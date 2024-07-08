<?php
require_once("config.php");
require_once("../vendor/autoload.php");
require_once("lib.php");
session_start();

use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;


$status = false;

global $CFG;

$error = "Payment Failed";

if (empty($_POST['razorpay_payment_id']) === false) {
	$api = new Api(API_KEY, API_SECRET);

	try {
		$attributes = array(
			'razorpay_order_id' => $_POST['razorpay_order_id'],
			'razorpay_payment_id' => $_POST['razorpay_payment_id'],
			'razorpay_signature' => $_POST['razorpay_signature']
		);

		$api->utility->verifyPaymentSignature($attributes);
		$status = true;
	} catch (SignatureVerificationError $e) {
		$status = false;
		$error = 'Razorpay Error : ' . $e->getMessage();
	}
}

if ($status == true) {
	$userid = $_POST['userid'];
	$order_id = $_POST['razorpay_order_id'];
	$travelid = $_POST['travelid'];
	$razorpay_payment_id = $_POST['razorpay_payment_id'];
	$query = "select * from orders where userid='$userid' and travelid='$travelid' and order_id='$order_id'";
	$query_res = mysqli_query($conn, $query);
	if ($query_res == true) {
		$order = mysqli_fetch_assoc($query_res);
		$order_id = $order['order_id'];

		$id = $order['id'];

		$api = new Razorpay\Api\Api(API_KEY, API_SECRET);
		$order = $api->order->fetch($order_id);

		if ($order['amount'] == $order->amount && $order->amount == $order->amount_paid && $order->status == 'paid') {
			$query = "update orders set status='$order->status',payment_id='$razorpay_payment_id' where id='$id' and userid='$userid' and order_id='$order_id' and travelid='$travelid'";
			$res = mysqli_query($conn, $query);
			$user_query = "select * from user where id='$userid'";
			$user_query_exe = mysqli_query($conn, $user_query);

			if ($user_query_exe) {
				$user_query_res = mysqli_fetch_assoc($user_query_exe);
				$subject = 'Payment Confirmation for travle booking!';
				$email = send_email($user_query_res['email'], $subject, confirmation_email_template($user_query_res['username'], '20-08-2024', 'Manali'));
				success_modal('Thanks for the payment', 'index.php');
			} else {
				success_modal('Payment Success mail failed! ', 'index.php');
			}
		} else {
		}
	} else {
	}
} else {
	success_modal('Payment Failed!, Something went wrong!', 'checkout.php');
}
