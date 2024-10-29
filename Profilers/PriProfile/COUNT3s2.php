<?php
session_start();
if (!isset($_SESSION['priusername'])) {
    header("location: index.php");
    exit();
}

// Database connection
$connection = mysqli_connect('localhost', 'harsh', 'harsh2005', 'placement');
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

$studentDetails = null;

if (isset($_POST['s2'])) {
    $Susn = mysqli_real_escape_string($connection, $_POST['susn']);
    $result = mysqli_query($connection, "SELECT * FROM basicdetails WHERE USN='$Susn'");
    $studentDetails = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="favicon.ico" type="image/icon">
    <link rel="icon" href="favicon.ico" type="image/icon">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    <title>Student Queries</title>
    <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/templatemo-style.css" rel="stylesheet">
    <style>
        body {
            background-image: url('../images/bg.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            color: #333;
            font-family: 'Roboto', sans-serif;
        }
        .templatemo-content-container {
            background-color: rgba(255, 255, 255, 0.9); /* White background with transparency */
            border-radius: 10px;
            padding: 20px;
            margin: 30px auto;
            max-width: 800px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        h3 {
            text-align: center;
            color: #007bff; /* Bootstrap primary color */
            margin-bottom: 20px;
        }
        table {
            margin: 0 auto;
            border-collapse: collapse;
            width: 100%;
            background-color: white;
            border-radius: 5px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        td {
            padding: 15px;
            border: 1px solid #dee2e6;
            text-align: left;
            font-size: 16px;
        }
        td:first-child {
            font-weight: 500; /* Bold for field labels */
            color: #555;
        }
        footer {
            text-align: center;
            padding: 15px;
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            position: relative;
            bottom: 0;
            width: 100%;
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="bg">
    <div class="templatemo-content-container">
        <div class="templatemo-content-widget no-padding">
            <?php if ($studentDetails): ?>
                <h3>Details of Student '<?php echo htmlspecialchars($Susn); ?>'</h3>
                <center>
                    <table>
                        <tr><td>First Name:</td><td><?php echo htmlspecialchars($studentDetails['FirstName']); ?></td></tr>
                        <tr><td>Last Name:</td><td><?php echo htmlspecialchars($studentDetails['LastName']); ?></td></tr>
                        <tr><td>USN:</td><td><?php echo htmlspecialchars($studentDetails['USN']); ?></td></tr>
                        <tr><td>Mobile:</td><td><?php echo htmlspecialchars($studentDetails['Mobile']); ?></td></tr>
                        <tr><td>Email:</td><td><?php echo htmlspecialchars($studentDetails['Email']); ?></td></tr>
                        <tr><td>DOB:</td><td><?php echo htmlspecialchars($studentDetails['DOB']); ?></td></tr>
                        <tr><td>Semester:</td><td><?php echo htmlspecialchars($studentDetails['Sem']); ?></td></tr>
                        <tr><td>Branch:</td><td><?php echo htmlspecialchars($studentDetails['Branch']); ?></td></tr>
                        <tr><td>SSLC Percentage:</td><td><?php echo htmlspecialchars($studentDetails['SSLC']); ?></td></tr>
                        <tr><td>PU/Diploma Percentage:</td><td><?php echo htmlspecialchars($studentDetails['PU/Dip']); ?></td></tr>
                        <tr><td>BE Aggregate:</td><td><?php echo htmlspecialchars($studentDetails['BE']); ?></td></tr>
                        <tr><td>Current Backlogs:</td><td><?php echo htmlspecialchars($studentDetails['Backlogs']); ?></td></tr>
                        <tr><td>History of Backlogs:</td><td><?php echo htmlspecialchars($studentDetails['HofBacklogs']); ?></td></tr>
                        <tr><td>Detain Years:</td><td><?php echo htmlspecialchars($studentDetails['DetainYears']); ?></td></tr>
                    </table>
                </center>
            <?php else: ?>
                <h3>No student details found.</h3>
            <?php endif; ?>
        </div>
    </div>
</div>

<footer>
    <p>Copyright &copy;2024 Hmc-PMS | Developed by <a href="#" target="_parent" style="color: #f8f9fa;">Hmc FutureTechnologies</a></p>
</footer>

<!-- JS -->
<script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="js/templatemo-script.js"></script>
<script>
    $(document).ready(function(){
        // Content widget with background image
        var imageUrl = $('img.content-bg-img').attr('src');
        $('.templatemo-content-img-bg').css('background-image', 'url('../images/bg.jpg')');
        $('img.content-bg-img').hide();
    });
</script>
</body>
</html>
