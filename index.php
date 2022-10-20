<?php
session_start();
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">
<?php
include 'head.php';
?>
<!-- register css -->
<!-- <link rel="stylesheet" href="./assets/dist/css/pages/dashboard.css"> -->
<style>    
</style>
</head>
<body class="bg-light">
    <?php
        
        require "database.php";

        $uid = $_SESSION['user_id'];
        $token = $_SESSION['csrf'];
        $utype = $_SESSION['user_type'];
        $fs_provider = $_SESSION['fs_provider'];
        if(isset($uid) && isset($token)){
            
            // Dashboard for User with Accounts
            $stmt = $mysqli->prepare("SELECT * FROM abuloy_users WHERE id = ?");
            $stmt->bind_param('d', $uid);
            $result = $stmt->execute();
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();
                $funeral_provider = $user['funeral_provider'];
            if(isset($user)){
                $log_time = $user['log_time'];
                $halfhr = 1 * 60; //1 mins
                $auto_out_time = $log_time + $halfhr;
                $time = time();
                if($time > $auto_out_time){
                    header("Location: /logout");
                    exit;
                }
                else{
                    include 'header-user.php';
                    include 'views/dashboard-user.php';
                }                
            }   
        }
        else{
            include 'header.php';
            include 'views/dashboard.php';
        }
    ?>
    
    <!-- start Footer Area -->
    <?php include 'footer.php'; ?>     
    <!-- end Footer Area -->

    <!-- Plugins -->
    <?php include 'plugins.php'; ?>
    <!-- Custom Script -->
    <script src="controllers/dashboard.js"></script>
    <script>
        var TxtType = function(el, toRotate, period) {
        this.toRotate = toRotate;
        this.el = el;
        this.loopNum = 0;
        this.period = parseInt(period, 10) || 2000;
        this.txt = '';
        this.tick();
        this.isDeleting = false;
    };

    TxtType.prototype.tick = function() {
        var i = this.loopNum % this.toRotate.length;
        var fullTxt = this.toRotate[i];

        if (this.isDeleting) {
        this.txt = fullTxt.substring(0, this.txt.length - 1);
        } else {
        this.txt = fullTxt.substring(0, this.txt.length + 1);
        }

        this.el.innerHTML = '<span class="wrap">'+this.txt+'</span>';

        var that = this;
        var delta = 200 - Math.random() * 100;

        if (this.isDeleting) { delta /= 2; }

        if (!this.isDeleting && this.txt === fullTxt) {
        delta = this.period;
        this.isDeleting = true;
        } else if (this.isDeleting && this.txt === '') {
        this.isDeleting = false;
        this.loopNum++;
        delta = 500;
        }

        setTimeout(function() {
        that.tick();
        }, delta);
    };

    window.onload = function() {
        var elements = document.getElementsByClassName('typewrite');
        for (var i=0; i<elements.length; i++) {
            var toRotate = elements[i].getAttribute('data-type');
            var period = elements[i].getAttribute('data-period');
            if (toRotate) {
              new TxtType(elements[i], JSON.parse(toRotate), period);
            }
        }
        // INJECT CSS
        var css = document.createElement("style");
        css.type = "text/css";
        css.innerHTML = ".typewrite > .wrap { border-right: 0.08em solid #94F7CF}";
        document.body.appendChild(css);
    };
    </script>
</body>
</html>