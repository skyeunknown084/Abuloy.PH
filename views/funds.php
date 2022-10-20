<!DOCTYPE html>
<html lang="en">
<?php
// session_start();
error_reporting(0);
include_once './config/db_connect.php';
include_once './head_views.php';
?>
<!-- Funds css -->
<link rel="stylesheet" href="./assets/dist/css/pages/funds.css">
</head>
<body>
    <?php include_once './header.php'; ?>
    
    
    <section class="container py-5" id="">
        <div class="container pt-5">
            <legend class="text-lavander">Funds Tracking</legend>
            <hr/>
            <div class="py-0 mb-5">
                <!-- Tabs navs -->
                <ul class="nav nav-tabs mb-3" id="ex1" role="tablist">
                    <li class="nav-item" role="tab">
                        <a class="nav-link active" id="all" data-bs-toggle="tab" data-bs-target="#all" role="tab" aria-controls="all">All</a>
                    </li>
                    <li class="nav-item" role="tab">
                        <a class="nav-link" id="pending" data-bs-toggle="tab" data-bs-target="#pending" role="tab" aria-controls="pending">Pending</a>
                    </li>
                    <li class="nav-item" role="tab">
                        <a class="nav-link" id="paid" data-bs-toggle="tab" data-bs-target="#paid" role="tab" aria-controls="paid">Paid</a>
                    </li>
                    <li class="nav-item" role="tab">
                        <a class="nav-link" id="refund" data-bs-toggle="tab" data-bs-target="#refund" role="tab" aria-controls="refund">Refund</a>
                    </li>
                    <li class="nav-item" role="tab">
                        <a class="nav-link" id="expired" data-bs-toggle="tab" data-bs-target="#expired" role="tab" aria-controls="expired">Expired</a>
                    </li>
                    <li class="nav-item" role="tab">
                        <a class="nav-link" id="cancelled" data-bs-toggle="tab" data-bs-target="#cancelled" role="tab" aria-controls="cancelled">Cancelled</a>
                    </li>
                </ul>
                <!-- Tabs navs -->
                <!-- Tabs content -->
                <div class="tab-content" id="funds-content">
                    <div class="tab-pane fade show active table-responsive" id="all" role="tabpanel" aria-labelledby="all">
                        <table class="table table-hover table-striped table-condensed p-0 m-0" id="funds-list">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-left">Account Name</th>
                                    <th class="text-left">Donator Name</th>
                                    <th class="text-center">Amount Donated</th>
                                    <th class="text-center">Date of Transaction</th>
                                    <th class="text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                // status: pending = 0; paid = 1; refund = 2; expired = 3; cancelled = 4;
                                $qry = $conn->query("SELECT * FROM payments order by id desc");
                                while($row= $qry->fetch_assoc()):
                                    // // encrypt id params
                                    // $data = $row['id'];
                                    // // convert to string and make it longer
                                    // $encode_data = (strval($data)*'9234123120');
                                    // // // encrypt data with base64 
                                    // $encoded_id = base64_encode($encode_data);
                                    $gid = $row['id'];
                                    $pay_status = $row['status'];
                                ?>
                                <tr>
                                    <th class="text-left"><?php echo $gid ?></th>
                                    <td class="text-left"><b><?php echo ucwords($row['account_name']) ?></b></td>
                                    <td class="text-left">
                                        <?php if($row['donator_name'] === ''){ ?>
                                            <b>Anonymous</b>
                                        <?php }else{ ?>
                                            <b><?php echo ucwords($row['donator_name']) ?></b>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center"><b><?php echo $row['amount'] ?></b></td>
                                    <td class="text-center"><b><?php echo date("Y-m-d",strtotime($row['date_added'])) ?> <span class="badge badge-success bg-lavander"> <?= date("h:i A",strtotime($row['date_added'])) ?> </span></b></td>
                                    <td class="text-center hide">
                                        <b class="">
                                            <?php
                                                if($pay_status == 0){
                                                    echo 'pending'; 
                                                }
                                                if($pay_status == 1){
                                                    echo 'paid';
                                                }
                                                if($pay_status == 2){
                                                    echo 'refund';
                                                }
                                                if($pay_status == 3){
                                                    echo 'expired';
                                                }
                                                if($pay_status == 4){
                                                    echo 'cancelled';
                                                }
                                            ?>
                                        </b>
                                    </td>
                                    <td class="text-center">
                                        <select onchange="status_update(this.options[this.selectedIndex].value, '<?php echo $gid ?>')" name="status" id="status" class="btn btn-default btn-sm btn-round border-primary wave-effect text-lavander dropdown-toggle custom-select custom-select-sm" required>
                                            <option value="">Change Status</option>                                            
                                            <option value="0" <?php echo isset($pay_status) && $pay_status == 0 ? 'selected' : '' ?>><b>Pending</b></option>
                                            <option value="1" <?php echo isset($pay_status) && $pay_status == 1 ? 'selected' : '' ?>><b>Paid</b></option>
                                            <option value="2" <?php echo isset($pay_status) && $pay_status == 2 ? 'selected' : '' ?>><b>Refund</b></option>
                                            <option value="3" <?php echo isset($pay_status) && $pay_status == 3 ? 'selected' : '' ?>><b>Expired</b></option>
                                            <option value="4" <?php echo isset($pay_status) && $pay_status == 4 ? 'selected' : '' ?>><b>Cancelled</b></option>
                                        </select>
                                        <button type="button" class="hide btn btn-default btn-sm btn-round border-info wave-effect text-info dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                        Action
                                        </button>
                                        <div class="dropdown-menu hide" style="">
                                        <a class="dropdown-item view_user hide" href="javascript:void(0)" data-id="<?php echo $encoded_id ?>">View</a>
                                        <div class="dropdown-divider hide"></div>
                                        <a class="dropdown-item" href="./index.php?page=edit_user&id=<?php echo $encoded_id ?>">Edit</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item delete_user" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">Delete</a>
                                        </div>
                                    </td>
                                </tr>	
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="pending" role="tabpanel" aria-labelledby="pending">
                        pending table
                    </div>
                    <div class="tab-pane fade" id="paid" role="tabpanel" aria-labelledby="paid">
                        paid table
                    </div>
                    <div class="tab-pane fade" id="refund" role="tabpanel" aria-labelledby="refund">
                        refund table
                    </div>
                    <div class="tab-pane fade" id="expired" role="tabpanel" aria-labelledby="expired">
                        expired table
                    </div>
                    <div class="tab-pane fade" id="cancelled" role="tabpanel" aria-labelledby="cancelled">
                        cancelled table
                    </div>
                </div>
                <!-- Tabs content -->

                
            </div>
        </div>
    </section>



<script>
    $(document).ready(function(){
        $('#funds-list').DataTable();
        $('#all_funds_btn').on('click', function() {
            alert("asdasd all");
            $('#all_funds_list').removeClass('hide');
            $('#pending_funds_list').addClass('hide');
            $('#paid_funds_list').addClass('hide');
            $('#refund_funds_list').addClass('hide');
            $('#expired_funds_list').addClass('hide');
            $('#cancelled_funds_list').addClass('hide');
        })

        $('#pending_funds_btn').on('click', function() {
            alert("asdasd pending");
            $('#all_funds_list').addClass('hide');
            $('#pending_funds_list').removeClass('hide');
            $('#paid_funds_list').addClass('hide');
            $('#refund_funds_list').addClass('hide');
            $('#expired_funds_list').addClass('hide');
            $('#cancelled_funds_list').addClass('hide');
        })

        $('#paid_funds_btn').on('click', function() {
            alert("asdasd paid");
            $('#all_funds_list').addClass('hide');
            $('#pending_funds_list').addClass('hide');
            $('#paid_funds_list').removeClass('hide');
            $('#refund_funds_list').addClass('hide');
            $('#expired_funds_list').addClass('hide');
            $('#cancelled_funds_list').addClass('hide');
        })

        $('#refund_funds_btn').on('click', function() {
            $('#all_funds_list').addClass('hide');
            $('#pending_funds_list').addClass('hide');
            $('#paid_funds_list').addClass('hide');
            $('#refund_funds_list').removeClass('hide');
            $('#expired_funds_list').addClass('hide');
            $('#cancelled_funds_list').addClass('hide');
        })

        $('#expired_funds_btn').on('click', function() {
            $('#all_funds_list').addClass('hide');
            $('#pending_funds_list').addClass('hide');
            $('#paid_funds_list').addClass('hide');
            $('#refund_funds_list').addClass('hide');
            $('#expired_funds_list').removeClass('hide');
            $('#cancelled_funds_list').addClass('hide');
        })

        $('#cancelled_funds_btn').on('click', function() {
            $('#all_funds_list').addClass('hide');
            $('#pending_funds_list').addClass('hide');
            $('#paid_funds_list').addClass('hide');
            $('#refund_funds_list').addClass('hide');
            $('#expired_funds_list').addClass('hide');
            $('#cancelled_funds_list').removeClass('hide');
        })
    });
    function status_update($value,$id){
        // start_load()
        $.ajax({
            url:'ajax?action=update_all_fund_status',
            method:'POST',
            data:{id:$id, value:$value},
            success:function(resp){
                if(resp==1){
                    setTimeout(function(){
                    // end_load()
                    location.reload();
                    },400)
                }
            }
        })
    }
</script>
<?php include_once './footer.php'; ?>
<script src="./assets/bootstrap/dist/js/bootstrap.bundle.min.js"></script>   
</body>
</html>
