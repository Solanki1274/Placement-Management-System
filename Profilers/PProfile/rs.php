<?php
session_start();

// Establishing Connection with Server
$connect = mysqli_connect("localhost", "harsh", "harsh2005", "placement");

// Check connection
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get POST data
$USN = $_POST['USN'];
$Question = $_POST['Question'];
$Answer = $_POST['Answer'];

// Prepare and execute the SELECT query
$stmt = $connect->prepare("SELECT Question, Answer FROM plogin WHERE Username = ?");
$stmt->bind_param("s", $USN);
$stmt->execute();
$result = $stmt->get_result();

// Check if any rows are returned
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $dbQuestion = $row['Question'];
    $dbAnswer = $row['Answer'];

    // Verify the security question and answer
    if ($dbQuestion === $Question && $dbAnswer === $Answer) {
        $_SESSION['reset'] = $USN;
        header("Location: Reset password.php");
        exit();
    } else {
        echo "<center>Failed! Incorrect Credentials</center>";
    }
} else {
    echo "<center>Enter Something Correctly!!!</center>";
}

// Close the statement and connection
$stmt->close();
$connect->close();
?>
