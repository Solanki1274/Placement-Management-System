<?php
// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Get form data
    $subject = $_POST['Subject'];
    $message = $_POST['Message'];
    $images = $_POST['Images']; // Assuming you're handling images as well

    // Database connection parameters
    $servername = "localhost";
    $username = "harsh";
    $password = "harsh2005";
    $dbname = "placement";

    // Create a connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO prim (Subject, Message, Images) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $subject, $message, $images); // 'sss' indicates three string parameters

    // Execute the statement
    if ($stmt->execute()) {
        echo "Message has been posted";
    } else {
        echo "Message posting unsuccessful! Try again: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
