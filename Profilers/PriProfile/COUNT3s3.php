<?php
  session_start();
 if (isset($_SESSION['priusername'])){
    
	   }
   else {
	   header("location: index.php");
  }  
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!--favicon-->
        <link rel="shortcut icon" href="favicon.ico" type="image/icon">
        <link rel="icon" href="favicon.ico" type="image/icon">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    <title>Manage Students</title>
    <meta name="description" content="">
    <meta name="author" content="templatemo">
    
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,700' rel='stylesheet' type='text/css'>
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/templatemo-style.css" rel="stylesheet">
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>  
  <body>
  <div class="bg">
  <div class="templatemo-content-container">
          <div class="templatemo-content-widget no-padding">
            <div class="panel panel-default table-responsive">
			<table class="table table-striped table-bordered templatemo-user-table">
                <thead>
                  <tr>    
 <td><a  class="white-text templatemo-sort-by">Sem </a></td>  
   <td><a  class="white-text templatemo-sort-by">Branch </a></td> 
                    <td><a class="white-text templatemo-sort-by">First Name </a></td>
                    <td><a  class="white-text templatemo-sort-by">Last Name </a></td>
                    <td><a  class="white-text templatemo-sort-by">USN </a></td>
                    <td><a  class="white-text templatemo-sort-by">Mobile </a></td>
					   <td><a  class="white-text templatemo-sort-by">Email </a></td>
                       <td><a  class="white-text templatemo-sort-by">DOB</a></td>               
   <td><a  class="white-text templatemo-sort-by">SSLC </a></td>
   <td><a  class="white-text templatemo-sort-by">PU/Dip </a></td>
			      <td><a  class="white-text templatemo-sort-by">BE </a></td>
			      <td><a  class="white-text templatemo-sort-by">Backlogs </a></td>
				     <td><a class="white-text templatemo-sort-by">History Of Backlogs </a></td>
				     <td><a  class="white-text templatemo-sort-by">Detain Years </a></td> 
				  </thead>
			   </tr>			   
 		
<?php
// Database connection
$connection = mysqli_connect('localhost', 'harsh', 'harsh2005', 'placement');

// Check connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['s3'])) { 
    $Csem = mysqli_real_escape_string($connection, $_POST['csem']);
    
    // Query to count the students
    $result = mysqli_query($connection, "SELECT COUNT(*) AS total_students FROM basicdetails WHERE `Approve`='1' AND Sem='$Csem'");
    
    // Fetch the count result
    if ($result) {
        $data = mysqli_fetch_assoc($result);
        echo "<br><h3>Students in Semester '$Csem'&nbsp:&nbsp" . $data['total_students'] . "</h3>";
    } else {
        echo "Error: " . mysqli_error($connection);
    }

    // Query to get the details of students
    $sql = mysqli_query($connection, "SELECT * FROM basicdetails WHERE `Approve`='1' AND Sem='$Csem' ORDER BY Branch");
    
    // Check if the second query was successful
    if ($sql) {
        while ($row = mysqli_fetch_assoc($sql)) {
            // Display each student's details
            echo "<div>";
            echo "First Name: " . htmlspecialchars($row['FirstName']) . "<br>";
            echo "Last Name: " . htmlspecialchars($row['LastName']) . "<br>";
            echo "USN: " . htmlspecialchars($row['USN']) . "<br>";
            echo "Mobile: " . htmlspecialchars($row['Mobile']) . "<br>";
            echo "Email: " . htmlspecialchars($row['Email']) . "<br>";
            echo "DOB: " . htmlspecialchars($row['DOB']) . "<br>";
            echo "Semester: " . htmlspecialchars($row['Sem']) . "<br>";
            echo "Branch: " . htmlspecialchars($row['Branch']) . "<br>";
            echo "SSLC Percentage: " . htmlspecialchars($row['SSLC']) . "<br>";
            echo "PU/Diploma Percentage: " . htmlspecialchars($row['PU/Dip']) . "<br>";
            echo "BE Aggregate: " . htmlspecialchars($row['BE']) . "<br>";
            echo "Current Backlogs: " . htmlspecialchars($row['Backlogs']) . "<br>";
            echo "History of Backlogs: " . htmlspecialchars($row['HofBacklogs']) . "<br>";
            echo "Detain Years: " . htmlspecialchars($row['DetainYears']) . "<br>";
            echo "</div><hr>";
        }
    } else {
        echo "Error: " . mysqli_error($connection);
    }
}

// Close the connection
mysqli_close($connection);
?>

     </tbody>
              </table>  
			  </div>
			  </div>
			  </div>
 <footer class="text-right">
            <p>Copyright &copy; 2024 Hmc-PMS
            |  Developed by <a href="#" target="_parent">Hmc FutureTechnologies</a></p>
          </footer>         
        </div>
      </div>
    </div>    
    <!-- JS -->
    <script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>      <!-- jQuery -->
    <script type="text/javascript" src="js/templatemo-script.js"></script>      <!-- Templatemo Script -->
    <script>
      $(document).ready(function(){
        // Content widget with background image
        var imageUrl = $('img.content-bg-img').attr('src');
        $('.templatemo-content-img-bg').css('background-image', 'url(' + imageUrl + ')');
        $('img.content-bg-img').hide();        
      });
    </script>
</body>
</html>