<?php
require 'global_call.php';
require 'database.php';

session_start();
error_reporting(0);
$email = $_SESSION['user_email'];
// change log_status 1 to 0 as offline
if(isset($_SESSION['user_email'])){
    $email = $_SESSION['user_email'];
    $logout_qry = $mysqli->prepare("UPDATE abuloy_users SET log_status = 0 WHERE email = '$email'");
    $logout_qry->execute();
    $log_result = $logout_qry->affected_rows;
    if($log_result > 0){
        // destroy session
        session_destroy();
        // redirect to login
        header("Location: /");
        exit;
    }
}
else{
    header("Location: /");
}
// else{
//     print_r("updating logout status failed");
//     exit;
// }






