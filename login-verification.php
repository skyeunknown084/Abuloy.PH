
<?php

    // require 'database.php';
    // error_reporting(0);
    // session_start();

    // if($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['otp'])){
    //     $e_mail = $mysqli->real_escape_string($verify_user_email);
    //     $userProvidedOtp = $mysqli->real_escape_string($_POST['otp']);

    //     $stmt_update = $mysqli->prepare("UPDATE abuloy_users SET email_status = 1, log_status = 1, user_type = 1 WHERE otp = $userProvidedOtp");
    //     $stmt_update->execute(); 
        
    //     $log_verify_user = $mysqli->query("SELECT * FROM abuloy_users WHERE email = '$e_mail'");
    //     if($user = $log_verify_user->fetch_assoc()){        
    //         // generate session again
    //         // session_start();
    //         session_regenerate_id();
    //         $_SESSION['user_id'] = $user['id'];
    //         $_SESSION['user_log'] = $user['log_status'];
    //         $_SESSION['user_type'] = $user['user_type'];
    //         $_SESSION['user_email'] = $user['email'];
    //         $_SESSION['user_email_status'] = $user['email_status'];
    //         $_SESSION['user_log_status'] = $user['log_status'];
    //         $_SESSION['user_firstname'] = $user['firstname'];
    //         $_SESSION['user_token'] = $user['token'];

    //         // header("Location: /email-activation-success");
    //         header("Location: /");
    //         exit;
    //     }
    // }
    // else{ 
    //     // json_encode(['status' => 'failure']);
    //     $_SESSION['error_log_verify'] = "Failed to get user data";
    //     // exit();
    // }
        

    // if($_SERVER['REQUEST_METHOD'] === "GET"){
        
    // }
?>
<!DOCTYPE html>
<html lang="en">
<?php require 'head.php'; ?>
</head>
<body>

    <?php
        // require 'database.php';

        out($_POST['email']);
        out($_POST['csrf']);
        
        // if(isset($verify_user_email)){
        //     out($verify_user_email);
        //     // include 'login-verification-content-success.php';
        // }
        // else{
        //     out($verify_user_email);
        //     include 'login-verification-content-failed.php';
        // }
    ?>

    <!-- start Footer Area -->
    <?php include 'footer.php' ?>     
    <!-- end Footer Area -->

    <!-- Plugins -->
    <?php include_once 'plugins.php'; ?>
    <!-- Custom Script -->
    <!-- <script src="controllers/register.js"></script> -->

    <!-- <script>
        const submitOtp = document.querySelector('.otp-submit')
        const otpContainer = document.querySelector('.otp-container')
        const otpError = document.querySelector('.otp-error')
        const otpForm = document.querySelector('.otp-form')

        $(document).ready(function(){
            // $(".email-submit").submit();            
        })

        $('.otp-submit').submit(function(){
            e.preventDefault()

            $.ajax({
                url:'/user-verification',
                data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                success:function(data){
                    location.href= "/";
                    window.location.href="/";
                    console.log(data);
                    if(data.status =='success'){
                        window.location.replace("/");
                        window.location.href="/";
                    }
                    else{
                        error(otpError, "Incorrect OTP provided");
                    }
                }
            })
            
        })

        function error(span, msg){
            span.textContent = msg
            span.style.color='red'
            setTimeout(()=>{span.textContent=""}, 3000)
        }

        
    </script> -->
</body>
</html>