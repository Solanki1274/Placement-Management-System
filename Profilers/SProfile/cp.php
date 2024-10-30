<?php
session_start();

// Establish a secure connection using mysqli
$connect = new mysqli("localhost", "harsh", "harsh2005", "placement");

if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}

// Check if session and POST variables are set
if (isset($_SESSION['username']) && isset($_POST['Password']) && isset($_POST['repassword']) && isset($_POST['curpassword'])) {
    
    $Username = $_SESSION['username'];
    $Password = $_POST['Password'];
    $repassword = $_POST['repassword'];
    $cur = $_POST['curpassword'];
    
    // Ensure both new passwords match
    if ($Password === $repassword) {
        
        // Prepare and execute the SQL query to fetch the user's current password
        $stmt = $connect->prepare("SELECT PASSWORD FROM slogin WHERE USN = ?");
        $stmt->bind_param("s", $Username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            $dbpassword = $row['PASSWORD'];
            
            // Check if entered current password matches the stored password
            if ($cur === $dbpassword) {
                
                // Prepare and execute the update statement
                $updateStmt = $connect->prepare("UPDATE slogin SET PASSWORD = ? WHERE USN = ?");
                $updateStmt->bind_param("ss", $Password, $Username);
                
                if ($updateStmt->execute()) {
                    echo "<center>Password Changed Successfully</center>";
                } else {
                    echo "<center>Can't Be Changed! Try Again</center>";
                }
                $updateStmt->close();
            } else {
                echo "<center>Error! Please Check your Current Password</center>";
            }
        } else {
            echo "<center>Username not Found</center>";
        }
        $stmt->close();
    } else {
        echo "<center>Passwords Do Not Match</center>";
    }
} else {
    echo "<center>Please Enter All Fields</center>";
}

// Close the connection
$connect->close();
?>
