<?php
session_start();
$branch = $_POST['Branch'];
$husername = $_POST['username'];
$password = $_POST['password'];

if ($husername && $password && $branch) {
    // Updated to mysqli_connect
    $connect = mysqli_connect("localhost", "harsh", "harsh2005", "placement");

    if (!$connect) {
        die("Couldn't Connect: " . mysqli_connect_error());
    }

    // Updated query execution to mysqli
    $query = mysqli_query($connect, "SELECT * FROM hlogin WHERE Username='$husername'");

    if ($query) {
        $numrows = mysqli_num_rows($query);

        if ($numrows != 0) {
            while ($row = mysqli_fetch_assoc($query)) {
                $dbbranch = $row['Branch'];
                $dbusername = $row['Username'];
                $dbpassword = $row['Password'];
            }

            // Check credentials
            if ($branch == $dbbranch && $husername == $dbusername && $password == $dbpassword) {
                echo "<center>Login Successful..!! <br/>Redirecting you to HomePage! </br>If not, go <a href='index.php'> here </a></center>";
                echo "<meta http-equiv='refresh' content='3; url=index.php'>";
                $_SESSION['husername'] = $husername;
                $_SESSION['department'] = $branch;
            } else {
                $message = "Username and/or Password and/or Department are/is incorrect.";
                echo "<script type='text/javascript'>alert('$message');</script>";
                echo "<center>Redirecting you back to Login Page! If not, go <a href='index.php'> here </a></center>";
                echo "<meta http-equiv='refresh' content='1; url=index.php'>";
            }
        } else {
            die("User does not exist");
        }
    } else {
        die("Error executing query: " . mysqli_error($connect));
    }
} else {
    $message = "Field can't be left blank";
    echo "<script type='text/javascript'>alert('$message');</script>";
    echo "<center>Redirecting you back to Login Page! If not, go <a href='index.php'> here </a></center>";
    echo "<meta http-equiv='refresh' content='1; url=index.php'>";
}

// Close the connection
mysqli_close($connect);
?>
