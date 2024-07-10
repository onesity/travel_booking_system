<?php

require_once('../vendor/autoload.php');
$config = require_once('config.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

function is_login()
{
    global $config;
    $secret_key = $config['jwt-secret'];

    if (isset($_COOKIE['token'])) {
        $token = $_COOKIE['token'];
        $decoded = JWT::decode($token, new Key($secret_key, 'HS256'));
        return $decoded;
    } else {
        return false;
    }
}

function send_email($email, $subject, $body)
{

    // var_dump($body);
    // die;
    // Load Composer's autoloader
    require('../vendor/autoload.php');

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';                     // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'nishit.yatharthriti@gmail.com';           // SMTP username
        $mail->Password = 'ydll eyta jwst kyjv';                    // SMTP password
        $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 465;                                    // TCP port to connect to

        // Recipients
        $mail->setFrom($email);
        $mail->addAddress($email);

        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $body;
        // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $res = $mail->send();
        // die($res);
        return true;
    } catch (Exception $e) {
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }
}

function sidenavbar()
{
    echo '
      <div class="left-div">
      <h3 id="navigation_heading">Navigation</h3>
            <table id="nav_table">
                <tr id=\'table_row_home\' selected="true">
                    <td id="row_data" >
                    <i class="bi bi-house"></i><a href="index.php" id="nav_link">Home</a>
                    </td>
                </tr>';
    if (is_siteadmin()) {
        echo '
                <tr id=\'table_row_category\' selected="false">
                    <td id="row_data">
                    <i class="bi bi-house"></i><a href="category.php" id="nav_link">Category</a>
                    </td>
                </tr>';
        echo ' <tr id=\'table_row_trip\' selected="false">
                    <td id="row_data">
                    <i class="bi bi-house"></i><a href="locations.php" id="nav_link">Trips</a>
                    </td>
                </tr>';
        echo '<tr id=\'table_row_bookings\' selected="false">
                                <td id="row_data">
                                <i class="bi bi-house"></i><a href="users.php" id="nav_link">Users</a>
                                </td>
                            </tr>';
    }
    echo '<tr id=\'table_row_bookings\' selected="false">
                    <td id="row_data">
                    <i class="bi bi-house"></i><a href="booking.php" id="nav_link">Bookings</a>
                    </td>
                </tr>';
    echo ' <tr id=\'table_row_payments\' selected="false">
                    <td id="row_data">
                    <i class="bi bi-house"></i><a href="#" id="nav_link">Payments</a>
                    </td>
                </tr>
            </table>
        </div>

        <script>
        window.addEventListener(\'load\', () => {
        const hamburger_btn = document.getElementById(\'hamburger_btn\');
        const left_div = document.querySelector(\'.left-div\');
            const right_div = document.querySelector(\'.right-div\');
            let toggle = 0;
            hamburger_btn.addEventListener(\'click\', () => {
                if (toggle == 0) {
                    left_div.style.width = \'0\';
                    left_div.style.transition = \'1s\';
                    right_div.style.width = \'100%\';
                    right_div.style.marginLeft = \'0\';
                    // hamburger_btn.style.marginLeft=\'10%\';
                    // right_div.style.marginLeft= \'0\';
                    hamburger_btn.innerHTML = \'&#9776\'
                    toggle = 1;
                } else {
                    left_div.style.width = \'16%\';
                    left_div.style.transition = "1s";
                    right_div.style.marginLeft = \'1%\';
                    right_div.style.width = \'81%\';
                    hamburger_btn.innerHTML = \'&#x2716;\'
                    toggle = 0;
                }
            })

        })
        const nav_table=document.querySelectorAll("tr");
        nav_table.forEach((e)=>{
            let selected =document.querySelector(\'[selected="true"]\')
            selected.style.backgroundColor=\'lightblue\';
            e.addEventListener(\'click\',(s)=>{
                let selected =document.querySelector(\'[selected="true"]\')
                selected.style.backgroundColor=\'white\';
                selected.setAttribute(\'selected\',false);
                e.style.backgroundColor=\'lightblue\';
                e.setAttribute(\'selected\',true);
            })
        })
        </script>
        ';
}




function success_modal($msg, $location)
{
    echo '
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
    
        button {
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border: none;
            background-color: #4CAF50;
            color: white;
            border-radius: 5px;
        }
    
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1000; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgba(0, 0, 0, 0.5); /* Black w/ opacity */
            align-items: center;
            justify-content: center;
            display: flex;
        }
    
        .modal-content {
            background-color: #fff;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
            text-align: center;
            border-radius: 10px;
            position: relative;
        }
    
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            position: absolute;
            top: 10px;
            right: 20px;
            cursor: pointer;
        }
    
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
        }
    </style>
    
    <!-- Modal Structure -->
    <div id="successModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Success!</h2>
            <p>' . htmlspecialchars($msg) . '</p>
        </div>
    </div>
    
    <script>
        document.addEventListener(\'DOMContentLoaded\', function() {
            var modal = document.getElementById(\'successModal\');
            modal.style.display = \'flex\';
    
            // Close modal after 3 seconds and redirect
            setTimeout(function() {
                modal.style.display = \'none\';
                window.location.href = \'' . htmlspecialchars($location) . '\';
            }, 3000);
    
            document.querySelector(\'.close\').addEventListener(\'click\', function() {
                modal.style.display = \'none\';
            });
    
            // Close the modal if the user clicks anywhere outside of it
            window.onclick = function(event) {
                if (event.target === modal) {
                    modal.style.display = \'none\';
                }
            };
        });
    </script>
    ';
}

function confirmation_email_template($customer_name, $date, $location)
{

    $output = '
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Confirmation Email</title>
        <style>
            /* Reset styles */
            body, html {
                margin: 0;
                padding: 0;
                font-family: \'Arial\', sans-serif;
                line-height: 1.6;
                background-color: #f0f0f0;
            }
            /* Wrapper styles */
            .email-wrapper {
                width: 100%;
                max-width: 600px;
                margin: auto;
                padding: 20px;
                background-color: #ffffff;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(0,0,0,0.1);
            }
            /* Header styles */
            .header {
                background-color: #4CAF50;
                color: #ffffff;
                text-align: center;
                padding: 20px 0;
                border-radius: 5px 5px 0 0;
            }
            .header h1 {
                margin: 0;
                font-size: 24px;
            }
            /* Content styles */
            .content {
                padding: 20px;
            }
            .content p {
                margin: 10px 0;
            }
            /* Button styles */
            .btn {
                display: inline-block;
                padding: 10px 20px;
                background-color: #4CAF50;
                color: #ffffff;
                text-decoration: none;
                border-radius: 5px;
                margin-top: 15px;
            }
            .btn:hover {
                background-color: #45a049;
            }
            /* Footer styles */
            .footer {
                text-align: center;
                color: #888888;
                font-size: 12px;
                margin-top: 20px;
            }
            /* Multicolor styling */
            .color1 {
                color: #4CAF50;
            }
            .color2 {
                color: #2196F3;
            }
            .color3 {
                color: #F44336;
            }
            .color4 {
                color: #FF9800;
            }
            .color5 {
                color: #9C27B0;
            }
            .color6 {
                color: #673AB7;
            }
            /* Responsive images */
            img {
                max-width: 100%;
                height: auto;
                display: block;
                margin: auto; /* Center image */
            }
        </style>
    </head>
    <body>
        <div class="email-wrapper">
            <div class="header">
                <h1>Confirmation Email</h1>
            </div>
            <div class="content">
                <p>Dear <span class="color1">' . $customer_name . '</span>,</p>
                <p>Your <span class="color2">booking</span> has been <span class="color3">confirmed</span> successfully.</p>
                <p><span class="color4">Travel Date:</span> <span class="color5">' . $date . '</span></p>
                <p><span class="color6">Destination:</span> <span class="color1">' . $location . '</span></p>
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR3420502Ztc7RjaetY17CYvJv3m21wM14scg&s" alt="Travel Image">
                <p>If you have any questions or need further assistance, feel free to contact our <span class="color2">customer support</span> team at <a href="mailto:support@example.com" class="color3">support@example.com</a>.</p>
                <a href="#" class="btn">View Booking Details</a>
            </div>
            <div class="footer">
                <p>This email was sent to you by <span class="color4">Travel Booking System</span>. Please do not reply to this email.</p>
            </div>
        </div>
    </body>
    </html>
    ';
    return $output;
}


function get_all_states_of_india()
{
    $statesOfIndia = [
        0 => 'Select State',
        1 => "Andhra Pradesh",
        2 => "Arunachal Pradesh",
        3 => "Assam",
        4 => "Bihar",
        5 => "Chhattisgarh",
        6 => "Goa",
        7 => "Gujarat",
        8 => "Haryana",
        9 => "Himachal Pradesh",
        10 => "Jharkhand",
        11 => "Karnataka",
        12 => "Kerala",
        13 => "Madhya Pradesh",
        14 => "Maharashtra",
        15 => "Manipur",
        16 => "Meghalaya",
        17 => "Mizoram",
        18 => "Nagaland",
        19 => "Odisha",
        20 => "Punjab",
        21 => "Rajasthan",
        22 => "Sikkim",
        23 => "Tamil Nadu",
        24 => "Telangana",
        25 => "Tripura",
        26 => "Uttar Pradesh",
        27 => "Uttarakhand",
        28 => "West Bengal"
    ];
    return $statesOfIndia;
}

function is_siteadmin()
{
    $login_user_data = is_login();
    if ($login_user_data != false) {
        // die($login_user_data->data->role);
        if ($login_user_data->data->role == 'admin') {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function get_user()
{
    $res = is_login();
    if ($res !== false) {
        return $res->data;
    } else {
        return false;
    }
}
function connect()
{
    $conn = mysqli_connect('localhost', 'root', '', 'travel_booking_system');
    return $conn;
}

function get_user_by_id($id)
{
    $query = "select * from user where id=$id";
    $query_res = mysqli_fetch_assoc(mysqli_query(connect(), $query));
    return $query_res;
}

function get_payment_informations($order_id)
{
    $api = new Razorpay\Api\Api(API_KEY, API_SECRET);
    $payment_info = $api->order->fetch($order_id);
    return $payment_info;
}


function update_payment_status_schedule_task(){
    $current_time=time();
    $before_time=$current_time-3600;
    $query="select order_id from orders where  timecreated between $current_time and $before_time";
    $query_res=mysqli_query(connect(),$query);
    if(mysqli_num_rows($query_res)!=0){
        $total_records=mysqli_num_rows($query_res);
        while($total_records!=0){
            $order_data=mysqli_fetch_assoc($query_res);
            $payment_data=get_payment_informations($order_data['order_id']);
            return $payment_data;
        }
    }else{
        return false;
    }


}

// die("dsd");