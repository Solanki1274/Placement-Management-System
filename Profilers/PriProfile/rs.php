<?php
session_start();

$servername = "localhost";
$username = "harsh";
$password = "harsh2005";
$dbname = "placement";

// Establish a new connection with the server
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch form data safely
$USN = $conn->real_escape_string($_POST['USN']);
$Question = $conn->real_escape_string($_POST['Question']);
$Answer = $conn->real_escape_string($_POST['Answer']);

// Prepare and execute the SQL query
$sql = "SELECT * FROM prilogin WHERE Username = '$USN'";
$result = $conn->query($sql);

if ($result->num_rows != 0) {
    $row = $result->fetch_assoc();
    $dbQuestion = $row['Question'];
    $dbAnswer = $row['Answer'];

    if ($dbQuestion === $Question && $dbAnswer === $Answer) {
        $_SESSION['reset'] = $USN;
        header("location: Reset password.php");
        exit;
    } else {
        echo "<center>Failed! Incorrect Credentials</center>";
    }
} else {
    echo "<center>Enter Something Correctly Champ!!!</center>";
}

// Close connection
$conn->close();
?>
