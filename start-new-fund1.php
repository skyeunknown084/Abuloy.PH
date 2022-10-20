<?php
session_start();
// error_reporting(0);
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

      require "./global_call.php";
      require "./database.php";

      $uid = $_SESSION['user_id'];

      

    //   if($_SERVER['REQUEST_METHOD'] === "POST" && isset($uid)){
                
    //     $stmt = $mysqli->prepare("SELECT * FROM abuloy_users WHERE id = ?");
    //     $stmt->bind_param('d', $uid);
    //     $result = $stmt->execute();
    //     $result = $stmt->get_result();
    //     $user = $result->fetch_assoc();
    //     // generate session again
    //     // session_regenerate_id();
    //     if(isset($user)){
    //       $qry = $mysqli->query("SELECT * FROM abuloy_accounts where uid = ".$user['id'])->fetch_array();
          
    //       foreach($qry as $k =>  $v){
    //         $$k = $v;
    //       }
    //       // fomulate Goal Date for max date of up to 1 month only
    //       $today = date('Y-m-d');
    //       $min_goal_days = "1 days";
    //       $min_goal_date = date_create($today);
    //       date_add($min_goal_date,date_interval_create_from_date_string($min_goal_days));
    //       $min_expiry_date = date_format($min_goal_date,"Y-m-d");

    //       $max_goal_days = "30 days";
    //       $max_goal_date = date_create($min_expiry_date);
    //       date_add($max_goal_date,date_interval_create_from_date_string($max_goal_days));
    //       $max_expiry_date = date_format($max_goal_date,"Y-m-d");

    //       include 'header-user.php';  
    //       ?>
    //       <section id="register pt-0" class="my-5 pt-5">    
    //         <div class="d-flex justify-content-center px-3 py-0">
    //             <div class="col-lg-12 container">
    //                 <div class="bg-white shadow align-m px-2 py-4">
    //                     <!-- <div class="card-body"> -->
    //                         <form action="" id="create_new_fund" method="POST" class="lavander-form">
    //                             <legend class="text-lavander text-center fw-bold pt-0">Create A Fund</legend>
    //                             <p class="text-blackish text-center align-m"><small><i>Please fill up the form with the correct details of the deceased</i></small></p>
    //                             <?php set_csrf(); ?>
    //                             <div class="form-row col-md-12 mx-auto">
    //                                 <?php if(isset($_SESSION['error_fund'])){ ?> 
    //                                     <div class="alert alert-danger alert-dismissible fade show text-justify" role="alert">
    //                                         <?= $_SESSION['error_fund'] ?>
    //                                         <a type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></a>
    //                                     </div>
    //                                 <?php unset($_SESSION['error_fund']);} ?>
    //                                 <div class="form-group hide" >
    //                                     <input type="text" name="uid" value="<?php out($uid) ?>">
    //                                 </div>
    //                                 <div class="col-lg-4 col-md-6 col-sm-12 mx-auto">
    //                                     <div class="form-group hide">
    //                                         <label for="" class="control-label hide">User Role</label>
    //                                         <input type="hidden" name="type" value="2">                                    
    //                                     </div>                                 
    //                                     <div class="form-group py-3">
    //                                         <label class="control-label hide">FirstName</label>
    //                                         <input type="text" class="form-control form-control text-center" name="d_firstname" required placeholder="First Name*">
    //                                         <small id="#msg"></small>
    //                                     </div>
    //                                     <div class="form-group py-3">
    //                                         <label class="control-label hide">MiddleName</label>
    //                                         <input type="text" class="form-control form-control text-center" name="d_middlename" placeholder="Middle Name*">
    //                                         <small id="#mn_msg"></small>
    //                                     </div>
    //                                     <div class="form-group py-3">
    //                                         <label class="control-label hide">LastName</label>
    //                                         <input type="text" class="form-control form-control text-center" name="d_lastname" required placeholder="Last Name*">
    //                                         <small id="#ln_msg"></small>
    //                                     </div>
    //                                     <div class="form-group py-3">
    //                                         <label class="control-label hide">BirthDate</label>
    //                                         <input type="date" class="form-control form-control text-center" name="d_birthdate" required placeholder="Birth Date*">
                                            
    //                                     </div>
    //                                     <div class="form-group py-3">
    //                                         <label class="control-label hide">Date of Death</label>
    //                                         <input type="date" class="form-control form-control text-center" name="d_date_of_death" required placeholder="Date of Death*">
                                            
    //                                     </div>
    //                                     <div class="form-group py-3">
    //                                         <label class="control-label">Tell his/her story. What happened?</label>
    //                                         <textarea cols="30" rows="10" class="form-control form-control text-center" name="d_summary" required placeholder=""></textarea>
    //                                     </div>
    //                                 </div>
    //                                 <div class="col-lg-4 col-md-6 col-sm-12 mx-auto py-3">
    //                                     <div class="form-group  py-3">
    //                                         <label class="control-label text-center">Goal Amount</label>
    //                                         <input type="number" class="form-control form-control text-center" name="d_goal_amount" placeholder="0.00">
    //                                     </div>
    //                                 </div>
    //                                 <div class="col-lg-4 col-md-6 col-sm-12 mx-auto py-3">
    //                                     <div class="form-group  py-3">
    //                                         <label class="control-label text-center">Goal Expiry Date</label>
    //                                         <input type="date" class="form-control form-control text-center" name="expiration" min="<?php out($min_expiry_date); ?>" max="<?php out($max_expiry_date); ?>" required placeholder="Expiration*">                                    
    //                                     </div>
    //                                 </div>
    //                                 <div class="col-lg-4 col-md-6 col-sm-12 mx-auto py-3">
    //                                     <div class="form-check pt-2 pb-0" id="terms">
    //                                         <input type="checkbox" class="form-check-input" id="agreement" required>
    //                                         <label class="form-check-label pt-1 ps-2 align-left" for="agreement">I agree to Abuloy.PH &nbsp;<a href="/terms-and-conditions" class="no-style">Terms & Conditions</a></label>
    //                                     </div>
    //                                 </div>
    //                             </div>
    //                             <hr>
    //                             <div class="col-12 text-right justify-content-center d-flex">
    //                                 <button type="submit" class="btn btn-primary me-2">Save</button>
    //                                 <button class="btn btn-secondary" type="button" onclick="location.href = '/'">Cancel</button>
    //                             </div>
    //                         </form>
    //                     <!-- </div> -->
    //                 </div>
    //             </div>
    //         </div>              
    //       </section>
    //       <?php
    //     }
    //   }
    //   else{
        include 'header.php';          
        include 'views/start-new-fund-content.php';          
    //   }

      // if($_SERVER['REQUEST_METHOD'] === "POST"){
        
      //   out($_POST['csrf']);
      //   out($_POST['d_middlename']);
      //   out($_POST['d_lastname']);
      //   out($_POST['d_birthdate']);
      //   out($_POST['d_date_of_death']);
      //   out($_POST['d_summary']);
      //   out($_POST['d_goal_amount']);
      //   out($_POST['expiration']);
      // }

    ?>
    <h1><?php out($uid); ?></h1>
    <!-- start Footer Area -->
    <?php include 'footer.php' ?>     
    <!-- end Footer Area -->

    <!-- Plugins -->
    <?php include 'plugins.php'; ?>
    <!-- Custom Script -->
    <script src="controllers/start-new-fund.js"></script>
</body>
</html>