<?php

// require 'vendor/autoload.php';
error_reporting(0);

if($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['register_individual'])){
    require "database.php";
    
    $token = $_POST["csrf"];
    $funeral_provider  = $_POST['funeral_provider'];
    $firstname  = $_POST['firstname'];
    $lastname  = $_POST['lastname'];
    $mobile  = $_POST['mobile'];
    $email  = $_POST['email'];
    $password  = $_POST['password'];
    $password_confirmation  = $_POST['password_confirmation'];

    if(empty($funeral_provider)){
        // die("First name is required");
        $_SESSION['error_reg'] = "Funeral service provider is required";        
    }

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
    elseif(!preg_match("/[a-z]/i", $password)){
        // die("Password must contain at least one letter");
        $_SESSION['error_reg'] = "Password must contain at least one letter";        
    }    
    elseif($password !== $password_confirmation){
        // die("Passwords must match");
        $_SESSION['error_reg'] = "Passwords does not match";
    }
    else{
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
    }
        
    $user_type = 2;
    $reg_type = 1;
    // String of all alphanumeric character
    $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';    
    // Shuffle the $str_result and returns substring
    // of specified length
    $code_activation = substr(str_shuffle($str_result), 0, 7);

    $otp = rand(111111, 999999);
    $log_time = time();
    // $token = $csrf;
    $date_created = date('Y-m-d H:i:s');
        
    $mobile_extph = 63;
    $phone_number = $mobile_extph . $mobile;  

    // Registration Status
    $log_status = 2; //for login-verification

    $check_email = $mysqli->query("SELECT * FROM abuloy_users WHERE email = '$email'")->num_rows;   
    // $result_check = $mysqli->query($check_email);    
    // $email_check = $result_check->fetch_assoc();
    // $email_cnt = mysqli_num_rows($email_check);
    if($check_email > 0) {
        $_SESSION['error_reg'] = "Email already used";
    }
    else{

        $insert_qry = $mysqli->prepare("INSERT INTO abuloy_users (funeral_provider, firstname, lastname, mobile, email, password_hash, code_activation, otp, log_status, log_time, token, date_created) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $insert_qry->bind_param("ssssssssssss",
                    $funeral_provider,
                    $firstname,
                    $lastname,
                    $phone_number,
                    $email,
                    $password_hash,
                    $code_activation,
                    $otp,
                    $log_status,
                    $log_time,
                    $token,
                    $date_created);
        $insert_qry->execute();
        $insert_qry->store_result();
        $count = $insert_qry->affected_rows;

        if($count > 0){
            
            // $stmt = $mysqli->prepare("SELECT * FROM abuloy_users WHERE email = ?");
            // $stmt->bind_param('s', $email);
            // $result = $stmt->execute();
            // $result = $stmt->get_result();
            // $verify_user = $result->fetch_assoc();
            // $verify_user_email = $verify_user['email'];            
            
            $sql = sprintf("SELECT * FROM abuloy_users WHERE email = '$email'");
    
            $result = $mysqli->query($sql);

            $user = $result->fetch_assoc();
            if($user){
                // after inserting get the email from database through select and send it!
                // sendEmailVerification($token, $otp, $email, $firstname);
                // re-direct to login-verification
                header("Location: register-email-verification/$token");
                exit;

            }
        }
        
    }   
    
}

if($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['register_funeralhome'])){
    require "database.php";

    $token = $_POST["csrf"];
    $funeral_provider  = $_POST['funeral_provider'];
    $mobile  = $_POST['mobile'];
    $email  = $_POST['email'];
    $street_address  = $_POST['street_address'];
    $city_town  = $_POST['city_town'];
    $state_province  = $_POST['state_province'];
    $firstname  = $_POST['firstname'];
    $lastname  = $_POST['lastname'];
    $password  = $_POST['password'];
    $password_confirmation  = $_POST['password_confirmation'];

    if(empty($funeral_provider)){
        // die("First name is required");
        $_SESSION['error_reg_fn'] = "Funeral service provider is required";        
    }

    if(empty($mobile)){
        // die("Mobile number is required");
        $_SESSION['error_reg_fn'] = "Mobile number is required";        
    }
    
    if(! filter_var($email, FILTER_VALIDATE_EMAIL)){
        // die("Valid email is required");
        $_SESSION['error_reg_fn'] = "Valid email is required";        
    }

    if(empty($street_address)){
        // die("First name is required");
        $_SESSION['error_reg_fn'] = "Street address is required";        
    }

    if(empty($city_town)){
        // die("First name is required");
        $_SESSION['error_reg_fn'] = "City or town is required";        
    }

    if(empty($state_province)){
        // die("First name is required");
        $_SESSION['error_reg_fn'] = "State or province is required";        
    }

    if(empty($firstname)){
        // die("First name is required");
        $_SESSION['error_reg_fn'] = "First name is required";        
    }
    
    if(empty($lastname)){
        // die("Last name is required");
        $_SESSION['error_reg_fn'] = "Last name is required";        
    }
    
    
    if (strlen($password) < 8) {
        // die("Password must be at least 8 characters");
        $_SESSION['error_reg_fn'] = "Password must be at least 8 characters";        
    }
    elseif(!preg_match("/[a-z]/i", $password)){
        // die("Password must contain at least one letter");
        $_SESSION['error_reg_fn'] = "Password must contain at least one letter";        
    }    
    elseif($password !== $password_confirmation){
        // die("Passwords must match");
        $_SESSION['error_reg_fn'] = "Passwords does not match";
    }
    else{
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
    }
        
    $user_type = 1;
    $reg_type = 2;
    // String of all alphanumeric character
    $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';    
    // Shuffle the $str_result and returns substring
    // of specified length
    $code_activation = substr(str_shuffle($str_result), 0, 7);

    $otp = rand(111111, 999999);
    $log_time = time();
    // $token = $csrf;
    $date_created = date('Y-m-d H:i:s');
        
    $mobile_extph = 63;
    $phone_number = $mobile_extph . $mobile;  

    // Registration Status
    $log_status = 2; //for login-verification

    $check_email = $mysqli->query("SELECT * FROM abuloy_users WHERE email = '$email'")->num_rows;   
    // $result_check = $mysqli->query($check_email);    
    // $email_check = $result_check->fetch_assoc();
    // $email_cnt = mysqli_num_rows($email_check);
    if($check_email > 0) {
        $_SESSION['error_reg_fn'] = "Email already used";
    }
    else{

        $insert_qry = $mysqli->prepare("INSERT INTO abuloy_users (reg_type, funeral_provider, firstname, lastname, mobile, email, password_hash, street_address, city_town, state_province, code_activation, otp, log_status, log_time, token, date_created) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $insert_qry->bind_param("ssssssssssssssss",
                    $reg_type,
                    $funeral_provider,
                    $firstname,
                    $lastname,
                    $phone_number,
                    $email,
                    $password_hash,
                    $street_address,
                    $city_town,
                    $state_province,
                    $code_activation,
                    $otp,
                    $log_status,
                    $log_time,
                    $token,
                    $date_created);
        $insert_qry->execute();
        $insert_qry->store_result();
        $count = $insert_qry->affected_rows;

        if($count > 0){
            
            // $stmt = $mysqli->prepare("SELECT * FROM abuloy_users WHERE email = ?");
            // $stmt->bind_param('s', $email);
            // $result = $stmt->execute();
            // $result = $stmt->get_result();
            // $verify_user = $result->fetch_assoc();
            // $verify_user_email = $verify_user['email'];            
            
            $sql = sprintf("SELECT * FROM abuloy_users WHERE email = '$email'");
    
            $result = $mysqli->query($sql);

            $user = $result->fetch_assoc();
            if($user){
                // after inserting get the email from database through select and send it!
                // sendEmailVerification($token, $otp, $email, $firstname);
                // re-direct to login-verification
                header("Location: register-email-verification/$token");
                exit;

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

    <?php include 'header.php'; ?>

    <section id="register" class="my-5 pt-5">    
        <div class="d-flex justify-content-center px-3">
            <div class="col-lg-12 container">                   
                <legend class="text-lavander text-center fw-bold">Create an Account</legend>
                <div class="row col-12 mx-auto align-center mt-5">
                    <div class="col-lg-6 col-md-10 col-sm-12 btn-group mb-5 me-2" role="group" style="height:38px">
                        <input type="radio" class="btn-check bg-lavander" name="btnradio" name="individual" id="individual" autocomplete="off" checked>
                        <label class="btn btn-outline-primary" for="individual">As Individual</label>
                        <input type="radio" class="btn-check" name="btnradio" name="funeralhome" id="funeralhome" autocomplete="off">
                        <label class="btn btn-outline-primary" for="funeralhome">As Funeral Home</label>
                    </div>
                </div> 
                <div class="row px-lg-5 " id="individual_form">
                    <div class="bg-white shadow align-m px-2 py-4">
                        <form action="" method="post" id="create_new_account" autocomplete="off" class="needs-validation">

                            <?php if(isset($_SESSION['error_reg'])){ ?> 
                                <div class="alert alert-danger alert-dismissible fade show text-justify" role="alert">
                                    <?= $_SESSION['error_reg'] ?>
                                    <a type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></a>
                                </div>
                            <?php unset($_SESSION['error_reg']);} ?>
                            <div class="form-row col-md-12 lavander-form mx-auto"> 
                                
                                <div class="col-md-6 mx-auto">                                    
                                    <div class="form-group  my-3 py-1">
                                        <?php set_csrf(); ?> 
                                        <small class="align-left text-lavander"><i>Funeral Service Provider*</i></small>
                                        <input type="text" id="funeral_provider" name="funeral_provider" class="form-control" required placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-6 mx-auto">                                    
                                    <div class="form-group  my-3 py-1">
                                        <small class="align-left text-lavander"><i>First Name*</i></small>
                                        <input type="text" id="firstname" name="firstname" class="form-control" required placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-6 mx-auto">
                                    <div class="form-group  my-3 py-1">
                                        <small class="align-left text-lavander"><i>Last Name*</i></small>
                                        <input type="text" id="lastname" name="lastname" class="form-control" required placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-6 mx-auto">
                                    <small class="align-left text-lavander"><i>Mobile Number*</i></small>
                                    <div class="input-group phone-input-group px-0 mx-0  my-3 py-1">                                    
                                        <span class="input-group-text phone-input-group-text">+63 &nbsp;</span>
                                        <input type="text" id="mobile" name="mobile" class="form-control" maxlength="10" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-6 mx-auto">
                                    <div class="form-group  my-3 py-1">
                                        <small class="align-left text-lavander"><i>Email Address*</i></small>
                                        <input type="email" id="email" name="email" class="form-control" required placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-6 mx-auto">
                                    <div class="form-group  my-3">
                                        <small class="align-left text-lavander"><i>Password*</i></small>
                                        <input type="password" id="password" name="password"  pattern=".{8,}" class="form-control" required placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-6 mx-auto">
                                    <div class="form-group  my-3">
                                        <small class="align-left text-lavander"><i>Confirm Password*</i></small>
                                        <input type="password" id="password_confirmation" name="password_confirmation"  pattern=".{8,}" class="form-control" required placeholder="">
                                        <small class="pass_match text-lavander bg-aquamarine col-12"><i>&nbsp;&nbsp;Note: Password must be at least 8 characters long&nbsp;&nbsp;</i></small>
                                    </div>
                                </div>
                                <div class="col-md-6 mx-auto">
                                    <div class="form-check pt-2 pb-0" id="terms">
                                        <input type="checkbox" class="form-check-input" id="agreement" required>
                                        <label class="form-check-label pt-1 ps-2 align-left" for="agreement">I agree to &nbsp;<a href="/terms-and-conditions" class="no-style">Terms & Conditions</a></label>
                                    </div>
                                </div>
                                <hr class="text-lavander"/>
                                <div class="col-md-6 mx-auto">
                                    <div class="col-lg-12 text-right justify-content-center d-flex">
                                        <button type="submit" name="register_individual" class="btn btn-primary me-2">Register</button>
                                        <a href="/" class="btn btn-secondary" type="button">Cancel</a>
                                    </div>                                   
                                </div>    
                            </div>
                        </form>
                        <small class="text-blackish align-center mt-3">I already have an account? &nbsp;<a href="/login" class="no-style text-lavander">Sign-In</a></small>
                    </div>
                </div>
                <div class="row px-lg-5 hide" id="funeralhome_form">
                    <div class="bg-white shadow align-m px-2 py-4">
                        <form action="" method="post" id="create_new_account_fh" autocomplete="off" class="needs-validation">
                            <?php if(isset($_SESSION['error_reg_fn'])){ ?> 
                                <div class="alert alert-danger alert-dismissible fade show text-justify" role="alert">
                                    <?= $_SESSION['error_reg_fn'] ?>
                                    <a type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></a>
                                </div>
                            <?php unset($_SESSION['error_reg_fn']);} ?>
                            <div class="form-row col-md-12 lavander-form mx-auto">                                 
                                <div class="col-md-6 mx-auto">                                    
                                    <div class="form-group  my-3 py-1">
                                        <?php set_csrf(); ?> 
                                        <small class="align-left text-lavander"><i>Business Legal Name*</i></small>
                                        <input type="text" id="funeral_provider" name="funeral_provider" class="form-control" required placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-6 mx-auto">
                                    <small class="align-left text-lavander"><i>Business Phone Number*</i></small>
                                    <div class="input-group phone-input-group px-0 mx-0  my-3 py-1">                                    
                                        <span class="input-group-text phone-input-group-text">+63 &nbsp;</span>
                                        <input type="text" id="mobile" name="mobile" class="form-control" maxlength="10" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-6 mx-auto">
                                    <div class="form-group  my-3 py-1">
                                        <small class="align-left text-lavander"><i>Business Email Address*</i></small>
                                        <input type="email" id="email" name="email" class="form-control" required placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-6 mx-auto">                                    
                                    <div class="form-group  my-3 py-1">
                                        <small class="align-left text-lavander"><i>Business Street Address*</i></small>
                                        <input type="text" id="funeral_provider" name="street_address" class="form-control" required placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-6 mx-auto">                                    
                                    <div class="form-group  my-3 py-1">
                                        <small class="align-left text-lavander"><i>City*</i></small>
                                        <input type="text" id="funeral_provider" name="city_town" class="form-control" required placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-6 mx-auto">                                    
                                    <div class="form-group  my-3 py-1">
                                        <small class="align-left text-lavander"><i>State / Province*</i></small>
                                        <input type="text" id="funeral_provider" name="state_province" class="form-control" required placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-6 mx-auto">                                    
                                    <div class="form-group  my-3 py-1">
                                        <small class="align-left text-lavander"><i>Representative First Name*</i></small>
                                        <input type="text" id="firstname" name="firstname" class="form-control" required placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-6 mx-auto">
                                    <div class="form-group  my-3 py-1">
                                        <small class="align-left text-lavander"><i>Representative Last Name*</i></small>
                                        <input type="text" id="lastname" name="lastname" class="form-control" required placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-6 mx-auto">
                                    <div class="form-group  my-3">
                                        <small class="align-left text-lavander"><i>Password*</i></small>
                                        <input type="password" id="password" name="password"  pattern=".{8,}" class="form-control" required placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-6 mx-auto">
                                    <div class="form-group  my-3">
                                        <small class="align-left text-lavander"><i>Confirm Password*</i></small>
                                        <input type="password" id="password_confirmation" name="password_confirmation"  pattern=".{8,}" class="form-control" required placeholder="">
                                        <small class="pass_match text-lavander bg-aquamarine col-12"><i>&nbsp;&nbsp;Note: Password must be at least 8 characters long&nbsp;&nbsp;</i></small>
                                    </div>
                                </div>
                                <div class="col-md-6 mx-auto">
                                    <div class="form-check pt-2 pb-0" id="terms">
                                        <input type="checkbox" class="form-check-input" id="agreement" required>
                                        <label class="form-check-label pt-1 ps-2 align-left" for="agreement">I agree to &nbsp;<a href="/terms-and-conditions" class="no-style">Terms & Conditions</a></label>
                                    </div>
                                </div>
                                <hr class="text-lavander"/>
                                <div class="col-md-6 mx-auto">
                                    <div class="col-lg-12 text-right justify-content-center d-flex">
                                        <button type="submit" name="register_funeralhome" class="btn btn-primary me-2">Register</button>
                                        <a href="/" class="btn btn-secondary" type="button">Cancel</a>
                                    </div> 
                                </div>
                            </div>
                        </form>
                        <small class="text-blackish align-center mt-3">I already have an account? &nbsp;<a href="/login" class="no-style text-lavander">Sign-In</a></small>
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
    <script src="controllers/register.js"></script>
</body>
</html>