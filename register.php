<!DOCTYPE html>
<html lang="en">
<?php
include_once 'global_call.php';
include 'database.php';
include 'head.php';
?>
<!-- register css -->
<!-- <link rel="stylesheet" href="./assets/dist/css/pages/register.css"> -->
</head>
<body>
    <?php include 'header.php'; ?>

    <section id="register" class="pt-5">    
        <legend class="text-lavander text-center fw-bold pt-5">Create an Account</legend>
        <div class="d-flex justify-content-center px-3 py-0">
            <div class="col-lg-12 container pb-5">
                <div class="card card-outline card-success">
                    <div class="card-body">
                        
                        <form action="/register-fnc" method="post" id="signup" novalidate>
                            <div class="form-row col-md-12 lavander-form mx-auto">
                                <div class="col-md-6 mx-auto">
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
                                        <input type="text" id="mobile" name="mobile" class="form-control" maxlength="9" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required placeholder="Mobile Number*">
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
                                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Confirm Password*">
                                    </div>
                                </div>
                                <div class="col-lg-12 text-right justify-content-center d-flex mb-5">
                                    <button type="submit" name="register" class="btn btn-primary me-2">Continue</button>
                                    <button class="btn btn-secondary" type="button" onclick="location.href = '/'">Cancel</button>
                                </div>
                            </div>
                            <small class="text-blackish align-center">I already have an account? &nbsp;<a href="/login" class="no-style text-lavander">Sign-In</a></small>
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