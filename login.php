<?php
$is_invalid = false;
// login query




if($_SERVER['REQUEST_METHOD'] === "POST") {
    $mysqli = require __DIR__ . "./database.php";

    $sql = sprintf("SELECT * FROM abuloy_users
                    WHERE email = '%s' AND log_status = 0",
                    $mysqli->real_escape_string($_POST['email']));
    
    $result = $mysqli->query($sql);

    $user = $result->fetch_assoc();

    if($user) {

        if(password_verify($_POST['password'], $user['password_hash'])){

            if($user['log_status'] == 3){
                print_r('Attempt to login 3 times! <br/>Account is Locked! <br/>Please wait 5 mins to re-login');
                exit;
            }
            elseif($user['log_status'] == 0){
                session_start();
                session_regenerate_id();
                $_SESSION['user_log'] = $user['log_status'];
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_email_status'] = $user['email_status'];

                if($_SESSION['user_email_status'] && $user['log_status'] == 0){
                    header("Location: /");
                    exit;
                }
                else{
                    // $err_login_msg_2 = "Email Not Verified";
                    // header('Location: /status/'. $err_login_msg_2);
                    print_r('Email not verified');
                    exit;
                }
            }else{
                print_r('You already login to our site with device name:');
                echo '<br/>' . gethostbyaddr($_SERVER['REMOTE_ADDR']); 
                $MAC = exec('getmac');  
                // Storing 'getmac' value in $MAC
                $MAC = strtok($MAC, ' ');                
                // Updating $MAC value using strtok function, 
                // strtok is used to split the string into tokens
                // split character of strtok is defined as a space
                // because getmac returns transport name after
                // MAC address   
                echo '<br/>' . "MAC address of Server is: $MAC";
                exit;
            }            
            
            
        }else{
            session_start();
            session_unset();
            session_destroy();
            print_r("Password is incorrect");
            exit;
        }

    }
    
    $is_invalid = true;
}else{
    $_SESSION['error_login'] = 'No account with that email';
}
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
                    <span class="hide"> <?php if($is_invalid): ?> <em>Invalid Login</em><?php endif ?></span> 
                                   
                    <form action="" method="post" id="login-form">
                    <h1 class="h3 mb-3 fw-normal hide"><a class="navbar-brand nav-brand-box py-2" href="/"><span class="text-aquamarine text-underline fw-700 fs-larger ms-2">Abuloy</span></a></h1>
                    <p class="mt-5 text-muted"></p>
                        <div class="form-row lavander-form">
                            <div class="col">
                            <input type="email" name="email" id="email" value="<?php htmlspecialchars($_POST['email'] ?? "") ?>" class="form-control my-3" placeholder="Email Address" required>
                            </div>
                            <div class="col">
                            <input type="password" name="password" id="password" class="form-control my-3" placeholder="Password" required>
                            </div>
                        </div>
                        <div class="submit-btn text-center mb-5">
                            <button type="submit" name="login_account" class="btn btn-lavander text-white text-uppercase fs-large py-2 rounded-pill text-dark px-5">Login</button>
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