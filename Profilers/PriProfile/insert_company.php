<?php
session_start();
if (!isset($_SESSION['priusername'])) {
    header("location: index.php");
    exit();
}

// Database connection
$connect = new mysqli('localhost', 'harsh', 'harsh2005', 'placement');

// Check connection
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}

// Insert company (plogin)
if (isset($_POST['insert'])) {
    $name = $connect->real_escape_string($_POST['name']);
    $username = $connect->real_escape_string($_POST['username']);
    $password = 'User@123'; // Default password
    $email = $connect->real_escape_string($_POST['email']);
    $question = $connect->real_escape_string($_POST['question']);
    $answer = $connect->real_escape_string($_POST['answer']);
    $approve = $_POST['approve'] == 'Yes' ? 1 : 0; // Convert 'Yes' to 1 and 'No' to 0

    $stmt = $connect->prepare("INSERT INTO plogin (Name, Username, Password, Email, Question, Answer, Approve) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssi", $name, $username, $password, $email, $question, $answer, $approve);
    
    if ($stmt->execute()) {
        $message = "Company added successfully!";
        $companyAdded = true;  // Flag to indicate the company was added
    } else {
        $message = "Error adding company: " . $connect->error;
        $companyAdded = false;
    }
    $stmt->close();
    $connect->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Company</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 30px;
            width: 400px;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            font-size: 14px;
            font-weight: bold;
            color: #555;
        }
        input, select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
            color: #333;
        }
        select {
            cursor: pointer;
        }
        input[readonly] {
            background-color: #f2f2f2;
        }
        .button-group {
            text-align: center;
        }
        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            margin: 5px;
        }
        button:hover {
            background-color: #0056b3;
        }
        .message {
            text-align: center;
            margin-top: 15px;
            color: #28a745;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Insert Company</h2>
    <form method="POST" action="">
        <div class="form-group">
            <label for="name">Company Name</label>
            <input type="text" name="name" id="name" required>
        </div>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="text" name="password" id="password" value="User@123" readonly>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>
        </div>
        <div class="form-group">
            <label for="question">Security Question</label>
            <input type="text" name="question" id="question" value="What is your favorite movie?" readonly>
        </div>
        <div class="form-group">
            <label for="answer">Security Answer</label>
            <input type="text" name="answer" id="answer" value="Vikram" readonly>
        </div>
        <div class="form-group">
            <label for="approve">Approve</label>
            <select name="approve" id="approve" required>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>
        </div>

        <div class="button-group">
            <button type="submit" name="insert">Add Company</button>
            <button type="reset">Reset</button>
        </div>
    </form>

    <?php if (isset($message)) { echo "<p class='message'>$message</p>"; } ?>
</div>

<script>
    // If company is added successfully, show an alert
    <?php if (isset($companyAdded) && $companyAdded) { ?>
        alert('Company added successfully!');
    <?php } ?>
</script>

</body>
</html>
