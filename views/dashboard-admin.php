<?php
$admintype = 3;
$update_log = $mysqli->prepare("UPDATE abuloy_users SET log_status = 1 WHERE user_type = $admintype");
$update_log->execute();
?>
<section class="py-3" id="">
    <div class="container">
        <div class="row align-items-center justify-content-start pb-4">
            <div class="col-xl-7 col-lg-5 col-md-6 col-sm-12 p-0 mb-4">
                <div class="col-lg-12 pt-5 ps-5">
                    <legend class="pe-5 pt-3 mt-0 text-blackish hide">
                        Welcome <span class="text-lavander">
                        <?php echo ucwords($user['firstname']) ?>! </span>
                    </legend>
                    <legend class="pe-5 pt-3 mt-0 text-blackish">Admin Dashboard</legend>                   
                    <div class="pe-5 pt-0"><h5 class="pe-5 pt-0 mt-0">Click button below to see your funds now! </h5></div>
                    <a href="/donees" class="btn btn-lavander btn-round text-uppercase" id="showFundForm">See All Funds <i class="fas fa-chevron-right"></i><i class="fas fa-chevron-right"></i> </a>
                </div> 
            </div>
            <!-- Status -->
            <div class="row d-flex">
                <div class="col-md-5 col-xl-4">
                    <div class="card p-3 mb-3 widget-content bg-light-lavander">
                        <div class="widget-content-wrapper text-lavander fw-500">
                            <div class="widget-content-left">
                                <div class="widget-heading">Total Donations</div>
                                <div class="widget-subheading">As of 2021 - 2022</div>
                            </div>
                            <div class="widget-content-right">
                                <?php 
                                    $total_donation = $mysqli->query("SELECT amount FROM abuloy_payments")->num_rows;
                                ?>
                                <div class="widget-numbers text-dark-purple"><h4><span>&#8369;</span> <?=$total_donation?>.00</h4></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 col-xl-4">
                    <div class="card p-3 mb-3 widget-content bg-aquamarine">
                        <div class="widget-content-wrapper text-lavander fw-500">
                            <div class="widget-content-left">
                                <div class="widget-heading">Most Shared Platforms</div>
                                <div class="widget-subheading"><i class="fab fa-facebook-f"></i>acebook</div>
                            </div>
                            <div class="widget-content-right">
                                <div class="widget-numbers text-dark-purple"><h4>11% shares</h4></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 col-xl-4">
                    <div class="card p-3 mb-3 widget-content bg-lavander">
                        <div class="widget-content-wrapper text-white fw-500">
                            <div class="widget-content-left">
                                <div class="widget-heading">Total Donators</div>
                                <div class="widget-subheading">As of 2021 - 2022</div>
                            </div>
                            <div class="widget-content-right">
                                <div class="widget-numbers text-aquamarine text-larger">
                                <?php 
                                    $total_fundraisers = $mysqli->query("SELECT uid FROM abuloy_accounts")->num_rows;
                                ?>
                                    <h4><?=$total_fundraisers?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- List -->
            <div class="row d-flex">
                <div class="col-md-5 col-xl-4">
                    <div class="card mb-3">
                        <div class="card-header bg-lavander hstack">
                        <h5 class="card-title text-white">Top Donators </h5>
                        <a href="#" class="text-white ms-auto" title="expand"><i class="fas fa-expand-arrows-alt"></i></a>
                        </div>
                        <div class="card-body">
                            
                            <div class="table-responsive" style="height:300px;scroll-y:auto">
                                <table class="table">
                                    <thead>
                                        <th>#</th>
                                        <th class="text-left">Donator</th>
                                        <th class="text-left">Fund</th>
                                        <th class="text-left">Amount</th>
                                        <th></th>
                                    </thead>
                                    <?php
                                    $funders_qry = $mysqli->query("SELECT * FROM abuloy_payments p INNER JOIN abuloy_accounts a ON p.aid = a.id ORDER BY p.amount DESC");
                                    // $funders_result = $funders_qry->execute();
                                    // $funders_result = $stmt->get_result();
                                    $funders = $funders_qry->fetch_assoc();

                                    if($funders){
                                        $i=1;
                                    ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td class="text-left"><?= $funders['customer_name'] ?></td>
                                        <td class="text-left"><?= $funders['account_name'] ?></td>
                                        <td class="text-left"><span>&#8369;</span> <?= $funders['amount'] ?>.00</td>
                                        <td class="text-center"><a href="#" class=""></a><i class="fas fa-receipt text-lavander bg-aquamarine" title="view details"></i></a></td>
                                    </tr>
                                    <?php
                                    }
                                    ?>
                                </table>
                            </div>
                        </div>
                        
                    </div>
                </div>    
                <div class="col-md-5 col-xl-4">
                    <div class="card mb-3">
                        <div class="card-header bg-light-lavander hstack">
                        <?php $total_active_funds = $mysqli->query("SELECT * FROM abuloy_payments WHERE payment_status = 1")->num_rows; ?>
                        <h5 class="card-title text-purple">Active Funds (<?= $total_active_funds ?>)</h5>
                        </div>
                        <div class="card-body">
                            
                            <div class="table-responsive" style="height:300px;scroll-y:auto">
                                <table class="table">
                                    <thead>
                                        <th>#</th>
                                        <th>Account</th>
                                        <th>Fund Goals</th>
                                        <th>Donated</th>
                                        <th></th>
                                    </thead>
                                    <?php
                                    $funders_qry = $mysqli->query("SELECT * FROM abuloy_payments p INNER JOIN abuloy_accounts a ON p.aid = a.id WHERE p.payment_status = 1");
                                    // $funders_result = $funders_qry->execute();
                                    // $funders_result = $stmt->get_result();
                                    $funders = $funders_qry->fetch_assoc();

                                    if($funders){
                                        $i=1;
                                    ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $funders['account_name'] ?></td>
                                        <td><span>&#8369;</span> <?= $funders['d_goal_amount'] ?></td>
                                        <td><span>&#8369;</span> <?= $funders['amount'] ?>.00</td>
                                        <td class="text-center"><a href="#" class=""></a><i class="fas fa-receipt text-lavander bg-aquamarine" title="view details"></i></a></td>
                                    </tr>
                                    <?php
                                    }
                                    ?>
                                </table>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="col-md-5 col-xl-4">
                    <div class="card mb-3">
                        <div class="card-header bg-aquamarine">
                            <?php $total_complete_funds = $mysqli->query("SELECT * FROM abuloy_payments WHERE payment_status = 5")->num_rows; ?>
                        <h5 class="card-title text-lavander">Completed Funds (<?= $total_complete_funds ?>)</h5>
                        </div>
                        <div class="card-body">
                            
                            <div class="table-responsive" style="height:300px;scroll-y:auto">
                                <table class="table">
                                    <thead>
                                        <th>#</th>
                                        <th>Account Name</th>
                                        <th>Withdraw Fund</th>
                                        <th></th>
                                    </thead>
                                    <?php
                                    $funders_qry = $mysqli->query("SELECT * FROM abuloy_payments p INNER JOIN abuloy_accounts a ON p.aid = a.id WHERE p.payment_status = 5");
                                    // $funders_result = $funders_qry->execute();
                                    // $funders_result = $stmt->get_result();
                                    $funders = $funders_qry->fetch_assoc();

                                    if($funders){
                                        $i=1;
                                    ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $funders['account_name'] ?></td>
                                        <td><span>&#8369;</span> <?= $funders['net_amount'] ?></td>
                                        <td class="text-center"><a href="#" class=""></a><i class="fas fa-receipt text-lavander bg-aquamarine" title="view details"></i></a></td>
                                    </tr>
                                    <?php
                                    }
                                    ?>
                                </table>
                            </div>
                        </div>
                        
                    </div>
                </div>
                
            </div>        
        </div>        
    </div>
    
</section>