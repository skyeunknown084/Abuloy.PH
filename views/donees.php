<?php

session_start();
require "./global_call.php";
if(isset($_SESSION['user_id'])) {
    
    $mysqli = require "./database.php";
    $user_id = $user['id'];
    $sql = "SELECT * FROM abuloy_users
            WHERE id = ". $_SESSION['user_id'] ." AND email_status = 1";
    $result = $mysqli->prepare($sql);
    $result->execute();

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
        
        <ul>
        <?php
        $id = $user['id'];
        $sql_account = "SELECT * FROM abuloy_accounts WHERE uid = ?";
        $result_account = $mysqli->prepare();
        $result_account->bind_param('d', $id);
        $result_account->execute();
        $accounts = $result_account->fetch_assoc();
        while($accounts){
        ?>
            <li><?= $accounts['d_firstname'] ?></li>
            <li><?= $accounts['d_middlename'] ?></li>
            <li><?= $accounts['d_lastname'] ?></li>
        <?php
        }
        ?>
        </ul>
        
    </main>
    
    <!-- start Footer Area -->
    <?php include './footer.php' ?>     
    <!-- end Footer Area -->

    <!-- Plugins -->
    <?php include '/plugin_views.php'; ?>
    <!-- Custom Script -->
    <!-- <script src="controllers/register.js"></script> -->
</body>
</html>