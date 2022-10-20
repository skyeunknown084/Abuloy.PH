<!DOCTYPE html>
<html lang="en">
<?php
error_reporting(0);
session_start();
include './head.php';
?>
</head>
<body class="bg-light">
    <?php
        
        require "./database.php";

        $uid = $_SESSION['user_id'];
        $token = $_SESSION['csrf'];
        $utype = $_SESSION['user_type'];
        $fs_provider = $_SESSION['fs_provider'];
        if(isset($uid) && isset($token)){
            
            // Dashboard for User with Accounts
            $stmt = $mysqli->prepare("SELECT * FROM abuloy_users WHERE id = ?");
            $stmt->bind_param('d', $uid);
            $result = $stmt->execute();
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();
                $funeral_provider = $user['funeral_provider'];
            if(isset($user)){
                $log_time = $user['log_time'];
                $halfhr = 1 * 60; //1 mins
                $auto_out_time = $log_time + $halfhr;
                $time = time();
                if($time > $auto_out_time){
                    header("Location: /logout");
                    exit;
                }
                else{
                    include './header-user.php';
                ?>
                <!-- start section Area -->
                <section class="my-5 py-5" id="home faq-user">
                    <div class="container">
                        <div class="row fullscreen align-items-center justify-content-start">
                            <div class="col-lg-12 col-md-12 col-sm-12 m-0">
                                <div class="card">
                                    <div class="card-header bg-lavander text-center py-3" style="height:50px;margin:0;padding:1px;">
                                        <h5 class="text-white">Frequently Asked Questions</h5>
                                    </div>
                                    <div class="card-body pb-5 mb-4">
                                        <div class="accordion accordion-flush" id="accordionFlushExample">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="faq-head-1">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-collapse-1" aria-expanded="false" aria-controls="faq-collapse-1">
                                                        What is Abuloy PH?
                                                    </button>
                                                </h2>
                                                <div id="faq-collapse-1" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                                    <div class="accordion-body">Abuloy.PH - is a crowdfunding website created for the purpose of helping the deceased who can't afford the money for the funeral or the final expenses of their loved ones.</div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="faq-head-2">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-collapse-2" aria-expanded="false" aria-controls="flush-collapseOne">
                                                        How we donate at Abuloy.PH?
                                                    </button>
                                                </h2>
                                                <div id="faq-collapse-2" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                                    <div class="accordion-body">To our dear users, we created a short clip video instruction for you to know the process very easily and efficiently. Below are the video instructions to how you can donate in <a href="/" class="text-lavander">Abuloy.PH</a></div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="faq-head-3">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-collapse-3" aria-expanded="false" aria-controls="faq-collapse-3">
                                                        How to create a fund in Abuloy PH?
                                                    </button>
                                                </h2>
                                                <div id="faq-collapse-3" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                                    <div class="accordion-body">To our dear users, we created a short clip video instruction to how you’ll create a fund in Abuloy.PH. Below are the video instructions on how to create a fund.<code>Click Here.</code></div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="faq-head-4">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-collapse-4" aria-expanded="false" aria-controls="faq-collapse-4">
                                                        What is "crowdfunding"?
                                                    </button>
                                                </h2>
                                                <div id="faq-collapse-4" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                                    <div class="accordion-body">Is the practice of funding a project or venture by raising money from a large number of people, in modern times typically via the Internet. Crowdfunding is a form of crowdsourcing and an Alternative Finance for a Funeral Services.</div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="faq-head-5">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-collapse-5" aria-expanded="false" aria-controls="faq-collapse-5">
                                                        Who shall received the money donated to Abuloy PH fund?
                                                    </button>
                                                </h2>
                                                <div id="faq-collapse-5" class="accordion-collapse collapse" aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushExample">
                                                    <div class="accordion-body">The money will be received by the one or more beneficiaries whom you chose to give your donation. Below are the details of their campaigns.</div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="faq-head-6">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-collapse-6" aria-expanded="false" aria-controls="faq-collapse-6">
                                                        Is there a fees?
                                                    </button>
                                                </h2>
                                                <div id="faq-collapse-6" class="accordion-collapse collapse" aria-labelledby="flush-headingFive" data-bs-parent="#accordionFlushExample">
                                                    <div class="accordion-body">Yes, charges a flat fee of 5% on each donation made to Abuloy.PH. This fee helps us to cover our own costs of running a website and business. The fee is similar to competing crowd funding websites. For more detailed information about our fees, please read our <a href="/terms-and-conditions" class="no-style text-lavander">terms of service.</a></div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="faq-head-7">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-collapse-7" aria-expanded="false" aria-controls="faq-collapse-7">
                                                        Can I donate anonymously?
                                                    </button>
                                                </h2>
                                                <div id="faq-collapse-7" class="accordion-collapse collapse" aria-labelledby="flush-headingSix" data-bs-parent="#accordionFlushExample">
                                                    <div class="accordion-body">Definitely Yes.</div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="faq-head-8">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-collapse-8" aria-expanded="false" aria-controls="faq-collapse-8">
                                                        Can I create more than one fund?
                                                    </button>
                                                </h2>
                                                <div id="faq-collapse-8" class="accordion-collapse collapse" aria-labelledby="flush-headingSeven" data-bs-parent="#accordionFlushExample">
                                                    <div class="accordion-body">Definitely Yes.</div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="faq-head-9">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-collapse-9" aria-expanded="false" aria-controls="faq-collapse-9">
                                                        Can I donate on my mobile phone?
                                                    </button>
                                                </h2>
                                                <div id="faq-collapse-9" class="accordion-collapse collapse" aria-labelledby="flush-headingSeven" data-bs-parent="#accordionFlushExample">
                                                    <div class="accordion-body">Definitely yes, of course, as long as you have latest or updated browsers in your phone.</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- end section Area -->
                <?php
                }                
            }   
        }
        else{
            include './header.php';
            ?>
            <!-- start section Area -->
            <section class="my-5 py-5" id="home faq">
                <div class="container">
                    <div class="row fullscreen align-items-center justify-content-start">
                    <div class="col-lg-12 col-md-12 col-sm-12 m-0">
                            <div class="card">
                                <div class="card-header bg-lavander text-center py-3" style="height:50px;margin:0;padding:1px;">
                                    <h5 class="text-white">Frequently Asked Questions</h5>
                                </div>
                                <div class="card-body pb-5 mb-4">
                                    <div class="accordion accordion-flush" id="accordionFlushExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="faq-head-1">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-collapse-1" aria-expanded="false" aria-controls="faq-collapse-1">
                                                    What is Abuloy PH?
                                                </button>
                                            </h2>
                                            <div id="faq-collapse-1" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">Abuloy.PH - is a crowdfunding website created for the purpose of helping the deceased who can't afford the money for the funeral or the final expenses of their loved ones.</div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="faq-head-2">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-collapse-2" aria-expanded="false" aria-controls="flush-collapseOne">
                                                    How we donate at Abuloy.PH?
                                                </button>
                                            </h2>
                                            <div id="faq-collapse-2" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">To our dear users, we created a short clip video instruction for you to know the process very easily and efficiently. Below are the video instructions to how you can donate in <a href="/" class="no-style text-lavander">Abuloy.PH.</a></div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="faq-head-3">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-collapse-3" aria-expanded="false" aria-controls="faq-collapse-3">
                                                    How to create a fund in Abuloy PH?
                                                </button>
                                            </h2>
                                            <div id="faq-collapse-3" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">To our dear users, we created a short clip video instruction to how you’ll create a fund in Abuloy.PH. Below are the video instructions on how to create a fund.<code>Click Here.</code></div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="faq-head-4">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-collapse-4" aria-expanded="false" aria-controls="faq-collapse-4">
                                                    What is "crowdfunding"?
                                                </button>
                                            </h2>
                                            <div id="faq-collapse-4" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">Is the practice of funding a project or venture by raising money from a large number of people, in modern times typically via the Internet. Crowdfunding is a form of crowdsourcing and an Alternative Finance for a Funeral Services.</div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="faq-head-5">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-collapse-5" aria-expanded="false" aria-controls="faq-collapse-5">
                                                    Who shall received the money donated to Abuloy PH fund?
                                                </button>
                                            </h2>
                                            <div id="faq-collapse-5" class="accordion-collapse collapse" aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">The money will be received by the one or more beneficiaries whom you chose to give your donation. Below are the details of their campaigns.</div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="faq-head-6">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-collapse-6" aria-expanded="false" aria-controls="faq-collapse-6">
                                                    Is there a fees?
                                                </button>
                                            </h2>
                                            <div id="faq-collapse-6" class="accordion-collapse collapse" aria-labelledby="flush-headingFive" data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">Yes, charges a flat fee of 5% on each donation made to Abuloy.PH. This fee helps us to cover our own costs of running a website and business. The fee is similar to competing crowd funding websites. For more detailed information about our fees, please read our <a href="/terms-and-conditions" class="no-style text-lavander">terms of service.</a></div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="faq-head-7">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-collapse-7" aria-expanded="false" aria-controls="faq-collapse-7">
                                                    Can I donate anonymously?
                                                </button>
                                            </h2>
                                            <div id="faq-collapse-7" class="accordion-collapse collapse" aria-labelledby="flush-headingSix" data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">Yes you can, just check the box for 'Make my donation anonymous' as you are about to donate, be sure to read the note as well for further details that may require.</div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="faq-head-8">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-collapse-8" aria-expanded="false" aria-controls="faq-collapse-8">
                                                    Can I create more than one fund?
                                                </button>
                                            </h2>
                                            <div id="faq-collapse-8" class="accordion-collapse collapse" aria-labelledby="flush-headingSeven" data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">Definitely Yes, as long as the fund is not the same name as the first you created.</div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="faq-head-9">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-collapse-9" aria-expanded="false" aria-controls="faq-collapse-9">
                                                    Can I donate on my mobile phone?
                                                </button>
                                            </h2>
                                            <div id="faq-collapse-9" class="accordion-collapse collapse" aria-labelledby="flush-headingSeven" data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">Yes of course, as long as you have the latest or updated browsers in your phone</div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="faq-head-10">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-collapse-10" aria-expanded="false" aria-controls="faq-collapse-10">
                                                    How long can I run the Abuloy Fund for?
                                                </button>
                                            </h2>
                                            <div id="faq-collapse-10" class="accordion-collapse collapse" aria-labelledby="flush-headingSeven" data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">Abuloy Fund will last up to 30 days after that the fund will be automatically expired and will no longer be publish to Abuloy.PH</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
                <!-- end section Area -->
        <?php
        }
    ?>

    <!-- start Footer Area -->
    <?php include './footer.php' ?>
    <!-- end Footer Area -->

    <!-- Plugins -->
    <?php include_once './plugins.php'; ?>
    <!-- Custom Script -->
    <script src="./controllers/faq.js"></script>
</body>

</html>