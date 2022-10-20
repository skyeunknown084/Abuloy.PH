<?php

require 'global_call.php';

$host = $_ENV['DATABASE_HOSTNAME'];
$username = $_ENV['DATABASE_USERNAME'];
$password = $_ENV['DATABASE_PASSWORD'];
// $liveusername = $_ENV['DATABASE_LIVEUSERNAME'];
// $livepassword = $_ENV['DATABASE_LIVEPASSWORD'];
$dbname = $_ENV['DATABASE_NAME'];
// Live Database Config
// $mysqli= new mysqli($host,$liveusername,$livepassword,$dbname)or die("Could not connect to mysql".mysqli_error($mysqli));
// $mysqli= new mysqli(hostname: $host, 
//                      username: $liveusername, 
//                      password: $livepassword, 
//                      database: $dbname);
// Localhost DB Config
$mysqli= new mysqli($host,$username,$password,$dbname)or die("Could not connect to mysql".mysqli_error($mysqli));
// $mysqli = new mysqli(hostname: $host, 
//                      username: $username, 
//                      password: $password, 
//                      database: $dbname);

if($mysqli->connect_errno) {
    die("Connection error: " . $mysqli->connect_error);
}

return $mysqli;