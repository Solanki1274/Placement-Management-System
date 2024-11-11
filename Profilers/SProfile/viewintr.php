<?php
session_start();
$connect = mysqli_connect("localhost", "harsh", "harsh2005", "placement");

if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

$usn = $_SESSION['username']; // Get logged-in student USN from session

// Fetch interview details for the logged-in student
$query = "SELECT i.id, i.Name AS company_name, i.USN, i.interview_at, i.mode, i.venue, i.status
          FROM interviews i
          WHERE i.USN = ?";

$stmt = $connect->prepare($query);
if (!$stmt) {
    die("Preparation failed: " . $connect->error);
}

$stmt->bind_param("s", $usn);
$stmt->execute();
$result = $stmt->get_result(); // Get the result of the query

// Close the connection after the query execution
$stmt->close();
$connect->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
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
    <style>
        .container {
            max-width: 800px;
            margin: auto;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .card {
            background: white;
            padding: 20px;
            margin: 10px 0;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
        }

        .card h3 {
            margin-top: 0;
            color: #333;
        }

        .card p {
            margin: 5px 0;
            font-size: 14px;
            color: #666;
        }

        .card .btn {
            padding: 10px;
            background-color: #5cb85c;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-align: center;
            width: 100%;
            font-size: 16px;
        }

        .card .btn:hover {
            background-color: #4cae4c;
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            text-align: center;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
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
                        <a href="#"><i class="fa fa-home fa-fw"></i>Dashboard</a>
                    </li>
                    <li>
                        <a href="placement_drives.php"><i class="fa fa-bar-chart fa-fw"></i>Placement Drives</a>
                    </li>
                    <li>
                        <a href="preferences.php"><i class="fa fa-sliders fa-fw"></i>Preferences</a>
                    </li>
                    <li>
                        <a href="viewintr.php" class="active"><i class="fa fa-eject fa-fw"></i>View Interview
                            Request</a>
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
            <div class="container">
    <h1>Your Interview Requests</h1>

    <?php if (isset($_SESSION['alert'])): ?>
        <div class="alert alert-danger"><?php echo $_SESSION['alert']; unset($_SESSION['alert']); ?></div>
    <?php endif; ?>
    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div>
    <?php endif; ?>

    <?php if ($result && $result->num_rows > 0): ?>
        <!-- Loop through each interview request -->
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="card">
                <h3><?php echo htmlspecialchars($row['company_name']); ?> Interview</h3>
                <div class="interview-detail">
                    <p><strong>Interview Date & Time:</strong>
                        <?php echo date('d-m-Y H:i', strtotime($row['interview_at'])); ?></p>
                    <p><strong>Mode:</strong> <?php echo $row['mode']; ?></p>
                    <?php if ($row['mode'] == 'Offline'): ?>
                        <p><strong>Venue:</strong> <?php echo htmlspecialchars($row['venue']); ?></p>
                    <?php endif; ?>
                    <p><strong>Status:</strong>
                        <?php echo $row['status'] ? htmlspecialchars($row['status']) : 'Pending'; ?></p>
                </div>

                <!-- Only show the confirm button if the status is not already confirmed -->
                <?php if ($row['status'] != 'Confirmed'): ?>
                    <form action="viewintr.php" method="POST">
                        <input type="hidden" name="interview_id" value="<?php echo $row['id']; ?>">
                        <button type="submit" class="btn">Confirm Interview</button>
                    </form>
                <?php else: ?>
                    <button class="btn" style="background-color: #d9534f; cursor: not-allowed;" disabled>Interview
                        Confirmed</button>
                <?php endif; ?>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <div class="alert alert-info">You don't have any upcoming interview requests.</div>
    <?php endif; ?>
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
    <script src="js/jquery-1.11.2.min.js"></script>
    <!-- jQuery -->
    <script src="js/jquery-migrate-1.2.1.min.js"></script>
    <!-- jQuery Migrate Plugin -->
    <script type="text/javascript" src="js/templatemo-script.js"></script>
    <!-- Templatemo Script -->
</body>

</html>