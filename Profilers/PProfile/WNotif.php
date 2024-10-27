<?php
session_start();
if (!isset($_SESSION["pusername"])) {
    header("location: index.php");
    die("You must be logged in to view this page <a href='index.php'>Click here</a>");
}

// Database connection
$connect = mysqli_connect("localhost", "harsh", "harsh2005", "placement");
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

// Handle message form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_message'])) {
    $subject = mysqli_real_escape_string($connect, $_POST['Subject']);
    $message = mysqli_real_escape_string($connect, $_POST['Message']);

    // Insert message into the database (assuming you have a messages table)
    $stmt = $connect->prepare("INSERT INTO messages (subject, message, created_at) VALUES (?, ?, NOW())");
    $stmt->bind_param("ss", $subject, $message);

    if ($stmt->execute()) {
        echo "<script>alert('Message posted successfully!');</script>";
    } else {
        echo "<script>alert('Error posting message: " . $stmt->error . "');</script>";
    }
}

// Handle image upload
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_image'])) {
    $target_dir = "uploads/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check === false) {
        echo "<script>alert('File is not an image.');</script>";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "<script>alert('Sorry, your file is too large.');</script>";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if (!in_array($imageFileType, ["jpg", "png", "jpeg", "gif"])) {
        echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.');</script>";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "<script>alert('Sorry, your file was not uploaded.');</script>";
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            // Insert into database
            $stmt = $connect->prepare("INSERT INTO images (file_path, uploaded_at) VALUES (?, NOW())");
            $stmt->bind_param("s", $target_file);

            if ($stmt->execute()) {
                echo "<script>alert('Image uploaded and saved to database successfully!');</script>";
            } else {
                echo "<script>alert('Error uploading image to database: " . $stmt->error . "');</script>";
            }
        } else {
            echo "<script>alert('Sorry, there was an error uploading your file.');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="favicon.ico" type="image/icon">
    <link rel="icon" href="favicon.ico" type="image/icon">    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Placement - Notifications</title>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,700' rel='stylesheet' type='text/css'>
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/templatemo-style.css" rel="stylesheet">
</head>
<body>
    <div class="templatemo-flex-row">
        <div class="templatemo-sidebar">
            <header class="templatemo-site-header">
                <div class="square"></div>
                <h1>Welcome<br><?php echo $_SESSION['pusername']; ?></h1>
            </header>
            <div class="profile-photo-container">
                <img src="images/profile-photo.jpg" alt="Profile Photo" class="img-responsive">
                <div class="profile-photo-overlay"></div>
            </div>
            <nav class="templatemo-left-nav">
                <ul>
                    <li><a href="login.php"><i class="fa fa-home fa-fw"></i>Dashboard</a></li>
                    <li><a href="Placement Drives.php"><i class="fa fa-home fa-fw"></i>Placement Drives</a></li>
                    <li><a href="manage-users.php"><i class="fa fa-users fa-fw"></i>View Students</a></li>
                    <li><a href="queries.php"><i class="fa fa-users fa-fw"></i>Queries</a></li>
                    <li><a href="Students Eligibility.php"><i class="fa fa-sliders fa-fw"></i>Students Eligibility Status</a></li>
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
                            <li><a href="">Drives Home</a></li>
                            <li><a href="Notif.php" class="active">Notifications</a></li>
                            <li><a href="Change Password.php">Change Password</a></li>
                        </ul>  
                    </nav>
                </div>
            </div>
            <div class="templatemo-content-container">
                <div class="templatemo-content-widget white-bg">
                    <h2 class="margin-bottom-10">Write Messages</h2>
                    <p>Department Notifications to Students</p>
                    <form method="POST" action="">
                        <div class="row form-group">
                            <div class="col-lg-12 form-group">                   
                                <label class="control-label" for="inputNote">Subject:</label>
                                <textarea class="form-control" id="inputNote" rows="2" name="Subject" required></textarea>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-lg-12 form-group">                   
                                <label class="control-label" for="inputNote">Message:</label>
                                <textarea class="form-control" id="inputNote" rows="5" name="Message" required></textarea>
                            </div>
                        </div>
                        <div class="form-group text-right">
                            <button type="submit" name="submit_message" class="templatemo-blue-button">POST</button>
                            <button type="reset" class="templatemo-white-button">Clear</button>
                        </div>
                    </form>

                    <h2 class="margin-top-30">Upload an Image</h2>
                    <p>To Upload an Image, use the form below:</p>
                    <form method="POST" action="" enctype="multipart/form-data">
                        <div class="row form-group">
                            <div class="col-lg-12 form-group">
                                <label class="control-label" for="fileToUpload">Select image to upload:</label>
                                <input type="file" name="fileToUpload" id="fileToUpload" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group text-right">
                            <button type="submit" name="submit_image" class="templatemo-blue-button">Upload Image</button>
                        </div>
                    </form>

                    <footer class="text-right">
                        <p>Copyright &copy; 2024 Hmc-PMS | Developed by
                            <a href="#" target="_parent">Hmc Future Technologies</a>
                        </p>
                    </footer>
                </div>
            </div>
        </div>
    </div>

    <!-- JS -->
    <script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/templatemo-script.js"></script>
</body>
</html>
