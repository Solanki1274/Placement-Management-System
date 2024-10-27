<?php
session_start();
if (!isset($_SESSION['pusername'])) {
    header("location: index.php");
    exit;
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
    <title>View Students</title>
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/css/bootstrap.min.css" rel="stylesheet">

    <style>
/* Global Styles */
body {
    font-family: 'Open Sans', sans-serif;
    background-color: #f5f5f5;
    margin: 0;
    padding: 0;
}

/* Main Container */
.bg {
    padding: 20px;
}

/* Content Container */
.templatemo-content-container {
    background-color: #ffffff;
    border-radius: 5px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

/* Panel Styles */
.panel {
    margin: 20px 0;
}

/* Table Styles */
.table {
    width: 100%;
    margin-bottom: 1rem;
    color: #212529;
    border-collapse: collapse;
    border-radius: 0.5rem;
    overflow: hidden; /* Ensures rounded corners on table */
}

.table thead th {
    background-color: #007bff;
    color: white;
    text-align: center;
    padding: 12px;
    position: sticky;
    top: 0; /* Make header sticky */
    z-index: 10; /* Ensure header is above other content */
}

.table-striped tbody tr:nth-of-type(odd) {
    background-color: #f2f2f2;
}

.table tbody tr {
    transition: background-color 0.3s, transform 0.3s;
}

.table tbody tr:hover {
    background-color: #e9ecef; /* Light gray on hover */
    transform: translateY(-1px); /* Slight lift effect */
}

.table td {
    padding: 12px;
    text-align: center;
    border: 1px solid #dee2e6; /* Light border */
}

.table a {
    color: #007bff;
    text-decoration: none;
    transition: color 0.3s;
}

.table a:hover {
    color: #0056b3; /* Darker blue on hover */
}

/* Footer Styles */
footer {
    padding: 15px;
    text-align: center;
    background-color: #007bff;
    color: white;
    position: relative;
    bottom: 0;
    width: 100%;
    height: 60px;
}

/* Responsive Styles */
@media (max-width: 768px) {
    .table thead {
        display: none; /* Hide header on small screens */
    }

    .table, .table tbody, .table tr, .table td {
        display: block;
        width: 100%; /* Make each cell full width */
    }

    .table tr {
        margin-bottom: 15px; /* Space between rows */
    }

    .table td {
        text-align: right;
        position: relative;
        padding-left: 50%; /* Space for label */
    }

    .table td:before {
        content: attr(data-label); /* Use data-label for header */
        position: absolute;
        left: 0;
        width: 50%;
        padding-left: 10px; /* Space from left */
        text-align: left;
        font-weight: bold;
    }
}

/* Button Styles */
.btn {
    display: inline-block;
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
    background-color: #28a745; /* Green button */
    color: white;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.btn:hover {
    background-color: #218838; /* Darker green on hover */
}

/* Input Styles */
input[type="text"] {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    transition: border-color 0.3s;
}

input[type="text"]:focus {
    border-color: #007bff; /* Change border on focus */
    outline: none;
}

/* Custom Scrollbar Styles */
.table {
    overflow: auto; /* Allows scrolling if needed */
}

.table::-webkit-scrollbar {
    width: 8px;
}

.table::-webkit-scrollbar-thumb {
    background: #007bff;
    border-radius: 4px;
}

.table::-webkit-scrollbar-thumb:hover {
    background: #0056b3; /* Darker on hover */
}


    </style>
</head>
<body>
    <div class="container-fluid d-flex p-0">
        <div class="templatemo-sidebar bg-dark text-white p-3">
            <header class="text-center mb-4">
                <div class="square"></div>
                <h2>Welcome, <?php echo htmlspecialchars($_SESSION['pusername']); ?></h2>
            </header>
            <nav class="templatemo-left-nav">
                <ul class="nav flex-column">
                    <li><a href="login.php" class="nav-link text-light"><i class="fa fa-home"></i> Dashboard</a></li>
                    <li><a href="Placement Drives.php" class="nav-link text-light"><i class="fa fa-building"></i> Placement Drives</a></li>
                    <li><a href="#" class="nav-link active"><i class="fa fa-users"></i> View Students</a></li>
                    <li><a href="queries.php" class="nav-link text-light"><i class="fa fa-question-circle"></i> Queries</a></li>
                    <li><a href="Students Eligibility.php" class="nav-link text-light"><i class="fa fa-check"></i> Students Eligibility</a></li>
                    <li><a href="logout.php" class="nav-link text-light"><i class="fa fa-sign-out-alt"></i> Sign Out</a></li>
                </ul>
            </nav>
        </div>
        <div class="content p-4 w-100">
            <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
                <ul class="navbar-nav">
                    <li class="nav-item"><a href="../../Homepage/index.php" class="nav-link">Home CIT-PMS</a></li>
                    <li class="nav-item"><a href="../../Drives/index.php" class="nav-link">Drives Home</a></li>
                    <li class="nav-item"><a href="Notif.php" class="nav-link">Notification</a></li>
                    <li class="nav-item"><a href="Change Password.php" class="nav-link">Change Password</a></li>
                </ul>
            </nav>

            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>Approval Date</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>USN</th>
                            <th>Mobile</th>
                            <th>Email</th>
                            <th>DOB</th>
                            <th>Semester</th>
                            <th>Branch</th>
                            <th>SSLC</th>
                            <th>PU/Dip</th>
                            <th>BE</th>
                            <th>Backlogs</th>
                            <th>History Of Backlogs</th>
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

                        $page = isset($_GET["page"]) ? $_GET["page"] : 1;
                        $start_from = ($page - 1) * $num_rec_per_page;
                        $sql = "SELECT * FROM basicdetails WHERE Approve='1' ORDER BY ApprovalDate DESC LIMIT $start_from, $num_rec_per_page";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>
                                    <td>{$row['ApprovalDate']}</td>
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
                            echo "<tr><td colspan='15' class='text-center'>No records found.</td></tr>";
                        }
                        $conn->close();
                        ?>
                    </tbody>
                </table>
            </div>

            <nav>
                <ul class="pagination justify-content-center">
                    <?php
                    $conn = new mysqli('localhost', 'harsh', 'harsh2005', 'placement');
                    $sql = "SELECT * FROM basicdetails WHERE Approve='1'";
                    $rs_result = $conn->query($sql);
                    $total_records = $rs_result->num_rows;
                    $total_pages = ceil($total_records / $num_rec_per_page);

                    if ($page > 1) {
                        echo "<li class='page-item'><a class='page-link' href='view_students.php?page=" . ($page - 1) . "'>Prev</a></li>";
                    }

                    for ($i = 1; $i <= $total_pages; $i++) {
                        echo "<li class='page-item'><a class='page-link' href='view_students.php?page=" . $i . "'>" . $i . "</a></li>";
                    }

                    if ($page < $total_pages) {
                        echo "<li class='page-item'><a class='page-link' href='view_students.php?page=" . ($page + 1) . "'>Next</a></li>";
                    }
                    ?>
                </ul>
            </nav>

            <footer class="text-center mt-5 footer">
                <p>&copy; 2024 Hmc-PMS | Developed by Hmc FutureTechnologies</p>
            </footer>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/js/bootstrap.min.js"></script>
</body>
</html>
