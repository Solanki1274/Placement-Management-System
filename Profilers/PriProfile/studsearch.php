<?php
  session_start();
 if (isset($_SESSION['priusername'])){
    
	   }
   else {
	   header("location: index.php");
  }  
?>
<!DOCTYPE html>
<html>
	<style>
		/* Custom CSS for Queries Page */
body {
    font-family: 'Open Sans', sans-serif;
    background-color: #f4f4f9;
}

.templatemo-sidebar {
    background-color: #36454f; /* Dark gray */
    color: #ffffff;
}

.templatemo-site-header h1 {
    color: #ffffff;
    font-size: 1.5rem;
    margin: 10px 0;
    font-weight: 700;
}

.profile-photo-container {
    text-align: center;
    margin: 20px 0;
}

.profile-photo-container img {
    border-radius: 50%;
    border: 4px solid #ffffff;
}

.templatemo-left-nav ul {
    list-style-type: none;
    padding: 0;
}

.templatemo-left-nav ul li a {
    color: #c1c7d0;
    padding: 10px 20px;
    display: block;
    text-decoration: none;
    border-radius: 4px;
    margin: 5px 0;
    transition: 0.3s;
}

.templatemo-left-nav ul li a:hover, .templatemo-left-nav ul li a.active {
    background-color: #4b5a6a;
    color: #ffffff;
}

.templatemo-top-nav-container {
    background-color: #36454f;
    padding: 15px;
}

.templatemo-top-nav ul {
    padding-left: 0;
}

.templatemo-top-nav ul li a {
    color: #ffffff;
    text-decoration: none;
    font-weight: 600;
    padding: 10px 15px;
    border-radius: 4px;
}

.templatemo-top-nav ul li a:hover {
    background-color: #4b5a6a;
}

.templatemo-content-widget {
    background-color: #ffffff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.templatemo-content-widget h3 {
    color: #36454f;
    font-weight: 700;
}

.templatemo-blue-button {
    color: #ffffff;
    background-color: #36454f;
    padding: 8px 15px;
    border-radius: 5px;
    text-decoration: none;
    transition: 0.3s;
}

.templatemo-blue-button:hover {
    background-color: #4b5a6a;
}

footer {
    padding: 20px;
    background-color: #36454f;
    color: #ffffff;
    text-align: center;
    font-size: 0.9rem;
    border-top: 2px solid #e7e7e7;
}

footer p a {
    color: #98c1d9;
    text-decoration: none;
}

footer p a:hover {
    text-decoration: underline;
}

.templatemo-search-form input[type="text"] {
    border: none;
    padding: 10px;
    border-radius: 4px 0 0 4px;
}

.templatemo-search-form button {
    background-color: #36454f;
    color: #ffffff;
    padding: 10px;
    border-radius: 0 4px 4px 0;
    border: none;
    transition: 0.3s;
}

.templatemo-search-form button:hover {
    background-color: #4b5a6a;
}

	</style>
<head>
</head>
<body>
<h2>Search By</h2>
<center>
					<form  action="COUNT3s1.php" method="POST">
						Student Name : 
						<input type="text" name="sname">
						<button type="submit" name="s1" >Search</button>						
						<br><br>
					</form>	
					<form  action="COUNT3s2.php" method="POST">					
						Student USN : &nbsp 
						<input type="text" name="susn">
						<button type="submit" name="s2" >Search</button>
						<br><br>
					</form>	
					<form  action="COUNT3s3.php" method="POST">					
						Semister Wise : 
						<input type="text" name="csem">
						<button type="submit" name="s3" >Search</button>
						<br><br>
					</form>	
					<form  action="COUNT3s4.php" method="POST">					
						Branch : &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
						<input type="text" name="cbranch">
						<button type="submit" name="s4" >Search</button>
						<br><br>
					</form>
					<form  action="COUNT3s5.php" method="POST">					
						SSLC : &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 
						<input type="text" name="csslc">
						<button type="submit" name="s5" >search</button>
						<br><br>
					</form>	
					<form  action="COUNT3s6.php" method="POST">					
						PU/Diploma : &nbsp 
						<input type="text" name="cpu">						
						<button type="submit" name="s6" >search</button>
						<br><br>
					</form>	
					<form  action="COUNT3s7.php" method="POST">					
						BE Aggregate :  
						<input type="text" name="cbe">
						<button type="submit" name="s7" >search</button>
						<br><br>
					</form>					
</center>
<footer class="text-right">
            <p>Copyright &copy;2024 Hmc-PMS
            | Developed by <a href="http://www.Wafferdevelopers.com" target="_parent">Hmc FutureTechnologies</a></p>
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