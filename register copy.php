<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
// error_reporting(0);
// limit login attempts 3x
$signup = 0;
$otp_form = 0;
if($signup == 0 && $otp_form == 0){
    $otp_style = "style='display:none;visibility:hidden'";
}

if($_SERVER['REQUEST_METHOD'] === "POST"){
    require "database.php";

    $token = $_POST["csrf"];
    $firstname  = $_POST['firstname'];
    $lastname  = $_POST['lastname'];
    $mobile  = $_POST['mobile'];
    $email  = $_POST['email'];
    $password  = $_POST['password'];
    $password_confirmation  = $_POST['password_confirmation'];

    if(empty($firstname)){
        // die("First name is required");
        $_SESSION['error_reg'] = "First name is required";        
    }
    
    if(empty($lastname)){
        // die("Last name is required");
        $_SESSION['error_reg'] = "Last name is required";        
    }
    
    if(empty($mobile)){
        // die("Mobile number is required");
        $_SESSION['error_reg'] = "Mobile number is required";        
    }
    
    if(! filter_var($email, FILTER_VALIDATE_EMAIL)){
        // die("Valid email is required");
        $_SESSION['error_reg'] = "Valid email is required";        
    }
    
    if (strlen($password) < 8) {
        // die("Password must be at least 8 characters");
        $_SESSION['error_reg'] = "Password must be at least 8 characters";        
    }
    
    if(!preg_match("/[a-z]/i", $password)){
        // die("Password must contain at least one letter");
        $_SESSION['error_reg'] = "Password must contain at least one letter";        
    }
    
    if($password !== $password_confirmation){
        // die("Passwords must match");
        $_SESSION['error_reg'] = "Passwords must match";
    }
        
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    $mobile_extph = 639;
    $mobile = $mobile_extph . $_POST['mobile'];

    function random_strings($length_of_string)
    {
        // String of all alphanumeric character
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';    
        // Shuffle the $str_result and returns substring
        // of specified length
        return substr(str_shuffle($str_result),
                            0, $length_of_string);
    }    
    $code_generated = random_strings(7);

    $log_time = time();
    $token = $_POST['csrf'];
    $createdate= date('Y-m-d H:i:s');   
    
    function sendEmail($email, $otp){
        require "database.php";
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
            $mail->Subject='Email Verification';
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
                    <td style='width:100vh;margin:2% 0;'><div style='margin-top:25px;text-align:left;width:100vh;'>Hi $user_firstname,<br/><br/>We are delighted that you signed up for Abuloy PH.<br/>To start building a fund for your love ones, please use the OTP code to complete the verification. <br/>This code will be valid for only 5 minutes.</div></td>
                </tr>
                <tr><td><div style='margin-top:25px;'>Your Code:<div></td></tr>
                <tr><td><div style='height:35px;width:100px;padding:2px;font-size:20px;margin:0 50px 50px 0;heigh:60px;text-align:center;background-color:#94F7CF;color:#A265E6;border-radius:3px;'><span style='vertical-align:middle;'>$otp</span></div></td></tr>
                <tr><td style='padding: 15px 0 20px;'>$clientIPAddress</td></tr>
            </table>";
            $mail->send();
            }catch(Exception $e){
                {echo $e;}
            }
        }else{
            echo 'Not working query';
        }
            
        
    }

    $check_email = $mysqli->query("SELECT * FROM abuloy_users WHERE email = '$email'")->num_rows;   
    // $result_check = $mysqli->query($check_email);    
    // $email_check = $result_check->fetch_assoc();
    // $email_cnt = mysqli_num_rows($email_check);
    if($check_email > 0) {
        $_SESSION['error_login'] = "Email already used";
    }
    else{
        $insert_qry = $mysqli->prepare("INSERT INTO abuloy_users (firstname, lastname, mobile, email, password_hash, code_activation, log_time, token, date_created) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $insert_qry->bind_param("sssssssss",
                    $firstname,
                    $lastname,
                    $mobile,
                    $email,
                    $password_hash,
                    $code_generated,
                    $token,
                    $log_time,
                    $createdate);
        $insert_qry->execute();
        $insert_qry->store_result();
        $count = $insert_qry->affected_rows;

        if($count > 0){
            // after inserting get the email from database through select
            $stmt = $mysqli->prepare("SELECT * FROM abuloy_users WHERE email = ?");
            $stmt->bind_param('d', $email);
            $result = $stmt->execute();
            $result = $stmt->get_result();
            $verify_user = $result->fetch_assoc();
            $verify_user_email = $verify_user['email'];
            

            if(isset($verify_user)){
                $signup = 1;
                $otp_form = 1;
                $otp = rand(111111, 999999);
                // $mysqli->query("UPDATE abuloy_users SET otp = $otp, log_status = 2 WHERE email = '$email';");
                $userEmail =  $mysqli->real_escape_string($email);
                $updateqry = "UPDATE abuloy_users SET log_status = 2, otp = ? WHERE email = ?";
                $stmt_update = $mysqli->prepare($updateqry);
                $stmt_update->bind_param('ss', $otp, $userEmail);
                $stmt_update->execute();
                $result_update = $stmt_update->affected_rows;
                if($result_update){
                    if($signup == 1 && $otp_form == 1){
                        sendEmail($email, $otp);
                        $signup_style = "style='display:none;visibility:hidden'";
                        $otp_style = "style='display:block;'";
                        // function sendEmail logic
    
                    }
                    else{
                        $signup_style = "style='display:block;'";
                        $otp_style = "style='display:none;visibility:hidden'";
                        sendEmail($email, $otp);
                    }
                    // header("Location: /login-verification");
                    // exit;
                }
            }
        }
        
    }

    
    
}


?>
<!DOCTYPE html>
<html lang="en">
<?php
include 'head.php';
?>
<!-- register css -->
<!-- <link rel="stylesheet" href="./assets/dist/css/pages/register.css"> -->
</head>
<body>

    <section id="register" class="pt-5">    
        <div class="d-flex justify-content-center px-3 py-0">
            <div class="col-lg-12 container pb-5">
                <div class="card card-outline card-success">
                    <div class="card-body">
                        
                        <form action="" method="post" id="signup" <?php out($signup_style); ?> >
                            <legend class="text-lavander text-center fw-bold pt-5">Create an Account</legend>
                            <div class="form-row col-md-12 lavander-form mx-auto">
                                <?php if(isset($_SESSION['error_reg'])){ ?> 
                                    <div class="alert alert-danger alert-dismissible fade show text-justify" role="alert">
                                        <?= $_SESSION['error_reg'] ?>
                                        <a type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></a>
                                    </div>
                                <?php unset($_SESSION['error_reg']);} ?>
                                <div class="col-md-6 mx-auto">
                                    <?php set_csrf(); ?>
                                    <div class="form-group  my-3">
                                        <input type="text" id="firstname" name="firstname" class="form-control" required placeholder="First Name*">
                                    </div>
                                </div>
                                <div class="col-md-6 mx-auto">
                                    <div class="form-group  my-3">
                                        <input type="text" id="lastname" name="lastname" class="form-control" required placeholder="Last Name*">
                                    </div>
                                </div>
                                <div class="col-md-6 mx-auto">
                                    <div class="input-group phone-input-group px-0 mx-0  my-3">
                                        <span class="input-group-text phone-input-group-text">+639 &nbsp;</span>
                                        <input type="text" id="mobile" name="mobile" class="form-control" maxlength="9" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required placeholder="Mobile Number*">
                                    </div>
                                </div>
                                <div class="col-md-6 mx-auto">
                                    <div class="form-group  my-3">
                                        <input type="email" id="email" name="email" class="form-control" required placeholder="Email Address*">
                                    </div>
                                </div>
                                <div class="col-md-6 mx-auto">
                                    <div class="form-group  my-3">
                                        <input type="password" id="password" name="password" class="form-control" required placeholder="Password*">
                                    </div>
                                </div>
                                <div class="col-md-6 mx-auto">
                                    <div class="form-group  my-3">
                                        <input type="password" id="password_confirmation" name="password_confirmation" required class="form-control" placeholder="Confirm Password*">
                                    </div>
                                </div>
                                <div class="col-lg-12 text-right justify-content-center d-flex mb-5">
                                    <button type="submit" name="register" class="btn btn-primary me-2">Continue</button>
                                    <button class="btn btn-secondary" type="button" onclick="location.href = '/'">Cancel</button>
                                </div>
                            </div>
                            <small class="text-blackish align-center">I already have an account? &nbsp;<a href="/login" class="no-style text-lavander">Sign-In</a></small>
                        </form>
                        
                        <form action="/user-verification" method="POST" class="otp-form" <?php out($otp_style); ?> >
                            <?php if(isset($_SESSION['error_log_verify'])){ ?> 
                                <div class="alert alert-danger alert-dismissible fade show text-justify" role="alert">
                                    <?= $_SESSION['error_log_verify'] ?>
                                    <a type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></a>
                                </div>
                            <?php unset($_SESSION['error_log_verify']);} ?>
                            <input type="hidden" id="email" name="email" class="form-control my-3" value="<?= $email ?>">
                            <div class="col-lg-6 col-md-8 col-sm-10 mx-auto mt-5">
                                <input type="text" id="otp" name="otp" class="form-control form-control-lg text-center" placeholder="Enter OTP">
                            </div>
                            <span class="otp-error"></span>
                            <button class="btn btn-lavander btn-round py-2 px-3 my-3 mb-5 otp-submit btn-sm">Validate and login</button>
                        </form>
                    </div>
                </div>
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