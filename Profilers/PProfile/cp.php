<?php
session_start();
$connect = new mysqli("localhost", "harsh", "harsh2005", "placement"); // Establishing Connection with Server and Database

// Check connection
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}

$Username = $_SESSION['pusername'];
$Password = $_POST['Password'];
$repassword = $_POST['repassword'];
$cur = $_POST['curpassword'];

if ($Password && $repassword && $cur) {
    if ($Password == $repassword) {
        $sql = $connect->query("SELECT * FROM `plogin` WHERE `Username`='$Username'");
        
        if ($sql->num_rows == 1) {
            $row = $sql->fetch_assoc();
            $dbpassword = $row['Password'];
            
            if ($cur == $dbpassword) {
                $query = $connect->query("UPDATE `plogin` SET `Password` = '$Password' WHERE `Username` = '$Username'");
                
                if ($query) {
                    echo "<center>Password Changed Successfully</center>";
                } else {
                    echo "<center>Can't Be Changed! Try Again</center>";
                }
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

$connect->close(); // Close the database connection
?>
