<?php

require 'database.php';
$stmt = $mysqli->query("SELECT * FROM abuloy_accounts WHERE token = '$token'");
$accounts = $stmt->fetch_assoc();

$token = $accounts['token'];

if($accounts){
    // send email
    $stmt_update = $mysqli->prepare("UPDATE abuloy_accounts SET account_status = 1 WHERE token = ?");
    $stmt_update->bind_param('s', $token);
    $stmt_update->execute();

    session_start();
    header("Location: /my-fund/".$token);
    exit;
    
}