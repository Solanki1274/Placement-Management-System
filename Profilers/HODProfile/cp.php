<?php
session_start();

// Database connection
$servername = "localhost";
$username = "harsh";
$password = "harsh2005";
$dbname = "placement";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$Username = $_SESSION['husername'];
$Password = $_POST['Password'];
$repassword = $_POST['repassword'];
$cur = $_POST['curpassword'];

if ($Password && $repassword && $cur) {
    if ($Password == $repassword) {
        // Prepare statement to prevent SQL injection
        $stmt = $conn->prepare("SELECT Password FROM hlogin WHERE Username = ?");
        $stmt->bind_param("s", $Username);
        $stmt->execute();
        $stmt->store_result();

        // Check if the username exists
        if ($stmt->num_rows === 1) {
            $stmt->bind_result($dbpassword);
            $stmt->fetch();
            $stmt->close();

            // Verify current password
            if ($cur == $dbpassword) { // Compare without hashing
                // Update the password (storing in plain text)
                $updateStmt = $conn->prepare("UPDATE hlogin SET Password = ? WHERE Username = ?");
                $updateStmt->bind_param("ss", $Password, $Username); // No hashing

                if ($updateStmt->execute()) {
                    echo "<center>Password Changed Successfully</center>";
                } else {
                    echo "<center>Can't Be Changed! Try Again</center>";
                }

                $updateStmt->close();
            } else {
                die("<center>Error! Please Check your Current Password</center>");
            }
        } else {
            die("<center>Username not Found</center>");
        }
    } else {
        die("<center>Passwords Do Not Match</center>");
    }
} else {
    die("<center>Enter All Fields</center>");
}

// Close the database connection
$conn->close();
?>
