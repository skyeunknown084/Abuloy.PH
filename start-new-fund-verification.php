<?php

    require 'global_call.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    
    require 'database.php';
    // session_start();
    $stmt = $mysqli->query("SELECT * FROM abuloy_accounts WHERE token = '$token'");
    $accounts = $stmt->fetch_assoc();

    $token = $accounts['token'];
    $email = $accounts['email'];
    $d_firstname = $accounts['d_firstname'];
    $d_middlename = $accounts['d_middlename'];
    $d_lastname = $accounts['d_lastname'];

    function sendNewFundVerification($token, $email, $d_firstname, $d_middlename, $d_lastname) {
        require "global_call.php";
        // $user_stmt = $mysqli->query("SELECT firstname FROM abuloy_users WHERE email = '$email';");
        // if($user_row = $user_stmt->fetch_assoc()){
        //     $user_firstname = $user_row['firstname'];
            // $clientIPAddress=$_SERVER['REMOTE_ADDR'];
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
        $mail->Subject='Verify Your New Fund Now!';
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
                <td style='width:100vh;margin:2% 0;'><div style='margin-top:25px;text-align:left;width:100vh;'>Hi! You successfully create a new fund for '$d_firstname $d_middlename $d_lastname'.<br/>To start accumulating donations, please click the button below and your fund will be publish.</div><br/><br/></td>
            </tr>            
            <tr><td><a href='http://abuloy.ph/start-new-fund-verification-update/$token' style='height:50px;border-radius:25px;background-color:#A265E6;color:#94F7CF;padding:8px 15px;text-align:center;font-weight:600;font-family:Poppins;text-decoration:none;'> Verify Account </a></td></tr>
            <tr><td><br/><br/><div>You may also be the first one to share this fund by clicking the social media icons in the page. <br/>Thank you.<div></td></tr>
            <tr><td style='padding: 15px 0 20px;'><div style='margin-top:25px;'><br/><br/>Best Regards,<br/>Abuloy PH Team<div></td></tr>
        </table>";
        $mail->send();
        }catch(Exception $e){
            {echo $e;}
        }
        // }
        // else{
        //     $_SESSION['error_reg'] = "Email did not sent";
        // }
    }
        
    if($accounts){
        // send email for New Fund
        sendNewFundVerification($token, $email, $d_firstname, $d_middlename, $d_lastname);
    }
?>
<!DOCTYPE html>
<html lang="en">
<?php include 'head.php'; ?>
</head>
<body>

    <?php include 'header.php'; ?>
    
    <section class="my-5" style="height:60vh">
        <div class="container otp-container my-5 pt-2">
            <div class="col-lg-6 col-md-6 col-sm-12 text-center mx-auto mt-5">
                <legend class="text-lavander my-0 py-0">New Fund Verification Sent!</legend>
                <small class="text-blackish">To complete your fund verification please check your email inbox or spam message and click the button provided in the email to complete.</small>
                <br/><br/>
                <img src="https://abuloy.ph/assets/img/mail-icon.png" alt="mail icon" style="height:175px;object-fit: fill">
                <div class="hide alert alert-info col-lg-6 col-md-8 col-sm-10 mx-auto text-justify"><small class="">Note: Please contact our customer service if you haven't received any email from us.</small></div>
            </div>
        </div>
    </section>

    <!-- start Footer Area -->
    <?php include 'footer.php' ?>     
    <!-- end Footer Area -->

    <!-- Plugins -->
    <?php include 'plugins.php'; ?>
    <!-- Custom Script -->
    <!-- <script src="controllers/register.js"></script> -->
</body>
</html>