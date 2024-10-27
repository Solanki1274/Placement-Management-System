<?php
session_start();
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

function getCompanyCount($conn) {
    $query = "SELECT COUNT(DISTINCT CompanyName) AS count FROM addpdrive WHERE PVenue LIKE '%CIT%' AND YEAR(Date) = YEAR(NOW())";
    $result = $conn->query($query);
    return $result->fetch_assoc()['count'];
}

function getAttendanceCount($conn) {
    $query = "SELECT COUNT(Attendence) AS count FROM updatedrive WHERE Attendence = 1 AND YEAR(Date) = YEAR(NOW())";
    $result = $conn->query($query);
    return $result->fetch_assoc()['count'];
}

function getPlacementCount($conn) {
    $query = "SELECT COUNT(Placed) AS count FROM updatedrive WHERE Placed = 1 AND YEAR(Date) = YEAR(NOW())";
    $result = $conn->query($query);
    return $result->fetch_assoc()['count'];
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
    <title>Queries</title>
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
            <h1>Welcome<br><?php echo htmlspecialchars($_SESSION['pusername']); ?></h1>
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
                <li><a href="Placement Drives.php"><i class="fa fa-home fa-fw"></i>Placement Drives</a></li>
                <li><a href="manage-users.php"><i class="fa fa-users fa-fw"></i>View Students</a></li>
                <li><a href="#" class="active"><i class="fa fa-users fa-fw"></i>Queries</a></li>
                <li><a href="Students Eligibility.php"><i class="fa fa-sliders fa-fw"></i>Students Eligibility Status</a></li>
                <li><a href="logout.php"><i class="fa fa-eject fa-fw"></i>Sign Out</a></li>
            </ul>
        </nav>
    </div>

    <div class="templatemo-content col-1 light-gray-bg">
        <div class="templatemo-top-nav-container">
            <nav class="templatemo-top-nav">
                <ul class="text-uppercase">
                    <li><a href="../../Homepage/index.php">Home CIT-PMS</a></li>
                    <li><a href="../../Drives/index.php">Drives Home</a></li>
                    <li><a href="Notif.php">Notification</a></li>
                    <li><a href="Change Password.php">Change Password</a></li>
                </ul>
            </nav>
        </div>
        <div class="templatemo-content-container">
            <div class="templatemo-content-widget no-padding">
                <center>
                    <ul>
                        <li><h3>Student Queries: &nbsp&nbsp&nbsp <a href="studsearch.php" class="templatemo-blue-button">Click Here</a></h3></li>
                        <br><br><br>
                        <li><h3>Company Queries: &nbsp <a href="comsearch.php" class="templatemo-blue-button">Click Here</a></h3></li>
                        <br><br><br>
                        <li><h3>Drive Queries: &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <a href="search.php" class="templatemo-blue-button">Click Here</a></h3></li>
                    </ul>
                </center>
            </div>

            <div class="templatemo-content-container">
                <center>
                    <h3>Companies In Our Campus This Year: &nbsp;<?php echo getCompanyCount($conn); ?></h3>
                    <h3>Number of Students Attended This Year: &nbsp;<?php echo getAttendanceCount($conn); ?></h3>
                    <h3>Number of Students Placed This Year: &nbsp;<?php echo getPlacementCount($conn); ?></h3>
                </center>
            </div>
            
            <footer class="text-right">
                <p>Copyright &copy; 2024 Hmc-PMS | Developed by <a href="#" target="_parent">Hmc FutureTechnologies</a></p>
            </footer>
        </div>
    </div>
</div>

<script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="js/templatemo-script.js"></script>
<script>
    $(document).ready(function() {
        // Content widget with background image
        var imageUrl = $('img.content-bg-img').attr('src');
        $('.templatemo-content-img-bg').css('background-image', 'url(' + imageUrl + ')');
        $('img.content-bg-img').hide();
    });
</script>
</body>
</html>
