<?php
session_start();
if(!isset($_SESSION['username']) && !isset($_COOKIE['session_token'])){
  header("Location: login.php");
}

if(isset($_COOKIE['session_token'])){
  // Verify session token against database
  $session_token = $_COOKIE['session_token'];

  // Assuming you have a MySQL database, you can connect to it like this:
  $conn = mysqli_connect("localhost", "username", "password", "database_name");

  // Check if the session token exists in the database
  $result = mysqli_query($conn, "SELECT * FROM sessions WHERE session_token='$session_token'");

  if(mysqli_num_rows($result) == 0){
    // Invalid session token, redirect to login page
    header("Location: login.php");
    exit();
  }

  $row = mysqli_fetch_assoc($result);
  $username = $row['username'];
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
</head>
<body>
	<h2>Welcome <?php echo $username; ?></h2><br>
	<h3>Token <?php echo $session_token; ?></h3><br>
	<a href="logout.php">Logout</a>
</body>
</html>
