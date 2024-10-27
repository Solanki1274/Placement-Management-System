<?php
session_start();
if (!isset($_SESSION['pusername'])) {
    header("location: index.php");
    exit();
}

// Database connection
$connect = mysqli_connect("localhost", "harsh", "harsh2005", "placement");
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

// Insert Placement Drive
if (isset($_POST['submit'])) { 
    $cname = $_POST['compny'];
    $date = $_POST['date'];
    $campool = $_POST['campool'];
    $poolven = $_POST['pcv'];
    $per = $_POST['sslc'];
    $puagg = $_POST['puagg'];
    $beaggregate = $_POST['beagg'];
    $back = $_POST['curback'];
    $hisofbk = $_POST['hob'];
    $breakstud = $_POST['break'];
    $otherdet = $_POST['odetails'];

    if (!empty($cname) && !empty($date)) {
        $stmt = $connect->prepare("INSERT INTO addpdrive (CompanyName, Date, C/P, PVenue, SSLC, PU/Dip, BE, Backlogs, HofBacklogs, DetainYears, ODetails) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssssss", $cname, $date, $campool, $poolven, $per, $puagg, $beaggregate, $back, $hisofbk, $breakstud, $otherdet);

        if ($stmt->execute()) {
            echo "<center>Drive Inserted successfully</center>";
        } else {
            die("Error: " . $stmt->error);
        }
        $stmt->close();
    } else {
        die("Fields cannot be left blank");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="../favicon.ico" type="image/icon">
    <link rel="icon" href="../favicon.ico" type="image/icon">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    <title>Company Details</title>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,700' rel='stylesheet' type='text/css'>
    <link href="../css/font-awesome.min.css" rel="stylesheet">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/templatemo-style.css" rel="stylesheet">
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>  
    <div class="templatemo-flex-row">
        <div class="templatemo-sidebar">
            <header class="templatemo-site-header">
                <div class="square"></div>
                <?php
                $Welcome = "Welcome";
                echo "<h1>" . $Welcome . "<br>" . $_SESSION['pusername'] . "</h1><br>";
                ?>
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
            <div class="mobile-menu-icon">
                <i class="fa fa-bars"></i>
            </div>
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
                            <li><a href="../../Homepage/index.php">Home CIT-PMS</a></li>
                            <li><a href="">Drives Home</a></li>
                            <li><a href="Notif.php">Notifications</a></li>
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
                                    <td><a class="white-text templatemo-sort-by">Company Name </a></td>
                                    <td><a class="white-text templatemo-sort-by">Date </a></td>
                                    <td><a class="white-text templatemo-sort-by">C/P</a></td>
                                    <td><a class="white-text templatemo-sort-by">PVenue</a></td>
                                    <td><a class="white-text templatemo-sort-by">SSLC</a></td>
                                    <td><a class="white-text templatemo-sort-by">PU/Dip</a></td>
                                    <td><a class="white-text templatemo-sort-by">BE</a></td>               
                                    <td><a class="white-text templatemo-sort-by">Backlogs</a></td>
                                    <td><a class="white-text templatemo-sort-by">History of Backlogs</a></td>
                                    <td><a class="white-text templatemo-sort-by">Detain years</a></td>
                                    <td><a class="white-text templatemo-sort-by">Others details</a></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $num_rec_per_page = 15;

                                // Get the current page number from the URL, default to 1
                                $currentpage = (isset($_GET['page']) ? $_GET['page'] : 1);
                                $start_from = ($currentpage - 1) * $num_rec_per_page; // Calculate the starting record for the LIMIT clause

                                // Fetch records with pagination
                                $sql = "SELECT * FROM addpdrive ORDER BY Date DESC LIMIT $start_from, $num_rec_per_page"; 
                                $rs_result = mysqli_query($connect, $sql);

                                while ($row = mysqli_fetch_assoc($rs_result)) {
                                    echo "<tr>"; 
                                    echo "<td>" . $row['CompanyName'] . "</td>"; 
                                    echo "<td>" . $row['Date'] . "</td>"; 
                                    echo "<td>" . $row['C/P'] . "</td>"; 
                                    echo "<td>" . $row['PVenue'] . "</td>"; 
                                    echo "<td>" . $row['SSLC'] . "</td>"; 
                                    echo "<td>" . $row['PU/Dip'] . "</td>"; 
                                    echo "<td>" . $row['BE'] . "</td>";
                                    echo "<td>" . $row['Backlogs'] . "</td>";
                                    echo "<td>" . $row['HofBacklogs'] . "</td>";
                                    echo "<td>" . $row['DetainYears'] . "</td>";
                                    echo "<td>" . $row['ODetails'] . "</td>";
                                    echo "</tr>"; 
                                }
                                ?> 
                            </tbody>
                        </table>  
                    </div>
                </div>
            </div>

            <div class="pagination">
                <?php
                // Count total number of records
                $result = mysqli_query($connect, "SELECT COUNT(*) FROM addpdrive");
                $row = mysqli_fetch_row($result);
                $total_records = $row[0];

                // Calculate total pages
                $total_pages = ceil($total_records / $num_rec_per_page);

                // Display pagination links
                for ($i = 1; $i <= $total_pages; $i++) {
                    echo "<a href='CompanyDetails.php?page=" . $i . "'>" . $i . "</a> ";
                }
                ?>
            </div>

            <!-- <div class="templatemo-content-widget no-padding">
                <h2>Add Placement Drive</h2>
                <form action="" method="POST">
                    <input type="text" name="compny" placeholder="Company Name" required>
                    <input type="date" name="date" placeholder="Date" required>
                    <input type="text" name="campool" placeholder="C/P" required>
                    <input type="text" name="pcv" placeholder="PVenue" required>
                    <input type="text" name="sslc" placeholder="SSLC" required>
                    <input type="text" name="puagg" placeholder="PU/Dip" required>
                    <input type="text" name="beagg" placeholder="BE" required>
                    <input type="text" name="curback" placeholder="Backlogs" required>
                    <input type="text" name="hob" placeholder="History of Backlogs" required>
                    <input type="text" name="break" placeholder="Detain Years" required>
                    <input type="text" name="odetails" placeholder="Others Details" required>
                    <input type="submit" name="submit" value="Add Drive">
                </form>
            </div> -->

        </div> 
    </div>

    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/templatemo-script.js"></script>
</body>
</html>
