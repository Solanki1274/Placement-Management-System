<?php
session_start();
if (!isset($_SESSION['priusername'])) {
    header("location: index.php");
    exit();
}

// Database connection
$connect = new mysqli('localhost', 'harsh', 'harsh2005', 'placement');

// Check connection
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}

// Initialize message variable
$message = "";

// Delete company logic
if (isset($_POST['delete'])) {
    // Get user inputs
    if (isset($_POST['companyname'])) {
        $companyname = $connect->real_escape_string($_POST['companyname']);

        // SQL queries to delete records from the `addpdrive`, `updatedrive`, and `plogin` tables based on `CompanyName`
        $deleteQuery1 = "DELETE FROM addpdrive WHERE CompanyName = ?";
        $deleteQuery2 = "DELETE FROM updatedrive WHERE CompanyName = ?";
        $deleteQuery3 = "DELETE FROM plogin WHERE Name = ?";

        // Prepare and execute the delete queries
        if ($stmt1 = $connect->prepare($deleteQuery1)) {
            $stmt1->bind_param("s", $companyname);
            $stmt1->execute();
        } else {
            die("Error preparing query 1: " . $connect->error);
        }

        if ($stmt2 = $connect->prepare($deleteQuery2)) {
            $stmt2->bind_param("s", $companyname);
            $stmt2->execute();
        } else {
            die("Error preparing query 2: " . $connect->error);
        }

        if ($stmt3 = $connect->prepare($deleteQuery3)) {
            $stmt3->bind_param("s", $companyname);
            $stmt3->execute();
        } else {
            die("Error preparing query 3: " . $connect->error);
        }

        // Check if the deletion was successful
        if ($stmt1->affected_rows > 0 || $stmt2->affected_rows > 0 || $stmt3->affected_rows > 0) {
            // Close statements
            $stmt1->close();
            $stmt2->close();
            $stmt3->close();
            $connect->close();

            // Redirect with success message in query parameter
            header("Location: delete_company.php?success=1");
            exit();
        } else {
            // Close statements
            $stmt1->close();
            $stmt2->close();
            $stmt3->close();
            $connect->close();

            // Redirect with error message
            header("Location: delete_company.php?error=1");
            exit();
        }
    } else {
        header("Location: delete_company.php?error=1");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Company</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 30px;
            width: 400px;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            font-size: 14px;
            font-weight: bold;
            color: #555;
        }
        input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
            color: #333;
        }
        .button-group {
            text-align: center;
        }
        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            margin: 5px;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Delete Company</h2>
    <form method="POST" action="">
        <div class="form-group">
            <label for="companyname">Username</label>
            <input type="text" name="companyname" id="username" required>
        </div>
  <div class="form-group">
            <label for="companyname">Company Name</label>
            <input type="text" name="companyname" id="companyname" required>
        </div>
        <div class="button-group">
            <button type="submit" name="delete" onclick="return confirmDelete()">Delete Company</button>
            <button type="reset">Reset</button>
        </div>
    </form>
</div>

<script>
function confirmDelete() {
    return confirm("Are you sure you want to delete this company? This action cannot be undone.");
}

// Check if the URL has a success or error parameter and display corresponding alert
<?php
if (isset($_GET['success'])) {
    echo 'alert("student deleted successfully!");';
} elseif (isset($_GET['error'])) {
    echo 'alert("An error occurred. Please try again.");';
}
?>
</script>

</body>
</html>
