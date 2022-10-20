<!DOCTYPE html>
<html lang="en">
<?php 
require './head.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
require 'global_call.php';
require 'database.php';

    session_start();
    $email = $_SESSION['EMAIL'];
    $stmt = $mysqli->prepare("SELECT * FROM abuloy_users WHERE email = '$email' AND email_status = 1");
    $stmt_result = $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $email = $user['email']; 
    // $user = $stmt->fetch_assoc();
    // $stmt_result = $stmt->execute();
    // $result = $stmt->get_result();
    // $user = $result->fetch_all(MYSQLI_ASSOC);
    // $email = $user['email'];
    sendChangePassword($email);

    // function sendEmail logic
    function sendChangePassword($email){
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
            $mail->Subject='Password has been changed successfully!';
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
                    <td style='width:100vh;margin:2% 0;'><div style='margin-top:25px;text-align:left;width:100vh;'>Hi $user_firstname,<br/><br/><span style='color:#A265E6;font-weight:500'>Password Changed.</span><br/></div></td>
                </tr>
                <tr>
                    <td style='padding: 15px 0 20px;'>The password to your Abuloy Account with the email '$email' has been change successfully.<br/></td>
                </tr>
                <tr>
                    <td style='padding: 15px 0 0 0;'>However, if you did not make this action to change your password.<br/>Please email us immediately by replying to this email.</td>
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
<!-- register css -->
<!-- <link rel="stylesheet" href="http://localhost/assets/dist/css/pages/request-password.css"> -->
</head>
<body>
    <section class="my-5" style="height:61vh">
        <div class="container otp-container my-5 pt-5">
            <div class="col-lg-6 col-md-6 col-sm-12 text-center mx-auto">
                <legend class="text-lavander my-0 py-2">You've Successfully Reset Your Password!</legend>
                
                
                <div class="col-lg-10 col-md-8 col-sm-10 mx-auto text-center p-3">
                <small class="my-0 py-0">You can now use the new password for: '<?= $email ?>'.<br/>
                Just click the button below to login with your new password.</small>
                </div><br/>
                <div class="align-center">
                    <a href="/login" class="btn btn-lavander"> Login </a>
                </div>
            </div>
        </div>
    </section>
    <!-- login area -->    
    

    <!-- start Footer Area -->
    <?php include './footer.php' ?>     
    <!-- end Footer Area -->

    <!-- Plugins -->
    <?php include_once './plugins.php'; ?>
    <!-- Custom Script -->
    <!-- <script src="controllers/register.js"></script> -->

    <script></script>
</body>
</html>