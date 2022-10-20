<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Document</title>
    
</head>
<body>
    <link href='https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap' rel='stylesheet'>
    <style type='text/css'>
    body {
        font-family: 'Poppins', Sans-Serif;
    }
    </style>    
    <table style='width:50vw'>
        <tr>
            <td><a href='abuloy.ph' style='background-color:#A265E6;color:white;font-size:24px;padding:0.2rem 0.5rem;margin:0;border-top-left-radius:30px;border-top-right-radius:6px;border-bottom-left-radius:6px;border-bottom-right-radius:6px;'><span style='font-family:Poppins,sans-serif;font-weight:700;text-decoration:underline;color:#94F7CF;margin-left:0.5rem'>Abuloy</span></a></td>
        </tr>
        <tr>
            <td><div style='position:relative;top:10px;margin:5px 0;border-bottom: 2px solid #94F7CF'></div></td>
        </tr>
        <tr>
            <td style='width:100vh;margin:2% 0;'><div style='margin-top:25px;text-align:left;width:100vh;'>Hi $user_firstname,<br/><br/><span style='color:#A265E6;font-weight:500'>Forgot your password? Let's have a new one!</span><br/></div></td>
        </tr>
        <tr>
            <td style='padding: 15px 0 20px;'>We have received a request to reset your password for Abuloy.PH account.</td>
        </tr>
        <tr><td style='padding: 0px 0 15px 0;'>You can change your password by clicking the link below:</td></tr>
        <tr>
            <td style='padding: 0px 0 15px 0;'><a href="/reset-password" style='height:50px;border-radius:25px;background-color:#A265E6;color:#94F7CF;padding:8px 15px;text-align:center;font-weight:500;font-family:Poppins'>Set a new password</a></td>
        </tr>
        <tr>
            <td style='padding: 15px 0 0 0;'>However, if you did not request to reset your password.<br/>Please email us immediately by replying to this email.</td>
        </tr>
    </table>

    <div>
    <form action="/reset-password-fnc" method="POST" class="reset-form">
        <input type="text" id="email" name="email" class="form-control my-3" value="<?= $email ?>">
        <input type="text" id="password" name="password" class="form-control text-center" placeholder="Enter New">
        <span class="reset-error"></span>
        <button class="btn btn-lavander my-3 reset-submit btn-sm">Validate and Login</button>
    </form>
    </div>
</body>
</html>

<?php

//check if can login again
$login_attempt = 2;
$log_time = date("Y-m-d H:i", time());
$time = time();
if($login_attempt == 1){
    
    print_r("<br/><br/><br/>Login attempt remaining (2)");
    echo $log_time . '<br/>';
    echo $time;
}elseif($login_attempt == 2){
    print_r("<br/><br/><br/>Login attempt remaining (1)");
    echo $log_time . '<br/>';
    // echo $time; //1661844364 - 1661844336 = 28ms or 28s
    // $newtime = new DateTime('Y-m-d H:i:s');
    // echo $newtime;
    $to_time = strtotime(date('Y-m-d H:i:s'));
    $from_time = strtotime("2022-08-30 03:40:00");
    $timeout = round(abs($to_time - $from_time) / 60,2);
    // echo '<br/>' . $t;
    echo '<br/>' . $timeout;
    echo exec('getmac');
    echo '<br/>' . $_SERVER["WINDIR"];
    echo '<br/>' . gethostbyaddr($_SERVER['REMOTE_ADDR']);
    echo '<br/>' . gethostbyname($_SERVER['REMOTE_ADDR']);
    echo '<br/>' . $_SERVER['HTTP_USER_AGENT'];
    echo '<br/>' . $_SERVER['REMOTE_ADDR'] . '<br/>';
    $MAC = exec('getmac');
  
    // Storing 'getmac' value in $MAC
    $MAC = strtok($MAC, ' ');
      
    // Updating $MAC value using strtok function, 
    // strtok is used to split the string into tokens
    // split character of strtok is defined as a space
    // because getmac returns transport name after
    // MAC address   
    echo "MAC address of Server is: $MAC";
}elseif($login_attempt == 3){
    echo time();
    print_r("<br/><br/><br/>Login attempt remaining (0)");
    print_r("<br/>Account is Locked! Please try again after 5 mins or try reseting your password");
    print_r("<a href='/forgot-password'>here</a>");
    echo $log_time . '<br/>';
    echo $time;

    
    
}

/* detect mobile device*/
// $ismobile = 1;
// $container = $_SERVER['HTTP_USER_AGENT'];
// // A list of mobile devices 
// $useragents = array ( 
// 'Blazer' ,
// 'Palm' ,
// 'Handspring' ,
// 'Nokia' ,
// 'Kyocera',
// 'Samsung' ,
// 'Motorola' ,
// 'Smartphone', 
// 'Windows CE' ,
// 'Windows NT' ,
// 'Blackberry' ,
// 'Win64',
// 'WAP' ,
// 'SonyEricsson',
// 'PlayStation Portable', 
// 'LG', 
// 'MMP',
// 'OPWV',
// 'Symbian',
// 'EPOC',
// ); 

// foreach ( $useragents as $useragents ) { 
//  if(strstr($container,$useragents)) {
//    $ismobile = 1;
//  }
// }
// if ( $ismobile == 1 ) {
// echo "<p>mobile device</p>";
// echo $_SERVER['HTTP_USER_AGENT'];
// }

    $ip   = gethostbyname('abuloy.ph');
    $long = ip2long($ip);

    if ($long == -1 || $long === FALSE) {
        echo 'Invalid IP, please try again';
    } else {
        echo "<br/>" . $ip   . "\n";            // 192.0.34.166
        echo "<br/>" . $long . "\n";            // 3221234342 (-1073732954 on 32-bit systems, due to integer overflow)
        printf("%u\n", ip2long($ip)); // 3221234342
    }


?>