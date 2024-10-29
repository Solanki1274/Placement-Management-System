<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION["username"])) {
    header("Location: index.php");
    exit();
}

echo "Welcome, " . htmlspecialchars($_SESSION['username']) . "!";

$connect = mysqli_connect("localhost", "harsh", "harsh2005", "placement");

if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

// Handle form submission for inserting new data
if (isset($_POST['submit'])) {
    $fname = $_POST['Fname'];
    $lname = $_POST['Lname'];
    $usn = $_POST['USN'];
    $sun = $_SESSION["username"];
    $phno = $_POST['Num'];
    $email = $_POST['Email'];
    $date = $_POST['DOB'];
    $cursem = $_POST['Cursem'];
    $branch = $_POST['Branch'];
    $per = $_POST['Percentage'];
    $puagg = $_POST['Puagg'];
    $beaggregate = $_POST['Beagg'];
    $back = $_POST['Backlogs'];
    $hisofbk = $_POST['History'];
    $detyear = $_POST['Dety'];

    if ($usn && $email) {
        if ($usn === $sun) {
            $stmt = $connect->prepare("INSERT INTO basicdetails (FirstName, LastName, USN, Mobile, Email, DOB, Sem, Branch, SSLC, `PU/Dip`, BE, Backlogs, HofBacklogs, DetainYears, Approve) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '0')");
            $stmt->bind_param("ssssssssssssss", $fname, $lname, $usn, $phno, $email, $date, $cursem, $branch, $per, $puagg, $beaggregate, $back, $hisofbk, $detyear);

            if ($stmt->execute()) {
                echo "<center>Data inserted successfully...!!</center>";
            } else {
                echo "<center>Failed to insert data</center>";
            }
            $stmt->close();
        } else {
            echo "<center>Please enter your own USN only...!!</center>";
        }
    }
}

// Handle form submission for updating existing data
if (isset($_POST['update'])) {
    $fname = $_POST['Fname'];
    $lname = $_POST['Lname'];
    $usn = $_POST['USN'];
    $sun = $_SESSION["username"];
    $phno = $_POST['Num'];
    $email = $_POST['Email'];
    $date = $_POST['DOB'];
    $cursem = $_POST['Cursem'];
    $branch = $_POST['Branch'];
    $per = $_POST['Percentage'];
    $puagg = $_POST['Puagg'];
    $beaggregate = $_POST['Beagg'];
    $back = $_POST['Backlogs'];
    $hisofbk = $_POST['History'];
    $detyear = $_POST['Dety'];

    if ($usn && $email) {
        if ($usn === $sun) {
            $stmt = $connect->prepare("SELECT * FROM basicdetails WHERE USN = ?");
            $stmt->bind_param("s", $usn);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows == 1) {
                $stmt->close();
                $stmt = $connect->prepare("UPDATE basicdetails SET FirstName = ?, LastName = ?, Mobile = ?, Email = ?, DOB = ?, Sem = ?, Branch = ?, SSLC = ?, `PU/Dip` = ?, BE = ?, Backlogs = ?, HofBacklogs = ?, DetainYears = ?, Approve = '0' WHERE USN = ?");
                $stmt->bind_param("ssssssssssssss", $fname, $lname, $phno, $email, $date, $cursem, $branch, $per, $puagg, $beaggregate, $back, $hisofbk, $detyear, $usn);
                
                if ($stmt->execute()) {
                    echo "<center>Data updated successfully...!!</center>";
                } else {
                    echo "<center>Failed to update data</center>";
                }
                $stmt->close();
            } else {
                echo "<center>No record found for update</center>";
            }
        } else {
            echo "<center>Please enter your own USN only</center>";
        }
    }
}

mysqli_close($connect);
?>
