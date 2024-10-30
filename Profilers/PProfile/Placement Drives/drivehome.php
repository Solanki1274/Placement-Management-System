<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['pusername'])) {
    header("location: index.php");
    exit();
}

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

$num_rec_per_page = 15;
$page = isset($_GET["page"]) ? (int)$_GET["page"] : 1; // Page number
$start_from = ($page - 1) * $num_rec_per_page;

// SQL query to fetch data
$sql = "SELECT a.*, u.*
        FROM addpdrive a
        JOIN updatedrive u ON a.CompanyName = u.CompanyName AND a.Date = u.Date
        LIMIT ?, ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $start_from, $num_rec_per_page);
$stmt->execute();
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="../favicon.ico" type="image/icon">
    <link rel="icon" href="../favicon.ico" type="image/icon">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Drive Details</title>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,700' rel='stylesheet' type='text/css'>
    <link href="../css/font-awesome.min.css" rel="stylesheet">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/templatemo-style.css" rel="stylesheet">
</head>
<body>
    <div class="templatemo-flex-row">
        <div class="templatemo-sidebar">
            <header class="templatemo-site-header">
                <div class="square"></div>
                <h1>Welcome<br><?php echo htmlspecialchars($_SESSION['pusername']); ?></h1>
            </header>
            <div class="profile-photo-container">
                <img src="../images/profile-photo.jpg" alt="Profile Photo" class="img-responsive">  
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
                    <li><a href="../login.php"><i class="fa fa-home fa-fw"></i>Dashboard</a></li> 
                    <li><a href="../Placement Drives.php" class="active"><i class="fa fa-home fa-fw"></i>Placement Drives</a></li>           
                    <li><a href="../manage-users.php"><i class="fa fa-users fa-fw"></i>View Students</a></li>
                    <li><a href="../queries.php"><i class="fa fa-users fa-fw"></i>Queries</a></li>
                    <li><a href="../Students Eligibility.php"><i class="fa fa-sliders fa-fw"></i>Students Eligibility Status</a></li>
                    <li><a href="../logout.php"><i class="fa fa-eject fa-fw"></i>Sign Out</a></li>
                </ul>  
            </nav>
        </div>
        
        <div class="templatemo-content col-1 light-gray-bg">
            <div class="templatemo-top-nav-container">
                <div class="row">
                    <nav class="templatemo-top-nav col-lg-12 col-md-12">
                        <ul class="text-uppercase">
                            <li><a href="../../../Homepage/index.php">Home CIT-PMS</a></li>
                            <li><a href="../../../Drives/index.php">Drives Home</a></li>
                            <li><a href="../Notif.php">Notifications</a></li>
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
                                    <td>Company Name</td>
                                    <td>Date</td>
                                    <td>C/P</td>
                                    <td>PVenue</td>
                                    <td>SSLC</td>
                                    <td>PU/Dip</td>
                                    <td>BE</td>
                                    <td>Backlogs</td>
                                    <td>History of Backlogs</td>
                                    <td>Detain years</td>
                                    <td>USN</td>
                                    <td>Name</td>
                                    <td>Placed</td>
                                </tr>
                            </thead>
                            <tbody>
                            <?php while ($row = $result->fetch_assoc()) { ?>
                                <tr> 
                                    <td><?php echo htmlspecialchars($row['CompanyName']); ?></td>
                                    <td><?php echo htmlspecialchars($row['Date']); ?></td> 
                                    <td><?php echo htmlspecialchars($row['C/P']); ?></td>
                                    <td><?php echo htmlspecialchars($row['PVenue']); ?></td>
                                    <td><?php echo htmlspecialchars($row['SSLC']); ?></td> 
                                    <td><?php echo htmlspecialchars($row['PU/Dip']); ?></td>
                                    <td><?php echo htmlspecialchars($row['BE']); ?></td>
                                    <td><?php echo htmlspecialchars($row['Backlogs']); ?></td>
                                    <td><?php echo htmlspecialchars($row['HofBacklogs']); ?></td>
                                    <td><?php echo htmlspecialchars($row['DetainYears']); ?></td>
                                    <td><?php echo htmlspecialchars($row['USN']); ?></td> 
                                    <td><?php echo htmlspecialchars($row['Name']); ?></td> 
                                    <td><?php echo htmlspecialchars($row['Placed']); ?></td>
                                </tr> 
                            <?php } ?>
                            </tbody>
                        </table>  
                    </div>
                </div>
            </div>

            <!-- Pagination -->
            <div class="pagination-wrap">
                <ul class="pagination">
                <?php
                // Get total records for pagination
                $sql_total = "SELECT COUNT(*) FROM addpdrive a JOIN updatedrive u ON a.CompanyName = u.CompanyName";
                $result_total = $conn->query($sql_total);
                $total_records = $result_total->fetch_row()[0];
                $total_pages = ceil($total_records / $num_rec_per_page); 

                if ($page > 1) {
                    $prev_page = $page - 1;
                    echo "<li><a href='drivehome.php?page=$prev_page'><</a></li>";
                }

                for ($i = 1; $i <= $total_pages; $i++) {
                    echo "<li><a href='drivehome.php?page=$i'>$i</a></li>";
                }

                if ($page < $total_pages) {
                    $next_page = $page + 1;
                    echo "<li><a href='drivehome.php?page=$next_page'>></a></li>";
                }

                echo "<li><a>Total Pages: $total_pages</a></li>";
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
    
    <script src="js/jquery-1.11.2.min.js"></script>
    <script src="js/templatemo-script.js"></script>
</body>
</html>

<?php
$conn->close(); // Close the database connection
?>
