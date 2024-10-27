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
    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico" type="image/icon">
    <link rel="icon" href="favicon.ico" type="image/icon">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage Students</title>
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
</head>
<body>
<div class="bg">
    <div class="templatemo-content-container">
        <div class="templatemo-content-widget no-padding">
            <div class="panel panel-default table-responsive">
                <table class="table table-striped table-bordered templatemo-user-table">
                    <thead>
                    <tr>
                        <td><a class="white-text templatemo-sort-by">Sem</a></td>
                        <td><a class="white-text templatemo-sort-by">Branch</a></td>
                        <td><a class="white-text templatemo-sort-by">First Name</a></td>
                        <td><a class="white-text templatemo-sort-by">Last Name</a></td>
                        <td><a class="white-text templatemo-sort-by">USN</a></td>
                        <td><a class="white-text templatemo-sort-by">Mobile</a></td>
                        <td><a class="white-text templatemo-sort-by">Email</a></td>
                        <td><a class="white-text templatemo-sort-by">DOB</a></td>
                        <td><a class="white-text templatemo-sort-by">SSLC</a></td>
                        <td><a class="white-text templatemo-sort-by">PU/Dip</a></td>
                        <td><a class="white-text templatemo-sort-by">BE</a></td>
                        <td><a class="white-text templatemo-sort-by">Backlogs</a></td>
                        <td><a class="white-text templatemo-sort-by">History Of Backlogs</a></td>
                        <td><a class="white-text templatemo-sort-by">Detain Years</a></td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    // Database connection
                    $conn = new mysqli('localhost', 'harsh', 'harsh2005', 'placement');
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    if (isset($_POST['s3'])) {
                        $Csem = $conn->real_escape_string($_POST['csem']);

                        // Count students
                        $stmt = $conn->prepare("SELECT COUNT(*) FROM basicdetails WHERE `Approve` = '1' AND Sem = ?");
                        $stmt->bind_param("s", $Csem);
                        $stmt->execute();
                        $stmt->bind_result($count);
                        $stmt->fetch();
                        $stmt->close();

                        echo "<br><h3>Students in Semester '$Csem': $count</h3>";

                        // Fetch students data
                        $stmt = $conn->prepare("SELECT * FROM basicdetails WHERE `Approve` = '1' AND Sem = ? ORDER BY Branch");
                        $stmt->bind_param("s", $Csem);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>" . htmlspecialchars($row['Sem']) . "</td>
                                    <td>" . htmlspecialchars($row['Branch']) . "</td>
                                    <td>" . htmlspecialchars($row['FirstName']) . "</td>
                                    <td>" . htmlspecialchars($row['LastName']) . "</td>
                                    <td>" . htmlspecialchars($row['USN']) . "</td>
                                    <td>" . htmlspecialchars($row['Mobile']) . "</td>
                                    <td>" . htmlspecialchars($row['Email']) . "</td>
                                    <td>" . htmlspecialchars($row['DOB']) . "</td>
                                    <td>" . htmlspecialchars($row['SSLC']) . "</td>
                                    <td>" . htmlspecialchars($row['PU/Dip']) . "</td>
                                    <td>" . htmlspecialchars($row['BE']) . "</td>
                                    <td>" . htmlspecialchars($row['Backlogs']) . "</td>
                                    <td>" . htmlspecialchars($row['HofBacklogs']) . "</td>
                                    <td>" . htmlspecialchars($row['DetainYears']) . "</td>
                                  </tr>";
                        }
                        $stmt->close();
                    }
                    $conn->close();
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <footer class="text-right">
        <p>Copyright &copy; 2024 Hmc-PMS | Developed by
            <a href="#" target="_parent">Hmc FutureTechnologies</a>
        </p>
    </footer>
</div>
<!-- JS -->
<script type="text/javascript" src="js/jquery-1.11.2.min.js"></script> <!-- jQuery -->
<script type="text/javascript" src="js/templatemo-script.js"></script> <!-- Templatemo Script -->
<script>
    $(document).ready(function () {
        // Content widget with background image
        var imageUrl = $('img.content-bg-img').attr('src');
        $('.templatemo-content-img-bg').css('background-image', 'url(' + imageUrl + ')');
        $('img.content-bg-img').hide();
    });
</script>
</body>
</html>
