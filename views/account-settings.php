<!DOCTYPE html>
<html lang="en">
<?php
include_once './global_call.php';
include_once './config/db_connect.php';
include_once './head_views.php';
?>
<!-- account-settings css -->
<link rel="stylesheet" href="./assets/dist/css/pages/account-settings.css">
</head>
<body>
    <?php include_once './header.php'; ?>  

    <section class="py-5" id="">
        <div class="container pt-5">
            <legend class="text-lavander">Account Settings</legend>
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
                                        <th class="text-center">#</th>
                                        <th class="text-left">Account Name</th>
                                        <th class="text-center">Goal Amount</th>
                                        <th class="text-center hide">Progress</th>
                                        <th class=""></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    $status = array('',"Pending","Paid","Refund","Expired","Cancelled");
                                    $qry = $conn->query("SELECT *,concat(d_firstname,' ',d_lastname) as account_name FROM accounts order by id desc");
                                    while($row= $qry->fetch_assoc()):
                                        // // encrypt id params
                                        // $data = $row['id'];
                                        // // convert to string and make it longer
                                        // $encode_data = (strval($data)*'9234123120');
                                        // // // encrypt data with base64 
                                        // $encoded_id = base64_encode($encode_data);
                                    ?>
                                    <tr>
                                        <th class="text-center"><?php echo $i++ ?></th>
                                        <td class="text-left"><b><?php echo ucwords($row['account_name']) ?></b></td>
                                        <td class="text-center"><b><?php echo $row['d_goal_amount'] ?></b></td>
                                        <td class="text-center hide">
                                            <b class="hide"><?php echo $row['d_summary'] ?></b>                                        
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-default btn-sm btn-round border-info wave-effect text-info dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                            Action
                                            </button>
                                            <div class="dropdown-menu" style="">
                                            <a class="dropdown-item view_account hide" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">View</a>
                                            <div class="dropdown-divider hide"></div>
                                            <a class="dropdown-item" href="./index.php?page=edit_account&id=<?php echo $row['id'] ?>">Edit</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item delete_account" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">Delete</a>
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

    <!-- Plugins -->
    <?php include_once './plugin_views.php'; ?>
    <!-- Custom Script -->
    <script src="./controllers/account-settings.js"></script>
</body>
</html>

