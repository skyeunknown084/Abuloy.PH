<?php
// session_start();
error_reporting(0);
$twhere ="";
if($_SESSION['login_type'] != 1)
  $twhere = "  ";
?>
<?php 
if(isset($_GET['id'])){
	$qry = $conn->query("SELECT * FROM accounts where id = ".$_GET['id'])->fetch_array();
	foreach($qry as $k => $v){
		$$k = $v;
	}
}
?>

<?php 
    // switch between admin(1) and user(2)
    $where = "";
    if($_SESSION['login_type'] == 1){
        $where = " where id = '{$_SESSION['login_id']}' ";
    }elseif($_SESSION['login_type'] == 2){
        $where = " where user_id = '{$_SESSION['login_user_id']}' ";
    }
?>
<section class="" id="">
    
    <div class="collapse navbar-collapse" id="toggleNavbar">
    
        <ul class="navbar-nav ms-auto me-3 flex-right uppercase">
            <?php if($_SESSION['login_type'] != 2 && $_SESSION['login_type'] != 1) { ?>                                             
            <li class="nav-item">
                <a class="text-blackish-lavander btn-r-square px-3 nav-link" href="/login">Sign In <span class="sr-only">(Sign In)</span></a>
            </li>           
            <li class="nav-item">
                <a class="text-blackish-lavander btn-r-square px-3 nav-link" href="/register">Start A Fund <span class="sr-only">(Start A Fund)</span></a>
            </li>
            <?php } else { ?>         
                <li class="nav-item">
                    <a class="text-blackish-lavander btn-r-square px-3 nav-link" href="/startnewfund">Start A New Fund <span class="sr-only">(Start A Fund)</span></a>
                </li>
            <?php } ?>
            <li class="nav-item">
                <a class="text-blackish-lavander btn-r-square px-3 nav-link" href="/donees">Donate <span class="sr-only">(Donate)</span></a>
            </li>
            <li class="nav-item">
                <a class="text-blackish-lavander btn-r-square px-3 nav-link" href="/contact">Contact <span class="sr-only">(Contact)</span></a>
            </li>
            <?php if($_SESSION['login_type'] == 2) { ?>
            <li class="nav-item">            
                <div class="btn-group btn-lg pt-1">
                    <button type="button" class="btn btn-lavander btn-round btn-sm py-1 ps-1 pe-3 dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <span class="text-aquamarine" style="font-size:16px"><span class="hide"><?php echo $_SESSION['login_type'] ?> : </span><a><img src="assets/img/no-image-available.png" class="img-thumbnail me-2 ms-0 p-0 " style="border-radius:50%;height:25px;border:0px" alt=""></a><?php echo ucwords($_SESSION['login_firstname']) ?>!</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end mt-3">
                        <li><a class="dropdown-item" type="button" href="/profile_list">My Abuloys</a></li>
                        <hr class="py-0 my-0"/>
                        <li><a class="dropdown-item" type="button" href="/account_settings"><i class="fa fa-cog pe-2"></i> Account Settings</a></li>
                        <li><a class="dropdown-item" type="button" href="ajax.php?action=logout"><i class="fa fa-power-off pe-2"></i> Logout</a></li>
                    </ul>
                </div>            
            </li>
            <?php } ?>
            <?php if($_SESSION['login_type'] == 1) { ?>
            <li class="nav-item dropdown mx-0 px-0 ms-2">
                
                <a class="nav-link mx-0 px-0 notif-toggle"  data-toggle="dropdown" aria-expanded="true" href="javascript:void(0)">
                <span>
                    <div class="d-felx badge-pill mt-0">
                    <span class="fa fa-bell mr-0 mb-1 mt-0 pt-0" style="font-size:25px;padding:0;"></span><span class="badge badge-danger notif-count"></span>
                    </div>
                </span>
                </a>
                <div class="dropdown-menu notif-menu y-scroll" style="height:400px;y-overflow:auto"></div>
                
            </li>
            <li class="ms-2">
                <div class="btn-group btn-lg pt-1">
                    <button type="button" class="btn btn-lavander btn-round btn-sm py-1 ps-1 pe-3 dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <span class="text-aquamarine" style="font-size:16px"><span class="hide"><?php echo $_SESSION['login_type'] ?> : </span><a><img src="assets/img/no-image-available.png" class="img-thumbnail me-1 ms-0 p-0" style="border-radius:50%;height:25px;border:0px;" alt=""></a>Admin - <?php echo ucwords($_SESSION['login_firstname']) ?>!</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end mt-3">
                        <li><a class="dropdown-item" type="button" href="/profile_list">My Abuloys</a></li>
                        <hr class="py-0 my-0"/>
                        <li><a class="dropdown-item" type="button" href="/funds"><i class="fas fa-donate pe-2"></i> Funds Tracking</a></li>
                        <li><a class="dropdown-item" type="button" href="/withdrawals"><i class="fas fa-wallet pe-2"></i> Withdrawals</a></li>
                        <li><a class="dropdown-item" type="button" href="/emails"><i class="fa fa-envelope pe-2"></i> Emails Send & Received</a></li>
                        <li><a class="dropdown-item" type="button" href="/account-settings"><i class="fa fa-users pe-2"></i> Accounts Settings</a></li>
                        <li><a class="dropdown-item" type="button" href="/ajax?action=logout"><i class="fa fa-power-off pe-2"></i> Logout</a></li>
                    </ul>
                </div> 
            </li>
            <?php } ?>
        </ul>
    </div>
</section>