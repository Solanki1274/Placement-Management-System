<?php
session_start();
if (isset($_SESSION["priusername"])) {

} else {
    header("location: index.php");
}
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
    <title>Student Details</title>
    <meta name="description" content="">
    <meta name="author" content="templatemo">   
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
            <h1>Welcome, <?php echo $_SESSION['priusername']; ?></h1>
        </header>
        <div class="profile-photo-container">
            <img src="images/profile-photo.jpg" alt="Profile Photo" class="img-responsive">
            <div class="profile-photo-overlay"></div>
        </div>
        <form class="templatemo-search-form" role="search">
            <div class="input-group">
                <button type="submit" class="fa fa-search"></button>
                <input type="text" class="form-control" placeholder="Search" name="srch-term" id="srch-term">
            </div>
        </form>
        <nav class="templatemo-left-nav">
        <ul>
          <li><a href="login.php" ><i class="fa fa-home fa-fw" ></i>Dashboard</a></li>
          <li><a href="Students Eligibility.php" ><i class="fa fa-bar-chart fa-fw"></i>Check Students Eligibility</a>
          </li>
          <li><a href="queries.php"><i class="fa fa-database fa-fw"></i>Queries</a></li>
          <li><a href="manage-users.php" class="active"><i class="fa fa-users fa-fw"></i>Student Details</a></li>
          <li><a href="manage-company.php"><i class="fa fa-users fa-fw"></i>Manage Company</a></li>
          <li><a href="manage-hod.php"><i class="fa fa-users fa-fw"></i>Manage HOD</a></li>
          <li><a href="logout.php"><i class="fa fa-eject fa-fw"></i>Sign Out</a></li>
        </ul>
      </nav>
    </div>

    <div class="templatemo-content col-1 light-gray-bg">
        <div class="templatemo-top-nav-container">
            <nav class="templatemo-top-nav col-lg-12 col-md-12">
                <ul class="text-uppercase">
                    <li><a href="../../Homepage/index.php">Home CIT-PMS</a></li>
                    <li><a href="../../Drives/index.php">Drives Homepage</a></li>
                    <li><a href="Notif.php">Notification</a></li>
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
                                <td>Company Name</td>
                                <td>USername</td>
                                <td>Password</td>
                                <td>Email</td>
                                <td>Sequirity Question</td>
                                <td>Answer</td>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $num_rec_per_page = 15;
                            $connect = new mysqli('localhost', 'harsh', 'harsh2005', 'placement');
                            if ($connect->connect_error) {
                                die("Connection failed: " . $connect->connect_error);
                            }

                            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                            $start_from = ($page - 1) * $num_rec_per_page;

                            $sql = "SELECT * FROM plogin WHERE Approve = '1' ORDER BY Name DESC LIMIT ?, ?";
                            $stmt = $connect->prepare($sql);
                            $stmt->bind_param("ii", $start_from, $num_rec_per_page);
                            $stmt->execute();
                            $rs_result = $stmt->get_result();

                            if ($rs_result->num_rows > 0) {
                                while ($row = $rs_result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $row['Name'] . "</td>";
                                    echo "<td>" . $row['Username'] . "</td>";
                                    echo "<td>" . $row['Password'] . "</td>";
                                    echo "<td>" . $row['Email'] . "</td>";
                                    echo "<td>" . $row['Question'] . "</td>";
                                    echo "<td>" . $row['Answer'] . "</td>";
                                    
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='14'>No records found.</td></tr>";
                            }

                            $stmt->close();
                            $connect->close();
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="pagination-wrap">
                <ul class="pagination">
                    <?php
                    $connect = new mysqli('localhost', 'harsh', 'harsh2005', 'placement');
                    $sql = "SELECT COUNT(*) FROM basicdetails WHERE Approve = '1'";
                    $result = $connect->query($sql);
                    $row = $result->fetch_row();
                    $total_records = $row[0];
                    $total_pages = ceil($total_records / $num_rec_per_page);

                    if ($page > 1) {
                        echo "<li><a href='manage-users.php?page=" . ($page - 1) . "'><</a></li>";
                    }

                    for ($i = max(1, $page - 2); $i <= min($page + 2, $total_pages); $i++) {
                        echo "<li><a href='manage-users.php?page=" . $i . "'>" . $i . "</a></li>";
                    }

                    if ($page < $total_pages) {
                        echo "<li><a href='manage-users.php?page=" . ($page + 1) . "'>></a></li>";
                    }

                    echo "<li><a>Total Pages: " . $total_pages . "</a></li>";
                    $connect->close();
                    ?>
                </ul>
            </div>

            <footer class="text-right">
                <p>Copyright &copy; 2024 Hmc-PMS | Developed by <a href="#" target="_parent">Hmc FutureTechnologies</a></p>
            </footer>
        </div>
    </div>
</div>

<script src="js/jquery-1.11.2.min.js"></script>
<script src="js/templatemo-script.js"></script>

</body>
</html>
