<?php
session_start();
if (isset($_SESSION['husername'])) {
} else {
    header("location: index.php");
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
    <title>Manage Students</title>
    
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/templatemo-style.css" rel="stylesheet">
  </head>
  <body>
    <div class="templatemo-flex-row">
      <div class="templatemo-sidebar">
        <header class="templatemo-site-header">
          <div class="square"></div>
          <?php
          $Welcome = "Welcome";
          echo "<h1>" . $Welcome . "<br>" . $_SESSION['husername'] . "</h1>";
          echo "<h2>(" . $_SESSION['department'] . ")</h2>";
          ?>
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
            <li><a href="#" class="active"><i class="fa fa-users fa-fw"></i>Manage Students</a></li>
            <li><a href="preferences.php"><i class="fa fa-sliders fa-fw"></i>Preferences</a></li>
            <li><a href="logout.php"><i class="fa fa-eject fa-fw"></i>Sign Out</a></li>
          </ul>
        </nav>
      </div>

      <div class="templatemo-content col-1 light-gray-bg">
        <div class="templatemo-top-nav-container">
          <div class="row">
            <nav class="templatemo-top-nav col-lg-12 col-md-12">
              <ul class="text-uppercase">
                <li><a href="../../Homepage/index.php">Home CIT-PMS</a></li>
                <li><a href="../../Drives/index.php">Drives</a></li>
                <li><a href="Notif.php">Notification</a></li>
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
                    <td>First Name</td>
                    <td>Last Name</td>
                    <td>USN</td>
                    <td>Mobile</td>
                    <td>Email</td>
                    <td>DOB</td>
                    <td>Current Sem</td>
                    <td>Branch</td>
                    <td>SSLC Percentage</td>
                    <td>PU Percentage</td>
                    <td>BE Aggregate</td>
                    <td>Current Backlogs</td>
                    <td>History of Backlogs</td>
                    <td>Detain Years</td>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $department = $_SESSION['department'];
                  $num_rec_per_page = 15;
                  $conn = new mysqli('localhost', 'harsh', 'harsh2005', 'placement');
                  
                  if (isset($_GET["page"])) {
                    $page = $_GET["page"];
                  } else {
                    $page = 1;
                  }
                  
                  $start_from = ($page - 1) * $num_rec_per_page;
                  $sql = "SELECT * FROM basicdetails WHERE Approve=0 AND Branch='$department' LIMIT $start_from, $num_rec_per_page";
                  $result = $conn->query($sql);
                  
                  while ($row = $result->fetch_assoc()) {
                      echo "<tr>";
                      echo "<td>" . $row['FirstName'] . "</td>";
                      echo "<td>" . $row['LastName'] . "</td>";
                      echo "<td>" . $row['USN'] . "</td>";
                      echo "<td>" . $row['Mobile'] . "</td>";
                      echo "<td>" . $row['Email'] . "</td>";
                      echo "<td>" . $row['DOB'] . "</td>";
                      echo "<td>" . $row['Sem'] . "</td>";
                      echo "<td>" . $row['Branch'] . "</td>";
                      echo "<td>" . $row['SSLC'] . "</td>";
                      echo "<td>" . $row['PU/Dip'] . "</td>";
                      echo "<td>" . $row['BE'] . "</td>";
                      echo "<td>" . $row['Backlogs'] . "</td>";
                      echo "<td>" . $row['HofBacklogs'] . "</td>";
                      echo "<td>" . $row['DetainYears'] . "</td>";
                      echo "</tr>";
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>

          <div class="pagination-wrap">
            <ul class="pagination">
              <?php
              $sql = "SELECT * FROM basicdetails WHERE Approve=0 AND Branch='$department'";
              $result = $conn->query($sql);
              $total_records = $result->num_rows;
              $total_pages = ceil($total_records / $num_rec_per_page);
              
              if ($page > 1) {
                  echo "<li><a href='manage-student.php?page=" . ($page - 1) . "'><</a></li>";
              }
              
              for ($i = 1; $i <= $total_pages; $i++) {
                  echo "<li><a href='manage-student.php?page=" . $i . "'>" . $i . "</a></li>";
              }
              
              if ($page < $total_pages) {
                  echo "<li><a href='manage-student.php?page=" . ($page + 1) . "'>></a></li>";
              }
              ?>
            </ul>
          </div>

          <center>
            <label><h2>OR</h2></label>
            <a href="manage-users1.php" class="templatemo-blue-button">View All</a>
          </center>
          <footer class="text-right">
            <p>&copy; 2024 Hmc-PMS | Developed by <a href="#" target="_blank">Hmc FutureTechnologies</a></p>
          </footer>
        </div>
      </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  </body>
</html>
