<!DOCTYPE html>
<html lang="en">
<?php 
// session_start();
include('./db_connect.php');
ob_start();
if(!isset($_SESSION['system'])){
  $system = $conn->query("SELECT * FROM system_settings")->fetch_array();
  foreach($system as $k => $v){
    $_SESSION['system'][$k] = $v;
  }
}
ob_end_flush();
?>
<?php 
if(isset($_SESSION['login_id']))
if(isset($_SESSION['login_account_id']))
// header("location:home");
?>
<?php include 'header.php' ?>

<!-- login area -->
<section id="login" class="">
    <div class="container mx-auto  login-form-height" >
        <div class="col-lg-12 col-md-12 col-sm-12 text-center">
            <legend class="text-lavander text-center fw-bold hide">Login</legend>
            <div class="d-flex justify-content-center align-items-center">                
                <form action="" method="post" enctype="multipart/form-data" id="login-form">
                    <div class="form-row lavander-form">
                        <div class="col">
                          <input type="email" value="<?php if(isset($user['email'])) echo $user['email'];  ?>" name="email" class="form-control my-3" id="validationDefault07" placeholder="Email Address" required>
                        </div>
                        <div class="col">
                          <input type="password" value="<?php if(isset($user['password'])) echo $user['password'];  ?>" required name="password" id="password" class="form-control my-3" placeholder="Password">
                        </div>
                    </div>
                    <div class="submit-btn text-center mb-5">
                        <button type="submit" name="login_account" class="btn btn-lavander text-white text-uppercase fs-large py-2 rounded-pill text-dark px-5">Login</button>
                    </div>
                    <small><a href="" class="text-left no-style">Forgot Password?</a></small><br/>
                    <small class="text-blackish">If you don't have any account? <a href="./index.php?page=register" class="no-style text-lavander">Sign-up</a></small>
                    <!-- <div class="gfm-embed" data-url="https://www.gofundme.com/f/ukraine-humanitarian-fund/widget/large/"></div>
                    <script defer src="https://www.gofundme.com/static/js/embed.js"></script> -->
                </form>
            </div>
        </div>
    </div>
</section>
<!-- #login area -->


<script>
  $(document).ready(function(){
    $('#login-form').submit(function(e){
    e.preventDefault()
    // start_load()
    if($(this).find('.alert-danger').length > 0 )
      $(this).find('.alert-danger').remove();
      $.ajax({
        url:'ajax.php?action=login',
        method:'POST',
        data:$(this).serialize(),
        error:err=>{
          console.log(err)
          end_load();

        },
        success:function(resp){
          if(resp == 1){
            location.href ='index.php?page=home';
          }else{
            $('#login-form').prepend('<div class="alert alert-danger">Username or password is incorrect.</div>')
            end_load();
          }
        }
      })
    })
  })
</script>
<?php include 'footer.php' ?>

</body>
</html>
