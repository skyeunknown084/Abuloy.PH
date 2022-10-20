<!DOCTYPE html>
<html lang="en">
<?php 
require './head.php';

// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\SMTP;
// use PHPMailer\PHPMailer\Exception;

// require 'vendor/autoload.php';
require './global_call.php';
require './database.php';

    session_start();
    $email = $_SESSION['EMAIL'];
    $stmt = $mysqli->prepare("SELECT * FROM abuloy_users WHERE email = '$email' AND email_status = 0");
    $stmt_result = $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $email = $user['email']; 
    // $user = $stmt->fetch_assoc();
    // $stmt_result = $stmt->execute();
    // $result = $stmt->get_result();
    // $user = $result->fetch_all(MYSQLI_ASSOC);
    // $email = $user['email'];

?>
<!-- register css -->
<!-- <link rel="stylesheet" href="http://localhost/assets/dist/css/pages/request-password.css"> -->
</head>
<body>
    <section class="my-5" style="height:61vh">
        <div class="container otp-container my-5 pt-5">
            <div class="col-lg-6 col-md-6 col-sm-12 text-center mx-auto">
                <legend class="text-lavander my-0 py-2">Resetting Your Password Failed!</legend>
                
                
                <div class="col-lg-10 col-md-8 col-sm-10 mx-auto text-center p-3">
                <small class="my-0 py-0">Something goes wrong while resetting your email.<br/>
                Just click the button below to retry again.</small>
                </div><br/>
                <div class="align-center">
                    <a href="/forgot-password" class="btn btn-lavander"> Try Again </a>
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