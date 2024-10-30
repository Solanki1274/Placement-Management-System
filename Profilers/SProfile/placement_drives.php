<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("location: index.php");
    exit();
}

// Database connection
$servername = "localhost";
$username = "harsh";
$password = "harsh2005";
$dbname = "placement"; // Database name

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set the number of records per page
$num_rec_per_page = 6; // You can change this number
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$start_from = ($page - 1) * $num_rec_per_page;

// Fetch placement drives with pagination, sorted by date (latest first)
$sql = "SELECT * FROM addpdrive ORDER BY Date DESC LIMIT $start_from, $num_rec_per_page";
$result = $conn->query($sql);

// Fetch total records for pagination
$stmt = $conn->prepare("SELECT COUNT(*) FROM addpdrive");
$stmt->execute();
$total_records = $stmt->get_result()->fetch_row()[0];
$total_pages = ceil($total_records / $num_rec_per_page);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        .drive-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            padding: 20px;
        }

        .drive-card {
            background-color: #f5f5f5;
            border: 1px solid #ddd;
            padding: 15px;
            width: 100%;
            max-width: 300px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .drive-card h3 {
            margin-top: 0;
            color: #333;
        }

        .drive-card p {
            margin: 5px 0;
            color: #555;
        }

        .apply-btn {
            position: absolute;
            bottom: 10px;
            right: 10px;
            padding: 5px 10px;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
        }
    </style>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Profile Home</title>
    <meta name="description" content="">
    <meta name="author" content="templatemo">
    <!--favicon-->
    <link rel="shortcut icon" href="favicon.ico" type="image/icon">
    <link rel="icon" href="favicon.ico" type="image/icon">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,700' rel='stylesheet'
        type='text/css'>
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/templatemo-style.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <!-- Left column -->
    <div class="templatemo-flex-row">
        <div class="templatemo-sidebar">
            <header class="templatemo-site-header">
                <div class="square"></div>
                <?php
                $Welcome = "Welcome";
                echo "<h1>" . $Welcome . "<br>" . $_SESSION['username'] . "</h1>";
                ?>
            </header>
            <div class="profile-photo-container">
                <img src="images/profile-photo.jpg" alt="Profile Photo" class="img-responsive">
                <div class="profile-photo-overlay"></div>
            </div>
            <!-- Search box -->
            <form class="templatemo-search-form" role="search">
                <div class="input-group">
                    <button type="submit" class="fa fa-search"></button>
                    <input type="text" class="form-control" placeholder="Search" name="srch-term" id="srch-term">
                </div>
            </form>
            <div class="mobile-menu-icon">
                <i class="fa fa-bars"></i>
            </div>
            <nav class="templatemo-left-nav">
                <ul>
                    <li>
                        <a href="login.php" ><i class="fa fa-home fa-fw"></i>Dashboard</a>
                    </li>
                    <li>
                        <a href="placement_drives.php" class="active"><i class="fa fa-bar-chart fa-fw"></i>Placement Drives</a>
                    </li>
                    <li>
                        <a href="preferences.php"><i class="fa fa-sliders fa-fw"></i>Preferences</a>
                    </li>
                    <li>
                        <a href="logout.php"><i class="fa fa-eject fa-fw"></i>Sign Out</a>
                    </li>
                </ul>
            </nav>
        </div>
        <!-- Main content -->
        <div class="templatemo-content col-1 light-gray-bg">
            <div class="templatemo-top-nav-container">
                <div class="row">
                    <nav class="templatemo-top-nav col-lg-12 col-md-12">
                        <ul class="text-uppercase">
                            <li>
                                <a href="../../Homepage/index.php">Home CIT-PMS</a>
                            </li>
                            <li>
                                <a href="../../Drives/index.php">Drives Homepage</a>
                            </li>
                            <li>
                                <a href="Notif.php">Notifications</a>
                            </li>
                            <li>
                                <a href="Change Password.php">Change Password</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="templatemo-content-container">
                <div class="templatemo-content-widget white-bg">
                    <header>
                        <h2 class="text-uppercase">Available Placement Drives</h2>
                    </header>
                    <div class="drive-container">
                        <?php
                       if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<div class="drive-card">';
                            echo '<h3>' . htmlspecialchars($row['CompanyName']) . '</h3>';
                    
                            // Convert the date to dd-mm-yyyy format
                            $date = new DateTime($row['Date']);
                            echo '<p><strong>Date:</strong> ' . htmlspecialchars($date->format('d-m-Y')) . '</p>';
                    
                            echo '<p><strong>Type:</strong> ' . ($row['C/P'] ? "Campus" : "Pool") . '</p>';
                            echo '<p><strong>Venue:</strong> ' . htmlspecialchars($row['PVenue']) . '</p>';
                            echo '<p><strong>SSLC % Requirement:</strong> ' . htmlspecialchars($row['SSLC']) . '</p>';
                            echo '<p><strong>PU/Dip % Requirement:</strong> ' . htmlspecialchars($row['PU/Dip']) . '</p>';
                            echo '<p><strong>BE % Requirement:</strong> ' . htmlspecialchars($row['BE']) . '</p>';
                            echo '<p><strong>Backlogs Allowed:</strong> ' . htmlspecialchars($row['Backlogs']) . '</p>';
                            echo '<p><strong>History of Backlogs:</strong> ' . ($row['HofBacklogs'] ? "Yes" : "No") . '</p>';
                            echo '<p><strong>Detain Years Allowed:</strong> ' . htmlspecialchars($row['DetainYears']) . '</p>';
                            
                            if (!empty($row['ODetails'])) {
                                echo '<p><strong>Other Details:</strong> ' . htmlspecialchars($row['ODetails']) . '</p>';
                            }
                            
                            echo '<a href="apply.php?company=' . urlencode($row['CompanyName']) . '&date=' . urlencode($row['Date']) . '" class="apply-btn">Apply</a>';
                            echo '</div>';
                        }
                    } else {
                        echo "<p>No drives available at the moment.</p>";
                    }
                    
                        ?>
                    </div>
                </div>
            </div>
            <div class="pagination-wrap">
                <ul class="pagination">
                    <!-- Previous page link -->
                    <?php if ($page > 1): ?>
                        <li><a href='placement_drives.php?page=<?php echo $page - 1; ?>'>&lt;</a></li>
                    <?php endif; ?>

                    <!-- Page number links -->
                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                        <li>
                            <a href='placement_drives.php?page=<?php echo $i; ?>' <?php if ($i == $page)
                                   echo "class='active'"; ?>><?php echo $i; ?></a>
                        </li>
                    <?php endfor; ?>

                    <!-- Next page link -->
                    <?php if ($page < $total_pages): ?>
                        <li><a href='placement_drives.php?page=<?php echo $page + 1; ?>'>&gt;</a></li>
                    <?php endif; ?>

                    <li><a>Total Pages: <?php echo $total_pages; ?></a></li>
                </ul>
            </div>
            <footer class="text-right">
                <footer class="text-right">
                    <p>Copyright &copy; 2024 Hmc-PMS | Developed by
                        <a href="#" target="_parent">Hmc FutureTechnologies</a>
                    </p>
                </footer>
        </div>
    </div>
    </div>
    <!-- JS -->
    <script src="js/jquery-1.11.2.min.js"></script>
    <!-- jQuery -->
    <script src="js/jquery-migrate-1.2.1.min.js"></script>
    <!-- jQuery Migrate Plugin -->
    <script type="text/javascript" src="js/templatemo-script.js"></script>
    <!-- Templatemo Script -->
</body>

</html>

<?php
$conn->close();
?>