<?php
session_start();
error_reporting(0);   
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
<body class="bg-light">
    
    <?php

      require "./global_call.php";
      require "./database.php";

      $uid = $_SESSION['user_id'];
      if($_SERVER['REQUEST_METHOD'] === "GET" && isset($uid)){
        $stmt = $mysqli->prepare("SELECT * FROM abuloy_users WHERE id = ?");
        $stmt->bind_param('d', $uid);
        $result = $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        // generate session again
        // session_regenerate_id();
        if(isset($user)){
          include 'header-user.php';
        }
      }
      else{
        include './header.php';          
      }

    ?>

    <section class="my-5">
      <div class="container-fluid p-5 text-center">
        <div class="row">
          <legend class="align-center pt-4 text-lavander">
            Our Campaign Donees
          </legend>
          <div class="align-center col-lg-12 pb-1">
            <div class="col-lg-8 align-left">
              <div class="d-flex " >
                <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                  <input type="radio" class="btn-check" name="btnradio" name="oldest_btn_user" id="oldestBtnUser" autocomplete="off">
                  <label class="btn btn-outline-primary" for="oldestBtnUser">Oldest</label>
                  <input type="radio" class="btn-check bg-lavander" name="btnradio" name="newest_btn_user" id="newestBtnUser" autocomplete="off" checked>
                  <label class="btn btn-outline-primary" for="newestBtnUser">Newest</label>
                </div>
              </div>
            </div>             
            <div class="align-right col-lg-4 ms-2 mt-3">
              <div class="input-group mb-3">
                <input type="text" class="form-control" id="searchbar" onkeyup="search_donees()" type="text"
                    name="search" placeholder="Search Name" aria-describedby="button-addon2">
                <button class="btn btn-outline-primary" type="button" id="button-addon2" onclick="search_donees()"><i class="fa fa-search"></i></button>
              </div>
            </div>                
          </div>
        </div>
        <div class="row " id="new_donees_user">
          <?php
            $sql = "SELECT * FROM abuloy_accounts ORDER BY id DESC";
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
          <div class="col-lg-3 col-md-6 col-sm-12 px-md-2 donee">
            <div class="card mt-3">
              <a target="_blank" href="/donate/<?= $aid ?>" class="bd-placeholder-img card-img-top align-center mx-auto bg-solid-silver">
                <?php if($photo == ''){ $no_image = 'assets/img/no-image-available.png'; ?>
                  <img src="<?= $no_image ?>" alt="" style="width:75%; height: 275px;">
                <?php }else{ ?>
                  <img src="<?= $photo ?>" alt="" style="width:70%; height: 275px;">
                <?php } ?>
              </a>
              <legend class="text-lavander text-center pb-0 mb-0" x="42%" y="90%"><?= $fname ?> <?= $lname ?></legend>
              <text  fill="#eceeef" class="text-lavander text-center"><?php echo date("M d, Y",strtotime($bdate)); ?> - <?php echo date("M d, Y",strtotime($ddate)); ?></text>
              <div class="card-body pt-0">
                <div class="my-2" style="height:70px">
                <?php if($summary === ''){ ?>
                  <p class="card-text text-center pt-4">N/A</p>
                <?php }else{ ?>
                  <p class="card-text text-justify pt-2"><?= substr($summary, 0, 48) . '...' ?></p>
                <?php } ?> 
                </div>
                <div class="d-flex justify-content-between align-items-center">
                  <small class="text-muted hide">location</small>
                  <div class="btn-group col-12">
                    <a href="/donate/<?= $aid ?>" type="button" class="btn btn-sm btn-lavander text-white py-2 px-5">Donate Now</a>
                  </div>
                </div>
                <span class="hide"><strong class="text-lavander">₱<?= $goal_amount ?>.00</strong> of <medium class="text-muted">₱<?= $goal_amount ?>.00 target goal</medium></span>
                <p class="fw-bold pt-2 mb-0">
                  <?php
                      $progqry = $mysqli->query("SELECT *,SUM(amount) as total_raised FROM abuloy_payments WHERE aid = $aid and payment_status = 1");            
                      while($progrow= $progqry->fetch_assoc()){
                  ?> 
                  <label for="goal-raised-progress" class="" style="font-size:15px">
                      <span class="">₱<?php echo number_format($progrow['total_raised'],2, '.', ',') ?></span>
                      of ₱<?php echo number_format($goal_amount, 2, '.', ',');?> goal
                  </label>
                  <?php } 
                  $total_amount = $mysqli->query("SELECT SUM(amount) as total_raised FROM abuloy_payments WHERE aid = $aid and payment_status = 1")->fetch_array();
                  foreach($total_amount as $key => $raised){
                      $$key = $raised;
                  }
                  $the_goal_amount = $mysqli->query("SELECT d_goal_amount as the_goal_amount FROM abuloy_accounts WHERE id = $aid")->fetch_array();
                  foreach($the_goal_amount as $k => $goal){
                      $$k = $goal;
                  }
                  $raised_percent = $goal > 0 ? ($raised * 100) / $goal : 0;
                  ?> 
                  <div class="col-lg-12 align-center mx-auto mt-1">          
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
          <?php
            }
          ?>
        </div>
        <div class="row hide" id="old_donees_user">
          <?php
            $sql = "SELECT * FROM abuloy_accounts ORDER BY id ASC";
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
          <div class="col-lg-3 col-md-6 col-sm-12 px-md-2">
            <div class="card mt-3">
              <a target="_blank" href="/donate/<?= $aid ?>" class="bd-placeholder-img card-img-top align-center mx-auto bg-solid-silver">
                <?php if($photo == ''){ $no_image = 'assets/img/no-image-available.png'; ?>
                  <img src="<?= $no_image ?>" alt="" style="width:75%; height: 275px;">
                <?php }else{ ?>
                  <img src="<?= $photo ?>" alt="" style="width:70%; height: 275px;">
                <?php } ?>
              </a>
              <legend class="text-lavander text-center pb-0 mb-0" x="42%" y="90%"><?= $fname ?> <?= $lname ?></legend>
              <text  fill="#eceeef" class="text-lavander text-center"><?php echo date("M d, Y",strtotime($bdate)); ?> - <?php echo date("M d, Y",strtotime($ddate)); ?></text>
              <div class="card-body pt-0">
                <div class="my-2" style="height:70px">
                <?php if($summary === ''){ ?>
                  <p class="card-text text-center pt-4">N/A</p>
                <?php }else{ ?>
                  <p class="card-text text-justify pt-2"><?= substr($summary, 0, 48) . '...' ?></p>
                <?php } ?> 
                </div>
                <div class="d-flex justify-content-between align-items-center">
                  <small class="text-muted hide">location</small>
                  <div class="btn-group col-12">
                    <a href="/donate/<?= $aid ?>" type="button" class="btn btn-sm btn-lavander text-white py-2 px-5">Donate Now</a>
                  </div>
                </div>
                <span class="hide"><strong class="text-lavander">₱<?= $goal_amount ?>.00</strong> of <medium class="text-muted">₱<?= $goal_amount ?>.00 target goal</medium></span>
                <p class="fw-bold pt-2 mb-0">
                  <?php
                      $progqry = $mysqli->query("SELECT *,SUM(amount) as total_raised FROM abuloy_payments WHERE aid = $aid and payment_status = 1");            
                      while($progrow= $progqry->fetch_assoc()){
                  ?> 
                  <label for="goal-raised-progress" class="" style="font-size:15px">
                      <span class="">₱<?php echo number_format($progrow['total_raised'],2, '.', ',') ?></span>
                      of ₱<?php echo number_format($goal_amount, 2, '.', ',');?> goal
                  </label>
                  <?php } 
                  $total_amount = $mysqli->query("SELECT SUM(amount) as total_raised FROM abuloy_payments WHERE aid = $aid and payment_status = 1")->fetch_array();
                  foreach($total_amount as $key => $raised){
                      $$key = $raised;
                  }
                  $the_goal_amount = $mysqli->query("SELECT d_goal_amount as the_goal_amount FROM abuloy_accounts WHERE id = $aid")->fetch_array();
                  foreach($the_goal_amount as $k => $goal){
                      $$k = $goal;
                  }
                  $raised_percent = $goal > 0 ? ($raised * 100) / $goal : 0;
                  ?> 
                  <div class="col-lg-12 align-center mx-auto mt-1">          
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
          <?php
            }
          ?>
        </div>
        <div class="row hide" id="filter_donees_user">
          <?php
            $sql = "SELECT * FROM abuloy_accounts WHERE d_firstname LIKE '{$input}%'";
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
          <div class="col-lg-3 col-md-6 col-sm-12 px-md-2">
            <div class="card mt-3">
              <a target="_blank" href="/donate/<?= $aid ?>" class="bd-placeholder-img card-img-top align-center mx-auto bg-solid-silver">
                <?php if($photo == ''){ $no_image = 'assets/img/no-image-available.png'; ?>
                  <img src="<?= $no_image ?>" alt="" style="width:75%; height: 275px;">
                <?php }else{ ?>
                  <img src="<?= $photo ?>" alt="" style="width:70%; height: 275px;">
                <?php } ?>
              </a>
              <legend class="text-lavander text-center pb-0 mb-0" x="42%" y="90%"><?= $fname ?> <?= $lname ?></legend>
              <text  fill="#eceeef" class="text-lavander text-center"><?php echo date("M d, Y",strtotime($bdate)); ?> - <?php echo date("M d, Y",strtotime($ddate)); ?></text>
              <div class="card-body pt-0">
                <div class="my-2" style="height:70px">
                <?php if($summary === ''){ ?>
                  <p class="card-text text-center pt-4">N/A</p>
                <?php }else{ ?>
                  <p class="card-text text-justify pt-2"><?= substr($summary, 0, 48) . '...' ?></p>
                <?php } ?> 
                </div>
                <div class="d-flex justify-content-between align-items-center">
                  <small class="text-muted hide">location</small>
                  <div class="btn-group col-12">
                    <a href="/donate/<?= $aid ?>" type="button" class="btn btn-sm btn-lavander text-white py-2 px-5">Donate Now</a>
                  </div>
                </div>
                <span class="hide"><strong class="text-lavander">₱<?= $goal_amount ?>.00</strong> of <medium class="text-muted">₱<?= $goal_amount ?>.00 target goal</medium></span>
                <p class="fw-bold pt-2 mb-0">
                  <?php
                      $progqry = $mysqli->query("SELECT *,SUM(amount) as total_raised FROM abuloy_payments WHERE aid = $aid and payment_status = 1");            
                      while($progrow= $progqry->fetch_assoc()){
                  ?> 
                  <label for="goal-raised-progress" class="" style="font-size:15px">
                      <span class="">₱<?php echo number_format($progrow['total_raised'],2, '.', ',') ?></span>
                      of ₱<?php echo number_format($goal_amount, 2, '.', ',');?> goal
                  </label>
                  <?php } 
                  $total_amount = $mysqli->query("SELECT SUM(amount) as total_raised FROM abuloy_payments WHERE aid = $aid and payment_status = 1")->fetch_array();
                  foreach($total_amount as $key => $raised){
                      $$key = $raised;
                  }
                  $the_goal_amount = $mysqli->query("SELECT d_goal_amount as the_goal_amount FROM abuloy_accounts WHERE id = $aid")->fetch_array();
                  foreach($the_goal_amount as $k => $goal){
                      $$k = $goal;
                  }
                  $raised_percent = $goal > 0 ? ($raised * 100) / $goal : 0;
                  ?> 
                  <div class="col-lg-12 align-center mx-auto mt-1">          
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
          <?php
            }
          ?>
        </div>
      </div>
    </section>
        

    
    <!-- start Footer Area -->
    <?php include './footer.php' ?>     
    <!-- end Footer Area -->

    <!-- Plugins -->
    <?php include './plugins.php'; ?>
    <!-- Custom Script -->
    <script src="./controllers/donees.js"></script>
</body>
</html>