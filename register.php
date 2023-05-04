<?php
// Connect to the database
$conn = mysqli_connect("localhost", "username", "password", "membership_app");

// Check for form submission
if (isset($_POST['submit'])) {
  // Retrieve form data
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

  // Insert new user into the database
  $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
  if (mysqli_query($conn, $sql)) {
    echo "Registration successful";
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
}

// Close the database connection
mysqli_close($conn);
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
</head>
<body>
    <h2>Register</h2>
    <form action="register.php" method="post">
      <label for="name">Name:</label>
      <input type="text" name="name" required><br>
      <label for="email">Email:</label>
      <input type="email" name="email" required><br>
      <label for="password">Password:</label>
      <input type="password" name="password" required><br>
      <input type="submit" name="submit" value="Register">
</form>
</body>
</html>