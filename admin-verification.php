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
    $email = $_SESSION['EMAIL'];
    if($email === ''){
        print_r("Email not found");
        exit;
    }else{
        $stmt = $mysqli->prepare("SELECT * FROM abuloy_users WHERE email = '$email' AND user_type = 3;");
        $stmt_result = $stmt->execute();
        $result = $stmt->get_result();
        $result_data = $result->fetch_all(MYSQLI_ASSOC);
        if($result_data){
            if($email == ''){
                session_start();
                session_unset();
                session_destroy();
                print_r("The email your trying to validate does not registered successfully");
            }else{
                $otp = rand(111111, 999999);
                // $mysqli->query("UPDATE abuloy_users SET otp = $otp, log_status = 2 WHERE email = '$email';");
                $adminEmail =  $mysqli->real_escape_string($email);
                $updateqry = "UPDATE abuloy_users SET log_status = 2, otp = ? WHERE email = ?";
                $stmt_update = $mysqli->prepare($updateqry);
                $stmt_update->bind_param('ss', $otp, $adminEmail);
                $stmt_update->execute();
                $result_update = $stmt_update->affected_rows;
                if($result_update){
                    sendEmail($email, $otp);
                    json_encode(['status' => 'success']);
                    exit;
                }
                
            }
        }
        else{
            json_encode(['status' => 'failure']);
            print_r("We did not get your email address. Please register first.");
            exit;
        }
    }
    

    
    // function sendEmail logic
    function sendEmail($email, $otp){
        require 'global_call.php';
        require 'database.php';
        $admin_stmt = $mysqli->query("SELECT firstname FROM abuloy_users WHERE email = '$email';");
        if($admin_row = $admin_stmt->fetch_assoc()){
            $admin_firstname = $admin_row['firstname'];
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
                    <td style='width:100vh;margin:2% 0;'><div style='margin-top:25px;text-align:left;width:100vh;'>Hi $admin_firstname,<br/><br/>We are delighted that you signed up for Abuloy PH.<br/>To start building a fund for your love ones, please use the OTP code to complete the verification. <br/>This code will be valid for only 5 minutes.</div></td>
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

?>
<!-- register css -->
<!-- <link rel="stylesheet" href="./assets/dist/css/pages/register.css"> -->
</head>
<body>
    <?php include 'header.php'; ?>
    <section class="my-5 pt-4" style="margin-top:70px">
        <div class="container otp-container my-5">
            
            <div class="col-lg-6 col-md-6 col-sm-12 text-center mx-auto">
                <legend class="text-lavander text-center fw-bolde">Login Verification</legend>
                <p>We have send a One-Time-Password (OTP) to your email. "<?php echo $email ?>" <br/> Please check your inbox or spam for code</p>
                <!-- <form action="" method=""></form> -->
                <form action="/user-verification" method="POST" class="otp-form">
                    <input type="hidden" id="email" name="email" class="form-control my-3" value="<?= $email ?>">
                    <div class="col-lg-6 col-md-8 col-sm-10 mx-auto mt-5">
                        <input type="text" id="otp" name="otp" class="form-control form-control-lg text-center" placeholder="Enter OTP">
                    </div>
                    <span class="otp-error"></span>
                    <button class="btn btn-lavander btn-round py-2 px-3 my-3 mb-5 otp-submit btn-sm">Validate and login</button>
                </form>
            </div>
        </div>
    </section>
    
    

    <!-- start Footer Area -->
    <?php include 'footer.php' ?>     
    <!-- end Footer Area -->

    <!-- Plugins -->
    <?php include_once 'plugins.php'; ?>
    <!-- Custom Script -->
    <!-- <script src="controllers/register.js"></script> -->

    <script>
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
                        window.location.replace("/")
                        window.location.href="/"
                    }
                    else{
                        error(otpError, "Incorrect OTP provided")
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