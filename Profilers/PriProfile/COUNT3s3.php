<?php
session_start();
if (!isset($_SESSION['priusername'])) {
    header("location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- favicon -->
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

    <!-- Add custom styles for better visibility -->
    <style>
        body {
            background-color: #f9f9f9;
        }
        .templatemo-user-table th {
            cursor: pointer;
        }
        .table th, .table td {
            vertical-align: middle;
            text-align: center;
        }
    </style>
    
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
                            <th><a class="white-text templatemo-sort-by">Sem</a></th>
                            <th><a class="white-text templatemo-sort-by">Branch</a></th>
                            <th><a class="white-text templatemo-sort-by">First Name</a></th>
                            <th><a class="white-text templatemo-sort-by">Last Name</a></th>
                            <th><a class="white-text templatemo-sort-by">USN</a></th>
                            <th><a class="white-text templatemo-sort-by">Mobile</a></th>
                            <th><a class="white-text templatemo-sort-by">Email</a></th>
                            <th><a class="white-text templatemo-sort-by">DOB</a></th>
                            <th><a class="white-text templatemo-sort-by">SSLC</a></th>
                            <th><a class="white-text templatemo-sort-by">PU/Dip</a></th>
                            <th><a class="white-text templatemo-sort-by">BE</a></th>
                            <th><a class="white-text templatemo-sort-by">Backlogs</a></th>
                            <th><a class="white-text templatemo-sort-by">History Of Backlogs</a></th>
                            <th><a class="white-text templatemo-sort-by">Detain Years</a></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Database connection
                        $connection = mysqli_connect('localhost', 'harsh', 'harsh2005', 'placement');

                        // Check connection
                        if (!$connection) {
                            die("Connection failed: " . mysqli_connect_error());
                        }

                        if (isset($_POST['s3'])) { 
                            $Csem = mysqli_real_escape_string($connection, $_POST['csem']);
                            
                            // Query to count the students
                            $result = mysqli_query($connection, "SELECT COUNT(*) AS total_students FROM basicdetails WHERE `Approve`='1' AND Sem='$Csem'");
                            
                            // Fetch the count result
                            if ($result) {
                                $data = mysqli_fetch_assoc($result);
                                echo "<br><h3>Students in Semester '$Csem'&nbsp:&nbsp" . $data['total_students'] . "</h3>";
                            } else {
                                echo "Error: " . mysqli_error($connection);
                            }

                            // Query to get the details of students
                            $sql = mysqli_query($connection, "SELECT * FROM basicdetails WHERE `Approve`='1' AND Sem='$Csem' ORDER BY Branch");
                            
                            // Check if the second query was successful
                            if ($sql) {
                                while ($row = mysqli_fetch_assoc($sql)) {
                                    // Display each student's details in table rows
                                    echo "<tr>";
                                    echo "<td>" . htmlspecialchars($row['Sem']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['Branch']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['FirstName']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['LastName']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['USN']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['Mobile']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['Email']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['DOB']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['SSLC']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['PU/Dip']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['BE']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['Backlogs']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['HofBacklogs']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['DetainYears']) . "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "Error: " . mysqli_error($connection);
                            }
                        }

                        // Close the connection
                        mysqli_close($connection);
                        ?>
                    </tbody>
                </table>  
            </div>
        </div>
    </div>
    <footer class="text-right">
        <p>Copyright &copy; 2024 Hmc-PMS | Developed by <a href="#" target="_parent">Hmc FutureTechnologies</a></p>
    </footer>         
</div>
</div>
<!-- JS -->
<script type="text/javascript" src="js/jquery-1.11.2.min.js"></script> <!-- jQuery -->
<script type="text/javascript" src="js/templatemo-script.js"></script> <!-- Templatemo Script -->
<script>
$(document).ready(function() {
    // Sort functionality
    $('.templatemo-sort-by').click(function() {
        var table = $(this).parents('table');
        var tbody = table.find('tbody');
        var rows = tbody.find('tr').toArray().sort(comparer($(this).index()));

        this.asc = !this.asc; // Toggle ascending and descending
        if (!this.asc) {
            rows = rows.reverse();
        }
        tbody.append(rows);
    });

    function comparer(index) {
        return function(a, b) {
            var valA = getCellValue(a, index), valB = getCellValue(b, index);
            return $.isNumeric(valA) && $.isNumeric(valB) ? valA - valB : valA.localeCompare(valB);
        }
    }

    function getCellValue(row, index) {
        return $(row).children('td').eq(index).text();
    }
});
</script>
</body>
</html>
