<?php

error_reporting(1);
if(empty($_POST['d_firstname'])){
    die("First name is required");
}

if(empty($_POST['d_lastname'])){
    die("Last name is required");
}

if(empty($_POST['d_birthdate'])){
    die("Birth date is required");
}

if(empty($_POST['d_date_of_death'])){
    die("Date of death is required");
}

if(empty($_POST['d_goal_amount'])){
    die("Goal amount is required");
}

if(empty($_POST['d_summary'])){
    die("A summary or story about the deceased is required");
}

if(empty($_POST['expiration'])){
    die("Expiration of this fund is required");
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
$utype = 1;
$short_code = random_strings(7);
$url_link = 'http://localhost/donate/' . $short_code;
// if($code_generated){
//     die("Code Activation not refreshing");
// }
$avatar = 'https://abuloy.ph/assets/img/no-image-available.png';
$createdate= date('Y-m-d H:i:s');
$updateddate= date('Y-m-d H:i:s');

// create a one-time-passcode (OTP)
// $otp = rand(111111, 999999);

$mysqli = require "./database.php";

$sql = "INSERT INTO abuloy_accounts (uid, utype, d_firstname, d_middlename, d_lastname, d_birthdate, d_date_of_death, d_goal_amount, d_summary, avatar, url_link, short_code, expiration, date_created, date_updated) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $mysqli->stmt_init();

if(!$stmt->prepare($sql)) {
    dir("SQL Error: " . $mysqli->error);
}

$stmt->bind_param("sssssssssssssss",
                  $_POST['uid'],
                  $utype,
                  $_POST['d_firstname'],
                  $_POST['d_middlename'],
                  $_POST['d_lastname'],
                  $_POST['d_birthdate'],
                  $_POST['d_date_of_death'],
                  $_POST['d_goal_amount'],
                  $_POST['d_summary'],
                  $avatar,
                  $url_link,
                  $short_code,
                  $_POST['expiration'],
                  $createdate,
                  $updateddate);

if($stmt->execute()){
    session_start();    
    // $_SESSION['short_code'] = $short_code;
    $_SESSION['uid'] = $_POST['uid'];
    header("Location: /start-new-fund-photo");    
    exit;
}else{
    if($mysqli->errno === 1) {
        die("account code already exist");
    }else{
        echo("Errorcode: " . $mysqli -> errno);
    }
}
