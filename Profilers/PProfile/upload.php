<?php
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION)); // Ensure the file type is in lowercase
$connect = mysqli_connect("localhost", "harsh", "harsh2005", "placement") or die("Couldn't Connect"); // Use mysqli for modern MySQL connections

// Check if form is submitted
if (isset($_POST["submit"])) {
    $subject = $_POST['Subject'];
    $msg = $_POST['Message'];

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size (max 500KB)
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            // Prepare an SQL statement to prevent SQL injection
            $stmt = $connect->prepare("INSERT INTO image (file_path, subject, message) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $target_file, $subject, $msg); // Bind parameters

            if ($stmt->execute()) {
                echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded and recorded in the database.";
            } else {
                echo "Failed to insert into database.";
            }

            $stmt->close(); // Close the statement
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

mysqli_close($connect); // Close the database connection
?>
