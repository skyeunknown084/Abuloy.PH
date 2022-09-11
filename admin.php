<?php

session_start();
error_reporting(0);

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

        require "global_call.php";
        require "database.php";
        $admin_id = 1;
        $admintype = 3;
        
        if($admintype == 3){
            $sql = "SELECT * FROM abuloy_users WHERE user_type = $admintype AND id = $admin_id";
            $result = $mysqli->query($sql);
            $admin = $result->fetch_assoc();
            include 'header-admin.php';
            include 'views/dashboard-admin.php';
        }
        else{
            include 'header.php';
            include 'views/dashboard.php';
        }
        


    ?>
    
    <!-- start Footer Area -->
    <?php include 'footer.php' ?>     
    <!-- end Footer Area -->

    <!-- Plugins -->
    <?php include 'plugins.php'; ?>
    <!-- Custom Script -->
    <!-- <script src="controllers/register.js"></script> -->
</body>
</html>