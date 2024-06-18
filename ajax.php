<?php

require_once('vendor/autoload.php');
require_once("lib.php");

use Firebase\JWT\JWT;

header('Content-Type:application/json');

$data = json_decode(file_get_contents('php://input'), true);
$action = $data['action'];

if ($action == 'signup' || $action == 'otp_verification') {
    global $otp;
    if($action=='signup'){

        $email = $data['email'];
        $password = $data['password'];

        $existing_query = "select * from user where email='$email'";
        $existing_query_result = mysqli_query($conn, $existing_query);

        if (mysqli_num_rows($existing_query_result) > 0) {
            $response = ['success' => false, 'msg' => 'Email already registered!'];
        } else {
            global $otp;
            $username = $data['username'];
            $timecreated = time();
            $role = 'user';
            
            $querry = "insert into  user(username,email,password,role,timecreated) values('$username','$email','$password','$role','$timecreated')";
            $subject='OTP for the registartion';
            $otp=rand(100000,999999);
            $body="Your one time password for the account creation is  $otp, Please verify and do not share it with anyone.
            Thank You ";
            send_email($email,$subject,$body);
            
            $res = mysqli_query($conn, $querry);
            if ($res) {
                $response = ['success' => true, 'msg' => "An OTP is sent to your email $email. Please verify it."];
            } else {
                $response = ['success' => false, 'msg' => 'Something went wrong,please try again later!'];
            }
        }
    }else{
        global $otp;
        $user_otp=$data['otp'];
        if($user_otp==$otp){
            $response = ['success' => true, 'msg' => 'Your account created successfully!'];  
        }else{
            $response = ['success' => false, 'msg' => 'Please enter correct OTP!','user_otp'=>$user_otp,'otp'=>$otp];  
        }
    }
    echo json_encode($response);
    exit;
}

if ($action == 'login') {

    $email = $data['email'];
    $password = $data['password'];

    $query = "select * from user where email='$email'";
    $res = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($res);
    
    if (mysqli_num_rows($res) != 0) {
        if ($password == $user['password']) {
            $secret_key = $config['jwt-secret'];
            $token = JWT::encode(
                array(
                    'iat' => time(),
                    'nbf' => time(),
                    'exp' => time() + 3600,
                    'data' => array(
                        'userid' => $user['id'],
                        'username' => $user['username'],
                        'email' => $user['email'],
                        'role' => $user['role'],
                    )
                ),
                $secret_key,
                'HS256'
            );
            setcookie('token', $token, time() + 3600, "/", "", true, true);
            $response = ['login' => true, 'msg' => 'Login successfully!'];
        } else {
            $response = ['login' => false, 'msg' => 'Please enter the correct username/password'];
        }
    } else {
        $response = ['login' => false, 'msg' => 'Please enter the correct username/password!'];
    }

    echo json_encode($response);
    exit;
}



