<?php
session_start();
error_reporting(0);   
?>
<!DOCTYPE html>
<html lang="en">
<?php
// include_once './global_call.php';
include './head_donate.php';
?>
<!-- register css -->
<link rel="stylesheet" href="https://abuloy.ph/assets/dist/css/pages/my-new-fund.css">
</head>
<body class="bg-light">
    
    <?php

        require "./database.php";

        $today = date('Y-m-d');
        $min_goal_days = "1 days";
        $min_goal_date = date_create($today);
        date_add($min_goal_date,date_interval_create_from_date_string($min_goal_days));
        $min_expiry_date = date_format($min_goal_date,"Y-m-d");

        $max_goal_days = "30 days";
        $max_goal_date = date_create($min_expiry_date);
        date_add($max_goal_date,date_interval_create_from_date_string($max_goal_days));
        $max_expiry_date = date_format($max_goal_date,"Y-m-d");

        $uid = $_SESSION['user_id'];
        if($_SERVER['REQUEST_METHOD'] === "GET"){
            $stmt = $mysqli->prepare("SELECT * FROM abuloy_users WHERE id = ?");
            $stmt->bind_param('d', $uid);
            $result = $stmt->execute();
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();
            
            // generate session again
            // session_regenerate_id();
            if(isset($user)){
                include 'header-user.php';
            }
            else{
                include './header.php';          
            }
        }

        // Photo Upload
        if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['photoToUpload'])){
            
            $img_name = $_FILES['photoToUpload']['name'];
            $img_size = $_FILES['photoToUpload']['size'];
            $tmp_name = $_FILES['photoToUpload']['tmp_name'];
            $error = $_FILES['photoToUpload']['error'];

            $d_firstname = $_POST['d_firstname'];
            $d_middlename = $_POST['d_middlename'];
            $d_lastname = $_POST['d_lastname'];
            $d_birthdate = $_POST['d_birthdate'];
            $d_date_of_death = $_POST['d_date_of_death'];
            $d_goal_amount = $_POST['d_goal_amount'];
            $expiration = $_POST['expiration'];
            $d_summary = $_POST['d_summary'];
            $token = $_POST['csrf'];

            // Upload Photo
            if($error === 0){
                if($img_size > 100000000){
                    $_SESSION['error'] = "Sorry, your file is too large";
                }
                else{
                    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                    $img_ex_lc = strtolower($img_ex);
    
                    $allowed_exs = array('jpg', 'jpeg', 'png');
    
                    if(in_array($img_ex_lc, $allowed_exs)){
                        $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
                        $img_upload_path = 'assets/uploads/'.$new_img_name;
                        move_uploaded_file($tmp_name, $img_upload_path);
    
                        // Insert into database
                        $sql = $mysqli->query("UPDATE abuloy_accounts SET 
                            avatar = '$new_img_name',
                            d_firstname = '$d_firstname',
                            d_middlename = '$d_middlename',
                            d_lastname = '$d_lastname',
                            d_birthdate = '$d_birthdate',
                            d_date_of_death = '$d_date_of_death',
                            d_goal_amount = '$d_goal_amount',
                            expiration = '$expiration',
                            d_summary = '$d_summary',
                            token = '$token'  
                            WHERE token = '$token'");
                        include 'image_preview.php';
                    }
                    else{
                        $_SESSION['error'] = "You can't upload files of this type!";
                    }
                }
            }
            else{
                $_SESSION['error'] = "Unknown error occurred!";
            }
    
        }
        

        // Upload Image
        // $target_dir = "assets/uploads/";
        // $target_file = $target_dir . basename($_FILES["photoToUpload"]["name"]);
        // $uploadOk = 1;
        // $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // // Check if image file is a actual image or fake image
        // // if(isset($_POST["submit"])) {}
        // if($_SERVER['REQUEST_METHOD'] === "POST"){
        //     $check = getimagesize($_FILES["photoToUpload"]["tmp_name"]);
        //     if($check !== false) {
        //         echo "File is an image - " . $check["mime"] . ".";
        //         $uploadOk = 1;
        //     } else {
        //         echo "File is not an image.";
        //         $uploadOk = 0;
        //     }
            
        // }
      

    ?>

    <section class="mb-5">
        <div class="container-fluid p-lg-5 p-md-5 pt-0 text-center">
            <div class="row">
                <div class="align-center col-lg-12 pb-1">             
                <div class="col-12 align-right pt-4 pb-2">
                    <a href="/my-funds" type="button" class="btn btn-lavander px-3 py-2 me-2">
                        <i class="fa fa-users pe-1 text-aquamarine"></i>  All My Funds
                    </a>
                </div>                
                </div>
                <hr class="text-purple">
            </div>
            <form action="" id="new-fund-upload-form" method="POST" enctype="multipart/form-data"> 
                <div class="row my_new_fund" id="my_new_fund">
                    
                    <?php
                    $acct_sql = $mysqli->prepare("SELECT * FROM abuloy_accounts WHERE token = ?");
                    $acct_sql->bind_param('s', $token);
                    $result_acct = $acct_sql->execute();
                    $result_acct = $acct_sql->get_result();
                    if($account = $result_acct->fetch_assoc()){
                        $aid = $account['id'];
                        $fname = $account['d_firstname'];
                        $mname = $account['d_middlename'];
                        $lname = $account['d_lastname'];
                        $photo = $account['avatar'];
                        $summary = $account['d_summary'];
                        $bdate = $account['d_birthdate'];
                        $ddate = $account['d_date_of_death'];
                        $goal_amount = $account['d_goal_amount'];
                        $link = $account['url_link'];

                        
                    ?>
                    
                        <div class="col-lg-6 mb-3 ps-lg-5 donate_user_search">
                            <div class="bg-white shadow">
                                <p class="no-mobile-donate-photo">
                                    <a target="_blank" href="/donate/<?= $aid ?>" class="bd-placeholder-img card-img-top align-center mx-auto bg-solid-silver">
                                    <?php if($photo == ''){ $no_image = 'https://abuloy.ph/assets/uploads/no-photo-available.png'; ?>
                                        <img src="<?= $no_image ?>" alt="" class="new-fund-photo" style="width:70%; height: 580px; object-fit: contain">
                                        <a class="photo_to_upload">
                                            <label for="file-upload" class="custom-file-upload">
                                                <i class="fa fa-image"></i> Upload Photo
                                            </label>
                                            <input type="file" id="file-upload" name="photoToUpload" />
                                        </a>
                                    <?php }else{ ?>
                                        <img src="<?= 'https://abuloy.ph/assets/uploads/'.$photo ?>" alt="" name="avatar" id="photo_upload" class="new-fund-photo" style="width:70%; height: 580px; object-fit: contain">
                                    <?php } ?>
                                    </a>
                                </p>
                                <p class="mobile-donate-photo">
                                    <a target="_blank" href="/donate/<?= $aid ?>" class="bd-placeholder-img card-img-top align-center mx-auto bg-solid-silver">
                                    <?php if($photo == ''){ $no_image = 'https://abuloy.ph/assets/uploads/no-photo-available.png'; ?>
                                        <img src="<?= $no_image ?>" alt="" style="width:100%; height: 360px; object-fit: contain">
                                    <?php }else{ ?>
                                        <img src="<?= $photo ?>" alt="" style="width:100%; height: 360px; object-fit: contain">
                                    <?php } ?>
                                    </a>
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-5 mb-3 pe-lg-5">
                            <div class="bg-white shadow align-m px-2">
                                <div class="bg-white p-3 pt-4">
                                                                
                                    <!-- <input type="hidden" name="gcash_abuloy_fee" id="gcash_abuloy_fee" value="0"> -->
                                    <label for="new-fund-details" class="d-flex text-lavander fw-800 justify-content-center fs-larger">Fund Details</label>
                                    <small for="new-fund-details" class="d-flex text-blackish justify-content-center">Please upload a photo of the deceased.</small>                                                 
                                    <div class="new-fund-details-form pb-2 pt-3" id="new-fund-details">
                                        <div class="form-row col-md-12 lavander-form mx-auto">
                                            <div class="col-lg-12 col-md-12 col-sm-12 mx-auto"> 
                                                <?php if(isset($_SESSION['error'])){ ?> 
                                                    <div class="alert alert-danger alert-dismissible fade show text-justify" role="alert">
                                                        <?= $_SESSION['error'] ?>
                                                        <a type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></a>
                                                    </div>
                                                <?php unset($_SESSION['error']);} ?>                      
                                                <div class="form-group py-1">
                                                    <?php set_csrf(); ?>
                                                    <small class="align-left"><i>First Name</i></small>
                                                    <input type="text" class="form-control form-control text-center py-0" value="<?php out($account['d_firstname']) ?>" name="d_firstname" required placeholder="First Name*">
                                                    <small id="#msg"></small>
                                                </div>
                                                <div class="form-group py-1">
                                                    <small class="align-left"><i>Middle Name</i></small>
                                                    <input type="text" class="form-control form-control text-center py-0" value="<?php out($account['d_middlename']) ?>" name="d_middlename" placeholder="Middle Name*">
                                                    <small id="#mn_msg"></small>
                                                </div>
                                                <div class="form-group py-1">
                                                    <small class="align-left"><i>Last Name</i></small>
                                                    <input type="text" class="form-control form-control text-center py-0" value="<?php out($account['d_lastname']) ?>" name="d_lastname" required placeholder="Last Name*">
                                                    <small id="#ln_msg"></small>
                                                </div>
                                                <div class="form-group py-1">
                                                    <small class="align-left"><i>Birth Date</i></small>
                                                    <input type="date" class="form-control form-control text-center py-0" value="<?php out(date("Y-m-d", strtotime($account['d_birthdate']))) ?>" name="d_birthdate" required placeholder="Birth Date*">
                                                    
                                                </div>
                                                <div class="form-group py-1">
                                                    <small class="align-left"><i>Date of Death</i></small>
                                                    <input type="date" class="form-control form-control text-center py-0" value="<?php out(date("Y-m-d", strtotime($account['d_date_of_death']))) ?>" name="d_date_of_death" required placeholder="Date of Death*">
                                                </div>
                                                <div class="form-group  py-1">
                                                    <small class="align-left"><i>Goal Amount</i></small>
                                                    <input type="number" class="form-control form-control text-center py-0" value="<?php out($account['d_goal_amount']) ?>" name="d_goal_amount" placeholder="0.00">
                                                </div>
                                                <div class="form-group  py-1">
                                                    <small class="align-left"><i>Goal Expiry Date</i></small>
                                                    <input type="date" class="form-control form-control text-center py-0" value="<?php out(date("Y-m-d", strtotime($account['expiration']))) ?>" name="expiration" min="<?php out($min_expiry_date); ?>" max="<?php out($max_expiry_date); ?>" required placeholder="Expiration*">                                    
                                                </div>
                                                <div class="form-group py-1">
                                                    <small class="align-left"><i>Summary</i></small>
                                                    <textarea cols="30" rows="4" class="form-control form-control text-center py-0" value="<?php out($summary) ?>" name="d_summary" id="d_summary" placeholder=""><?php out($summary) ?></textarea>
                                                </div>
                                                <div class="form-check pt-2 pb-0" id="terms">
                                                    <input type="checkbox" class="form-check-input input-sm" id="agreement" required>
                                                    <small class="form-check-label pt-1 ps-2 align-left" for="agreement">I understand the &nbsp;<a href="/terms-and-conditions" class="no-style">Terms & Conditions</a></small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                      
                                    <button type="submit" id="uploadNewFundBtn" class="btn btn-lavander fw-bold col-12 fs-larger text-uppercase p-2 mt-3 my-2 align-center" >
                                        SUBMIT
                                    </button>
                                    
                                </div>
                            </div>
                        </div>
                    
                    <?php
                    }
                    ?>
                </div>
            </form>
        </div>
    </section>
        
    <!-- Modal here -->
    
    <!-- start Footer Area -->
    <?php include './footer.php' ?>     
    <!-- end Footer Area -->

    <!-- Plugins -->
    <?php include './plugins.php'; ?>
    <!-- Custom Script -->
    <script src="https://abuloy.ph/controllers/my-new-fund.js"></script>
</body>
</html>