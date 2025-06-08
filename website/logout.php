<?php
// filepath: c:\xampp\htdocs\project\website\logout.php

// Start the session
session_start();

// Clear all session variables
$_SESSION = [];

// Destroy the session
session_destroy();

// Redirect to the login page
header("Location: index.php");
exit;
?>