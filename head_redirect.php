<?php 
// session_start();
error_reporting(0);
include_once './config/db_connect.php';

$short_url;
$sql = $conn->query("SELECT * FROM accounts WHERE short_url = '$short_url'");
if($row=$sql->fetch_assoc()){
    $id = $row['id'];
    $long_url = $row['url_link'];
?>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta HTTP-EQUIV='REFRESH' content="0; url=<?=$long_url?>">
<?php
}
    // session_start();
    $short_url;
    $metaqry = $conn->query("SELECT * FROM accounts WHERE share_url = $short_url");
    if($row=$metaqry->fetch_assoc()){
        $acct_id = $row['id'];
        $fname = $row['d_firstname'];
        $lname = $row['d_lastname'];
        $description = $row['d_summary'];
        $image = $row['avatar'];
        ?>
        <title>In Loving Memory of <?php echo $fname ?> <?php echo $lname ?></title>
        <meta property="og:url"          content="https://abuloy.ph/donate?id=<?php echo $acct_id ?>" />
        <meta property="og:type"         content="article" />
        <meta property="og:title"        content="In Loving Memory of <?php echo $fname ?> <?php echo $lname ?>" />
        <meta property="og:description"  content="<?php echo $description ?>" />
        <meta property="og:image" content="https://abuloy.ph/assets/uploads/<?php echo $image ?>" />
        
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
<link rel="stylesheet" href="./assets/bootstrap/dist/css/bootstrap.css">
<!-- Custom css -->
<link rel="stylesheet" href="./assets/dist/css/main.css">
<link rel="stylesheet" href="./assets/dist/css/style.css">
<!-- Media-Device Sizes css -->
<link rel="stylesheet" href="./assets/dist/css/sizes.css">
<!-- Scrollbar css -->
<link rel="stylesheet" href="./assets/dist/css/scrollbar.css">
<!-- Plugins -->
<link rel="stylesheet" href="./assets/plugins/toastr/toastr.css">
<!-- JQuery -->
<script src="./assets/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="./assets/plugins/jquery-ui/jquery-ui.min.js"></script>
