<?php
session_start();
error_reporting(0);
require './global_call.php';
require './database.php';   
?>
<!DOCTYPE html>
<html lang="en">
<?php include './head_views.php'; ?>
<body>
    <?php include './header-admin.php' ?>

    <section class="py-5 my-3">
        <div class="container">
            <legend class="pt-5 pb-0 text-lavander">Withdrawals</legend>
            <hr class="m-0 p-0">
            <div class="mt-3">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" data-bs-toggle="tab" data-bs-target="#all">All Funds</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" data-bs-target="#pending">Pending</a>
                    </li>
                </ul>
                <div class="tab-content">                    
                    <div class="tab-pane fade show table-responsive" id="all">
                        <table class="table table-borderless table-striped table-condensed">
                            <thead>
                                <th>#</th>
                                <th>Account Name</th>
                                <th>Donator Name</th>
                                <th>Amount Donated</th>
                                <th>Date of Transaction</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </thead>
                            <tbody>
                                <?php 
                                    $all_funds_qry = $mysqli->prepare("SELECT * FROM abuloy_payments p INNER JOIN abuloy_accounts a WHERE p.payment_status = 1");
                                    $result_all_funds = $all_funds_qry->execute();
                                    $result_all_funds = $all_funds_qry->get_result();
                                    while($all_funds = $result_all_funds->fetch_assoc()){
                                    $i=1;
                                    $gid = $all_funds['id'];
                                    $utype = $all_funds['user_type'];
                                    $aid = $all_funds['aid'];
                                    $pay_status = $all_funds['payment_status'];
                                ?>
                                <tr>
                                    <td class="fw-500"><?= $i++ ?></td>
                                    <td class="fw-500"><?= $all_funds['account_name'] ?></td>
                                    <td class="fw-500"><?= $all_funds['customer_name'] ?></td>
                                    <td class="fw-500"><span class="mb-2">&#8369;</span> <?= $all_funds['amount'] ?></td>
                                    <td class="fw-500"><?= date("Y-m-d",strtotime($all_funds['date_added'])) ?> <span class="badge badge-success bg-lavander"> <?= date("h:i A",strtotime($all_funds['date_added'])) ?></td>
                                    <td class="text-center fw-500">
                                        
                                        <?php
                                            if($pay_status == 0){
                                                echo 'PENDING'; 
                                            }
                                            if($pay_status == 1){
                                                echo 'PAID';
                                            }
                                            if($pay_status == 2){
                                                echo 'REFUND';
                                            }
                                            if($pay_status == 3){
                                                echo 'EXPIRED';
                                            }
                                            if($pay_status == 4){
                                                echo 'CANCELLED';
                                            }
                                            if($pay_status == 5){
                                                echo 'WITHDRAW';
                                            }
                                        ?>
                                        <span class="hide">
                                        <select onchange="status_update(this.options[this.selectedIndex].value, '<?php echo $gid ?>')" name="payment_status" id="payment_status" class="btn btn-default btn-sm btn-round border-primary wave-effect text-lavander dropdown-toggle custom-select custom-select-sm" required>
                                            <option value="">Change Status</option>                                            
                                            <option value="0" <?php echo isset($pay_status) && $pay_status == 0 ? 'selected' : '' ?>><b>Pending</b></option>
                                            <option value="1" <?php echo isset($pay_status) && $pay_status == 1 ? 'selected' : '' ?>><b>Paid</b></option>
                                            <option value="2" <?php echo isset($pay_status) && $pay_status == 2 ? 'selected' : '' ?>><b>Refund</b></option>
                                            <option value="3" <?php echo isset($pay_status) && $pay_status == 3 ? 'selected' : '' ?>><b>Expired</b></option>
                                            <option value="4" <?php echo isset($pay_status) && $pay_status == 4 ? 'selected' : '' ?>><b>Cancelled</b></option>
                                            <option value="5" <?php echo isset($pay_status) && $pay_status == 5 ? 'selected' : '' ?>><b>Withdraw</b></option>
                                        </select>                                        
                                        </span>
                                    </td>
                                    <td class="text-center">                                        
                                        <a href="#" class=""></a><i class="fas fa-receipt text-lavander" title="view receipt" style="font-size:24px"></i></a>
                                        <div class="vr"></div>
                                        <a href="#" class=""></a><i class="fa fa-edit text-lavander" title="edit transaction" style="font-size:24px"></i></a>
                                        <div class="vr"></div>
                                        <a href="#" class=""></a><i class="fa fa-trash text-lavander" title="delete transaction" style="font-size:24px"></i></a>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade table-responsive" id="pending">
                        <table class="table table-borderless table-striped table-condensed">
                            <thead>
                                <th>#</th>
                                <th>Account Name</th>
                                <th>Donator Name</th>
                                <th>Amount Donated</th>
                                <th>Date of Transaction</th>
                                <th>Status</th>
                                <th class="text-center">Action</th>
                            </thead>
                            <tbody>
                                <?php 
                                    $all_funds_qry = $mysqli->prepare("SELECT * FROM abuloy_payments WHERE payment_status = 0");
                                    $result_all_funds = $all_funds_qry->execute();
                                    $result_all_funds = $all_funds_qry->get_result();
                                    while($all_funds = $result_all_funds->fetch_assoc()){
                                    $i=1;
                                    $gid = $all_funds['id'];
                                    $pay_status = $all_funds['payment_status'];
                                ?>
                                <tr>
                                    <td class="fw-500"><?= $i++ ?></td>
                                    <td class="fw-500"><?= $all_funds['account_name'] ?></td>
                                    <td class="fw-500"><?= $all_funds['customer_name'] ?></td>
                                    <td class="fw-500"><span class="mb-2">&#8369;</span> <?= $all_funds['amount'] ?></td>
                                    <td class="fw-500"><?= date("Y-m-d",strtotime($all_funds['date_added'])) ?> <span class="badge badge-success bg-lavander"> <?= date("h:i A",strtotime($all_funds['date_added'])) ?></td>
                                    <td class="text-center fw-500">
                                        <span class="hide">
                                        <?php
                                            if($pay_status == 0){
                                                echo 'PENDING'; 
                                            }
                                            if($pay_status == 1){
                                                echo 'PAID';
                                            }
                                            if($pay_status == 2){
                                                echo 'REFUND';
                                            }
                                            if($pay_status == 3){
                                                echo 'EXPIRED';
                                            }
                                            if($pay_status == 4){
                                                echo 'CANCELLED';
                                            }
                                            if($pay_status == 5){
                                                echo 'WITHDRAW';
                                            }
                                        ?>
                                        </span>
                                        <select onchange="status_update(this.options[this.selectedIndex].value, '<?php echo $gid ?>')" name="payment_status" id="payment_status" class="btn btn-default btn-sm btn-round border-primary wave-effect text-lavander dropdown-toggle custom-select custom-select-sm" required>
                                            <option value="">Change Status</option>                                            
                                            <option value="0" <?php echo isset($pay_status) && $pay_status == 0 ? 'selected' : '' ?>><b>Pending</b></option>
                                            <option value="1" <?php echo isset($pay_status) && $pay_status == 1 ? 'selected' : '' ?>><b>Paid</b></option>
                                            <option value="2" <?php echo isset($pay_status) && $pay_status == 2 ? 'selected' : '' ?>><b>Refund</b></option>
                                            <option value="3" <?php echo isset($pay_status) && $pay_status == 3 ? 'selected' : '' ?>><b>Expired</b></option>
                                            <option value="4" <?php echo isset($pay_status) && $pay_status == 4 ? 'selected' : '' ?>><b>Cancelled</b></option>
                                            <option value="5" <?php echo isset($pay_status) && $pay_status == 5 ? 'selected' : '' ?>><b>Withdraw</b></option>
                                        </select>
                                    </td>
                                    <td class="text-center">                                        
                                        <a href="#" class=""></a><i class="fas fa-receipt text-lavander" title="view receipt" style="font-size:24px"></i></a>
                                        <div class="vr"></div>
                                        <a href="#" class=""></a><i class="fa fa-edit text-lavander" title="edit transaction" style="font-size:24px"></i></a>
                                        <div class="vr"></div>
                                        <a href="#" class=""></a><i class="fa fa-trash text-lavander" title="delete transaction" style="font-size:24px"></i></a>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- start Footer Area -->
    <?php include './footer.php' ?>     
    <!-- end Footer Area -->

    <!-- Plugins -->
    <?php include './plugin_views.php'; ?>
    <!-- Custom Script -->
    <script src="../controllers/withdrawals.js"></script>
</body>
</html>