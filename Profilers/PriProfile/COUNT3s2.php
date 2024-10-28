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
    <title>Queries</title>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,700' rel='stylesheet' type='text/css'>
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/templatemo-style.css" rel="stylesheet">
</head>
<body>
<div class="bg">
    <div class="templatemo-content-container">
        <div class="templatemo-content-widget no-padding">
            <?php if ($studentDetails): ?>
                <h3>Details of Student '<?php echo htmlspecialchars($Susn); ?>'</h3>
                <center>
                    <table>
                        <tr><td>First Name: <?php echo htmlspecialchars($studentDetails['FirstName']); ?></td></tr>
                        <tr><td>Last Name: <?php echo htmlspecialchars($studentDetails['LastName']); ?></td></tr>
                        <tr><td>USN: <?php echo htmlspecialchars($studentDetails['USN']); ?></td></tr>
                        <tr><td>Mobile: <?php echo htmlspecialchars($studentDetails['Mobile']); ?></td></tr>
                        <tr><td>Email: <?php echo htmlspecialchars($studentDetails['Email']); ?></td></tr>
                        <tr><td>DOB: <?php echo htmlspecialchars($studentDetails['DOB']); ?></td></tr>
                        <tr><td>Semester: <?php echo htmlspecialchars($studentDetails['Sem']); ?></td></tr>
                        <tr><td>Branch: <?php echo htmlspecialchars($studentDetails['Branch']); ?></td></tr>
                        <tr><td>SSLC Percentage: <?php echo htmlspecialchars($studentDetails['SSLC']); ?></td></tr>
                        <tr><td>PU/Diploma Percentage: <?php echo htmlspecialchars($studentDetails['PU/Dip']); ?></td></tr>
                        <tr><td>BE Aggregate: <?php echo htmlspecialchars($studentDetails['BE']); ?></td></tr>
                        <tr><td>Current Backlogs: <?php echo htmlspecialchars($studentDetails['Backlogs']); ?></td></tr>
                        <tr><td>History of Backlogs: <?php echo htmlspecialchars($studentDetails['HofBacklogs']); ?></td></tr>
                        <tr><td>Detain Years: <?php echo htmlspecialchars($studentDetails['DetainYears']); ?></td></tr>
                    </table>
                </center>
            <?php else: ?>
                <h3>No student details found.</h3>
            <?php endif; ?>
        </div>
    </div>
</div>

<footer class="text-right">
    <p>Copyright &copy;2024 Hmc-PMS | Developed by <a href="#" target="_parent">Hmc FutureTechnologies</a></p>
</footer>

<!-- JS -->
<script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="js/templatemo-script.js"></script>
<script>
    $(document).ready(function(){
        // Content widget with background image
        var imageUrl = $('img.content-bg-img').attr('src');
        $('.templatemo-content-img-bg').css('background-image', 'url(' + imageUrl + ')');
        $('img.content-bg-img').hide();
    });
</script>
</body>
</html>
