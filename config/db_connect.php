<?php 
require_once './global_call.php';

$host = $_ENV['DATABASE_HOSTNAME'];
// $username = $_ENV['DATABASE_USERNAME'];
// $password = $_ENV['DATABASE_PASSWORD'];
$liveusername = $_ENV['DATABASE_LIVEUSERNAME'];
$livepassword = $_ENV['DATABASE_LIVEPASSWORD'];
$dbname = $_ENV['DATABASE_NAME'];
// Live Database Config
// $conn= new mysqli('localhost','francisr_abuloy','iAm-Abul0yPH','francisr_abuloydb')or die("Could not connect to mysql".mysqli_error($conn));
$conn= new mysqli($host,$liveusername,$livepassword,$dbname)or die("Could not connect to mysql".mysqli_error($conn));
// Localhost DB Config

// $conn= new mysqli($host,$username,$password,$dbname)or die("Could not connect to mysql".mysqli_error($conn));
