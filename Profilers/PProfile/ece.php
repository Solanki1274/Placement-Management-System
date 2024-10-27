<?php
session_start();
if (isset($_SESSION['pusername'])) {
    echo "Welcome, " . $_SESSION['pusername'] . "!";
} else {
    header("location: index.php");
    die("You must be logged in to view this page <a href='index.php'>Click here</a>");
}

// Database connection
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'placement';

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Pagination setup
$num_rec_per_page = 2;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start_from = ($page - 1) * $num_rec_per_page;

// Fetch approved ECE students
$sql = "SELECT * FROM basicdetails WHERE Approve = '1' AND Branch = 'ECE' LIMIT $start_from, $num_rec_per_page";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!--favicon-->
    <link rel="shortcut icon" href="favicon.ico" type="image/icon">
    <link rel="icon" href="favicon.ico" type="image/icon">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage Students</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,700" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/templatemo-style.css" rel="stylesheet">
</head>

<body>
<div class="bg">
    <div class="templatemo-content-container">
        <center><h2>Approved Students List of ECE</h2></center>
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
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                <td>{$row['FirstName']}</td>
                                <td>{$row['LastName']}</td>
                                <td>{$row['USN']}</td>
                                <td>{$row['Mobile']}</td>
                                <td>{$row['Email']}</td>
                                <td>{$row['DOB']}</td>
                                <td>{$row['Sem']}</td>
                                <td>{$row['Branch']}</td>
                                <td>{$row['SSLC']}</td>
                                <td>{$row['PU/Dip']}</td>
                                <td>{$row['BE']}</td>
                                <td>{$row['Backlogs']}</td>
                                <td>{$row['HofBacklogs']}</td>
                                <td>{$row['DetainYears']}</td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='14' class='text-center'>No records found</td></tr>";
                    }
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
            // Count total records for pagination
            $sql_total = "SELECT COUNT(*) AS total FROM basicdetails WHERE Approve = '1' AND Branch = 'ECE'";
            $total_result = $conn->query($sql_total);
            $total_row = $total_result->fetch_assoc();
            $total_records = $total_row['total'];
            $total_pages = ceil($total_records / $num_rec_per_page);

            if ($total_pages > 1) {
                for ($i = 1; $i <= $total_pages; $i++) {
                    $active = ($page == $i) ? 'class="active"' : '';
                    echo "<li $active><a href='ece.php?page=$i'>$i</a></li>";
                }
            }
            ?>
        </ul>
    </div>

</div>
</body>
</html>

<?php
$conn->close();
?>
