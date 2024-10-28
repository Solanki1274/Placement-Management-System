<?php
session_start();

// Database connection
$connect = mysqli_connect("localhost", "harsh", "harsh2005", "placement");

// Check connection
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

$Username = $_SESSION['priusername'];
$Password = $_POST['Password'];
$repassword = $_POST['repassword'];
$cur = $_POST['curpassword'];

if ($Password && $repassword && $cur) {
    if ($Password == $repassword) {
        // Prepare and execute the query to fetch the user
        $stmt = mysqli_prepare($connect, "SELECT * FROM `prilogin` WHERE `Username`=?");
        mysqli_stmt_bind_param($stmt, "s", $Username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $dbpassword = $row['Password'];

            // Check current password
            if ($cur == $dbpassword) {
                // Prepare and execute the update statement
                $stmt = mysqli_prepare($connect, "UPDATE `prilogin` SET `Password`=? WHERE `Username`=?");
                mysqli_stmt_bind_param($stmt, "ss", $Password, $Username);
                if (mysqli_stmt_execute($stmt)) {
                    echo "<center>Password Changed Successfully</center>";
                } else {
                    echo "<center>Can't Be Changed! Try Again</center>";
                }
            } else {
                die("<center>Error! Please Check Your Password</center>");
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
mysqli_close($connect);
?>
