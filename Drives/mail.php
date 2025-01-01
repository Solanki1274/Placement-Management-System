<?php
// Database connection
$servername = "localhost"; 
$username = "harsh";        
$password = "harsh2005";      
$database = "placement";     

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $subject = $conn->real_escape_string($_POST['subject']);
    $message = $conn->real_escape_string($_POST['message']);

    // Insert data into the database
    $sql = "INSERT INTO contact_form (name, email, subject, message) VALUES ('$name', '$email', '$subject', '$message')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('Thank you for contacting us! We will get back to you soon.');
                window.location.href = 'mail.php'; // Redirect back to the contact page
              </script>";
    } else {
        echo "<script>
                alert('An error occurred. Please try again later.');
                window.location.href = 'mail.php'; // Redirect back to the contact page
              </script>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
	<!--favicon-->
		<link rel="shortcut icon" href="favicon.ico" type="image/icon">
		<link rel="icon" href="favicon.ico" type="image/icon">
<title>Hmc-PMS | Contact Us</title>
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
<!--// css -->
<!-- bootstarp-css -->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<!--// bootstarp-css -->
<script src="js/jquery-1.11.1.min.js"></script>
<!--fonts-->
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,800,700,600' rel='stylesheet' type='text/css'>
<!--/fonts-->
<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
<script src="js/wow.min.js"></script>
<script>
	 new WOW().init();
</script>
</head>
<body>
	<!-- banner -->
	<div class="banner a-banner">
		<!-- container -->
		<div class="container">
			<div class="header">
				<div class="head-logo">
					
				</div>
				<div class="top-nav">
					<span class="menu"><img src="images/menu.png" alt=""></span>
					<ul class="nav1">
						<li class="hvr-sweep-to-bottom">
								<a href="../Homepage/index.php">Hmc-PMS<i>Goto Placement Homepage</i></a>
							</li>
						<li class="hvr-sweep-to-bottom">
								<a href="index.php">Home<i>Get the Overview of the Site</i></a>
								<li class="hvr-sweep-to-bottom">
									<a href="about.php">About<i>About Us and our Cheif Architects</i></a>
								</li>
								<li class="hvr-sweep-to-bottom">
									<a href="products.php">Campus Drives<i>Campus Drives</i></a>
								</li>
								
								<li class="hvr-sweep-to-bottom active">
									<a href="mail.php">Mail Us<i>Get in Touch with us Instantly</i></a>
								</li>
						<div class="clearfix"> </div>
					</ul>
					<!-- script-for-menu -->
							 <script>
							   $( "span.menu" ).click(function() {
								 $( "ul.nav1" ).slideToggle( 300, function() {
								 // Animation complete.
								  });
								 });
							</script>
						<!-- /script-for-menu -->
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
		<!-- //container -->
	</div>
	<!-- //banner -->
	<!-- mail -->
	<div class="mail">
		<!-- container -->
		<div class="container">
			<div class="map footer-middle wow bounceIn animated" data-wow-delay="0.4s" style="visibility: visible; -webkit-animation-delay: 0.4s;">
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7361.123569659039!2d72.65762184239274!3d22.7073515148438!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395ef5d4dbc30751%3A0x2ae600005d19c93a!2z4Kqu4Kq-4Kqk4KqwLCDgqpfgq4HgqpzgqrDgqr7gqqQgMzg3NTMw!5e0!3m2!1sgu!2sin!4v1734524051488!5m2!1sgu!2sin" width="500" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
			</div>
			<div class="mail-grids">
				<div class="col-md-6 mail-grid-left wow fadeInLeft animated" data-wow-delay="0.4s" style="visibility: visible; -webkit-animation-delay: 0.4s;">
					<h3>Contact Us</h3>	
					<p></p>				
					<h4>Hmc Institute of Technology</h4>
					<p>NH 48 ,
						<span>Matar, Sasoon Dock, Mumbai</span>
						India IN-387 530
					</p>
					<h4>Get In Touch</h4>
					<p>Telephone: +91 9723947850
						<span>FAX: +91 9429074195</span>
						E-mail: <a href="mailto:solankiatulr2011@gmail.com">solankiatulr2011@gmail.com</a>
					</p>
				</div>
				<div class="col-md-6 contact-form wow fadeInRight animated" data-wow-delay="0.4s" style="visibility: visible; -webkit-animation-delay: 0.4s;">
				<form action="mail.php" method="POST">
						<input type="text" name="name" placeholder="Name" required="">
						<input type="email" name="email" placeholder="Email" required="">
						<input type="text" name="subject" placeholder="Subject">
						<textarea name="message" placeholder="Message" required=""></textarea>
						<input type="submit" value="SEND">
					</form>

				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
		<!-- //container -->
	</div>
	<!-- //mail -->
	<!-- footer -->
		<div class="footer">
			<!-- container -->
			<div class="container">
				<div class="col-md-6 footer-left  wow fadeInLeft animated" data-wow-delay="0.4s" style="visibility: visible; -webkit-animation-delay: 0.4s;">
					<ul>
						<li>
							<a href="index.php">Home</a>
						</li>
						<li>
							<a href="about.php">About</a>
						</li>
						<li>
							<a href="products.php">Campus Drives</a>
						</li>
						<li>
							<a href="../Gallery/index.html">Gallery</a>
						</li>
						<li>
							<a href="mail.php">Mail Us</a>
						</li>
					</ul>

				</div>
				<div class="col-md-3 footer-middle wow bounceIn animated" data-wow-delay="0.4s" style="visibility: visible; -webkit-animation-delay: 0.4s;">
					<h3>Address</h3>
					<div class="address">
						<p>Hmc
							<span>Sasoon Dock, Mumbai</span>
						</p>
					</div>
					<div class="phone">
						<p>+91 9723947850</p>
					</div>
				</div>
				<div class="col-md-3 footer-right  wow fadeInRight animated" data-wow-delay="0.4s" style="visibility: visible; -webkit-animation-delay: 0.4s;">
					<h6 style="color: white">Hmc Institute of Technology</h6>
					<h4>
						<a href="../Homepage/index.php" style="color: white">Placement Management System</a>
					</h4>
					<p></p>
				</div>
				<div class="clearfix"></div>
			</div>
			<!-- //container -->
		</div>
		<!-- //footer -->
		<div class="copyright">
			<!-- container -->
			<div class="container">
				<div class="copyright-left wow fadeInLeft animated" data-wow-delay="0.4s" style="visibility: visible; -webkit-animation-delay: 0.4s;">
					 <p>Copyright &copy; 2024 Hmc-PMS | Developed by
              <a href="" target="_parent">Hmc FutureTechnologies</a>
				</div>
				<div class="copyright-right wow fadeInRight animated" data-wow-delay="0.4s" style="visibility: visible; -webkit-animation-delay: 0.4s;">
					<ul>
						<li>
							<a href="#" class="twitter"> </a>
						</li>
						<li>
							<a href="#" class="twitter facebook"> </a>
						</li>
						<li>
							<a href="#" class="twitter chrome"> </a>
						</li>
						<li>
							<a href="#" class="twitter pinterest"> </a>
						</li>
						<li>
							<a href="#" class="twitter linkedin"> </a>
						</li>
						<li>
							<a href="#" class="twitter dribbble"> </a>
						</li>
					</ul>
				</div>
				<div class="clearfix"></div>
			</div>
		<!-- //container -->
	</div>
</body>
</html>