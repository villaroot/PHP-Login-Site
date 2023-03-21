<?php
session_start();
require_once('config.php');

// Delete the session data for the current user from the SQL database
$username = $_SESSION['username'];
$session_id = session_id();
$sql = "DELETE FROM sessions WHERE username='$username' AND session_id='$session_id'";
$result = mysqli_query($conn, $sql);
if (!$result) {
    die('Error deleting session data: ' . mysqli_error($conn));
}

// Terminate the user cookie by setting its expiration time to the past
setcookie('user', '', time() - 3600, '/');

// Destroy the session
session_unset();
session_destroy();

// Redirect the user to the login page
header('Location: login.php');
exit;
?>
