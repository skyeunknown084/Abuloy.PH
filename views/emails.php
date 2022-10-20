<!DOCTYPE html>
<html lang="en">
<?php
include_once './global_call.php';
include_once './config/db_connect.php';
include_once './head_views.php';
?>
<!-- emails css -->
<link rel="stylesheet" href="./assets/dist/css/pages/emails.css">
</head>
<body>
    <?php include_once './header.php'; ?>
       
    <section class="py-5" id="">
        <div class="container pt-5">
            <legend class="text-lavander">Emails Management</legend>
            <hr/>
            <div class="py-5 my-5"></div>
        </div>
    </section>

    <!-- start Footer Area -->
    <?php include './footer.php' ?>     
    <!-- end Footer Area -->

    <!-- Plugins -->
    <?php include_once './plugin_views.php'; ?>
    <!-- Custom Script -->
    <script src="./controllers/emails.js"></script>
</body>
</html>