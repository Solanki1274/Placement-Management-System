
<?php
  session_start();
  if(isset($_SESSION["priusername"])){
   
  }
   else
	   header("location: index.php")
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
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
<!-- <style>
  body {
    background-image: url("./images/bg.jpg");
    background-size: cover; /* This makes the background image cover the entire body */
    background-repeat: no-repeat; /* Prevents the image from repeating */
    background-position: center; /* Centers the image */
}

</style> -->
  </head>
  <body>  
    <!-- Left column -->
    <div class="templatemo-flex-row">
      <div class="templatemo-sidebar">
        <header class="templatemo-site-header">
          <div class="square"></div>
           <?php
		  $Welcome = "Welcome";
          echo "<h1>" . $Welcome . "<br>". $_SESSION['priusername']. "</h1>";
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
            <li><a href="Students Eligibility.php"><i class="fa fa-bar-chart fa-fw"></i>Check Students Eligibility</a></li>
            <li><a href="queries.php"><i class="fa fa-database fa-fw"></i>Queries</a></li>
            <li><a href="manage-users.php" ><i class="fa fa-users fa-fw"></i>Student Details</a></li>
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
          <div class="templatemo-flex-row flex-content-row">
            <div class="templatemo-content-widget white-bg col-2">
              <i class="fa fa-times"></i>
              <div class="square"></div>
              <h2 class="templatemo-inline-block">Welcome to CIT-PMS</h2><hr>
              <p>There is a worth for everything so do logging in here. The Use of this is, You can View Student details, Check their Eligibility Criteria and U cvan look up drive details</p>    
              <p><a href="Students Eligibility.php">Check Students Eligibility</a></p>
              
              <p><a href="manage-users.php">Student Details</a></p>
              <p><a href="queries.php">Search any Details about Drives, Company and a Student</a></p>          
            </div>
            <div class="templatemo-content-widget white-bg col-1 text-center">
              <i class="fa fa-times"></i>
              <h2 class="text-uppercase">Best Project</h2>
              <h3 class="text-uppercase margin-bottom-10">Design Project</h3>
              <img src="images/bicycle.jpg" alt="Bicycle" class="img-circle img-thumbnail">
            </div>
            <div class="templatemo-content-widget white-bg col-1">
              <i class="fa fa-times"></i>
              <h2 class="text-uppercase">Progress Bar</h2>
              <h3 class="text-uppercase">Progress</h3><hr>
              <div class="progress">
                <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
              </div>
              <div class="progress">
                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 50%;"></div>
              </div>
              <div class="progress">
                <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
              </div>                          
            </div>
          </div>
          <div class="templatemo-flex-row flex-content-row">
            <div class="col-1">              
              <div class="templatemo-content-widget orange-bg">
                <i class="fa fa-times"></i>                
                <div class="media">
                  <div class="media-left">
                    <a href="#">
                      <img class="media-object img-circle" src="images/sunset.jpg" alt="Sunset">
                    </a>
                  </div>
                  <div class="media-body">
                    <h2 class="media-heading text-uppercase">Updates</h2>
                    <p>Get the Latest Update about Placement News
                    
		</p> 
                  </div>        
                </div>                
              </div>            
              <div class="templatemo-content-widget white-bg">
                <i class="fa fa-times"></i>
                <div class="media">
                  <div class="media-left">
                    <a href="#">
                      <img class="media-object img-circle" src="images/sunset.jpg" alt="Sunset">
                    </a>
                  </div>
                  <div class="media-body">
                    <h2 class="media-heading text-uppercase">Drive Results</h2>
                    <p>Latest Drive Result Overview</p> 
      <?php			

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
echo "<br><br><h3>";

// 1. Count of distinct companies on campus this year
$query1 = "SELECT COUNT(DISTINCT CompanyName) as count FROM addpdrive WHERE PVenue LIKE '%CIT%' AND YEAR(Date) = YEAR(NOW())";
$data1 = fetchCount($connect, $query1);
echo "Companies In Our Campus In This Year&nbsp:&nbsp" . $data1['count'];

// 2. Count of students who attended this year
$query2 = "SELECT COUNT(Attendence) as count FROM updatedrive WHERE Attendence = 1 AND YEAR(Date) = YEAR(NOW())";
$data2 = fetchCount($connect, $query2);
echo "<br><br>Number of Students Attended In This Year&nbsp:&nbsp" . $data2['count'];

// 3. Count of students placed this year
$query3 = "SELECT COUNT(Placed) as count FROM updatedrive WHERE Placed = 1 AND YEAR(Date) = YEAR(NOW())";
$data3 = fetchCount($connect, $query3);
echo "<br><br>Number of Students Placed In This Year&nbsp:&nbsp" . $data3['count'];

echo "</h3>";

// Close connection
$connect->close();
?>

 
                  </div>
                </div>                
              </div>            
            </div>
            <div class="col-1">
              <div class="panel panel-default templatemo-content-widget white-bg no-padding templatemo-overflow-hidden">
                <i class="fa fa-times"></i>
                <div class="panel-heading templatemo-position-relative"><h2 class="text-uppercase">HOD List</h2></div>
                <div class="table-responsive">
                  <table class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <td>No.</td>
                        <td>First Name</td>
                        <td>Last Name</td>
                        <td>Username</td>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>1.</td>
                        <td>harsh</td>
                        <td>Solanki</td>
                        <td>@hs</td>
                      </tr>
                      <tr>
                        <td>2.</td>
                        <td>Rolex</td>
                        <td>Daas</td>
                        <td>@rd</td>
                      </tr>
                      <tr>
                        <td>3.</td>
                        <td>Harold</td>
                        <td>Das</td>
                        <td>@ld</td>
                      </tr>
                      <tr>
                        <td>4.</td>
                        <td>Leo</td>
                        <td>Das</td>
                        <td>@ld</td>
                      </tr>
                      <tr>
                        <td>5.</td>
                        <td>Antony</td>
                        <td>Das</td>
                        <td>@ad</td>
                      </tr>                    
                    </tbody>
                  </table>    
                </div>                          
              </div>
            </div>           
          </div> <!-- Second row ends -->
    
          <footer class="text-right">
            <p>Copyright &copy; 2024 Hmc-PMS | Developed by
              <a href="#" target="_parent">Hmc FutureTechnologies</a>
            </p>
          </footer>       
        </div>
      </div>
    </div>
    
    <!-- JS -->
    <script src="js/jquery-1.11.2.min.js"></script>      <!-- jQuery -->
    <script src="js/jquery-migrate-1.2.1.min.js"></script> <!--  jQuery Migrate Plugin -->
    <script src="https://www.google.com/jsapi"></script> Google Chart

    <script type="text/javascript" src="js/templatemo-script.js"></script>      <!-- Templatemo Script -->

  </body>
</html>