<?php 
// session_start();
// error_reporting(0); 
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">     
    
    <?php 
        // session_start();
        include_once './global_call.php';
        include_once './database.php';

        $metaqry = $mysqli->prepare("SELECT * FROM abuloy_accounts WHERE short_code = ?");
        $metaqry->bind_param('s', $code);
        $result_metaqry = $metaqry->execute();
        $result_metaqry = $metaqry->get_result();
        if($row=$result_metaqry->fetch_assoc()){
            $fname = $row['d_firstname'];
            $lname = $row['d_lastname'];
            $description = $row['d_summary'];
            $image = $row['avatar'];
            ?>
            <title>In Loving Memory of <?= $fname ?> <?= $lname ?></title>
            <meta name="twitter:card" content="summary" />
            <meta property="og:url"          content="https://abuloy.ph/donate/<?= $code ?>" />
            <meta property="og:type"         content="article" />
            <meta property="og:title"        content="In Loving Memory of <?= $fname ?> <?= $lname ?>" />
            <meta property="og:description"  content="<?= htmlspecialchars($description) ?>" />
            <meta property="og:image" content="https://abuloy.ph/assets/uploads/<?= $image ?>" />
        <?php
        }    
    ?>
    
    <!-- Google Fonts (Poppins) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- Fonts Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://abuloy.ph/assets/bootstrap/dist/css/bootstrap.css">
    <!-- Custom css -->
    <link rel="stylesheet" href="https://abuloy.ph/assets/dist/css/main.css">
    <link rel="stylesheet" href="https://abuloy.ph/assets/dist/css/style.css">
    <!-- Media-Device Sizes css -->
    <link rel="stylesheet" href="https://abuloy.ph/assets/dist/css/sizes.css">
    <!-- Scrollbar css -->
    <link rel="stylesheet" href="https://abuloy.ph/assets/dist/css/scrollbar.css">
    <!-- Plugins -->
    <link rel="stylesheet" href="https://abuloy.ph/assets/plugins/toastr/toastr.css">
    <!-- JQuery -->
    <script src="https://abuloy.ph/assets/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="https://abuloy.ph/assets/plugins/jquery-ui/jquery-ui.min.js"></script>