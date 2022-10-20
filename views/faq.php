<!DOCTYPE html>
<html lang="en">
<?php
include_once './global_call.php';
include_once './config/db_connect.php';
include_once './head_views.php';
?>
<!-- faq css -->
<link rel="stylesheet" href="./assets/dist/css/pages/faq.css">
</head>

<body>
    <?php include_once './header.php'; ?>

    <!-- start section Area -->
    <section class="my-5 py-5" id="home startafund" style="padding-top:50px;">
        <div class="overlay overlay-bg bg-aquamarine"></div>
        <div class="container">
            <div class="row fullscreen align-items-center justify-content-start">
                <div class="main-content col-lg-12 col-md-12 pt-100 pb-100 m-0" id="fundForm" style="padding-top:50px;">
                    <div class="card">
                        <div class="card-header bg-lavander text-center py-3" style="height:50px;margin:0;padding:1px;">
                            <h5 class="text-white">Frequently Asked Questions</h5>
                        </div>
                        <div class="card-body pb-5 mb-4">
                            <div class="accordion accordion-flush" id="accordionFlushExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingOne">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                            What is Abuloy PH?
                                        </button>
                                    </h2>
                                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">Abuloy.Ph - is a crowdfunding website created for the purpose of helping the deceased who can't afford the money for the funeral or the final expenses of their loved ones.</div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingOne">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                            How we donate at Abuloy.Ph?
                                        </button>
                                    </h2>
                                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">To our dear users, we created a short clip video instruction for you to know the process very easily and efficiently. Below are the video instructions to how you can donate in <code>Abuloy.Ph.</code></div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingTwo">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                            How to create a fund in Abuloy PH?
                                        </button>
                                    </h2>
                                    <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">To our dear users, we created a short clip video instruction to how you’ll create a fund in Abuloy.Ph. Below are the video instructions on how to create a fund.<code>Click Here.</code></div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingThree">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                            What is "crowdfunding"?
                                        </button>
                                    </h2>
                                    <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">Is the practice of funding a project or venture by raising money from a large number of people, in modern times typically via the Internet. Crowdfunding is a form of crowdsourcing and an Alternative Finance for a Funeral Services.</div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingFour">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                                            Who shall received the money donated to Abuloy PH fund?
                                        </button>
                                    </h2>
                                    <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">The money will be received by the one or more beneficiaries whom you chose to give your donation. Below are the details of their campaigns.</div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingFive">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFive">
                                            Is there a fees?
                                        </button>
                                    </h2>
                                    <div id="flush-collapseFive" class="accordion-collapse collapse" aria-labelledby="flush-headingFive" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">Yes, charges a flat fee of 5% on each donation made to Abuloy.Ph. This fee helps us to cover our own costs of running a website and business. The fee is similar to competing crowd funding websites. For more detailed information about our fees, please read our <code>terms of service.</code></div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingSix">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSix" aria-expanded="false" aria-controls="flush-collapseSix">
                                            Can I donate anonymously?
                                        </button>
                                    </h2>
                                    <div id="flush-collapseSix" class="accordion-collapse collapse" aria-labelledby="flush-headingSix" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">Definitely Yes.</div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingSeven">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSeven" aria-expanded="false" aria-controls="flush-collapseSeven">
                                            Can I create more than one fund?
                                        </button>
                                    </h2>
                                    <div id="flush-collapseSeven" class="accordion-collapse collapse" aria-labelledby="flush-headingSeven" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">Definitely Yes.</div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingSeven">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSeven" aria-expanded="false" aria-controls="flush-collapseSeven">
                                            Can I donate on my mobile phone?
                                        </button>
                                    </h2>
                                    <div id="flush-collapseSeven" class="accordion-collapse collapse" aria-labelledby="flush-headingSeven" data-bs-parent="#accordionFlushExample">
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

    <!-- start Footer Area -->
    <?php include './footer.php' ?>
    <!-- end Footer Area -->

    <!-- Plugins -->
    <?php include_once './plugin_views.php'; ?>
    <!-- Custom Script -->
    <script src="./controllers/faq.js"></script>
</body>

</html>