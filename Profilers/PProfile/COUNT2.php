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
    <title>Company Drive Details</title>
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

    // Prepare and execute the query
    $stmt = $conn->prepare("SELECT * FROM addpdrive WHERE CompanyName = ?");
    $stmt->bind_param("s", $cname);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if any rows are returned
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<br><td>Date: " . htmlspecialchars($row['Date']) . "</td>";
            echo "<br><td>Campus/Pool: " . htmlspecialchars($row['C/P']) . "</td>";
            echo "<br><td>Pool Venue: " . htmlspecialchars($row['PVenue']) . "</td>";
            echo "<br><td>SSLC: " . htmlspecialchars($row['SSLC']) . "</td>";
            echo "<br><td>PU/Dip: " . htmlspecialchars($row['PU/Dip']) . "</td>";
            echo "<br><td>BE Aggregate: " . htmlspecialchars($row['BE']) . "</td>";
            echo "<br><td>Current Backlogs: " . htmlspecialchars($row['Backlogs']) . "</td>";
            echo "<br><td>History of Backlogs: " . htmlspecialchars($row['HofBacklogs']) . "</td>";
            echo "<br><td>Detain Years: " . htmlspecialchars($row['DetainYears']) . "</td>";
            echo "<br><td>Other Details: " . htmlspecialchars($row['ODetails']) . "</td><br><br><br>";
            echo "</tr>";
        }
    } else {
        echo "No records found for the selected company.";
    }

    $stmt->close();
}

$conn->close();
?>
</center>
</body>
</html>
