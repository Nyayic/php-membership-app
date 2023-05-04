<?php
// Start a session
session_start();

// Connect to the database
$conn = mysqli_connect("localhost", "username", "password", "membership_app");

// Check for form submission
if (isset($_POST['submit'])) {
  // Retrieve form data
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Check if the user exists in the database
  $sql = "SELECT * FROM users WHERE email='$email'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) == 1) {
    // Retrieve the user's data
    $row = mysqli_fetch_assoc($result);
    $hashed_password = $row['password'];

    // Check if the password is correct
    if (password_verify($password, $hashed_password)) {
      // Authentication successful
      $_SESSION['user_id'] = $row['id'];
      $_SESSION['user_name'] = $row['name'];
      header("Location: profile.php");
      exit();
    } else {
      // Incorrect password
      echo "Incorrect password";
    }
  } else {
    // User not found
    echo "User not found";
  }
}
// Retrieve the user's role from the database
$sql = "SELECT r.name FROM users u INNER JOIN roles r ON u.role_id = r.id WHERE u.id = {$_SESSION['user_id']}";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$user_role = $row['name'];

// Close the database connection
mysqli_close($conn);
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
  <h2>Login</h2>
  <form action="login.php" method="post">
    <label for="email">Email:</label>
    <input type="email" name="email" required><br>
    <label for="password">Password:</label>
    <input type="password" name="password" required><br>
    <input type="submit" name="submit" value="Login">
  </form>
</body>
</html>