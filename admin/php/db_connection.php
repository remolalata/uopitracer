<?php

$host = "localhost";
$username = "root";
$password = "";
$db = "alumnitracerdb";

// $host = "mysql.hostinger.ph";
// $username = "u512871206_user";
// $password = "abcd1234";
// $db = "u512871206_uop";

$conn = mysqli_connect($host, $username, $password, $db);

if(!$conn){
  die("Failed to connect to MySQL: " . mysqli_connect_error());
}

?>
