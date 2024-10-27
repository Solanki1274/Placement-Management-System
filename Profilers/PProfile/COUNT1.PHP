<?php
session_start();
if (!isset($_SESSION['pusername'])) {
    header("location: index.php");
    exit("You must be logged in to view this page.");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Placement Drive Attendance</title>
</head>
<body>
<center>
<?php
// Database connection
$servername = "localhost";
$username = "harsh";
$password = "harsh2005";
$dbname = "placement";
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
    $cname = $_POST['cname'];
    $date = $_POST['date'];

    // Prepare and execute queries
    $queries = [
        'Number of Students Attended' => "SELECT COUNT(Attendence) AS count FROM updatedrive WHERE Attendence=1 AND CompanyName=? AND Date=?",
        'Number of Students Cleared WT' => "SELECT COUNT(WT) AS count FROM updatedrive WHERE WT=1 AND CompanyName=? AND Date=?",
        'Number of Students Cleared GD' => "SELECT COUNT(GD) AS count FROM updatedrive WHERE GD=1 AND CompanyName=? AND Date=?",
        'Number of Students Cleared Technical' => "SELECT COUNT(Techical) AS count FROM updatedrive WHERE Techical=1 AND CompanyName=? AND Date=?",
        'Number of Students Placed' => "SELECT COUNT(Placed) AS count FROM updatedrive WHERE Placed=1 AND CompanyName=? AND Date=?"
    ];

    foreach ($queries as $label => $query) {
        if ($stmt = $conn->prepare($query)) {
            $stmt->bind_param("ss", $cname, $date);
            $stmt->execute();
            $stmt->bind_result($count);
            $stmt->fetch();
            echo "<br>{$label}:&nbsp{$count}";
            $stmt->close();
        } else {
            echo "<br>Error preparing query for {$label}: " . $conn->error;
        }
    }
}

$conn->close();
?>
</center>
</body>
</html>
