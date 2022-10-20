<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">     
    
    <?php 
        // session_start();
        include_once 'config/db_connect.php';

        $acc_id = $_GET['id'];
        $metaqry = $conn->query("SELECT * FROM accounts WHERE id = $acc_id");
        if($row=$metaqry->fetch_assoc()){
            $acct_id = $row['id'];
            $fname = $row['d_firstname'];
            $lname = $row['d_lastname'];
            $description = $row['d_summary'];
            $image = $row['avatar'];
            ?>
            <title>In Loving Memory of <?php echo $fname ?> <?php echo $lname ?></title>
            <meta property="og:url"          content="https://abuloy.ph/index.php?page=donate&id=<?php echo $acct_id ?>" />
            <meta property="og:type"         content="article" />
            <meta property="og:title"        content="In Loving Memory of <?php echo $fname ?> <?php echo $lname ?>" />
            <meta property="og:description"  content="<?php echo htmlspecialchars($description) ?>" />
            <meta property="og:image:secure" content="https://abuloy.ph/assets/uploads/<?php echo $image ?>" />
        <?php
        }    
    ?>
    
    <!-- Google Fonts (Poppins) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- Fonts Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="assets/plugins/toastr/toastr.min.css">
    <!-- DateTimePicker -->
    <link rel="stylesheet" href="assets/dist/css/jquery.datetimepicker.min.css">
    <!-- Theme style -->
    <!-- <link rel="stylesheet" href="assets/dist/css/bs/bootstrap.css"> -->
    <link rel="stylesheet" href="assets/dist/css/custom.css">
    <link rel="stylesheet" href="assets/dist/css/main.css">
    <link rel="stylesheet" href="assets/dist/css/style.css">    
    <link rel="stylesheet" href="assets/dist/css/scrollbar.css">    
    <!-- JQuery -->
    <script src="assets/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="assets/plugins/jquery-ui/jquery-ui.min.js"></script>
    
    <!-- Load Facebook SDK for JavaScript -->

    <!-- GetPaid GCash JS -->
    <!-- <script src="/assets/js/vendors.bundle.js"></script>
    <script src="/assets/js/moment.js"></script>
    <script src="/assets/js/custom_objects/config.php?v=1.4"></script>
    <script src="/assets/js/custom_objects/global.js?v=1.8"></script>
    <script src="/assets/js/custom_objects/fs.js"></script>
    <script src="/assets/js/custom_objects/localdata.js"></script>
    <script src="/assets/js/custom_objects/account.js?_=1.0"></script>
    <script src="/assets/js/custom_objects/site.js?v=1.8"></script>
    <script src="/assets/js/custom_objects/JavaScript-Load-Image-2.26.0/js/load-image.all.min.js"></script>
    <script src="/assets/js/custom_objects/fileuploader.js?v=1"></script> -->
</head>