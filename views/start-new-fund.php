<!DOCTYPE html>
<html lang="en">
<?php
// include_once './global_call.php';
include './head.php';
?>
<!-- register css -->
<!-- <link rel="stylesheet" href="./assets/dist/css/pages/register.css"> -->
</head>
<body class="bg-light">
    
    <?php
        require "./global_call.php";
        require "./database.php";
        session_start();
        $uid = $_SESSION['user_id'];
        $utype = $_SESSION['user_type'];
        if($utype == 1){
            
            // Dashboard for User with Accounts
            $stmt = $mysqli->prepare("SELECT * FROM abuloy_users WHERE id = ?");
            $stmt->bind_param('d', $uid);
            $result = $stmt->execute();
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();
            if(isset($user)){
                include './header-user.php';
            }
            ?>

                <section id="startnewfund" class="pt-5">    
                    <legend class="text-lavander text-center fw-bold pt-5">Create A New Fund</legend>
                    <div class="d-flex justify-content-center px-3 py-0">
                        <div class="col-lg-12 container pb-5">
                            <div class="card card-outline card-success">
                                <div class="card-body">
                                    <small class="align-center pb-3">Please upload a photo of the deceased below </small>
                                    <form action="/start-new-fund-fnc" method="POST" id="startnewfund" novalidate>
                                        <div class="form-row col-md-12 lavander-form mx-auto">
                                            <div class="col-md-6 mx-auto hide">
                                                <div class="form-group  my-3">
                                                    <label for="uid">ID*</label>
                                                    <input type="text" id="uid" name="uid" class="form-control" value="<?= $uid ?>" required placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-md-6 mx-auto">
                                                <div class="form-group  my-3">
                                                    <label for="d_firstname" class="">First Name*</label>
                                                    <input type="text" id="d_firstname" name="d_firstname" class="form-control" required placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-md-6 mx-auto">
                                                <div class="form-group  my-3">
                                                    <label for="d_middlename">Middle Name</label>
                                                    <input type="text" id="d_firstname" name="d_middlename" class="form-control" placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-md-6 mx-auto">
                                                <div class="form-group  my-3">
                                                    <label for="d_lastname">Last Name*</label>
                                                    <input type="text" id="d_firstname" name="d_lastname" class="form-control" required placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-md-6 mx-auto">
                                                <div class="form-group  my-3">
                                                    <label for="d_birthdate">Birth Date*</label>
                                                    <input type="date" id="d_birthdate" name="d_birthdate" class="form-control" required placeholder="Birth Date*">
                                                </div>
                                            </div>
                                            <div class="col-md-6 mx-auto">
                                                <div class="form-group  my-3">
                                                    <label for="d_date_of_death">Date of Death*</label>
                                                    <input type="date" id="d_date_of_death" name="d_date_of_death" class="form-control" required placeholder="Date of Death*">
                                                </div>
                                            </div>
                                            <div class="col-md-6 mx-auto">
                                                <div class="form-group  my-3">
                                                    <label for="d_summary">Tell us his/her story. What happened?*</label>
                                                    <textarea name="d_summary" id="d_summary" cols="30" rows="10" class="form-control"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mx-auto">
                                                <label for="d_goal_amount">The Goal Amount*</label>
                                                <div class="input-group phone-input-group px-0 mx-0  my-3">                                                    
                                                    <span class="input-group-text phone-input-group-text fs-large">&#x20B1; &nbsp;</span>
                                                    <input type="text" id="d_goal_amount" name="d_goal_amount" class="form-control" maxlength="9" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-md-6 mx-auto">
                                                <div class="form-group  my-3">
                                                    <label for="expiration">The Goal Date Expiration*</label>
                                                    <input type="date" id="expiration" name="expiration" class="form-control" required placeholder="">
                                                </div>
                                            </div>
                                            
                                            <div class="col-lg-12 text-right justify-content-center d-flex mb-5 mt-4">
                                                <button type="submit" name="startnewfund" class="btn btn-primary me-2">Continue</button>
                                                <button class="btn btn-secondary" type="button" onclick="location.href = '/'">Cancel</button>
                                            </div>
                                        </div>
                                    </form>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            <?php
        }
            ?>
    <!-- start Footer Area -->
    <?php include './footer.php' ?>     
    <!-- end Footer Area -->

    <!-- Plugins -->
    <?php include './plugins.php'; ?>
    <!-- Custom Script -->
    <!-- <script src="controllers/register.js"></script> -->
</body>
</html>