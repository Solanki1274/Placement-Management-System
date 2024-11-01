<?php
session_start();
if (!isset($_SESSION['pusername'])) {
  header("location: index.php");
  exit;
}
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
  <title>Placement - Home</title>
  <meta name="description" content="">
  <meta name="author" content="templatemo">
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,700' rel='stylesheet' type='text/css'>
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
        $Welcome = "Helloo!!! How are You?";
        echo "<h1>" . $Welcome . "<br>" . $_SESSION['pusername'] . "</h1>";
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
          <li><a href="#" class="active"><i class="fa fa-home fa-fw"></i>Dashboard</a></li>
          <li><a href="Placement Drives.php"><i class="fa fa-home fa-fw"></i>Placement Drives</a></li>
          <li><a href="manage-users.php"><i class="fa fa-users fa-fw"></i>View Students</a></li>
          <li><a href="queries.php"><i class="fa fa-users fa-fw"></i>Queries</a></li>
          <li><a href="Students Eligibility.php"><i class="fa fa-sliders fa-fw"></i>Students Eligibility Status</a></li>
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
              <li><a href="../../Homepage/index.php">Home CIT-PMS</a></li>
              <li><a href="../../Drives/index.php">Drives Home</a></li>
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
                <tr>
                  <th >Approval Date</th>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>USN</th>
                  <th>Mobile</th>
                  <th>Email</th>
                  <th>DOB</th>
                  <th>Semester</th>
                  <th>Branch</th>
                  <th>SSLC</th>
                  <th>PU/Dip</th>
                  <th>BE</th>
                  <th>Backlogs</th>
                  <th>History Of Backlogs</th>
                  <th>Detain Years</th>
                </tr>
                </tr>
              </thead>
              <tbody>
                <?php
                $num_rec_per_page = 15;
                $conn = new mysqli('localhost', 'harsh', 'harsh2005', 'placement');

                if ($conn->connect_error) {
                  die("Connection failed: " . $conn->connect_error);
                }

                $page = isset($_GET["page"]) ? $_GET["page"] : 1;
                $start_from = ($page - 1) * $num_rec_per_page;
                $sql = "SELECT * FROM basicdetails WHERE Approve='1' ORDER BY ApprovalDate DESC LIMIT $start_from, $num_rec_per_page";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                                    <td>{$row['ApprovalDate']}</td>
                                    <td>{$row['FirstName']}</td>
                                    <td>{$row['LastName']}</td>
                                    <td>{$row['USN']}</td>
                                    <td>{$row['Mobile']}</td>
                                    <td>{$row['Email']}</td>
                                    <td>{$row['DOB']}</td>
                                    <td>{$row['Sem']}</td>
                                    <td>{$row['Branch']}</td>
                                    <td>{$row['SSLC']}</td>
                                    <td>{$row['PU/Dip']}</td>
                                    <td>{$row['BE']}</td>
                                    <td>{$row['Backlogs']}</td>
                                    <td>{$row['HofBacklogs']}</td>
                                    <td>{$row['DetainYears']}</td>
                                </tr>";
                  }
                } else {
                  echo "<tr><td colspan='15' class='text-center'>No records found.</td></tr>";
                }
                $conn->close();
                ?>
              </tbody>
            </table>
          </div>
        </div>
        <nav>
          <ul class="pagination justify-content-center">
            <?php
            $conn = new mysqli('localhost', 'harsh', 'harsh2005', 'placement');
            $sql = "SELECT * FROM basicdetails WHERE Approve='1'";
            $rs_result = $conn->query($sql);
            $total_records = $rs_result->num_rows;
            $total_pages = ceil($total_records / $num_rec_per_page);

            if ($page > 1) {
              echo "<li class='page-item'><a class='page-link' href='manage-users.php?page=" . ($page - 1) . "'>Prev</a></li>";
            }

            for ($i = 1; $i <= $total_pages; $i++) {
              echo "<li class='page-item'><a class='page-link' href='manage-users.php?page=" . $i . "'>" . $i . "</a></li>";
            }

            if ($page < $total_pages) {
              echo "<li class='page-item'><a class='page-link' href='manage-users.php?page=" . ($page + 1) . "'>Next</a></li>";
            }
            ?>
          </ul>
        </nav>
        <footer class="text-right">
          <p>Copyright &copy; 2024 Hmc-PMS | Developed by
            <a href="#" target="_parent">Hmc FutureTechnologies</a>
          </p>
        </footer>
      </div>
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/js/bootstrap.min.js"></script>
</body>

</html>