<?php

session_start();
// error_reporting(0);

// if(isset($usertype) == 1){
//     $sql = "SELECT * FROM abuloy_users WHERE id = $userid";

//     $result = $mysqli->query($sql);

//     $user = $result->fetch_assoc();
//         $log_status = $user['log_status'];
//     if($log_status == 1){
//         echo 'success login';
//         echo $user['firstname'];
//         echo $user['user_type'];
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

//     $user = $result->fetch_assoc();

    

// }
// else{
    
    // if($user == ''){
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

        $uid = $_SESSION['user_id'];
        if($_SERVER['REQUEST_METHOD'] === "GET" && isset($uid)){
            $stmt = $mysqli->prepare("SELECT * FROM abuloy_users WHERE id = ?");
            $stmt->bind_param('d', $uid);
            $result = $stmt->execute();
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();
            if(isset($user)){
                include 'header-user.php';
                include 'views/dashboard-user.php';
            }
            else{
                include 'header.php';
                include 'views/dashboard.php';
            }
        }
        else{
            include 'header.php';
            include 'views/dashboard.php';
        ?>
        
        <!-- Anonymous -->
        

        <?php
        }
        


    ?>
    
    <!-- start Footer Area -->
    <?php include 'footer.php'; ?>     
    <!-- end Footer Area -->

    <!-- Plugins -->
    <?php include 'plugins.php'; ?>
    <!-- Custom Script -->
    <!-- <script src="controllers/register.js"></script> -->
</body>
</html>