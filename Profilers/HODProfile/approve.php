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
$message = "";

// Handle approval
if ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($id)) {
    // Prepare and bind for basicdetails table
    $sql = "UPDATE basicdetails SET Approve=?, ApprovalDate=NOW() WHERE USN=?";
    $stmt = $link->prepare($sql);

    if ($stmt) {
        $approve = 1; // Set approval value
        $stmt->bind_param("is", $approve, $id); // 'is' because Approve is an integer and USN is a string

        // Execute the statement for basicdetails table
        if ($stmt->execute()) {
            // After successful approval in basicdetails, update the slogin table
            // Close the first statement before preparing a new one
            $stmt->close(); 

            // Prepare and bind for slogin table
            $sql_slogin = "UPDATE slogin SET Approve=? WHERE USN=?";
            $stmt_slogin = $link->prepare($sql_slogin);

            if ($stmt_slogin) {
                $stmt_slogin->bind_param("is", $approve, $id); // 'is' because Approve is an integer and USN is a string

                // Execute the statement for slogin table
                if ($stmt_slogin->execute()) {
                    $message = "USN: $id Approved successfully.";
                } else {
                    $message = "Error updating slogin: " . $stmt_slogin->error;
                }

                // Close the second statement
                $stmt_slogin->close();
            } else {
                $message = "Error preparing statement for slogin: " . $link->error;
            }
        } else {
            $message = "Error updating basicdetails: " . $stmt->error;
        }
    } else {
        $message = "Error preparing statement for basicdetails: " . $link->error;
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
    <meta http-equiv='refresh' content='3; url=manage-users.php'> <!-- Change this to redirect to your desired page -->
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
