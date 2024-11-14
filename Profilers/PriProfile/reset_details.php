<?php
session_start();
if (isset($_SESSION['priusername'])){
      }
  else {
      header("location: index.php");
  } 
// Database connection
$servername = "localhost";
$username = "harsh";  // Update with your database username
$password = "harsh2005";      // Update with your database password
$dbname = "placement"; // Update with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get HOD ID from URL
if (isset($_GET['id'])) {
    $hod_id = $_GET['id'];

    // Reset to default values
    $default_firstname = "DNCA";
    $default_lastname = "DNCA";
    $default_username = "hmchod";
    $default_password = "User@123";

    $reset_sql = "UPDATE hlogin 
                  SET FirstName = '$default_firstname', 
                      LastName = '$default_lastname', 
                      Username = '$default_username', 
                      Password = '$default_password'
                  WHERE Id = $hod_id";

    if ($conn->query($reset_sql) === TRUE) {
        echo "Details reset successfully.";
        header("Location: view-hod.php"); // Redirect to view HOD list page after reset
        exit();
    } else {
        echo "Error resetting details: " . $conn->error;
    }
}

$conn->close();
?>
