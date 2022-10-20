<?php 
    // require_once './global_call.php';
    // $gcash_public_key = $_ENV['GCASH_PK'];
    

?>
<!DOCTYPE html>
<html lang="en">
<?php
include_once './global_call.php';
include_once './database.php';
include_once './head_views.php';
$hash = $_GET['hash'];

?>
<!-- success css -->
<link rel="stylesheet" href="./assets/dist/css/pages/success.css">
</head>
<body>

<div class="py-5">
    <form name="update_payment" action="" id="update_payment" method="POST">
        <div class="py-5 mt-2 text-center bb-lavander">
            <h4 class="text-lavander">Your payment has been successfully received!</h4>
            <img src="assets/img/check.png" alt="check-freepik" class="my-5" style="height:250px;width:250px">
            <div>with reference code</div>
            <?php
            $profileqry = $mysqli->prepare("SELECT * FROM abuloy_payments WHERE request_id = ?"); 
            $profileqry->bind_param('s', $hash);
            $result_profileqry = $profileqry->execute();
            $result_profileqry = $profileqry->get_result();    
            if($row = $result_profileqry->fetch_assoc()){
                $account_id = $row['aid']; 
                $hash = $row['request_id']; 
                $scode = $row['short_code'];
            ?> 
            <input type="hidden" name="request_id" value="<?php echo $hash;  //Output: url hash ?>">            
            <small class="mt-2"><b><?php echo $hash;  //Output: url hash ?></b></small><br/>
            <div class="col-12 mt-2">                  
                <a href="/donate/<?php echo $scode ?>" class="btn btn-primary py-2">Back to Profile</a>
            <?php 
            } ?>
            </div>
        </div>
    </form>    
</div>
<script>
    // Update Database with this unique Hash Code
    $(document).ready(function(){
        $("#update_payment").submit();
        // get_web_page($content)             
    })
    $('#update_payment').submit(function(e){
        e.preventDefault()
        // start_load()
        $.ajax({
            url:'/ajax?action=update_payment_success',
            data: new FormData($(this)[0]),
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            type: 'POST',
            success:function(data){
                console.log(data);       
            }
        })          
    });    
    // $.ajax({
    //         url:'https://abuloy.ph/success',
    //         data: url,
    //         method: 'POST',
    //         type: 'POST',
    //         success:function(resp){
    //             console.log(resp);
    //             $("#dataPost").html(resp);       
    //         }
    // })
    // GCash Payment Success Update
	// function success(){
	// 	extract($_POST);
	// 	$check_id = $this->db->query("SELECT * FROM payments ORDER BY id desc")->num_rows;
	// 	$code_id = $check_id; 
	// 	if($code_id > 0){
	// 		// status pending=0,paid=2,refund=2,expired=3,cancelled=4
	// 		$update = $this->db->query("UPDATE payments SET request_id='$request_id',code='$code',status=1 WHERE code = $code_id");
	// 	}
	// 	if($update){
	// 		return 1;
	// 	}
	// }
    
</script>
    
    <?php include_once './footer.php'; ?>
    <!-- Plugins -->
    <?php include_once './plugin_views.php'; ?>
    <script src="./controller/success.js"></script>
</body>
</html>