<?php

require 'database.php';
$stmt = $mysqli->query("SELECT * FROM abuloy_users WHERE token = '$token'");
$user = $stmt->fetch_assoc();

$token = $user['csrf'];
$otp = $user['otp'];
$email = $user['email'];
$firstname = $user['firstname'];
// $generate_token = $user['token'];
if($user){
    // send email
    $stmt_update = $mysqli->prepare("UPDATE abuloy_users SET email_status = 1, log_status = 0, user_type = 1 WHERE email = ?");
    $stmt_update->bind_param('s', $email);
    $stmt_update->execute();

    header("Location: /login");
    exit;
    
}