<?php
require 'global_call.php';
require 'database.php';

session_start();
// error_reporting(0);
$email = $_SESSION['user_email'];
// change log_status 1 to 0 as offline
if($_SERVER['REQUEST_METHOD'] === "GET" && isset($email)){
    $logout_qry = "UPDATE abuloy_users SET log_status = 0 WHERE email = ?";
    $stmt_result = $mysqli->prepare($logout_qry);
    $stmt_result->bind_param('s', $email);
    $stmt_result->execute();
    // $result = $stmt->get_result();
    $user = $stmt_result->affected_rows;
    echo $user;
    if($user == 0){
        unset($user);
        session_unset();
        session_destroy();
        header('Location: /');
        
    }
    else{
        header('Location: /login');
    }
    // if($user == true){
    //     // destroy session
    //     // echo $user;
    //     unset($user);
    //     session_unset();
    //     session_destroy();
    //     // // redirect to login
    //     header("Location: /login");
    // }
    // $stmt_result->close();
    // else{
    //     // destroy session
    //     session_unset();
    //     session_destroy();
    //     // redirect to login
    //     header("Location: /login");
    // }
}
else{
    unset($user);
    session_unset();
    session_destroy();
    header('Location: /');
}
unset($user);
session_unset();
session_destroy();
header('Location: /');
// else{
//     // destroy session
//     session_unset();
//     session_destroy();
//     // redirect to login
//     header("Location: /login");
// }
// else{
//     print_r("updating logout status failed");
//     exit;
// }






