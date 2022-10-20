<?php

?>
    <section class="py-5" id="">
        <div class="container pt-5">
            <legend class="text-lavander">Withdrawals</legend>
            <hr/>
            <div class="py-0 mb-5">
                <div class="card">
                    <div class="card-header bg-light-lavander">
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive xpand xpand-table x-scroll p-0 m-0">
                            <table class="table table-hover table-striped table-condensed p-0 m-0" id="funds-list">
                                <thead>
                                    <tr>
                                        <th class="text-center">Ref #</th>
                                        <th class="text-left">Account Name</th>
                                        <th class="text-center">Beneficiary Name</th>
                                        <th class="text-center">Beneficiary Contact</th>

                                        <th class="text-center">Goal Amount</th>
                                        <th class="text-center">Total Abuloy Accumulate</th>
                                        <th class="text-center">Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    $status = array('',"Pending","Paid","Refund","Expired","Cancelled");
                                    $qry = $conn->query("SELECT * FROM gcash_payments order by id desc");
                                    while($row= $qry->fetch_assoc()):

                                        // // encrypt id params
                                        // $data = $row['id'];
                                        // // convert to string and make it longer
                                        // $encode_data = (strval($data)*'9234123120');
                                        // // // encrypt data with base64 
                                        // $encoded_id = base64_encode($encode_data);
                                        $gid = $row['account_id'];
                                        $beneficiaryqry = $conn->query("SELECT * FROM users WHERE id =".$row['user_id']);
                                        $beneficiaryqry2 = $conn->query("SELECT * FROM users WHERE id =".$row['user_id']);
                                        
                                    ?>
                                    <tr>
                                        <th class="text-left"><?php echo $row['id'] ?></th>                                    
                                        <td class="text-left"><b><?php echo ucwords($row['account_name']) ?></b></td>
                                        <td class="text-left">
                                            <?php while($beneficiary=$beneficiaryqry->fetch_assoc()): ?>
                                            <b><?php echo ucwords($beneficiary['firstname']) ?> <?php echo ucwords($beneficiary['lastname']) ?></b>
                                            <?php endwhile; ?>
                                        </td>
                                        <td class="text-left">
                                            <?php while($beneficiary2=$beneficiaryqry2->fetch_assoc()): ?>
                                            <b><?php echo $beneficiary2['email'] ?> <br/>+63<?php echo $beneficiary2['phone_number'] ?></b>
                                            <?php endwhile; ?>
                                        </td>
                                        <td class="text-center"><b><?php echo $row['d_goal_amount'] ?></b></td>
                                        <td class="text-center"><b><?php echo $row['gcash_amount'] ?></b></td>
                                        <td class="text-center">
                                            <b>
                                                <?php
                                                    if($row['gcash_status'] == 0){
                                                        echo 'pending'; ?>
                                                    <?php    
                                                    }
                                                    if($row['gcash_status'] == 1){
                                                        echo 'paid';
                                                    }
                                                    if($row['gcash_status'] == 2){
                                                        echo 'refund';
                                                    }
                                                    if($row['gcash_status'] == 3){
                                                        echo 'expired';
                                                    }
                                                    if($row['gcash_status'] == 4){
                                                        echo 'cancelled';
                                                    }
                                                ?>
                                            </b>
                                        </td>
                                        <td class="text-center">
                                            <select onchange="status_update(this.options[this.selectedIndex].value, '<?php $row['account_id'] ?>')" id="gcash_status" class="btn btn-default btn-sm btn-round border-primary wave-effect text-lavander dropdown-toggle custom-select custom-select-sm" required>
                                                <option value="">Change Status</option>                                            
                                                <option value="0" >Pending</option>
                                                <option value="1" >Paid</option>
                                                <option value="2" >Refund</option>
                                                <option value="3" >Expired</option>
                                                <option value="4" >Cancelled</option>
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
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- start Footer Area -->
    <?php include './footer.php' ?>     
    <!-- end Footer Area -->

    <script src="./assets/dist/js/pages/withdrawals.js"></script>
    <!-- Plugins -->
    <?php include_once './plugin_views.php' ?> 
</body>
</html>