
<!DOCTYPE html>
<html lang="en">
<?php
include_once './global_call.php';
include_once './config/db_connect.php';
include_once './head_views.php';
?>
<!-- profile css -->
<link rel="stylesheet" href="./assets/dist/css/pages/profile.css">
</head>
<body>
    <?php include_once './header.php'; ?>

<?php if($_SESSION['login_type'] == 2) { ?>

    <section class="py-5 my-5">
        <div class="overlay overlay-bg bg-aquamarine"></div>
        <div class="container">
            <div class="row">
                <div class="col-12 align-right pt-4 pb-2">
                    <a href="./index.php?page=profile_list" type="button" class="btn btn-lavander px-3 py-2">
                        <i class="fa fa-arrow-left pe-1 text-aquamarine"></i>  Back 
                    </a>
                </div>
            </div>
            <hr class="mt-0"/>
            <?php
                $id = $_GET['id'];
                $qry = $conn->query("SELECT * FROM accounts a INNER JOIN users u ON(a.user_id = u.id) WHERE a.id =".$id);
                if($row= $qry->fetch_assoc()):
                $bdate = $row['d_birthdate'];
                $dod = $row['d_date_of_death'];
                $goal_amount = $row['d_goal_amount'];
            ?>
            <div class="row">
                <div class="col-lg-7">
                    <h1><?php echo $_SESSION['acct_id']; ?></h1>
                    <legend for="" class="fw-bold text-lavander text-center">
                        <?php if(isset($row['d_firstname'])){ printf('%s %s', $row['d_firstname'], $row['d_lastname']); } ?>
                    </legend>
                    <p for="" class="fw-bold text-blackish text-center fs-larger">
                    <?php echo date("M d, Y",strtotime($bdate)) ?> - <?php echo date("M d, Y",strtotime($dod)) ?>
                    </p>
                    <div class="card p-0 bg-solid-silver">
                        <a target="_blank" class="mx-auto"><img class="img-fluid avatar-profile" src="assets/uploads/<?php echo $row['avatar'] ?>" alt=""> </a>
                    </div>
                    <div class="col-lg-12 py-3 px-2">
                        <?php
                            $account_id = $_GET['id'];
                            $qry = $conn->query("SELECT *,SUM(amount) as total_raised FROM payments WHERE account_id = $account_id and status = 1");            
                            if($row= $qry->fetch_assoc()): $goal_amount = $row['d_goal_amount'];
                        ?> 
                        <label for="goal-raised-progress" class="fs-larger">
                            <span class="larger fw-700">₱<?php echo number_format($row['total_raised'],2, '.', ',') ?></span>
                            raised over ₱<?php echo number_format($goal_amount, 2, '.', ',');?> goal
                        </label>
                        <?php endif ?>
                        <?php
                            $account_id = $_GET['id'];
                            $total_amount = $conn->query("SELECT SUM(amount) as total_raised FROM payments WHERE account_id = $account_id and status = 1")->fetch_array();
                            foreach($total_amount as $key => $raised){
                                $$key = $raised;
                            }
                            $the_goal_amount = $conn->query("SELECT d_goal_amount as the_goal_amount FROM accounts WHERE id = $account_id")->fetch_array();
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
                    <div class="col-lg-8 col-md-8 col-sm-5 mx-auto align-center py-1 px-1 mb-2">
                        <a target="_blank" class="text-lavander col-lg-8 col-md-10 col-sm-12 py-1 no-style d-flex align-items-center align-left" style="font-size:24px;border-radius:25px;width:100%" data-href="https://www.abuloy.ph/index.php?page=donate&id=<?= $id ?>" data-layout="button_count" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fwww.abuloy.ph%2Findex.php%3Fpage%3Ddonate%26id%3D<?= $id ?>&src=sdkpreparse" class="fb-xfbml-parse-ignore"><i class="fab fa-facebook fa-2x px-3"></i><span class="pt-2">Share to Facebook</span></a>
                        <!-- <a href="donees.php" class="btn btn-lavander p-1">Share to Facebook </a> -->
                    </div>
                    <div class="col-lg-2 mx-auto align-center py-1 px-1 col-lg-12 col-md-12 col-sm-12 mb-0" style="height:20px"><p>OR</p></div>
                    <div class="col-lg-8 col-md-8 col-sm-5 mx-auto align-center py-2 px-1 pointer">
                        <a href="index.php?page=donate&id=<?= $id ?>" target="_blank" class="text-lavander py-1 col-lg-12 col-md-12 col-sm-12 no-style d-flex align-items-center align-left" style="font-size:24px;border-radius:25px;width:100%" ><i class="fas fa-donate fa-2x  px-3"></i><span class="pt-2">Add Donation Now</span></a>
                        <!-- <a href="donees.php" class="btn btn-lavander p-1">Share to Facebook </a> -->
                    </div>
                    
                                
                </div>
            </div>        
            <?php endif ?>        
            <div class="row">
                <?php
                    $account_id = $_GET['id'];
                    $qry = $conn->query("SELECT * FROM accounts WHERE id = $account_id");
                    if($row= $qry->fetch_assoc()):
                    $fname = $row['d_firstname'];
                    $lname = $row['d_lastname'];
                    $bdate = $row['d_birthdate'];
                    $dod = $row['d_date_of_death'];
                    $goal_amount = $row['d_goal_amount'];
                ?>  
                <div class="accordion col-12" id="accordionPanelsStayOpenExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header bg-aquamarine text-blackish" id="panelsStayOpen-headingOne">
                        <button class="accordion-button text-purple" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                            Who is <?php echo $fname ?> <?php echo $lname ?>?
                        </button>
                        </h2>
                        <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
                        <div class="accordion-body">
                        <?php if(isset($row['d_summary'])){ printf('%s', $row['d_summary']); } ?>
                        </div>
                        </div>
                    </div>
                </div>
                <?php endif ?>                                   
            </div>
        </div>
    </section>

<?php } elseif($_SESSION['login_type'] == 1) { ?>

    <section class="py-5 my-5">
        <div class="overlay overlay-bg bg-aquamarine"></div>
        <div class="container">
            <div class="row">
                <div class="col-12 align-right pt-4 pb-2">
                    <a href="./index.php?page=profile_list" type="button" class="btn btn-lavander px-3 py-2">
                        <i class="fa fa-arrow-left pe-1 text-aquamarine"></i>  Back 
                    </a>
                </div>
            </div>
            <hr class="mt-0"/>
            <?php
                $id = $_GET['id'];
                $qry = $conn->query("SELECT * FROM accounts a INNER JOIN users u ON(a.user_id = u.id) WHERE a.id =".$id);
                if($row= $qry->fetch_assoc()):
                $bdate = $row['d_birthdate'];
                $dod = $row['d_date_of_death'];
                $goal_amount = $row['d_goal_amount'];
            ?>
            <div class="row">
                <div class="col-lg-7">
                    <h1><?php echo $_SESSION['acct_id']; ?></h1>
                    <legend for="" class="fw-bold text-lavander text-center">
                        <?php if(isset($row['d_firstname'])){ printf('%s %s', $row['d_firstname'], $row['d_lastname']); } ?>
                    </legend>
                    <p for="" class="fw-bold text-blackish text-center fs-larger">
                    <?php echo date("M d, Y",strtotime($bdate)) ?> - <?php echo date("M d, Y",strtotime($dod)) ?>
                    </p>
                    <div class="card p-0 bg-solid-silver">
                        <a target="_blank" class="mx-auto"><img class="img-fluid avatar-profile" src="assets/uploads/<?php echo $row['avatar'] ?>" alt=""> </a>
                    </div>
                    <div class="col-lg-12 py-3 px-2">
                        <?php
                            $account_id = $_GET['id'];
                            $qry = $conn->query("SELECT *,SUM(amount) as total_raised FROM payments WHERE account_id = $account_id and status = 1");            
                            if($row= $qry->fetch_assoc()): $goal_amount = $row['d_goal_amount'];
                        ?> 
                        <label for="goal-raised-progress" class="fs-larger">
                            <span class="larger fw-700">₱<?php echo number_format($row['total_raised'],2, '.', ',') ?></span>
                            raised over ₱<?php echo number_format($goal_amount, 2, '.', ',');?> goal
                        </label>
                        <?php endif ?>
                        <?php
                            $account_id = $_GET['id'];
                            $total_amount = $conn->query("SELECT SUM(amount) as total_raised FROM payments WHERE account_id = $account_id and status = 1")->fetch_array();
                            foreach($total_amount as $key => $raised){
                                $$key = $raised;
                            }
                            $the_goal_amount = $conn->query("SELECT d_goal_amount as the_goal_amount FROM accounts WHERE id = $account_id")->fetch_array();
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
                    <div class="col-lg-8 col-md-8 col-sm-5 mx-auto align-center py-1 px-1 mb-2">
                        <a target="_blank" class="text-lavander col-lg-8 col-md-10 col-sm-12 py-1 no-style d-flex align-items-center align-left" style="font-size:24px;border-radius:25px;width:100%" id="shareBtn" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fabuloy.ph%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore"><i class="fab fa-facebook fa-2x px-3"></i><span class="pt-2">Share to Facebook</span></a>
                        <!-- <a href="donees.php" class="btn btn-lavander p-1">Share to Facebook </a> -->
                    </div>
                    <div class="col-lg-2 mx-auto align-center py-1 px-1 col-lg-12 col-md-12 col-sm-12 mb-0" style="height:20px"><p>OR</p></div>
                    <div class="col-lg-8 col-md-8 col-sm-5 mx-auto align-center py-2 px-1 pointer">
                        <a href="index.php?page=donate&id=<?= $id ?>" target="_blank" class="text-lavander py-1 col-lg-12 col-md-12 col-sm-12 no-style d-flex align-items-center align-left" style="font-size:24px;border-radius:25px;width:100%" ><i class="fas fa-donate fa-2x  px-3"></i><span class="pt-2">Add Donation Now</span></a>
                        <!-- <a href="donees.php" class="btn btn-lavander p-1">Share to Facebook </a> -->
                    </div>
                    
                                
                </div>
            </div>
            <?php endif ?>        
            <div class="row">
                <?php
                    $account_id = $_GET['id'];
                    $qry = $conn->query("SELECT * FROM accounts WHERE id = $account_id");
                    if($row= $qry->fetch_assoc()):
                    $fname = $row['d_firstname'];
                    $lname = $row['d_lastname'];
                    $bdate = $row['d_birthdate'];
                    $dod = $row['d_date_of_death'];
                    $goal_amount = $row['d_goal_amount'];
                ?>  
                <div class="accordion col-12" id="accordionPanelsStayOpenExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header bg-aquamarine text-blackish" id="panelsStayOpen-headingOne">
                        <button class="accordion-button text-purple" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                            Who is <?php echo $fname ?> <?php echo $lname ?>?
                        </button>
                        </h2>
                        <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
                        <div class="accordion-body">
                        <?php if(isset($row['d_summary'])){ printf('%s', $row['d_summary']); } ?>
                        </div>
                        </div>
                    </div>
                </div>
                <?php endif ?>                                   
            </div>
            
        </div>
    </section>

<?php } else {?>


    <!-- View Fund Details For Donators with/without Account -->
    <section class="py-5 my-1">
        <div class="overlay overlay-bg bg-aquamarine"></div>
        <div class="container">
            <div class="row hide">
                <div class="col-12 align-right pt-4 pb-2">
                    <a href="/donees" type="button" class="btn btn-lavander px-3 py-2">
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
                            $fname = $row['d_firstname'];
                            $lname = $row['d_lastname'];
                            // echo $account_id;
                        $bdate = $row['d_birthdate'];
                        $dod = $row['d_date_of_death'];
                        $goal_amount = $row['d_goal_amount'];
                    ?>
                    <input type="text" value="<?php echo $accnt_id ?>" id="donee-id" class="donee-id hide">
                    <input type="text" value="<?php echo $fname ?> <?php echo $lname ?>" id="donee-name" class="donee-name hide">
                    <legend for="" class="fw-bold text-lavander text-center" >
                        <?php if(isset($row['d_firstname'])){ printf('%s %s', $row['d_firstname'], $row['d_lastname']); } ?>
                    </legend>
                    <p for="" class="fw-bold text-blackish text-center fs-larger">
                    <?php echo date("M d, Y",strtotime($bdate)) ?> - <?php echo date("M d, Y",strtotime($dod)) ?>
                    </p>
                    <div class="card p-0 bg-solid-silver">
                        <a target="_blank" class="mx-auto"><img class="img-fluid avatar-profile donee-img" src="assets/uploads/<?php echo $row['avatar'] ?>" alt=""> </a>
                    </div>
                    <?php endif ?>
                    <div class="col-12 py-3 px-2">
                    <!-- Your share button code -->
                    <div class="hide fb-share-button mt-2 col-12" data-href="https://www.abuloy.ph/donate?id=<?php echo $act_id ?>" data-layout="button_count" data-size="large" data-title="Andres Bonifacio">
                        <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fwww.abuloy.ph%2Findex.php%3Fpage%3Ddonate%3Fid%3D<?php echo $act_id ?>&src=sdkpreparse" class="fb-xfbml-parse-ignore">Share</a>
                    </div>
                    <?php
                        $aid = $_GET['id'];
                        $progqry = $conn->query("SELECT *,SUM(amount) as total_raised FROM payments WHERE account_id = $aid and status = 1");            
                        if($row= $progqry->fetch_assoc()):
                            $goalamountqry = $conn->query("SELECT d_goal_amount FROM accounts WHERE id = $aid")->fetch_array();
                            foreach($goalamountqry as $key => $goalamount){
                                $$key = $goalamount;
                            }
                    ?> 
                    <label for="goal-raised-progress" class="fs-larger">
                        <span class="larger fw-700">₱<?php echo number_format($row['total_raised'],2, '.', ',') ?></span>
                        raised over ₱<?php echo number_format($goal_amount, 2, '.', ',');?> goal
                    </label>
                    <?php endif ?>
                    <?php
                        $account_id = $_GET['id'];
                        $total_amount = $conn->query("SELECT SUM(amount) as total_raised FROM payments WHERE account_id = $account_id and status = 1")->fetch_array();
                        foreach($total_amount as $key => $raised){
                            $$key = $raised;
                        }
                        $the_goal_amount = $conn->query("SELECT d_goal_amount as the_goal_amount FROM accounts WHERE id = $account_id")->fetch_array();
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
                    <div class="card align-m px-2 mb-3">
                        <div class="card-body py-4">                            
                            <form>
                                <div class="col-12 form-group">
                                    <a href="/donate?id=<?= $account_id ?>" class="col-12 btn btn-lavander text-uppercase fw-bold">
                                        Donate Now
                                    </a>

                                </div>
                                <div class="col-12 form-group">
                                    <div id="sharenow" class="">
                                        <div class="text-blackish text-center text-uppercase mt-3 fw-bold">or share to</div>
                                        <div class="text-blackish text-center mt-1 fw-bold"></div>
                                        <a target="_blank" data-href="https://abuloy.ph/donate?id=<?php echo $account_id ?>&scrape=true" data-layout="button_count" href="https://www.facebook.com/sharer.php?u=https%3A%2F%2Fabuloy.ph%2Fdonate%26id%3D<?php echo $account_id ?>&scrape=true" 
                                            class="hide btn btn-aquamarine btn-default text-lavander btn-social btn-facebook btn-sm disableIfNotLive fw-bold col-12 mt-3" id="facebook" name="provider" value="Share On Facebook" title="Share On Facebook" style="margin-top:0px;">
                                            <i class="fab fa-facebook" style="margin-top: 0px;font-size:19px"></i>
                                            <span style="font-size:19px">SHARE</span>
                                        </a>
                                        <div class="share-btn-container align-center">
                                            <a href="https://www.facebook.com/sharer.php?u=https://abuloy.ph/donate?id=<?php echo $account_id ?>" data-layout="button_count" class="facebook-btns fa-3x no-style ps-4 pe-3 disableIfNotLive" title="facebook">
                                                <i class="fab fa-facebook"></i>
                                            </a>
                                            <iframe class="hide" src="https://www.facebook.com/plugins/share_button.php?href=https%3A%2F%2Fabuloy.ph%2Fdonate%3Fid%3D1&layout=button_count&size=small&appId=959404248753205&width=77&height=20" width="77" height="20" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>

                                            <a href="http://twitter.com/share?url=https://abuloy.ph/donate?id=<?php echo $account_id ?>" id="twitter-btn" class="twitter-btn fa-3x no-style px-3" title="twitter">
                                                <i class="fab fa-twitter"></i>
                                            </a>
                                            <a href="whatsapp://send?text=https://abuloy.ph/donate?id=<?php echo $account_id ?>" data-action="share/whatsapp/share" class="fa-3x no-style px-3" title="whatsapp">
                                                <i class="fab fa-whatsapp"></i>
                                            </a>
                                            <?php 
                                                $emailshareqry = $conn->query("SELECT * FROM accounts WHERE id = $account_id");
                                                if($emailshare = $emailshareqry->fetch_assoc()):
                                            ?>
                                            <a href="mailto:?subject=In loving memory of <?php echo $emailshare['d_firstname'] ?> <?php echo $emailshare['d_lastname'] ?>&amp;body=Please share this link to help spread the news about <?php echo $emailshare['d_firstname'] ?> <?php echo $emailshare['d_lastname'] ?>. https://abuloy.ph/donate?id=<?php echo $emailshare['id'] ?>" target="_blank" class="email-btn fa-3x no-style ps-3 pe-4" title="email">
                                                <i class="fa fa-envelope"></i>
                                            </a>
                                            <?php endif ?>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                        
                    </div>
                    <div class="accordion col-lg-12 col-md-12 col-sm-12" id="accordionPanelsStayOpenExample">
                        <div class="accordion-item">
                            <div class="accordion-header bg-aquamarine text-blackish" id="panelsStayOpen-headingOne">
                                <button class="bg-aquamarine text-purple fw-bold" type="button">
                                    <?php $num_donators = $conn->query("SELECT * FROM payments WHERE donator_name != '' and account_id =".$account_id)->num_rows; ?>
                                    Funders (<?= $num_donators ?>)
                                </button>
                            </div>
                            <div class="accordion-body">
                                <table class="table table-bordered" style="border: 1px solid #A265E6">
                                    <?php
                                    // echo "List of Donators"
                                    $account_id = $_GET['id'];
                                    $donatorsqry = $conn->query("SELECT * FROM payments WHERE account_id =".$account_id." ORDER BY id desc LIMIT 10");
                                    while($row=$donatorsqry->fetch_assoc()){
                                        $funders = $row['donator_name'];
                                        if($funders != ''){
                                    ?>
                                    <tr>
                                        <td class="bg-light-lavander text-purple text-left fw-bold" width="30%">₱ <i><?= $row['amount'] ?>.00</i></td>
                                        <td><span class="text-lavander fw-bold"><?= $row['donator_name'] ?></span> <br/><i style="font-size:14px">"<?= $row['description']?>"</i></td>
                                    </tr>
                                    <?php }
                                    } ?>
                                </table>  
                            </div>
                            
                        </div>
                    </div>                          
                </div>
            </div> 
            <?php
                $account_id = $_GET['id'];
                $qry = $conn->query("SELECT * FROM accounts where id =".$account_id);
                if($row= $qry->fetch_assoc()):
                    $f_name = $row['d_firstname'];
                    $m_name = $row['d_middlename'];
                    $l_name = $row['d_lastname'];
                $bdate = $row['d_birthdate'];
                $dod = $row['d_date_of_death'];
                $goal_amount = $row['d_goal_amount'];
            ?>       
            <div class="row mt-3">
                <div class="accordion col-lg-7 col-md-12 col-sm-12 mb-3" id="accordionPanelsStayOpenExample">
                    <div class="accordion-item">
                        <div class="accordion-header bg-aquamarine text-blackish" id="panelsStayOpen-headingOne">
                            <button class="bg-aquamarine text-purple fw-bold" type="button">
                                Who is <?php echo $f_name ?> 
                                <?php echo $m_name[0] ?>. <?php echo $l_name ?>?
                            </button>
                        </div>
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

    <!-- start Footer Area -->
    <?php include './footer.php' ?>     
    <!-- end Footer Area -->

    <!-- Plugins -->
    <?php include_once './plugin_views.php'; ?>
    <!-- Custom Script -->
    <script src="controllers/profile.js"></script>
</body>
</html>