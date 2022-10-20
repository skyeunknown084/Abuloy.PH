<?php
error_reporting(0);

if($_SERVER['REQUEST_METHOD'] === "POST"){
    require "database.php";

    $postToken = $mysqli->real_escape_string($_POST['csrf']);
    $email = $mysqli->real_escape_string($_POST['email']);
    $time_forgot = time();

    $stmt_update = $mysqli->prepare("UPDATE abuloy_users SET email_status = 0, log_status = 2, user_type = 2, log_time = '$time_forgot', token = '$postToken' WHERE email = '$email'");
    $stmt_update->execute();
    $forgot_result = $stmt_update->affected_rows;
    if($forgot_result > 0){
        $sql = "SELECT * FROM abuloy_users WHERE email = '$email'";
        $result = $mysqli->prepare($sql);
        $result->execute();
        $get_result = $result->get_result();
        $user_forgot = $get_result->fetch_assoc();

        $token = $user_forgot['token'];
        $uid = $user_forgot['id'];

        if($user_forgot) {
            
            // delete user_logins
            $stmt_delete_log = $mysqli->prepare("DELETE FROM abuloy_user_logins WHERE uid = $uid");
            $stmt_delete_log->execute();
                
            header("Location: /request-password-success/$token");
            exit;

        }
    }
    
    // else{ 
    //     $_SESSION['error_forgot'] = "Failed to get user data";
    // }
}
    
?>
<!DOCTYPE html>
<html lang="en">
<?php 
include 'head.php';
?>
<link rel="stylesheet" href="https://abuloy.ph/assets/dist/css/pages/forgot-password.css">
</head>
<body>
    <?php include 'header.php'; ?>

    <!-- login area -->
    <section id="login" class="my-5 pt-5 ">
        <div class="container mx-auto  login-form-height" >
            <div class="col-lg-12 col-md-12 col-sm-12 text-center pt-5">
                <legend class="text-lavander text-center fw-bolde">Forgot Your Password?</legend>
                <div class="alert alert-info mx-auto col-lg-5 col-md-9 col-sm-12 p-1">
                <small class="text-justify">Don't worry, just enter and submit us the e-mail address you use to sign-in and we will send you instructions to reset your password. If you did not receive any e-mail be sure to check on spam.</small>
                </div>
                
                <div class="d-flex justify-content-center align-items-center mb-5">                
                    <form action="" method="post" id="forgot-form" class="mt-5">
                        <?php if(isset($_SESSION['error_forgot'])){ ?> 
                            <div class="alert alert-danger alert-dismissible fade show text-justify" role="alert">
                                <?= $_SESSION['error_forgot'] ?>
                                <a type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></a>
                            </div>
                        <?php unset($_SESSION['error_forgot']);} ?>
                        <div class="form-row lavander-form mt-4">
                            <div class="col"><?php set_csrf(); ?></div>
                            <div class="col">
                                <input type="email" name="email" id="email" class="form-control my-3 text-center forgot-email" placeholder="Enter email address" required>
                            </div>
                        </div>
                        <div class="submit-btn text-center mb-1">
                            <button type="submit" id="forgot-submit" class="btn btn-lavander btn-sm text-white text-uppercase fs-large py-1 rounded-pill text-dark px-4 mb-4">Submit</button>
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
    <?php include 'plugins.php'; ?>
    <!-- Custom Script -->
    <!-- <script>
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

        
    </script> -->
</body>
</html>