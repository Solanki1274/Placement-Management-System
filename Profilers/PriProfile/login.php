<?php

session_start();
if (isset($_SESSION["priusername"])) {

} else {
    header("location: index.php");
}
// Database connection
$servername = "localhost";
$username = "harsh";
$password = "harsh2005";
$dbname = "placement";
$connect = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}

// Define a function to fetch and display counts based on specific criteria
function fetchCount($conn, $query) {
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    $stmt->close();
    return $data;
}

// Query and display results
$query1 = "SELECT COUNT(DISTINCT CompanyName) as count FROM addpdrive WHERE PVenue LIKE '%CIT%' AND YEAR(Date) = YEAR(NOW())";
$data1 = fetchCount($connect, $query1);

$query2 = "SELECT COUNT(Attendence) as count FROM updatedrive WHERE Attendence = 1 AND YEAR(Date) = YEAR(NOW())";
$data2 = fetchCount($connect, $query2);

$query3 = "SELECT COUNT(Placed) as count FROM updatedrive WHERE Placed = 1 AND YEAR(Date) = YEAR(NOW())";
$data3 = fetchCount($connect, $query3);

// Get total students, companies, and HODs from the existing database
$total_students = mysqli_fetch_assoc(mysqli_query($connect, "SELECT COUNT(*) AS total FROM basicdetails"))['total'];
$total_companies = mysqli_fetch_assoc(mysqli_query($connect, "SELECT COUNT(*) AS total FROM plogin"))['total'];
$total_hods = mysqli_fetch_assoc(mysqli_query($connect, "SELECT COUNT(*) AS total FROM hlogin"))['total'];

$interview_query = "SELECT i.Name AS company_name, i.USN, i.interview_at, i.mode, i.venue
                    FROM interviews i
                    INNER JOIN basicdetails b ON i.USN = b.USN
                    WHERE i.interview_at > NOW()
                    ORDER BY i.interview_at ASC";

$interviews_result = $connect->query($interview_query);

// Check if the query failed
if (!$interviews_result) {
    // Output the error message from MySQL
    die('Error in query: ' . $connect->error);
}

function fetchUpcomingDrives($conn)
{
    $query = "SELECT * FROM addpdrive WHERE Date > NOW() ORDER BY Date ASC LIMIT 5";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        return $result;
    } else {
        return null;
    }
}

// Fetch upcoming drives
$upcomingDrives = fetchUpcomingDrives($connect);
// Close connection
$connect->close();
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
    <title>Principal - Home</title>
    <meta name="description" content="">
    <meta name="author" content="templatemo">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,700' rel='stylesheet' type='text/css'>
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/templatemo-style.css" rel="stylesheet">
    <style>
       
        .card {
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
        .card:hover {
            transform: scale(1.05);
        }
        .card-header {
            background-color: #0d6efd;
            color: white;
            font-size: 1.5rem;
        }
        .card-body {
            font-size: 1.2rem;
            text-align: center;
        }
        .card-footer {
            background-color: #f1f1f1;
        }
        .stat-card {
            border-radius: 15px;
            color: white;
            text-align: center;
            margin-bottom: 20px;
            transition: all 0.3s ease;
            padding: 30px;
        }
        .stat-card:hover {
            transform: scale(1.05);
        }
        .card-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .card-container .card {
            flex: 1;
            margin-right: 20px;
            margin-bottom: 20px;
        }
        .card-container .card:last-child {
            margin-right: 0;
        }
        .table th {
            background-color: #0d6efd;
            color: white;
        }
        .btn-custom {
            background-color: #0d6efd;
            color: white;
            border-radius: 5px;
            padding: 10px 20px;
        }
        .btn-custom:hover {
            background-color: #0056b3;
        }
        .upcoming-interviews {
            margin-top: 30px;
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
echo "<h1>" . $Welcome . "<br>" . $_SESSION['priusername'] . "</h1>";
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
          <li><a href="login.php" class="active"><i class="fa fa-home fa-fw" class="active"></i>Dashboard</a></li>
          <li><a href="Students Eligibility.php"><i class="fa fa-bar-chart fa-fw"></i>Check Students Eligibility</a>
          </li>
          <li><a href="queries.php"><i class="fa fa-database fa-fw"></i>Queries</a></li>
          <li><a href="manage-users.php"><i class="fa fa-users fa-fw"></i>Student Details</a></li>
          <li><a href="manage-company.php"><i class="fa fa-users fa-fw"></i>Manage Company</a></li>
          <li><a href="manage-hod.php"><i class="fa fa-users fa-fw"></i>Manage HOD</a></li>
          <li><a href="logout.php"><i class="fa fa-eject fa-fw"></i>Sign Out</a></li>
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
                <a href="Notif.php">Notification</a>
              </li>
              <li>
                <a href="Change Password.php">Change Password</a>
              </li>
            </ul>
          </nav>
        </div>
      </div>
      <div class="container mt-5">
        <h1 class="mb-4 text-center">Admin Dashboard</h1>

        <!-- Stat Cards -->
        <div class="card-container">
            <div class="card stat-card" style="background-color: #28a745;">
                <div class="card-body">
                    <h5>Total Students</h5>
                    <p><?php echo $total_students; ?></p>
                </div>
            </div>
            <div class="card stat-card" style="background-color: #ffc107;">
                <div class="card-body">
                    <h5>Total Companies</h5>
                    <p><?php echo $total_companies; ?></p>
                </div>
            </div>
            <div class="card stat-card" style="background-color: #17a2b8;">
                <div class="card-body">
                    <h5>Total HODs</h5>
                    <p><?php echo $total_hods; ?></p>
                </div>
            </div>
        </div>

        <!-- Yearly Statistics -->
        <div class="card-container">
            <div class="card stat-card" style="background-color: #007bff;">
                <div class="card-body">
                    <h5>Companies on Campus This Year</h5>
                    <p><?php echo $data1['count']; ?></p>
                </div>
            </div>
            <div class="card stat-card" style="background-color: #fd7e14;">
                <div class="card-body">
                    <h5>Students Attended This Year</h5>
                    <p><?php echo $data2['count']; ?></p>
                </div>
            </div>
            <div class="card stat-card" style="background-color: #dc3545;">
                <div class="card-body">
                    <h5>Students Placed This Year</h5>
                    <p><?php echo $data3['count']; ?></p>
                </div>
            </div>
        </div>
       
        <div class="templatemo-content-container">
            <div class="templatemo-content-widget no-padding">
            <h2>Upcoming Drives</h2>
                <div class="panel panel-default table-responsive">
                 
                <?php if ($upcomingDrives): ?>
                    <table class="table table-striped table-bordered templatemo-user-table">
                <thead>
                    <tr>
                        <td>Company Name</td>
                        <td>Drive Date</td>
                        <td>Placement Type</td>
                        <td>Placement Venue</t>
                        <td>SSLC (%)</t>
                        <td>PU/Dip (%)</td>
                        <td>BE (%)</td>
                        <td>Backlogs</td>
                        <td>HOF Backlogs</td>
                        <td>Detain Years</td>
                        <td>Other Details</td>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $upcomingDrives->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['CompanyName']; ?></td>
                            <td><?php echo date("d-m-Y", strtotime($row['Date'])); ?></td>
                            <td><?php echo $row['C/P'] == 1 ? 'Campus' : 'Pool'; ?></td>
                            <td><?php echo $row['PVenue']; ?></td>
                            <td><?php echo $row['SSLC']; ?></td>
                            <td><?php echo $row['PU/Dip']; ?></td>
                            <td><?php echo $row['BE']; ?></td>
                            <td><?php echo $row['Backlogs']; ?></td>
                            <td><?php echo $row['HofBacklogs'] == 1 ? 'Yes' : 'No'; ?></td>
                            <td><?php echo $row['DetainYears']; ?></td>
                            <td><?php echo $row['ODetails']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No upcoming placement drives.</p>
        <?php endif; ?>
    </div>
</div>

        <!-- Upcoming Interviews Table -->
        <div class="templatemo-content-container">
          <h2>Upcoming Interview</h2>
            <div class="templatemo-content-widget no-padding">
                <div class="panel panel-default table-responsive">
                <?php if ($interviews_result->num_rows > 0) : ?>
                    <table class="table table-striped table-bordered templatemo-user-table">
                        <thead>
                            <tr>
                                <td>Company Name</td>
                                <td>USN</td>
                                <td>Interview Date</t>
                                <td>Mode</td>
                                <td>Venue</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $interviews_result->fetch_assoc()) : ?>
                                <tr>
                                    <td><?php echo $row['company_name']; ?></td>
                                    <td><?php echo $row['USN']; ?></td>
                                    <td><?php echo date('d M Y, H:i', strtotime($row['interview_at'])); ?></td>
                                    <td><?php echo $row['mode']; ?></td>
                                    <td><?php echo $row['venue']; ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                <?php else : ?>
                    <p>No upcoming interviews.</p>
                <?php endif; ?>
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

 
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

  <script type="text/javascript" src="js/templatemo-script.js"></script> <!-- Templatemo Script -->

</body>

</html>