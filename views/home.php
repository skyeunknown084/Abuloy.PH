<?php 
// switch between admin(1) and user(2)
$where = "";
if($_SESSION['login_type'] == 1){
    $where = " where u.id = '{$_SESSION['login_id']}' ";
}elseif($_SESSION['login_type'] == 2){
    $where = " where a.user_id = '{$_SESSION['login_user_id']}' ";
}elseif($_SESSION['login_type'] == null){
    $where = "";
}
if($_SESSION['login_type'] == 2) { ?>
    
<section class="py-5" id="">
    <?php
        // $id = $_SESSION['login_id'];
        $qry = $conn->query("SELECT * FROM users u INNER JOIN accounts a on u.id = a.user_id WHERE a.user_id = ".$_SESSION['login_id']);
        
    ?>
    <div class="container py-5">
        <div class="row banner-content fullscreen align-items-center justify-content-start pb-4">
            <div class=" col-lg-7 col-md-6 col-sm-12 p-0 mb-4">
                <div class="col-lg-12 pt-5 ps-5">
                    <h3 class="text-blackish fw-700 block pt-5 pe-2">
                        <i>Hi <span class="text-lavander">
                        <?php echo ucwords($_SESSION['login_firstname']) ?>! </span></i>
                        <div class="pe-5 pt-0"><h4 class="pe-5 pt-0 mt-0 text-blackish">You successfully raised <br/>your first fund for</h4></div>
                        <?php
                        if($row = $qry->fetch_assoc()){
                        ?>
                        <span class="text-aquamarine text-underline">
                            <span class="text-lavander">
                            <?php echo ucwords($row['d_firstname']) ?> 
                            <?php if($row['d_middlename']!=''): ?>
                            <?php  
                                $words = explode(" ", $row['d_middlename']);
                                $mid_initial = "";                                
                                foreach ($words as $w) {
                                    $mid_initial .= $w[0];
                                } echo $mid_initial; ?>.
                            <?php endif ?> <?php echo ucwords($row['d_lastname']) ?>
                            </span>
                        </span>
                        <?php } ?>
                    </h3>
                    <br/>                    
                    <div class="pe-5 pt-0"><h5 class="pe-5 pt-0 mt-0">Click button below to see your funds now! </h5></div>
                    <a href="/profile_list" class="btn btn-lavander btn-round text-uppercase" id="showFundForm">Go To My Fund <i class="fas fa-chevron-right"></i><i class="fas fa-chevron-right"></i> </a>
                </div>                             
            </div>
            <div class="banner-img-container row align-items-center col-lg-5 col-md-6 col-sm-12 pt-5 pb-100 m-0 px-0 mx-0" id="fundForm">                
                <a href="/profile_list" class="donate-btn btn btn-aquamarine btn-lg-round text-lavander fw-700 fs-larger text-uppercase col-lg-6 col-md-6 col-sm-4 mx-auto my-0  px-0 mx-0" style="position:relative;bottom:-40vh;border-radius:25px;cursor:pointer;box-shadow:2px 2px 2px 2px" id="showFundForm">Donate Now <i class="fas fa-donate ps-2"></i> </a>
                <a href="/profile_list" class="col-lg-12 img-banner img-fluid m-0 bg-white  px-0 mx-0">
                    <img src="assets/img/banner-illustration-php.png" alt="" class="img-fluid col-lg-12 my-0  px-0 mx-0" style="height:55vh !important;">
                </a>                
            </div>  
        </div>
    </div>
</section>

<?php }elseif($_SESSION['login_type'] == 1) { ?>

<section class="py-3" id="">
    <div class="container">
        <div class="row banner-content fullscreen align-items-center justify-content-start pb-4">
            <div class="col-xl-7 col-lg-5 col-md-6 col-sm-12 p-0 mb-4">
                <div class="col-lg-12 pt-5 ps-5">
                    <h3 class="text-blackish fw-700 block pt-5 pe-2">
                        <i>Welcome <span class="text-lavander">
                        <?php echo ucwords($_SESSION['login_firstname']) ?>! </span></i>
                        <div class="pe-5 pt-0"><h4 class="pe-5 pt-0 mt-0 text-blackish">AMS Dashboard<br/></h4></div>
                        <span class="text-aquamarine text-underline hide"><span class="text-lavander">
                            <?php echo ucwords($row['d_firstname']) ?> 
                            <?php if($row['d_middlename']!=''): ?>
                            <?php  
                                $words = explode(" ", $row['d_middlename']);
                                $mid_initial = "";                                
                                foreach ($words as $w) {
                                    $mid_initial .= $w[0];
                                } echo $mid_initial; ?>.
                            <?php endif ?> <?php echo ucwords($row['d_lastname']) ?></span></span>
                    </h3><br/>                    
                    <div class="pe-5 pt-0"><h5 class="pe-5 pt-0 mt-0">Click button below to see your funds now! </h5></div>
                    <a href="/donees" class="btn btn-lavander btn-round text-uppercase" id="showFundForm">See All Funds <i class="fas fa-chevron-right"></i><i class="fas fa-chevron-right"></i> </a>
                </div> 
            </div>
            <div class="hide align-right banner-img-container row align-items-center col-xl-4 col-lg-5 col-md-6 col-sm-12 pt-5 pb-100 m-0 px-0 mx-0" id="fundForm">                
                <a href="/profile_list" class="donate-btn btn btn-aquamarine btn-lg-round text-lavander fw-700 fs-larger text-uppercase col-lg-6 col-md-6 col-sm-4 mx-auto my-0  px-0 mx-0" style="position:relative;bottom:-40vh;border-radius:25px;cursor:pointer;box-shadow:2px 2px 2px 2px" id="showFundForm">Donate Now <i class="fas fa-donate ps-2"></i> </a>
                <a href="/profile_list" class="col-lg-12 img-banner img-fluid m-0 bg-white  px-0 mx-0">
                    <img src="assets/img/banner-illustration-php.png" alt="" class="img-fluid col-lg-12 my-0  px-0 mx-0" style="height:55vh !important;">
                </a>                
            </div> 
            <div class="col-12 p-3 d-flex">
                <div class="col-md-6 col-xl-4 me-3">
                    <div class="card p-3 mb-3 widget-content bg-light-lavander">
                        <div class="widget-content-wrapper text-lavander fw-bold">
                            <div class="widget-content-left">
                                <div class="widget-heading">Total Donations</div>
                                <div class="widget-subheading">As of 2021 - 2022</div>
                            </div>
                            <div class="widget-content-right">
                                <?php 
                                    $total_donation = $conn->query("SELECT gcash_amount FROM gcash_payments")->num_rows;
                                ?>
                                <div class="widget-numbers text-dark-purple"><h4>??? <?=$total_donation?>.00</h4></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-4 me-3">
                    <div class="card p-3 mb-3 widget-content bg-aquamarine">
                        <div class="widget-content-wrapper text-lavander fw-bold">
                            <div class="widget-content-left">
                                <div class="widget-heading">Most Shared Platforms</div>
                                <div class="widget-subheading"><i class="fab fa-facebook-f"></i>acebook</div>
                            </div>
                            <div class="widget-content-right">
                                <div class="widget-numbers text-dark-purple"><h4>67% shares</h4></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-4 me-3">
                    <div class="card p-3 mb-3 widget-content bg-lavander">
                        <div class="widget-content-wrapper text-white fw-bold">
                            <div class="widget-content-left">
                                <div class="widget-heading">Total Funderaisers</div>
                                <div class="widget-subheading">As of 2021 - 2022</div>
                            </div>
                            <div class="widget-content-right">
                                <div class="widget-numbers text-aquamarine text-larger">
                                <?php 
                                    $total_fundraisers = $conn->query("SELECT user_id FROM accounts")->num_rows;
                                ?>
                                    <h4><?=$total_fundraisers?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>        
    </div>
    
</section>

<?php } else { ?>
    
    <section class="py-5" id="">
    <div class="container py-5">
        <div class="row banner-content fullscreen align-items-center justify-content-start pb-4">
            <div class=" col-lg-7 col-md-6 col-sm-12 p-0 mb-4">
                <div class="col-lg-12 pt-5 ps-5">
                    <h2>Welcome to <div class="text-aquamarine text-underline fw-900 pb-4"><span class="text-lavander">Abuloy</span></div></h2>
                    <div class="pe-5 pt-0"><h4 class="pe-5 pt-0 mt-0">Your can now help your love ones to raised a fund.</h4></div>
                    <a href="/register" class="btn btn-lavander btn-round text-uppercase" id="showFundForm">Start A Fund Now <i class="fas fa-hand-holding-heart ps-2"></i> </a>
                    
                </div>                             
            </div>
            <div class="banner-img-container row align-items-center col-lg-5 col-md-6 col-sm-12 pt-5 pb-100 m-0 px-0 mx-0" id="fundForm">                
                <a href="/donees" class="donate-btn btn btn-aquamarine btn-lg-round text-lavander fw-700 fs-larger text-uppercase col-lg-6 col-md-6 col-sm-4 mx-auto my-0  px-0 mx-0" style="position:relative;bottom:-40vh;border-radius:25px;cursor:pointer;box-shadow:2px 2px 2px 2px" id="showFundForm">Donate Now <i class="fas fa-donate ps-2"></i> </a>
                <a href="/donees" class="col-lg-12 img-banner img-fluid m-0 bg-white  px-0 mx-0">
                    <img src="assets/img/banner-illustration-php.png" alt="" class="img-fluid col-lg-12 my-0  px-0 mx-0" style="height:55vh !important;">
                </a>                
            </div> 
        </div>
    </div>
</section>

<?php } ?>

