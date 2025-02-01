<?php
// Include the database connection file
require_once 'db.php';

// Initialize variables for storing errors and success messages
$error = "";
$success = "";

// Check if the form was submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Clean and validate the form inputs
    $full_name = !empty($_POST['full_name']) ? $conn->real_escape_string(trim($_POST['full_name'])) : null;
    $username = !empty($_POST['username']) ? $conn->real_escape_string(trim($_POST['username'])) : null;
    $password = !empty($_POST['password']) ? $conn->real_escape_string(trim($_POST['password'])) : null;
    $email = !empty($_POST['email']) ? $conn->real_escape_string(trim($_POST['email'])) : null;
    $address = !empty($_POST['address']) ? $conn->real_escape_string(trim($_POST['address'])) : null;

    // Validate all required fields are filled
    if (!$full_name || !$username || !$password || !$email || !$address) {
        $error = "All fields are required!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Check if the email format is valid
        $error = "Invalid email format!";
    } else {
        // Check if the 'users' table and 'username' column exist before querying
        $check_table = $conn->query("SHOW TABLES LIKE 'users'");
        if ($check_table->num_rows == 0) {
            $error = "Database table 'users' does not exist. Please check your database setup.";
        } else {
            // Check if the 'username' column exists
            $check_column = $conn->query("SHOW COLUMNS FROM users LIKE 'username'");
            if ($check_column->num_rows == 0) {
                $error = "Column 'username' does not exist in 'users' table. Please update your database schema.";
            } else {
                // Check if the username already exists
                $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
                $stmt->bind_param("s", $username);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $error = "Username already exists!";
                } else {
                    // Hash the password securely
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                    // Prepare an SQL statement to insert user data
                    $stmt = $conn->prepare("INSERT INTO users (full_name, username, password, email, address) VALUES (?, ?, ?, ?, ?)");
                    $stmt->bind_param("sssss", $full_name, $username, $hashed_password, $email, $address);

                    // Execute the statement and check for success
                    if ($stmt->execute()) {
                        $success = "Registration successful!";
                    } else {
                        $error = "Error: " . $conn->error;
                    }

                    // Close the statement
                    $stmt->close();
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="register.css"> <!-- Link to the CSS file -->
</head>
<body>
    <div class="register-container">
        <h2>Register</h2>
        <form method="POST" action="">
            <div class="input-group">
                <label for="full_name">Full Name:</label>
                <input type="text" name="full_name" id="full_name" value="<?php echo htmlspecialchars($full_name ?? '', ENT_QUOTES); ?>" required>
            </div>
            <div class="input-group">
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" value="<?php echo htmlspecialchars($username ?? '', ENT_QUOTES); ?>" required>
            </div>
            <div class="input-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required>
            </div>
            <div class="input-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($email ?? '', ENT_QUOTES); ?>" required>
            </div>
            <div class="input-group">
                <label for="address">Address:</label>
                <input type="text" name="address" id="address" value="<?php echo htmlspecialchars($address ?? '', ENT_QUOTES); ?>" required>
            </div>
            <button type="submit" class="btn">Register</button>
        </form>
        <div class="messages">
            <p class="success"><?php echo $success; ?></p>
            <p class="error"><?php echo $error; ?></p>
        </div>
    </div>
</body>
</html>
