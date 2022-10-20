
<main role="main" class="page-content mt-5 pt-1 mx-auto">
	<div class="container py-2 py-lg-5 px-sm-0" style="padding-top:0px !important">
		<div class="row">
			
			<div class="col-xl-10 mx-auto ">
				<div class="card my-4 px-4 rounded-plus">
					<div class="x-paysuccess" style="margin:auto">
						<div class=" swal2-icon swal2-success swal2-icon-show" style="display: flex;"><div class="swal2-success-circular-line-left" style="background-color: rgb(255, 255, 255);"></div>
							<span class="swal2-success-line-tip"></span> <span class="swal2-success-line-long"></span>
							<div class="swal2-success-ring"></div> <div class="swal2-success-fix" style="background-color: rgb(255, 255, 255);"></div>
							<div class="swal2-success-circular-line-right" style="background-color: rgb(255, 255, 255);"></div>
						</div>
					</div>
					<div class="col-xl-12">
						<legend class="fw-bold text-center text-lavander">
							Payment Successful! <br/>
							<small class="fw-300 mt-3 mb-0 opacity-70 text-blackish	">
								Below are the details of your transaction:
							</small>
						</legend>
					</div>
					<div class="alert border-primary pb-0" role="alert">
						<?php include 'db_connect.php';
							$hash = $_GET['hash'];
							$paysuccessqry = $conn->query("SELECT * FROM payments WHERE request_id = '$hash'");
							if($row = $paysuccessqry->fetch_assoc()){ ?>
								<div class="row">
									<div class="col-6">
										<small class="text-uppercase fw-700 fs-xs">Account Name</small>
										<p class="mb-4 field-merchantname fs-xxl merchantname"> <?php echo $row['account_name'] ?> <span class="hide">/ <?php echo $row['customer_email'] ?></span> </p>
									</div>
									<div class="col-6">
										<small class="text-uppercase fw-700 fs-xs">Amount</small>
										<p class="mb-4 field-reference fs-xxl grossamountdisplay"> ₱ <?php echo $row['amount'] ?>.00 </p>
									</div>
									<div class="col-6">
										<small class="text-uppercase fw-700 fs-xs">CUSTOMER NAME</small>
										<p class="mb-4 field-customername customername"> 
											<?php if($row['customer_name'] == ''){ ?>Anonymous<?php }else{ ?><?php echo $row['customer_name'] ?><?php } ?>
										</p>
									</div>
									<div class="col-6 hide">
										<small class="fw-700 fs-xs">CUSTOMER EMAIL</small>
										<p class="mb-4 field-customeremail customeremail"> <?php echo $row['customer_email'] ?> </p>
									</div>
									<div class="col-6 hide">
										<small class=" fw-700 fs-xs">CUSTOMER MOBILE</small>
										<p class="mb-4 field-customermobile customermobile"> <?php echo $row['customer_mobile'] ?> </p>
									</div>
									<div class="col-6">
										<small class=" fw-700 fs-xs">DATE TIME PAID</small>
										<p class="mb-4 field-datepaid datepaiddisplay"> <?php echo $row['date_added'] ?></p>
									</div>
									<div class="col-6">
										<small class="text-uppercase fw-700 fs-xs">Reference Number</small>
										<p class="mb-4 field-reference fs-xxl reference"> <a class="btn btn-lavander btn-sm btn-round py-1 px-3" href="https://getpaid.gcash.com/paymentsuccess?hash=<?php echo $hash ?>" target="_blank">click here</a> </p>
									</div>
								</div>
						<?php 
							}
						?>
						
					</div>
					<p class="mt-0 p-0 text-center">
						<span class="title pt-0 px-auto">REQUEST FOR REFUND?<br/>Contact Customer Service <a href="index.php?page=contact" >here</a> </span><br/>
						<span>To see status of your payment, please <a href="https://getpaid.gcash.com/paymentsuccess?hash=<?php echo $hash ?>" target="_blank">click here</a>.
						<br /><span class="hide">This link will expire in 2 days</span>
						</span>
					</p>
				</div>
			</div>
		</div>
	</div>
</main>

