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

// Define upload directories
$profilePicDir = "C:/xampp/htdocs/Placement-Management-System/Profilers/SProfile/uploads/profile_pics/";
$resumeDir = "C:/xampp/htdocs/Placement-Management-System/Profilers/SProfile/uploads/resumes/";

// Profile Picture Upload Handling
if (isset($_FILES["profilePic"]) && !empty($_FILES["profilePic"]["name"])) {
    $profilePicName = basename($_FILES["profilePic"]["name"]);
    $profilePicPath = $profilePicDir . $profilePicName;
    $profilePicType = pathinfo($profilePicPath, PATHINFO_EXTENSION);

    // Check file size (1 MB limit)
    if ($_FILES["profilePic"]["size"] <= 1048576) { // 1 MB
        $allowedTypes = array('jpg', 'jpeg', 'png', 'gif');
        if (in_array($profilePicType, $allowedTypes)) {
            if (move_uploaded_file($_FILES["profilePic"]["tmp_name"], $profilePicPath)) {
                echo "Profile picture uploaded successfully!";
            } else {
                echo "Failed to upload profile picture.";
            }
        } else {
            echo "Only JPG, JPEG, PNG, and GIF files are allowed for profile pictures.";
        }
    } else {
        echo "Profile picture size exceeds the 1 MB limit.";
    }
}

// Resume Upload Handling
if (isset($_FILES["resume"]) && !empty($_FILES["resume"]["name"])) {
    $resumeName = basename($_FILES["resume"]["name"]);
    $resumePath = $resumeDir . $resumeName;
    $resumeType = pathinfo($resumePath, PATHINFO_EXTENSION);

    // Check file size (5 MB limit)
    if ($_FILES["resume"]["size"] <= 5242880) { // 5 MB
        $allowedTypes = array('pdf', 'doc', 'docx');
        if (in_array($resumeType, $allowedTypes)) {
            if (move_uploaded_file($_FILES["resume"]["tmp_name"], $resumePath)) {
                echo "Resume uploaded successfully!";
            } else {
                echo "Failed to upload resume.";
            }
        } else {
            echo "Only PDF, DOC, and DOCX files are allowed for resumes.";
        }
    } else {
        echo "Resume size exceeds the 5 MB limit.";
    }
}

mysqli_close($connect);
?>
