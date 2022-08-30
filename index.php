<?php

session_start();
require "global_call.php";
if(isset($_SESSION['user_id'])) {
    
    $mysqli = require __DIR__ . "/database.php";

    $sql = "SELECT * FROM abuloy_users
            WHERE id = " . $_SESSION['user_id'] ." AND email_status = 1";

    $result = $mysqli->query($sql);

    $user = $result->fetch_assoc();
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
    
    <section class="mt-5 pt-5">
        
        <?php 
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
        

        if($user['user_type'] === '0'){ 
            $ipAddress = getIpAddr();
            print_r($ipAddress);
            ?>
            <p>Hello <?= htmlspecialchars(ucwords($user['firstname'])) ?> <?= htmlspecialchars(ucwords($user['lastname'])) ?>.</p>
            <p>UserType: <?= $user['user_type'] ?></p>
            <p>Email Status: <?= $user['email_status'] ?></p>
            <p><a href="/logout">Log out</a></p>
        <?php }elseif($user['user_type']  === '1'){ ?>
            <p>Hello <?= htmlspecialchars(ucwords($user['firstname'])) ?> <?= htmlspecialchars(ucwords($user['lastname'])) ?>.</p>
            <p>UserType: <?= $user['user_type'] ?></p>
            <p>Email Status: <?= $user['email_status'] ?></p>
        <?php }else{ ?>
            
            <p>UserType: <?= $user['firstname'] ?></p>
            <p>Email Status: <?= $user['email_status'] ?></p>
        <?php } ?>
            
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