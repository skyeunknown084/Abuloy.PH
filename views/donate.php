<?php
session_start();
// error_reporting(0);
require "./global_call.php";
require "./database.php";
$aid;
echo $_SESSION['user_id'];
if(isset($_SESSION['user_id'])) {
    
    $sql = "SELECT * FROM abuloy_users
            WHERE id = " . $_SESSION['user_id'] ." AND email_status = 1";

    $result = $mysqli->query($sql);

    $user = $result->fetch_assoc();
    
}
// else{
//     $sql = "SELECT * FROM abuloy_users";

//     $result = $mysqli->query($sql);

//     $user = $result->fetch_assoc();

//     $aid = $user['id'];
// }

$uid = $user['id'];
$sql = "SELECT * FROM abuloy_accounts WHERE uid = $uid";

    
?>
<!DOCTYPE html>
<html lang="en">
<?php include './head_donate.php'; ?>
<body>

    <section class="my-5 pt-5">
    <div class="album py-5 ">
    <div class="container">
      <?php
      $result = $mysqli->query($sql);
      if($account = $result->fetch_assoc()){
        $aid = $account['id'];
        $fname = $account['d_firstname'];
        $mname = $account['d_middlename'];
        $lname = $account['d_lastname'];
        $photo = $account['avatar'];
        $summary = $account['d_summary'];
        $bdate = $account['d_birthdate'];
        $ddate = $account['d_date_of_death'];
        $goal_amount = $account['d_goal_amount'];
        $link = $account['url_link'];
      ?>
      <h1><?= $link ?></h1>
    </div>
  </div>
        
    </section>
        
<?php
}
?>

    <!-- start Footer Area -->
    <?php include './footer.php' ?>     
    <!-- end Footer Area -->

    <!-- Plugins -->
    <?php include './plugin_views.php'; ?>
    <!-- Custom Script -->
    <!-- <script src="controllers/register.js"></script> -->
</body>
</html>