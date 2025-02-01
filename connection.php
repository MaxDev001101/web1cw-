connection 
<?php
// Database credentials
$host = "localhost";
$user = "root";
$db = "login";  // Ensure this is the correct database name
$pass = "";  // Leave the password empty if no password is set for root


// Create connection using mysqli with better error handling
$conn = new mysqli($host, $user, $pass, $db);

if(!$conn)
{
    die("Connection failed: " . mysqli_connect_error());
}
else
{
    echo "Connected successfully";
}

// // Check if the connection was successful, and handle errors
// if ($conn->connect_error) {
//     // Log the error to a file (you can enable this if needed)
//     error_log("Connection failed: " . $conn->connect_error, 3, "errors.log");

//     // Display a generic error message for security reasons
//     die("Database connection failed. Please try again later.");
// } 

// Uncomment this for debugging if needed
// echo "Connection Successful"; 
?>
