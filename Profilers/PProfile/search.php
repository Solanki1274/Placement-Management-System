<?php
  session_start();
 if (isset($_SESSION['pusername'])){
    
	
	   }
   else {
	   header("location: index.php");}
   
?>

<!DOCTYPE html>
<style>
  /* Global Styles */
body {
    font-family: 'Arial', sans-serif;
    background-color: #f5f5f5;
    margin: 0;
    padding: 0;
}

/* Form Container */
.templatemo-login-form {
    max-width: 600px; /* Limit the width */
    margin: 50px auto; /* Center the form */
    background: white; /* White background for the form */
    border-radius: 8px; /* Rounded corners */
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow */
    padding: 30px; /* Padding around the form */
}

/* Input Styles */
.form-control {
    width: 100%; /* Full width */
    padding: 12px; /* Padding inside the input */
    margin: 10px 0; /* Space between inputs */
    border: 1px solid #ccc; /* Light border */
    border-radius: 4px; /* Slightly rounded corners */
    transition: border-color 0.3s; /* Transition effect for focus */
}

.form-control:focus {
    border-color: #007bff; /* Change border color on focus */
    outline: none; /* Remove default outline */
}

/* Button Styles */
.templatemo-blue-button, .templatemo-white-button {
    padding: 10px 15px; /* Padding for buttons */
    border: none; /* No border */
    border-radius: 4px; /* Rounded corners */
    font-size: 16px; /* Font size for buttons */
    cursor: pointer; /* Pointer cursor on hover */
    transition: background-color 0.3s, color 0.3s; /* Transition for hover effect */
}

.templatemo-blue-button {
    background-color: #007bff; /* Blue background */
    color: white; /* White text */
}

.templatemo-blue-button:hover {
    background-color: #0056b3; /* Darker blue on hover */
}

.templatemo-white-button {
    background-color: white; /* White background */
    color: #007bff; /* Blue text */
    border: 1px solid #007bff; /* Blue border */
}

.templatemo-white-button:hover {
    background-color: #007bff; /* Blue background on hover */
    color: white; /* White text */
}

/* Footer Styles */
footer {
    padding: 15px; /* Padding around footer */
    text-align: center; /* Centered text */
    background-color: #007bff; /* Blue background */
    color: white; /* White text */
    position: relative;
    bottom: 0;
    width: 100%;
    height: 60px; /* Fixed height for footer */
}

footer a {
    color: white; /* White links */
    text-decoration: underline; /* Underlined links */
}

footer a:hover {
    text-decoration: none; /* Remove underline on hover */
}

/* Responsive Styles */
@media (max-width: 600px) {
    .templatemo-login-form {
        padding: 20px; /* Reduce padding on smaller screens */
    }

    .form-control {
        font-size: 14px; /* Smaller font size */
    }

    .templatemo-blue-button, .templatemo-white-button {
        font-size: 14px; /* Smaller button font size */
    }
}

  </style>
<html lang="en">
 
            
            <form action="COUNT1.PHP" class="templatemo-login-form" method="POST" enctype="multipart/form-data">
			
                              
				<div class="col-lg-6 col-md-6 form-group">
                  <label for="sslc">Company Name</label>
                  <input type="text" name="cname" class="form-control" id="sslc" placeholder="">
                </div>
				
				<div class="col-lg-6 col-md-6 form-group">
                  <label for="BE">Date</label>
                  <input type="date" name="date" class="form-control" id="BE" placeholder="">
                </div>
                
                
				
                
				
          <br>
              <div class="form-group text-right">
                <button type="submit" name="submit" class="templatemo-blue-button">submit</button>
                <button type="reset" class="templatemo-white-button">Reset</button>
              </div>
            </form>
          </div>     
          
          <footer class="text-right">
           <p>Copyright &copy; 2024 Hmc-PMS | Developed by
              <a href="#" target="_parent">Hmc FutureTechnologies</a>
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