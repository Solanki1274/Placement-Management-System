<?php
session_start();
if (isset($_SESSION['pusername'])) {
    echo "Welcome, " . $_SESSION['pusername'] . "!";
} else {
    header("location: index.php");
    die("You must be logged in to view this page <a href='index.php'>Click here</a>");
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
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/templatemo-style.css" rel="stylesheet">
</head>

<body>
<div class="bg">
<div class="templatemo-content-container">
    <center><h2>Approved Students List of EEE</h2></center>
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
                        <td>Backlog</td>
                        <td>History Of Backlogs</td>
                        <td>Detain Years</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $num_rec_per_page = 2;
                    $conn = new mysqli('localhost', 'harsh', 'harsh2005', 'placement');

                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $page = isset($_GET["page"]) ? $_GET["page"] : 1;
                    $start_from = ($page - 1) * $num_rec_per_page;

                    $sql = "SELECT * FROM basicdetails WHERE Approve='1' AND Branch='EEE' LIMIT $start_from, $num_rec_per_page";
                    $result = $conn->query($sql);

                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['FirstName'] . "</td>";
                        echo "<td>" . $row['LastName'] . "</td>";
                        echo "<td>" . $row['USN'] . "</td>";
                        echo "<td>" . $row['Mobile'] . "</td>";
                        echo "<td>" . $row['Email'] . "</td>";
                        echo "<td>" . $row['DOB'] . "</td>";
                        echo "<td>" . $row['Sem'] . "</td>";
                        echo "<td>" . $row['Branch'] . "</td>";
                        echo "<td>" . $row['SSLC'] . "</td>";
                        echo "<td>" . $row['PU/Dip'] . "</td>";
                        echo "<td>" . $row['BE'] . "</td>";
                        echo "<td>" . $row['Backlogs'] . "</td>";
                        echo "<td>" . $row['HofBacklogs'] . "</td>";
                        echo "<td>" . $row['DetainYears'] . "</td>";
                        echo "</tr>";
                    }

                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="pagination-wrap">
    <ul class="pagination">
        <?php
        $conn = new mysqli('localhost', 'harsh', 'harsh2005', 'placement');
        $sql = "SELECT * FROM basicdetails WHERE Approve='1' AND Branch='EEE'";
        $result = $conn->query($sql);
        $total_records = $result->num_rows;
        $total_pages = ceil($total_records / $num_rec_per_page);

        for ($i = 1; $i <= $total_pages; $i++) {
            $active_class = ($i == $page) ? "class='active'" : "";
            echo "<li $active_class><a href='eee.php?page=".$i."'>".$i."</a></li>";
        }

        echo "<li><a>Total Pages: $total_pages</a></li>";
        $conn->close();
        ?>
    </ul>
</div>

</body>
</html>
