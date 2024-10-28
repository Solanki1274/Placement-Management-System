<?php
session_start();

$priusername = $_POST['Username'];
$password = $_POST['Password'];

if ($priusername && $password) {
    // Database connection using mysqli
    $connect = new mysqli("localhost", "harsh", "harsh2005", "placement");

    // Check connection
    if ($connect->connect_error) {
        die("Connection failed: " . $connect->connect_error);
    }

    // Prepare the SQL query to prevent SQL injection
    $stmt = $connect->prepare("SELECT * FROM prilogin WHERE Username = ?");
    $stmt->bind_param("s", $priusername);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $dbusername = $row['Username'];
        $dbpassword = $row['Password'];

        // Verify password (use password hashing in real applications)
        if ($priusername === $dbusername && $password === $dbpassword) {
            echo "<center>Login Successful! <br/>Redirecting you to HomePage! <br/>If not, go to <a href='index.php'>Here</a></center>";
            echo "<meta http-equiv='refresh' content='3; url=index.php'>";
            $_SESSION['priusername'] = $priusername;
        } else {
            echo "<script type='text/javascript'>alert('Username and/or Password incorrect.');</script>";
            echo "<center>Redirecting you back to Login Page! If not, go to <a href='index.php'>Here</a></center>";
            echo "<meta http-equiv='refresh' content='1; url=index.php'>";
        }
    } else {
        echo "User does not exist.";
    }

    // Close connection
    $stmt->close();
    $connect->close();
} else {
    echo "Please enter Username and Password";
}
?>
