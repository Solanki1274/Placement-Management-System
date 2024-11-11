<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION["username"])) {
    header("Location: index.php");
    exit();
}

echo "Welcome, " . htmlspecialchars($_SESSION['username']) . "!";

// Database connection
$connect = mysqli_connect("localhost", "harsh", "harsh2005", "placement");
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

// Handle form submission for inserting or updating data
if (isset($_POST['submit']) || isset($_POST['update'])) {
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

    // Set up the file upload path and file type checking
    $targetDir = "SProfile/uploads/";
    $fileName = "";
    $resumeUploaded = false;

    // Check if the file is uploaded
    if (isset($_FILES["fileToUpload"]) && !empty($_FILES["fileToUpload"]["name"])) {
        $fileName = basename($_FILES["fileToUpload"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        // Check if file size is within the limit
        if ($_FILES["fileToUpload"]["size"] <= 5242880) { // 5MB
            $allowedTypes = array('pdf', 'doc', 'docx');
            if (in_array($fileType, $allowedTypes)) {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFilePath)) {
                    $resumeUploaded = true;
                } else {
                    echo "File upload failed.";
                }
            } else {
                echo "Only PDF, DOC, and DOCX files are allowed.";
            }
        } else {
            echo "File size exceeds the 5MB limit.";
        }
    }

    // Handle insert or update based on form submission
    if ($usn && $email) {
        if ($usn === $sun) {
            // Check if a record with this USN already exists
            $stmt = $connect->prepare("SELECT * FROM basicdetails WHERE USN = ?");
            $stmt->bind_param("s", $usn);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows == 1) {
                // Update existing record
                $stmt->close();
                $query = "UPDATE basicdetails SET FirstName = ?, LastName = ?, Mobile = ?, Email = ?, DOB = ?, Sem = ?, Branch = ?, SSLC = ?, `PU/Dip` = ?, BE = ?, Backlogs = ?, HofBacklogs = ?, DetainYears = ?, Approve = '0'";
                if ($resumeUploaded) {
                    $query .= ", ResumeID = ?";
                }
                $query .= " WHERE USN = ?";

                $stmt = $connect->prepare($query);
                if ($resumeUploaded) {
                    $stmt->bind_param("sssssssssssssss", $fname, $lname, $phno, $email, $date, $cursem, $branch, $per, $puagg, $beaggregate, $back, $hisofbk, $detyear, $fileName, $usn);
                } else {
                    $stmt->bind_param("ssssssssssssss", $fname, $lname, $phno, $email, $date, $cursem, $branch, $per, $puagg, $beaggregate, $back, $hisofbk, $detyear, $usn);
                }

                if ($stmt->execute()) {
                    echo "<center>Data updated successfully...!!</center>";
                } else {
                    echo "<center>Failed to update data</center>";
                }
            } else {
                // Insert new record
                $stmt->close();
                $query = "INSERT INTO basicdetails (FirstName, LastName, USN, Mobile, Email, DOB, Sem, Branch, SSLC, `PU/Dip`, BE, Backlogs, HofBacklogs, DetainYears, Approve";
                if ($resumeUploaded) {
                    $query .= ", ResumeID";
                }
                $query .= ") VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '0'";
                if ($resumeUploaded) {
                    $query .= ", ?";
                }
                $query .= ")";

                $stmt = $connect->prepare($query);
                if ($resumeUploaded) {
                    $stmt->bind_param("sssssssssssssss", $fname, $lname, $usn, $phno, $email, $date, $cursem, $branch, $per, $puagg, $beaggregate, $back, $hisofbk, $detyear, $fileName);
                } else {
                    $stmt->bind_param("ssssssssssssss", $fname, $lname, $usn, $phno, $email, $date, $cursem, $branch, $per, $puagg, $beaggregate, $back, $hisofbk, $detyear);
                }

                if ($stmt->execute()) {
                    echo "<center>Data inserted successfully...!!Once YOu CAn Appy After It Is Approved By Administrating Staff!!</center>";
                } else {
                    echo "<center>Failed to insert data</center>";
                }
            }
        } else {
            echo "<center>Please enter your own USN only...!!</center>";
        }
    }
}

// Close the database connection
mysqli_close($connect);
?>
