<?php
session_start();
error_reporting(0);   
?>
<!DOCTYPE html>
<html lang="en">
<?php include './head_views.php'; ?>
<body>
    
    <?php
    require "./global_call.php";
    require "./database.php";
    $userid = $_SESSION['user_id'];
    $usertype = $_SESSION['user_type'];

    if(isset($usertype) == 1){
        $sql = "SELECT * FROM abuloy_users WHERE user_type = 1 AND log_status = 1";
        $result = $mysqli->query($sql);
        $user = $result->fetch_assoc();
        // generate session again
        session_regenerate_id();
        include 'header-user.php';
    }
    else{
      include 'header.php';
      session_unset();
      session_destroy();
    }

    ?>

    <section class="my-5 pt-5">
    <div class="album py-5 ">
    <div class="container">
      <?php
      $sql = "SELECT * FROM abuloy_accounts";
      $result = $mysqli->query($sql);
      while($account = $result->fetch_assoc()){
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
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-3 g-4">
        <div class="col">
          <div class="card shadow-sm">
            <!-- <img src="<?= $photo ?>" class="bd-placeholder-img card-img-top" width="225px" height="325px" /> -->
            <a target="_blank" href="/donate?id=<?= $aid ?>" class="bd-placeholder-img card-img-top align-center mx-auto bg-solid-silver">
                <?php if($photo == ''){ $no_image = 'assets/img/no-image-available.png'; ?>
                    <img src="<?= $no_image ?>" alt="" style="width:75%; height: 275px;">
                <?php }else{ ?>
                    <img src="<?= $photo ?>" alt="" style="width:70%; height: 275px;">
                <?php } ?>
            </a>
            <legend class="text-lavander text-center pb-0 mb-0" x="42%" y="90%"><?= $fname ?> <?= $lname ?></legend>
            <text  fill="#eceeef" class="text-lavander text-center"><?php echo date("M d, Y",strtotime($bdate)); ?> - <?php echo date("M d, Y",strtotime($ddate)); ?></text>
            <div class="card-body">
              <p class="card-text"><?= $summary ?></p>
              <div class="d-flex justify-content-between align-items-center">
                <small class="text-muted hide">location</small>
                <div class="btn-group col-12">
                  <a href="/donate/<?= $aid ?>" type="button" class="btn btn-sm btn-lavander text-white py-2 px-5">Donate Now</a>
                </div>
                
              </div>
              <span class="hide"><strong class="text-lavander">₱<?= $goal_amount ?>.00</strong> of <medium class="text-muted">₱<?= $goal_amount ?>.00 target goal</medium></span>
              <p class="fw-bold pt-2 mb-0">
                <?php
                    $progqry = $mysqli->query("SELECT *,SUM(amount) as total_raised FROM abuloy_payments WHERE aid = $aid and status = 1");            
                    while($progrow= $progqry->fetch_assoc()){
                ?> 
                <label for="goal-raised-progress" class="" style="font-size:15px">
                    <span class="">₱<?php echo number_format($progrow['total_raised'],2, '.', ',') ?></span>
                    of ₱<?php echo number_format($goal_amount, 2, '.', ',');?> goal
                </label>
                <?php } 
                $total_amount = $mysqli->query("SELECT SUM(amount) as total_raised FROM abuloy_payments WHERE aid = $aid and status = 1")->fetch_array();
                foreach($total_amount as $key => $raised){
                    $$key = $raised;
                }
                $the_goal_amount = $mysqli->query("SELECT d_goal_amount as the_goal_amount FROM abuloy_accounts WHERE id = $aid")->fetch_array();
                foreach($the_goal_amount as $k => $goal){
                    $$k = $goal;
                }
                $raised_percent = $goal > 0 ? ($raised * 100) / $goal : 0;
                ?> 
                <div class="col-lg-12 align-center mx-auto p-0 my-0">          
                    <div style="height: 20px; width:100%; background-color: rgb(148,247,207);border-radius:4px;">
                        <div class="mh-100 py-0 my-0 text-aquamarine text-center d-flex" style="width: <?php echo $raised_percent ?>%; height: 100px; background-color: rgba(162,101,230,0.8);border-radius:4px;font-size:14px;"> 
                            <?php
                            if($raised_percent < 10){ ?>
                                <span class="text-purple px-4"><?php echo round($raised_percent,2) ?>%</span> 
                            <?php 
                            }elseif($raised_percent <= 15){ ?>
                                <span class="text-purple px-5"><?php echo round($raised_percent,2) ?>%</span> 
                            <?php 
                            }elseif($raised_percent <= 21){ ?>
                                <span class="text-purple px-5 mx-2"><?php echo round($raised_percent,2) ?>%</span> 
                            <?php 
                            }else{ ?>
                            <span class="text-aquamarine mx-auto"><?php echo round($raised_percent,2) ?>%</span>
                            <?php
                            }
                            ?>                                            
                        </div>
                    </div>
                </div> 
                </p>  
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
        
    </section>
        
<?php
}
?>

    <!-- start Footer Area -->
    <?php include 'footer.php' ?>     
    <!-- end Footer Area -->

    <!-- Plugins -->
    <?php include 'plugins.php'; ?>
    <!-- Custom Script -->
    <!-- <script src="controllers/register.js"></script> -->
</body>
</html>