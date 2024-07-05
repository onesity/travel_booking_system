<?php
require_once("config.php");
require_once("../vendor/autoload.php");

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
$data = $_POST;

?>
