<?php

session_start();
error_reporting(0);

// if(isset($admintype) == 1){
//     $sql = "SELECT * FROM abuloy_users WHERE id = $adminid";

//     $result = $mysqli->query($sql);

//     $admin = $result->fetch_assoc();
//         $log_status = $admin['log_status'];
//     if($log_status == 1){
//         echo 'success login';
//         echo $admin['firstname'];
//         echo $admin['user_type'];
//     }else{
//         echo 'failed login';
//     }
// }else{

//     $

//     // header('Location: /login');
//     // session_unset();
//     // session_destroy();
// }
// if(isset($_SESSION['user_id'])) {
    
//     $sql = "SELECT * FROM abuloy_users
//             WHERE id = " . $_SESSION['user_id'] ." AND email_status = 1";

//     $result = $mysqli->query($sql);

//     $admin = $result->fetch_assoc();

    

// }
// else{
    
    // if($admin == ''){
    //     header("Location: /login");
    // }else{
    //     header("Location: /");
    // }
    
// }
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
            $sql = "SELECT * FROM abuloy_users WHERE user_type = 3 AND log_status = 1 AND id = $admin_id";
            $result = $mysqli->query($sql);
            $admin = $result->fetch_assoc();
            session_regenerate_id();
            include 'header-admin.php';
            include 'views/dashboard.php';
        }
        else{
            include 'header.php';
            include 'views/dashboard.php';
            $admintype = 2;
            $_SESSION['user_type'] = 2;
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