<?php
session_start();
if(!isset($_SESSION["pusername"])){
    header("location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    <title>Company Details</title>
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/templatemo-style.css" rel="stylesheet">
</head>
<body>  
<div class="templatemo-flex-row">
    <div class="templatemo-sidebar">
        <header class="templatemo-site-header">
            <h1>Welcome, <?php echo $_SESSION['pusername']; ?></h1>
        </header>
        <nav class="templatemo-left-nav">          
            <ul>
                <li><a href="login.php">Dashboard</a></li> 
                <li><a href="Placement Drives.php">Placement Drives</a></li>           
                <li><a href="manage-users.php">View Students</a></li>
                <li><a href="queries.php">Queries</a></li>
                <li><a href="Students Eligibility.php" class="active">Students Eligibility Status</a></li>
                <li><a href="logout.php">Sign Out</a></li>
            </ul>  
        </nav>
    </div>
    <div class="templatemo-content col-1 light-gray-bg">
        <div class="templatemo-top-nav-container">
            <nav class="templatemo-top-nav">
                <ul class="text-uppercase">
                    <li><a href="../../Homepage/index.php">Home CIT-PMS</a></li>
                    <li><a href="">Drives Home</a></li>
                    <li><a href="Notif.php">Notifications</a></li>
                    <li><a href="Change Password.php">Change Password</a></li>
                </ul>   
            </nav> 
        </div>
        <div class="templatemo-content-container">
            <div class="templatemo-content-widget no-padding">
                <div class="panel panel-default table-responsive">
                    <table class="table table-striped table-bordered templatemo-user-table">
                        <thead>
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>USN</th>
                                <th>Mobile</th>
                                <th>Email</th>
                                <th>DOB</th>
                                <th>Current Sem</th>
                                <th>Branch</th>
                                <th>SSLC Percentage</th>
                                <th>PU Percentage</th>
                                <th>BE Aggregate</th>
                                <th>Current Backlogs</th>
                                <th>History of Backlogs</th>
                                <th>Detain Years</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $num_rec_per_page = 15;
                            $conn = new mysqli('localhost', 'harsh', 'harsh2005', 'placement');
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }

                            $page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
                            $start_from = ($page - 1) * $num_rec_per_page;

                            $sql = "SELECT * FROM basicdetails WHERE Approve='1' ORDER BY FirstName ASC LIMIT $start_from, $num_rec_per_page";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>{$row['FirstName']}</td>";
                                    echo "<td>{$row['LastName']}</td>";
                                    echo "<td>{$row['USN']}</td>";
                                    echo "<td>{$row['Mobile']}</td>";
                                    echo "<td>{$row['Email']}</td>";
                                    echo "<td>{$row['DOB']}</td>";
                                    echo "<td>{$row['Sem']}</td>";
                                    echo "<td>{$row['Branch']}</td>";
                                    echo "<td>{$row['SSLC']}</td>";
                                    echo "<td>{$row['PU/Dip']}</td>";
                                    echo "<td>{$row['BE']}</td>";
                                    echo "<td>{$row['Backlogs']}</td>";
                                    echo "<td>{$row['HofBacklogs']}</td>";
                                    echo "<td>{$row['DetainYears']}</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='14'>No results found.</td></tr>";
                            }
                            $conn->close();
                            ?>
                        </tbody>
                    </table>  
                </div>
            </div>
            <div class="pagination-wrap">
                <ul class="pagination">
                    <?php
                    $conn = new mysqli('localhost', 'harsh', 'harsh2005', 'placement');
                    $sql = "SELECT * FROM basicdetails WHERE Approve='1'";
                    $result = $conn->query($sql);
                    $total_records = $result->num_rows;
                    $total_pages = ceil($total_records / $num_rec_per_page);

                    if ($page > 1) {
                        echo "<li><a href='eligibility.php?page=" . ($page - 1) . "'><</a></li>";
                    }

                    for ($i = 1; $i <= $total_pages; $i++) {
                        echo "<li><a href='eligibility.php?page=" . $i . "'>" . $i . "</a></li>";
                    }

                    if ($page < $total_pages) {
                        echo "<li><a href='eligibility.php?page=" . ($page + 1) . "'>></a></li>";
                    }
                    $conn->close();
                    ?>
                </ul>
            </div>
            <footer class="text-right">
                <p>&copy; 2024 Hmc-PMS | Developed by <a href="#" target="_parent">Hmc FutureTechnologies</a></p>
            </footer>         
        </div>
    </div>
</div>

<!-- JS -->
<script src="js/jquery-1.11.2.min.js"></script>
<script src="js/templatemo-script.js"></script>
</body>
</html>
