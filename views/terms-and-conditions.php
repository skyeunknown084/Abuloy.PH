<?php

session_start();
error_reporting(0);

// if(isset($usertype) == 1){
//     $sql = "SELECT * FROM abuloy_users WHERE id = $userid";

//     $result = $mysqli->query($sql);

//     $user = $result->fetch_assoc();
//         $log_status = $user['log_status'];
//     if($log_status == 1){
//         echo 'success login';
//         echo $user['firstname'];
//         echo $user['user_type'];
//     }else{
//         echo 'failed login';
//     }
// }else{

//     $

//     // header('Location: /login');
//     // session_unset();
//     // session_destroy();
// }
// if(isset($_SESSION['user_id'])) {
    
//     $sql = "SELECT * FROM abuloy_users
//             WHERE id = " . $_SESSION['user_id'] ." AND email_status = 1";

//     $result = $mysqli->query($sql);

//     $user = $result->fetch_assoc();

    

// }
// else{
    
    // if($user == ''){
    //     header("Location: /login");
    // }else{
    //     header("Location: /");
    // }
    
// }
?>
<!DOCTYPE html>
<html lang="en">
<?php
// include_once './global_call.php';
include 'head.php';
?>
<!-- register css -->
<!-- <link rel="stylesheet" href="./assets/dist/css/pages/register.css"> -->
</head>
<body class="bg-light">
    
    <?php

        require "global_call.php";
        require "database.php";

        $uid = $_SESSION['user_id'];
        $utype = $_SESSION['user_type'];
        if($utype == 1){
            
            // Dashboard for User with Accounts
            $stmt = $mysqli->prepare("SELECT * FROM abuloy_users WHERE id = ?");
            $stmt->bind_param('d', $uid);
            $result = $stmt->execute();
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();
            
            if(isset($user)){
                include 'header-user.php';
                ?>
                <section class="my-5 pt-5">
                    <h1>Terms & Conditions</h1>
                </section>
                <?php
            }
        }
        else{
            include 'header.php';
            ?>
            <section class="my-5 pt-5">
                <div class="container mx-auto">
                    <div class="card">
                        <div class="card-header bg-lavander text-center" style="height:1px;margin:0;padding:1px;">
                            
                        </div>
                        <div class="card-body pb-5 mb-4">
                            <br>
                            <h4 class="text-center pb-2">ABULOY.PH – TERMS OF SERVICE AND CONDITIONS</h4>
                            <p class="text-justify px-lg-5 pb-1">
                            </p><center>PLEASE READ THESE TERMS OF SERVICE CAREFULLY. BY USING THIS WEBSITE, <br>
                                YOU AGREE TO ALL OF THE TERMS OF SERVICES AND CONDITIONS CONTAINED HEREIN.</center> 
                            <br>
                            <center>If you have any Questions? <a href="index.php?page=contact"><u>Contact Us</u></a></center>    
                            <p></p>
                            <p class="text-justify px-lg-5 pb-1">
                            ABULOY.PH (“Abuloy.Ph,” “we,” “us,” “our”) provides its services through the website located at Abuloy.ph (the “Site”). We reserve the right at any time to alter these “Terms of Service”. If we alter the Terms of Service, we will post the changes on the Site and revise the date at the top of this page. We may also attempt to notify you through email or any other reasonable means. Any changes made to these Site terms will take effect no less than fourteen (14) days from the time they are posted. It is the responsibility of the Site user to check the Terms of Service at least every fourteen (14) days to check if the Terms of Service have changed. If you have any questions regarding the use of the Site or these Terms of Service, please contact us at A support@abuloy.ph
                            Failure to abide by these Terms of Service may result in a permanent suspension or termination of your account with Abuloy.Ph. In the event of suspension or termination of an account any funeral funds will end immediately and be removed from the site.
                            Abuloy offers “Services” to its users which may include “Abuloy Fund Organizers”, “Donors”, “Abuloy Service Fund Providers”, and any other users (registered or non-registered) of the Site. The Services are designed to allow Abuloy Fund Organizer to create a “Abuloy Fund” to accept monetary donations from “Donors/Donees”. In order for Abuloy Fund to become active on the Site, it must be linked to a Abuloy Service Fund Provider account and be accepted by the Abuloy Service Fund Providers. The Abuloy Service Provider must set the Abuloy Fund goal amount and reserves the right to change the Abuloy Fund goal amount at any time. The Abuloy Service Provider also reserves the right to deny, suspend, or end the Abuloy Fund at any time. Donations made to a Abuloy Fund will be deposited directly into the Abuloy Service Providers business bank account and not the Abuloy Fund Organizer as soon as the payment is processed. There are no fees to create a Abuloy Service Provider account or to create a Abuloy Fund, however a percentage of each Donation will be charged as a fee for our Services and to our third party payment processor. Please see the Fees section for more details.
                            Abuloy Funds are not charities and your donations are not tax-deductible charitable contributions. By accepting these terms of service, you acknowledge that donations made to a Abuloy Fund are not deductible for U.S. federal income tax purposes as charitable contributions.
                            </p>                            
                            <p class="text-justify px-lg-5 pb-1">
                            <strong class="mb-2">Registering an Account</strong>
                            <br>
                            You must be at least 18 years old and by registering an account you represent and warrant that you are least 18 years old. You must represent yourself and provide accurate information as prompted by the Site during the registration process. This may include, but is not limited to first name, last name, and email address. Abuloy Service Providers are required to accurately provide more detailed information including legal business name, phone number, address, and applicable banking information. It is the responsibility of the registered user to update any information that changes post registration with the Site. It is also the responsibility of the user to maintain the security of your password and accept all risks of unauthorized access to the registration data and any other information you provide to Fund the Funeral. You are responsible for all actions performed on the Site using your account.
                            </p>
                            <p class="text-justify px-lg-5 pb-1">
                            <strong>Creating a Funeral Fund</strong>
                            <br>
                            Registered users of the Site can create an Abuloy Fund to accept donations to pay for funeral expenses only. Abuloy Funds may only be created to cover the “Final Expenses” of an individual, including, but not limited to the fees charged by the Abuloy Service Provider. You must provide accurate information when creating a funeral fund including the name of the deceased, date of birth, and date of death. When creating an Abuloy Fund you will have the option to select from Abuloy Service Providers who have registered accounts with AbuloyPh. If the Abuloy Service Provider you are using is not registered with Abuloy.Ph, you will be prompted to provide us with contact information for the Abuloy Service Provider you are using to provide funeral services. We will make a reasonable effort to contact the Abuloy Service Provider and notify them of your Abuloy Fund with us. If the Abuloy Service Provider registers an account with us, your Abuloy Fund will be sent to the Abuloy Service Provider for confirmation. If the Abuloy Service Provider does not register an account Abuloy.Ph, you will be notified by email and your Abuloy Fund will not become active on the Site. You may not post any material in an Abuloy Fund that is false, inaccurate or otherwise misleading. It is your responsibility to ensure that you do not post any copyrighted material including text or images. If your Abuloy Fund is found to be in violation of these Terms of Service, your Abuloy Fund may be suspended, or terminated by either the Abuloy Service Provider or Abuloy.Ph Fund. Abuloy Funds have no time limit and will remain active until the Abuloy Service Provider chooses to end the Abuloy Fund. After an Abuloy Fund has ended it will remain visible on the Site, but can no longer receive Donations. In the event that the Funeral Fund generates more money than is required to pay the Abuloy Service Provider for their services, the Abuloy Service Provider must refund the remainder of the donations to the Abuloy Fund Organizer. It is the responsibility of the Abuloy Service Provider to contact the Abuloy Fund Organizer after ending an Abuloy Fund to arrange a refund if necessary.
                            </p>
                            <p class="text-justify px-lg-5 pb-1"> 
                            <strong>Donating to a Funeral Fund</strong>
                            <br>
                            You agree that all donations made on the Site through the payment processor associated with the Abuloy Fund are made voluntarily by you. Abuloy attempts to ensure the accuracy of Abuloy Funds by having all donations go directly to the Abuloy Service Providers bank account instead of the Abuloy Fund Organizer. We cannot however individually verify the accuracy of the information contained in Abuloy Funds on the Site and we do not warrant or represent the accuracy of any Abuloy Fund on the Site. Donations are made through a third party payment processor, and Abuloy.Ph cannot refund donations made to a Abuloy Fund. However, we can put you in touch with the third party payment processor in order for you to request a refund. Refunds given by the third party payment processor are at the sole discretion of the payment processor and in accordance with their terms of service.
                            </p>
                            <p class="text-justify px-lg-5 pb-1"> 
                            <strong>Funeral Service Providers</strong>
                            <br>
                            By registering for an account on Abuloy.Ph, you represent and warrant that you work for a legal business entity in the Philippines and that your business primarily conducts business related to funeral services. It is your responsibility to provide accurate information requested by the Site when you register an account with Abuloy.Ph. It is the responsibility of the Abuloy Service Provider to ensure that all of the donations received for an Abuloy Fund are used to cover the expenses of the funeral service. In the event that an Abuloy Fund receives more donations than required to cover the expenses of the funeral service, the surplus must be given to the Abuloy Fund organizer.
                            </p>
                            <p class="text-justify px-lg-5 pb-1"> 
                            <strong>User Conduct and Content</strong>
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
                            Abuloy.Ph, reserves the right to determine if you are in violation of any of user content and conduct stipulations contained in these Terms of Service.   
                            </p>
                            <p class="text-justify px-lg-5 pb-1"> 
                            <strong>Fees</strong>
                            <br>
                            Abuloy.Ph, does not charge Abuloy Service Providers or Abuloy Fund Organizers any fees for registering an account, creating Abuloy Funds, or receiving donations. Abuloy.Ph, receives a flat percentage of each donation made to an Abuloy fund. In addition, a fee is deducted from each donation for payment processing which is payable directly to our third party payment processor. Donors to an Abuloy Fund acknowledge that their donation is in agreement with the terms and services of the third party payment processor as well as these Terms of Service. Service fees and payment processing fees are provided below:<br>
                            <br>
                            •	Abuloy.Ph, charges a flat service fee of 3% per donation.<br>
                            •	Gcash, charges a processing fee of 2% per donation<br>
                            •	Gcash, also need a withdrawal fee of Php 20.00 pesos.   
                            </p>
                            <p class="text-justify px-lg-5 pb-1"> 
                            <strong>Linking</strong>
                            <br>
                            You are granted a unlimited, non-exclusive right to link to the Site provided your link does not portray Abuloy.Ph, in a negative, false, misleading, derogatory, or otherwise defamatory manner. Social Links may not be placed on any site that contains illegal, adult, offensive or otherwise objectionable material.
                            </p>
                            <p class="text-justify px-lg-5 pb-1"> 
                            <strong>Indemnification</strong>
                            <br>
                            By using the Site, you agree to hold harmless Abuloy.Ph, and all of its members, from and against any suits or claims, and to indemnify Abuloy.Ph Fund Services against any and all costs, liabilities, damages and expenses that may arise from the use of the Site and related to any user content posted, stored or transmitted on the Site.    
                            </p>
                            <p class="text-justify px-lg-5 pb-1"> 
                            <strong>Disclaimer</strong>
                            <br>
                            Your use of Abuloy.Ph is at your own risk. The service provided by Abuloy.Ph is provided on as “as is” and “as available” basis only. Abuloy.Ph makes no guarantee that its service will meet any requirements that, be uninterrupted, secure or error free.
                            </p>
                            <p class="text-justify px-lg-5 pb-1"> 
                            <strong>Site Issues</strong>
                            <br>
                            If you have any questions about these Terms of Service, or about Abuloy.Ph in general, you may contact Abuloy.Ph via emailing <a href="/contact-us">support@abuloy.ph.</a> 
                            <br>
                            If you have a problem concerning an account, how Abuloy.Ph, works or any other general issue, please visit our <a href="/contact-us">Help Center.</a>   
                            </p>   
                        </div>
                    </div>
                </div>
            </section>
            <?php
        }
        ?>
        

        <?php
        // }
        


    ?>
    
    <!-- start Footer Area -->
    <?php include 'footer.php'; ?>     
    <!-- end Footer Area -->

    <!-- Plugins -->
    <?php include 'plugins.php'; ?>
    <!-- Custom Script -->
    <!-- <script src="controllers/register.js"></script> -->
</body>
</html>