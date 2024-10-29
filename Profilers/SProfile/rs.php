<?php
session_start();

$connect = mysqli_connect("localhost", "harsh", "harsh2005", "placement"); // Establishing Connection with Database

if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

$usn = $_POST['USN'];
$question = $_POST['Question'];
$answer = $_POST['Answer'];

// Check if the USN exists in the database
$check_stmt = mysqli_prepare($connect, "SELECT Question, Answer FROM slogin WHERE USN = ?");
mysqli_stmt_bind_param($check_stmt, "s", $usn);
mysqli_stmt_execute($check_stmt);
mysqli_stmt_store_result($check_stmt);

if (mysqli_stmt_num_rows($check_stmt) != 0) {
    mysqli_stmt_bind_result($check_stmt, $dbQuestion, $dbAnswer);
    mysqli_stmt_fetch($check_stmt);

    if ($dbQuestion === $question && $dbAnswer === $answer) {
        $_SESSION['reset'] = $usn;
        header("Location: Reset password.php");
        exit();
    } else {
        echo "<center>Failed! Incorrect Credentials</center>";
    }
} else {
    echo "<center>Enter Something Correctly Champ!!!</center>";
}

mysqli_stmt_close($check_stmt);
mysqli_close($connect);
?>
