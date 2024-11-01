<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION["pusername"])) {
    header("location: ../index.php");
    exit();
}


// view_profile.php

// Database connection
$servername = "localhost";
$username = "harsh";
$password = "harsh2005";
$dbname = "placement";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch the USN from the POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usn = $_POST['usn'];

    // Prepare and execute the SQL query
    $stmt = $conn->prepare("SELECT * FROM basicdetails WHERE USN = ?");
    $stmt->bind_param("s", $usn);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch the profile details
        $profile = $result->fetch_assoc();
    } else {
        echo "No profile found for the given USN.";
        exit();
    }
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<style>
    .application-table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
    }

    .application-table th,
    .application-table td {
        border: 1px solid #ddd;
        padding: 8px;
    }

    .application-table th {
        background-color: #f2f2f2;
    }

    .schedule-btn {
        background-color: #4CAF50;
        /* Green */
        color: white;
        padding: 10px 15px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        border: none;
        cursor: pointer;
    }

    .schedule-btn:hover {
        background-color: #45a049;
    }
</style>

<head>
    <!--favicon-->
    <link rel="shortcut icon" href="../favicon.ico" type="image/icon">
    <link rel="icon" href="../favicon.ico" type="image/icon">

    <link rel="shortcut icon" href="favicon.ico" type="image/icon">
    <link rel="icon" href="favicon.ico" type="image/icon">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Placement Drives</title>
    <meta name="description" content="">
    <meta name="author" content="templatemo">

    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,700' rel='stylesheet'
        type='text/css'>
    <link href="../css/font-awesome.min.css" rel="stylesheet">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/templatemo-style.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <style>
        /* styles.css */




        .profile-card {
            padding: 20px;
        }

        .profile-card h2 {
            text-align: center;
            color: #333;
        }

        .profile-card p {
            font-size: 16px;
            line-height: 1.6;
            margin: 10px 0;
        }

        .close-btn {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            margin-top: 20px;
        }

        .close-btn:hover {
            background-color: #0056b3;
        }

        .container {
            max-width: 800px;
            margin-top: 30px;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .profile-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .profile-header h2 {
            margin: 0;
            color: #333;
        }

        .close-btn {
            padding: 10px 15px;
            background-color: #dc3545;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .close-btn:hover {
            background-color: #c82333;
        }

        .profile-card,
        .academic-card,
        .approval-card {
            margin-top: 20px;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .profile-card h3,
        .academic-card h3,
        .approval-card h3 {
            margin: 0 0 15px;
            color: #007bff;
        }

        .profile-info {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 15px;
        }

        .info-item {
            background: #ffffff;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 1px 5px rgba(0, 0, 0, 0.1);
        }

        .info-item strong {
            display: block;
            color: #495057;
        }

        .info-item p {
            margin: 5px 0 0;
            color: #343a40;
        }
    </style>
</head>

<body>
    <!-- Left column -->
    <div class="templatemo-flex-row">
        <div class="templatemo-sidebar">
            <header class="templatemo-site-header">
                <div class="square"></div>
                <?php
                $Welcome = "Hello!!! How are You?";
                echo "<h1>" . $Welcome . "<br>" . $_SESSION['pusername'] . "</h1>";
                ?>
            </header>
            <div class="profile-photo-container">
                <img src="../images/profile-photo.jpg" alt="Profile Photo" class="img-responsive">
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
                    <li><a href="../login.php"><i class="fa fa-home fa-fw"></i>Dashboard</a></li>
                    <li><a href="../Placement Drives.php" class="active"><i class="fa fa-home fa-fw"></i>Placement
                            Drives</a></li>
                    <li><a href="../manage-users.php"><i class="fa fa-users fa-fw"></i>View Students</a></li>
                    <li><a href="../queries.php"><i class="fa fa-users fa-fw"></i>Queries</a></li>
                    <li><a href="../Students Eligibility.php"><i class="fa fa-sliders fa-fw"></i>Students Eligibility
                            Status</a></li>
                    <li><a href="../logout.php"><i class="fa fa-eject fa-fw"></i>Sign Out</a></li>
                </ul>
            </nav>
        </div>
        <!-- Main content -->
        <div class="templatemo-content col-1 light-gray-bg">
            <div class="templatemo-top-nav-container">
                <div class="row">
                    <nav class="templatemo-top-nav col-lg-12 col-md-12">
                        <ul class="text-uppercase">
                            <li><a href="../../../Homepage/index.php">Home CIT-PMS</a></li>
                            <li><a href="../../../Drives/index.php">Drives Home</a></li>
                            <li><a href="../Notif.php">Notifications</a></li>
                            <li><a href="../Change Password.php">Change Password</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="container">
                <h1>Profile Details</h1>
                <div class="profile-card">
                    <h3>Personal Information</h3>
                    <div class="profile-info">
                        <div class="info-item">
                            <strong>First Name:</strong>
                            <p><?php echo htmlspecialchars($profile['FirstName']); ?></p>
                        </div>
                        <div class="info-item">
                            <strong>Last Name:</strong>
                            <p><?php echo htmlspecialchars($profile['LastName']); ?></p>
                        </div>
                        <div class="info-item">
                            <strong>USN:</strong>
                            <p><?php echo htmlspecialchars($profile['USN']); ?></p>
                        </div>
                        <div class="info-item">
                            <strong>Mobile:</strong>
                            <p><?php echo htmlspecialchars($profile['Mobile']); ?></p>
                        </div>
                        <div class="info-item">
                            <strong>Email:</strong>
                            <p><?php echo htmlspecialchars($profile['Email']); ?></p>
                        </div>
                        <div class="info-item">
                            <strong>Date of Birth:</strong>
                            <p>
                                <?php
                                // Assuming $profile['DOB'] is in `YYYY-MM-DD` format
                                $dob = DateTime::createFromFormat("Y-m-d", $profile['DOB']);
                                echo $dob ? $dob->format("d-m-Y") : "Invalid date";
                                ?>
                            </p>
                        </div>


                    </div>
                    <div class="academic-card">
                        <h3>Academic Details</h3>
                        <div class="profile-info">
                            <div class="info-item">
                                <strong>Semester:</strong>
                                <p><?php echo htmlspecialchars($profile['Sem']); ?></p>
                            </div>
                            <div class="info-item">
                                <strong>Branch:</strong>
                                <p><?php echo htmlspecialchars($profile['Branch']); ?></p>
                            </div>
                            <div class="info-item">
                                <strong>SSLC:</strong>
                                <p><?php echo htmlspecialchars($profile['SSLC']); ?></p>
                            </div>
                            <div class="info-item">
                                <strong>PU/Dip:</strong>
                                <p><?php echo htmlspecialchars($profile['PU/Dip']); ?></p>
                            </div>
                            <div class="info-item">
                                <strong>BE:</strong>
                                <p><?php echo htmlspecialchars($profile['BE']); ?></p>
                            </div>
                            <div class="info-item">
                                <strong>Backlogs:</strong>
                                <p><?php echo htmlspecialchars($profile['Backlogs']); ?></p>
                            </div>
                            <div class="info-item">
                                <strong>HOF Backlogs:</strong>
                                <p><?php echo htmlspecialchars($profile['HofBacklogs']); ?></p>
                            </div>
                            <div class="info-item">
                                <strong>Detain Years:</strong>
                                <p><?php echo htmlspecialchars($profile['DetainYears']); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="approval-card">
                        <h3>Approval Status</h3>
                        <div class="profile-info">
                            <div class="info-item">
                                <strong>Approval Status:</strong>
                                <p><?php echo htmlspecialchars($profile['Approve'] ? 'Approved' : 'Not Approved'); ?>
                                </p>
                            </div>

                            <div class="info-item">
                                <strong>Date of Birth:</strong>
                                <p>
                                    <?php
                                    // Assuming $profile['DOB'] is in `YYYY-MM-DD` format
                                    $ard = DateTime::createFromFormat("Y-m-d", $profile['ApprovalDate']);
                                    echo $ard ? $ard->format("d-m-Y") : "Invalid date";
                                    ?>
                                </p>
                            </div>

                        </div>
                    </div>
                    <div class="profile-header">

                        <a href="viewapp.php"><button class="close-btn">Close</button></a>
                    </div>
                </div>
                <footer class="text-right">
                    <p>Copyright &copy; 2024 Hmc-PMS | Developed by
                        <a href="#" target="_parent">Hmc FutureTechnologies</a>
                    </p>
                </footer>
            </div>
        </div>
    </div>
    <!-- JS -->
    <script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
    <!-- jQuery -->
    <script type="text/javascript" src="js/bootstrap-filestyle.min.js"></script>
    <!-- http://markusslima.github.io/bootstrap-filestyle/ -->
    <script type="text/javascript" src="js/templatemo-script.js"></script>
    <!-- Templatemo Script -->
</body>

</html>