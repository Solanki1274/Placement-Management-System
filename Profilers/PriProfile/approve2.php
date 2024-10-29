<?php
session_start();
if (isset($_SESSION['priusername'])) {
    // User is logged in
} else {
    header("location: index.php");
    exit; // It's good practice to add exit after header redirection.
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Approve Company</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            text-align: center;
            padding: 50px;
        }
        h1 {
            color: #4CAF50; /* Green color for the heading */
            margin-bottom: 20px;
        }
        form {
            background-color: white;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            margin: auto;
            position: relative;
            top: 50%;
            transform: translateY(-50%);
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #4CAF50; /* Green button */
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #45a049; /* Darker green on hover */
        }
    </style>
    <script>
        // Function to confirm approval before form submission
        function confirmApproval() {
            return confirm("Are you sure you want to approve this company?");
        }
    </script>
</head>
<body>
    <h1>Approve Company</h1>
    <form action="approve.php" method="post" onsubmit="return confirmApproval()">
        <label for="company_id">Enter the Company ID:</label>
        <input type="text" name="company_id" id="company_id" required><br><br>
        
        <label for="company_name">Enter the Company Name:</label>
        <input type="text" name="company_name" id="company_name" required><br><br>
        
        <input type="submit" value="Approve">
    </form>
</body>
</html>
