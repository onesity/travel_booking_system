<?php

$conn=mysqli_connect('localhost','root','','travel_booking_system');
define('API_KEY', 'rzp_test_qOVILFcqtWc5fn');
define('API_SECRET', 'Cdyru1h9deyPtMhBzpC5fGcL');
$time=time();
define('RECIEPT_ID',"$time".uniqid());
return [
    'jwt-secret'=>'ffsfswrteryrhrhdteyete'
]
?>