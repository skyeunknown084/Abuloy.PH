<?php
require 'database.php';

session_start();
// error_reporting(0);
$email = $_SESSION['user_email'];
// $token = $_POST['csrf'];

// out($token);
if($_SERVER['REQUEST_METHOD'] === "GET" && isset($email)) {
    $logout_qry = "UPDATE abuloy_users SET log_status = 0 WHERE email = ?";
    $stmt_result = $mysqli->prepare($logout_qry);
    $stmt_result->bind_param('s', $email);
    $stmt_result->execute();
    // $result = $stmt->get_result();
    $user = $stmt_result->affected_rows;
    if($user > 0){
        unset($user);
        unset($_SESSION);
        session_unset();
        session_destroy();
        header('Location: /');
        exit;        
    }
    else{
        out($user);
        // unset($user);
        // unset($_SESSION);
        // session_unset();
        // session_destroy();
        // header('Location: /');   
    }
}
else{
    // $emailadd = $_POST['email'];
    // out($emailadd);
    $out_qry = "UPDATE abuloy_users SET log_status = 0 WHERE token = ?";
    $out_result = $mysqli->prepare($out_qry);
    $out_result->bind_param('s', $token);
    $out_result->execute();
    $user = $out_result->affected_rows;
    if($user > 0){
        unset($user);
        unset($_SESSION);
        session_unset();
        session_destroy();
        header('Location: /login');
        exit;
    }
    else{
        out($user);
    }
}
