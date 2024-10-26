<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['husername'])) {
    header("Location: index.php");
    exit;
}

// Database connection
$link = new mysqli("localhost", "harsh", "harsh2005", "placement");

// Check connection
if ($link->connect_error) {
    die("Connection failed: " . $link->connect_error);
}

// Initialize variables
$id = $_POST["id"] ?? '';
$dob = $_POST["DOB"] ?? '';
$message = "";

// Handle approval
if ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($id) && !empty($dob)) {
    // Prepare and bind
    $sql = "UPDATE basicdetails SET Approve=?, ApprovalDate=? WHERE USN=?";
    $stmt = $link->prepare($sql);

    if ($stmt) {
        $approve = 1; // Set approval value
        $stmt->bind_param("isi", $approve, $dob, $id);

        // Execute the statement
        if ($stmt->execute()) {
            $message = "USN: $id approved successfully.";
        } else {
            $message = "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        $message = "Error preparing statement: " . $link->error;
    }
}

// Close the database connection
$link->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="favicon.ico" type="image/icon">
    <link rel="icon" href="favicon.ico" type="image/icon">
    <title>Approval Status</title>
    <meta http-equiv='refresh' content='3; url=manage-users1.php'> <!-- Change this to redirect to your desired page -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            text-align: center;
            padding: 50px;
        }
    </style>
</head>
<body>
    <h1>Approval Status</h1>
    <p><?php echo htmlspecialchars($message); ?></p>
    <p>You will be redirected shortly...</p>
</body>
</html>
