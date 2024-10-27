<?php
session_start();
if (isset($_SESSION['pusername'])) {
    echo "Welcome, " . $_SESSION['pusername'] . "!";
} else {
    header("location: index.php");
    die("You must be logged in to view this page <a href='index.php'>Click here</a>");
}

// Database Connection
$host = 'localhost';
$user = 'harsh';
$password = 'harsh2005';
$database = 'placement';

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="favicon.ico" type="image/icon">
    <link rel="icon" href="favicon.ico" type="image/icon">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    <title>Manage Students</title>
    
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,700" rel="stylesheet" type="text/css">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/templatemo-style.css" rel="stylesheet">
</head>

<body>
<div class="bg">
    <div class="templatemo-content-container">
        <center><h2>Approved Students List of CVE</h2></center>
        <div class="templatemo-content-widget no-padding">
            <div class="panel panel-default table-responsive">
                <table class="table table-striped table-bordered templatemo-user-table">
                    <thead>
                        <tr>
                            <td>First Name</td>
                            <td>Last Name</td>
                            <td>USN</td>
                            <td>Mobile</td>
                            <td>Email</td>
                            <td>DOB</td>
                            <td>Sem</td>
                            <td>Branch</td>
                            <td>SSLC</td>
                            <td>PU/Dip</td>
                            <td>BE</td>
                            <td>Backlogs</td>
                            <td>History Of Backlogs</td>
                            <td>Detain Years</td>
                        </tr>
                    </thead>
                    <tbody>

                    <?php
                    $num_rec_per_page = 2;
                    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
                    $start_from = ($page - 1) * $num_rec_per_page;

                    // Prepared statement for fetching students
                    $stmt = $conn->prepare("SELECT * FROM basicdetails WHERE Approve = ? AND Branch = ? LIMIT ?, ?");
                    $approve = 1;
                    $branch = 'CVE';
                    $stmt->bind_param("isii", $approve, $branch, $start_from, $num_rec_per_page);
                    $stmt->execute();
                    $result = $stmt->get_result();

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

                    $stmt->close();
                    ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    <div class="pagination-wrap">
        <ul class="pagination">
            <?php
            $sql_total = "SELECT COUNT(*) FROM basicdetails WHERE Approve = 1 AND Branch = 'CVE'";
            $total_records = $conn->query($sql_total)->fetch_row()[0];
            $total_pages = ceil($total_records / $num_rec_per_page);

            if ($page > 1) {
                echo "<li><a href='cve.php?page=" . ($page - 1) . "'><</a></li>";
            }

            for ($i = max(1, $page - 2); $i <= min($total_pages, $page + 2); $i++) {
                if ($i == $page) {
                    echo "<li class='active'><a href='#'>" . $i . "</a></li>";
                } else {
                    echo "<li><a href='cve.php?page=" . $i . "'>" . $i . "</a></li>";
                }
            }

            if ($page < $total_pages) {
                echo "<li><a href='cve.php?page=" . ($page + 1) . "'>></a></li>";
            }

            echo "<li><a>Total Pages: " . $total_pages . "</a></li>";
            ?>
        </ul>
    </div>

</div>
</body>
</html>

<?php
$conn->close();
?>
