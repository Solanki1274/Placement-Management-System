<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION["pusername"])) {
  header("location: ../index.php");
  exit();
}

// Establishing connection with the database
$connect = mysqli_connect("localhost", "harsh", "harsh2005", "placement");
if (!$connect) {
  die("Connection failed: " . mysqli_connect_error());
}

// Get the username from the session
$username = $_SESSION['pusername'];

// Query to fetch company name based on username
$company_query = "SELECT Name FROM plogin WHERE Username = ?";
$stmt_company = mysqli_prepare($connect, $company_query);
mysqli_stmt_bind_param($stmt_company, "s", $username);
mysqli_stmt_execute($stmt_company);
$company_result = mysqli_stmt_get_result($stmt_company);

// Check if the company name is retrieved successfully
if (mysqli_num_rows($company_result) > 0) {
  $company_row = mysqli_fetch_assoc($company_result);
  $company_name = $company_row['Name'];
} else {
  die("Company not found for the user.");
}

// Fetch applications for the specific company
$query = "SELECT * FROM applications WHERE company_name = ? ORDER BY applied_at DESC";
$stmt_applications = mysqli_prepare($connect, $query);
mysqli_stmt_bind_param($stmt_applications, "s", $company_name);
mysqli_stmt_execute($stmt_applications);
$result = mysqli_stmt_get_result($stmt_applications);

// Check for any applications
$applications = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Close the prepared statements and connection
mysqli_stmt_close($stmt_company);
mysqli_stmt_close($stmt_applications);
mysqli_close($connect); // Close the connection

// You can now use the $applications array as needed
?>
<?php
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

// Pagination setup
$limit = 10; // Number of profiles per page
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Fetch total number of profiles for pagination
$total_result = $conn->query("SELECT COUNT(*) AS total FROM basicdetails");
$total_row = $total_result->fetch_assoc();
$total_profiles = $total_row['total'];
$total_pages = ceil($total_profiles / $limit);

// Fetch profiles for the current page
$stmt = $conn->prepare("SELECT * FROM basicdetails LIMIT ?, ?");
$stmt->bind_param("ii", $offset, $limit);
$stmt->execute();
$result = $stmt->get_result();

// Fetch profiles into an array
$profiles = [];
while ($row = $result->fetch_assoc()) {
  $profiles[] = $row;
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<style>
  /* Style and space each action button */
  .action-btn {
    display: inline-block;
    margin: 5px;
    padding: 8px 12px;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
  }

  .action-btn:hover {
    background-color: #45a049;
  }

  /* Table styling */
  .application-table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
  }

  .application-table th,
  .application-table td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: center;
    vertical-align: middle;
  }

  .application-table th {
    background-color: #007bff;
    color: #fff;
    font-weight: bold;
  }

  .application-table td {
    background-color: #fff;
  }

  .button-container {
    display: flex;
    gap: 10px; /* Adds space between the buttons */
    justify-content: center; /* Centers buttons within the cell */
}

.action-btn {
    padding: 8px 12px;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.2s ease;
}

.action-btn:hover {
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

  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,700' rel='stylesheet' type='text/css'>
  <link href="../css/font-awesome.min.css" rel="stylesheet">
  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <link href="../css/templatemo-style.css" rel="stylesheet">
  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

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
          <li><a href="../Placement Drives.php" class="active"><i class="fa fa-home fa-fw"></i>Placement Drives</a></li>
          <li><a href="../manage-users.php"><i class="fa fa-users fa-fw"></i>View Students</a></li>
          <li><a href="../queries.php"><i class="fa fa-users fa-fw"></i>Queries</a></li>
          <li><a href="../Students Eligibility.php"><i class="fa fa-sliders fa-fw"></i>Students Eligibility Status</a>
          </li>
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
        <h2 class="mt-4">Applications for <?php echo htmlspecialchars($company_name); ?></h2>
        <table class="table table-striped table-bordered templatemo-user-table">
          <thead>
            <tr>
              <th>Application ID</th>
              <th>USN</th>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Applied At</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php if (count($applications) > 0): ?>
              <?php foreach ($applications as $app): ?>
                <tr>
                  <td><?php echo htmlspecialchars($app['id']); ?></td>
                  <td><?php echo htmlspecialchars($app['usn']); ?></td>
                  <td><?php echo htmlspecialchars($app['first_name']); ?></td>
                  <td><?php echo htmlspecialchars($app['last_name']); ?></td>
                  <td><?php echo htmlspecialchars($app['applied_at']); ?></td>
                  <td class="button-container">
                    <form action="scheduleinterview.php" method="post">
                      <input type="hidden" name="application_id" value="<?php echo $app['id']; ?>">
                      <button type="submit" class="action-btn">Schedule Interview</button>
                    </form>
                    <form action="dwnres.php" method="post">
                      <input type="hidden" name="application_id" value="<?php echo $app['id']; ?>">
                      <button type="submit" class="action-btn">Download Resume</button>
                    </form>
                    <form action="viewpro.php" method="post">
                      <input type="hidden" name="usn" value="<?php echo htmlspecialchars($app['usn']); ?>">
                      <button type="submit" class="action-btn">View Profile</button>
                    </form>
                  </td>


                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="6" class="text-center">No applications found.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
      <div class="pagination-wrap">
        <ul class="pagination">
          <!-- Previous page link -->
          <?php if ($page > 1): ?>
            <li><a href='viewapp.php?page=<?php echo $page - 1; ?>'>&lt;</a></li>
          <?php endif; ?>

          <!-- Page number links -->
          <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <li>
              <a href='viewapp.php?page=<?php echo $i; ?>' <?php if ($i == $page)
                   echo "class='active'"; ?>>
                <?php echo $i; ?>
              </a>
            </li>
          <?php endfor; ?>

          <!-- Next page link -->
          <?php if ($page < $total_pages): ?>
            <li><a href='viewapp.php?page=<?php echo $page + 1; ?>'>&gt;</a></li>
          <?php endif; ?>

          <li><a>Total Pages: <?php echo $total_pages; ?></a></li>
        </ul>
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