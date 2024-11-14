<?php
session_start();
if (isset($_SESSION['priusername'])){
      }
  else {
      header("location: index.php");
  } 
// Database connection
$servername = "localhost";
$username = "harsh";  // Update with your database username
$password = "harsh2005";      // Update with your database password
$dbname = "placement"; // Update with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get HOD ID from URL
if (isset($_GET['id'])) {
    $hod_id = $_GET['id'];

    // Fetch current branch of the HOD
    $sql = "SELECT Branch FROM hlogin WHERE Id = $hod_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $current_branch = $row['Branch'];
    } else {
        echo "HOD not found.";
        exit();
    }
}

// Update branch if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_branch = $_POST['branch'];

    $update_sql = "UPDATE hlogin SET Branch = '$new_branch' WHERE Id = $hod_id";

    if ($conn->query($update_sql) === TRUE) {
        echo "Branch updated successfully.";
        header("Location: view-hod.php"); // Redirect to view HOD list page after successful update
        exit();
    } else {
        echo "Error updating branch: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Branch</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center">Change Branch</h2>
    <form action="" method="post">
        <div class="form-group">
            <label for="branch">Current Branch:</label>
            <input type="text" class="form-control" value="<?php echo $current_branch; ?>" readonly>
        </div>
        <div class="form-group">
            <label for="branch">New Branch:</label>
            <select name="branch" class="form-control" required>
                <option value="CSE">CSE</option>
                <option value="ISE">ISE</option>
                <option value="EEE">EEE</option>
                <option value="ECE">ECE</option>
                <option value="ME">ME</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update Branch</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
