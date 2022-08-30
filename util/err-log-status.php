<?php

$err_log_1 = "Attempt to Login 3 times! \n Your Account has been locked for security purposes. \n To resolved this, please contact us via email.";
$err_log_2 = "The Email Address you tried to login is not yet Verified.\n";
?>
<!DOCTYPE html>
<html lang="en">
<?php 
include './head.php'; 
?>     
</head>
<body>
    <main>
        <p><?= $err_log_2 ?></p>
        <p>Please click <a href="/email-verification">here</a> to verify your email</p>
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