<?php
session_start();

// Database connection
$servername = "localhost";
$username = "harsh";
$password = "harsh2005";
$dbname = "placement";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the user is logged in
if (!isset($_SESSION['husername'])) {
    header("location: index.php");
    die("You must be logged in to view this page <a href='index.php'>Click here</a>");
}

// Initialize variables
$newFirstName = '';
$newLastName = '';
$newEmail = '';
$newUsername = '';
$successMessage = '';
$errorMessage = '';
$duplicateMessage = '';

// Fetch existing user details to show in the form
$username = $_SESSION['husername'];
$result = $conn->query("SELECT Firstname, Lastname, Email, Username FROM hlogin WHERE Username='$username'");
$userDetails = $result->fetch_assoc();

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newFirstName = isset($_POST['inputFirstName']) ? $_POST['inputFirstName'] : '';
    $newLastName = isset($_POST['inputLastName']) ? $_POST['inputLastName'] : '';
    $newEmail = isset($_POST['inputEmail']) ? $_POST['inputEmail'] : '';
    $newUsername = isset($_POST['inputUsername']) ? $_POST['inputUsername'] : '';

    // Check if the new values are the same as the existing values
    if ($newFirstName === $userDetails['Firstname'] && $newLastName === $userDetails['Lastname'] &&
        $newEmail === $userDetails['Email'] && $newUsername === $userDetails['Username']) {
        $duplicateMessage = "No changes made. Data is already up to date!";
    } else {
        // Prepare the SQL update statement
        $updateSql = "UPDATE hlogin SET Firstname=?, Lastname=?, Email=?, Username=? WHERE Username=?";
        $stmt = $conn->prepare($updateSql);
        $stmt->bind_param("sssss", $newFirstName, $newLastName, $newEmail, $newUsername, $username);

        if ($stmt->execute()) {
            $successMessage = "Details updated successfully!";
            $_SESSION['husername'] = $newUsername; // Update session username if changed
        } else {
            $errorMessage = "Error updating details: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Update Profile</title>
    <script>
        // JavaScript function to show alert message if update is successful
        function showAlert(message) {
            alert(message);
        }
    </script>
</head>

<body>
    <?php if (!empty($successMessage)): ?>
        <script>
            showAlert("<?php echo $successMessage; ?>");
        </script>
    <?php endif; ?>

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
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,700' rel='stylesheet'
            type='text/css'>
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
                    echo "<h1>" . $Welcome . "<br>" . $_SESSION['husername'] . "</h1>";
                    echo "<h1>(</h1>";
                    echo "<h1>" . $_SESSION['department'] . "</h1>";
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
                        <li><a href="view-students.php"><i class="fa fa-users fa-fw"></i>View Students</a></li>
                        <li><a href="preferences.php" class="active"><i class="fa fa-sliders fa-fw"></i>Preferences</a>
                        </li>
                        <li><a href="manage-students.php"><i class="fa fa-sliders fa-fw"></i>Manage Students</a></li>
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
                    <div class="templatemo-content-widget white-bg">
                        <h2 class="margin-bottom-10">Preferences</h2>
                        <p>Update your Details here:</p>
                        <form action="" class="templatemo-login-form" method="post" enctype="multipart/form-data">
                            <div class="row form-group">
                                <div class="col-lg-6 col-md-6 form-group">
                                    <label for="inputFirstName">First Name</label>
                                    <input type="text" class="form-control" id="inputFirstName" name="inputFirstName"
                                        value="<?php echo htmlspecialchars($userDetails['Firstname'] ?? ''); ?>"
                                        required>
                                </div>
                                <div class="col-lg-6 col-md-6 form-group">
                                    <label for="inputLastName">Last Name</label>
                                    <input type="text" class="form-control" id="inputLastName" name="inputLastName"
                                        value="<?php echo htmlspecialchars($userDetails['Lastname'] ?? ''); ?>"
                                        required>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-lg-6 col-md-6 form-group">
                                    <label for="inputUsername">Username</label>
                                    <input type="text" class="form-control" id="inputUsername" name="inputUsername"
                                        value="<?php echo htmlspecialchars($_SESSION['husername']); ?>" required>
                                </div>
                                <div class="col-lg-6 col-md-6 form-group">
                                    <label for="inputEmail">Email</label>
                                    <input type="email" class="form-control" id="inputEmail" name="inputEmail"
                                        value="<?php echo htmlspecialchars($userDetails['Email'] ?? ''); ?>" required>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-lg-12">
                                    <label class="control-label templatemo-block">Profile Photo</label>
                                    <input type="file" name="fileToUpload" id="fileToUpload" class="filestyle"
                                        data-buttonName="btn-primary" data-buttonBefore="true" data-icon="false">
                                    <p>Maximum upload size is 5 MB. Current file:
                                        <?php echo htmlspecialchars($userDetails['ProfilePhoto'] ?? 'None'); ?>
                                    </p>
                                </div>
                            </div>
                            <div class="form-group text-right">
                                <button type="submit" class="templatemo-blue-button">Update</button>
                                <button type="reset" class="templatemo-white-button">Reset</button>
                            </div>
                        </form>

                        <!-- Modal for success/error messages -->
                        <div class="modal fade" id="successModal" tabindex="-1" role="dialog"
                            aria-labelledby="successModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="successModalLabel">Success!</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <?php if (!empty($successMessage)): ?>
                                            <p><?php echo $successMessage; ?></p>
                                        <?php endif; ?>
                                        <?php if (!empty($duplicateMessage)): ?>
                                            <p><?php echo $duplicateMessage; ?></p>
                                        <?php endif; ?>
                                        <?php if (!empty($errorMessage)): ?>
                                            <p><?php echo $errorMessage; ?></p>
                                        <?php endif; ?>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <script>
                            $(document).ready(function () {
                                // Show modal if there is a success message or an error message
                                <?php if (!empty($successMessage) || !empty($duplicateMessage) || !empty($errorMessage)): ?>
                                    $('#successModal').modal('show');
                                <?php endif; ?>
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
        <footer class="text-right">
            <p>Copyright &copy; 2024 Hmc-PMS | Developed by
                <a href="#" target="_parent">Hmc FutureTechnologies</a>
        </footer>
        </div>
        </div>
        </div>
        <script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
        <script type="text/javascript" src="js/bootstrap-filestyle.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/templatemo-script.js"></script>
    </body>

    </html>