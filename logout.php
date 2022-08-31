<?php
require 'global_call.php';
$mysqli = require __DIR__ . "./database.php";

session_start();
$email = $_SESSION['user_email'];
// change log_status 1 to 0 as offline
if(isset($_SESSION['user_email'])){
    $email = $_SESSION['user_email'];
    echo $email;
    echo "<script>alert(".$email.")</script>";
    $logout_qry = $mysqli->prepare("UPDATE abuloy_users SET log_status = 0 WHERE email = '$email'");
    $logout_qry->execute();
    $log_result = $logout_qry->affected_rows;
    if($log_result > 0){
        // destroy session
        session_destroy();
        // redirect to login
        header("Location: /login");
        exit;
    }
}else{
    print_r("updating log status failed");
    exit;
}






