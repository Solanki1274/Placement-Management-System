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

            <div class="pagination-wrap">
                <ul class="pagination">
                    <?php 
                    $sql = "SELECT * FROM addpdrive ORDER BY Date DESC"; 
                    $rs_result = mysqli_query($connect, $sql);
                    $total_records = mysqli_num_rows($rs_result);  
                    $totalpage = ceil($total_records / $num_rec_per_page); 

                    $currentpage = (isset($_GET['page']) ? $_GET['page'] : 1);
                    if ($currentpage > 1) {
                        echo '<li><a href="manage-drives.php?page=' . ($currentpage - 1) . '">&laquo;</a></li>';
                    }

                    for ($i = 1; $i <= $totalpage; $i++) {
                        echo '<li><a href="manage-drives.php?page=' . $i . '">' . $i . '</a></li>';
                    }

                    if ($currentpage < $totalpage) {
                        echo '<li><a href="manage-drives.php?page=' . ($currentpage + 1) . '">&raquo;</a></li>';
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>

    <div class="templatemo-content-container">
        <h1>Add Placement Drive</h1>
        <form action="" method="post" class="templatemo-form">
            <div class="form-group">
                <label for="compny">Company Name</label>
                <input type="text" name="compny" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="date">Date</label>
                <input type="date" name="date" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="campool">C/P</label>
                <input type="text" name="campool" class="form-control">
            </div>
            <div class="form-group">
                <label for="pcv">PVenue</label>
                <input type="text" name="pcv" class="form-control">
            </div>
            <div class="form-group">
                <label for="sslc">SSLC</label>
                <input type="text" name="sslc" class="form-control">
            </div>
            <div class="form-group">
                <label for="puagg">PU/Dip</label>
                <input type="text" name="puagg" class="form-control">
            </div>
            <div class="form-group">
                <label for="beagg">BE</label>
                <input type="text" name="beagg" class="form-control">
            </div>
            <div class="form-group">
                <label for="curback">Backlogs</label>
                <input type="text" name="curback" class="form-control">
            </div>
            <div class="form-group">
                <label for="hob">History of Backlogs</label>
                <input type="text" name="hob" class="form-control">
            </div>
            <div class="form-group">
                <label for="break">Detain Years</label>
                <input type="text" name="break" class="form-control">
            </div>
            <div class="form-group">
                <label for="odetails">Others Details</label>
                <input type="text" name="odetails" class="form-control">
            </div>
            <input type="submit" name="submit" class="btn btn-primary" value="Add Drive">
        </form>
    </div>
    
    <script src="../js/jquery-1.11.3.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/templatemo-script.js"></script>
</body>
</html>
