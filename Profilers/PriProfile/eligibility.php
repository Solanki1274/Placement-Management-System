<?php
session_start();
if (!isset($_SESSION["priusername"])) {
    header("location: index.php");
    exit();
}

// Database connection
$mysqli = new mysqli('localhost', 'harsh', 'harsh2005', 'placement');

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Pagination variables
$num_rec_per_page = 15;
$page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
$start_from = ($page - 1) * $num_rec_per_page;

// Fetch all approved students
$sql = "SELECT * FROM basicdetails WHERE Approve='1' LIMIT ?, ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("ii", $start_from, $num_rec_per_page);
$stmt->execute();
$result = $stmt->get_result();

// Search functionality
$searchResult = $result; // Default to all results if no search

if (isset($_POST['submit'])) {
    // Only access $_POST variables if they are set
    $branch = isset($_POST['Branch']) ? $_POST['Branch'] : '';
    $sslc = isset($_POST['sslc']) ? $_POST['sslc'] : 0;
    $puaggregate = isset($_POST['puagg']) ? $_POST['puagg'] : 0;  // Default to 0 if not set
    $beaggregate = isset($_POST['beagg']) ? $_POST['beagg'] : 0;
    $backlogs = isset($_POST['curback']) ? $_POST['curback'] : 0;
    $hisofbk = isset($_POST['hob']) ? $_POST['hob'] : 0;
    $dety = isset($_POST['dy']) ? $_POST['dy'] : 0;

    // Prepare search SQL
    $searchSql = "SELECT * FROM basicdetails WHERE Approve=1 AND Branch=? AND SSLC>=? AND `PU/Dip`>=? AND BE>=? AND Backlogs=? AND HofBacklogs=? AND DetainYears=?";
    $searchStmt = $mysqli->prepare($searchSql);
    $searchStmt->bind_param("siiiiii", $branch, $sslc, $puaggregate, $beaggregate, $backlogs, $hisofbk, $dety);
    $searchStmt->execute();
    $searchResult = $searchStmt->get_result();
} 

// HTML Structure
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="favicon.ico" type="image/icon">
    <link rel="icon" href="favicon.ico" type="image/icon">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    <title>Company Details</title>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,700' rel='stylesheet' type='text/css'>
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/templatemo-style.css" rel="stylesheet">
</head>
<body>
<div class="templatemo-flex-row">
    <div class="templatemo-sidebar">
        <header class="templatemo-site-header">
            <div class="square"></div>
            <?php
            echo "<h1>Welcome<br>" . htmlspecialchars($_SESSION['priusername']) . "</h1><br>";
            ?>
        </header>
        <div class="profile-photo-container">
            <img src="images/profile-photo.jpg" alt="Profile Photo" class="img-responsive">  
        </div>      
        <nav class="templatemo-left-nav">          
            <ul>
                <li><a href="index.php"><i class="fa fa-home fa-fw"></i>Dashboard</a></li>
                <li><a href="Students Eligibility.php" class="active"><i class="fa fa-bar-chart fa-fw"></i> Eligibility Criteria</a></li>
                <li><a href="queries.php"><i class="fa fa-database fa-fw"></i>Queries</a></li>
                <li><a href="manage-users.php"><i class="fa fa-users fa-fw"></i>Student Details</a></li>
                <li><a href="logout.php"><i class="fa fa-eject fa-fw"></i>Sign Out</a></li>
            </ul>  
        </nav>
    </div>

    <div class="templatemo-content col-1 light-gray-bg">
        <div class="templatemo-top-nav-container">
            <div class="row">
                <nav class="templatemo-top-nav col-lg-12 col-md-12">
                    <ul class="text-uppercase">
                        <li><a href="../../Homepage/index.php">Home CIT-PMS</a></li>
                        <li><a href="../../Drives/index.php">Drives Homepage</a></li>
                        <li><a href="Notif.php">Notification</a></li>
                        <li><a href="Change Password.php">Change Password</a></li>
                    </ul>   
                </nav> 
            </div>
        </div>
        <div class="templatemo-content-container">
            <div class="templatemo-content-widget no-padding">
                <div class="panel panel-default table-responsive">
                    <table class="table table-striped table-bordered templatemo-user-table">
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
                        while ($row = $searchResult->fetch_assoc()) {
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
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="pagination-wrap">
            <ul class="pagination">
                <?php 
                // Count total records for pagination
                $sqlCount = "SELECT COUNT(*) FROM basicdetails WHERE Approve='1'";
                $total_records = $mysqli->query($sqlCount)->fetch_row()[0];
                $totalpage = ceil($total_records / $num_rec_per_page);

                if ($page > 1) {
                    echo "<li><a href='eligibility.php?page=" . ($page - 1) . "'><</a></li>";
                }
                for ($i = 1; $i <= $totalpage; $i++) {
                    echo "<li><a href='eligibility.php?page=$i'>$i</a></li>";
                }
                if ($page < $totalpage) {
                    echo "<li><a href='eligibility.php?page=" . ($page + 1) . "'>></a></li>";
                }
                echo "<li><a>Total Pages: $totalpage</a></li>";
                ?>
            </ul>
        </div>

        <footer class="text-right">
            <p>Copyright &copy; 2024 Hmc-PMS | Developed by
                <a href="#" target="_parent">Hmc FutureTechnologies</a>
            </p>
        </footer>
    </div>
</div>
</body>
</html>
