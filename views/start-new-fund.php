<?php

session_start();
require "./global_call.php";
if(isset($_SESSION['user_id'])) {
    
    $mysqli = require "./database.php";

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
include './head_views.php';
?>
<!-- register css -->
<!-- <link rel="stylesheet" href="./assets/dist/css/pages/register.css"> -->
</head>
<body>
    <?php include './header.php'; ?>
    
    <main>
        
    </main>
    
    <!-- start Footer Area -->
    <?php include './footer.php' ?>     
    <!-- end Footer Area -->

    <!-- Plugins -->
    <?php include './plugin_views.php'; ?>
    <!-- Custom Script -->
    <!-- <script src="controllers/register.js"></script> -->
</body>
</html>