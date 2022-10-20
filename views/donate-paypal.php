<?php
    $twhere ="";
    if($_SESSION['login_type'] != 1)
      $twhere = "  ";
    // switch between admin(1) and user(2)
    $where = "";
    if($_SESSION['login_type'] == 1){
        $where = " where id = '{$_SESSION['login_id']}' ";
    }elseif($_SESSION['login_type'] == 2){
        $where = " where a.user_id = '{$_SESSION['login_user_id']}' ";
    }
    if(isset($_GET['id'])){
        $qry = $conn->query("SELECT * FROM accounts a INNER JOIN users u ON (a.user_id = u.id) where a.user_id = ".$_GET['id'])->fetch_array();
        foreach($qry as $k => $v){
            $$k = $v;
        }
    }
    if(isset($_SESSION['user_id'])){
        $qry = $conn->query("SELECT * FROM accounts a INNER JOIN users u ON (a.user_id = u.id) where a.user_id = ".$_GET['user_id'])->fetch_array();
        foreach($qry as $k => $v){
            $$k = $v;
        }
    }

?>
<?php if($_SESSION['login_type'] == 2) { ?> 
<div id="fb-root"></div>  
<!-- For Users with Account Registered and have Funds to Raise -->
<section class="py-5 my-5">
    <div class="overlay overlay-bg bg-aquamarine"></div>
    <div class="container">
        <div class="row">
            <div class="col-12 align-right pt-4 pb-2">
                <a href="./index.php?page=donees" type="button" class="btn btn-lavander px-3 py-2">
                    <i class="fa fa-users pe-1 text-aquamarine"></i>  View Other Funds 
                </a>
            </div>
        </div>
        <hr class="mt-0"/>        
        <div class="row">
            <div class="col-lg-7 mt-2">
                <?php
                    $user_id = $_SESSION['login_id'];
                    $acct_id = $_GET['id'];
                    $qry = $conn->query("SELECT * FROM accounts a INNER JOIN users u ON (a.user_id = u.id) where a.id =" .$acct_id);
                    if($row= $qry->fetch_assoc()){
                    $bdate = $row['d_birthdate'];
                    $dod = $row['d_date_of_death'];
                    $profilepic = $row['avatar'];
                ?>    
                <legend for="" class="fw-bold text-lavander text-center">
                    <?php if(isset($row['d_firstname'])){ printf('%s %s', $row['d_firstname'], $row['d_lastname']); } ?>
                </legend>
                <p for="" class="fw-bold text-blackish text-center fs-larger">
                <?php echo date("M d, Y",strtotime($bdate)) ?> - <?php echo date("M d, Y",strtotime($dod)) ?>
                </p>
                <div class="card bg-solid-silver">
                    <a target="_blank" class="mx-auto"><img class="img-fluid img-responsive avatar-profile" src="assets/uploads/<?php echo $profilepic ?>" alt=""> </a>
                </div>
                <!-- Your share button code -->
                
                <?php } ?>
                <div class="col-12 py-3 px-2">
                    <?php
                        $account_id = $_GET['id'];
                        $qry = $conn->query("SELECT *,SUM(g.gcash_amount) as total_raised FROM gcash_payments g INNER JOIN accounts a ON a.id = g.account_id where a.id ='$account_id' and g.gcash_status = 'paid'");            
                        if($row= $qry->fetch_assoc()){ 
                            $goal_amount = $row['d_goal_amount'];
                    ?> 
                    <label for="goal-raised-progress" class="fs-larger">
                        <span class="larger fw-700">₱<?php echo number_format($row['total_raised'],2, '.', ',') ?></span>
                        raised over ₱<?php echo number_format($goal_amount, 2, '.', ',');?> goal
                    </label>
                    <?php } ?>
                    <?php
                        $account_id = $_GET['id'];
                        $total_gcash_amount = $conn->query("SELECT SUM(g.gcash_amount) as total_raised FROM gcash_payments g INNER JOIN accounts a ON a.id = g.account_id WHERE a.id ='$account_id' and g.gcash_status = 'paid'")->fetch_array();
                        foreach($total_gcash_amount as $key => $raised){
                            $$key = $raised;
                        }
                        $the_goal_amount = $conn->query("SELECT d_goal_amount as the_goal_amount FROM accounts WHERE id =".$account_id)->fetch_array();
                        foreach($the_goal_amount as $k => $goal){
                            $$k = $goal;
                        }
                        $raised_percent = $goal > 0 ? round($raised * 100 / $goal ) : 0;
                    ?> 
                    <div class="col-lg-12 align-center mx-auto p-0">          
                        <div style="height: 25px; width:100%; background-color: rgba(148,247,207,0.55);border-radius:25px;">
                            <div class="mh-100 px-5 text-aquamarine text-center" style="width: <?php echo $raised_percent ?>%; height: 100px; background-color: rgba(162,101,230,0.8);border-radius:25px;font-size:17px;"> <?php echo $raised_percent ?>% </div>
                        </div>
                    </div> 
                </div>
                
            </div>
            <div class="col-lg-5 mt-lg-5 pt-lg-5 block">
                <div class="card align-m px-2">
                    <div class="card-body py-4" id="smart-button-container">
                        <form action="" id="manage_user_gcash_donation" class="block">
                            <?php
                                $user_id = $_SESSION['login_id'];
                                $acct_id = $_GET['id'];
                                $qry = $conn->query("SELECT * FROM accounts a INNER JOIN users u ON (a.user_id = u.id) where a.id =" .$acct_id);
                                if($row= $qry->fetch_assoc()):
                                    // $a_id = $row['account_id'];
                                $bdate = $row['d_birthdate'];
                                $dod = $row['d_date_of_death'];
                                $goal_amount = $row['d_goal_amount'];
                            ?>
                            <input type="hidden" name="account_id" id="account_id" value="<?php echo $acct_id ?>">
                            <input type="hidden" name="user_type" id="user_type" value="2">
                            <input type="hidden" name="gcash_fee" id="gcash_fee" value="0.02">
                            <input type="hidden" name="customername" id="customername" value="John Doe">
                            <input type="hidden" name="customeremail" id="customeremail" value="johndoe@gmail.com">
                            <input type="hidden" name="customermobile" id="customermobile" value="09089879592">
                            <input type="hidden" name="gcash_abuloy_fee" id="gcash_abuloy_fee" value="0.03">
                            <label for="amount" id="donate_label" class="d-flex text-lavander fw-800 justify-content-center fs-larger">Enter Amount</label>
                            <label for="amount" id="paynow_label" class="d-flex text-lavander fw-800 justify-content-center fs-larger hide">You will donate an Amount of</label>
                            <p for="amount" class="text-black fs-small hide">A minimum of ₱ 25.00 and above is appreciated.</p>
                            <div class="input-group mb-3 mt-3">
                                <span class="input-group-text fw-bold fs-larger px-auto px-4">₱</span>
                                <input type="number" name="gcash_amount" id="amount" class="form-control text-blackish amount-input fw-bold fs-larger py-0 px-auto text-center" aria-label="Amount (to the nearest peso)" style="height:60px;font-size:50px" required>
                                <span class="input-group-text fw-bold fs-larger px-auto px-4">.00</span>
                                <small id="msg"></small>
                            </div>
                            <div class="form-check pb-2 pt-0" id="makeMeAnonymous">
                                <input type="checkbox" class="form-check-input" name="anonymous" id="anonymous">
                                <label class="form-check-label pt-1 ps-2" for="anonymous">Make my donation anonymous</label>
                            </div>                                                       
                            <input type="text" class="form-control text-blackish mb-3 text-center" name="donator_name" id="donator_name" placeholder="Add Your Name">
                            
                            <textarea name="condolence_message" id="condolence_message" class="form-control text-blackish text-center" rows="3" placeholder="Add a short message" required></textarea>
                            <div class="form-check pt-4 pb-0">
                                <input type="checkbox" class="form-check-input" name="agreement" id="agreement" required>
                                <label class="form-check-label pt-1 ps-2" for="agreement">I agree to <a href="./index.php?page=terms-and-conditions">Terms & Conditions</a></label>
                            </div>
                            <p id="descriptionError" style="visibility: hidden; color:red; text-align: center;">Please enter a description</p>
                            <div id="invoiceidDiv" style="text-align: center; display: none;"><label for="invoiceid"> </label><input name="invoiceid" maxlength="127" type="text" id="invoiceid" value="" ></div>
                            <p id="invoiceidError" style="visibility: hidden; color:red; text-align: center;">Please enter an Invoice ID</p> 
                            <a id="user_acct_id_link" href="index.php?page=donate&id=<?php echo $acct_id ?>" class="hide"></a>            
                            <button type="submit" id="donatebtn_user_paypal" onclick="" class="btn btn-lavander fw-bold col-12 fs-larger text-uppercase p-2 mt-3 my-2 align-center" >
                                DONATE
                            </button>
                            <?php endif ?>
                            <!-- <button type="submit" id="donated" class="btn btn-lavander col-12 fs-larger text-uppercase my-2 align-center" >
                                DONATED
                            </button> -->
                            <div style="text-align: center; margin-top: 0.625rem;" id="paypal-button-container"></div>
                            <a id="user_paynow_paypal" data-expiry="6" data-description="Payment for services rendered" data-href="https://getpaid.gcash.com/paynow" data-public-key="pk_d1def7eb7d0a89ba8df6b1a2aad5ca87" 
                            onclick="this.href = this.getAttribute('data-href') 
                                +'?public_key=' + this.getAttribute('data-public-key')
                                +'&amp;amount=' + document.getElementById('gcash_amount').value
                                +'&amp;fee=' + document.getElementById('gcash_amount').value * 0
                                +'&amp;expiry='+this.getAttribute('data-expiry')
                                +'&amp;description=' + this.getAttribute('data-description')
                                +'&amp;customername=' + document.getElementById('customername').value
                                +'&amp;customeremail=' + document.getElementById('customeremail').value
                                +'&amp;customermobile=' + document.getElementById('customermobile').value" target="_blank" class="btn btn-lavander fw-bold fs-larger text-uppercase px-2 my-1 py-1 align-center hide">
                                <img src="assets/img/gcash.png" height="40px"> Pay Now
                            </a>
                            <div id="sharenow" class="">
                                <div class="text-blackish text-center mt-3 fw-bold">OR</div>
                                <a target="_blank" data-href="https://www.abuloy.ph/index.php?page=donate&id=<?php echo $acct_id ?>" data-layout="button_count" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fwww.abuloy.ph%2Findex.php%3Fpage%3Ddonate%26id%3D<?php echo $acct_id ?>&src=sdkpreparse" 
                                    class="btn btn-aquamarine btn-default text-lavander btn-social btn-facebook btn-sm disableIfNotLive fw-bold col-12 mt-3" id="facebook" name="provider" value="Share On Facebook" title="Share On Facebook" style="margin-top:0px;">
                                    <i class="fab fa-facebook" style="margin-top: 0px;font-size:19px"></i>
                                    <span style="font-size:19px">SHARE</span>
                                </a>
                            </div>
                            <div id="otherpayments" class="hide">
                            <div class="text-lavander mt-5 mb-3 text-center">Other payment methods will be available soon</div>
                            <div class="col-12 d-flex">
                                <a class="col-lg-4 col-md-6 col-sm-12"><img src="https://www.ppro.com/wp-content/uploads/2021/06/pay-Maya-logo.png" alt="" height="25px" class="text-center align-center mx-auto pe-2"></a>
                                <a class="col-lg-4 col-md-6 col-sm-12"><img src="https://upload.wikimedia.org/wikipedia/en/thumb/5/55/Coins.ph_logo.svg/569px-Coins.ph_logo.svg.png" alt="" height="25px" class="text-center align-center mx-auto pe-2"></a>
                                <a class="col-lg-4 col-md-6 col-sm-12"><img src="https://craftindustryalliance.org/wp-content/uploads/2019/04/PayPal_logo_logotype_emblem.png" alt="" height="25px" class="text-center align-center mx-auto pe-2"></a>
                                
                            </div>
                            </div>                                                
                            <!-- <button onclick="facebook_share()" class="btn btn-aquamarine btn-default text-lavander btn-social btn-facebook btn-sm disableIfNotLive col-12 mt-3" id="facebook" name="provider" value="Share On Facebook" title="Share On Facebook" style="margin-top:0px;">
                                <i class="fab fa-facebook" style="margin-top: 0px;font-size:19px"></i>
                                <span style="font-size:19px">SHARE</span>
                            </button> -->
                        </form>
                    </div>
                </div>  
                <!-- <div class="col-lg-2 mx-auto align-center py-1 px-1 col-lg-12 col-md-12 col-sm-12 mt-4 mb-0 fw-bold" style="height:20px"><p>OR</p></div>
                <div class="col-lg-8 col-md-8 col-sm-5 mx-auto align-center py-1 px-1 mt-1 mb-2">                    
                    <div>
                    <a href="./index.php?page=profile_list" class="donate-btn btn btn-aquamarine btn-lg-round text-lavander fw-700 fs-larger col-lg-12 col-md-12 col-sm-12 mx-auto my-0  px-0 mx-0" style="position:relative;border-radius:5px;cursor:pointer;box-shadow:2px 2px 2px 2px" id="showFundForm"><i class="fab fa-facebook fa-2x px-3 my-auto py-auto"></i><span class="my-auto py-auto pb-5">Share to Facebook</span></a>
                    </div>
                </div> -->     
            </div>
            
        </div> 
        
        <?php
            $user_id = $_SESSION['login_id'];
            $acct_id = $_GET['id'];
            $qry = $conn->query("SELECT * FROM accounts a INNER JOIN users u ON (a.user_id = u.id) where a.id =" .$acct_id);
            if($row= $qry->fetch_assoc()):
            $bdate = $row['d_birthdate'];
            $dod = $row['d_date_of_death'];
            $goal_amount = $row['d_goal_amount'];
        ?>     
        <div class="row mt-3">
            <div class="accordion col-12" id="accordionPanelsStayOpenExample">
                <div class="accordion-item">
                    <h2 class="accordion-header bg-aquamarine text-blackish" id="panelsStayOpen-headingOne">
                    <button class="accordion-button text-purple" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                        Who is <?php if(isset($row['d_firstname'])){ printf('%s %s', $row['d_firstname'], $row['d_lastname']); } ?>?
                    </button>
                    </h2>
                    <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
                    <div class="accordion-body">
                    <?php if(isset($row['d_summary'])){ printf('%s', $row['d_summary']); } ?>
                    </div>
                    </div>
                </div>
            </div>                                  
        </div>
        <?php endif ?>
        
    </div>
</section>

    
<?php } else { ?> 
<!-- For Donators with No Account or Fund to Raise -->
<section class="py-5 my-5">
    <div class="overlay overlay-bg bg-aquamarine"></div>
    <div class="container">
        <div class="row">
            <div class="col-12 align-right pt-4 pb-2">
                <a href="./index.php?page=donees" type="button" class="btn btn-lavander px-3 py-2">
                    <i class="fa fa-users pe-1 text-aquamarine"></i>  View Other Funds 
                </a>
            </div>
        </div>
        <hr class="mt-0"/>
       
        <div class="row">
            
            <div class="col-lg-7 mt-2">
                <?php
                    $accnt_id = $_GET['id'];
                    $qry = $conn->query("SELECT * FROM accounts WHERE id = ".$accnt_id);
                    if($row= $qry->fetch_assoc()):
                        $account_id = $row['id'];
                        // echo $account_id;
                    $bdate = $row['d_birthdate'];
                    $dod = $row['d_date_of_death'];
                    $goal_amount = $row['d_goal_amount'];
                ?>
                <legend for="" class="fw-bold text-lavander text-center">
                    <?php if(isset($row['d_firstname'])){ printf('%s %s', $row['d_firstname'], $row['d_lastname']); } ?>
                </legend>
                <p for="" class="fw-bold text-blackish text-center fs-larger">
                <?php echo date("M d, Y",strtotime($bdate)) ?> - <?php echo date("M d, Y",strtotime($dod)) ?>
                </p>
                <div class="card p-0 bg-solid-silver">
                    <a target="_blank" class="mx-auto"><img class="img-fluid avatar-profile" src="assets/uploads/<?php echo $row['avatar'] ?>" alt=""> </a>
                </div>
                <?php endif ?>
                <div class="col-12 py-3 px-2">
                <!-- Your share button code -->
                <div class="fb-share-button mt-2 col-12" data-href="https://www.abuloy.ph/index.php?page=donate&id=<?php echo $act_id ?>" data-layout="button_count" data-size="large" data-title="Andres Bonifacio">
                    <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fwww.abuloy.ph%2Findex.php%3Fpage%3Ddonate%26id%3D<?php echo $act_id ?>&src=sdkpreparse" class="fb-xfbml-parse-ignore">Share</a>
                </div>
                <?php
                    $account_id = $_GET['id'];
                    $qry = $conn->query("SELECT *,SUM(g.gcash_amount) as total_raised FROM gcash_payments g INNER JOIN accounts a ON a.id = g.account_id where a.id ='$account_id' and g.gcash_status = 'paid'");            
                    if($row= $qry->fetch_assoc()): $goal_amount = $row['d_goal_amount'];
                ?> 
                <label for="goal-raised-progress" class="fs-larger">
                    <span class="larger fw-700">₱<?php echo number_format($row['total_raised'],2, '.', ',') ?></span>
                    raised over ₱<?php echo number_format($goal_amount, 2, '.', ',');?> goal
                </label>
                <?php endif ?>
                <?php
                    $account_id = $_GET['id'];
                    $total_gcash_amount = $conn->query("SELECT SUM(g.gcash_amount) as total_raised FROM gcash_payments g INNER JOIN accounts a ON a.id = g.account_id WHERE a.id ='$account_id' and g.gcash_status = 'paid'")->fetch_array();
                    foreach($total_gcash_amount as $key => $raised){
                        $$key = $raised;
                    }
                    $the_goal_amount = $conn->query("SELECT d_goal_amount as the_goal_amount FROM accounts WHERE id =".$account_id)->fetch_array();
                    foreach($the_goal_amount as $k => $goal){
                        $$k = $goal;
                    }
                    $raised_percent = $goal > 0 ? round($raised * 100 / $goal ) : 0;
                ?> 
                <div class="col-lg-12 align-center mx-auto p-0">          
                    <div style="height: 25px; width:100%; background-color: rgba(148,247,207,0.55);border-radius:25px;">
                        <div class="mh-100 px-5 text-aquamarine text-center" style="width: <?php echo $raised_percent ?>%; height: 100px; background-color: rgba(162,101,230,0.8);border-radius:25px;font-size:17px;"> <?php echo $raised_percent ?>% </div>
                    </div>
                </div> 
            </div>
            </div>
            <div class="col-lg-5 mt-lg-5 pt-lg-5">
                <div class="card align-m px-2">
                    <div class="card-body py-4"  id="smart-button-container">
                        
                        <form action="" id="manage_gcash_donation" >
                            <?php
                                $accnt_id = $_GET['id'];
                                $qry = $conn->query("SELECT * FROM accounts WHERE id = ".$accnt_id);
                                if($row= $qry->fetch_assoc()):
                                    $account_id = $row['id'];
                                    // echo $account_id;
                                $goal_amount = $row['d_goal_amount'];
                            ?>
                            <input type="hidden" name="account_id" id="account_id" value="<?php echo $account_id ?>">
                            <input type="hidden" name="user_type" id="user_type" value="2">
                            <input type="hidden" name="gcash_fee" id="gcash_fee" value="0.02">
                            <input type="hidden" name="customername" id="customername" value="John Doe">
                            <input type="hidden" name="customeremail" id="customeremail" value="johndoe@gmail.com">
                            <input type="hidden" name="customermobile" id="customermobile" value="09089879592">
                            <input type="hidden" name="gcash_abuloy_fee" id="gcash_abuloy_fee" value="0.03">
                            <label for="amount" id="donate_label" class="d-flex text-lavander fw-800 justify-content-center fs-larger">Enter Amount</label>
                            <label for="amount" id="paynow_label" class="d-flex text-lavander fw-800 justify-content-center fs-larger hide">You will donate an Amount of</label>
                            <p for="amount" class="text-black fs-small hide">A minimum of ₱ 25.00 and above is appreciated.</p>
                            <div class="input-group mb-3 mt-3">
                                <span class="input-group-text fw-bold fs-larger px-auto px-4">₱</span>
                                <input type="number" name="gcash_amount" id="gcash_amount" class="form-control text-blackish amount-input fw-bold fs-larger py-0 px-auto text-center" aria-label="Amount (to the nearest peso)" style="height:60px;font-size:50px" required>
                                <span class="input-group-text fw-bold fs-larger px-auto px-4">.00</span>
                                <small id="msg"></small>
                            </div>
                            <div class="form-check pb-2 pt-0" id="makeMeAnonymous">
                                <input type="checkbox" class="form-check-input" name="anonymous" id="anonymous">
                                <label class="form-check-label pt-1 ps-2" for="anonymous">Make my donation anonymous</label>
                            </div>                                                       
                            <input type="text" class="form-control text-blackish mb-3 text-center" name="donator_name" id="donator_name" placeholder="Add Your Name">
                            
                            <textarea name="condolence_message" id="condolence_message" class="form-control text-blackish text-center" rows="3" placeholder="Add a short message" required></textarea>
                            <div class="form-check pt-4 pb-0">
                                <input type="checkbox" class="form-check-input" name="agreement" id="agreement" required>
                                <label class="form-check-label pt-1 ps-2" for="agreement">I agree to <a href="./index.php?page=terms-and-conditions">Terms & Conditions</a></label>
                            </div> 
                            <a id="acct_id_lnk" href="index.php?page=donate&id=<?php echo $account_id ?>" class="hide"></a>                        
                            <button type="submit" id="donatebtn_paypal" class="btn btn-lavander fw-bold col-12 fs-larger text-uppercase p-2 mt-3 my-2 align-center" >
                                DONATE
                            </button>
                            <?php endif ?>
                            <!-- <button type="submit" id="donated" class="btn btn-lavander col-12 fs-larger text-uppercase my-2 align-center" >
                                DONATED
                            </button> -->
                            <a id="paynow_paypal" data-expiry="6" data-description="Payment for services rendered" data-href="https://getpaid.gcash.com/paynow" data-public-key="pk_d1def7eb7d0a89ba8df6b1a2aad5ca87" 
                            onclick="this.href = this.getAttribute('data-href') 
                                +'?public_key=' + this.getAttribute('data-public-key')
                                +'&amp;amount=' + document.getElementById('gcash_amount').value
                                +'&amp;fee=' + document.getElementById('gcash_amount').value * 0
                                +'&amp;expiry='+this.getAttribute('data-expiry')
                                +'&amp;description=' + this.getAttribute('data-description')
                                +'&amp;customername=' + document.getElementById('customername').value
                                +'&amp;customeremail=' + document.getElementById('customeremail').value
                                +'&amp;customermobile=' + document.getElementById('customermobile').value;" target="_blank" class="btn btn-lavander fw-bold fs-larger text-uppercase px-2 my-1 py-1 align-center hide">
                                <img src="assets/img/gcash.png" height="40px"> Pay Now
                            </a>
                            <div id="sharenow" class="">
                                <div class="text-blackish text-center mt-3 fw-bold">OR</div>
                                <a target="_blank" data-href="https://www.abuloy.ph/index.php?page=donate&id=<?php echo $account_id ?>" data-layout="button_count" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fwww.abuloy.ph%2Findex.php%3Fpage%3Ddonate%26id%3D<?php echo $account_id ?>&src=sdkpreparse" 
                                    class="btn btn-aquamarine btn-default text-lavander btn-social btn-facebook btn-sm disableIfNotLive fw-bold col-12 mt-3" id="facebook" name="provider" value="Share On Facebook" title="Share On Facebook" style="margin-top:0px;">
                                    <i class="fab fa-facebook" style="margin-top: 0px;font-size:19px"></i>
                                    <span style="font-size:19px">SHARE</span>
                                </a>
                            </div>
                            <div id="otherpayments" class="hide">
                            <div class="text-lavander mt-5 mb-3 text-center">Other payment methods will be available soon</div>
                            <div class="col-12 d-flex">
                                <a class="col-lg-4 col-md-6 col-sm-12"><img src="https://www.ppro.com/wp-content/uploads/2021/06/pay-Maya-logo.png" alt="" height="25px" class="text-center align-center mx-auto pe-2"></a>
                                <a class="col-lg-4 col-md-6 col-sm-12"><img src="https://upload.wikimedia.org/wikipedia/en/thumb/5/55/Coins.ph_logo.svg/569px-Coins.ph_logo.svg.png" alt="" height="25px" class="text-center align-center mx-auto pe-2"></a>
                                <a class="col-lg-4 col-md-6 col-sm-12"><img src="https://craftindustryalliance.org/wp-content/uploads/2019/04/PayPal_logo_logotype_emblem.png" alt="" height="25px" class="text-center align-center mx-auto pe-2"></a>
                                
                            </div>
                            </div>
                                                
                            <!-- <button onclick="facebook_share()" class="btn btn-aquamarine btn-default text-lavander btn-social btn-facebook btn-sm disableIfNotLive col-12 mt-3" id="facebook" name="provider" value="Share On Facebook" title="Share On Facebook" style="margin-top:0px;">
                                <i class="fab fa-facebook" style="margin-top: 0px;font-size:19px"></i>
                                <span style="font-size:19px">SHARE</span>
                            </button> -->
                        </form>

                    </div>
                </div>                            
            </div>
            
            
        </div> 
        
         
        
        
        <?php
            $account_id = $_GET['id'];
            $qry = $conn->query("SELECT * FROM accounts where id =".$account_id);
            if($row= $qry->fetch_assoc()):
                
            $bdate = $row['d_birthdate'];
            $dod = $row['d_date_of_death'];
            $goal_amount = $row['d_goal_amount'];
        ?>       
        <div class="row mt-3">
            <div class="accordion col-12" id="accordionPanelsStayOpenExample">
                <div class="accordion-item">
                    <h2 class="accordion-header bg-aquamarine text-blackish" id="panelsStayOpen-headingOne">
                    <button class="accordion-button text-purple" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                        Who is <?php if(isset($row['d_firstname'])){ printf('%s %s', $row['d_firstname'], $row['d_lastname']); } ?>?
                    </button>
                    </h2>
                    <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
                    <div class="accordion-body">
                    <?php if(isset($row['d_summary'])){ printf('%s', $row['d_summary']); } ?>
                    </div>
                    </div>
                </div>
            </div>                                  
        </div>
        <?php endif ?>
        
    </div>
</section>

<?php } ?>

<!-- <script>
//  data-toggle="modal" data-target="#manage_user_gcash"
// $('#manage_user_donation').click(function(){
//     uni_modal('Donation','donate-confirmation.php?id=')
// }) 
$(document).ready(function() {
    
    

})

</script> -->
<!-- <div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v13.0&appId=406588566187636&autoLogAppEvents=1" nonce="TorfkrpM"></script>