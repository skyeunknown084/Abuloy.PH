<?php
ini_set( 'display_errors', 1 );
error_reporting( E_ALL );
$from = "information@abuloy.ph";
$to = "abuloyph.cs@gmail.com";
$subject = "Checking PHP mail";
$message = "PHP mail works just fine";  
$headers = "From:" . $from;
if(mail($to,$subject,$message, $headers)) {
    echo "The email message was sent.";
} else {
    echo "The email message was not sent.";
}
?>