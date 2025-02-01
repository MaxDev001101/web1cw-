homepage 
<?php
    session_start();
    include("connection.php");
   ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
     <div style="text-align: center;">
        <h1>Welcome to OceanHarvest</h1>
        <h2>Homepage</h2>
        <p>Hi, <?php 
        if(isset($_SESSION['email'])){
            $email=$_SESSION['email'];
            $query=mysqli_query($conn,"select * from login where email='$email'");
            while($row=mysqli_fetch_array($query)){
                echo $row['fullname'];
            }

        }
        else{
            header("Location:login.php");
        }
        ?></p>
        <a href="logout.php">Logout</a>
</body>
</html>