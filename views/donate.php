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
      if($_SERVER['REQUEST_METHOD'] === "GET" && isset($aid)){
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
        else{
            include './header.php';          
          }
      }
      

    ?>

    <section class="my-5">
        <div class="container-fluid p-5 text-center">
            <div class="row">
                <div class="align-center col-lg-12 pb-1">             
                <div class="col-12 align-right pt-4 pb-2">
                    <a href="/donees" type="button" class="btn btn-lavander px-3 py-2">
                        <i class="fa fa-users pe-1 text-aquamarine"></i>  View Other Funds 
                    </a>
                </div>                
                </div>
                <hr class="text-purple">
            </div>
            <div class="row " id="donate_user">
                
                <?php
                $sql = "SELECT * FROM abuloy_accounts a INNER JOIN abuloy_payments p ON a.id = p.aid WHERE p.aid = $aid";
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
                <div class="col-lg-7 mb-3 ps-lg-5 donate_user_search">
                <div class="card">
                    <a target="_blank" href="/donate/<?= $aid ?>" class="bd-placeholder-img card-img-top align-center mx-auto bg-solid-silver">
                    <?php if($photo == ''){ $no_image = 'assets/img/no-image-available.png'; ?>
                        <img src="<?= $no_image ?>" alt="" style="width:75%; height: 275px;">
                    <?php }else{ ?>
                        <img src="<?= $photo ?>" alt="" style="width:70%; height: 375px;">
                    <?php } ?>
                    </a>
                    <legend class="text-lavander text-center pb-0 mb-0" x="42%" y="90%"><?= $fname ?> <?= $lname ?></legend>
                    <text  fill="#eceeef" class="text-lavander text-center"><?php echo date("M d, Y",strtotime($bdate)); ?> - <?php echo date("M d, Y",strtotime($ddate)); ?></text>
                    <div class="card-body pt-0">
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
                <div class="col-lg-5 mb-3 pe-lg-5">
                <div class="card align-m px-2">
                    <div class="card-body py-4">
                    <form action="" id="process_payment" method="POST">
                        <input type="hidden" name="aid" id="aid" value="<?php echo $aid ?>">
                        <input type="hidden" name="account_name" id="account_name" value="<?= $fname ?> <?= $mname[0] ?>. <?= $lname ?>">
                        <input type="hidden" name="utype" id="utype" value="2">
                        <input type="hidden" name="payment_status" id="payment_status" value="0">
                        <input type="hidden" name="request_id" id="request_id" value="pending"> 
                        <input type="hidden" name="description" id="description" value="Payment for services rendered"> 
                        <input type="hidden" name="expiry" id="expiry" value="24"> 
                        
                        <!-- <input type="hidden" name="gcash_abuloy_fee" id="gcash_abuloy_fee" value="0"> -->
                        <label for="amount" id="donate_label" class="d-flex text-lavander fw-800 justify-content-center fs-larger">Enter Amount</label>
                        <label for="amount" id="paynow_label" class="d-flex text-lavander fw-800 justify-content-center fs-larger hide">You will donate an Amount of</label>
                        <div class="input-group mb-3 mt-3">
                            <span class="input-group-text fw-bold fs-larger px-auto px-4">₱</span>
                            <input type="number" name="amount" id="amount" class="form-control text-blackish amount-input fw-bold fs-larger py-0 px-auto text-center" aria-label="Amount (to the nearest peso)" style="height:60px;font-size:50px" required>
                            <span class="input-group-text fw-bold fs-larger px-auto px-4">.00</span>
                            <small for="amount" id="amountnote" class="text-black fs-small hide">Please enter any amount that is more than ₱0.00</small>
                        </div>
                        <div class="form-check pb-2 pt-0" id="makeMeAnonymous">
                            <input type="checkbox" class="form-check-input" name="anonymous" id="anonymous">
                            <label class="form-check-label pt-1 ps-2 align-left" for="anonymous">Make my donation anonymous</label>
                        </div>
                        <div class="pb-1 hide" id="note">
                            <small>NOTE: </small><small>As you wish to be an anonymous donator your name and donation will not be listed in public view under Funders list.<br/><span class="text-lavander">For GCash payments options, a customer information is required.</span></small>
                        </div>                                                        
                        <div class="gcash-form pb-2 pt-0" id="gcashFormReq">
                            <input type="text" class="form-control text-blackish mb-3 text-center" name="customer_name" id="customer_name" placeholder="Add Your Name">
                            <input type="email" class="form-control text-blackish mb-3 text-center" name="customer_email" id="customer_email" placeholder="Email Address">
                            <input type="text" class="form-control text-blackish mb-3 text-center" name="customer_mobile" id="customer_mobile" placeholder="Mobile Number">
                        </div>
                        
                        <textarea name="message" id="message" class="form-control text-blackish text-center" rows="3" placeholder="A short message" required></textarea>
                        <div class="form-check pt-4 pb-0" id="terms">
                            <input type="checkbox" class="form-check-input" id="agreement" required>
                            <label class="form-check-label pt-1 ps-2 align-left" for="agreement">I agree to <a href="/terms-and-conditions">Terms & Conditions</a></label>
                        </div>
                        <div class="pb-1 hide" id="paynote">
                            <small>NOTE: </small><small>For a moment we only accept GCash payment.</small>
                        </div>   
                        <a id="acct_id_lnk" href="/donate/<?php echo $aid ?>" class="hide"></a>                        
                        <button type="submit" id="donatebtn" class="btn btn-lavander fw-bold col-12 fs-larger text-uppercase p-2 mt-3 my-2 align-center" >
                            DONATE
                        </button>
                        <!-- <button type="submit" id="donated" class="btn btn-lavander col-12 fs-larger text-uppercase my-2 align-center" >
                            DONATED
                        </button> -->                            
                        <a id="paynow" class="btn btn-lavander fw-bold fs-larger text-uppercase px-2 my-1 py-1 align-center hide">
                            <img src="http://localhost/assets/img/gcash.png" height="40px"> Pay Now
                        </a>

                        
                        <!-- <a href="https://www.paypal.com/donate/?hosted_button_id=RW46D3593NK74#" class="col-lg-4 col-md-6 col-sm-12 hide"><img src="https://craftindustryalliance.org/wp-content/uploads/2019/04/PayPal_logo_logotype_emblem.png" alt="" height="25px" class="text-center align-center mx-auto pe-2"></a> -->

                        <div id="sharenow" class="">
                            <div class="hide text-lavander text-center text-uppercase mt-3 fw-bold">or share to</div>
                            <div class="text-blackish text-center mt-1 fw-bold"></div>
                            <a target="_blank" data-href="https://abuloy.ph/donate/<?php echo $aid ?>&scrape=true" data-layout="button_count" href="https://www.facebook.com/sharer.php?u=https%3A%2F%2Fabuloy.ph%2Fdonate%26id%3D<?php echo $aid ?>&scrape=true" 
                                class="hide btn btn-aquamarine btn-default text-lavander btn-social btn-facebook btn-sm disableIfNotLive fw-bold col-12 mt-3" id="facebook" name="provider" value="Share On Facebook" title="Share On Facebook" style="margin-top:0px;">
                                <i class="fab fa-facebook" style="margin-top: 0px;font-size:19px"></i>
                                <span style="font-size:19px">SHARE</span>
                            </a>
                            <hr>
                            <button data-bs-toggle="modal" data-bs-target="#share-to-social-media" class="btn btn-lavander col-12 text-uppercase fs-larger fw-bold">
                                Share <i class="fas fa-hand-holding-heart ps-2"></i>
                            </button>
                            
                        </div>
                        <div id="otherpayments" class="hide">
                        <div class="text-lavander mt-5 mb-3 text-center">Other payment methods that will be available soon</div>
                        <div class="col-12 d-flex">
                            <a class="col-lg-4 col-md-6 col-sm-12"><img src="https://www.ppro.com/wp-content/uploads/2021/06/pay-Maya-logo.png" alt="" height="25px" class="text-center align-center mx-auto pe-2"></a>
                            <a href="https://www.paypal.com/donate/?hosted_button_id=RW46D3593NK74" target="_blank" class="col-lg-4 col-md-6 col-sm-12"><img src="./assets/img/paypal.png" alt="" height="25px" class="text-center align-center mx-auto pe-2"></a>
                        </div>
                        </div>
                                            
                        <!-- <button onclick="facebook_share()" class="btn btn-aquamarine btn-default text-lavander btn-social btn-facebook btn-sm disableIfNotLive col-12 mt-3" id="facebook" name="provider" value="Share On Facebook" title="Share On Facebook" style="margin-top:0px;">
                            <i class="fab fa-facebook" style="margin-top: 0px;font-size:19px"></i>
                            <span style="font-size:19px">SHARE</span>
                        </button> -->

                        <!-- Modal -->
                        <div class="modal fade " id="gcashSaveConfirm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="gcashSaveConfirmLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                <div class="modal-header hide">
                                    <h5 class="modal-title" id="gcashSaveConfirmLabel"></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to donate an amount of Php <?= $amount ?></p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="cancelDonate">No</button>
                                    <button type="submit" class="btn btn-primary" id="yes_donate_btn" data-bs-dismiss="modal">Yes</button>
                                </div>
                                </div>
                            </div>
                        </div>

                    </form>
                    </div>
                </div>
                </div>
                <div class="col-lg-7 mb-3 ps-lg-5">
                <div class="card-desc">
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button " type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Who is <?= $fname ?> <?= $mname[0] ?> <?= $lname ?>?
                            </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <?php if($summary === ''){ ?>
                                <p class="card-text text-center pt-4">N/A</p>
                                <?php }else{ ?>
                                <p class="card-text text-justify pt-2"><?= $summary ?></p>
                                <?php } ?> 
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                <?php
                }
                ?>
                <div class="col-lg-5 mb-3 pe-lg-5 text-left">
                    <div class="accordion-item">
                        <div class="accordion-button bg-aquamarine text-blackish" id="panelsStayOpen-headingOne">
                            <button class="bg-aquamarine text-purple fw-bold" type="button">
                                <?php $num_donators = $mysqli->query("SELECT * FROM abuloy_payments WHERE customer_name != '' and aid =".$aid)->num_rows; ?>
                                Funders (<?= $num_donators ?>)
                            </button>
                        </div>
                        <div class="accordion-body">
                            <table class="table table-bordered" style="border: 1px solid #A265E6">
                                <?php
                                // echo "List of Donators"
                                $donatorsqry = $mysqli->query("SELECT * FROM abuloy_payments WHERE aid =".$aid." ORDER BY id desc LIMIT 10");
                                while($row=$donatorsqry->fetch_assoc()){
                                    $funders = $row['customer_name'];
                                    if($funders != ''){
                                ?>
                                <tr>
                                    <td class="bg-light-lavander text-purple text-left fw-bold" width="30%">₱ <i><?= $row['amount'] ?>.00</i></td>
                                    <td><span class="text-lavander fw-bold"><?= $row['customer_name'] ?></span> <br/><i style="font-size:14px">"<?= $row['description']?>"</i></td>
                                </tr>
                                <?php }
                                } ?>
                            </table>  
                        </div>                
                    </div>
                </div>
                
            </div>
        </div>
    </section>
        

    
    <!-- start Footer Area -->
    <?php include './footer.php' ?>     
    <!-- end Footer Area -->

    <!-- Plugins -->
    <?php include './plugins.php'; ?>
    <!-- Custom Script -->
    <script src="http://localhost/controllers/donate.js"></script>
</body>
</html>