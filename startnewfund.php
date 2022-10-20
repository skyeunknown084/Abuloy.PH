<!DOCTYPE html>
<html lang="en">
<?php 
session_start();
// error_reporting(0);
include './global_call.php';
include 'config/db_connect.php';
include './head.php'; ?>
<body>
<?php include './header.php'; ?>    
<?php
if(isset($_GET['id'])){
	$qry = $conn->query("SELECT * FROM accounts where id = ".$_GET['id'])->fetch_array();
	foreach($qry as $k => $v){
		$$k = $v;
	}
}
?>
<?php if($_SESSION['login_type'] == 2 || $_SESSION['login_type'] == 1) { ?>
<section id="register pt-0" class="py-5">    
    <legend class="text-lavander text-center fw-bold mt-5 pt-0">Create an Account</legend>
    <div class="d-flex justify-content-center px-3 py-0">
        <div class="col-lg-12 container">
            <div class="card card-outline card-success">
                <div class="card-body">
                    <form action="" id="create_new_account" class="lavander-form">
                        <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
                        <div class="form-row col-md-12 mx-auto">
                            <div class="form-group hide" >
                                <select class="form-control form-control-sm select2 hide" name="user_id" style="display:none;visibility:hidden;opacity:0"  required>
                                    <option></option>
                                    <?php 
                                    $user = $conn->query("SELECT id,concat(firstname,' ',lastname) as name FROM users where type = 2 order by concat(firstname,' ',lastname) asc ");
                                    while($row=$user->fetch_assoc()):
                                    ?>
                                    <option value="<?php echo $_SESSION['login_id'] ?>" <?php echo isset($user_id) && $user_id == $row['id'] ? "selected" : 'selected' ?> selected><?php echo ucwords($_SESSION['login_id']) ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12 mx-auto">
                                <div class="form-group hide">
                                    <label for="" class="control-label hide">User Role</label>
                                    <input type="hidden" name="type" value="2">                                    
                                </div> 
                                
                                <div class="form-group d-flex justify-content-center align-items-center">
                                    <img src="<?php echo isset($avatar) ? 'assets/uploads/'.$avatar :'assets/img/no-logo.png' ?>" id="cimg" class="img-fluid img-thumbnail p-2">
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label hide">Avatar</label>
                                    <div class="">
                                    <input type="file" class="custom-file-input" id="" name="img" onchange="displayImg(this,$(this))">
                                    <label class="custom-file-label hide" for="">Choose file</label>
                                    </div>
                                </div>
                                <div class="form-group py-3">
                                    <label class="control-label hide">FirstName</label>
                                    <input type="text" class="form-control form-control text-center" name="d_firstname" required value="<?php echo isset($d_firstname) ? $d_firstname : '' ?>" placeholder="First Name*">
                                    <small id="#msg"></small>
                                </div>
                                <div class="form-group py-3">
                                    <label class="control-label hide">MiddleName</label>
                                    <input type="text" class="form-control form-control text-center" name="d_middlename" value="<?php echo isset($d_middlename) ? $d_middlename : '' ?>" placeholder="Middle Name*">
                                    <small id="#mn_msg"></small>
                                </div>
                                <div class="form-group py-3">
                                    <label class="control-label hide">LastName</label>
                                    <input type="text" class="form-control form-control text-center" name="d_lastname" required value="<?php echo isset($d_lastname) ? $d_lastname : '' ?>" placeholder="Last Name*">
                                    <small id="#ln_msg"></small>
                                </div>
                                <div class="form-group py-3">
                                    <label class="control-label hide">BirthDate</label>
                                    <input type="date" class="form-control form-control text-center" name="d_birthdate" required value="<?php echo isset($d_birthdate) ? $d_birthdate : '' ?>" placeholder="Birth Date*">
                                    
                                </div>
                                <div class="form-group py-3">
                                    <label class="control-label hide">Date of Death</label>
                                    <input type="date" class="form-control form-control text-center" name="d_date_of_death" required value="<?php echo isset($d_date_of_death) ? $d_date_of_death : '' ?>" placeholder="Date of Death*">
                                    
                                </div>
                                <div class="form-group py-3">
                                    <label class="control-label">Tell his/her story. What happened?</label>
                                    <textarea cols="30" rows="10" class="form-control form-control text-center" name="d_summary" required value="<?php echo isset($d_summary) ? $d_summary : '' ?>" placeholder=""></textarea>
                                    
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12 mx-auto py-3">
                                <div class="form-group  py-3">
                                    <label class="control-label text-center">Goal Amount</label>
                                    <input type="number" class="form-control form-control text-center" name="d_goal_amount" required value="<?php echo isset($d_goal_amount) ? $d_goal_amount : '' ?>" placeholder="0.00">
                                    
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="col-12 text-right justify-content-center d-flex">
                            <button type="submit" class="btn btn-primary me-2">Save</button>
                            <button class="btn btn-secondary" type="button" onclick="location.href = '/home'">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
</section>
<?php } else { ?>
    <?php
    if(isset($_SESSION['login_id']))
    header("location:/");
    ?>
    <section id="register pt-0" class="py-5">    
        <legend class="text-lavander text-center fw-bold mt-5 pt-0">Create an Account</legend>
        <div class="d-flex justify-content-center px-3 py-0">
            <div class="col-lg-12 container">
                <div class="card card-outline card-success">
                    <div class="card-body">
                        <form action="" id="create_new_account"  class="lavander-form">
                            <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
                            <div class="form-row col-md-12 mx-auto">
                                <div class="form-group hide" >
                                    <select class="form-control form-control-sm select2 hide" name="user_id" style="display:none;visibility:hidden;opacity:0"  required>
                                        <option></option>
                                        <?php 
                                        $user = $conn->query("SELECT id,concat(firstname,' ',lastname) as name FROM users where type = 2 order by concat(firstname,' ',lastname) asc ");
                                        while($row=$user->fetch_assoc()):
                                        ?>
                                        <option value="<?php echo $_SESSION['login_id'] ?>" <?php echo isset($user_id) && $user_id == $row['id'] ? "selected" : 'selected' ?> selected><?php echo ucwords($_SESSION['login_id']) ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12 mx-auto">
                                    <div class="form-group hide">
                                        <label for="" class="control-label hide">User Role</label>
                                        <input type="hidden" name="type" value="2">                                    
                                    </div> 
                                    
                                    <div class="form-group d-flex justify-content-center align-items-center">
                                        <img src="<?php echo isset($avatar) ? 'assets/uploads/'.$avatar :'assets/img/no-logo.png' ?>" id="cimg" class="img-fluid img-thumbnail p-2">
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="control-label hide">Avatar</label>
                                        <div class="">
                                        <input type="file" class="custom-file-input" id="" name="img" onchange="displayImg(this,$(this))">
                                        <label class="custom-file-label hide" for="">Choose file</label>
                                        </div>
                                    </div>
                                    <div class="form-group py-3">
                                        <label class="control-label hide">FirstName</label>
                                        <input type="text" class="form-control form-control text-center" name="d_firstname" required value="<?php echo isset($d_firstname) ? $d_firstname : '' ?>" placeholder="First Name*">
                                        <small id="#msg"></small>
                                    </div>
                                    <div class="form-group py-3">
                                        <label class="control-label hide">MiddleName</label>
                                        <input type="text" class="form-control form-control text-center" name="d_middlename" value="<?php echo isset($d_middlename) ? $d_middlename : '' ?>" placeholder="Middle Name*">
                                        <small id="#mn_msg"></small>
                                    </div>
                                    <div class="form-group py-3">
                                        <label class="control-label hide">LastName</label>
                                        <input type="text" class="form-control form-control text-center" name="d_lastname" required value="<?php echo isset($d_lastname) ? $d_lastname : '' ?>" placeholder="Last Name*">
                                        <small id="#ln_msg"></small>
                                    </div>
                                    <div class="form-group py-3">
                                        <label class="control-label hide">BirthDate</label>
                                        <input type="date" class="form-control form-control text-center" name="d_birthdate" required value="<?php echo isset($d_birthdate) ? $d_birthdate : '' ?>" placeholder="Birth Date*">
                                        
                                    </div>
                                    <div class="form-group py-3">
                                        <label class="control-label hide">Date of Death</label>
                                        <input type="date" class="form-control form-control text-center" name="d_date_of_death" required value="<?php echo isset($d_date_of_death) ? $d_date_of_death : '' ?>" placeholder="Date of Death*">
                                        
                                    </div>
                                    <div class="form-group py-3">
                                        <label class="control-label">Tell his/her story. What happened?</label>
                                        <textarea cols="30" rows="10" class="form-control form-control text-center" name="d_summary" required value="<?php echo isset($d_summary) ? $d_summary : '' ?>" placeholder=""></textarea>
                                        
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12 mx-auto py-3">
                                    <div class="form-group  py-3">
                                        <label class="control-label text-center">Goal Amount</label>
                                        <input type="number" class="form-control form-control text-center" name="d_goal_amount" required value="<?php echo isset($d_goal_amount) ? $d_goal_amount : '' ?>" placeholder="0.00">
                                        
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="col-12 text-right justify-content-center d-flex">
                                <button type="submit" class="btn btn-primary me-2">Save</button>
                                <button class="btn btn-secondary" type="button" onclick="location.href = '/home'">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>        
    </section>
<?php } ?>

    <!-- start Footer Area -->
    <?php include './footer.php' ?>     
    <!-- end Footer Area -->

    <script src="./assets/dist/js/pages/startnewfund.js"></script>
    <!-- Plugins -->
    <?php include_once './plugin_views.php' ?> 
</body>
</html>