<?php
error_reporting(0);
// limit login attempts 3x
if($_SERVER['REQUEST_METHOD'] === "POST"){
    $mysqli = require __DIR__ . "./database.php";

    // $time = time()-30; //30 seconds cool down time
    // $ip_address=getIpAddr(); //store IP Address in variable
    // $countqry = $mysqli->query("SELECT count(*) as total_count FROM abuloy_user_logins WHERE time_count > $time and ip_add='$ip_address'");
    // $check_login_row = $countqry->fetch_assoc($countqry);
    // $total_count=$check_login_row['total_count'];
    // print_r($total_count);
    $email  = $_POST['email'];
    $password  = $_POST['password'];
    $utype = 1;
    $sql = sprintf("SELECT * FROM abuloy_users WHERE email = '$email' AND user_type = $utype");
    
    $result = $mysqli->query($sql);

    $user = $result->fetch_assoc();

    if($user) {
        $uid = $user['id'];
        if(password_verify($_POST['password'], $user['password_hash'])){
            if($user['log_status'] == 0 && $user['email_status'] == 1){
                

                $update_log = $mysqli->prepare("UPDATE abuloy_users SET log_status = 1 WHERE email = '$email'");
                $update_log->execute();
                $login_result = $update_log->affected_rows;
                if($login_result > 0){
                    $delete_log = $mysqli->prepare("DELETE FROM abuloy_user_logins WHERE uid = ?");
                    $delete_log->bind_param('d', $uid);
                    $delete_log->execute();

                    session_start();
                    session_regenerate_id();
                    $_SESSION['user_log'] = $user['log_status'];
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['user_type'] = $user['user_type'];
                    $_SESSION['user_email'] = $user['email'];
                    $_SESSION['user_email_status'] = $user['email_status'];
                    $_SESSION['user_log_status'] = $user['log_status'];
                    header("Location: /");
                    // exit;
                }

                // if($user['log_status']){
            //         // $delete_log = $mysqli->query("DELETE FROM abuloy_user_logins WHERE uid = $uid");
            //         // $delete_log->execute();
            //         $email = $user['email'];
            //         $update_log = $mysqli->prepare("UPDATE abuloy_users SET log_status = 1 WHERE email = '$email'");
            //         $update_log->execute();
            //         $login_result = $update_log->affected_rows;
            //         if($login_result > 0){
            //             header("Location: /");
            //             exit;
            //         }
                    
                // }
            
            }
            elseif($user['log_status'] == 3){
                $_SESSION['error_login'] = 'Your Account is Locked. <br/>To unlocked you may contact us or you can <br/>choose to reset your password <a href="/forgot-password">here</a>';
            }
            elseif($user['log_status'] == 2){
                $_SESSION['error_login'] = 'Email not verified, you may contact us to <br/>verify your account <a href="mailto:information@abuloy.ph">here</a>';
            }else{
                $_SESSION['error_login'] = 'You already logged in.<br/>If your did not do this or something goes wrong <br/>please contact us <a href="mailto:information@abuloy.ph">here</a> immediately';
            }
            
        }
        else{
            $time = time(); //30 seconds cool down time

            $ip_address=getIpAddr(); //store IP Address in variable
            // echo '<br/>ip: ' .$ip_address;
            $user_id = $user['id'];
            // echo '<br/>user_id: ' . $user_id;

            $sql_log = "SELECT * FROM abuloy_user_logins WHERE uid = $user_id";
    
            $result_log = $mysqli->query($sql_log);
            $user_log = $result_log->fetch_assoc();
            $row_cnt = mysqli_num_rows($result_log);
            if($row_cnt > 2) {  
                // $sql_log_count = "SELECT * FROM abuloy_user_logins WHERE uid = $user_id ORDER BY time_count DESC LIMIT 1";
                // $result_log_count = $mysqli->query($sql_log_count);
                // $user_log_count = $result_log_count->fetch_assoc();
                // $time_secs = 30;
                // $time_count = $user_log_count['time_count'];
                // $timer = $time_count + $time_secs;
                // if($timer){
                //     echo 'timer exceeds 30 secs. You may attempt to login again';
                // }
                
                $update_log = "UPDATE abuloy_users SET log_status = 3, email_status = 0 WHERE id = ?";
                $result_update = $mysqli->prepare($update_log);
                $result_update->bind_param('d', $user_id);
                $result_update->execute();
                $_SESSION['error_login'] = 'Opps! You’ve reached the maximum logon attempts.<br/> Your account will be locked.<br/> Do not fear, this is only for security purposes. <br/> To unlocked your account you may contact us <br/>via <a href="mailto:information@abuloy.ph">information@abuloy.ph</a> or you may change <br/>your password by clicking <a href="/forgot-password">here</a>';
            }
            else{
                $insert_log = "INSERT INTO abuloy_user_logins (uid, ip_add, time_count, date_logged) VALUES ('$user_id', '$ip_address', '$time', NOW())";
                $result_insert = $mysqli->query($insert_log);
                $_SESSION['error_login'] = "Login email or password is incorrect";
            }            
        }
    }
    else{
        if($user['email_status'] == 0 && $user['log_status'] == 3){
            $_SESSION['error_login'] = 'Account Locked. Please reset <a href="/forgot-password>here</a>"';
        }
        if($user['email_status'] == 0 && $user['log_status'] == 2){
            $_SESSION['error_login'] = 'Account need to verify first, please check email for instructions';
        }
    }



    // if($total_count == 3){
    //     $_SESSION['error_login'] = "3 Login Attempts! Account Locked. Please try after 30 seconds";
    // }
    // else{
    //     $email = $_POST['email'];
    //     $password = $_POST['password'];

    //     $sql = $mysqli->query("SELECT * FROM abuloy_users  WHERE email = '$email' AND password_hash = '$password'")->num_rows;
        
    //     if(mysqli_num_rows($sql)) {
    //         $delete = $mysqli->query("DELETE FROM abuloy_user_logins WHERE ip_add = '$ip_address'");
    //         echo "Yes!";
    //         // header('Location: /');
    //         // if(password_verify($_POST['password'], $user['password_hash'])){
    //         //     print_r("Yes!");
    //         //     exit;
    //         // }else{
    //         //     print_r("No!");
    //         //     exit;
    //         // }
    //     }else{
    //         $total_count++;
    //         $rem_attm=3-$total_count;
    //         if($rem_attm==0){
    //         $_SESSION['error_login'] = "To many failed login attempts. Please login after 30 sec";
    //         }else{
    //         $_SESSION['error_login'] = "Please enter valid login details.<br/>".$rem_attm." attempts remaining";
    //         }
    //         $try_time=time();
    //         $inser_countqry = $mysqli->query("INSERT INTO  (ip_add,time_count) VALUES ('$ip_address', '$try_time')");
    //     }


    // }

    
}
// else{
   
    // $_SESSION['login_attempts'] +=1;
    // $_SESSION['error_login'] = "No!";
// }

function getIpAddr(){
    if (!empty($_SERVER['HTTP_CLIENT_IP'])){
    $ipAddr=$_SERVER['HTTP_CLIENT_IP'];
    }elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
    $ipAddr=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
    $ipAddr=$_SERVER['REMOTE_ADDR'];
    }
    return $ipAddr;
}

// login query
// if($_SERVER['REQUEST_METHOD'] === "POST") {
//     $mysqli = require __DIR__ . "./database.php";

//     $sql = sprintf("SELECT * FROM abuloy_users
//                     WHERE email = '%s' AND email_status = 1",
//                     $mysqli->real_escape_string($_POST['email']));
    
//     $result = $mysqli->query($sql);

//     $user = $result->fetch_assoc();

//     if($user) {

//         if(password_verify($_POST['password'], $user['password_hash'])){

//             if($user['log_status'] === '3'){
//                 $_SESSION['error_login'] = 'Attempt to login 3 times! <br/>Account is Locked! <br/>Please wait 5 mins to re-login';
//             }
//             elseif($user['log_status'] === '2'){
//                 $_SESSION['error_login'] = 'The email you tried to sign-in need to be verified. <br/>To verify please contact <a href="mailto:information@abuloy.ph">information@abuloy.ph</a>';
//             }
//             elseif($user['log_status'] === '0'){
//                 session_start();
//                 session_regenerate_id();
//                 $_SESSION['user_log'] = $user['log_status'];
//                 $_SESSION['user_id'] = $user['id'];
//                 $_SESSION['user_email'] = $user['email'];
//                 $_SESSION['user_email_status'] = $user['email_status'];

//                 if($_SESSION['user_email_status']){
//                     $email = $user['email'];
//                     $update_log = $mysqli->prepare("UPDATE abuloy_users SET log_status = 1 WHERE email = '$email'");
//                     $update_log->execute();
//                     $login_result = $update_log->affected_rows;
//                     if($login_result > 0){
//                         header("Location: /");
//                         exit;
//                     }
//                 }
//                 else{
//                     // $err_login_msg_2 = "Email Not Verified";
//                     // header('Location: /status/'. $err_login_msg_2);
//                     $_SESSION['error_login'] = 'Email not verified';
//                 }
//             }else{
//                 print_r('You already login to our site with device name:');
//                 echo '<br/>' . gethostbyaddr($_SERVER['REMOTE_ADDR']); 
//                 $MAC = exec('getmac');  
//                 // Storing 'getmac' value in $MAC
//                 $MAC = strtok($MAC, ' ');                
//                 // Updating $MAC value using strtok function, 
//                 // strtok is used to split the string into tokens
//                 // split character of strtok is defined as a space
//                 // because getmac returns transport name after
//                 // MAC address   
//                 echo '<br/>' . "MAC address of Server is: $MAC";
//                 echo '<br/>';
//                 function get_user_browser()
//                 {
//                     $u_agent = $_SERVER['HTTP_USER_AGENT'];        $ub = '';
//                     if(preg_match('/MSIE/i',$u_agent))          {   $ub = "IE browser";     }
//                     elseif(preg_match('/Firefox/i',$u_agent))   {   $ub = "Moxilla Firefox";    }
//                     // elseif(preg_match('/Safari/i',$u_agent))    {   $ub = "Safari"; }
//                     elseif(preg_match('/Chrome/i',$u_agent))    {   $ub = "Chrome browser"; }
//                     elseif(preg_match('/Flock/i',$u_agent)) {   $ub = "Flock";      }
//                     elseif(preg_match('/Opera/i',$u_agent)) {   $ub = "Opera browser";      }
//                     return $ub;
//                 }
//                 echo get_user_browser();
//                 echo '<br/>If you still having problem to login, please contact <a href="mailto:support@abuloy.ph">support@abuloy.ph</a> ';
//                 exit;
//             }            
            
            
//         }else{
//             session_start();
//             session_unset();
//             session_destroy();
//             $_SESSION['login_attempts'] += 1;
//             $_SESSION['error_login'] = "Password is incorrect";
//         }
//     }
    
// }else{
//     $_SESSION['login_attempts'] += 1;
//     $_SESSION['error_log'] = 'No account with that email';
// }
?>
<!DOCTYPE html>
<html lang="en">
<?php
// include_once './global_call.php';
include 'database.php';
include 'head.php';
?>
<!-- register css -->
<!-- <link rel="stylesheet" href="./assets/dist/css/pages/register.css"> -->
</head>
<body>
    <?php include 'header.php'; ?>
    <section id="login" class="">
        <div class="container mx-auto  login-form-height" >
            <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                <div class="d-flex justify-content-center align-items-center pt-5" style="margin: 65px 0">
                    
                                   
                    <form action="" method="post" id="login-form">
                        <?php if(isset($_SESSION['error_login'])){ ?> 
                            <div class="alert alert-danger alert-dismissible fade show text-justify" role="alert">
                                <?= $_SESSION['error_login'] ?>
                                <a type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></a>
                            </div>
                        <?php unset($_SESSION['error_login']);} ?>
                        <h1 class="h3 mb-3 fw-normal hide"><a class="navbar-brand nav-brand-box py-2" href="/"><span class="text-aquamarine text-underline fw-700 fs-larger ms-2">Abuloy</span></a></h1>
                        <p class="mt-5 text-muted"></p>
                        <div class="form-row lavander-form">
                            <div class="col">
                                <input type="email" name="email" id="email" value="<?php htmlspecialchars($_POST['email'] ?? "") ?>" class="form-control my-3" placeholder="Email Address" required>
                            </div>
                            <div class="col">
                                <input type="password" name="password" id="password" value="<?php htmlspecialchars($_POST['password'] ?? "") ?>" class="form-control my-3" placeholder="Password" required>
                            </div>
                        </div>
                        <div class="submit-btn text-center mb-5">
                            <button type="submit" name="login_account" class="btn btn-lavander text-white text-uppercase fs-large py-2 text-dark px-5">Login</button><br/>                            
                        </div>
                        <small><a href="/forgot-password" class="text-left no-style">Forgot Password?</a></small><br/>
                        <small class="text-blackish">If you don't have any account? <a href="/register" class="no-style text-lavander">Sign-up</a></small>
                        <!-- <div class="gfm-embed" data-url="https://www.gofundme.com/f/ukraine-humanitarian-fund/widget/large/"></div>
                        <script defer src="https://www.gofundme.com/static/js/embed.js"></script> -->
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- start Footer Area -->
    <?php include 'footer.php' ?>     
    <!-- end Footer Area -->

    <!-- Plugins -->
    <?php include 'plugins.php'; ?>
    <!-- Custom Script -->
    <!-- <script src="controllers/register.js"></script> -->
</body>
</html>