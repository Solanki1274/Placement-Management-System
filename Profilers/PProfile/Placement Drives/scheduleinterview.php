<?php
session_start(); // Start the session to use session variables

// Create a connection
$connect = mysqli_connect("localhost", "harsh", "harsh2005", "placement");

// Check connection
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

// Initialize alert and success messages
$alert = '';
$success = '';
$stmt = null; // Initialize $stmt

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and fetch input data
    $application_id = $_POST['application_id'];
    $interview_date = $_POST['interview_date'];
    $interview_time = $_POST['interview_time'];
    $mode = $_POST['mode'];
    $venue = $_POST['venue'];

    // Input validation
    if (empty($interview_date) || empty($interview_time) || empty($mode) || ($mode == "offline" && empty($venue))) {
        $_SESSION['alert'] = "Please fill in all required fields for scheduling the interview.";
        header("Location: scheduleinterview.php?application_id=$application_id");
        exit();
    }

    // Fetch application details
    $app_query = "SELECT usn, company_name FROM applications WHERE id = ?";
    $stmt = $connect->prepare($app_query);
    if (!$stmt) {
        die("Preparation failed: " . $connect->error);
    }

    $stmt->bind_param("i", $application_id);
    $stmt->execute();
    $app_result = $stmt->get_result();
    $application = $app_result->fetch_assoc();

    if (!$application) {
        $_SESSION['alert'] = "Application not found.";
        header("Location: viewapp.php");
        exit();
    }

    // Prepare to insert interview schedule
    $interview_at = $interview_date . ' ' . $interview_time;
    $insert_query = "INSERT INTO interviews (Name, USN, interview_at, mode, venue) VALUES (?, ?, ?, ?, ?)";
    $stmt = $connect->prepare($insert_query);
    if (!$stmt) {
        die("Preparation failed: " . $connect->error);
    }

    $stmt->bind_param("sssss", $application['company_name'], $application['usn'], $interview_at, $mode, $venue);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Interview scheduled successfully.";
    } else {
        $_SESSION['alert'] = "Error scheduling interview: " . $stmt->error;
    }

    header("Location: viewapp.php");
    exit();
}

// Close the statement if it was initialized
if ($stmt) {
    $stmt->close();
}
$connect->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule Interview</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h1, h2 {
            text-align: center;
            color: #333;
        }
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            display: none; /* Hide alerts by default */
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }
        input[type="text"], input[type="datetime-local"], select {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            width: 100%;
            background-color: #5cb85c;
            color: white;
            padding: 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #4cae4c;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Schedule Interview</h1>

    <?php if (isset($_SESSION['alert'])): ?>
        <div class="alert alert-danger"><?php echo $_SESSION['alert']; unset($_SESSION['alert']); ?></div>
    <?php endif; ?>
    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div>
    <?php endif; ?>

    <form action="scheduleinterview.php" method="POST">
        <input type="hidden" name="application_id" value="<?php echo htmlspecialchars($application_id); ?>">

        <label for="interview_date">Interview Date:</label>
        <input type="date" name="interview_date" required>

        <label for="interview_time">Interview Time:</label>
        <input type="time" name="interview_time" required>

        <label for="mode">Mode:</label>
        <select name="mode" required>
            <option value="Online">Online</option>
            <option value="Offline">Offline</option>
        </select>

        <label for="venue">Venue:</label>
        <input type="text" name="venue" placeholder="Enter venue (required for offline)" />

        <button type="submit">Schedule Interview</button>
    </form>
</div>

</body>
</html>
