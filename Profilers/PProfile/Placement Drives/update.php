<?php
session_start();
if (!isset($_SESSION["pusername"])) {
    header("location: index.php");
    exit();
}

// Establishing connection with the database
$connect = mysqli_connect("localhost", "harsh", "harsh2005", "placement");
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

$message = ""; // Variable to hold success or failure message
$success = false; // Flag to track success status

if (isset($_POST['submit'])) {
    $usn = mysqli_real_escape_string($connect, $_POST['usn']);
    $name = mysqli_real_escape_string($connect, $_POST['sname']);
    $comname = mysqli_real_escape_string($connect, $_POST['comname']);
    $date = mysqli_real_escape_string($connect, $_POST['Date']);
    $attend = mysqli_real_escape_string($connect, $_POST['Attendance']);
    $wt = mysqli_real_escape_string($connect, $_POST['WrittenTest']);
    $gd = mysqli_real_escape_string($connect, $_POST['GD']);
    $tech = mysqli_real_escape_string($connect, $_POST['Tech']);
    $placed = mysqli_real_escape_string($connect, $_POST['Placed']);

    // Check if the USN exists in the basicdetails table
    $usn_check_query = "SELECT * FROM basicdetails WHERE USN = '$usn'";
    $result = mysqli_query($connect, $usn_check_query);

    if (mysqli_num_rows($result) > 0) {
        // USN exists, proceed with the insertion
        $query = "INSERT INTO updatedrive (USN, Name, CompanyName, Date, Attendence, WT, GD, Techical, Placed) 
                  VALUES ('$usn', '$name', '$comname', '$date', '$attend', '$wt', '$gd', '$tech', '$placed')";

        if (mysqli_query($connect, $query)) {
            $message = "Data Inserted successfully...!!";
            $success = true; // Set success flag
        } else {
            $message = "FAILED: " . mysqli_error($connect);
        }
    } else {
        // USN does not exist
        $message = "FAILED: The USN '$usn' does not exist in the basicdetails table.";
    }

    // Store message in session to display after redirect
    $_SESSION['message'] = $message;
    $_SESSION['success'] = $success;

    // Redirect to the same page to avoid resubmission
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

$message = isset($_SESSION['message']) ? $_SESSION['message'] : '';
$success = isset($_SESSION['success']) ? $_SESSION['success'] : false;

// Clear the message after displaying
unset($_SESSION['message']);
unset($_SESSION['success']);

mysqli_close($connect); // Close the connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- favicon -->
    <link rel="shortcut icon" href="../favicon.ico" type="image/icon">
    <link rel="icon" href="../favicon.ico" type="image/icon">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Preferences</title>
    <meta name="description" content="">
    <meta name="author" content="templatemo">
    
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,700' rel='stylesheet' type='text/css'>
    <link href="../css/font-awesome.min.css" rel="stylesheet">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/templatemo-style.css" rel="stylesheet">
    
    <script>
        function confirmSubmit() {
            return confirm("Are you sure you want to update?");
        }

        function showMessage() {
            const message = "<?php echo addslashes($message); ?>";
            const success = <?php echo json_encode($success); ?>;
            if (message) {
                alert(message);
                if (success) {
                    window.location.reload(); // Reload the page on success if needed
                }
            }
        }
    </script>
</head>
<body onload="showMessage()">
    <!-- Left column -->
    <div class="templatemo-flex-row">
        <div class="templatemo-sidebar">
            <header class="templatemo-site-header">
                <div class="square"></div>
                <h1>Update Drive Details</h1>
            </header>
            <div class="profile-photo-container">
                <img src="../images/profile-photo.jpg" alt="Profile Photo" class="img-responsive">
                <div class="profile-photo-overlay"></div>
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
        <!-- Main content --> 
        <div class="templatemo-content col-1 light-gray-bg">
            <div class="templatemo-content-container">
                <div class="templatemo-content-widget white-bg">
                    <h2 class="margin-bottom-10">Placement Drives</h2>
                    <p>Update Students Details</p>
                    <form action="update.php" class="templatemo-login-form" method="post" enctype="multipart/form-data" onsubmit="return confirmSubmit()">
                        <div class="row form-group">
                            <div class="col-lg-6 col-md-6 form-group">
                                <label for="USN">USN</label>
                                <input type="text" name="usn" class="form-control" id="inputusn" placeholder="1cg12is000" required>
                            </div>
                            <div class="col-lg-6 col-md-6 form-group">
                                <label for="Name">Student Name</label>
                                <input type="text" name="sname" class="form-control" id="inputName" placeholder="Karan" required>
                            </div>
                            <div class="col-lg-6 col-md-6 form-group">
                                <label for="Name">Company Name</label>
                                <input type="text" name="comname" class="form-control" id="inputName" placeholder="" required>
                            </div>
                            <div class="col-lg-6 col-md-6 form-group">
                                <label for="DOB">Date</label>
                                <input type="date" name="Date" class="form-control" id="DOB" placeholder="DD/MM/YYYY" required>
                            </div>
                            <div class="col-lg-6 col-md-6 form-group">
                                <label for="Attendance">Attendance</label>
                                <select name="Attendance" class="form-control" required>
                                    <option value="select">Y/N</option>
                                    <option value="1">Y</option>
                                    <option value="0">N</option>
                                </select>
                            </div>
                            <div class="col-lg-6 col-md-6 form-group">
                                <label for="written test">Written Test</label>
                                <select name="WrittenTest" class="form-control" required>
                                    <option value="select">Y/N</option>
                                    <option value="1">Y</option>
                                    <option value="0">N</option>
                                </select>                 
                            </div>
                            <div class="col-lg-6 col-md-6 form-group">
                                <label for="Group discussion">Group Discussion</label>
                                <select name="GD" class="form-control" required>
                                    <option value="select">Y/N</option>
                                    <option value="1">Y</option>
                                    <option value="0">N</option>
                                </select> 
                            </div>
                            <div class="col-lg-6 col-md-6 form-group">
                                <label for="Technical">Technical</label>
                                <select name="Tech" class="form-control" required>
                                    <option value="select">Y/N</option>
                                    <option value="1">Y</option>
                                    <option value="0">N</option>
                                </select>
                            </div>
                            <div class="col-lg-6 col-md-6 form-group">
                                <label for="Placed">Placed</label>
                                <select name="Placed" class="form-control" required>
                                    <option value="select">Y/N</option>
                                    <option value="1">Y</option>
                                    <option value="0">N</option>
                                </select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-12 text-right">
                                <button type="submit" name="submit" class="templatemo-blue-button">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="../js/jquery-1.11.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/templatemo-script.js"></script>
</body>
</html>
