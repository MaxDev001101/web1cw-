<?php
// Include the database connection file
require_once 'db.php';

session_start(); // Start the session

// Initialize variables for storing errors
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the submitted username and password
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);

    // Query to check if the user exists
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch user data
        $row = $result->fetch_assoc();
        // Verify the password
        if (password_verify($password, $row['password'])) {
            // Set session variables
            $_SESSION['username'] = $row['username'];
            $_SESSION['email'] = $row['email'];
            
            // Redirect to the front page after login
            header("Location: frontsite.php");  // Corrected redirection
            exit;
        } else {
            $error = "Invalid password!";
        }
    } else {
        $error = "User not found!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css"> <!-- Link to the CSS file -->
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <h2>Login</h2>
            <form method="POST" action="">
                <div class="input-group">
                    <label for="username">Username:</label>
                    <input type="text" name="username" id="username" required>
                </div>
                <div class="input-group">
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password" required>
                </div>
                <button type="submit" class="submit-button">Login</button>
            </form>
            <?php if (!empty($error)): ?>
                <p class="error-message"><?php echo $error; ?></p>
            <?php endif; ?>
            <div class="register-link">
                <p>Don't have an account? <a href="register.php">Register here</a></p>
            </div>
        </div>
    </div>
</body>
</html>
