<?php
session_start();

$servername = "localhost";
$username = "harsh";
$password = "harsh2005";
$dbname = "placement";

// Establish a new connection with the server
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data securely
$USN1 = $conn->real_escape_string($_POST['USN']);
$password = $conn->real_escape_string($_POST['PASSWORD']);
$confirm = $conn->real_escape_string($_POST['repassword']);

// Check if passwords match
if ($password === $confirm) {
    // Hash the password for security
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Prepare and execute the SQL update query
    $sql = "UPDATE prilogin SET PASSWORD = '$hashedPassword' WHERE Username = '$USN1'";
    if ($conn->query($sql) === TRUE) {
        echo "<center>Password Reset Complete</center>";
        echo "<center><a href='index.php'>Go Back</a></center>";
        session_unset();
    } else {
        echo "<center>Update Failed: " . $conn->error . "</center>";
    }
} else {
    echo "<center>Passwords do not match. Please try again.</center>";
}

// Close the connection
$conn->close();
?>
