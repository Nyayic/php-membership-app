
<?php
// Start session
session_start();

// Check if user is already logged in
if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit;
}

// Check if login form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get user input from form
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Connect to MySQL
    $conn = mysqli_connect('localhost', 'username', 'password', 'database');

    // Lookup user in "users" table by email
    $sql = "SELECT id, password FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);

    // Verify password hash with password_verify() function
    if ($user && password_verify($password, $user['password'])) {
        // Login successful, set session variables
        $_SESSION['user_id'] = $user['id'];

        // Close MySQL connection
        mysqli_close($conn);

        // Redirect to dashboard page
        header('Location: dashboard.php');
        exit;
    } else {
        // Login failed, show error message
        $error_msg = 'Invalid email or password';
    }

    // Close MySQL connection
    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
<form action="login.php" method="POST">
    <label for="email">Email:</label>
    <input type="email" name="email" required>
    <label for="password">Password:</label>
    <input type="password" name="password" required>
    <button type="submit">Login</button>
</form>

</body>
</html>