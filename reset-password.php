<!DOCTYPE html>
<html lang="en">
<?php 
require 'global_call.php';
require 'database.php';
require 'head.php';

    session_start();
    $email = $_SESSION['EMAIL'];
    $stmt = $mysqli->prepare("SELECT * FROM abuloy_users WHERE email = '$email'");
    $stmt_result = $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    // $user = $stmt->fetch_assoc();
    // $stmt_result = $stmt->execute();
    // $result = $stmt->get_result();
    // $user = $result->fetch_all(MYSQLI_ASSOC);
    // $email = $user['email'];


?>
<!-- register css -->
<!-- <link rel="stylesheet" href="./assets/dist/css/pages/register.css"> -->
</head>
<body>
    <section class="my-5" style="height:61vh">
        <div class="container otp-container my-5 pt-5">
            <div class="col-lg-6 col-md-6 col-sm-12 text-center mx-auto">
                <legend class="text-lavander my-0 py-0">Set New Password</legend>
                <small class="my-0 py-0">Enter your new password below</small>
                <!-- <form action="" method=""></form> -->
                <form action="/reset-password-fnc" method="POST" class="reset-form mx-auto" novalidate>
                    <div class="mx-auto">
                        <div class="form-row lavander-form mt-1">
                            <div class="col-lg-6 col-md-8 col-sm-10 mx-auto">
                                <?php   $email = $user['email']; ?>
                                <input type="hidden" id="email" name="email" class="form-control text-center my-3" value="<?= $email ?>">
                            </div>
                        </div>
                        <div class="form-row lavander-form mt-1">
                            <div class="col-lg-6 col-md-8 col-sm-10 mx-auto">
                                <input type="text" id="password" name="password" class="form-control my-3 text-center" placeholder="New Password">
                            </div>
                        </div>
                        <div class="form-row lavander-form mt-1">
                            <div class="col-lg-6 col-md-8 col-sm-10 mx-auto">
                                <input type="text" id="password_confirmation" name="password_confirmation" class="form-control text-center" placeholder="Confirm New Password">
                            </div>
                        </div>
                    </div>
                    <span class="reset-error"></span>
                    <div class="submit-btn text-center mt-3">
                        <button class="btn btn-lavander btn-sm text-white text-uppercase fs-large py-1 rounded-pill text-dark px-4 mb-4">Submit</button>
                    </div>
                </form>
                <div class="alert alert-info col-lg-6 col-md-8 col-sm-10 mx-auto text-justify"><small class="">Note: Your new password should be atleast 8 characters long. To make it stronger, use upper and lower case letters, and numbers.</small></div>
            </div>
        </div>
    </section>
    <!-- login area -->    
    

    <!-- start Footer Area -->
    <?php include 'footer.php' ?>     
    <!-- end Footer Area -->

    <!-- Plugins -->
    <?php include_once 'plugins.php'; ?>
    <!-- Custom Script -->
    <!-- <script src="controllers/register.js"></script> -->

    <script>
        // const submitOtp = document.querySelector('.otp-submit')
        // const otpContainer = document.querySelector('.otp-container')
        // const otpError = document.querySelector('.otp-error')
        // const otpForm = document.querySelector('.otp-form')

        // $(document).ready(function(){
        //     // $(".email-submit").submit();            
        // })

        // $('.otp-submit').submit(function(){
        //     alert("hey")
        //     // e.preventDefault()

        //     // $.ajax({
        //     //     url:'user-verification.php',
        //     //     data: new FormData($(this)[0]),
        //     //     cache: false,
        //     //     contentType: false,
        //     //     processData: false,
        //     //     method: 'POST',
        //     //     type: 'POST',
        //     //     success:function(data){
        //     //         location.href= "index.php";
        //     //         window.location.href="index.php";
        //     //         console.log(data);
        //     //         if(data.status =='success'){
        //     //             window.location.replace("index.php")
        //     //             window.location.href="index.php"
        //     //         }
        //     //         else{
        //     //             error(otpError, "Incorrect OTP provided")
        //     //         }
        //     //     }
        //     // })
            
        // })

        // function error(span, msg){
        //     span.textContent = msg
        //     span.style.color='red'
        //     setTimeout(()=>{span.textContent=""}, 3000)
        // }

        
    </script>
</body>
</html>