<?php
session_start();
if (isset($_SESSION['priusername'])){
      }
  else {
      header("location: index.php");
  } 
// Database connection
$servername = "localhost";
$username = "harsh"; 
$password = "harsh2005";      
$dbname = "placement"; 


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT * FROM hlogin";
$result = $conn->query($sql);
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
    <title>Manage-HOD</title>
    <meta name="description" content="">
    <meta name="author" content="templatemo">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,700' rel='stylesheet' type='text/css'>
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/templatemo-style.css" rel="stylesheet">

    
  
    <style>
        .btn-actions {
            display: flex;
            justify-content: space-around;
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
          <li><a href="login.php"><i class="fa fa-home fa-fw" class="active"></i>Dashboard</a></li>
          <li><a href="Students Eligibility.php"><i class="fa fa-bar-chart fa-fw"></i>Check Students Eligibility</a>
          </li>
          <li><a href="queries.php"><i class="fa fa-database fa-fw"></i>Queries</a></li>
          <li><a href="manage-users.php"><i class="fa fa-users fa-fw"></i>Student Details</a></li>
          <li><a href="manage-company.php"><i class="fa fa-users fa-fw"></i>Manage Company</a></li>
          <li><a href="manage-hod.php"><i class="fa fa-users fa-fw"  class="active"></i>Manage HOD</a></li>
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
      
      <div class="templatemo-content-container">
     <h2 class="templatemo-site-header">View & Manage</h2>
            <div class="templatemo-content-widget no-padding">
                <div class="panel panel-default table-responsive">
                    
                    <table class="table table-striped table-bordered templatemo-user-table">
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Username</th>
                <th>Password</th>
                <th>Email</th>
                <th>Question</th>
                <th>Answer</th>
                <th>Branch</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['Firstname']; ?></td>
                        <td><?php echo $row['Lastname']; ?></td>
                        <td><?php echo $row['Username']; ?></td>
                        <td><?php echo $row['Password']; ?></td>
                        <td><?php echo $row['Email']; ?></td>
                        <td><?php echo $row['Question']; ?></td>
                        <td><?php echo $row['Answer']; ?></td>
                        <td><?php echo $row['Branch']; ?></td>
                        <td class="btn-actions">
                            <a href="change_branch.php?id=<?php echo $row['Id']; ?>" class="btn btn-primary btn-sm">Change Branch</a>
                            <a href="reset_details.php?id=<?php echo $row['Id']; ?>" class="btn btn-warning btn-sm">Reset Details</a>
                            <a href="delete_hod.php?id=<?php echo $row['Id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this HOD? This action cannot be undone!')">Delete HOD</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" class="text-center">No HODs found</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <footer class="text-right">
          <p>Copyright &copy; 2024 Hmc-PMS | Developed by
            <a href="#" target="_parent">Hmc FutureTechnologies</a>
          </p>
        </footer>
      </div>
    </div>
  </div>

  

  <script type="text/javascript" src="js/templatemo-script.js"></script> <!-- Templatemo Script -->

</body>

</html>