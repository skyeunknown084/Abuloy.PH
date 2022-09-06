<?php

    require 'database.php';

    session_start();

    $email = $_SESSION['EMAIL'];

    if($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['otp'])){
        $e_mail = $mysqli->real_escape_string($email);
        $adminProvidedOtp = $mysqli->real_escape_string($_POST['otp']);

        $stmt_update = $mysqli->prepare("UPDATE abuloy_users SET email_status = 1, user_type = 3 WHERE otp = $adminProvidedOtp");
        $stmt_update->execute();
        
        $sql = "SELECT * FROM abuloy_users WHERE email = '$e_mail' AND otp = $adminProvidedOtp";
        $result = $mysqli->prepare($sql);
        $result->execute();
        $get_result = $result->get_result();
        $admin = $get_result->fetch_assoc();

        if($admin) {
            $adminEmail = $admin['email'];
            if($adminProvidedOtp == $admin['otp'] && $admin['email_status'] == 1){ 

                $login_update = $mysqli->prepare("UPDATE abuloy_users SET log_status = 1 WHERE email = '$adminEmail'");
                $login_update->execute();

                // generate session again
                session_regenerate_id();

                $_SESSION['user_id'] = $admin['id'];
                $_SESSION['user_email'] = $admin['email'];
                $_SESSION['user_email_status'] = $admin['email_status'];
                $_SESSION['user_type'] = $admin['user_type'];
                $_SESSION['user_firstname'] = $admin['firstname'];

                header("Location: /admin");
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

