<?php

require "./global_call.php";
require "./database.php";
session_start();

$stmt_account = $mysqli->prepare("SELECT * FROM abuloy_accounts WHERE id = ".$_SESSION['user_id']);
$stmt_account->execute();
$result_account = $stmt_account->get_result();
$account = $result_account->fetch_assoc();
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
    
    <main class="mt-5 py-5">
        <div class="mt-5 py-5 text-blackish">
            <h1><?= $account['d_firstname'] ?></h1>
        </div>
        
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