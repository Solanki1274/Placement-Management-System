<?php
// Database configuration
$servername = "localhost";
$username = "hmc";
$password = "159753";
$dbname = "details";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['update'])) { 
    $Fname = $_POST['Fname'];
    $Lname = $_POST['Lname'];
    $USN = $_POST['USN'];
    $username = $_SESSION["username"]; // Assuming this is already set
    $Num = $_POST['Num'];

    if ($USN != '' || $Email != '') {
        if ($USN == $username) {
            $sql = "SELECT * FROM basicdetails WHERE USN='$USN'";
            $result = $conn->query($sql);

            if ($result->num_rows == 1) {
                $updateQuery = "UPDATE basicdetails SET 
                    FirstName='$Fname', 
                    LastName='$Lname', 
                    Mobile='$Num', 
                    Email='$Email', 
                    DOB='$DOB', 
                    Sem='$Sem', 
                    Branch='$Branch', 
                    SSLC='$SSLC', 
                    PUDip='$PUDip', 
                    BE='$BE', 
                    Backlogs='$Backlogs', 
                    HofBacklogs='$HofBacklogs', 
                    DetainYears='$DetainYears', 
                    Approve='0'
                    WHERE USN='$USN'";

                if ($conn->query($updateQuery) === TRUE) {
                    echo "<center>Data Updated successfully...!!</center>";
                } else {
                    echo "<center>FAILED</center>";
                }
            } else {
                echo "<center>NO record found for update</center>";
            }
        } else {
            echo "<center>Enter your USN only</center>";
        }
    }
}

$conn->close();
?>
