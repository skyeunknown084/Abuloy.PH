<!DOCTYPE html>
<html lang="en">
<?php
// session_start();
error_reporting(0);
include_once './config/db_connect.php';

?>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Abuloy PH</title>
<!-- Google Fonts (Poppins) -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
<!-- Fonts Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="assets/bootstrap/dist/css/bootstrap.css">
<link rel="stylesheet" href="assets/dist/css/main.css">
<link rel="stylesheet" href="assets/dist/css/style.css">
<link rel="stylesheet" href="assets/dist/css/scrollbar.css">
<style>
/* Small devices (landscape phones, 576px and up) */
@media screen and (max-width: 767px) {
    .mobile-device{
        display:block !important;
    }
    .no-mobile-device{
        display:none !important;
    }
}

/* Medium devices (tablets, 768px and up) */
@media screen and (min-width: 768px) {
    .mobile-device{
        display:block !important;
    }
    .no-mobile-device{
        display:none !important;
    }
}

/* Large devices (desktops, 992px and up) */
@media screen and (min-width: 992px) {
    .mobile-device{
        display:none !important;
    }
    .no-mobile-device{
        display:block !important;
    }
}

/* X-Large devices (large desktops, 1200px and up) */
@media screen and (min-width: 1200px) {
    .mobile-device{
        display:none !important;
    }
    .no-mobile-device{
        display:block !important;
    }
}

/* // XX-Large devices (larger desktops, 1400px and up) */
@media screen and (min-width: 1400px) {
    .mobile-device{
        display:none !important;
    }
    .no-mobile-device{
        display:block !important;
    }
}
body {
    box-sizing: border-box;
}
</style>
</head>
<body>
    <div class="bb-aquamarine fixed-top nav-shadow">
        <nav class="navbar navbar-lg d-flex" aria-label="Offcanvas navbar large">
            <div class="container-fluid">
                <a class="navbar-brand nav-brand-box" href="/"><span class="text-aquamarine text-underline fw-700 fs-larger ms-2">Abuloy</span></a>
                <div class="no-mobile-device">
                    <ul class="nav justify-content-end">
                        <li class="nav-item">
                            <form class="d-flex" role="search">
                                <input class="hide form-control" type="search" placeholder="Search" aria-label="Search">
                                <button class="btn btn-white btn-sm" type="submit">
                                    <i class="fa fa-search me-1 m-0 pt-0 text-lavander" style="font-size:25px;"></i>
                                </button>
                            </form>
                        </li>
                        <li class="nav-item">
                            <div class="dropdown p-0">
                                <a class="nav-link dropdown-toggle me-2" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="text-aquamarine fw-bold p-0 mt-1" style="font-size:15px">
                                        Why Abuloy PH?
                                    </span>
                                </a>
                                <ul class="dropdown-menu gap-1 p-2 rounded-3 mx-0 shadow w-220px">
                                    <li><a class="dropdown-item rounded-2 text-blackish-aquamarine" href="/about-us">Who we are</a></li>
                                    <li><a class="dropdown-item rounded-2 text-blackish-aquamarine" href="/how-it-works">How Abuloy PH works</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item rounded-2 text-blackish-aquamarine" href="/faq">FAQs</a></li>
                                </ul>
                            </div>
                        </li>
                        <?php if($_SESSION['login_type'] != 1 && $_SESSION['login_type'] != 2){ ?>
                        <li class="nav-item">
                            <a class="nav-link text-blackish-lavander" href="/login">Sign-In</a>
                        </li>
                        <?php } ?>
                        <li class="nav-item">
                            <a class="nav-link btn btn-lavander py-2" href="/startnewfund">Start A Fund</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-blackish-lavander" href="/donees">Donate</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-blackish-lavander" href="/contact">Contact</a>
                        </li>
                        <li class="nav-item hide">
                            <a class="dropdown-toggle btn btn-white btn-sm me-2" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-bell mr-0 m-0 pt-0 text-lavander" style="font-size:25px;"></i>
                            </a>
                            <ul class="dropdown-menu gap-1 p-2 rounded-3 mx-0 shadow w-220px">
                                <li><a class="dropdown-item rounded-2 text-blackish-aquamarine" href="#">No Message</a></li>
                            </ul>
                        </li>
                        <?php if($_SESSION['login_type'] == 1 || $_SESSION['login_type'] == 2){ ?> 
                        <li class="nav-item dropdown active">
                            <a class="nav-link dropdown-toggle btn btn-lavander btn-round px-2 py-1" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="text-aquamarine py-0" style="font-size:15px">
                                    <img src="assets/img/no-image-available.png" class="img-thumbnail me-2 ms-0 p-0" style="border-radius:50%;height:25px;border:0px" alt=""><?php echo $_SESSION['login_firstname']; ?>!</span>
                                </span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end gap-1 p-2 rounded-3 mx-0 shadow w-220px">
                                <li><a class="dropdown-item rounded-2 text-blackish-aquamarine" href="/profile-list">My Fund Lists</a></li>
                                <li><a class="dropdown-item rounded-2 text-blackish-aquamarine" href="/account-settings"><i class="fa fa-cog pe-2"></i> Account Settings</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item rounded-2 text-blackish-aquamarine" href="/ajax?action=logout"><i class="fa fa-power-off pe-2"></i>  Logout</a></li>
                            </ul>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
                <button class="mobile-device navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#staticBackdrop" aria-controls="offcanvasNavbar2">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="mobile-device offcanvas offcanvas-start" data-bs-backdrop="static" tabindex="-1" id="staticBackdrop" aria-labelledby="staticBackdropLabel">
                <!-- <div class="mobile-device offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasNavbar2" aria-labelledby="offcanvasNavbar2Label"> -->
                    <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbar2Label">
                    <a class="navbar-brand nav-brand-box py-2" href="/"><span class="text-aquamarine text-underline fw-700 fs-larger ms-2">Abuloy</span></a>
                    </h5>
                    <button type="button" class="btn-close btn-close text-dark-purple" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body" style="height:100vh;overflow-y:auto">
                        <ul class="nav nav-pills flex-column mb-auto">
                            <li class="nav-item">
                                <form class="d-flex" role="search">
                                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                                    <button class="btn btn-white btn-sm" type="submit">
                                        <i class="fa fa-search mr-0 m-0 pt-0 text-purple" style="font-size:25px;"></i>
                                    </button>
                                </form>
                            </li>
                            <li class="nav-item">
                                <div class="accordion accordion-flush" id="accordionFlushExample">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-heading1">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse1" aria-expanded="false" aria-controls="flush-collapse1">
                                            <a class="text-lavander m-0 p-0 no-style fs-larger"><strong>Why Abuloy PH?</strong></a>  
                                        </button>
                                        </h2>
                                        <div id="flush-collapse1" class="accordion-collapse collapse" aria-labelledby="flush-heading1" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body text-black">
                                                <ul class="">
                                                    <li><a class="no-style fw-bold rounded-2 text-blackish-aquamarine" href="/about-us">Who we are</a></li>
                                                    <li><a class="no-style fw-bold rounded-2 text-blackish-aquamarine" href="/how-it-works">How Abuloy PH works</a></li>
                                                    <li><a class="no-style fw-bold rounded-2 text-blackish-aquamarine" href="/faq">FAQs</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>                            
                                </div>  
                            </li>                            
                            <?php if($_SESSION['login_type'] != 1 && $_SESSION['login_type'] != 2){ ?>
                            <li class="nav-item">
                                <a href="/login" class="nav-link fw-bold text-blackish-lavander">
                                <i class="hide fas fa-user pe-2"></i>
                                Sign-In
                                </a>
                            </li>
                            <?php } ?>
                            <li class="nav-item py-1">
                                <a href="/startnewfund" class="nav-link fw-bold text-blackish-lavander">
                                <i class="hide fas fa-donate pe-2"></i>
                                Start A Fund
                                </a>
                            </li>
                            <li>
                                <a href="/donate" class="nav-link fw-bold text-blackish-lavander">
                                <i class="hide fas fa-donate pe-2"></i>
                                Donate
                                </a>
                            </li>
                            <?php if($_SESSION['login_type'] == 1){ ?>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a href="/funds" class="nav-link fw-bold text-blackish-lavander">
                                <i class="hide fas fa-donate pe-2"></i>
                                Funds Traccking
                                </a>
                            </li>
                            <li>
                                <a href="/withdrawals" class="nav-link fw-bold text-blackish-lavander">
                                <i class="hide fas fa-wallet pe-2"></i>
                                Withdrawals
                                </a>
                            </li>
                            <li>
                                <a href="/emails" class="nav-link fw-bold text-blackish-lavander">
                                <i class="hide fa fa-envelope pe-2"></i>
                                Emails Send & Received
                                </a>
                            </li>
                            <li class="hide">
                                <a href="/account-settings" class="nav-link fw-bold text-blackish-lavander">
                                <i class="fa fa-users pe-2"></i>
                                Account Settings
                                </a>
                            </li>
                            <?php } ?>
                            <?php if($_SESSION['login_type'] != 1 && $_SESSION['login_type'] != 2){ ?>
                            <li class="nav-item">
                                <div class="accordion accordion-flush" id="accordionFlushExample">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-heading2">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse2" aria-expanded="false" aria-controls="flush-collapse2">
                                            <a href="/contact" class="text-lavander m-0 p-0 no-style fs-larger"><strong>Contact Us</strong></a>  
                                        </button>
                                        </h2>
                                        <div id="flush-collapse2" class="accordion-collapse collapse" aria-labelledby="flush-heading2" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body bg-aquamarine text-black">
                                                <p class="mb-2">     
                                                    <p>
                                                    <i class="fas fa-phone me-3"></i>Phone: +63 (43) 406 4065</p>
                                                    <p>
                                                    <i aria-hidden="true" class="fas fa-mobile me-3"></i>Mobile: +63 (977) 811 3377</p>
                                                    <p>
                                                    <i aria-hidden="true" class="fab fa-viber me-3"></i>Viber: +63 (977) 811 3377</p>
                                                    <p>
                                                    <i aria-hidden="true" class="fab fa-whatsapp me-3"></i>WhatsApp: +63 (977) 811 3377</p>
                                                    <p>
                                                    <i class="fas fa-envelope me-3"></i><a href="mailto:abuloyph.citychapels@gmail.com" class="text-b-lavander no-style"> citychapels@gmail.com</a></p>
                                                </p>
                                            </div>
                                        </div>
                                    </div>                            
                                </div>                                 
                            </li>
                            <?php } ?>
                        </ul>
                        
                        <?php if($_SESSION['login_type'] == 1 || $_SESSION['login_type'] == 2){ ?>
                        <div class="dropup-center dropup" style="position:absolute;bottom:25px">
                            <a class="nav-link dropdown-toggle btn btn-lavander btn-round px-2 py-1" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="text-aquamarine py-0" style="font-size:15px">
                                    <img src="assets/img/no-image-available.png" class="img-thumbnail me-2 ms-0 p-0" style="border-radius:50%;height:25px;border:0px" alt=""><?php echo $_SESSION['login_firstname']; ?>!</span>
                                </span>
                            </a>
                            <ul class="dropdown-menu gap-1 p-2 rounded-3 mx-0 shadow w-220px">
                                <li><a class="dropdown-item rounded-2 text-blackish-aquamarine" href="/profile">Profile</a></li>
                                <li><a class="dropdown-item rounded-2 text-blackish-aquamarine" href="/account-settings"><i class="fa fa-cog pe-2"></i> Account Settings</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item rounded-2 text-blackish-aquamarine" href="/ajax?action=logout"><i class="fa fa-power-off pe-2"></i>  Logout</a></li>
                            </ul>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </nav>
    </div>
<!-- start section Area -->
<section class="my-5 py-5" id="home startafund" style="padding-top:50px;">
    <div class="overlay overlay-bg bg-aquamarine"></div>
        <div class="container">
            <div class="row fullscreen align-items-center justify-content-start">
                <div class="main-content col-lg-12 col-md-12 pt-100 pb-100 m-0" id="fundForm" style="padding-top:50px;">
                    <div class="card">
                        <div class="card-header bg-lavander text-center" style="height:1px;margin:0;padding:1px;">
                            
                        </div>
                        <div class="card-body pb-5 mb-4">
                            <br>
                            <h4 class="text-center pb-2">ABULOY.PH – PRIVACY POLICY</h4>
                            <p class="text-justify px-5 pb-1">
                            <center>PLEASE READ THESE POLICY CAREFULLY. BY USING THIS WEBSITE, <br>
                                YOU AGREE TO ALL OF THE POLICY CONTAINED HEREIN.</center> 
                            <br>
                            <center>If you have any Questions? <a href="index.php?page=contact"><u>Contact Us</u></a></center>    
                            </p>
                            <p class="text-justify px-5 pb-1">
                            ABULOY.PH (“Abuloy.Ph,” “we,” “us,” “our”) provides its services through the website located at Abuloy.ph (the “Site”). We reserve the right at any time to alter these “Privacy Policy”. If we alter the Privacy Policy, we will post the changes on the Site and revise the date at the top of this page. We may also attempt to notify you through email or any other reasonable means. Any changes made to these Site terms will take effect no less than fourteen (14) days from the time they are posted. It is the responsibility of the Site user to check the Privacy Policy at least every fourteen (14) days to check if the Privacy Policy have changed. If you have any questions regarding the use of the Site or these Privacy Policy, please contact us at Asupport@abuloyph.com
                            Failure to abide by these Privacy Policy may result in a permanent suspension or termination of your account with Abuloy.Ph. In the event of suspension or termination of an account any funeral funds will end immediately and be removed from the site.
                            Abuloy offers “Services” to its users which may include “Abuloy Fund Organizers”, “Donors”, “Abuloy Service Fund Providers”, and any other users (registered or non-registered) of the Site. The Services are designed to allow Abuloy Fund Organizer to create a “Abuloy Fund” to accept monetary donations from “Donors/Donees”. In order for Abuloy Fund to become active on the Site, it must be linked to a Abuloy Service Fund Provider account and be accepted by the Abuloy Service Fund Providers. The Abuloy Service Provider must set the Abuloy Fund goal amount and reserves the right to change the Abuloy Fund goal amount at any time. The Abuloy Service Provider also reserves the right to deny, suspend, or end the Abuloy Fund at any time. Donations made to a Abuloy Fund will be deposited directly into the Abuloy Service Providers business bank account and not the Abuloy Fund Organizer as soon as the payment is processed. There are no fees to create a Abuloy Service Provider account or to create a Abuloy Fund, however a percentage of each Donation will be charged as a fee for our Services and to our third party payment processor. Please see the Fees section for more details.
                            Abuloy Funds are not charities and your donations are not tax-deductible charitable contributions. By accepting these policy, you acknowledge that donations made to a Abuloy Fund are not deductible for U.S. federal income tax purposes as charitable contributions.
                            </p>                            
                            <p class="text-justify px-5 pb-1">
                            <b>Registering an Account</b>
                            <br>
                            You must be at least 18 years old and by registering an account you represent and warrant that you are least 18 years old. You must represent yourself and provide accurate information as prompted by the Site during the registration process. This may include, but is not limited to first name, last name, and email address. Abuloy Service Providers are required to accurately provide more detailed information including legal business name, phone number, address, and applicable banking information. It is the responsibility of the registered user to update any information that changes post registration with the Site. It is also the responsibility of the user to maintain the security of your password and accept all risks of unauthorized access to the registration data and any other information you provide to Fund the Funeral. You are responsible for all actions performed on the Site using your account.
                            </p>
                            <p class="text-justify px-5 pb-1">
                            <b>Creating a Funeral Fund</b>
                            <br>
                            Registered users of the Site can create an Abuloy Fund to accept donations to pay for funeral expenses only. Abuloy Funds may only be created to cover the “Final Expenses” of an individual, including, but not limited to the fees charged by the Abuloy Service Provider. You must provide accurate information when creating a funeral fund including the name of the deceased, date of birth, and date of death. When creating an Abuloy Fund you will have the option to select from Abuloy Service Providers who have registered accounts with AbuloyPh. If the Abuloy Service Provider you are using is not registered with Abuloy.Ph, you will be prompted to provide us with contact information for the Abuloy Service Provider you are using to provide funeral services. We will make a reasonable effort to contact the Abuloy Service Provider and notify them of your Abuloy Fund with us. If the Abuloy Service Provider registers an account with us, your Abuloy Fund will be sent to the Abuloy Service Provider for confirmation. If the Abuloy Service Provider does not register an account Abuloy.Ph, you will be notified by email and your Abuloy Fund will not become active on the Site. You may not post any material in an Abuloy Fund that is false, inaccurate or otherwise misleading. It is your responsibility to ensure that you do not post any copyrighted material including text or images. If your Abuloy Fund is found to be in violation of these Privacy Policy, your Abuloy Fund may be suspended, or terminated by either the Abuloy Service Provider or Abuloy.Ph Fund. Abuloy Funds have no time limit and will remain active until the Abuloy Service Provider chooses to end the Abuloy Fund. After an Abuloy Fund has ended it will remain visible on the Site, but can no longer receive Donations. In the event that the Funeral Fund generates more money than is required to pay the Abuloy Service Provider for their services, the Abuloy Service Provider must refund the remainder of the donations to the Abuloy Fund Organizer. It is the responsibility of the Abuloy Service Provider to contact the Abuloy Fund Organizer after ending an Abuloy Fund to arrange a refund if necessary.
                            </p>
                            <p class="text-justify px-5 pb-1"> 
                            <b>Donating to a Funeral Fund</b>
                            <br>
                            You agree that all donations made on the Site through the payment processor associated with the Abuloy Fund are made voluntarily by you. Abuloy attempts to ensure the accuracy of Abuloy Funds by having all donations go directly to the Abuloy Service Providers bank account instead of the Abuloy Fund Organizer. We cannot however individually verify the accuracy of the information contained in Abuloy Funds on the Site and we do not warrant or represent the accuracy of any Abuloy Fund on the Site. Donations are made through a third party payment processor, and Abuloy.Ph cannot refund donations made to a Abuloy Fund. However, we can put you in touch with the third party payment processor in order for you to request a refund. Refunds given by the third party payment processor are at the sole discretion of the payment processor and in accordance with their Privacy Policy.
                            </p>
                            <p class="text-justify px-5 pb-1"> 
                            <b>Funeral Service Providers</b>
                            <br>
                            By registering for an account on Abuloy.Ph, you represent and warrant that you work for a legal business entity in the Philippines and that your business primarily conducts business related to funeral services. It is your responsibility to provide accurate information requested by the Site when you register an account with Abuloy.Ph. It is the responsibility of the Abuloy Service Provider to ensure that all of the donations received for an Abuloy Fund are used to cover the expenses of the funeral service. In the event that an Abuloy Fund receives more donations than required to cover the expenses of the funeral service, the surplus must be given to the Abuloy Fund organizer.
                            </p>
                            <p class="text-justify px-5 pb-1"> 
                            <b>User Conduct and Content</b>
                            <br>
                            It is the sole responsibility of the Site user to follow the rules for uploading content on the Site. Content may include, but is not limited to, text, comments, information, data, messages, pictures, music, video, graphics, or any other user uploaded content. You are responsible for any content that you upload and you agree not to upload, post, transmit, create or otherwise publish through the Site any of the following:<br>
                            <br>
                            •	User content that that infringes upon copyright, patent, trademark or any other intellectual property of another party. By posting content on the Site, you represent and warrant that you own the right to distribute such content.<br>
                            •	User content that is illegal, inappropriate, lewd, harassing, threatening, defamatory, pornographic, invasive of privacy or otherwise objectionable.<br>
                            •	User Content that misrepresents yourself or any other entity, or impersonates another person or entity.<br>
                            •	User content that solicits, promotes or advertises any product, service, or political campaign.<br>
                            •	User content that could be considered private information of any third party including, but not limited to phone numbers, social security numbers, addresses, email addresses or banking information.<br>
                            •	Data that could be considered harmful including viruses or otherwise disruptive or destructive content.<br>
                            •	User content that for any reason is considered objectionable by Abuloy.Ph.<br>
                            <br>
                            Furthermore, you agree that you are solely responsible for your use of the Site and conduct while on the Site and that you will not do any of the following while connected to the Site:<br>
                            <br>
                            •	Look for exploits on the Site in order to cheat or gain monetarily from. <br>
                            •	Stalk, intimidate or threaten any other users of the Site. <br>
                            •	Use the Site to distribute, market, or spam any product or service.<br>
                            •	Collect or harvest information about other users without their consent.<br>
                            •	Avoid or attempt to avoid any security measures or features used to protect the Site and its users.<br>
                            •	Use the site for any illegal purposes.<br>
                            <br>
                            Abuloy.Ph, reserves the right to determine if you are in violation of any of user content and conduct stipulations contained in these Privacy Policy.   
                            </p>
                            <p class="text-justify px-5 pb-1"> 
                            <b>Fees</b>
                            <br>
                            Abuloy.Ph, does not charge Abuloy Service Providers or Abuloy Fund Organizers any fees for registering an account, creating Abuloy Funds, or receiving donations. Abuloy.Ph, receives a flat percentage of each donation made to an Abuloy fund. In addition, a fee is deducted from each donation for payment processing which is payable directly to our third party payment processor. Donors to an Abuloy Fund acknowledge that their donation is in agreement with the terms and services of the third party payment processor as well as these Privacy Policy. Service fees and payment processing fees are provided below:<br>
                            <br>
                            •	Abuloy.Ph, charges a flat service fee of 3% per donation.<br>
                            •	Gcash, charges a processing fee of 2% per donation<br>
                            •	Gcash, also need a withdrawal fee of Php 20.00 pesos.   
                            </p>
                            <p class="text-justify px-5 pb-1"> 
                            <b>Linking</b>
                            <br>
                            You are granted a unlimited, non-exclusive right to link to the Site provided your link does not portray Abuloy.Ph, in a negative, false, misleading, derogatory, or otherwise defamatory manner. Social Links may not be placed on any site that contains illegal, adult, offensive or otherwise objectionable material.
                            </p>
                            <p class="text-justify px-5 pb-1"> 
                            <b>Indemnification</b>
                            <br>
                            By using the Site, you agree to hold harmless Abuloy.Ph, and all of its members, from and against any suits or claims, and to indemnify Abuloy.Ph Fund Services against any and all costs, liabilities, damages and expenses that may arise from the use of the Site and related to any user content posted, stored or transmitted on the Site.    
                            </p>
                            <p class="text-justify px-5 pb-1"> 
                            <b>Disclaimer</b>
                            <br>
                            Your use of Abuloy.Ph is at your own risk. The service provided by Abuloy.Ph is provided on as “as is” and “as available” basis only. Abuloy.Ph makes no guarantee that its service will meet any requirements that, be uninterrupted, secure or error free.
                            </p>
                            <p class="text-justify px-5 pb-1"> 
                            <b>Site Issues</b>
                            <br>
                            If you have any questions about these Privacy Policy, or about Abuloy.Ph in general, you may contact Abuloy.Ph via emailing <a href="index.php?page=contact">support@abuloyph.com.</a> 
                            <br>
                            If you have a problem concerning an account, how Abuloy.Ph, works or any other general issue, please visit our <a href="index.php?page=contact">Help Center.</a>   
                            </p>   
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </section>
<!-- end section Area -->
<?php include_once './footer.php'; ?>
<script src="assets/bootstrap/dist/js/bootstrap.bundle.min.js"></script>   
</body>
</html>
