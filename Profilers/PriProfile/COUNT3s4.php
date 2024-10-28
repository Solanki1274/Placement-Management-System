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
    <title>Departmental Search</title>
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
<td><a  class="white-text templatemo-sort-by">Branch </a></td>
 <td><a  class="white-text templatemo-sort-by">Sem </a></td>   				  
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

if (isset($_POST['s4'])) { 
    // Sanitize user input
    $Cbranch = mysqli_real_escape_string($connection, $_POST['cbranch']);

    // Query to count the number of students in the specified branch
    $result = mysqli_query($connection, "SELECT COUNT(*) AS total_students FROM basicdetails WHERE `Approve`='1' AND Branch='$Cbranch'");
    
    if ($result) {
        $data = mysqli_fetch_assoc($result);
        echo "<br><h3>Students in '$Cbranch' Branch&nbsp:&nbsp" . $data['total_students'] . "</h3>"; 
    } else {
        echo "Error counting students: " . mysqli_error($connection);
    }

    // Query to get the details of students in the specified branch
    $sql = mysqli_query($connection, "SELECT * FROM basicdetails WHERE `Approve`='1' AND Branch='$Cbranch' ORDER BY Sem");
    
    if ($sql) {
        echo '<table>'; // Start the table
        echo '<tr>
                <th>Branch</th>
                <th>Semester</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>USN</th>
                <th>Mobile</th>
                <th>Email</th>
                <th>DOB</th>
                <th>SSLC Percentage</th>
                <th>PU/Diploma Percentage</th>
                <th>BE Aggregate</th>
                <th>Current Backlogs</th>
                <th>History of Backlogs</th>
                <th>Detain Years</th>
              </tr>'; // Table headers

        while ($row = mysqli_fetch_assoc($sql)) {
            echo "<tr>"; 
            echo '<td>' . htmlspecialchars($row['Branch']) . '</td>';			
            echo '<td>' . htmlspecialchars($row['Sem']) . '</td>';			
            echo '<td>' . htmlspecialchars($row['FirstName']) . '</td>';	
            echo '<td>' . htmlspecialchars($row['LastName']) . '</td>';		
            echo '<td>' . htmlspecialchars($row['USN']) . '</td>';	
            echo '<td>' . htmlspecialchars($row['Mobile']) . '</td>';	
            echo '<td>' . htmlspecialchars($row['Email']) . '</td>';		
            echo '<td>' . htmlspecialchars($row['DOB']) . '</td>';			 			
            echo '<td>' . htmlspecialchars($row['SSLC']) . '</td>';	
            echo '<td>' . htmlspecialchars($row['PU/Dip']) . '</td>';	
            echo '<td>' . htmlspecialchars($row['BE']) . '</td>';	
            echo '<td>' . htmlspecialchars($row['Backlogs']) . '</td>';	
            echo '<td>' . htmlspecialchars($row['HofBacklogs']) . '</td>';	
            echo '<td>' . htmlspecialchars($row['DetainYears']) . '</td>';
            echo "</tr>"; 
        }
        echo '</table>'; // End the table
    } else {
        echo "Error fetching students: " . mysqli_error($connection);
    }
}

// Close the database connection
mysqli_close($connection);
?>

     </tbody>
              </table>  
			  </div>
			  </div>
			  </div>
 <footer class="text-right">
            <p>Copyright &copy; 2024 Hmc-PMS
            |  Developed by <a href="#" target="_parent">Hmc  FutureTechnologies</a></p>
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