<?php
session_start();

$usn1 = $_POST['USN'];
$password = $_POST['PASSWORD'];
$confirm = $_POST['repassword'];
$usn2 = $_SESSION['reset'];

$connect = mysqli_connect("localhost", "harsh", "harsh2005", "placement");

if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($usn1 && $password && $confirm) {
    if ($password === $confirm) {
        if ($usn2 === $usn1) {
            // Using prepared statement to prevent SQL injection
            $stmt = mysqli_prepare($connect, "UPDATE slogin SET PASSWORD = ? WHERE USN = ?");
            mysqli_stmt_bind_param($stmt, "ss", $password, $usn1);
            
            if (mysqli_stmt_execute($stmt)) {
                echo "<center>Password Reset Complete</center>";
                session_unset(); // Clear the session variable
            } else {
                echo "<center>Update Failed</center>";
            }
            
            mysqli_stmt_close($stmt);
        } else {
            session_unset();
            die("<center>Enter Your USN only</center>");
        }
    } else {
        echo "<center>Passwords do not match</center>";
        session_unset();
    }
} else {
    echo "<center>Fields cannot be left blank</center>";
    session_unset();
}

mysqli_close($connect);
?>
