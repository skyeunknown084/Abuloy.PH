<?php
session_start();
error_reporting(0);   
?>
<!DOCTYPE html>
<html lang="en">
<?php include './head_views.php'; ?>
<body>
    
    <?php
    require "./global_call.php";
    require "./database.php";
    $userid = $_SESSION['user_id'];
    $usertype = $_SESSION['user_type'];

    if(isset($usertype) == 1){
        $sql = "SELECT * FROM abuloy_users WHERE user_type = 1 AND log_status = 1";
        $result = $mysqli->query($sql);
        $user = $result->fetch_assoc();
        // generate session again
        session_regenerate_id();
        include 'header-user.php';
    }
    else{
      include 'header.php';
      session_unset();
      session_destroy();
    }

    ?>

<?php
if(isset($_SESSION['user_id'])){
?>
<section class="py-5" id="">
    <div class="container py-5">
        <div class="row banner-content fullscreen align-items-center justify-content-start pb-4">
            <div class=" col-lg-7 col-md-6 col-sm-12 p-0 mb-4">
                <div class="col-lg-12 pt-5 ps-5">
                    <h3 class="text-blackish fw-700 block pt-5 pe-2">
                        <i>Hi <span class="text-lavander"><?php echo ucwords($user['firstname']) ?>! </span></i>
                    </h3>
                    <?php 
                        $user_id = $user['id'];
                        $userqry = $mysqli->prepare("SELECT * FROM  abuloy_accounts WHERE uid = $user_id");
                        $user_stmt = $userqry->execute();
                        $user_result = $userqry->get_result();
                        if($user_row = $user_result->fetch_assoc()){
                        $id = $user_row['id'];
                        $fname = $user_row['d_firstname'];
                        $mname = $user_row['d_middlename'];
                        $lname = $user_row['d_lastname'];
                            if($id == ''){
                            ?>
                                <div class="pe-5 pt-0"><h5 class="pe-5 pt-0 mt-0 text-blackish">You haven't raised a fund yet.</h5></div>
                                <br/>
                                <div class="pe-5 pt-0"><h5 class="pe-5 pt-0 mt-0">Click the button below to create your first fund now! </h5></div>
                                <a href="/start-new-fund" class="btn btn-lavander btn-round text-uppercase" id="showFundForm">Start A Fund <i class="fas fa-chevron-right"></i><i class="fas fa-chevron-right"></i> </a>                    
                            <?php    
                            }
                            elseif($id == 1){
                            ?>
                                <div class="pe-5 pt-0"><h4 class="pe-5 pt-0 mt-0 text-blackish">You successfully raised your first fund for <span class="text-lavander"><?= $fname ?> <?= $mname ?> <?= $lname ?></span></h4></div>
                                <br/>
                                <div class="pe-5 pt-0"><h5 class="pe-5 pt-0 mt-0">Click button below to see your funds now! </h5></div>
                                <a href="/start-new-fund" class="btn btn-lavander btn-round text-uppercase" id="showFundForm">Go To My Fund <i class="fas fa-chevron-right"></i><i class="fas fa-chevron-right"></i> </a>                    
                            <?php 
                            }
                        }
                        ?>
                    
                </div>                             
            </div>
            <div class="banner-img-container row align-items-center col-lg-5 col-md-6 col-sm-12 pt-5 pb-100 m-0 px-0 mx-0" id="fundForm">                
                <a href="/profile_list" class="donate-btn btn btn-aquamarine btn-lg-round text-lavander fw-700 fs-larger text-uppercase col-lg-6 col-md-6 col-sm-4 mx-auto my-0  px-0 mx-0" style="position:relative;bottom:-40vh;border-radius:25px;cursor:pointer;box-shadow:2px 2px 2px 2px" id="showFundForm">Donate Now <i class="fas fa-donate ps-2"></i> </a>
                <a href="/profile_list" class="col-lg-12 img-banner img-fluid m-0 bg-white  px-0 mx-0">
                    <img src="assets/img/banner-illustration-php.png" alt="" class="img-fluid col-lg-12 my-0  px-0 mx-0" style="height:55vh !important;">
                </a>                
            </div>  
        </div>
        </div>
</section>
<?php
}
?>