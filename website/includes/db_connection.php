<?php
// Database connection script
$host = 'localhost'; // Hostname
$username = 'root'; // MySQL username
$password = ''; // MySQL password (default is empty for XAMPP)
$database = 'majorproject'; // Database name

// Create connection
$con = mysqli_connect($host, $username, $password, $database);

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
