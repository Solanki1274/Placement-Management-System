<?php
session_start();
if (!isset($_SESSION['husername'])) {
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

// Delete student logic
if (isset($_POST['delete'])) {
    // Get user inputs
    if (isset($_POST['usn'])) {
        $usn = $connect->real_escape_string($_POST['usn']); // Get the USN from the form input

        // SQL queries to delete records from `slogin`, `basicdetails`, and `interview` tables based on `USN`
        $deleteQuery1 = "DELETE FROM slogin WHERE USN = ?";
        $deleteQuery2 = "DELETE FROM basicdetails WHERE USN = ?";
        $deleteQuery3 = "DELETE FROM interviews WHERE USN = ?";

        // Prepare and execute the delete queries
        if ($stmt1 = $connect->prepare($deleteQuery1)) {
            $stmt1->bind_param("s", $usn);
            $stmt1->execute();
        } else {
            die("Error preparing query 1: " . $connect->error);
        }

        if ($stmt2 = $connect->prepare($deleteQuery2)) {
            $stmt2->bind_param("s", $usn);
            $stmt2->execute();
        } else {
            die("Error preparing query 2: " . $connect->error);
        }

        if ($stmt3 = $connect->prepare($deleteQuery3)) {
            $stmt3->bind_param("s", $usn);
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
            header("Location: delete_student.php?success=1");
            exit();
        } else {
            // Close statements
            $stmt1->close();
            $stmt2->close();
            $stmt3->close();
            $connect->close();

            // Redirect with error message
            header("Location: delete_student.php?error=1");
            exit();
        }
    } else {
        header("Location: delete_student.php?error=1");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Student</title>
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
    <h2>Delete Student</h2>
    <form method="POST" action="">
        <div class="form-group">
            <label for="usn">USN</label>
            <input type="text" name="usn" id="usn" required>
        </div>

        <div class="button-group">
            <button type="submit" name="delete" onclick="return confirmDelete()">Delete Student</button>
            <button type="reset">Reset</button>
        </div>
    </form>
</div>

<script>
function confirmDelete() {
    return confirm("Are you sure you want to delete this student? This action cannot be undone.");
}

// Check if the URL has a success or error parameter and display corresponding alert
<?php
if (isset($_GET['success'])) {
    echo 'alert("Student deleted successfully!");';
} elseif (isset($_GET['error'])) {
    echo 'alert("An error occurred. Please try again.");';
}
?>
</script>

</body>
</html>
