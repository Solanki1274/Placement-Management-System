<?php
session_start();
if (!isset($_SESSION['priusername'])) {
    header("location: index.php");
    exit;
}

// Database connection
$link = new mysqli("localhost", "harsh", "harsh2005", "placement");

if ($link->connect_error) {
    die("Connection failed: " . $link->connect_error);
}

// Initialize variables
$company_id = $_POST["company_id"] ?? '';
$company_name = $_POST["company_name"] ?? '';
$message = "";

// Handle approval
if ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($company_id) && !empty($company_name)) {
    // Check if company ID and name match in the database
    $check_sql = "SELECT * FROM plogin WHERE Id=? AND Name=?";
    $check_stmt = $link->prepare($check_sql);

    if ($check_stmt) {
        $check_stmt->bind_param("is", $company_id, $company_name);
        $check_stmt->execute();
        $result = $check_stmt->get_result();

        if ($result->num_rows === 1) {
            // Company ID and name match, proceed with approval
            $approve = 1;
            $sql = "UPDATE plogin SET Approve=? WHERE Id=? AND Name=?";
            $stmt = $link->prepare($sql);

            if ($stmt) {
                $stmt->bind_param("iis", $approve, $company_id, $company_name);
                
                if ($stmt->execute()) {
                    $message = "Company ID: $company_id with name '$company_name' approved successfully.";
                } else {
                    $message = "Error updating company: " . $stmt->error;
                }
                $stmt->close();
            } else {
                $message = "Error preparing statement: " . $link->error;
            }
        } else {
            // Company ID and name do not match, display error in modal
            $message = "Error: Company ID and name do not match our records.";
            echo '
            <div id="modal" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeModal()">&times;</span>
                    <h2 style="color: red;">Invalid Company Details</h2>
                    <p>' . htmlspecialchars($message) . '</p>
                    <button class="close-button" onclick="closeModal()">Close</button>
                </div>
            </div>
            <script>
                // Function to close the modal
                function closeModal() {
                    document.getElementById("modal").style.display = "none";
                }
                // Show the modal on page load
                window.onload = function() {
                    document.getElementById("modal").style.display = "block";
                }
            </script>
            <style>
                /* Modal styles */
                .modal {
                    display: none; /* Hidden by default */
                    position: fixed; /* Stay in place */
                    z-index: 1; /* Sit on top */
                    left: 0;
                    top: 0;
                    width: 100%; /* Full width */
                    height: 100%; /* Full height */
                    overflow: auto; /* Enable scroll if needed */
                    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
                }
                .modal-content {
                    background-color: #fefefe;
                    margin: 15% auto; /* 15% from the top and centered */
                    padding: 20px;
                    border: 1px solid #888;
                    width: 80%; /* Could be more or less, depending on screen size */
                    text-align: center;
                }
                .close {
                    color: #aaa;
                    float: right;
                    font-size: 28px;
                    font-weight: bold;
                }
                .close:hover,
                .close:focus {
                    color: black;
                    text-decoration: none;
                    cursor: pointer;
                }
                .close-button {
                    background-color: #f44336; /* Red background */
                    color: white; /* White text */
                    border: none;
                    padding: 10px 20px;
                    font-size: 16px;
                    margin-top: 10px;
                    cursor: pointer;
                }
                .close-button:hover {
                    background-color: #d32f2f; /* Darker red on hover */
                }
            </style>
            ';
        }
        $check_stmt->close();
    } else {
        $message = "Error preparing statement: " . $link->error;
    }
} else {
    $message = "Please provide both Company ID and Company Name.";
}

// Close the database connection
$link->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Approval Status</title>
    <meta http-equiv='refresh' content='3; url=approve2.php'> <!-- Redirect after 3 seconds -->
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
