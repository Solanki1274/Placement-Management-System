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
    <!--favicon-->
    <link rel="shortcut icon" href="favicon.ico" type="image/icon">
    <link rel="icon" href="favicon.ico" type="image/icon">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ISE Students</title>
    
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,700" rel="stylesheet" type="text/css">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/templatemo-style.css" rel="stylesheet">
</head>

<body>
<div class="bg">
<div class="templatemo-content-container">
    <center><h2>Approved Students List of ISE</h2></center>
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
$servername = "localhost";
$username = "harsh";
$password = "harsh2005";
$dbname = "placement";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$num_rec_per_page = 15;
$page = isset($_GET["page"]) ? $_GET["page"] : 1;
$start_from = ($page - 1) * $num_rec_per_page;

$sql = "SELECT * FROM basicdetails WHERE Approve='1' AND Branch='ISE' LIMIT ?, ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $start_from, $num_rec_per_page);
$stmt->execute();
$result = $stmt->get_result();

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
        $conn = new mysqli($servername, $username, $password, $dbname);
        $sql = "SELECT COUNT(*) FROM basicdetails WHERE Approve='1' AND Branch='ISE'";
        $result = $conn->query($sql);
        $row = $result->fetch_row();
        $total_records = $row[0];
        $total_pages = ceil($total_records / $num_rec_per_page);
        
        if ($page > 1) {
            $prev = $page - 1;
            echo "<li><a href='ise.php?page=$prev'>&lt;</a></li>";
        }

        for ($i = max(1, $page - 2); $i <= min($total_pages, $page + 2); $i++) {
            if ($i == $page) {
                echo "<li class='active'><a>$i</a></li>";
            } else {
                echo "<li><a href='ise.php?page=$i'>$i</a></li>";
            }
        }

        if ($page < $total_pages) {
            $next = $page + 1;
            echo "<li><a href='ise.php?page=$next'>&gt;</a></li>";
        }

        echo "<li><a>Total Pages: $total_pages</a></li>";

        $conn->close();
        ?>
    </ul>
</div>

</body>
</html>
