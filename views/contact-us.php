<?php
session_start();
error_reporting(0);   
?>
<!DOCTYPE html>
<html lang="en">
<?php
// include_once './global_call.php';
include './head_views.php';
?>
<!-- register css -->
<!-- <link rel="stylesheet" href="./assets/dist/css/pages/register.css"> -->
</head>
<body class="bg-light">
    
    <?php

        require "global_call.php";
        require "database.php";

        $uid = $_SESSION['user_id'];
        if($_SERVER['REQUEST_METHOD'] === "GET" && isset($uid)){
            $stmt = $mysqli->prepare("SELECT * FROM abuloy_users WHERE id = ?");
            $stmt->bind_param('d', $uid);
            $result = $stmt->execute();
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();
            $email = $user['email'];
            // generate session again
            // session_regenerate_id();
            if(isset($user)){
            include 'header-user.php';
            ?>
            <section class="my-5 pt-5">
                <div class="album py-5 ">
                    <div class="container">
                    <div class="row row-cols-1 row-cols-sm-1 row-cols-md-1 row-cols-lg-2 g-4 align-center">
                        <div class="col">
                        <div class="card shadow-sm">
                            <legend class="text-lavander text-center py-0 my-3" x="42%" y="90%">Get In Touch</legend>
                            <div class="px-3 hide"><hr></div>
                            <div class="card-body">
                                <form action="" method="POST" id="contact-form">
                                    <div class="mb-3 hide">
                                        <label for="user_true" class="form-label">Name: </label>
                                        <input type="text" class="form-control text-blackish" name="user_sender_name" id="user_true" aria-describedby="user_true" value="<?php echo $user['firstname'] ?>" disabled>
                                    </div>
                                    <div class="mb-3">
                                        <label for="userEmailAddress" class="form-label">Email: </label>
                                        <input type="email" class="form-control text-blackish" name="user_email_add" id="userEmailAddress" value="<?= $email ?>" disabled>
                                        <small id="emailHelp" class="form-text">We'll never share your email with anyone else.</small>
                                    </div>
                                    <div class="mb-3">
                                        <label for="userMessage" class="form-label">Message: </label>
                                        <textarea name="user_message" id="user_message" cols="30" rows="5" class="form-control" placeholder=""></textarea>
                                    </div>
                                    <div class="mb-3 form-check hide">
                                        <input type="checkbox" class="form-check-input" id="user_check">
                                        <label class="form-check-label" for="user_check">Check me out</label>
                                    </div>
                                    <div class="mb-3 align-center">
                                        <button type="submit" class="btn btn-primary" id="contact-submit">Send <i class="fa fa-paper-plane"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
            </section>
            <?php
            }
        }
        else{
            include 'header.php';
        ?>
        <section class="my-5 pt-5">
            <div class="album py-5 ">
                <div class="container">
                <div class="row row-cols-1 row-cols-sm-1 row-cols-md-1 row-cols-lg-2 g-4 align-center">
                    <div class="col">
                    <div class="card shadow-sm">
                        <legend class="text-lavander text-center py-0 my-3" x="42%" y="90%">Get In Touch</legend>
                        <div class="px-3 hide"><hr></div>
                        <div class="card-body">
                            <form action="" method="POST" id="contact-form">
                                <div class="mb-3 hide">
                                    <label for="true" class="form-label">Name: </label>
                                    <input type="text" class="form-control text-blackish" name="sender_name" id="true" aria-describedby="true" value="0" disabled>
                                </div>
                                <div class="mb-3">
                                    <select class="form-control">
                                        <option value="">What will your message all about?</option>
                                        <option value="1">Account verification</option>
                                        <option value="2">Create a new fund</option>
                                        <option value="3">Withdrawal of fund</option>
                                        <option value="3">Other concerns</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <input type="email" class="form-control text-blackish" name="email_add" id="emailAddress" placeholder="Enter email address">
                                    <small id="emailHelp" class="form-text">We'll never share your email with anyone else.</small>
                                </div>
                                <div class="mb-3">
                                    <textarea name="message" id="message" cols="30" rows="5" class="form-control" placeholder="write a message"></textarea>
                                </div>
                                <div class="mb-3 form-check hide">
                                    <input type="checkbox" class="form-check-input" id="false" value="false">
                                    <label class="form-check-label" for="false">Check me out</label>
                                </div>
                                <div class="mb-3 align-center">
                                    <button type="submit" class="btn btn-primary" id="contact-submit">Send <i class="fa fa-paper-plane"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>
        </section>
        <?php          
        }

    ?>

    
        

    
    <!-- start Footer Area -->
    <?php include 'footer.php' ?>     
    <!-- end Footer Area -->

    <!-- Plugins -->
    <?php include 'plugins.php'; ?>
    <!-- Custom Script -->
    <!-- <script src="controllers/register.js"></script> -->
</body>
</html>