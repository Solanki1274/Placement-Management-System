<?php
// Establishing Connection with Server
$connect = mysqli_connect("localhost", "harsh", "harsh2005", "details");

// Check connection
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['submit'])) {
    // Sanitize user input
    $cname = mysqli_real_escape_string($connect, $_POST['compny']);
    $date = mysqli_real_escape_string($connect, $_POST['date']);
    $campool = mysqli_real_escape_string($connect, $_POST['campool']);
    $poolven = mysqli_real_escape_string($connect, $_POST['pcv']);
    $per = mysqli_real_escape_string($connect, $_POST['sslc']);
    $puagg = mysqli_real_escape_string($connect, $_POST['puagg']);
    $beaggregate = mysqli_real_escape_string($connect, $_POST['beagg']);
    $back = mysqli_real_escape_string($connect, $_POST['curback']);
    $hisofbk = mysqli_real_escape_string($connect, $_POST['hob']);
    $breakstud = mysqli_real_escape_string($connect, $_POST['break']);
    $otherdet = mysqli_real_escape_string($connect, $_POST['odetails']);

    // Check if required fields are not empty
    if (!empty($cname) && !empty($date)) {
        // Prepare the SQL statement
        $query = "INSERT INTO addpdrive (CompanyName, Date, campusPool, poolcampusVenue, SSLCAgg, PUDIPLOMAgg, BEAgg, CurrentBacklogs, HistoryBacklogs, BreakStudies, otherDetails)
                  VALUES ('$cname', '$date', '$campool', '$poolven', '$per', '$puagg', '$beaggregate', '$back', '$hisofbk', '$breakstud', '$otherdet')";

        // Execute the query
        if (mysqli_query($connect, $query)) {
            echo "<center>Drive Inserted successfully</center>";
        } else {
            echo "Error: " . mysqli_error($connect); // Show detailed error
        }
    } else {
        echo "<center>Please fill in the Company Name and Date.</center>";
    }
}

// Close the database connection
mysqli_close($connect);
?>
