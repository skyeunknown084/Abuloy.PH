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
    
    <main>
        <?php 
        if($user['user_type'] === '0'){ 
            include 'views/dashboard-admin.php';
        }elseif($user['user_type'] === '1'){ 
            include 'views/dashboard-user.php';
        }else{
            include 'views/dashboard.php';
        }
        ?>
    </main>
    
    <!-- start Footer Area -->
    <?php include 'footer.php' ?>     
    <!-- end Footer Area -->

    <!-- Plugins -->
    <?php include 'plugins.php'; ?>
    <!-- Custom Script -->
    <!-- <script src="controllers/register.js"></script> -->
</body>
</html>