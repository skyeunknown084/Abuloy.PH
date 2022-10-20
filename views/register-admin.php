<?php
// if($_SERVER['REQUEST_METHOD'] == 'POST'){
//     require ('register-process.php');
// }
   
?>
<section id="register pt-0" class="pt-1 mt-5">    
    <legend class="text-lavander text-center fw-bold mt-5 pt-5">Create an Admin Account</legend>
    <div class="d-flex justify-content-center px-3 py-0">
        <div class="col-lg-12 container">
            <div class="card card-outline card-success">
                <div class="form-row text-black hide">
                <?php
                    if(isset($_SESSION['messages']))
                    {
                        ?>                            
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong><?php echo $_SESSION['messages']; ?></strong>
                        <button type="button" class="btn-close" id="clear-btn" data-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php
                        unset($_SESSION['messages']);
                    }
                ?>
                </div>
                <div class="card-body">
                    <form action="" id="manage_account">
                        <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
                        <div class="form-row col-md-12 mx-auto">
                            <div class="col-md-6 mx-auto">
                                <div class="form-group">
                                    <label for="" class="control-label">First Name</label>
                                    <input type="text" name="reg_firstname" class="form-control form-control-sm" required value="<?php echo isset($reg_firstname) ? $reg_firstname : '' ?>">
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label">Last Name</label>
                                    <input type="text" name="reg_lastname" class="form-control form-control-sm" required value="<?php echo isset($reg_firstname) ? $reg_firstname : '' ?>">
                                </div>
                                <div class="form-group hide">
                                    <label for="" class="control-label hide">User Role</label>
                                    <input type="hidden" name="type" value="1">                                    
                                </div>
                                
                            </div>
                            <div class="col-md-6 mx-auto">
                                <div class="form-group">
                                    <label class="control-label">Phone Number</label>
                                    <input type="text" class="form-control form-control-sm" name="phone_number" required value="<?php echo isset($phone_number) ? $phone_number : '' ?>">
                                    
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Email</label>
                                    <input type="email" class="form-control form-control-sm" name="email_add" required value="<?php echo isset($email_add) ? $email_add : '' ?>">
                                    <small id="#msg"></small>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Password</label>
                                    <input type="password" class="form-control form-control-sm" name="password" <?php echo !isset($id) ? "required":'' ?>>
                                    <small><i><?php echo isset($id) ? "Leave this blank if you dont want to change you password":'' ?></i></small>
                                </div>
                                <div class="form-group">
                                    <label class="label control-label">Confirm Password</label>
                                    <input type="password" class="form-control form-control-sm" name="cpass" <?php echo !isset($id) ? 'required' : '' ?>>
                                    <small id="pass_match" data-status=''></small>
                                </div>
                            </div>
                            <div class="col-md-6 mx-auto">
                                <div class="form-group">
                                    <label for="" class="control-label">Avatar</label>
                                    <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="customFile" name="img" onchange="displayImg(this,$(this))">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
                                </div>
                                <div class="form-group d-flex justify-content-center align-items-center">
                                    <img src="<?php echo isset($avatar) ? 'assets/uploads/'.$avatar :'' ?>" alt="Avatar" id="cimg" class="img-fluid img-thumbnail ">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">FirstName</label>
                                    <input type="text" class="form-control form-control-sm" name="d_firstname" required value="<?php echo isset($d_firstname) ? $d_firstname : '' ?>">
                                    <small id="#fn_msg"></small>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">MiddleName</label>
                                    <input type="text" class="form-control form-control-sm" name="d_middlename" value="<?php echo isset($d_middlename) ? $d_middlename : '' ?>">
                                    <small id="#mn_msg"></small>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">LastName</label>
                                    <input type="text" class="form-control form-control-sm" name="d_lastname" required value="<?php echo isset($d_lastname) ? $d_lastname : '' ?>">
                                    <small id="#ln_msg"></small>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">BirthDate</label>
                                    <input type="date" class="form-control form-control-sm" name="d_birthdate" required value="<?php echo isset($d_birthdate) ? $d_birthdate : '' ?>">
                                    
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Date of Death</label>
                                    <input type="date" class="form-control form-control-sm" name="d_date_of_death" required value="<?php echo isset($d_date_of_death) ? $d_date_of_death : '' ?>">
                                    
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Tell his/her story. What happened?</label>
                                    <textarea cols="30" rows="10" class="form-control form-control-sm" name="d_summary" required value="<?php echo isset($d_summary) ? $d_summary : '' ?>"></textarea>
                                    
                                </div>
                            </div>
                            <div class="col-md-6 mx-auto">
                                <div class="form-group">
                                    <label class="control-label">Goal Amount</label>
                                    <input type="number" class="form-control form-control-sm" name="d_goal_amount" required value="<?php echo isset($d_goal_amount) ? $d_goal_amount : '' ?>">
                                    
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="col-lg-12 text-right justify-content-center d-flex">
                            <button type="submit" class="btn btn-primary mr-2">Save</button>
                            <button class="btn btn-secondary" type="button" onclick="location.href = '<?php base() ?>home'">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
</section>
<style>
	img#cimg{
		height: 15vh;
		width: 15vh;
		object-fit: cover;
		border-radius: 100% 100%;
	}
</style>
<script>
	$('[name="password"],[name="cpass"]').keyup(function(){
		var pass = $('[name="password"]').val()
		var cpass = $('[name="cpass"]').val()
		if(cpass == '' ||pass == ''){
			$('#pass_match').attr('data-status','')
		}else{
			if(cpass == pass){
				$('#pass_match').attr('data-status','1').html('<i class="text-success">Password Matched.</i>')
			}else{
				$('#pass_match').attr('data-status','2').html('<i class="text-danger">Password does not match.</i>')
			}
		}
	})
	function displayImg(input,_this) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	        	$('#cimg').attr('src', e.target.result);
	        }

	        reader.readAsDataURL(input.files[0]);
	    }
	}
	$('#manage_account').submit(function(e){
        
		e.preventDefault()
		$('input').removeClass("border-danger")
		start_load()
		$('#msg').html('')
        $('#fn_msg').html('')
        $('#mn_msg').html('')
        $('#ln_msg').html('')
		if($('[name="password"]').val() != '' && $('[name="cpass"]').val() != ''){
			if($('#pass_match').attr('data-status') != 1){
				if($("[name='password']").val() !=''){
					$('[name="password"],[name="cpass"]').addClass("border-danger")
					end_load()
					return false;
				}
			}
		}
        
		$.ajax({
			url:'ajax.php?action=save_account',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp == 1){
					alert_toast('Data successfully saved.',"success");
					setTimeout(function(){
						location.replace('login')
					},750)
				}else if(resp == 2){
					$('#msg').html("<div class='alert alert-danger' role='alert'>Email already exist.</div>");
					$('[name="email_add"]').addClass("border-danger");
                    $('#fn_msg').html("<div class='alert alert-danger' role='alert'>First Name already exist.</div>");
					$('[name="d_firstname"]').addClass("border-danger")
                    $('#mn_msg').html("<div class='alert alert-danger' role='alert'>Middle Name already exist.</div>");
					$('[name="d_middlename"]').addClass("border-danger")
                    $('#ln_msg').html("<div class='alert alert-danger' role='alert'>Last Name already exist.</div>");
					$('[name="d_lastname"]').addClass("border-danger")
					end_load()
				}
			}
		})
	})
</script>