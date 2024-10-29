<?php
session_start();

if (isset($_POST['username'], $_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $connect = mysqli_connect("localhost", "harsh", "harsh2005", "placement");

    if (!$connect) {
        die("Couldn't Connect to Database: " . mysqli_connect_error());
    }

    $query = "SELECT * FROM slogin WHERE USN=?";
    $stmt = mysqli_prepare($connect, $query);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $dbusername = $row['USN'];
        $dbpassword = $row['PASSWORD'];

        // Check if the stored password is hashed
        if (password_verify($password, $dbpassword)) {
            // Password matches
            echo "<center>Login Successful! <br/>Redirecting you to HomePage!<br/>If not, go <a href='index.php'>Here</a></center>";
            echo "<meta http-equiv='refresh' content='3; url=index.php'>";
            $_SESSION['username'] = $username;
        } elseif ($password === $dbpassword) {
            // Password is stored as plain text in the database, but matches
            echo "<center>Login Successful! <br/>Redirecting you to HomePage!<br/>If not, go <a href='index.php'>Here</a></center>";
            echo "<meta http-equiv='refresh' content='3; url=index.php'>";
            $_SESSION['username'] = $username;

            // Rehash the password for security
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $updateQuery = "UPDATE slogin SET PASSWORD=? WHERE USN=?";
            $updateStmt = mysqli_prepare($connect, $updateQuery);
            mysqli_stmt_bind_param($updateStmt, "ss", $hashedPassword, $username);
            mysqli_stmt_execute($updateStmt);
            mysqli_stmt_close($updateStmt);
        } else {
            // Password does not match
            echo "<script type='text/javascript'>alert('Username and/or Password incorrect.');</script>";
            echo "<center>Redirecting you back to Login Page! If not, go <a href='index.php'>Here</a></center>";
            echo "<meta http-equiv='refresh' content='1; url=index.php'>";
        }
    } else {
        echo "User does not exist.";
    }

    mysqli_stmt_close($stmt);
    mysqli_close($connect);
} else {
    echo "Please enter USN and Password";
}
?>
