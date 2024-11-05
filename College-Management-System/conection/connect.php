<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "assignment";

// Create connection
$con = mysqli_connect($host, $user, $password, $database);

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
