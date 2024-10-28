<?php
session_start();
if (!isset($_SESSION["priusername"])) {
    header("location: index.php");
    exit();
}

echo "Welcome, " . htmlspecialchars($_SESSION['priusername']) . "!";

// Database connection
$mysqli = new mysqli('localhost', 'harsh', 'harsh2005', 'placement');

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
?>

<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta charset="UTF-8">
    <title>Database Connections</title>
</head>
<body>
<center>
<div>
    <form method="post" action="">
        <label for="Branch">Branch:</label>
        <input type="text" name="Branch" required>
        <label for="sslc">SSLC:</label>
        <input type="number" name="sslc" required>
        <label for="puagg">PU Aggregate:</label>
        <input type="number" name="puagg" required>
        <label for="beagg">BE Aggregate:</label>
        <input type="number" name="beagg" required>
        <label for="curback">Current Backlogs:</label>
        <input type="number" name="curback" required>
        <label for="hob">History of Backlogs:</label>
        <input type="number" name="hob" required>
        <input type="submit" name="submit" value="Search">
    </form>

    <table border="1" style="display: inline-block; border: 1px solid; float: left;">
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>USN</th>
                <th>Mobile</th>
                <th>Email</th>
                <th>DOB</th>
                <th>Current Sem</th>
                <th>Branch</th>
                <th>SSLC Percentage</th>
                <th>PU Percentage</th>
                <th>BE Aggregate</th>
                <th>Current Backlogs</th>
                <th>History of Backlogs</th>
                <th>Detain Years</th>
            </tr>
        </thead>
        <tbody>
        <?php
        if (isset($_POST['submit'])) {
            $branch = $_POST['Branch'];
            $sslc = $_POST['sslc'];
            $puaggregate = $_POST['puagg'];
            $beaggregate = $_POST['beagg'];
            $backlogs = $_POST['curback'];
            $hisofbk = $_POST['hob'];

            $stmt = $mysqli->prepare("SELECT * FROM basicdetails WHERE Approve=1 AND Branch=? AND SSLC=? AND `PU/Dip`=? AND BE=? AND Backlogs=? AND HofBacklogs=?");
            $stmt->bind_param("siiiii", $branch, $sslc, $puaggregate, $beaggregate, $backlogs, $hisofbk);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['FirstName']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['LastName']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['USN']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['Mobile']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['Email']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['DOB']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['Sem']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['Branch']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['SSLC']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['PU/Dip']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['BE']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['Backlogs']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['HofBacklogs']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['DetainYears']) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='14'>No records found</td></tr>";
            }

            $stmt->close();
        }
        $mysqli->close();
        ?>
        </tbody>
    </table>
</div>
</center>
</body>
</html>
