<?php
session_start();

// Redirect if the user is not logged in
if (!isset($_SESSION['priusername'])) {
    header("Location: index.php");
    exit();
}
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
    <title>Queries</title>
    <meta name="description" content="">
    <meta name="author" content="templatemo">

    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,700' rel='stylesheet'
        type='text/css'>
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/templatemo-style.css" rel="stylesheet">
    <!-- Footer -->
    <link type="text/css" rel="stylesheet" href="../../Homepage/css/style.css">

    <style>
        body {
            background-color: #f9f9f9;
        }

        .table th,
        .table td {
            vertical-align: middle;
            text-align: center;
        }
    </style>

    <!-- HTML5 shim and Respond.js for IE8 support -->
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
                    <table class="table table-striped table-bordered templatemo-user-table" id="studentTable">
                        <thead>
                            <tr>
                                <th><a class="white-text templatemo-sort-by" onclick="sortTable(0)">First Name</a></th>
                                <th><a class="white-text templatemo-sort-by" onclick="sortTable(1)">Last Name</a></th>
                                <th><a class="white-text templatemo-sort-by" onclick="sortTable(2)">USN</a></th>
                                <th><a class="white-text templatemo-sort-by" onclick="sortTable(3)">Mobile</a></th>
                                <th><a class="white-text templatemo-sort-by" onclick="sortTable(4)">Email</a></th>
                                <th><a class="white-text templatemo-sort-by" onclick="sortTable(5)">DOB</a></th>
                                <th><a class="white-text templatemo-sort-by" onclick="sortTable(6)">Sem</a></th>
                                <th><a class="white-text templatemo-sort-by" onclick="sortTable(7)">Branch</a></th>
                                <th><a class="white-text templatemo-sort-by" onclick="sortTable(8)">SSLC</a></th>
                                <th><a class="white-text templatemo-sort-by" onclick="sortTable(9)">PU/Dip</a></th>
                                <th><a class="white-text templatemo-sort-by" onclick="sortTable(10)">BE</a></th>
                                <th><a class="white-text templatemo-sort-by" onclick="sortTable(11)">Backlogs</a></th>
                                <th><a class="white-text templatemo-sort-by" onclick="sortTable(12)">History Of
                                        Backlogs</a></th>
                                <th><a class="white-text templatemo-sort-by" onclick="sortTable(13)">Detain Years</a>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Database connection
                            $conn = new mysqli('localhost', 'harsh', 'harsh2005', 'placement');

                            // Check connection
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }

                            if (isset($_POST['s1']) && !empty($_POST['sname'])) {
                                $Sname = $conn->real_escape_string(trim($_POST['sname']));

                                // Fetch count of students matching the search criteria
                                $countQuery = "SELECT COUNT(*) as count FROM basicdetails WHERE `Approve`='1' AND (`FirstName` LIKE '%$Sname%' OR `LastName` LIKE '%$Sname%')";
                                $RESULT = $conn->query($countQuery);
                                $data = $RESULT->fetch_assoc();
                                echo "<br><h3>Number of Students with Name '$Sname': {$data['count']}</h3>";

                                // Fetch students' details
                                $sql = "SELECT * FROM basicdetails WHERE `Approve`='1' AND (`FirstName` LIKE '%$Sname%' OR `LastName` LIKE '%$Sname%')";
                                $result = $conn->query($sql);

                                // Check if there are results and output rows
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo '<td>' . htmlspecialchars($row['FirstName']) . '</td>';
                                        echo '<td>' . htmlspecialchars($row['LastName']) . '</td>';
                                        echo '<td>' . htmlspecialchars($row['USN']) . '</td>';
                                        echo '<td>' . htmlspecialchars($row['Mobile']) . '</td>';
                                        echo '<td>' . htmlspecialchars($row['Email']) . '</td>';
                                        echo '<td>' . htmlspecialchars($row['DOB']) . '</td>';
                                        echo '<td>' . htmlspecialchars($row['Sem']) . '</td>';
                                        echo '<td>' . htmlspecialchars($row['Branch']) . '</td>';
                                        echo '<td>' . htmlspecialchars($row['SSLC']) . '</td>';
                                        echo '<td>' . htmlspecialchars($row['PU/Dip']) . '</td>';
                                        echo '<td>' . htmlspecialchars($row['BE']) . '</td>';
                                        echo '<td>' . htmlspecialchars($row['Backlogs']) . '</td>';
                                        echo '<td>' . htmlspecialchars($row['HofBacklogs']) . '</td>';
                                        echo '<td>' . htmlspecialchars($row['DetainYears']) . '</td>';
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='14'>No students found.</td></tr>";
                                }
                            }
                            // Close the database connection
                            $conn->close();
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
        function sortTable(n) {
            var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
            table = document.getElementById("studentTable");
            switching = true;
            dir = "asc"; // Set the sorting direction to ascending

            // Loop until no switching is needed
            while (switching) {
                switching = false;
                rows = table.rows;

                // Loop through all table rows (except the first, which contains table headers)
                for (i = 1; i < (rows.length - 1); i++) {
                    shouldSwitch = false;
                    x = rows[i].getElementsByTagName("TD")[n];
                    y = rows[i + 1].getElementsByTagName("TD")[n];

                    // Check the direction of sorting and compare two rows
                    if (dir == "asc") {
                        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                            shouldSwitch = true;
                            break;
                        }
                    } else if (dir == "desc") {
                        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                            shouldSwitch = true;
                            break;
                        }
                    }
                }
                if (shouldSwitch) {
                    // If a switch has been marked, make the switch and mark that a switch has been done
                    rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                    switching = true;
                    switchcount++;
                } else {
                    // If no switching has been done and the direction is "asc", set the direction to "desc" and run the while loop again
                    if (switchcount == 0 && dir == "asc") {
                        dir = "desc";
                        switching = true;
                    }
                }
            }
        }

        $(document).ready(function () {
            $('.templatemo-sort-by').on('click', function () {
                var column = $(this).index();
                sortTable(column);
            });
        });
    </script>
</body>

</html>