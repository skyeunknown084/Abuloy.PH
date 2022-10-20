<?php 
session_start();
error_reporting(0);
// if(!isset($_SESSION['login_id']))
// header('location:login.php');
include 'db_connect.php';
ob_start();
// Get System Datas
if(!isset($_SESSION['system'])){
    $system = $conn->query("SELECT * FROM system_settings")->fetch_array();
    foreach($system as $k => $v){
        $_SESSION['system'][$k] = $v;
    }
    
}else {
    $system = $conn->query("SELECT * FROM system_settings")->fetch_array();
    foreach($system as $k => $v){
    $_SESSION['system'][$k] = $v;
    }
}
if(!isset($_SESSION['account'])){
    $account = $conn->query("SELECT * FROM accounts")->fetch_array();
    foreach($system as $k => $v){
    $_SESSION['account'][$k] = $v;
    }
    
}else {
    $account = $conn->query("SELECT * FROM accounts")->fetch_array();
    foreach($system as $k => $v){
    $_SESSION['account'][$k] = $v;
    }
}
if(!isset($_SESSION['user'])){
    $user = $conn->query("SELECT * FROM users")->fetch_array();
    foreach($system as $k => $v){
    $_SESSION['user'][$k] = $v;
    }
    
}else {
    $user = $conn->query("SELECT * FROM users")->fetch_array();
    foreach($system as $k => $v){
    $_SESSION['user'][$k] = $v;
    }
}
if(!isset($_SESSION['gpay'])){
    $gpay = $conn->query("SELECT * FROM gcash_payments")->fetch_array();
    foreach($gpay as $k => $v){
    $_SESSION['gpay'][$k] = $v;
    }
    
}else {
    $gpay = $conn->query("SELECT * FROM gcash_payments")->fetch_array();
    foreach($gpay as $k => $v){
    $_SESSION['gpay'][$k] = $v;
    }
}
    
    
// Get User Datas
ob_end_flush();
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://ogp.me/ns/fb#">
<?php include 'header.php' ?>
<body>
    <!-- start header Area -->
    <header class="default-header">
        <nav class="navbar navbar-expand-lg navbar-light bg-white bb-aquamarine d-flex fixed-top nav-shadow">
            <div class="container-fluid">
                <a class="navbar-brand nav-brand-box ms-2" href="./index.php?page=home"><span class="text-aquamarine text-underline fw-700 fs-larger ms-2">
                <?php echo ucwords($_SESSION['system']['name']) ?>
                </span></a>
                <button class="navbar-toggler ms-auto" type="button" data-toggle="collapse" data-target="#toggleNavbar" aria-controls="toggleNavbar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <?php include 'navbar.php' ?>
            </div>
        </nav>
    </header>
    <!-- end header Area -->
    <!-- start section Area -->    
    <?php
        $page = isset($_GET['page']) ? $_GET['page'] : 'home';
            if(!file_exists($page.".php")){
                include '404.html';
                
            }else{
                include $page.'.php';
            }
    ?>
    <!-- end section Area -->
    
    <footer class="page-footer font-small text-blackish bg-aquamarine">
        <div class="container">
            <div class="row pb-3 pt-4">
                <div class="col-md-12">
                    <div class="mb-3 flex-center align-center text-lavander">
                        <a class="fb-ic" href="https://www.facebook.com/Abuloy-101224709138256">
                            <i class="fab fa-facebook-f fa-lg text-lavander me-4"> </i>
                        </a>
                        <a class="tw-ic">
                            <i class="fab fa-twitter fa-lg text-lavander me-4"> </i>
                        </a>
                        <a class="gplus-ic">
                            <i class="fab fa-google-plus-g fa-lg text-lavander me-4"> </i>
                        </a>
                        <a class="li-ic">
                            <i class="fab fa-linkedin-in fa-lg text-lavander me-4"> </i>
                        </a>
                        <a class="ins-ic">
                            <i class="fab fa-instagram fa-lg text-lavander me-4"> </i>
                        </a>
                        <a class="pin-ic">
                            <i class="fab fa-pinterest fa-lg text-lavander"> </i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row text-center d-flex justify-content-center pt-3 mb-3 hide">
                <!-- Grid column -->
                <div class="col-md-2 mb-1">
                    <h6 class="text-uppercase font-weight-bold">
                        <a href="#!">About us</a>
                    </h6>
                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-2 mb-3">
                    <h6 class="text-uppercase font-weight-bold">
                        <a href="#!">Start A Fund</a>
                    </h6>
                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-2 mb-3">
                    <h6 class="text-uppercase font-weight-bold">
                        <a href="#!">Donate</a>
                    </h6>
                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-2 mb-3">
                    <h6 class="text-uppercase font-weight-bold">
                        <a href="#!">Contact</a>
                    </h6>
                </div>
                <!-- Grid column -->
            </div>
            <hr class="rgba-white-light bg-lavender text-white" style="margin: 0 1%;padding:0.5px 0;" />
            <div class="row d-flex text-center justify-content-center mb-md-0 pt-2 pb-4">
                <div class="col-md-10 col-lg-8 col-xl-8 mx-auto mt-4">
                    <p>
                    <i class="fas fa-map-signs me-3"></i> 
                    <a class="text-b-lavander no-style" href="https://www.google.com/maps/place/City+Chapels+-+Sto.+Tomas/@14.1015144,121.1434893,17z/data=!3m1!4b1!4m5!3m4!1s0x33bd658d7dc507ed:0xb487e56f1d1e6831!8m2!3d14.1015092!4d121.145678" target="_blank">City Chapels Inc., General Malvar Avenue, <br>Barangay San Roque, Santo Tomas City, Batangas, Philippines, 4234 </a></p>                   
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

                </div>
            </div>
            <hr class="clearfix d-md-none rgba-white-light hide" style="margin: 10% 15% 5%;" />            
        </div>
        <div class="footer-copyright text-center text-white bg-lavander py-3">© 2021 Copyright
            <a href="https://abuloy.ph/" class="text-aquamarine" > <i class="fa fa-heart" aria-hidden="true"></i> Abuloy.ph</a>
            <a href="index.php?page=terms-and-conditions" class="text-w-aquamarine pt-3 text-center no-style">Terms of Services</a>
        </div>
    </footer>
    <!-- start Footer Area -->
    <?php include 'views/layout/footer.php' ?>    
    <!-- end Footer Area -->
</body>
</html>