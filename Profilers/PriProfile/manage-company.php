<?php
session_start();
if (isset($_SESSION['priusername'])) {
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
    <title>Queries</title>
    <meta name="description" content="">
    <meta name="author" content="templatemo">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,700' rel='stylesheet'
        type='text/css'>
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/templatemo-style.css" rel="stylesheet">
    <title>Manage Company</title>
    <style>
        .container {
            text-align: center;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .container a {
            display: block;
            padding: 10px 20px;
            margin: 10px;
            text-decoration: none;
            color: white;
            background-color: #007bff;
            border-radius: 5px;
            font-size: 16px;
        }
        .container a:hover {
            background-color: #0056b3;
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
                echo "<br>";
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
                    <li><a href="login.php"><i class="fa fa-home fa-fw"></i>Dashboard</a></li>
                    <li><a href="Students Eligibility.php"><i class="fa fa-bar-chart fa-fw"></i>Check Students
                            Eligibility</a>
                    </li>
                    <li><a href="queries.php"><i class="fa fa-database fa-fw"></i>Queries</a></li>
                    <li><a href="manage-users.php"><i class="fa fa-users fa-fw"></i>Student Details</a></li>
                    <li><a href="manage-company.php" class="active"><i class="fa fa-users fa-fw"></i>Manage Company</a>
                    </li>
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
                            <li><a href="../../Homepage/index.php">Home CIT-PMS</a></li>
                            <li><a href="../../Drives/index.php">Drives Home</a></li>
                            <li><a href="Notif.php">Notification</a></li>
                            <li><a href="Change Password.php">Change Password</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
            <center>

                <div class="container">
                    <h2>Manage Company</h2>
                    <a href="insert_company.php">Insert Company</a>
                    <a href="delete_company.php">Delete Company</a>
                </div>
                <footer class="text-right">
                    <p>Copyright &copy; 2024 Hmc-PMS
                        | Developed by <a href="#" target="_parent">Hmc FutureTechnologies</a></p>
                </footer>
        </div>
    </div>
    </div>
    <!-- JS -->
    <script type="text/javascript" src="js/jquery-1.11.2.min.js"></script> <!-- jQuery -->
    <script type="text/javascript" src="js/templatemo-script.js"></script> <!-- Templatemo Script -->

</body>

</html>