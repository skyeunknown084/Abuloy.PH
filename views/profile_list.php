<!DOCTYPE html>
<html lang="en">
<?php
include_once './global_call.php';
include_once './config/db_connect.php';
include_once './head_views.php';
?>
<!-- donees css -->
<link rel="stylesheet" href="./assets/dist/css/pages/profile?id=<?= $aid ?>-list.css">
</head>
<body>
    <?php include_once './header.php'; ?>

    <?php if($_SESSION['login_type'] == 2){ ?>
        <section class="py-5" id="">
            <div class="container pt-4">
                <?php $total_funds = $conn->query("SELECT * FROM accounts WHERE user_id = ".$_SESSION['login_id'])->num_rows; ?>
                <legend class="text-lg-right text-md-center text-sm-left pt-4 text-lavander align-right">
                    Search for a Abuloy Funds (<?= $total_funds ?>)
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
                    <?php $_SESSION['login_type'] ?>                
                    <div class="align-right col-lg-4 ms-2 mt-3">
                        <!-- <div class="input-group mb-3">
                            <input type="text" class="form-control" id="search_donees" placeholder="Search Full Name" aria-label="Search Full Name" aria-describedby="button-addon2">
                            <button class="btn btn-outline-primary" type="button" id="button-addon2"><i class="fa fa-search"></i></button>
                        </div> -->
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="searchbar" onkeyup="search_donees()" type="text"
                                name="search" placeholder="Search Name" aria-describedby="button-addon2">
                            <button class="btn btn-outline-primary" type="button" id="button-addon2" onclick="search_donees()"><i class="fa fa-search"></i></button>
                        </div>
                    </div>                
                </div>
                <div class="row d-flex p-0 hide" id="old_donees_user">
                    <?php
                        // $id = $_SESSION['login_id'];
                        $qry = $conn->query("SELECT * FROM accounts WHERE type = 2 ORDER BY id ASC");
                        while($row= $qry->fetch_assoc()):
                            $aid = $row['id'];
                            $_SESSION['account_id'] = $row['id'];
                            $bdate = $row['d_birthdate'];
                            $dod = $row['d_date_of_death'];
                            $goal_amount = $row['d_goal_amount'];
                    ?>
                    <div class="col-lg-3 col-md-6 col-sm-12 px-3 pb-4 donee">
                        <div class="card p-0">
                            <div class="card-body p-0 donee-photo">
                                <?php $no_image = 'https://abuloy.ph/assets/uploads/no-image-available.png'; ?>                            
                                <a target="_blank" href="/profile?id=<?= $aid ?>" class="align-center mx-auto bg-solid-silver">
                                    <?php if($row['avatar'] == ''){ ?>
                                        <img src="<?php echo $no_image ?>" alt="" style="width:75%; height: 275px;">
                                    <?php }else{ ?>
                                        <img src="assets/uploads/<?php echo isset($row['avatar']) ? $row['avatar'] : $no_image ?>" alt="" style="width:75%; height: 275px;">
                                    <?php } ?>
                                </a>
                            </div>
                            <div class="card-footer p-1 m-0 text-center">
                                <input type="hidden" id="aid" value="<?php echo $aid ?>" >
                                <div class="desc p-0 m-0"><b><?php echo ucwords($row['d_firstname']) ?> <?php echo ucwords($row['d_lastname']) ?></b><br><?php echo date("M d, Y",strtotime($bdate)) ?> - <?php echo date("M d, Y",strtotime($dod)) ?></div>
                                <div class="desc p-0 m-0"><a href="/donate?id=<?php echo $row['id'] ?>"  data-id="<?php echo $row['id'] ?>" class="align-center btn btn-lavander p-2">Donate Now</a></div>
                                <p class="fw-bold pt-2 mb-0">
                                    <?php
                                        $progqry = $conn->query("SELECT *,SUM(amount) as total_raised FROM payments WHERE account_id = $aid and status = 1");            
                                        while($progrow= $progqry->fetch_assoc()){
                                    ?> 
                                    <label for="goal-raised-progress" class="" style="font-size:15px">
                                        <span class="">₱<?php echo number_format($progrow['total_raised'],2, '.', ',') ?></span>
                                        of ₱<?php echo number_format($goal_amount, 2, '.', ',');?> goal
                                    </label>
                                    <?php } 
                                    $total_amount = $conn->query("SELECT SUM(amount) as total_raised FROM payments WHERE account_id = $aid and status = 1")->fetch_array();
                                    foreach($total_amount as $key => $raised){
                                        $$key = $raised;
                                    }
                                    $the_goal_amount = $conn->query("SELECT d_goal_amount as the_goal_amount FROM accounts WHERE id = $aid")->fetch_array();
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
                    <?php endwhile; ?>                 
                </div>
                <div class="row d-flex p-0" id="new_donees_user">
                    <?php
                        // $id = $_SESSION['login_id'];
                        $qry = $conn->query("SELECT * FROM accounts WHERE type = 2 ORDER BY id DESC");
                        while($row= $qry->fetch_assoc()):
                            $aid = $row['id'];
                            $_SESSION['account_id'] = $row['id'];
                            $bdate = $row['d_birthdate'];
                            $dod = $row['d_date_of_death'];
                            $goal_amount = $row['d_goal_amount'];
                    ?>
                    <div class="col-lg-3 col-md-6 col-sm-12 px-3 pb-4 donee">
                        <div class="card p-0">
                            <div class="card-body p-0 donee-photo">
                                <?php $no_image = 'https://abuloy.ph/assets/uploads/no-image-available.png'; ?>                            
                                <a target="_blank" href="/profile?id=<?= $aid ?>" class="align-center mx-auto bg-solid-silver">
                                    <?php if($row['avatar'] == ''){ ?>
                                        <img src="<?php echo $no_image ?>" alt="" style="width:75%; height: 275px;">
                                    <?php }else{ ?>
                                        <img src="assets/uploads/<?php echo isset($row['avatar']) ? $row['avatar'] : $no_image ?>" alt="" style="width:75%; height: 275px;">
                                    <?php } ?>
                                </a>
                            </div>
                            <div class="card-footer p-1 m-0 text-center">
                                <input type="hidden" id="aid" value="<?php echo $aid ?>" >
                                <div class="desc p-0 m-0"><b><?php echo ucwords($row['d_firstname']) ?> <?php echo ucwords($row['d_lastname']) ?></b><br><?php echo date("M d, Y",strtotime($bdate)) ?> - <?php echo date("M d, Y",strtotime($dod)) ?></div>
                                <div class="desc p-0 m-0"><a href="/donate?id=<?php echo $row['id'] ?>"  data-id="<?php echo $row['id'] ?>" class="align-center btn btn-lavander p-2">Donate Now</a></div>
                                <p class="fw-bold pt-2 mb-0">
                                    <?php
                                        $progqry = $conn->query("SELECT *,SUM(amount) as total_raised FROM payments WHERE account_id = $aid and status = 1");            
                                        while($progrow= $progqry->fetch_assoc()){
                                    ?> 
                                    <label for="goal-raised-progress" class="" style="font-size:15px">
                                        <span class="">₱<?php echo number_format($progrow['total_raised'],2, '.', ',') ?></span>
                                        of ₱<?php echo number_format($goal_amount, 2, '.', ',');?> goal
                                    </label>
                                    <?php } 
                                    $total_amount = $conn->query("SELECT SUM(amount) as total_raised FROM payments WHERE account_id = $aid and status = 1")->fetch_array();
                                    foreach($total_amount as $key => $raised){
                                        $$key = $raised;
                                    }
                                    $the_goal_amount = $conn->query("SELECT d_goal_amount as the_goal_amount FROM accounts WHERE id = $aid")->fetch_array();
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
                    <?php endwhile; ?>                 
                </div>
                <div class="row d-flex p-0 hide" id="filter_donees_user">
                    <?php
                    if(isset($_POST['input'])){
                        $input = $_POST['input'];
                    
                        $query = "SELECT * FROM accounts WHERE d_firstname LIKE '{$input}%' and type = 2";
                    
                        $result = mysqli_query($conn,$query);
                    
                        if(mysqli_num_rows($result) > 0){ 
                            while($row = mysqli_fetch_assoc($result)){
                                $_SESSION['account_id'] = $row['id'];
                                $bdate = $row['d_birthdate'];
                                $dod = $row['d_date_of_death'];
                            ?>
                            <div class="col-lg-3 col-md-6 col-sm-12 px-3 pb-4">
                                <div class="card p-0">
                                    <div class="card-body p-0 donee-photo">
                                        <?php $no_image = 'https://abuloy.ph/assets/uploads/no-image-available.png'; ?>   
                                        <a target="_blank" href="#" class="align-center mx-auto bg-solid-silver"><img src="assets/uploads/<?php echo isset($row['avatar']) ? $row['avatar'] : $no_image ?>" alt="" style="width:75%; height: 275px;"></a>
                                    </div>
                                    <div class="card-footer p-1 m-0 text-center">
                                        <div class="desc p-0 m-0"><b><?php echo ucwords($row['d_firstname']) ?> <?php echo ucwords($row['d_lastname']) ?></b><br><?php echo date("M d, Y",strtotime($bdate)) ?> - <?php echo date("M d, Y",strtotime($dod)) ?></div>
                                        <div class="desc p-0 m-0"><a href="/donate?id=<?php echo $row['id'] ?>" data-id="<?php echo $row['id'] ?>" class="align-center btn btn-lavander p-2">Donate Now</a></div>
                                    </div>
                                </div>                      
                            </div>
                            <?php       
                            }
                        }else{ ?>
                            <div class="col-md-12 p-0 px-3 py-4">
                                <div class="p-0 text-black">
                                    <h2>No List Found</h2>
                                </div>                      
                            </div>
                        <?php
                        }
                    } 
                    ?> 
                </div>
            </div>
        </section>
    <?php }else{ ?>
        <section class="py-5" id="">
            <div class="container pt-4">
                <?php $total_funds = $conn->query("SELECT * FROM accounts")->num_rows; ?>
                <legend class="text-lg-right text-md-center text-sm-left pt-4 text-lavander align-right">
                    Search for a Abuloy Funds (<?= $total_funds ?>)
                </legend>
                <div class="align-center col-lg-12 pb-1">
                    <div class="col-lg-8 align-left">
                        <div class="d-flex " >
                            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                <input type="radio" class="btn-check" name="btnradio" name="oldest_btn" id="oldestBtn" autocomplete="off">
                                <label class="btn btn-outline-primary" for="oldestBtn">Oldest</label>
                                <input type="radio" class="btn-check bg-lavander" name="btnradio" name="newest_btn" id="newestBtn" autocomplete="off" checked>
                                <label class="btn btn-outline-primary" for="newestBtn">Newest</label>
                            </div>
                        </div>
                    </div>
                    <?php $_SESSION['login_type'] ?>                
                    <div class="align-right col-lg-4 ms-2 mt-3">
                        <!-- <div class="input-group mb-3">
                            <input type="text" class="form-control" id="search_donees" placeholder="Search Full Name" aria-label="Search Full Name" aria-describedby="button-addon2">
                            <button class="btn btn-outline-primary" type="button" id="button-addon2"><i class="fa fa-search"></i></button>
                        </div> -->
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="searchbar" onkeyup="search_donees()" type="text"
                                name="search" placeholder="Search Name" aria-describedby="button-addon2">
                            <button class="btn btn-outline-primary" type="button" id="button-addon2"><i class="fa fa-search"></i></button>
                        </div>
                    </div>                
                </div>
                <div class="row d-flex p-0 hide" id="old_donees">
                    <?php
                        // $id = $_SESSION['login_id'];
                        $qry = $conn->query("SELECT * FROM accounts ORDER BY id ASC");
                        while($row= $qry->fetch_assoc()):
                            $aid = $row['id'];
                            $_SESSION['account_id'] = $row['id'];
                            $bdate = $row['d_birthdate'];
                            $dod = $row['d_date_of_death'];
                            $goal_amount = $row['d_goal_amount'];
                    ?>
                    <div class="col-lg-3 col-md-6 col-sm-12 p-0 px-3 pb-4 donee">
                        <div class="card p-0">
                            <div class="card-body p-0 donee-photo">
                                <?php $no_image = 'https://abuloy.ph/assets/uploads/no-image-available.png'; ?>                            
                                <a target="_blank" href="/profile?id=<?= $aid ?>" class="align-center mx-auto bg-solid-silver">
                                    <?php if($row['avatar'] == ''){ ?>
                                        <img src="<?php echo $no_image ?>" alt="" style="width:75%; height: 275px;">
                                    <?php }else{ ?>
                                        <img src="assets/uploads/<?php echo isset($row['avatar']) ? $row['avatar'] : $no_image ?>" alt="" style="width:75%; height: 275px;">
                                    <?php } ?>
                                </a>
                            </div>
                            <div class="card-footer p-1 m-0 text-center">
                                <input type="hidden" id="aid" value="<?php echo $aid ?>" >
                                <div class="desc p-0 m-0"><b><?php echo ucwords($row['d_firstname']) ?> <?php echo ucwords($row['d_lastname']) ?></b><br><?php echo date("M d, Y",strtotime($bdate)) ?> - <?php echo date("M d, Y",strtotime($dod)) ?></div>
                                <div class="desc p-0 m-0"><a href="/donate?id=<?php echo $row['id'] ?>"  data-id="<?php echo $row['id'] ?>" class="align-center btn btn-lavander p-2">Donate Now</a></div>
                                <p class="fw-bold pt-2 mb-0">
                                    <?php
                                        $progqry = $conn->query("SELECT *,SUM(amount) as total_raised FROM payments WHERE account_id = $aid and status = 1");            
                                        while($progrow= $progqry->fetch_assoc()){
                                    ?> 
                                    <label for="goal-raised-progress" class="" style="font-size:15px">
                                        <span class="">₱<?php echo number_format($progrow['total_raised'],2, '.', ',') ?></span>
                                        of ₱<?php echo number_format($goal_amount, 2, '.', ',');?> goal
                                    </label>
                                    <?php } 
                                    $total_amount = $conn->query("SELECT SUM(amount) as total_raised FROM payments WHERE account_id = $aid and status = 1")->fetch_array();
                                    foreach($total_amount as $key => $raised){
                                        $$key = $raised;
                                    }
                                    $the_goal_amount = $conn->query("SELECT d_goal_amount as the_goal_amount FROM accounts WHERE id = $aid")->fetch_array();
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
                    <?php endwhile; ?>                 
                </div>
                <div class="row d-flex p-0" id="new_donees">
                    <?php
                        // $id = $_SESSION['login_id'];
                        $qry = $conn->query("SELECT * FROM accounts ORDER BY id DESC");
                        while($row= $qry->fetch_assoc()):
                            $aid = $row['id'];
                            $_SESSION['account_id'] = $row['id'];
                            $bdate = $row['d_birthdate'];
                            $dod = $row['d_date_of_death'];
                            $goal_amount = $row['d_goal_amount'];
                    ?>
                    <div class="col-lg-3 col-md-6 col-sm-12 p-0 px-3 pb-4 donee">
                        <div class="card p-0">
                            <div class="card-body p-0 donee-photo">
                                <?php $no_image = 'https://abuloy.ph/assets/uploads/no-image-available.png'; ?>                            
                                <a target="_blank" href="/profile?id=<?= $aid ?>" class="align-center mx-auto bg-solid-silver">
                                    <?php if($row['avatar'] == ''){ ?>
                                        <img src="<?php echo $no_image ?>" alt="" style="width:75%; height: 275px;">
                                    <?php }else{ ?>
                                        <img src="assets/uploads/<?php echo isset($row['avatar']) ? $row['avatar'] : $no_image ?>" alt="" style="width:75%; height: 275px;">
                                    <?php } ?>
                                </a>
                            </div>
                            <div class="card-footer p-1 m-0 text-center">
                                <input type="hidden" id="aid" value="<?php echo $aid ?>" >
                                <div class="desc p-0 m-0"><b><?php echo ucwords($row['d_firstname']) ?> <?php echo ucwords($row['d_lastname']) ?></b><br><?php echo date("M d, Y",strtotime($bdate)) ?> - <?php echo date("M d, Y",strtotime($dod)) ?></div>
                                <div class="desc p-0 m-0"><a href="/donate?id=<?php echo $row['id'] ?>"  data-id="<?php echo $row['id'] ?>" class="align-center btn btn-lavander p-2">Donate Now</a></div>
                                <p class="fw-bold pt-2 mb-0">
                                    <?php
                                        $progqry = $conn->query("SELECT *,SUM(amount) as total_raised FROM payments WHERE account_id = $aid and status = 1");            
                                        while($progrow= $progqry->fetch_assoc()){
                                    ?> 
                                    <label for="goal-raised-progress" class="" style="font-size:15px">
                                        <span class="">₱<?php echo number_format($progrow['total_raised'],2, '.', ',') ?></span>
                                        of ₱<?php echo number_format($goal_amount, 2, '.', ',');?> goal
                                    </label>
                                    <?php } 
                                    $total_amount = $conn->query("SELECT SUM(amount) as total_raised FROM payments WHERE account_id = $aid and status = 1")->fetch_array();
                                    foreach($total_amount as $key => $raised){
                                        $$key = $raised;
                                    }
                                    $the_goal_amount = $conn->query("SELECT d_goal_amount as the_goal_amount FROM accounts WHERE id = $aid")->fetch_array();
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
                    <?php endwhile; ?>                 
                </div>
                <div class="row d-flex p-0 hide" id="filter_donees">
                    <?php
                    if(isset($_POST['input'])){
                        $input = $_POST['input'];
                    
                        $query = "SELECT * FROM accounts WHERE d_firstname LIKE '{$input}%'";
                    
                        $result = mysqli_query($conn,$query);
                    
                        if(mysqli_num_rows($result) > 0){ 
                            while($row = mysqli_fetch_assoc($result)){
                                $_SESSION['account_id'] = $row['id'];
                                $bdate = $row['d_birthdate'];
                                $dod = $row['d_date_of_death'];
                            ?>
                            <div class="col-lg-3 col-md-6 col-sm-12 p-0 px-3 pb-4">
                                <div class="card p-0">
                                    <div class="card-body p-0 donee-photo">
                                        <?php $no_image = 'https://abuloy.ph/assets/uploads/no-image-available.png'; ?>   
                                        <a target="_blank" href="#" class="align-center mx-auto bg-solid-silver"><img src="assets/uploads/<?php echo isset($row['avatar']) ? $row['avatar'] : $no_image ?>" alt="" style="width:75%; height: 275px;"></a>
                                    </div>
                                    <div class="card-footer p-1 m-0 text-center">
                                        <div class="desc p-0 m-0"><b><?php echo ucwords($row['d_firstname']) ?> <?php echo ucwords($row['d_lastname']) ?></b><br><?php echo date("M d, Y",strtotime($bdate)) ?> - <?php echo date("M d, Y",strtotime($dod)) ?></div>
                                        <div class="desc p-0 m-0"><a href="/donate?id=<?php echo $row['id'] ?>" data-id="<?php echo $row['id'] ?>" class="align-center btn btn-lavander p-2">Donate Now</a></div>
                                    </div>
                                </div>                      
                            </div>
                            <?php       
                            }
                        }else{ ?>
                            <div class="col-md-12 p-0 px-3 py-4">
                                <div class="p-0 text-black">
                                    <h2>No List Found</h2>
                                </div>                      
                            </div>
                        <?php
                        }
                    } 
                    ?> 
                </div>
            </div>
        </section>
    <?php } ?>
   
    <!-- start Footer Area -->
    <?php include './footer.php' ?>     
    <!-- end Footer Area -->

    <!-- Plugins -->
    <?php include_once './plugin_views.php'; ?>
    <!-- Custom Script -->
    <script src="./controllers/profile?id=<?= $aid ?>-list.js"></script>
</body>
</html>