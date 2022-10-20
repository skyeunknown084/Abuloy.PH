

<section class="py-5" id="">
    <div class="container py-5">
        <div class="row banner-content fullscreen align-items-center justify-content-start pb-4">
            <div class=" col-lg-12 col-md-12 col-sm-12 p-0 mb-4">
                <div class="col-lg-12 pt-5 ps-5">
                    <h2>Welcome to <div class="text-aquamarine text-underline fw-900 pb-4"><span class="text-lavander">Abuloy</span></div></h2>
                    <div class="col-6 justify-content-start typewriter"><h2>to&nbsp;donate;</h2></div>
                    <!-- to contribute; to aid; -->
                    <br/><br/>
                    <div class="pe-5 pt-0"><h4 class="pe-5 pt-0 mt-0">Your can now help your love ones to raised a fund.</h4></div>
                    <a href="/register" class="btn btn-lavander btn-round text-uppercase" id="showFundForm">Start A Fund Now <i class="fas fa-hand-holding-heart ps-2"></i> </a>
                    
                </div>                             
            </div>
            <!-- <div class="banner-img-container row align-items-center col-lg-5 col-md-6 col-sm-12 pt-5 pb-100 m-0 px-0 mx-0" id="fundForm">                
                <a href="/donees" class="donate-btn btn btn-aquamarine btn-lg-round text-lavander fw-700 fs-larger text-uppercase col-lg-6 col-md-6 col-sm-4 mx-auto my-0  px-0 mx-0" style="position:relative;bottom:-40vh;border-radius:25px;cursor:pointer;box-shadow:2px 2px 2px 2px" id="showFundForm">Donate Now <i class="fas fa-donate ps-2"></i> </a>
                <a href="/donees" class="col-lg-12 img-banner img-fluid m-0 bg-white  px-0 mx-0">
                    <img src="assets/img/banner-illustration-php.png" alt="" class="img-fluid col-lg-12 my-0  px-0 mx-0" style="height:55vh !important;">
                </a>                
            </div>  -->
        </div>
    </div>
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div><strong class="text-uppercase text-lavander">Register</strong></div>
                <p>Complete our simple registration form.</p>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div><strong class="text-uppercase text-lavander">Share</strong></div>
                <p>Share the link to your client's family and friends.</p>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div><strong class="text-uppercase text-lavander">Receive</strong></div>
                <p>Donations are processed and directly deposited to your funeral homes account.</p>
            </div>
        </div>
    </div>

    <div class="m-0 px-lg-5 p-0">
        <div class="container-fluid px-lg-5 p-5 text-center">
            <div class="row px-lg-5 ">
                <legend class="align-center pt-5 text-lavander">
                See All Funeral Funds
                </legend>
                <div class="align-center col-lg-12 pb-1">
                    <div class="col-lg-12">
                        <div class="d-flex">
                            <div class="btn-group me-2" role="group" style="height:38px">
                                <input type="radio" class="btn-check" name="btnradio" name="oldest_btn_user" id="oldestBtnUser" autocomplete="off">
                                <label class="btn btn-outline-primary" for="oldestBtnUser">Oldest</label>
                                <input type="radio" class="btn-check bg-lavander" name="btnradio" name="newest_btn_user" id="newestBtnUser" autocomplete="off" checked>
                                <label class="btn btn-outline-primary" for="newestBtnUser">Newest</label>
                            </div>
                            <div class="input-group mb-3 ms-2">
                                <input type="text" class="form-control" id="searchbar" onkeyup="search_donees()" type="text"
                                    name="search" placeholder="Search Name" aria-describedby="button-addon2">
                                <button class="btn btn-outline-primary" type="button" id="button-addon2" onclick="search_donees()"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>                   
                </div>
            </div>
            <div class="row px-lg-5 " id="new_donees_user">
                <?php
                $sql = "SELECT * FROM abuloy_accounts WHERE account_status = 1 ORDER BY id DESC";
                $result = $mysqli->query($sql);
                while($account = $result->fetch_assoc()){
                    $aid = $account['id'];
                    $uid = $account['uid'];
                    $fname = $account['d_firstname'];
                    $mname = $account['d_middlename'];
                    $lname = $account['d_lastname'];
                    $photo = $account['avatar'];
                    $summary = $account['d_summary'];
                    $bdate = $account['d_birthdate'];
                    $ddate = $account['d_date_of_death'];
                    $goal_amount = $account['d_goal_amount'];
                    $link = $account['url_link'];
                    $code = $account['short_code'];
                ?>
                <div class="col-lg-4 col-md-6 col-sm-12 px-md-2 donee">
                <div class="bg-white border shadow-sm mt-3" onclick="location.href='/donate/<?= $code ?>'">
                    <a target="_blank" href="/donate/<?= $code ?>" class="no-style">
                        <a target="_blank" href="/donate/<?= $code ?>" class="bd-placeholder-img card-img-top align-center mx-auto bg-solid-silver">
                            <?php if($photo == ''){ $no_image = 'https://abuloy.ph/assets/uploads/no-photo-available.png'; ?>
                                <img src="<?= $no_image ?>" alt="" style="width:75%; height: 275px; object-fit: contain">
                            <?php }else{ ?>
                                <img src="<?= 'https://abuloy.ph/assets/uploads/'.$photo ?>" alt="" style="width:70%; height: 275px; object-fit: contain">
                            <?php } ?>
                        </a>
                        <legend class="text-lavander text-center pb-0 mb-0" x="42%" y="90%"><?= $fname ?> <?= $lname ?></legend>
                        <text  fill="#eceeef" class="text-lavander text-center"><?php echo date("M d, Y",strtotime($bdate)); ?> - <?php echo date("M d, Y",strtotime($ddate)); ?></text>
                        <div class="card-body py-0 px-3">
                            <div class="my-2" style="height:59px">
                                <?php if($summary === ''){ ?>
                                    <p class="card-text text-center pt-4">N/A</p>
                                <?php }else{ ?>
                                    <p class="card-text text-justify pt-2"><?= substr($summary, 0, 65) . '...' ?></p>
                                <?php } ?> 
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted hide">location</small>
                                <div class="btn-group col-12">
                                <a href="/donate/<?= $aid ?>" type="button" class="btn btn-sm btn-lavander text-white py-2 px-5 hide">Donate Now</a>
                                </div>
                            </div>
                            <span class="hide"><strong class="text-lavander">₱<?= $goal_amount ?>.00</strong> of <medium class="text-muted">₱<?= $goal_amount ?>.00 target goal</medium></span>
                            <p class="fw-bold pt-2 mb-0">
                                <?php
                                    $progqry = $mysqli->query("SELECT *,SUM(amount) as total_raised FROM abuloy_payments WHERE aid = $aid and payment_status = 1");            
                                    while($progrow= $progqry->fetch_assoc()){
                                ?> 
                                <label for="goal-raised-progress" class="" style="font-size:15px">
                                    <span class="text-lavander">₱<?php echo number_format($progrow['total_raised'],2, '.', ',') ?>
                                    <i class="fw-none">of</i> ₱<?php echo number_format($goal_amount, 2, '.', ',');?> <i class="fw-none">goal</i></span>
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
                            <div class="my-0 pt-0">
                            <?php $fspqry = $mysqli->query("SELECT * FROM abuloy_users WHERE id = $uid");            
                                if($fsp= $fspqry->fetch_assoc()){ ?>
                                <small class=""><?php out($fsp['funeral_provider']) ?></small>
                                <?php
                                }
                            ?>
                            </div>
                        </div>
                    </a>
                </div>
                
                <?php
                }
                ?>
            </div>
            <div class="row px-lg-5 hide" id="old_donees_user">
                <?php
                $sql = "SELECT * FROM abuloy_accounts WHERE account_status = 1 ORDER BY id ASC";
                $result = $mysqli->query($sql);
                while($account = $result->fetch_assoc()){
                    $aid = $account['id'];
                    $uid = $account['uid'];
                    $fname = $account['d_firstname'];
                    $mname = $account['d_middlename'];
                    $lname = $account['d_lastname'];
                    $photo = $account['avatar'];
                    $summary = $account['d_summary'];
                    $bdate = $account['d_birthdate'];
                    $ddate = $account['d_date_of_death'];
                    $goal_amount = $account['d_goal_amount'];
                    $link = $account['url_link'];
                    $code = $account['short_code'];
                ?>
                <div class="col-lg-4 col-md-6 col-sm-12 px-md-2 donee">
                <div class="bg-white border shadow-sm mt-3" onclick="location.href='/donate/<?= $aid ?>'">
                    <a target="_blank" href="/donate/<?= $aid ?>" class="no-style">
                        <a target="_blank" href="/donate/<?= $aid ?>" class="bd-placeholder-img card-img-top align-center mx-auto bg-solid-silver">
                            <?php if($photo == ''){ $no_image = 'https://abuloy.ph/assets/uploads/no-photo-available.png'; ?>
                                <img src="<?= $no_image ?>" alt="" style="width:75%; height: 275px; object-fit: contain">
                            <?php }else{ ?>
                                <img src="<?= 'https://abuloy.ph/assets/uploads/'.$photo ?>" alt="" style="width:70%; height: 275px; object-fit: contain">
                            <?php } ?>
                        </a>
                        <legend class="text-lavander text-center pb-0 mb-0" x="42%" y="90%"><?= $fname ?> <?= $lname ?></legend>
                        <text  fill="#eceeef" class="text-lavander text-center"><?php echo date("M d, Y",strtotime($bdate)); ?> - <?php echo date("M d, Y",strtotime($ddate)); ?></text>
                        <div class="card-body py-0 px-3">
                            <div class="my-2" style="height:59px">
                                <?php if($summary === ''){ ?>
                                    <p class="card-text text-center pt-4">N/A</p>
                                <?php }else{ ?>
                                    <p class="card-text text-justify pt-2"><?= substr($summary, 0, 65) . '...' ?></p>
                                <?php } ?> 
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted hide">location</small>
                                <div class="btn-group col-12">
                                <a href="/donate/<?= $aid ?>" type="button" class="btn btn-sm btn-lavander text-white py-2 px-5 hide">Donate Now</a>
                                </div>
                            </div>
                            <span class="hide"><strong class="text-lavander">₱<?= $goal_amount ?>.00</strong> of <medium class="text-muted">₱<?= $goal_amount ?>.00 target goal</medium></span>
                            <p class="fw-bold pt-2 mb-0">
                                <?php
                                    $progqry = $mysqli->query("SELECT *,SUM(amount) as total_raised FROM abuloy_payments WHERE aid = $aid and payment_status = 1");            
                                    while($progrow= $progqry->fetch_assoc()){
                                ?> 
                                <label for="goal-raised-progress" class="" style="font-size:15px">
                                    <span class="text-lavander">₱<?php echo number_format($progrow['total_raised'],2, '.', ',') ?>
                                    <i class="fw-none">of</i> ₱<?php echo number_format($goal_amount, 2, '.', ',');?> <i class="fw-none">goal</i></span>
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
                            <div class="my-0 pt-0">
                            <?php $fspqry = $mysqli->query("SELECT * FROM abuloy_users WHERE id = $uid");            
                                if($fsp= $fspqry->fetch_assoc()){ ?>
                                <small class=""><?php out($fsp['funeral_provider']) ?></small>
                                <?php
                                }
                            ?>
                            </div>
                        </div>
                    </a>
                </div>
                
                <?php
                }
                ?>
            </div>        
            <div class="row px-lg-5 hide" id="filter_donees_user">
                <?php
                $sql = "SELECT * FROM abuloy_accounts WHERE d_firstname LIKE '{$input}%'";
                $result = $mysqli->query($sql);
                while($account = $result->fetch_assoc()){
                    $aid = $account['id'];
                    $uid = $account['uid'];
                    $fname = $account['d_firstname'];
                    $mname = $account['d_middlename'];
                    $lname = $account['d_lastname'];
                    $photo = $account['avatar'];
                    $summary = $account['d_summary'];
                    $bdate = $account['d_birthdate'];
                    $ddate = $account['d_date_of_death'];
                    $goal_amount = $account['d_goal_amount'];
                    $link = $account['url_link'];
                    $code = $account['short_code'];
                ?>
                <div class="col-lg-4 col-md-6 col-sm-12 px-md-2">
                <div class="bg-white border shadow-sm mt-3" onclick="location.href='/donate/<?= $aid ?>'">
                    <a target="_blank" href="/donate/<?= $aid ?>" class="no-style">
                        <a target="_blank" href="/donate/<?= $aid ?>" class="bd-placeholder-img card-img-top align-center mx-auto bg-solid-silver">
                            <?php if($photo == ''){ $no_image = 'https://abuloy.ph/assets/uploads/no-photo-available.png'; ?>
                                <img src="<?= $no_image ?>" alt="" style="width:75%; height: 275px; object-fit: contain">
                            <?php }else{ ?>
                                <img src="<?= 'https://abuloy.ph/assets/uploads/'.$photo ?>" alt="" style="width:70%; height: 275px; object-fit: contain">
                            <?php } ?>
                        </a>
                        <legend class="text-lavander text-center pb-0 mb-0" x="42%" y="90%"><?= $fname ?> <?= $lname ?></legend>
                        <text  fill="#eceeef" class="text-lavander text-center"><?php echo date("M d, Y",strtotime($bdate)); ?> - <?php echo date("M d, Y",strtotime($ddate)); ?></text>
                        <div class="card-body py-0 px-3">
                            <div class="my-2" style="height:59px">
                                <?php if($summary === ''){ ?>
                                    <p class="card-text text-center pt-4">N/A</p>
                                <?php }else{ ?>
                                    <p class="card-text text-justify pt-2"><?= substr($summary, 0, 65) . '...' ?></p>
                                <?php } ?> 
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted hide">location</small>
                                <div class="btn-group col-12">
                                <a href="/donate/<?= $aid ?>" type="button" class="btn btn-sm btn-lavander text-white py-2 px-5 hide">Donate Now</a>
                                </div>
                            </div>
                            <span class="hide"><strong class="text-lavander">₱<?= $goal_amount ?>.00</strong> of <medium class="text-muted">₱<?= $goal_amount ?>.00 target goal</medium></span>
                            <p class="fw-bold pt-2 mb-0">
                                <?php
                                    $progqry = $mysqli->query("SELECT *,SUM(amount) as total_raised FROM abuloy_payments WHERE aid = $aid and payment_status = 1");            
                                    while($progrow= $progqry->fetch_assoc()){
                                ?> 
                                <label for="goal-raised-progress" class="" style="font-size:15px">
                                    <span class="text-lavander">₱<?php echo number_format($progrow['total_raised'],2, '.', ',') ?>
                                    <i class="fw-none">of</i> ₱<?php echo number_format($goal_amount, 2, '.', ',');?> <i class="fw-none">goal</i></span>
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
                            <div class="my-0 pt-0">
                            <?php $fspqry = $mysqli->query("SELECT * FROM abuloy_users WHERE id = $uid");            
                                if($fsp= $fspqry->fetch_assoc()){ ?>
                                <small class=""><?php out($fsp['funeral_provider']) ?></small>
                                <?php
                                }
                            ?>
                            </div>
                        </div>
                    </a>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</section>