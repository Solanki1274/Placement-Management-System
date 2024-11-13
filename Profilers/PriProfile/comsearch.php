<?php
session_start();
if (!isset($_SESSION['priusername'])) {
    header("location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Placement Drive Report</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .form-container, .result-container {
            width: 80%;
            max-width: 600px;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }
        .form-container h2 {
            text-align: center;
        }
        .form-group {
            margin: 10px 0;
        }
        .form-group label {
            display: block;
            font-weight: bold;
        }
        .form-group input[type="text"], .form-group input[type="date"] {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .btn-group {
            text-align: right;
        }
        .btn {
            padding: 10px 15px;
            margin-top: 10px;
            cursor: pointer;
            border: none;
            border-radius: 4px;
        }
        .btn-blue {
            background-color: #007bff;
            color: #fff;
        }
        .btn-reset {
            background-color: #ccc;
            color: #333;
        }
        .result-card {
            margin: 10px 0;
            padding: 15px;
            border-radius: 6px;
            background-color: #e7f3ff;
            border-left: 5px solid #007bff;
        }
        footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #666;
        }
        footer a {
            color: #007bff;
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Placement Drive Report</h2>
    <form method="POST" action="">
        <div class="form-group">
            <label for="cname">Company Name:</label>
            <input type="text" name="cname" id="cname" required>
        </div>
        <div class="form-group">
            <label for="date">Date:</label>
            <input type="date" name="date" id="date" required>
        </div>
        <div class="btn-group">
            <button type="submit" name="submit" class="btn btn-blue">Generate Report</button>
            <button type="reset" class="btn btn-reset">Reset</button>
        </div>
    </form>
</div>

<?php
if (isset($_POST['submit'])) {
    // Database connection
    $connect = new mysqli('localhost', 'harsh', 'harsh2005', 'placement');

    // Check connection
    if ($connect->connect_error) {
        die("Connection failed: " . $connect->connect_error);
    }

    // Retrieve and sanitize inputs
    $cname = $connect->real_escape_string($_POST['cname']);
    $date = $connect->real_escape_string($_POST['date']);

    // Function to fetch and display counts for different stages
    function fetchCount($conn, $column, $companyName, $date) {
        $stmt = $conn->prepare("SELECT COUNT($column) AS count FROM updatedrive WHERE $column = 1 AND CompanyName = ? AND Date = ?");
        $stmt->bind_param("ss", $companyName, $date);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        $stmt->close();
        return $data['count'];
    }

    echo "<div class='form-container result-container'>";
    echo "<div class='result-card'><strong>Number of Students Attended:</strong> " . fetchCount($connect, 'Attendence', $cname, $date) . "</div>";
    echo "<div class='result-card'><strong>Number of Students Cleared WT:</strong> " . fetchCount($connect, 'WT', $cname, $date) . "</div>";
    echo "<div class='result-card'><strong>Number of Students Cleared GD:</strong> " . fetchCount($connect, 'GD', $cname, $date) . "</div>";
    echo "<div class='result-card'><strong>Number of Students Cleared Technical:</strong> " . fetchCount($connect, 'Techical', $cname, $date) . "</div>";
    echo "<div class='result-card'><strong>Number of Students Placed:</strong> " . fetchCount($connect, 'Placed', $cname, $date) . "</div>";
    echo "</div>";

    $connect->close();
}
?>

<footer>
    <p>&copy; 2024 Hmc-PMS | Designed by <a href="#">Hmc FutureTechnologies</a></p>
</footer>

</body>
</html>
