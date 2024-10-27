<?php
session_start();
if (!isset($_SESSION['pusername'])) {
    header("location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="favicon.ico" type="image/icon">
    <link rel="icon" href="favicon.ico" type="image/icon">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    <title>Manage Students</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,700" rel="stylesheet" type="text/css">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/templatemo-style.css" rel="stylesheet">
</head>

<body>
<div class="bg">
    <div class="templatemo-content-container">
        <center><h2>Approved Students List of CSE</h2></center>
        <div class="templatemo-content-widget no-padding">
            <div class="panel panel-default table-responsive">
                <table class="table table-striped table-bordered templatemo-user-table">
                    <thead>
                        <tr>
                            <td>First Name</td>
                            <td>Last Name</td>
                            <td>USN</td>
                            <td>Mobile</td>
                            <td>Email</td>
                            <td>DOB</td>
                            <td>Sem</td>
                            <td>Branch</td>
                            <td>SSLC</td>
                            <td>PU/Dip</td>
                            <td>BE</td>
                            <td>Backlogs</td>
                            <td>History Of Backlogs</td>
                            <td>Detain Years</td>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $num_rec_per_page = 2;
                    $connect = new mysqli('localhost', 'harsh', 'harsh2005', 'placement');

                    if ($connect->connect_error) {
                        die("Connection failed: " . $connect->connect_error);
                    }

                    $page = isset($_GET["page"]) ? $_GET["page"] : 1;
                    $start_from = ($page - 1) * $num_rec_per_page;
                    $sql = "SELECT * FROM basicdetails WHERE Approve='1' AND Branch='CSE' LIMIT $start_from, $num_rec_per_page";
                    $result = $connect->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                <td>{$row['FirstName']}</td>
                                <td>{$row['LastName']}</td>
                                <td>{$row['USN']}</td>
                                <td>{$row['Mobile']}</td>
                                <td>{$row['Email']}</td>
                                <td>{$row['DOB']}</td>
                                <td>{$row['Sem']}</td>
                                <td>{$row['Branch']}</td>
                                <td>{$row['SSLC']}</td>
                                <td>{$row['PU/Dip']}</td>
                                <td>{$row['BE']}</td>
                                <td>{$row['Backlogs']}</td>
                                <td>{$row['HofBacklogs']}</td>
                                <td>{$row['DetainYears']}</td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='14'>No records found</td></tr>";
                    }
                    $connect->close();
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="pagination-wrap">
        <ul class="pagination">
            <?php
            $connect = new mysqli('localhost', 'harsh', 'harsh2005', 'placement');
            if ($connect->connect_error) {
                die("Connection failed: " . $connect->connect_error);
            }

            $sql = "SELECT * FROM basicdetails WHERE Approve='1' AND Branch='CSE'";
            $result = $connect->query($sql);
            $total_records = $result->num_rows;
            $total_pages = ceil($total_records / $num_rec_per_page);
            $currentpage = isset($_GET['page']) ? $_GET['page'] : 1;

            if ($currentpage > 1) {
                $prev = $currentpage - 1;
                echo "<li><a href='cse.php?page=" . $prev . "'><</a></li>";
            }

            for ($i = max(1, $currentpage - 1); $i <= min($currentpage + 2, $total_pages); $i++) {
                echo "<li><a href='cse.php?page=" . $i . "'>" . $i . "</a></li>";
            }

            if ($total_pages > $currentpage) {
                $next = $currentpage + 1;
                echo "<li><a href='cse.php?page=" . $next . "'>></a></li>";
            }

            echo "<li><a>Total Pages:" . $total_pages . "</a></li>";
            $connect->close();
            ?>
        </ul>
    </div>
</div>
</body>
</html>
