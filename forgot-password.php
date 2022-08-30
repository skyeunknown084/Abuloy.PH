<!DOCTYPE html>
<html lang="en">
<?php 
require 'global_call.php';
require 'head.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'database.php';
require 'vendor/autoload.php';

session_start();
if($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['email'])){
    $email = $mysqli->real_escape_string($_POST['email']);

    $stmt_update = $mysqli->prepare("UPDATE abuloy_users SET email_status = 0, user_type = 3 WHERE email = '$email'");
    $stmt_update->execute();
    
    $sql = "SELECT * FROM abuloy_users WHERE email = '$email'";
    $result = $mysqli->prepare($sql);
    $result->execute();
    $get_result = $result->get_result();
    $user = $get_result->fetch_assoc();

    if($user) {

        if($email == $user['email']){           

            session_regenerate_id();

            $_SESSION['EMAIL'] = $user['email'];
            
            sendForgotEmail($email);                
            
            header("Location: /reset-password");
            exit;
        }
        else{
            print_r("Error validating email for password reset");
        }

    }
    else{ 
        json_encode(['status' => 'failure']);
        print_r("Failed to get user data");
        exit();
    }
}


    // function sendEmail logic
    function sendForgotEmail($email){
        require 'global_call.php';
        require 'database.php';
        $user_stmt = $mysqli->query("SELECT firstname FROM abuloy_users WHERE email = '$email';");
        if($user_row = $user_stmt->fetch_assoc()){
            $user_firstname = $user_row['firstname'];
            $clientIPAddress=$_SERVER['REMOTE_ADDR'];
            $mail = new PHPMailer(true);
        
            try{
            $mail->isSMTP();
            $mail->Debugoutput = 'html';
            $mail->Host = $_ENV['PHPMAIL_HOST'];
            $mail->Username = $_ENV['PHPMAIL_FROM'];
            $mail->Password = $_ENV['PHPMAIL_PWRD'];
            $mail->SMTPAuth=true;
            $mail->Port = $_ENV['PHPMAIL_PORT'];
            $mail->SMTPSecure = 'tls';
            $mail->setFrom($_ENV['PHPMAIL_FROM'], $_ENV['PHPMAIL_NAME']);
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject='Forgot Password';
            $mail->Body = "<link href='https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap' rel='stylesheet'>
            <style type='text/css'>
            body {
                font-family: 'Poppins', Sans-Serif;
            }
            </style>    
            <table style='width:50vw'>
                <tr>
                    <td><a href='abuloy.ph' style='background-color:#A265E6;color:white;font-size:24px;padding:0.2rem 0.5rem;margin:0;border-top-left-radius:30px;border-top-right-radius:6px;border-bottom-left-radius:6px;border-bottom-right-radius:6px;'><span style='font-family:Poppins,sans-serif;font-weight:700;text-decoration:underline;color:#94F7CF;margin-left:0.5rem'>Abuloy</span></a></td>
                </tr>
                <tr>
                    <td><div style='position:relative;top:10px;margin:5px 0;border-bottom: 2px solid #94F7CF'></div></td>
                </tr>
                <tr>
                    <td style='width:100vh;margin:2% 0;'><div style='margin-top:25px;text-align:left;width:100vh;'>Hi $user_firstname,<br/><br/><span style='color:#A265E6;font-weight:500'>Forgot your password? Let's have a new one!</span><br/></div></td>
                </tr>
                <tr>
                    <td style='padding: 15px 0 20px;'>We have received a request to reset your password for Abuloy.PH account.</td>
                </tr>
                <tr><td style='padding: 0px 0 15px 0;'>You can change your password by clicking the link below:</td></tr>
                <tr>
                    <td style='padding: 0px 0 15px 0;'><a href='abuloy.ph/reset-password' style='height:50px;border-radius:25px;background-color:#A265E6;color:#94F7CF;padding:8px 15px;text-align:center;font-weight:500;font-family:Poppins'>Set a new password</a></td>
                </tr>
                <tr>
                    <td style='padding: 15px 0 0 0;'>However, if you did not request to reset your password.<br/>Please email us immediately by replying to this email.</td>
                </tr>
            </table>";
            $mail->send();
            }catch(Exception $e){
                {echo $e;}
            }
        }else{
            echo 'Not working query';
        }           
    }
?>
<link rel="stylesheet" href="./assets/dist/css/pages/forgot-password.css">
</head>
<body>
    <?php include_once 'header.php'; ?>

    <!-- login area -->
    <section id="login" class="pt-5 mt-5">
        <div class="container mx-auto  login-form-height" >
            <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                <legend class="text-lavander text-center fw-bolde">Forgot Your Password?</legend>
                <div class="alert alert-info mx-auto col-lg-5 col-md-9 col-sm-12 p-1">
                <small class="text-justify">Don't worry, just enter and submit us the e-mail address you use to sign-in and we will send you instructions to reset your password. If you did not receive any e-mail be sure to check on spam.</small>
                </div>
                
                <div class="d-flex justify-content-center align-items-center mb-5">                
                    <form action="" method="post" id="forgot-form" class="mb-5">
                        <div class="form-row lavander-form mt-4">
                            <div class="col">
                                <input type="email" name="email" id="email" class="form-control my-3 text-center forgot-email" placeholder="Enter email address" required>
                            </div>
                        </div>
                        <div class="submit-btn text-center mb-1">
                            <button type="submit" id="forgot-submit" class="btn btn-lavander btn-sm text-white text-uppercase fs-large py-1 rounded-pill text-dark px-4 mb-4  ">Submit</button>
                        </div>
                        <small class="text-blackish">No, I want to create a new account? <a href="/register" class="no-style text-lavander">Sign-up</a></small><br/>
                        <small class="text-blackish">Oh! I remember my credentials now, let me <a href="/login" class="no-style text-lavander">login</a></small>
                        <!-- <div class="gfm-embed" data-url="https://www.gofundme.com/f/ukraine-humanitarian-fund/widget/large/"></div>
                        <script defer src="https://www.gofundme.com/static/js/embed.js"></script> -->
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- start Footer Area -->
    <?php include 'footer.php' ?>     
    <!-- end Footer Area -->

    <!-- Plugins -->
    <?php include_once 'plugins.php'; ?>
    <!-- Custom Script -->
    <script>
        const submitforgot = document.querySelector('.forgot-submit')
        const forgotContainer = document.querySelector('.forgot-container')
        const forgotError = document.querySelector('.forgot-error')
        const forgotForm = document.querySelector('.forgot-form')
        const forgotEmail = document.querySelector('.forgot-email')

        $(document).ready(function(){
            // $(".email-submit").submit();            
        })

        $('.forgot-submit').submit(function(){
            e.preventDefault()

            $.ajax({
                url:'/reset-password-fnc',
                data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                success:function(data){
                    location.href= "/reset-password/" + forgotEmail;
                    window.location.href="/reset-password" + forgotEmail;
                    console.log(data);
                    if(data.status =='success'){
                        window.location.replace("/reset-password" + forgotEmail);
                        window.location.href="/reset-password" + forgotEmail;
                    }
                    else{
                        error(forgotError, "Incorrect email provided")
                    }
                }
            })
            
        })

        function error(span, msg){
            span.textContent = msg
            span.style.color='red'
            setTimeout(()=>{span.textContent=""}, 3000)
        }

        
    </script>
</body>
</html>