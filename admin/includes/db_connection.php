<?php
// Database connection script
$host = "localhost";
$username = "root";
$password = "";
$database = "majorproject";

// Establishing the connection
$con = mysqli_connect($host, $username, $password, $database);

// Check the connection
if (!$con) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>