<?php
session_start();
error_reporting(0);
require "./global_call.php";
require "./database.php";
echo $aid;
if(isset($aid)){
    $acct_qry = "SELECT * FROM abuloy_accounts WHERE id = $aid";
    $result = $mysqli->query($acct_qry);
    $user = $result->fetch_assoc();
    $fname = $user['d_firstname'];
    $lname = $user['d_lastname'];
    $bdate = $user['d_birthdate'];
    $dod = $user['d_date_of_death'];
    $goal_amount = $user['d_goal_amount'];
    $uid = $user['uid'];

?>
<!DOCTYPE html>
<html lang="en">
<?php include './head_views.php'; ?>
<body>

    <?php
        include 'header-user.php';
    ?>
    
    <section class="py-5 my-1">
        <div class="overlay overlay-bg bg-aquamarine"></div>
        <div class="container">
            <div class="row">
                <div class="col-12 align-right pt-4 pb-2">
                    <a href="/donees" type="button" class="btn btn-lavander px-3 py-2">
                        <i class="fa fa-users pe-1 text-aquamarine"></i>  View Other Funds 
                    </a>
                </div>
            </div>
            <hr class="mt-0"/>
            <div class="row">            
                <div class="col-lg-7 mt-2">
                    <input type="text" value="<?php echo $accnt_id ?>" id="donee-id" class="donee-id hide">
                    <input type="text" value="<?php echo $fname ?> <?php echo $lname ?>" id="donee-name" class="donee-name hide">
                    <legend for="" class="fw-bold text-lavander text-center" >
                        <?php if(isset($user['d_firstname'])){ printf('%s %s', $user['d_firstname'], $user['d_lastname']); } ?>
                    </legend>
                    <p for="" class="fw-bold text-blackish text-center fs-larger">
                    <?php echo date("M d, Y",strtotime($bdate)) ?> - <?php echo date("M d, Y",strtotime($dod)) ?>
                    </p>
                    <div class="card p-0 bg-solid-silver">
                        <?php $no_image = 'https://abuloy.ph/assets/uploads/no-image-available.png'; ?>
                        <a target="_blank" class="mx-auto">
                            <?php if($user['avatar'] == ''){ ?>
                                <img src="<?php echo $no_image ?>" alt="" style="width:100%;">
                            <?php }else{ ?>
                            <img class="img-fluid avatar-profile donee-img" src="<?php echo $user['avatar'] ?>" alt="">
                            <?php } ?>
                        </a>
                    </div>
                    <div class="col-12 py-3 px-2">
                    <!-- Your share button code -->
                    <div class="hide fb-share-button mt-2 col-12" data-href="https://www.abuloy.ph/donate/<?php echo $act_id ?>" data-layout="button_count" data-size="large" data-title="Andres Bonifacio">
                        <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fwww.abuloy.ph%2Findex.php%3Fpage%3Ddonate%3Fid%3D<?php echo $act_id ?>&src=sdkpreparse" class="fb-xfbml-parse-ignore">Share</a>
                    </div>
                    <?php
                        $progqry = $mysqli->query("SELECT *,SUM(amount) as total_raised FROM abuloy_payments WHERE aid = $aid and status = 1");            
                        if($user= $progqry->fetch_assoc()):
                            $goalamountqry = $mysqli->query("SELECT d_goal_amount FROM abuloy_accounts WHERE id = $aid")->fetch_array();
                            foreach($goalamountqry as $key => $goalamount){
                                $$key = $goalamount;
                            }
                    ?> 
                    <label for="goal-raised-progress" class="fs-larger">
                        <span class="larger fw-700">₱<?php echo number_format($user['total_raised'],2, '.', ',') ?></span>
                        raised over ₱<?php echo number_format($goal_amount, 2, '.', ',');?> goal
                    </label>
                    <?php endif ?>
                    <?php
                        $total_amount = $mysqli->query("SELECT SUM(amount) as total_raised FROM abuloy_payments WHERE aid = $aid and status = 1")->fetch_array();
                        foreach($total_amount as $key => $raised){
                            $$key = $raised;
                        }
                        $the_goal_amount = $mysqli->query("SELECT d_goal_amount as the_goal_amount FROM abuloy_accounts WHERE id = $aid")->fetch_array();
                        foreach($the_goal_amount as $k => $goal){
                            $$k = $goal;
                        }
                        $raised_percent = $goal > 0 ? ($raised * 100) / $goal  : 0;
                    ?> 
                    <div class="col-lg-12 align-center mx-auto p-0">          
                        <div style="height: 25px; width:100%; background-color: rgba(148,247,207,0.55);border-radius:3px;">
                            <div class="mh-100 text-aquamarine text-center" style="width: <?php echo $raised_percent ?>%; height: 100px; background-color: rgba(162,101,230,0.8);border-radius:3px;font-size:17px;">
                                <?php
                                if($raised_percent < 7){ ?>
                                    <span class="text-purple px-5"><?php echo round($raised_percent,2) ?>%</span> 
                                <?php 
                                }else{ ?>
                                <span class="text-aquamarine mx-auto"><?php echo round($raised_percent,2) ?>%</span>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div> 
                </div>
                </div>
                <div class="col-lg-5 mt-lg-5 pt-lg-5">
                    <div class="card align-m px-2">
                        <div class="card-body py-4">                            
                            <form action="" id="process_payment" method="POST">
                                <?php
                                    $accnt_id = $_GET['id'];
                                    $qry = $mysqli->query("SELECT * FROM abuloy_accounts WHERE id = ".$aid);
                                    if($user= $qry->fetch_assoc()):
                                        $account_id = $user['id'];
                                        $fname = $user['d_firstname'];
                                        $mname = $user['d_middlename'];
                                        $lname = $user['d_lastname'];
                                        
                                        // $code_qry =  $mysqli->query("SELECT * FROM payments ORDER BY id DESC")->num_rows;
                                        // $code = $code_qry + 1;
                                        // echo $account_id;
                                    // $goal_amount = $user['d_goal_amount'];
                                ?>
                                <input type="hidden" name="account_id" id="account_id" value="<?php echo $aid ?>">
                                <input type="hidden" name="account_name" id="account_name" value="<?php echo $fname ?> <?php echo $lname ?>">
                                <input type="hidden" name="user_type" id="user_type" value="2">
                                <input type="hidden" name="status" id="status" value="0">
                                <input type="hidden" name="request_id" id="request_id" value="pending"> 
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
                                    <label class="form-check-label pt-1 ps-2" for="anonymous">Make my donation anonymous</label>
                                </div>
                                <div class="pb-1 hide" id="note">
                                    <small>NOTE: </small><small>As you wish to be an anonymous donator your name and donation will not be listed in public view under Funders list.</small>
                                </div>                                                        
                                <input type="text" class="form-control text-blackish mb-3 text-center" name="customer_name" id="customer_name" placeholder="Add Your Name">
                                <div class="gcash-form pb-2 pt-0" id="gcashFormReq">
                                    <input type="hidden" class="form-control text-blackish mb-3 text-center" name="customer_name" id="customer_name" placeholder="First & Last Name">
                                    <input type="hidden" class="form-control text-blackish mb-3 text-cente" name="customer_email" id="customer_email" placeholder="Email Address">
                                    <input type="hidden" class="form-control text-blackish mb-3 text-center" name="customer_mobile" id="customer_mobile" placeholder="Mobile Number">
                                </div>
                                
                                <textarea name="description" id="description" class="form-control text-blackish text-center" rows="3" placeholder="Add a short message" required></textarea>
                                <div class="form-check pt-4 pb-0" id="terms">
                                    <input type="checkbox" class="form-check-input" id="agreement" required>
                                    <label class="form-check-label pt-1 ps-2" for="agreement">I agree to <a href="/terms-and-conditions">Terms & Conditions</a></label>
                                </div>
                                <div class="pb-1 hide" id="paynote">
                                    <small>NOTE: </small><small>For a moment we only accept GCash payment.</small>
                                </div>   
                                <a id="acct_id_lnk" href="/donate?id=<?php echo $account_id ?>" class="hide"></a>                        
                                <button type="submit" id="donatebtn" class="btn btn-lavander fw-bold col-12 fs-larger text-uppercase p-2 mt-3 my-2 align-center" >
                                    DONATE
                                </button>
                                <?php endif ?>
                                <!-- <button type="submit" id="donated" class="btn btn-lavander col-12 fs-larger text-uppercase my-2 align-center" >
                                    DONATED
                                </button> -->                            
                                <a id="paynow" class="btn btn-lavander fw-bold fs-larger text-uppercase px-2 my-1 py-1 align-center hide">
                                    <img src="assets/img/gcash.png" height="40px"> Pay Now
                                </a>

                                
                                <!-- <a href="https://www.paypal.com/donate/?hosted_button_id=RW46D3593NK74#" class="col-lg-4 col-md-6 col-sm-12 hide"><img src="https://craftindustryalliance.org/wp-content/uploads/2019/04/PayPal_logo_logotype_emblem.png" alt="" height="25px" class="text-center align-center mx-auto pe-2"></a> -->

                                <div id="sharenow" class="">
                                    <div class="hide text-lavander text-center text-uppercase mt-3 fw-bold">or share to</div>
                                    <div class="text-blackish text-center mt-1 fw-bold"></div>
                                    <a target="_blank" data-href="https://abuloy.ph/donate?id=<?php echo $aid ?>&scrape=true" data-layout="button_count" href="https://www.facebook.com/sharer.php?u=https%3A%2F%2Fabuloy.ph%2Fdonate%26id%3D<?php echo $aid ?>&scrape=true" 
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
                                    <a href="https://www.paypal.com/donate/?hosted_button_id=RW46D3593NK74" target="_blank" class="col-lg-4 col-md-6 col-sm-12"><img src="http://abuloy.ph/assets/img/paypal.png" alt="" height="25px" class="text-center align-center mx-auto pe-2"></a>
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
            </div> 
            <div class="row mt-3">
                <div class="accordion col-lg-7 col-md-12 col-sm-12 mb-3" id="accordionPanelsStayOpenExample">
                    <div class="accordion-item">
                        <div class="accordion-header bg-aquamarine text-blackish" id="panelsStayOpen-headingOne">
                            <button class="bg-aquamarine text-purple fw-bold" type="button">
                                Who is <?php echo $fname ?> 
                                <?php echo $mname[0] ?>. <?php echo $lname ?>?
                            </button>
                        </div>
                        <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
                        <div class="accordion-body">
                        <?php if(isset($user['d_summary'])){ printf('%s', $user['d_summary']); } ?>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="accordion col-lg-5 col-md-12 col-sm-12" id="accordionPanelsStayOpenExample">
                    <div class="accordion-item">
                        <div class="accordion-header bg-aquamarine text-blackish" id="panelsStayOpen-headingOne">
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
                                while($user=$donatorsqry->fetch_assoc()){
                                    $funders = $user['customer_name'];
                                    if($funders != ''){
                                ?>
                                <tr>
                                    <td class="bg-light-lavander text-purple text-left fw-bold" width="30%">₱ <i><?= $user['amount'] ?>.00</i></td>
                                    <td><span class="text-lavander fw-bold"><?= $user['customer_name'] ?></span> <br/><i style="font-size:14px">"<?= $user['description']?>"</i></td>
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

<?php
}
?>
    <!-- start Footer Area -->
    <?php include './footer.php' ?>     
    <!-- end Footer Area -->

    <!-- Plugins -->
    <?php include './plugin_views.php'; ?>
    <!-- Custom Script -->
    <script src="controllers/donate.js"></script>
</body>
</html>