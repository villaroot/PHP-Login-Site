<?php
session_start();
if(isset($_SESSION['username'])){
  header("Location: dashboard.php");
  exit();
}

if(isset($_POST['username']) && isset($_POST['password'])){
  // Check username and password against database
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Assuming you have a MySQL database, you can connect to it like this:
  $conn = mysqli_connect("localhost", "username", "password", "database_name");

  // Check if the user exists in the database
  $result = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$password'");

  if(mysqli_num_rows($result) == 1){
    // User exists, create session and cookie
    $_SESSION['username'] = $username;
    $session_token = session_id();

    // Insert session into database
    mysqli_query($conn, "INSERT INTO sessions (session_id, username, session_token) VALUES ('$session_token', '$username', '$session_token')");

    setcookie("session_token", $session_token, time() + 3600, "/"); // Set cookie to expire in 1 hour
    header("Location: dashboard.php");
    exit();
  } else {
    // Invalid username or password
    $error = "Invalid username or password";
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
</head>
<body>
  <h2>Login</h2>
  <?php if(isset($error)){ echo "<p>$error</p>"; } ?>
  <form method="post" action="">
    <label>Username:</label><br>
    <input type="text" name="username"><br>
    <label>Password:</label><br>
    <input type="password" name="password"><br><br>
    <input type="submit" value="Login">
  </form>
</body>
</html>
