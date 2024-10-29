<?php
$connect = mysqli_connect("localhost", "harsh", "harsh2005", "placement"); // Establishing Connection with Database

if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['submit'])) { 
    $name = $_POST['Fullname'];
    $usn = $_POST['USN'];
    $password = $_POST['PASSWORD'];
    $repassword = $_POST['repassword'];
    $email = $_POST['Email'];
    $question = $_POST['Question'];
    $answer = $_POST['Answer'];

    // Check if the USN already exists in the database
    $check_stmt = mysqli_prepare($connect, "SELECT * FROM slogin WHERE USN = ?");
    mysqli_stmt_bind_param($check_stmt, "s", $usn);
    mysqli_stmt_execute($check_stmt);
    mysqli_stmt_store_result($check_stmt);

    if (mysqli_stmt_num_rows($check_stmt) == 0) {
        if ($password === $repassword) {
            // Insert new user information into the database using prepared statement
            $query = "INSERT INTO slogin (Name, USN, PASSWORD, Email, Question, Answer) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($connect, $query);
            mysqli_stmt_bind_param($stmt, "ssssss", $name, $usn, $password, $email, $question, $answer);

            if (mysqli_stmt_execute($stmt)) {
                echo "<center>You have registered successfully...!! Go back to </center>";
                echo "<center><a href='index.php'>Login here</a></center>";
            } else {
                echo "<center>Registration failed. Please try again.</center>";
            }
            mysqli_stmt_close($stmt);
        } else {
            echo "<center>Your passwords do not match</center>";
        }
    } else {
        echo "<center>This USN already exists</center>";
    }

    mysqli_stmt_close($check_stmt);
}

mysqli_close($connect);
?>
