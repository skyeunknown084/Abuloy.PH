<?php
    if (strlen($_POST['password']) < 8) {
        die("Password must be at least 8 characters");
    }
    
    if(!preg_match("/[a-z]/i", $_POST['password'])){
        die("Password must contain at least one letter");
    }

    if($_POST['password'] !== $_POST['password_confirmation']){
        die("Passwords must match");
    }


    require 'database.php';

    session_start();

    $email = $_SESSION['EMAIL'];

    if($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['password'])){
        $userEmail = $mysqli->real_escape_string($email);
        $userNewPassword = $mysqli->real_escape_string($_POST['password']);
        $userNewPasswordConfirm = $mysqli->real_escape_string($_POST['password_confirmation']);
        $password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $updateqry = "UPDATE abuloy_users SET email_status = 1, user_type = 1, log_status = 0, password_hash = ? WHERE email = ?";
        $stmt_update = $mysqli->prepare($updateqry);
        $stmt_update->bind_param('ss', $password_hash, $userEmail);
        $stmt_update->execute();
        $result_update = $stmt_update->affected_rows;

        if($result_update > 0){

            $stmt = $mysqli->prepare("SELECT * FROM abuloy_users WHERE email = '$userEmail' AND password_hash = '$password_hash';");
            $stmt_result = $stmt->execute();
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();
            if($user){
                $userNewPasswordHashed = $user['password_hash'];
                // echo $userNewPasswordHashed;
                if(password_verify($userNewPassword, $userNewPasswordHashed)){

                    session_regenerate_id();

                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['user_email_status'] = $user['email_status'];
                    $_SESSION['user_type'] = $user['user_type'];
                    $_SESSION['user_log'] = $user['log_status'];
                    $_SESSION['user_email'] = $user['email'];

                    // sendResetEmail($email);
                    // json_encode(['status' => 'success']);
                    header("Location: /reset-password-success");
                    // header("Location: /login");
                    exit;
                    
                }
                else{
                    // json_encode(['status' => 'failure']);
                    header("Location: /reset-password-failed");
                    exit();
                }
                
            }
            else{ 
                json_encode(['status' => 'failure']);
                print_r('Error changing password. Password did not change');
                exit();
            }
        }

        
                   
    }