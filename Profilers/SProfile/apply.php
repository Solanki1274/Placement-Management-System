<?php
// Start the session
session_start();

// Check if the USN is set in the session
if (!isset($_SESSION['username'])) {
    echo "<script>alert('User is not logged in. Please log in first.'); window.location.href = 'login.php';</script>";
    exit; // Stop executing the script
}

// Get USN from session
$usn = $_SESSION['username'];

// Database connection
$conn = new mysqli("localhost", "harsh", "harsh2005", "placement");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch user details based on USN
$sql = "SELECT FirstName, LastName, Mobile, Email, DOB, Sem, Branch, SSLC, `PU/Dip`, BE, Backlogs, HofBacklogs, DetainYears FROM basicdetails WHERE USN = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $usn);
$stmt->execute();
$result = $stmt->get_result();

// Check if any rows were returned
if ($result->num_rows > 0) {
    // Fetch user details into an associative array
    $user_details = $result->fetch_assoc();

    // Assign fetched details to variables
    $first_name = $user_details['FirstName'] ?? '';
    $last_name = $user_details['LastName'] ?? '';
    $phone = $user_details['Mobile'] ?? '';
    $email = $user_details['Email'] ?? '';
    $dob = $user_details['DOB'] ?? '';
    $current_semester = $user_details['Sem'] ?? '';
    $branch = $user_details['Branch'] ?? '';
    $sslc = $user_details['SSLC'] ?? '';
    $pu_dip = $user_details['PU/Dip'] ?? '';
    $be = $user_details['BE'] ?? '';
    $backlogs = $user_details['Backlogs'] ?? '';
    $hof_backlogs = $user_details['HofBacklogs'] ?? '';
    $detain_years = $user_details['DetainYears'] ?? '';

    // Fetch company name from the URL
    $company_name = $_GET['company'] ?? '';

    // Check if company name and other required fields are not empty
    if (!empty($company_name) && !empty($usn) && !empty($first_name) && !empty($last_name)) {
        // Prepare and bind
        $stmt_insert = $conn->prepare("
            INSERT INTO applications (company_name, usn, first_name, last_name, applied_at)
            VALUES (?, ?, ?,  ?, CURRENT_TIMESTAMP)
        ");
        $stmt_insert->bind_param("ssss", $company_name, $usn, $first_name, $last_name);

        // Execute the insertion
        if ($stmt_insert->execute()) {
            echo "<script>alert('Application submitted successfully.');</script>";
        } else {
            echo "<script>alert('Error submitting application: " . $stmt_insert->error . "');</script>";
        }

        // Close the insert statement
        $stmt_insert->close();
    } else {
        echo "<script>alert('Please fill in all required fields.');</script>";
    }

    // Fetching applied companies based on USN
    $applied_sql = "SELECT a.company_name, a.applied_at 
                    FROM applications a 
                    WHERE a.usn = ?";
    $applied_stmt = $conn->prepare($applied_sql);
    $applied_stmt->bind_param("s", $usn);
    $applied_stmt->execute();
    $applied_result = $applied_stmt->get_result();


} else {
    // Handle case where no user is found
    echo "<script>alert('No user found with the specified USN.');</script>";
}

// Clean up
$stmt->close();
$applied_stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apply for Job</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }

        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        input[type="submit"] {
            background: #28a745;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background: #218838;
        }

        .error {
            color: red;
            margin-top: 10px;
            text-align: center;
        }

        .success {
            color: green;
            margin-top: 10px;
            text-align: center;
        }
    </style>
    <style>
        .templatemo-content-widget {
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .templatemo-content-widget h2 {
            color: #333;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .form-control {
            border-radius: 4px;
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 15px;
        }

        .btn {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #0056b3;
        }
    </style>

    <head>
        <!--favicon-->
        <link rel="shortcut icon" href="favicon.ico" type="image/icon">
        <link rel="icon" href="favicon.ico" type="image/icon">

        <link rel="shortcut icon" href="favicon.ico" type="image/icon">
        <link rel="icon" href="favicon.ico" type="image/icon">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Preferences</title>
        <meta name="description" content="">
        <meta name="author" content="templatemo">

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
    </head>

<body>
    <!-- Left column -->
    <div class="templatemo-flex-row">
        <div class="templatemo-sidebar">
            <!-- <header class="templatemo-site-header">
                <div class="square"></div>

                <?php
                $Welcome = "Welcome";
                echo "<h1>" . $Welcome . "<br>" . $_SESSION['username'] . "</h1>";
                ?>
            </header> -->
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
                        <a href="login.php"><i class="fa fa-home fa-fw"></i>Dashboard</a>
                    </li>
                    <li>
                        <a href="placement_drives.php"><i class="fa fa-bar-chart fa-fw"></i>Placement Drives</a>
                    </li>
                    <li>
                        <a href="preferences.php"><i class="fa fa-sliders fa-fw"></i>Preferences</a>
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
                                <a href="../../Homepage/index.html">Home CIT-PMS</a>
                            </li>
                            <li>
                                <a href="#">Drives Homepage</a>
                            </li>
                            <li>
                                <a href="#">Overview</a>
                            </li>
                            <li>
                                <a href="#">Change Password</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="templatemo-content-container">
                <div class="templatemo-content-widget white-bg">
                    <h2 class="margin-bottom-10">Your Data</h2>
                    <p>View Your Details</p>
                    <form action="apply.php" class="templatemo-login-form" method="post" enctype="multipart/form-data">
                        <div class="row form-group">
                            <div class="col-lg-6 col-md-6 form-group">
                                <label for="inputFirstName">First Name</label>
                                <input type="text" name="Fname" class="form-control" id="inputFirstName"
                                    value="<?php echo htmlspecialchars($first_name); ?>" readonly>
                            </div>
                            <div class="col-lg-6 col-md-6 form-group">
                                <label for="inputLastName">Last Name</label>
                                <input type="text" name="Lname" class="form-control" id="inputLastName"
                                    value="<?php echo htmlspecialchars($last_name); ?>" readonly>
                            </div>
                            <div class="col-lg-6 col-md-6 form-group">
                                <label for="usn">USN</label>
                                <input type="text" name="USN" class="form-control" id="usn"
                                    value="<?php echo htmlspecialchars($usn); ?>" readonly>
                            </div>
                            <div class="col-lg-6 col-md-6 form-group">
                                <label for="Phone">Phone:</label>
                                <input type="text" name="Num" class="form-control" id="Phone"
                                    value="<?php echo htmlspecialchars($phone); ?>" readonly>
                            </div>
                            <div class="col-lg-6 col-md-6 form-group">
                                <label for="Email">Email</label>
                                <input type="email" name="Email" class="form-control" id="Email"
                                    value="<?php echo htmlspecialchars($email); ?>" readonly>
                            </div>
                            <div class="col-lg-6 col-md-6 form-group">
                                <label for="DOB">Date of Birth</label>
                                <input type="date" name="DOB" class="form-control" id="DOB"
                                    value="<?php echo htmlspecialchars($dob); ?>" readonly>
                            </div>
                            <div class="col-lg-6 col-md-6 form-group">
                                <label class="control-label templatemo-block">Current Semester</label>
                                <select name="Cursem" class="form-control" readonly>
                                    <option value="<?php echo htmlspecialchars($current_semester); ?>" selected>
                                        <?php echo htmlspecialchars($current_semester); ?>
                                    </option>
                                    <!-- Include other options if necessary -->
                                </select>
                            </div>
                            <div class="col-lg-6 col-md-6 form-group">
                                <label class="control-label templatemo-block">Branch of Study</label>
                                <select name="Branch" class="form-control" readonly>
                                    <option value="<?php echo htmlspecialchars($branch); ?>" selected>
                                        <?php echo htmlspecialchars($branch); ?>
                                    </option>
                                    <!-- Include other branches if necessary -->
                                </select>
                            </div>
                            <!-- Add fields for SSLC, PU/Dip, BE, Backlogs, etc. -->
                            <div class="col-lg-6 col-md-6 form-group">
                                <label for="SSLC">SSLC Percentage</label>
                                <input type="text" name="SSLC" class="form-control" id="SSLC"
                                    value="<?php echo htmlspecialchars($sslc); ?>" readonly>
                            </div>
                            <div class="col-lg-6 col-md-6 form-group">
                                <label for="PUDip">PU/Dip Percentage</label>
                                <input type="text" name="PUDip" class="form-control" id="PUDip"
                                    value="<?php echo htmlspecialchars($pu_dip); ?>" readonly>
                            </div>
                            <div class="col-lg-6 col-md-6 form-group">
                                <label for="BE">BE Percentage</label>
                                <input type="text" name="BE" class="form-control" id="BE"
                                    value="<?php echo htmlspecialchars($be); ?>" readonly>
                            </div>
                            <div class="col-lg-6 col-md-6 form-group">
                                <label for="Backlogs">Backlogs</label>
                                <input type="text" name="Backlogs" class="form-control" id="Backlogs"
                                    value="<?php echo htmlspecialchars($backlogs); ?>" readonly>
                            </div>
                            <div class="col-lg-6 col-md-6 form-group">
                                <label for="HOFBacklogs">HOF Backlogs</label>
                                <input type="text" name="HOFBacklogs" class="form-control" id="HOFBacklogs"
                                    value="<?php echo htmlspecialchars($hof_backlogs); ?>" readonly>
                            </div>
                            <div class="col-lg-6 col-md-6 form-group">
                                <label for="DetainYears">Detain Years</label>
                                <input type="text" name="DetainYears" class="form-control" id="DetainYears"
                                    value="<?php echo htmlspecialchars($detain_years); ?>" readonly>
                            </div>
                            <div class="col-lg-12 form-group">
                                <button type="button" class="btn" onclick="applyChanges()">Apply</button>
                            </div>
                        </div>
                    </form>
                </div>
        </div>

        <script>
            function applyChanges() {
                alert('Application submitted successfully!');
            }
            
        </script>

    </div>

    </form>
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