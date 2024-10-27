<?php
session_start();
if (!isset($_SESSION['pusername'])) {
    header("location: index.php");
    exit();
}
echo "Welcome, " . htmlspecialchars($_SESSION['pusername']) . "!";
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
    <title>QUERIES</title>
    <meta name="description" content="">
    <meta name="author" content="templatemo">
    
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,700' rel='stylesheet' type='text/css'>
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/templatemo-style.css" rel="stylesheet">
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="bg">
    <div class="templatemo-content-container">
        <div class="templatemo-content-widget no-padding">
            <?php
            // Establish database connection
            $connection = new mysqli('localhost', 'harsh', 'harsh2005', 'placement');

            // Check for connection errors
            if ($connection->connect_error) {
                die("Connection failed: " . $connection->connect_error);
            }

            if (isset($_POST['s2'])) { 
                $Susn = $connection->real_escape_string($_POST['susn']);
                $result = $connection->query("SELECT * FROM basicdetails WHERE USN='$Susn'");

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    echo "<br><h3>Details of Student '$Susn'&nbsp:&nbsp</h3>";
                    echo "<center><table>";
                    echo "<tr><td>First Name :</td><td>" . htmlspecialchars($row['FirstName']) . "</td></tr>";
                    echo "<tr><td>Last Name :</td><td>" . htmlspecialchars($row['LastName']) . "</td></tr>";
                    echo "<tr><td>USN :</td><td>" . htmlspecialchars($row['USN']) . "</td></tr>";
                    echo "<tr><td>Mobile :</td><td>" . htmlspecialchars($row['Mobile']) . "</td></tr>";
                    echo "<tr><td>Email :</td><td>" . htmlspecialchars($row['Email']) . "</td></tr>";
                    echo "<tr><td>DOB :</td><td>" . htmlspecialchars($row['DOB']) . "</td></tr>";
                    echo "<tr><td>Semester :</td><td>" . htmlspecialchars($row['Sem']) . "</td></tr>";
                    echo "<tr><td>Branch :</td><td>" . htmlspecialchars($row['Branch']) . "</td></tr>";
                    echo "<tr><td>SSLC Percentage :</td><td>" . htmlspecialchars($row['SSLC']) . "</td></tr>";
                    echo "<tr><td>PU/Diploma Percentage :</td><td>" . htmlspecialchars($row['PU/Dip']) . "</td></tr>";
                    echo "<tr><td>BE Aggregate :</td><td>" . htmlspecialchars($row['BE']) . "</td></tr>";
                    echo "<tr><td>Current Backlogs :</td><td>" . htmlspecialchars($row['Backlogs']) . "</td></tr>";
                    echo "<tr><td>History of Backlogs :</td><td>" . htmlspecialchars($row['HofBacklogs']) . "</td></tr>";
                    echo "<tr><td>Detain Years :</td><td>" . htmlspecialchars($row['DetainYears']) . "</td></tr>";
                    echo "</table></center>";
                } else {
                    echo "<h3>No student found with USN '$Susn'.</h3>";
                }
            }

            // Close the connection
            $connection->close();
            ?>
            <footer class="text-right">
                <p>Copyright &copy; 2024 Hmc-PMS | Developed by
                    <a href="#" target="_parent">Hmc FutureTechnologies</a>
                </p>
            </footer>
        </div>
    </div>
</div>    
<!-- JS -->
<script type="text/javascript" src="js/jquery-1.11.2.min.js"></script> <!-- jQuery -->
<script type="text/javascript" src="js/templatemo-script.js"></script> <!-- Templatemo Script -->
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
