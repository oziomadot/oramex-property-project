<?php
require_once 'backend/authController.php';






?>


<!DOCTYPE html>
<html lang="en">
<head>
	<title>Registration page</title>
	<meta charset ="UTF-8">
	<meta name="keywords" content="rent, flats, rooms,apartments,house">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href= https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css>
    <script src= "https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
      <script src= "https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <meta name="author" content="Ezeomeke Ozioma">
	<meta name="description" content="rent a home at your finger tip">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel="icon" type="image/x-icon" href="favicon.ico">
  <link rel="stylesheet" href="normalize.css">
	<link rel="stylesheet" href="style.css">



  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
	
</head>

	<body>
<header>

<div  id="AniP">
	<h1>ORAMEX HOMES</h1>
	</div>	

 


<nav class="navbar navbar-expand-lg navbar-inverse  navbar-light bg-light">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>

   
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
    <li class="nav-item active">
        <a   href="index.php"> Home </a>
      </li><br>
      <li class="nav-item">
        <a href="about.php">About</span></a>
      </li><br>
      <li class="nav-item">
        <a href="register.php">Upload apartment</a>
      </li><br>
      <li class="nav-item">
        <a  href="contact.php">Contact</a>
      </li><br>
      <li class="nav-item">
        <a  href="vacancy.php">Work with us</a>
      </li><li class="nav-item">
        <a  href="Help.php">Help</a>
      </li>
  
      
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>

</header>

		<?php
	include('header.php');
	?>
		<section>
			<div>
				<?php 
					

					if ( isset($_SESSION['error'])  ) {
						echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
						unset($_SESSION['error']);
					}
					if ( isset($_SESSION['success'])) {
						echo '<p style="color:green">'.$_SESSION['success']."</p>\n";
						unset($_SESSION['success']);
					}

					//placeholder for input
					$surname = isset($_POST['surname']) ? $_POST['surname'] : '';
					$firstname = isset($_POST['firstname']) ? $_POST['firstname'] : '';
					$othername = isset($_POST['othername']) ? $_POST['othername'] : '';
					$email= isset($_POST['email']) ? $_POST['email'] : '';
					$password = isset($_POST['password']) ? $_POST['password'] : '';
					$phonenumber = isset($_POST['phonenumber']) ? $_POST['phonenumber'] : '';
					$refeeralid = isset ($_POST['refeeralid']) ? $_POST['refeeralid'] : '';
					
				?>


			</div><br>
			<div>
				<br>
				<h4>Register for agents or landlords</h4> 
				<div class="agentlandlords">
				
				
					<h3>Login</h3><br>
					<form action="register.php" method="post">
						<label for="username">Phone Number or Email</label>
						<input type="text" id="username" value="<?= htmlentities($email || $phonenumber) ?>" name="username" autofocus required><br><br>
						<label for="loginpassword">Password</label>
						<input type="password" id="loginpassword" name="password" value="<?= htmlentities($password) ?>" required><br><br>
						<button type="submit" name="agentlogin-btn" class="btn btn-primary btn-inline-block btn-lg">Login</button> 
						<input type="reset">
						<div style = "font-size: 1.2em; text-align: left;"><a href="forgotpassword.php">Forgot Password?</a></div>
					</form>
				</div>


				<div class="agentlandlords">
					<h3>Registration</h3> <br>

										
			
				
					<form action="register.php" method="post" class="row g-3 needs-validation" novalidate><br>
					
					<div class="col-md-6">
						<label for="validationCustom01" class="form-label">Surname</label>
						<input type="text" class="form-control" id="validationCustom01" name="surname" value="<?= htmlentities($surname) ?>" required>
						<div class="valid-feedback">
      					Looks good!
    					</div>
  						</div>
						

						<div class="col-md-6">
						<label for="validationCustom02" class="form-label">First name</label>
						<input type="text" class="form-control" id="validationCustom02" name="firstname" value="<?= htmlentities($firstname) ?>" required>
						<div class="valid-feedback">
      						Looks good!
    					</div>
  						</div>

						
						<div class="col-md-6">
						<label for="othername" class="form-label">Othername</label>
						<input type="text" class="form-control" id="othername" name="othername" value="<?= htmlentities($othername) ?>"><br>
						</div>


						<div class="col-md-6">
						<label for="validationCustom03" class="form-label">Email</label>
						<input type="email" class="form-control" id="validationCustom03" value="<?= htmlentities($email) ?>" name="email" required>
						<div class="valid-feedback">
      						Looks good!
    					</div>
  						</div>


						<div class="col-md-6">
						<label for="password" class="pr-password">Choose a Password:</label>
						<input type="password" class="form-control" id="psw" name="password" value="<?= htmlentities($password) ?>" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
					
						<div id="message">
  <h5>Password must contain the following:</h3>
  <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
  <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
  <p id="number" class="invalid">A <b>number</b></p>
  <p id="length" class="invalid">Minimum <b>8 characters</b></p>
</div>			
    
						</div>


						<div class="col-md-6">
						<label for="passwordConf" class="form-label">Confirm Password:</label>
						<input type="password"  class="form-control" id="passwordConf" name="passwordConf" required>
						
						<div style="margin-top: 7px;" id="CheckPasswordMatch"></div>
						<br></div>


						<div class="col-md-6">
						<label for="validationCustom05" class="form-label">Phone Number</label>
						<input type="tel" id="validationCustom05" class="form-control" name="phonenumber" value="<?= htmlentities($phonenumber) ?>" placeholder="080-000-00000" pattern="[0-9{3}-[0-9]{3}-[0-9]{5}" required maxlength="11" required >
						<div class="valid-feedback">
      						Looks good!
    					</div>
  						</div>
						<br>
						

						<div class="col-md-6">
						<label for="refeeralid" class="form-label">Referal ID</label>
						<input type="text" id="refeeralid"  class="form-control" value="<?= htmlentities($refeeralid)  ?>" name="refeeralid">
						
  						</div>

					
						
						<br>
						<br>
						<div class="col-md-4">
						<button type="submit" id="submitform" name="signup-btn" class="btn btn-primary btn-inline-block btn-lg">Sign Up</button>
						<input type="reset" value="Reset">
						</div>
					</form>
				</div>
				</div>

						
				
		
		</section>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="http://code.jquery.com/jquery-1.7.min.js"></script>
		<link rel="stylesheet" href="style.css">
		<!-- <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script> -->
		<script src="//cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>


		<!-- new jquery -->
		
	

		<script type="text/javascript">

var myInput = document.getElementById("psw");
var letter = document.getElementById("letter");
var capital = document.getElementById("capital");
var number = document.getElementById("number");
var length = document.getElementById("length");

// When the user clicks on the password field, show the message box
myInput.onfocus = function() {
  document.getElementById("message").style.display = "block";
}

// When the user clicks outside of the password field, hide the message box
myInput.onblur = function() {
  document.getElementById("message").style.display = "none";
}

// When the user starts to type something inside the password field
myInput.onkeyup = function() {
  // Validate lowercase letters
  var lowerCaseLetters = /[a-z]/g;
  if(myInput.value.match(lowerCaseLetters)) {  
    letter.classList.remove("invalid");
    letter.classList.add("valid");
  } else {
    letter.classList.remove("valid");
    letter.classList.add("invalid");
  }
  
  // Validate capital letters
  var upperCaseLetters = /[A-Z]/g;
  if(myInput.value.match(upperCaseLetters)) {  
    capital.classList.remove("invalid");
    capital.classList.add("valid");
  } else {
    capital.classList.remove("valid");
    capital.classList.add("invalid");
  }

  // Validate numbers
  var numbers = /[0-9]/g;
  if(myInput.value.match(numbers)) {  
    number.classList.remove("invalid");
    number.classList.add("valid");
  } else {
    number.classList.remove("valid");
    number.classList.add("invalid");
  }
  
  // Validate length
  if(myInput.value.length >= 8) {
    length.classList.remove("invalid");
    length.classList.add("valid");
  } else {
    length.classList.remove("valid");
    length.classList.add("invalid");
  }
}


$(document).ready(function() {

	$("#confirm_password").on('keyup', function() {
        var password = $("#psw").val();
        var confirmPassword = $("#passwordConf").val();
        if (password != confirmPassword)
          $("#CheckPasswordMatch").html("Password does not match !").css("color", "red");
        else
          $("#CheckPasswordMatch").html("Password match !").css("color", "green");
      });	

	  ("#submitform").click(function(){
alert("Thanks for registering with ORAMEX PROPERTY staff. Please, always check your email "+ $('#email').val()+" for further information. ");
return true;
});

});

</script>
	</body>
</html>