<?php
// Start a session
session_start();

// Connect to the database
$conn = mysqli_connect("localhost", "username", "password", "mydatabase");

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}

// Retrieve the user's role from the database
$sql = "SELECT r.name FROM users u INNER JOIN roles r ON u.role_id = r.id WHERE u.id = {$_SESSION['user_id']}";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$user_role = $row['name'];

// Check if the user has the "admin" role
if ($user_role != "admin") {
  echo "Access denied";
  exit();
}

// Display the dashboard
echo "Welcome to the dashboard, {$_SESSION['user_name']}";
?>
