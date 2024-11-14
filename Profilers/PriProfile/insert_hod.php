<?php
session_start();
if (isset($_SESSION['priusername'])){
      }
  else {
      header("location: index.php");
  } 
// Database connection
$servername = "localhost";
$username = "harsh";
$password = "harsh2005";
$dbname = "placement";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $firstName = $_POST['FirstName'];
    $lastName = $_POST['LastName'];
    $username = $_POST['Username'];
    $password = "Hod@123"; // Default password, no hashing
    $email = $_POST['Email'];
    $branch = $_POST['Branch'];
    $question = $_POST['Question'];
    $answer = $_POST['Answer'];

    // Prepare the SQL statement to insert HOD data
    $sql = "INSERT INTO hlogin (FirstName, LastName, Username, Password, Email, Branch, Question, Answer) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssss", $firstName, $lastName, $username, $password, $email, $branch, $question, $answer);

    if ($stmt->execute()) {
        header("location: manage-hod.php");
        echo "<script>alert('HOD added successfully!');</script>";
        
    } else {
        echo "<script>alert('Error adding HOD: " . $stmt->error . "');</script>";
    }

    $stmt->close();
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add HOD</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Basic styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7f6;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        h2 {
            color: #333;
            text-align: center;
        }

        /* Form container styling */
        .form-container {
            background: #ffffff;
            width: 500px;
            padding: 34px;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }

        /* Input styling */
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            font-weight: bold;
            color: #555;
            display: block;
            margin-bottom: 5px;
        }
        .form-control {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            transition: border-color 0.3s;
        }
        .form-control:focus {
            border-color: #007bff;
            outline: none;
        }
        .input-group-addon {
            display: inline-block;
            margin-right: 10px;
            color: #007bff;
        }

        /* Button styling */
        .btn {
            background-color: #007bff;
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
            width: 100%;
        }
        .btn:hover {
            background-color: #0056b3;
        }

        /* Styling for read-only password */
        .form-group .readonly {
            background-color: #f9f9f9;
            color: #666;
            cursor: not-allowed;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Add HOD</h2>
        <form action="insert_hod.php" method="post">
            <div class="form-group">
                <label for="firstName">First Name:</label>
                <input type="text" id="firstName" name="FirstName" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="lastName">Last Name:</label>
                <input type="text" id="lastName" name="LastName" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="Username" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Password (Default: Hod@123):</label>
                <input type="text" id="password" name="Password" value="Hod@123" class="form-control readonly" readonly>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="Email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="branch">Branch:</label>
                <select id="branch" name="Branch" class="form-control" required>
                    <option value="CSE">CSE</option>
                    <option value="ISE">ISE</option>
                    <option value="EEE">EEE</option>
                    <option value="ECE">ECE</option>
                    <option value="ME">ME</option>
                </select>
            </div>
            <div class="form-group">
                <label for="question">Security Question:</label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-question-circle"></i>
                    </div>
                    <select name="Question" class="form-control" required>
                        <option value="What is your nickname?">What is your nickname?</option>
                        <option value="What is your fav spot?">What is your fav spot?</option>
                        <option value="What is your fav dish?">What is your fav dish?</option>
                        <option value="What is your dream land address?">What is your dream land address?</option>
                        <option value="What is your first mobile number?">What is your first mobile number?</option>
                        <option value="What is your one truth which others don’t know?">What is your one truth which others don’t know?</option>
                        <option value="What is your detained years in life?">What is your detained years in life?</option>
                        <option value="What is your enemy's name?">What is your enemy's name?</option>
                        <option value="What is your pet's name?">What is your pet's name?</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="answer">Answer:</label>
                <input type="text" id="answer" name="Answer" class="form-control" required>
            </div>
            <button type="submit" class="btn">Add HOD</button>
        </form>
    </div>
</body>
</html>
