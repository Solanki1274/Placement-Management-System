<?php
session_start();

// Retrieve form data
$USN1 = $_POST['USN'];
$password = $_POST['PASSWORD'];
$confirm = $_POST['repassword'];

// Establishing connection with the database
$connect = mysqli_connect("localhost", "harsh", "harsh2005", "placement");

// Check connection
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the passwords match
if ($password === $confirm) {
    // Hash the password for security
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Prepare the UPDATE query
    $stmt = $connect->prepare("UPDATE plogin SET Password = ? WHERE Username = ?");
    $stmt->bind_param("ss", $hashedPassword, $USN1);

    // Execute the query
    if ($stmt->execute()) {
        echo "<center>Password Reset Complete</center>";
        session_unset(); // Clear session data
        session_destroy(); // End the session
    } else {
        echo "<center>Update Failed: " . $stmt->error . "</center>";
    }

    // Close the statement
    $stmt->close();
} else {
    echo "<center>Passwords do not match.</center>";
}

// Close the database connection
mysqli_close($connect);
?>
