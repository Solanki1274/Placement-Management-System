<?php
session_start();
if (!isset($_SESSION['husername'])) {
    header("Location: index.php");
    exit;
}

$p = $_SESSION['department'];
$num_rec_per_page = 15;

try {
    // Database connection
    $conn = new PDO("mysql:host=localhost;dbname=placement", "harsh", "harsh2005");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get the current page number
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $start_from = ($page - 1) * $num_rec_per_page;

    // Prepare and execute the SQL statement
    $stmt = $conn->prepare("SELECT * FROM basicdetails WHERE Branch = :branch LIMIT :start, :limit");
    $stmt->bindParam(':branch', $p, PDO::PARAM_STR);
    $stmt->bindParam(':start', $start_from, PDO::PARAM_INT);
    $stmt->bindParam(':limit', $num_rec_per_page, PDO::PARAM_INT);
    $stmt->execute();
    $students = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="favicon.ico" type="image/icon">
    <link rel="icon" href="favicon.ico" type="image/icon">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage Students</title>
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
            <h1>Welcome<br><?php echo htmlspecialchars($_SESSION['husername']); ?></h1>
            <h1>(<?php echo htmlspecialchars($_SESSION['department']); ?>)</h1>
        </header>
        <div class="profile-photo-container">
            <img src="images/profile-photo.jpg" alt="Profile Photo" class="img-responsive">
            <div class="profile-photo-overlay"></div>
        </div>
        <form class="templatemo-search-form" role="search">
            <div class="input-group">
                <button type="submit" class="fa fa-search"></button>
                <input type="text" class="form-control" placeholder="Search" name="srch-term" id="srch-term">
            </div>
        </form>
        <nav class="templatemo-left-nav">
            <ul>
                <li><a href="login.php"><i class="fa fa-home fa-fw"></i>Dashboard</a></li>
                <li><a href="#" class="active"><i class="fa fa-users fa-fw"></i>Manage Students</a></li>
                <li><a href="preferences.php"><i class="fa fa-sliders fa-fw"></i>Preferences</a></li>
                <li><a href="approve2.php"><i class="fa fa-sliders fa-fw"></i>Approve Students</a></li>
                <li><a href="logout.php"><i class="fa fa-eject fa-fw"></i>Sign Out</a></li>
            </ul>
        </nav>
    </div>
    <div class="templatemo-content col-1 light-gray-bg">
        <div class="templatemo-top-nav-container">
            <nav class="templatemo-top-nav">
                <ul>
                    <li><a href="../../Homepage/index.php">Home CIT-PMS</a></li>
                    <li><a href="../../Drives/index.php">Drives</a></li>
                    <li><a href="Notif.php">Notification</a></li>
                    <li><a href="Change Password.php">Change Password</a></li>
                </ul>
            </nav>
        </div>
        <div class="templatemo-content-container">
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
                                <td>Current Sem</td>
                                <td>Branch</td>
                                <td>SSLC Percentage</td>
                                <td>PU Percentage</td>
                                <td>BE Aggregate</td>
                                <td>Current Backlogs</td>
                                <td>History of Backlogs</td>
                                <td>Detain Years</td>
                                <td>Approve?</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($students as $student): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($student['FirstName']); ?></td>
                                    <td><?php echo htmlspecialchars($student['LastName']); ?></td>
                                    <td><?php echo htmlspecialchars($student['USN']); ?></td>
                                    <td><?php echo htmlspecialchars($student['Mobile']); ?></td>
                                    <td><?php echo htmlspecialchars($student['Email']); ?></td>
                                    <td><?php echo htmlspecialchars($student['DOB']); ?></td>
                                    <td><?php echo htmlspecialchars($student['Sem']); ?></td>
                                    <td><?php echo htmlspecialchars($student['Branch']); ?></td>
                                    <td><?php echo htmlspecialchars($student['SSLC']); ?></td>
                                    <td><?php echo htmlspecialchars($student['PU/Dip']); ?></td>
                                    <td><?php echo htmlspecialchars($student['BE']); ?></td>
                                    <td><?php echo htmlspecialchars($student['Backlogs']); ?></td>
                                    <td><?php echo htmlspecialchars($student['HofBacklogs']); ?></td>
                                    <td><?php echo htmlspecialchars($student['DetainYears']); ?></td>
                                    <td><?php echo htmlspecialchars($student['Approve']); ?></td>
                                    
                                    
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="pagination-wrap">
            <ul class="pagination">
                <?php
                // Get total records for pagination
                $stmt = $conn->prepare("SELECT COUNT(*) FROM basicdetails WHERE Branch = :branch");
                $stmt->bindParam(':branch', $p, PDO::PARAM_STR);
                $stmt->execute();
                $total_records = $stmt->fetchColumn();
                $total_pages = ceil($total_records / $num_rec_per_page);

                // Previous page link
                if ($page > 1) {
                    $prev = $page - 1;
                    echo "<li><a href='manage-users1.php?page=$prev'>&lt;</a></li>";
                }

                // Page number links
                for ($i = 1; $i <= $total_pages; $i++) {
                    echo "<li><a href='manage-users1.php?page=$i'>$i</a></li>";
                }

                // Next page link
                if ($page < $total_pages) {
                    $next = $page + 1;
                    echo "<li><a href='manage-users1.php?page=$next'>&gt;</a></li>";
                }
                ?>
                <li><a>Total Pages: <?php echo $total_pages; ?></a></li>
            </ul>
        </div>
        <footer class="text-right">
            <p>&copy; 2024 Hmc-PMS | Developed by <a href="#" target="_parent">Hmc FutureTechnologies</a></p>
        </footer>
    </div>
</div>
<script src="js/jquery-1.11.2.min.js"></script>
<script src="js/templatemo-script.js"></script>
</body>
</html>
