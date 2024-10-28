<?php
session_start();
if (!isset($_SESSION['priusername'])) {
    header("location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Placement Drive Report</title>
</head>
<body>
    <center>
        <form method="POST" action="">
            <label for="cname">Company Name:</label>
            <input type="text" name="cname" id="cname" required>
            <br><br>
            <label for="date">Date:</label>
            <input type="date" name="date" id="date" required>
            <br><br>
            <input type="submit" name="submit" value="Generate Report">
        </form>

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

            // Define a function to fetch and display counts for different stages
            function fetchCount($conn, $column, $companyName, $date) {
                $stmt = $conn->prepare("SELECT COUNT($column) AS count FROM updatedrive WHERE $column = 1 AND CompanyName = ? AND Date = ?");
                $stmt->bind_param("ss", $companyName, $date);
                $stmt->execute();
                $result = $stmt->get_result();
                $data = $result->fetch_assoc();
                $stmt->close();
                return $data['count'];
            }

            echo "<br>Number of Students Attended: " . fetchCount($connect, 'Attendence', $cname, $date);
            echo "<br>Number of Students Cleared WT: " . fetchCount($connect, 'WT', $cname, $date);
            echo "<br>Number of Students Cleared GD: " . fetchCount($connect, 'GD', $cname, $date);
            echo "<br>Number of Students Cleared Technical: " . fetchCount($connect, 'Techical', $cname, $date);
            echo "<br>Number of Students Placed: " . fetchCount($connect, 'Placed', $cname, $date);

            $connect->close();
        }
        ?>
    </center>
</body>
</html>
