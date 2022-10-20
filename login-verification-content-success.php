<section class="my-5 pt-4" style="margin-top:70px">
    <div class="container otp-container my-5">
        
        <div class="col-lg-6 col-md-6 col-sm-12 text-center mx-auto">
            <legend class="text-lavander text-center fw-bolde">Login Verification</legend>
            <p>We have send a One-Time-Password (OTP) to your email. "<?php out($verify_user_email) ?>" <br/> Please check your inbox or spam for code</p>
            <!-- <form action="" method=""></form> -->
            <form action="" method="POST" class="otp-form">
                <?php if(isset($_SESSION['error_log_verify'])){ ?> 
                    <div class="alert alert-danger alert-dismissible fade show text-justify" role="alert">
                        <?= $_SESSION['error_log_verify'] ?>
                        <a type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></a>
                    </div>
                <?php unset($_SESSION['error_log_verify']);} ?>
                <?php set_csrf(); ?>
                <input type="hidden" id="email" name="email" class="form-control my-3" value="<?php out($verify_user_email) ?>">
                <div class="col-lg-6 col-md-8 col-sm-10 mx-auto mt-5">
                    <input type="text" id="otp" name="otp" class="form-control form-control-lg text-center" placeholder="Enter OTP">
                </div>
                <!-- <span class="otp-error"></span> -->
                <button class="btn btn-lavander btn-round py-2 px-3 my-3 mb-5 otp-submit btn-sm">Validate and login</button>
            </form>
        </div>
    </div>
</section>