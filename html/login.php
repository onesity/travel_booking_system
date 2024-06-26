<?php
include('header.php');

$config = require_once('config.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login page</title>
    <style>
        #username_error,
        #email_error,
        #password_error {
            color: red;
            margin-left: 20px;
            display: none;
        }
        #login_msg{
            margin-left: 10px;
            margin-top: 10px;
            
        }
        #msg_div{
            background-color:#f4d6d2;
            height: 40px;
            margin-bottom: 20px;
            width: 305px;
            margin-left: 20px;
          padding-top: 12px;
          display: none;
            word-wrap: break-word;
        }
        #forgot_password_link{
            margin-left: 20px; 
            cursor: pointer;
            font-size: 15px;
        }
        #resend_password_link{
            margin-left: 20px; 
            cursor: pointer;
            text-decoration: underline;
            font-size: 15px;

        }
    
    </style>
</head>

<body>
    
    <div class="form-div">
        <h2 id="form-heading">Login to your account</h2>
        <form action="" id="login_form">
            <div id="msg_div">
                <span id='login_msg'>sdfs f sdfsd fsd fsdfsdf</span>
            </div>
            <input type="text" placeholder="email" name="email" id="email">
            <span id="email_error">email error</span>
            <br><br>
            <input type="text" placeholder="password" name="password" id="password">
            <span id="password_error">password error</span>
            <br><br>
            <a href='#' id="forgot_password_link">Forgot Password</a>
            <br><br>
            <input type="button" id='login' value="Login">
            <br><br>
            <span id="login-link">Create account?</span>
            <a href="signup.php"> Signup</a>
         
        </form>
    </div>

    <script type='module' src="../js/login_script.js"></script>
</body>

</html>

<?php

include('footer.php');

?>