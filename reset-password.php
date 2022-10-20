<?php
    error_reporting(0);

    require 'database.php';
    
    $sql = "SELECT * FROM abuloy_users WHERE token = '$token'";
    $result = $mysqli->prepare($sql);
    $result->execute();
    $get_result = $result->get_result();
    $user = $get_result->fetch_assoc();

    $e_mail = $mysqli->real_escape_string($user['email']);

    if($_SERVER['REQUEST_METHOD'] === "POST"){
        $userToken = $mysqli->real_escape_string($_POST['csrf']);
        $userEmail = $mysqli->real_escape_string($_POST['email']);
        $userNewPassword = $mysqli->real_escape_string($_POST['password']);
        $userNewPasswordConfirm = $mysqli->real_escape_string($_POST['password_confirmation']);
        $time_reset = time();

        if (strlen($userNewPassword) < 8) {
            // die("Password must be at least 8 characters");
            $_SESSION['error_reset'] = "Password must be at least 8 characters";        
        }
        elseif(!preg_match("/[a-z]/i", $userNewPassword)){
            // die("Password must contain at least one letter");
            $_SESSION['error_reset'] = "Password must contain at least one letter";        
        }    
        elseif($userNewPassword !== $userNewPasswordConfirm){
            // die("Passwords must match");
            $_SESSION['error_reset'] = "Passwords does not match";
        }
        else{
            $password_hash = password_hash($userNewPassword, PASSWORD_DEFAULT);
        }


        $updateqry = "UPDATE abuloy_users SET email_status = 1, user_type = 1, log_status = 0, password_hash = ?, log_time = ?, token = ? WHERE email = ?";
        $stmt_update = $mysqli->prepare($updateqry);
        $stmt_update->bind_param('ssss', $password_hash, $userToken, $time_reset, $userEmail);
        $stmt_update->execute();
        $result_update = $stmt_update->affected_rows;

        if($result_update > 0){
            // redirect to login
            header("Location: /login");
            exit;
        }
                   
    }

?>
<!-- register css -->
<!-- <link rel="stylesheet" href="./assets/dist/css/pages/register.css"> -->
<!DOCTYPE html>
<html lang="en">
<?php 
require 'head.php';
?>
</head>
<body>
    <section class="my-5" style="height:61vh">
        <div class="container otp-container my-5 pt-5">
            <div class="col-lg-6 col-md-6 col-sm-12 text-center mx-auto">
                <legend class="text-lavander my-0 py-0">Set New Password</legend>
                <small class="my-0 py-0">Enter your new password below</small>
                <!-- <form action="" method=""></form> -->
                <form action="" method="POST" class="reset-form mx-auto">
                    <div class="mx-auto">
                        <?php if(isset($_SESSION['error_reset'])){ ?> 
                            <div class="alert alert-danger alert-dismissible fade show text-justify" role="alert">
                                <?= $_SESSION['error_reset'] ?>
                                <a type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></a>
                            </div>
                        <?php unset($_SESSION['error_reset']);} ?>
                        <div class="form-row lavander-form mt-1">
                            <div class="col-lg-6 col-md-8 col-sm-10 mx-auto">
                                <?php set_csrf(); ?>
                                <input type="hidden" id="email" name="email" class="form-control text-center my-3" value="<?php out($e_mail); ?>">
                            </div>
                        </div>
                        <div class="form-row lavander-form mt-1">
                            <div class="col-lg-6 col-md-8 col-sm-10 mx-auto">
                                <input type="password" id="password" name="password" class="form-control my-3 text-center" placeholder="New Password">
                            </div>
                        </div>
                        <div class="form-row lavander-form mt-1">
                            <div class="col-lg-6 col-md-8 col-sm-10 mx-auto">
                                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control text-center" placeholder="Confirm New Password">
                            </div>
                        </div>
                    </div>
                    <span class="reset-error"></span>
                    <div class="submit-btn text-center mt-3">
                    <button type="submit" name="reset-password" class="btn btn-primary me-2">Submit</button>
                    </div>
                </form>
                <div class="alert alert-info col-lg-6 col-md-8 col-sm-10 mx-auto text-justify"><small class="">Note: Your new password should be atleast 8 characters long. To make it stronger, use uppercase with lowercase letters and numbers.</small></div>
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

    
</body>
</html>