<?php

session_start();
require "global_call.php";
require "database.php";
if(isset($_SESSION['user_id'])) {
    
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
include 'head.php';
?>
<!-- register css -->
<!-- <link rel="stylesheet" href="./assets/dist/css/pages/register.css"> -->
</head>
<body class="bg-light">
    <?php include 'header.php'; ?>
    
    <main>
        <?php 
        // $utype = $user['user_type']; 
        // if($utype === '0'){
        //     include 'views/dashboard-admin.php'; 
        // }elseif($utype === '1'){
        //     include 'views/dashboard-user.php';
        // }elseif($utype === '2'){
        //     include 'views/dashboard.php';
        // }
        
        $routes = [];

        $path = $_SERVER['REQUEST_URI'];

        switch ($path) {
            case "/":
                include 'views/dashboard-user.php';
                break;
            case "/start-new-fund":
                include 'views/start-new-fund.php';
                break;
            case "/contact":
                include 'views/contact-us.php';
                break;
            case "/donees":
                include 'views/donees.php';
                break;    
            default:
                include '/404.php';
        }

        function route(string $path, callable $callback) {
            global $routes;
            $routes[$path] = $callback;
          }
          
          run();
          
          function run() {
            global $routes;
            $uri = $_SERVER['REQUEST_URI'];
            $found = false;
            foreach ($routes as $path => $callback) {
              if ($path !== $uri) continue;
          
              $found = true;
              $callback;
            }
          
            // if (!$found) {
            //   $notFoundCallback = $routes['/404'];
            //   $notFoundCallback();
            //   include '404.php';
            // }
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