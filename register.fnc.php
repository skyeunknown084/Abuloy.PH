<?php

error_reporting(1);
if(empty($_POST['firstname'])){
    die("First name is required");
}

if(empty($_POST['lastname'])){
    die("Last name is required");
}

if(empty($_POST['mobile'])){
    die("Mobile number is required");
}

if(! filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
    die("Valid email is required");
}

if (strlen($_POST['password']) < 8) {
    die("Password must be at least 8 characters");
}

if(!preg_match("/[a-z]/i", $_POST['password'])){
    die("Password must contain at least one letter");
}

if($_POST['password'] !== $_POST['password_confirmation']){
    die("Passwords must match");
}

function random_strings($length_of_string)
{
    
    // String of all alphanumeric character
    $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';    
    // Shuffle the $str_result and returns substring
    // of specified length
    return substr(str_shuffle($str_result),
                        0, $length_of_string);
}

$code_generated = random_strings(7);

// if($code_generated){
//     die("Code Activation not refreshing");
// }

$password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
$createdate= date('Y-m-d H:i:s');

// create a one-time-passcode (OTP)
// $otp = rand(111111, 999999);
$mobile_extph = 9;
$mobile = $mobile_extph . $_POST['mobile'];

$mysqli = require __DIR__ . "./database.php";

$sql = "INSERT INTO abuloy_users (firstname, lastname, mobile, email, password_hash, code_activation, date_created) VALUES (?, ?, ?, ?, ?, ?, ?)";

$stmt = $mysqli->stmt_init();

if(!$stmt->prepare($sql)) {
    dir("SQL Error: " . $mysqli->error);
}

$stmt->bind_param("sssssss",
                  $_POST['firstname'],
                  $_POST['lastname'],
                  $mobile,
                  $_POST['email'],
                  $password_hash,
                  $code_generated,
                  $createdate);

if($stmt->execute()){
    session_start();    
    $_SESSION['EMAIL'] = $_POST['email'];
    header("Location: /login-verification");    
    exit;
}else{
    if($mysqli->errno === 1) {
        die("email already exist");
    }else{
        echo("Errorcode: " . $mysqli -> errno);
    }
}