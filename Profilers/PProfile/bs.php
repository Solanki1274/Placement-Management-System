<?php
session_start();
if (isset($_SESSION['pusername'])) {
    // User is logged in
} else {
    header("location: index.php");
    die("You must be logged in to view this page <a href='index.php'>Click here</a>");
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
    <title>Manage Students</title>
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
            <center><h2>Approved Students List of Basic Science</h2></center>
            <div class="templatemo-content-widget no-padding">
                <div class="panel panel-default table-responsive">
                    <table class="table table-striped table-bordered templatemo-user-table">
                        <thead>
                            <tr>
                                <td><a class="white-text templatemo-sort-by">First Name</a></td>
                                <td><a class="white-text templatemo-sort-by">Last Name</a></td>
                                <td><a class="white-text templatemo-sort-by">USN</a></td>
                                <td><a class="white-text templatemo-sort-by">Mobile</a></td>
                                <td><a class="white-text templatemo-sort-by">Email</a></td>
                                <td><a class="white-text templatemo-sort-by">DOB</a></td>
                                <td><a class="white-text templatemo-sort-by">Sem</a></td>
                                <td><a class="white-text templatemo-sort-by">Branch</a></td>
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
                        $num_rec_per_page = 2;
                        $link = mysqli_connect('localhost', 'harsh', 'harsh2005', 'details');

                        if (!$link) {
                            die("Connection failed: " . mysqli_connect_error());
                        }

                        $page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
                        $start_from = ($page - 1) * $num_rec_per_page;

                        $sql = "SELECT * FROM basicdetails WHERE Approve='1' AND Branch='Basic Science' LIMIT $start_from, $num_rec_per_page";
                        $result = mysqli_query($link, $sql);

                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['FirstName']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['LastName']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['USN']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['Mobile']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['Email']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['DOB']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['Sem']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['Branch']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['SSLC']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['PU/Dip']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['BE']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['Backlogs']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['HofBacklogs']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['DetainYears']) . "</td>";
                            echo "</tr>";
                        }

                        mysqli_close($link);
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="pagination-wrap">
            <ul class="pagination">
                <?php
                $link = mysqli_connect('localhost', 'harsh', 'harsh2005', 'details');

                if (!$link) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                $sql = "SELECT * FROM basicdetails WHERE Approve='1' AND Branch='Basic Science'";
                $result = mysqli_query($link, $sql);
                $total_records = mysqli_num_rows($result);
                $total_pages = ceil($total_records / $num_rec_per_page);

                if ($page > 1) {
                    $prev = $page - 1;
                    echo "<li><a href='bs.php?page=".$prev."'><</a></li>";
                }

                for ($i = 1; $i <= $total_pages; $i++) {
                    if ($i == $page) {
                        echo "<li class='active'><a href='bs.php?page=".$i."'>".$i."</a></li>";
                    } else {
                        echo "<li><a href='bs.php?page=".$i."'>".$i."</a></li>";
                    }
                }

                if ($page < $total_pages) {
                    $nxt = $page + 1;
                    echo "<li><a href='bs.php?page=".$nxt."'>></a></li>";
                }

                echo "<li><a>Total Pages: ".$total_pages."</a></li>";

                mysqli_close($link);
                ?>
            </ul>
        </div>
    </div>
</body>
</html>
