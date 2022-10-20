<!DOCTYPE html>
<html lang="en">
<?php
// include_once './phpmailer.php';
// include_once './config/db_connect.php';
include_once './head_views.php';
?>
<!-- contact css -->
<link rel="stylesheet" href="./assets/dist/css/pages/contact.css">
</head>
<body>
    <?php include_once './header.php'; ?>
       
    <section class="pt-5 mt-4" id="">
        <div class="overlay overlay-bg bg-aquamarine"></div>
        <div class="container-fluid py-4 my-5">
            <div class="card col-lg-6 col-md-8 col-sm-12 mx-auto mb-5">
                <div class="card-body align-items-center justify-content-center bg-aquamarine">
                    <div class="p-2 my-2 ">
                        <div class="form-msg">
                            <?php if (!empty($msg)) {
                            echo "<p>$msg</p>";
                            echo `<div class="col-md-12 align-center ">
                                    <button class="btn btn-lavander py-5" id="getInTouch">Get in touch again</button>                             
                                    </div>`;
                        }?>
                        </div>
                        <form method="" class="" id="Get-In-Touch">
                            <legend class="card-title text-lavander text-center fw-bold">Get in touch</legend>
                            <!-- <input type="hidden" name="_next" value="https://abuloy.ph/thankyou.php"> -->
                            <div class="form-row justify-content-center align-items-center col-md-18 mt-0" >
                                <div class="col-lg-12">
                                    <label for="validationDefault02" class="form-label hide"><span class="text-lavander">*</span>Name</label>
                                    <input type="text" value="" name="name" id="name" class="text-center form-control my-3 text-lavander" id="validationDefault02" placeholder="Name">
                                </div>
                                <div class="col-lg-12">
                                    <label for="validationDefault02" class="form-label hide"><span class="text-lavander">*</span>Email Address</label>
                                    <input type="email" value="" name="email" id="email" class="text-center form-control my-3 text-lavander" id="validationDefault02" placeholder="Email Address">
                                </div>
                                <div class="col-lg-12">
                                    <label for="validationDefault03" class="form-label hide"><span class="text-lavander">*</span>Type Message here...</label>
                                    <textarea style="height:30vh" type="text" value="" name="message" id="message" class="text-center form-control my-3 text-lavander" id="validationDefault03" placeholder="Write Message here" required></textarea>
                                </div>
                                <div class="col-md-12 align-center ">
                                    <button class="btn btn-lavander text-uppercase align-items-center justify-content-center" style="padding:4px; margin:0px;">SEND <i class="fas fa-paper-plane"></i></button>                             
                                </div>
                            </div>
                        </form>                      
                    </div>
                </div>
            </div>
        </div>
    </section>
    

<?php include_once './footer.php'; ?>
<?php include_once './plugin_views.php'; ?>
<script>
    $(document).ready(function(){
        $('#getInTouch').on('click', function(){
            $('#Get-In-Touch-Form').addClass('hide');
        })
    });
</script>
</body>
</html>

