<?php 
// session_set_cookie_params(0);
session_start();
error_reporting(0);

require "database.php";

$uid = $_SESSION['user_id'];
// $token = $_SESSION['user_token'];


$today = date('Y-m-d');
$min_goal_days = "1 days";
$min_goal_date = date_create($today);
date_add($min_goal_date,date_interval_create_from_date_string($min_goal_days));
$min_expiry_date = date_format($min_goal_date,"Y-m-d");

$max_goal_days = "30 days";
$max_goal_date = date_create($min_expiry_date);
date_add($max_goal_date,date_interval_create_from_date_string($max_goal_days));
$max_expiry_date = date_format($max_goal_date,"Y-m-d");


// Upload Photo
//file input variables
$img_name = $_FILES['avatar']['name'];
$img_size = $_FILES['avatar']['size'];
$tmp_name = $_FILES['avatar']['tmp_name'];
$error = $_FILES['avatar']['error'];

if($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['create_fund'])){
    
    $email = $_POST['email'];
    $d_firstname = $_POST['d_firstname'];
    $d_middlename = $_POST['d_middlename'];
    $d_lastname = $_POST['d_lastname'];
    $d_birthdate = $_POST['d_birthdate'];
    $d_date_of_death = $_POST['d_date_of_death'];
    $d_summary = $_POST['d_summary'];
    $d_goal_amount = $_POST['d_goal_amount'];
    $expiration = $_POST['expiration'];
    $token = $_POST['csrf'];

    if(empty($d_firstname)){
        $_SESSION['error_fund'] = "First Name is required";        
    }

    if(empty($d_lastname)){
        $_SESSION['error_fund'] = "Last Name is required";        
    }

    if(empty($d_birthdate)){
        $_SESSION['error_fund'] = "Birth date is required";        
    }

    if(empty($d_date_of_death)){
        $_SESSION['error_fund'] = "Date of death is required";        
    }

    if(empty($d_summary)){
        $_SESSION['error_fund'] = "Summary is required";        
    }

    if(empty($d_goal_amount)){
        $_SESSION['error_fund'] = "Goal amount is required";        
    }

    if(empty($expiration)){
        $_SESSION['error_fund'] = "Goal expiration is required";        
    }
  
    // variables
    $utype = 1;
    $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';    
    // Shuffle the $str_result and returns substring
    // of specified length
    $short_code = substr(str_shuffle($str_result), 0, 7);
    $url_link = 'https://abuloy.ph/donate/'.$short_code;
    $date_created = date('Y-m-d H:i:s');

    // Check Fund Name
    $check_fund = $mysqli->query("SELECT * FROM abuloy_accounts WHERE abuloy_accounts WHERE d_firstname = '$d_firstname' AND d_middlename = '$d_middlename' AND d_lastname = '$d_lastname'")->num_rows;
    if($check_fund > 0) {
        $_SESSION['error_reg'] = "Fund for ".$d_firstname." ".$d_middlename." ".$d_lastname." was already created.";
    }
    else{    
        // Upload Photo        
        if($error === 0){
            if($img_size > 100000000){
                $_SESSION['error_fund'] = "Sorry, your file is too large";
            }
            else{
                $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                $img_ex_lc = strtolower($img_ex);

                $allowed_exs = array('jpg', 'jpeg', 'png');

                if(in_array($img_ex_lc, $allowed_exs)){
                    $img_date = date("Ymd");
                    $avatar = uniqid("abuloy_img_".$img_date, true).'.'.$img_ex_lc;
                    $img_upload_path = 'assets/uploads/'.$avatar;
                    move_uploaded_file($tmp_name, $img_upload_path);

                    // Insert into database
                    $sql = $mysqli->query("INSERT INTO abuloy_accounts 
                        (uid,
                        utype,
                        email,
                        d_firstname,
                        d_middlename,
                        d_lastname,
                        d_birthdate,
                        d_date_of_death,
                        d_goal_amount,
                        d_summary,
                        avatar,
                        url_link,
                        short_code,
                        token,
                        expiration,
                        date_created
                        ) 
                        VALUES 
                        ('$uid',
                        '$utype',
                        '$email',
                        '$d_firstname',
                        '$d_middlename',
                        '$d_lastname',
                        '$d_birthdate',
                        '$d_date_of_death',
                        '$d_goal_amount',
                        '$d_summary',
                        '$avatar',
                        '$url_link',
                        '$short_code',
                        '$token',
                        '$expiration',
                        NOW())");
                    
                    header("Location: start-new-fund-verification/$token");
                    exit;
                }
                else{
                    $_SESSION['error_fund'] = "You can't upload files of this type!";
                }
            }
        }
        else{
            $_SESSION['error_fund'] = "Unknown error occurred!";
        }
    }
        // if($error === 0){
        //     if($img_size > 150000000){
        //         $_SESSION['error_fund'] = "Sorry, your file is too large";
        //     }
        //     else{
        //         $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
        //         $img_ex_lc = strtolower($img_ex);

        //         $allowed_exs = array('jpg', 'jpeg', 'png');

        //         if(in_array($img_ex_lc, $allowed_exs)){
        //             $avatar = uniqid("abuloy_img_", true).'.'.$img_ex_lc;
        //             $img_upload_path = $_SERVER['DOCUMENT_ROOT'].'/assets/uploads/'.$avatar;
        //             move_uploaded_file($tmp_name, $img_upload_path);

        //             // Insert into database
        //             $insert_qry = $mysqli->prepare("INSERT INTO abuloy_accounts (uid,utype,email,d_firstname,d_middlename,d_lastname,d_birthdate,d_date_of_death,d_goal_amount,d_summary,avatar,url_link,short_code,token,expiration,date_created) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) WHERE token = '$token')");
        //             $insert_qry->bind_param("ssssssssssssssss",
        //                 $uid,
        //                 $utype,
        //                 $email,
        //                 $d_firstname,
        //                 $d_middlename,
        //                 $d_lastname,
        //                 $d_birthdate,
        //                 $d_date_of_death,
        //                 $d_goal_amount,
        //                 $d_summary,
        //                 $avatar,
        //                 $url_link,
        //                 $short_code,
        //                 $token,
        //                 $expiration,
        //                 $date_created);
        //             $insert_qry->execute();
        //             $insert_qry->store_result();
        //             $count = $insert_qry->affected_rows;

        //             if($count > 0){     
                        
        //                 $sql = sprintf("SELECT * FROM abuloy_accounts WHERE token = '$token'");
    
        //                 $result = $mysqli->query($sql);
            
        //                 $account = $result->fetch_assoc();
        //                 if($account){
        //                     // after inserting get the email from database through select and send it!
        //                     // sendEmailVerification($token, $otp, $email, $firstname);
        //                     // re-direct to login-verification
        //                     header("Location: start-new-fund-verification/$token");
        //                     exit;
            
        //                 }                        
        //             }
        //         }
        //         else{
        //             $_SESSION['error_fund'] = "You can't upload files of this type!";
        //         }
        //     }
        // }
        // else{
        //     $_SESSION['error_fund'] = "Unknown error occurred when upload!";
        // }
    // }
    // else{

    //     $_SESSION['error_fund'] = "Session Timeout";

    // }

    
}

?>
<!DOCTYPE html>
<html lang="en">
<?php
include 'head.php';
?>
</head>
<body>
    <?php 
    // if($_SERVER['REQUEST_METHOD'] === "GET" && isset($uid)){
        $stmt = $mysqli->prepare("SELECT * FROM abuloy_users WHERE id = ?");
        $stmt->bind_param('d', $uid);
        $result = $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $email = $user['email'];
        $userid = $user['id'];
        // generate session again
        // session_regenerate_id();
        if(isset($user)){
            include 'header-user.php';
    ?>
        <section id="register" class="my-5 pt-5">    
            <div class="d-flex justify-content-center px-3">
                <div class="col-lg-12 container">
                    <div class="bg-white shadow align-m px-2 py-4">
                        <form action="" id="" method="POST" autocomplete="off" class="needs-validation" enctype="multipart/form-data">
                            <legend class="text-lavander text-center fw-bold pt-0">Create A Fund</legend>
                            <p class="text-blackish text-center align-m"><small><i>Please fill up the form with the correct details of the deceased</i></small></p>
                            <?php if(isset($_SESSION['error_fund'])){ ?> 
                                <div class="alert alert-danger alert-dismissible fade show text-justify" role="alert">
                                    <?= $_SESSION['error_fund'] ?>
                                    <a type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></a>
                                </div>
                            <?php unset($_SESSION['error_fund']);} ?>
                            <div class="form-row col-md-12 lavander-form mx-auto">
                                <div class="col-lg-4 col-md-6 col-sm-12 mx-auto mb-3 px-lg-5">
                                    <div class="bg-white shadow">
                                        <?php if($img_name == ''){ $no_image = 'https://abuloy.ph/assets/uploads/no-photo-available.png'; ?>
                                            <input type="file" id="file-upload" name="avatar" class="btn btn-lavander" onchange="displayImg(this,$(this))" />
                                            <img src="<?php echo isset($img_name) ? 'https://abuloy.ph/assets/uploads/'.$img_name : $no_image ?>" alt="" id="photo_upload" class="new-fund-photo img-fluid img-thumbnail mx-auto align-center" style="width:70%; height: 100%; object-fit: contain">
                                        <?php }else{ ?>
                                            <img src="<?php echo isset($img_name) ? 'https://abuloy.ph/assets/uploads/'.$img_name : $no_image ?>" alt="" id="photo_upload" class="new-fund-photo img-fluid img-thumbnail mx-auto align-center" style="width:70%; height: 100%; object-fit: contain">
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12 mx-auto">                               
                                    <div class="form-group  my-3 py-1">
                                        <?php set_csrf(); ?>
                                        <input type="hidden" class="form-control text-center" value="<?php out($userid); ?>" name="uid" required placeholder="">
                                        <input type="hidden" class="form-control text-center" value="<?php out($email); ?>" name="email" required placeholder="">
                                        <small class="align-left text-lavander"><i>First Name*</i></small>
                                        <input type="text" class="form-control form-control text-center" name="d_firstname" required placeholder="">
                                    </div>
                                    <div class="form-group  my-3 py-1">
                                        <small class="align-left text-lavander"><i>Middle Name*</i></small>
                                        <input type="text" class="form-control form-control text-center" name="d_middlename" placeholder="">
                                    </div>
                                    <div class="form-group  my-3 py-1">
                                        <small class="align-left text-lavander"><i>Last Name*</i></small>
                                        <input type="text" class="form-control form-control text-center" name="d_lastname" required placeholder="">
                                    </div>
                                    <div class="form-group  my-3 py-1">
                                        <small class="align-left text-lavander"><i>Birth Date*</i></small>
                                        <input type="date" class="form-control form-control text-center" name="d_birthdate" required placeholder="">
                                        
                                    </div>
                                    <div class="form-group  my-3 py-1">
                                        <small class="align-left text-lavander"><i>Date of Death*</i></small>
                                        <input type="date" class="form-control form-control text-center" name="d_date_of_death" required placeholder="">
                                    </div>
                                    <div class="form-group my-3 py-3">
                                        <small class="align-left text-lavander">Tell his/her story. What happened?</small>
                                        <textarea cols="30" rows="10" class="form-control form-control text-center" style="border: 1px solid #A265E6;border-radius:0" name="d_summary" required placeholder=""></textarea>
                                    </div>
                                    <div class="form-group  my-3 py-1">
                                        <small class="align-left text-lavander"><i>Goal Amount*</i></small>
                                        <div class="input-group phone-input-group px-0 mx-0  my-3 py-1">                                    
                                            <span class="input-group-text phone-input-group-text" style="">&nbsp; <i class="fa-solid fa-peso-sign"></i> &nbsp;</span>
                                            <input type="number" class="form-control form-control text-center" name="d_goal_amount" placeholder="0.00">
                                            <!-- <input type="text" id="mobile" name="mobile" class="form-control" maxlength="10" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required placeholder=""> -->
                                        </div>
                                    </div>
                                    <div class="form-group  my-3 py-1">
                                        <small class="align-left text-lavander"><i>Goal Expiration*</i></small>
                                        <input type="date" class="form-control form-control text-center" name="expiration" min="<?php out($min_expiry_date); ?>" max="<?php out($max_expiry_date); ?>" required placeholder="">                                    
                                    </div>
                                </div>
                                <!-- <div class="col-lg-4 col-md-6 col-sm-12 mx-auto py-3">
                                    <div class="form-check pt-2 pb-0" id="terms">
                                        <input type="checkbox" class="form-check-input" id="agreement" required>
                                        <label class="form-check-label pt-1 ps-2 align-left" for="agreement">I agree to &nbsp;<a href="/terms-and-conditions" class="no-style">Terms & Conditions</a></label>
                                    </div>
                                </div> -->
                            </div>
                            <hr>
                            <div class="col-12 text-right justify-content-center d-flex">
                                <button type="submit" name="create_fund" class="btn btn-primary me-2">Submit</button>
                                <button class="btn btn-secondary" type="button" onclick="location.href = '/'">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    <?php
        }
    // }
    
    ?>

<?php include 'footer.php' ?>     
<!-- end Footer Area -->

<!-- Plugins -->
<?php include 'plugins.php'; ?>
<!-- Custom Script -->
<script>
    function displayImg(input,_this) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#photo_upload').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

</script>
</body>
</html>