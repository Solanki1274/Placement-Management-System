<?php
session_start();
if (isset($_SESSION['pusername'])) {
    // User is logged in
} else {
    header("location: index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Search Students</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        h2 {
            text-align: center;
            color: #4CAF50;
        }

        form {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 20px auto;
            padding: 20px;
            width: 300px;
        }

        input[type="text"] {
            width: calc(100% - 22px); /* Full-width input */
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #4CAF50; /* Green */
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            background-color: #45a049; /* Darker green */
        }

        footer {
            text-align: right;
            margin-top: 20px;
        }

        footer p {
            margin: 0;
        }
    </style>
</head>
<body>
    <h2>Search By</h2>
    <center>
        <form action="COUNT3s1.php" method="POST">
            Student Name: 
            <input type="text" name="sname">
            <button type="submit" name="s1">Search</button>                        
        </form>    
        <form action="COUNT3s2.php" method="POST">                    
            Student USN: &nbsp 
            <input type="text" name="susn">
            <button type="submit" name="s2">Search</button>
        </form>    
        <form action="COUNT3s3.php" method="POST">                    
            Semester Wise: 
            <input type="text" name="csem">
            <button type="submit" name="s3">Search</button>
        </form>    
        <form action="COUNT3s4.php" method="POST">                    
            Branch: &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
            <input type="text" name="cbranch">
            <button type="submit" name="s4">Search</button>
        </form>
        <form action="COUNT3s5.php" method="POST">                    
            SSLC: &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 
            <input type="text" name="csslc">
            <button type="submit" name="s5">Search</button>
        </form>    
        <form action="COUNT3s6.php" method="POST">                    
            PU/Diploma: &nbsp 
            <input type="text" name="cpu">                        
            <button type="submit" name="s6">Search</button>
        </form>    
        <form action="COUNT3s7.php" method="POST">                    
            BE Aggregate:  
            <input type="text" name="cbe">
            <button type="submit" name="s7">Search</button>
        </form>                    
    </center>
    <footer class="text-right">
        <p>Copyright &copy; 2024 Hmc-PMS | Developed by
            <a href="#" target="_parent">Hmc FutureTechnologies</a>
        </p>
    </footer>         
    <!-- JS -->
    <script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>      <!-- jQuery -->
    <script type="text/javascript" src="js/templatemo-script.js"></script>      <!-- Templatemo Script -->
    <script>
        $(document).ready(function() {
            // Content widget with background image
            var imageUrl = $('img.content-bg-img').attr('src');
            $('.templatemo-content-img-bg').css('background-image', 'url(' + imageUrl + ')');
            $('img.content-bg-img').hide();        
        });
    </script>
</body>
</html>
