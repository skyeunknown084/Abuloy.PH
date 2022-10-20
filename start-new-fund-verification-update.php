<?php

require 'database.php';
$stmt = $mysqli->query("SELECT * FROM abuloy_accounts WHERE token = '$token'");
$accounts = $stmt->fetch_assoc();

$token = $accounts['token'];
// $d_firstname = $accounts['d_firstname'];
// $d_middlename = $accounts['d_middlename'];
// $d_lastname = $accounts['d_lastname'];

if($accounts){
    // send email
    $stmt_update = $mysqli->prepare("UPDATE abuloy_accounts SET account_status = 1 WHERE token = ?");
    $stmt_update->bind_param('s', $token);
    $stmt_update->execute();

    session_start();
    header("Location: /");
    exit;
    
}