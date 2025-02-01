register 
<?php
include("connection.php"); // Include the connection to the database

if (isset($_POST['register'])) {  // Check if the form is submitted for registration
    // Validate all required fields
    if (!empty($_POST['fullname']) && !empty($_POST['email']) && !empty($_POST['add']) && !empty($_POST['Pnum']) && !empty($_POST['pass'])) {

        // Sanitize and assign input values
        $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $add = mysqli_real_escape_string($conn, $_POST['add']);
        $Pnum = mysqli_real_escape_string($conn, $_POST['Pnum']);
        $password = mysqli_real_escape_string($conn, $_POST['pass']);
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);  // Hash the password for security

        // Check if email already exists
        $stmt = $conn->prepare("SELECT * FROM login WHERE email=?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "<p style='color: red;'>Email already exists. Please use a different email.</p>";
        } else {
            // Insert new user data into the database
            $insertQuery = $conn->prepare("INSERT INTO login (fullname, email, add, Pnum, pass) VALUES (?, ?, ?, ?, ?)");
            $insertQuery->bind_param("sssss", $fullname, $email, $add, $Pnum, $hashedPassword);
            
            if ($insertQuery->execute()) {
                echo "<p style='color: green;'>Registration successful! Redirecting to login page...</p>";
                header("refresh:2;url=login.php");  // Redirect after 2 seconds
                exit();
            } else {
                echo "<p style='color: red;'>Error: " . $conn->error . "</p>";
            }
        }
    } else {
        echo "<p style='color: red;'>All fields are required!</p>";
    }
}
?>

