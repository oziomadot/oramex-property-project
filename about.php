<?php require_once 'backend/authController.php';
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>About Oramex Property</title>
		<meta charset ="UTF-8">
	<meta name="keywords" content="rent, flats, rooms,apartments,house">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/8842871648.js" crossorigin="anonymous"></script>

<!-- reference your copy of Font Awesome here in the head (from our CDN or by hosting yourself) -->
  <link href="https://kit.fontawesome.com/8842871648.js/css/fontawesome.css" rel="stylesheet">
  <link href="https://kit.fontawesome.com/8842871648.jse/css/brands.css" rel="stylesheet">
  <link href="https://kit.fontawesome.com/8842871648.js/css/solid.css" rel="stylesheet">






    <script src= "https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
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
	
</head>
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
      </li><br>
	  <li class="nav-item">
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
	<body >

<div class="container">
		<div style="border-width: 10px;" class="row">
			<h3>STAFF AND MANAGEMENT</h3>
    </div>

    <div class="row">
		<?php
	$sql = "SELECT profile_pic, Surname, First_name, designation, Work_Phonenumber, Staff_id, instagram, tweeter, philosophy  FROM staff WHERE Approved = :approved ";
	$stmt = $pdo->prepare($sql);
	$stmt->execute(array ( 
		':approved' => 'Yes'
	));
	
	

			 

    while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {

   //$oneroomapartment = $row;
	
   ?>
  
 
  <div class="col-md-3 col-sm-6">
<div class="card" style="width: 20rem;" >
 
	<img
	<?php

		
		$imagesDirectory = "profilepic/";
		$detg =  $row['Staff_id'];
  	//$key = '$detg';

      if(is_dir($imagesDirectory))
  {
  
    $opendirectory = opendir($imagesDirectory);
   
    
      while (($image = readdir($opendirectory)) !== false)
    {
      
       if(($image == '.') || ($image == '..'))
      {
   
  
        continue;
      }
      
      $imgFileType = pathinfo($image,PATHINFO_EXTENSION);
      
      $nameimg = $row['designation'];
  
        if(($imgFileType=='jpg' || $imgFileType=='png') && strpos($image, $detg)!==false ){
      echo "<img src='$imagesDirectory".$image."'    class='card-img-top' alt='image of '.$nameimg.'' />" ;
		} 
      }
     closedir($opendirectory);
    };
  
?>
/>
 

<div  class="card-body" style=" background-color:#f1f1f1; width: 20rem; " >
<p class="card-text"> <?php echo $row['Surname']. ' ' .$row['First_name']; ?></p> 
<p class="card-text" style="text-align: left; display: block; padding:0% border:0%;"> <?php echo $row['designation']; ?></p> <p class="card-text" style="text-align: left; display: block; padding:0% border:0%;"> <i class="fa fa-phone" aria-hidden="true"><?php echo $row['Work_Phonenumber']; ?></i></p>
<p class="card-text"><i class="fa fa-twitter" aria-hidden="true"><?php echo $row['tweeter']; ?></i> </p>  <p class="card-text"> <i class="fa fa-instagram" aria-hidden="true"><?php echo $row['instagram']; ?></i></p>
<p class="card-text"> <i class="fa fa-certificate" aria-hidden="true"></i><?php echo $row['philosophy']; ?></i></p>

</div>
</div>
</div>
<?php
}; ?> 


  

    </div>



<div>	
		<?php 
					

					if ( isset($_SESSION['error'])) {
						
						echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
						unset($_SESSION['error']);
					}
					if ( isset($_SESSION['success'])) {
						echo '<p style="color:green">'.$_SESSION['success']."</p>\n";
						unset($_SESSION['success']);
					}
    ?>
</div>

<div class="container">
  <div class="row">
    <div class="col">
<h3 >ABOUT</h3>
<div class="card">
  <div class="card-body">
<p style="font-family: Cambria; font-size: 2vw">Oramex Enterprise was register in Nigeria with CAC in 2014. It is an ICT solution and service provide. After years of doing business in ICT, Oramex Enterprise has given birth to Oramex Property Agency and Management. OPAM is focused on making apartment managment and agency services easy, faster and safe. Through ICT plateform, OPAM intend to make easy for people in Nigeria to find their dream house for rent at their finger tips. OPAM intend to give a wholistic management of apartments, rents and making it safe and easy for landlords, tenants and agents. </p>
</div></div></div></div>

<div class="row">
<div class="col-md-3">
<h3 >MISSION</h3>
<div class="card">
  <div class="card-body">
<p style="font-family: Didot; font-size: 2vw">Easy life for everyone. </p>
</div></div></div>

<div class="col-md-6">

<h3>VISSION</h3>
<div class="card">
  <div class="card-body">
<p style="font-family: Didot; font-size: 2vw">To be the best platform that provide solution renting and management of apartment through our strategic and ever growing strategies and solution.</p>
</div></div></div>

<div class="col-md-3">
<h3>VALUES</h3>
<div class="card">
  <div class="card-body">
<ol style="font-family: Didot; font-size: 2vw">
  <li class="list-group-item"><i class="fa-solid fa-circle-check"></i>Innovations</li>
<li class="list-group-item"><i class="fa-solid fa-circle-check"></i>Diversity and inclusion</li>
<li class="list-group-item" ><i class="fa-solid fa-circle-check"></i>Trustworthy</li>
<li class="list-group-item"><i class="fa-solid fa-circle-check"></i>Safety</li>
<li style="float: left; text-align: left;" class="list-group-item"><i class="fa-solid fa-circle-check"></i>Saving time and Energy </li>
</ol>
  </div></div></div>
</div></div>

		<div class= "container-md">

<p id='staffclick'>If you are a staff, please, <a id ="hiddentag1" href="#"> click here to login </a>.



<div   class="col-md-4" id ="stafflogin" style = "display: none" >
<div class="row ">
					<h4>Login</h4>
</div>

					<div>
            <?php 
					

				


					$staffid = isset($_POST['staff_id']) ? $_POST['staff_id'] : '';
					$password = isset($_POST['password']) ? $_POST['password'] : '';
					

										
				?>
				</div>
<div class="row">
					<form action="about.php" method="post">
						<label for="staffid" class="form-label">Staff ID</label>
						<input class="form-control" type="text" id="staffid" value="<?= htmlentities($staffid) ?>" name="staff_id" autofocus required><br><br>
						
						<label for="password" class="form-label">Password</label>
						<input class="form-control" type="password" id="loginpassword" name="password" value="<?= htmlentities($password) ?>" required><br><br>
						
						<div class="form-check">
  
						<p>Select login type</p>
						
						<input class="form-check-input" type="radio" name="logintype" value="admin">
						<label for="admin" class="form-check-label">Admin</label><br>
						
						<input class="form-check-input" type="radio" name="logintype" value="staff">
						<label for="staff" class="form-check-label">Staff</label><br>
						</div>
						
						<button type="submit" name="stafflogin-btn" class="btn btn-primary btn-inline-block btn-lg">Login</button> 
						<input type="reset">
						<p><a href="forgot-password.html">Forgot Password</a></p>
						<p>New staff, <a id ="hiddentag2" href="#">click here to signup</a></p>
					</form>
</div>
					
<div class="col-md-4" id ="staffreg" style = "display: none">
					<h4>Registration</h4>

					<div><?php 
					

				

					

					$surname = isset($_POST['surname']) ? $_POST['surname'] : '';
					$firstname = isset($_POST['firstname']) ? $_POST['firstname'] : '';
					$othername = isset($_POST['othername']) ? $_POST['othername'] : '';
					$email= isset($_POST['email']) ? $_POST['email'] : '';
					$phonenumber = isset($_POST['phonenumber']) ? $_POST['phonenumber'] : '';
					$designation = isset ($_POST['designation']) ? $_POST['designation'] : '';
					$tweeter = isset ($_POST['tweeter']) ? $_POST['tweeter'] : '';
					$instagram = isset ($_POST['instagram']) ? $_POST['instagram'] : '';
					$philosophy = isset ($_POST['philosophy']) ? $_POST['philosophy'] : '';

											

										
				?>
				</div>
					<form action="about.php" method="post" enctype="multipart/form-data">
					<p id="head"></p>
          <div class="mb-3">
						<label for="surname" class="form-label">Surname</label>
						<input class="form-control" type="text" id="surname" name="surname" value="<?= htmlentities($surname) ?>" required>
						<p id="p2"></p>
          </div>

						<label for="firstname" class="form-label">First name</label>
						<input class="form-control" type="text" id="firstname" name="firstname" value="<?= htmlentities($firstname) ?>" required>
						<p id="p1"></p><br><br>

						<label for="othername" class="form-label">Othername</label>
						<input class="form-control" type="text" id="othername" name="othername" value="<?= htmlentities($othername) ?>"><br><br>

						<label for="email" class="form-label">Email</label>
						<input class="form-control" type="email" id="email" value="<?= htmlentities($email) ?>" name="email" required>
						<p id="p3"></p><br><br>

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


						<div class="col-lg-6">
						<label for="passwordConf" class="form-label">Confirm Password:</label>
						<input type="password"  class="form-control" id="passwordConf" name="passwordConf" required>
						
						<div style="margin-top: 7px;" id="CheckPasswordMatch"></div>
						<br></div>

						<label for="phonenumber" class="form-label">Personal Phone Number</label>
						<input class="form-control" type="tel" id="phonenumber" name="phonenumber" value="<?= htmlentities($phonenumber) ?>" placeholder="080-000-00000" pattern="[0-9{3}-[0-9]{3}-[0-9]{5}" required maxlength="11" required >

						<label for="phonenumber" class="form-label">Work Phone Number</label>
						<input class="form-control" type="tel" id="workphonenumber" name="workphonenumber" value="<?= htmlentities($phonenumber) ?>" placeholder="080-000-00000" pattern="[0-9{3}-[0-9]{3}-[0-9]{5}" required maxlength="11" required > <br> <br>
						
						<label for="designation" class="form-label">Designation</label>
						<input class="form-control" type="text" id="designation" name="designation" value="<?= htmlentities($designation) ?>" required><br><br> 

						<label for="Tweeter" class="form-label">Tweeter</label>
						<input class="form-control" type="text" id="tweeter" name="tweeter" value="<?= htmlentities($tweeter) ?>" ><br><br>
						
						<label for="instagram" class="form-label">Instagram</label>
						<input class="form-control" type="text" id="instagram" name="instagram" value="<?= htmlentities($instagram) ?>" ><br><br> 

						<label for="philosophy" class="form-label">Philosophy</label>
						<input class="form-control" type="text" id="philosophy" name="philosophy" value="<?= htmlentities($philosophy) ?>" ><br><br> 
						

					 <!-- <form action="register.php" method="post" enctype="multipart/form-data"> -->
						<label for="Profilepix" class="form-label">Upload profile pix</label>
						<input class="form-control" type="file" id="profilepic" name= "profile_pic" accept="image/*"  required >
						<p id="imagesize"></p>
						<div class="user-image mb-3 text-center">
        
          
		<img src="..." class="figure-img img-fluid rounded" id="imgPlaceholder" alt="">
		
        </div>
      			
	  <br>
						<button type="submit" name="staffsignup-btn" id="submitform" class="btn btn-primary btn-inline-block btn-lg">Sign Up</button>
						<input type="reset" value="Reset">
						<!-- </form> -->
					</form>
				</div>
				
				</div>
			
</p>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>


  <script>

$(document).ready(function() {
$("#hiddentag1").click(function () {
$("#stafflogin").toggle()

});


$("#hiddentag2").click(function () {
$("#staffreg").toggle()
});

$('#profilepic').bind('change', function() {
        var a=(this.files[0].size);
		if(a < 2000000){ $('#imagesize').html(a);
		};
     
        if(a > 2000000) {
			$('#imagesize').addClass('error');
			$('#imagesize').html("Image is more tna 200mb. Please reduce the image");
           
        };
    });


	

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




	$("#confirm_password").on('keyup', function() {
        var password = $("#psw").val();
        var confirmPassword = $("#passwordConf").val();
        if (password != confirmPassword)
          $("#CheckPasswordMatch").html("Password does not match !").css("color", "red");
        else
          $("#CheckPasswordMatch").html("Password match !").css("color", "green");
      });	

	  $("#submitform").click(function(){
alert("Thanks for registering with ORAMEX PROPERTY staff. Please, always check your email "+ $('#email').val()+" for further information. ");
return true;
});









    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
          $('#imgPlaceholder').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]); // convert to base64 string
      }
    }
    $("#profilepic").change(function () {
      readURL(this);
    });
});
  </script>
</body>
</html>