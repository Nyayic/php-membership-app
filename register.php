<?php
// Connect to MySQL
$host = "localhost";
$user = "root";
$password = "";
$dbname = "membership_app";
$conn = mysqli_connect($host, $user, $password, $dbname);


// // Retrieve notes from the database
// $sql = "SELECT * FROM membership_app";
// $result = mysqli_query($conn, $sql);

// Get user input from form
$name = $_POST['name'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

// Insert user into "users" table
$sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
mysqli_query($conn, $sql);

// Close MySQL connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
</head>
<body>
    <form action="register.php" method="POST">
        <label for="name">Name:</label>
        <input type="text" name="name" required>
        <label for="email">Email:</label>
        <input type="email" name="email" required>
        <label for="password">Password:</label>
        <input type="password" name="password" required>
        <button type="submit">Register</button>
    </form>
</body>
</html>