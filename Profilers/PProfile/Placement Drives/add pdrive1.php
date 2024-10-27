<?php
// Establishing connection with the server using mysqli
$connect = new mysqli("localhost", "harsh", "harsh2005", "placement");

// Check connection
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}

// Check if the form is submitted
if (isset($_POST['submit'])) {
    $cname = $_POST['compny'];
    $date = $_POST['date'];
    $campool = $_POST['campool'];
    $poolven = $_POST['pcv'];
    $per = $_POST['sslc'];
    $puagg = $_POST['puagg'];
    $beaggregate = $_POST['beagg'];
    $back = $_POST['curback'];
    $hisofbk = $_POST['hob'];
    $breakstud = $_POST['break'];
    $otherdet = $_POST['odetails'];

    // Check if required fields are not empty
    if (!empty($cname) && !empty($date)) {
        // Prepare an SQL statement for execution
        $stmt = $connect->prepare("INSERT INTO `addpdrive` (`CompanyName`, `Date`, `C/P`, `PVenue`, `SSLC`, `PU/Dip`, `BE`, `Backlogs`, `HofBacklogs`, `DetainYears`, `ODetails`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        
        // Bind parameters
        $stmt->bind_param("sssssssssss", $cname, $date, $campool, $poolven, $per, $puagg, $beaggregate, $back, $hisofbk, $breakstud, $otherdet);
        
        // Execute the statement
        if ($stmt->execute()) {
            echo "<center>Drive Inserted successfully</center>";
        } else {
            echo "Error: " . $stmt->error; // Display error message
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Fields cannot be left blank"; // Improved error message
    }
} else {
    echo "You don't have privileges"; // Improved error message
}

// Close the connection
$connect->close();
?>
