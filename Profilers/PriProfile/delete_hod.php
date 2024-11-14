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

    // Delete HOD from the database
    $delete_sql = "DELETE FROM hlogin WHERE Id = $hod_id";

    if ($conn->query($delete_sql) === TRUE) {
        echo "HOD deleted successfully.";
        header("Location: view-hod.php"); // Redirect to view HOD list page after deletion
        exit();
    } else {
        echo "Error deleting HOD: " . $conn->error;
    }
}

$conn->close();
?>
