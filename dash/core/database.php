<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "csatletis";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
$result=mysqli_query($conn,"SET NAMES 'utf8'");
// Check connection
if (!$conn) {
   die("Connection failed: " . mysqli_connect_error());
}

?>
