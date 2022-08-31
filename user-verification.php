<?php

    require 'database.php';

    session_start();

    $email = $_SESSION['EMAIL'];

    if($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['otp'])){
        $e_mail = $mysqli->real_escape_string($email);
        $userProvidedOtp = $mysqli->real_escape_string($_POST['otp']);

        $stmt_update = $mysqli->prepare("UPDATE abuloy_users SET email_status = 1, user_type = 1 WHERE otp = $userProvidedOtp");
        $stmt_update->execute();
        
        $sql = "SELECT * FROM abuloy_users WHERE email = '$e_mail' AND otp = $userProvidedOtp";
        $result = $mysqli->prepare($sql);
        $result->execute();
        $get_result = $result->get_result();
        $user = $get_result->fetch_assoc();

        if($user) {
            $userEmail = $user['email'];
            if($userProvidedOtp == $user['otp'] && $user['email_status'] == 1){ 

                $login_update = $mysqli->prepare("UPDATE abuloy_users SET log_status = 1 WHERE email = '$userEmail'");
                $login_update->execute();

                // generate session again
                session_regenerate_id();

                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['user_email_status'] = $user['email_status'];
                $_SESSION['user_type'] = $user['user_type'];

                header("Location: /");
                exit;
            }
            else{
                print_r("Error validating OTP");
            }

        }
        else{ 
            json_encode(['status' => 'failure']);
            print_r("Failed to get user data");
            exit();
        }
    }

    

    
?>

