<?php

?>
<section class="py-5" id="">
    <div class="container py-5">
        <div class="row banner-content fullscreen align-items-center justify-content-start pb-4">
            <div class=" col-lg-7 col-md-6 col-sm-12 p-0 mb-4">
                <div class="col-lg-12 pt-5 ps-5">
                    <h3 class="text-blackish fw-700 block pt-5 pe-2">
                        <i>Hi <span class="text-lavander"><?php echo ucwords($user['firstname']) ?>! </span></i>
                    </h3>
                    <?php 
                        $userqry = $mysqli->prepare("SELECT * FROM abuloy_users u INNER JOIN abuloy_accounts a ON u.id = a.uid WHERE a.uid = ".$user['id']);
                        $user_stmt = $userqry->execute();
                        $user_result = $userqry->get_result();
                        $user_row = $user_result->fetch_assoc();
                        if($row_user['id'] == ''){
                        ?>
                        <div class="pe-5 pt-0"><h5 class="pe-5 pt-0 mt-0 text-blackish">You haven't raised a fund yet.</h5></div>
                        <br/>
                        <div class="pe-5 pt-0"><h5 class="pe-5 pt-0 mt-0">Click button below create your first funds now! </h5></div>
                        <a href="/start-new-fund" class="btn btn-lavander btn-round text-uppercase" id="showFundForm">Start A Fund <i class="fas fa-chevron-right"></i><i class="fas fa-chevron-right"></i> </a>                    
                        <?php    
                        }elseif($row_user['id'] == 1){
                        ?>
                        <div class="pe-5 pt-0"><h4 class="pe-5 pt-0 mt-0 text-blackish">You successfully raised your first fund for</h4></div>
                        <br/>
                        <div class="pe-5 pt-0"><h5 class="pe-5 pt-0 mt-0">Click button below to see your funds now! </h5></div>
                        <a href="/profile_list" class="btn btn-lavander btn-round text-uppercase" id="showFundForm">Go To My Fund <i class="fas fa-chevron-right"></i><i class="fas fa-chevron-right"></i> </a>                    
                        <?php 
                        }
                        ?>
                    
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