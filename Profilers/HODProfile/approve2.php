<?php
session_start();
if (isset($_SESSION['husername'])) {
    // User is logged in
} else {
    header("location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Approve USN</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            text-align: center;
            padding: 0px;
        }
        h1 {
            color: #4CAF50; /* Green color for the heading */
            margin-bottom: 20px;
        }
        form {
            background-color: white;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            margin: auto;
            position: relative;
            top: 50%;
            transform: translateY(-50%);
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #4CAF50; /* Green button */
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #45a049; /* Darker green on hover */
        }
    </style>
    <script>
        // Function to confirm approval before form submission
        function confirmApproval() {
            return confirm("Are you sure you want to approve this USN?");
        }
    </script>
</head>
<body>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="favicon.ico" type="image/icon">
    <link rel="icon" href="favicon.ico" type="image/icon">    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HOD - Preferences</title>
    <meta name="description" content="">
    <meta name="author" content="templatemo">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,700' rel='stylesheet' type='text/css'>
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/templatemo-style.css" rel="stylesheet">
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="templatemo-flex-row">
        <div class="templatemo-sidebar">
            <header class="templatemo-site-header">
                <div class="square"></div>
                <?php
                $Welcome = "Welcome";
                echo "<h1>" . $Welcome . "<br>". $_SESSION['husername']. "</h1>";
                echo "<h1>(</h1>";
                echo "<h1>" . $_SESSION['department']. "</h1>";   
                echo "<h1>)</h1>";
                ?>
            </header>
            <div class="profile-photo-container">
                <img src="images/profile-photo.jpg" alt="Profile Photo" class="img-responsive">
                <div class="profile-photo-overlay"></div>
            </div>
            <nav class="templatemo-left-nav">
                <ul>
                    <li><a href="login.php"><i class="fa fa-home fa-fw"></i>Dashboard</a></li>           
                    <li><a href="manage-students.php"><i class="fa fa-users fa-fw"></i>Manage Students</a></li>
                    <li><a href="preferences.php" ><i class="fa fa-sliders fa-fw"></i>Preferences</a></li>
                    <li><a href="approve2.php" class="active"><i class="fa fa-sliders fa-fw"></i>Approve Students</a></li>
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
    <h1>Approve USN</h1>
    <form action="approve.php" method="post" onsubmit="return confirmApproval()">
        <label for="id">Enter the USN:</label>
        <input type="text" name="id" id="id" required><br><br>
        
        <!-- Removed the date input as per your request -->
        
        <input type="submit" value="Approve">
    </form>
    
    <script type="text/javascript" src="js/jquery-1.11.2.min.js"></script> 
    <script type="text/javascript" src="js/bootstrap-filestyle.min.js"></script> 
    <script type="text/javascript" src="js/bootstrap.min.js"></script> 
    <script type="text/javascript" src="js/templatemo-script.js"></script>
    <footer class="text-right">
           <p>Copyright &copy; 2024 Hmc-PMS | Developed by
              <a href="#" target="_parent">Hmc FutureTechnologies</a>
          </footer>         
        </div>
      </div>
    </div>
</body>
</html>
