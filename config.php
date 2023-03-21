<?php
// Database configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'DatabaseUsername');
define('DB_PASS', 'DatabasePassword');
define('DB_NAME', 'DatabaseName');

// Create a MySQL connection object, $conn will be used in other php files
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check the connection
if (!$conn) {
    die('Error connecting to the database: ' . mysqli_connect_error());
}

// Set the default timezone
date_default_timezone_set('America/New_York');
?>
