<?php
require_once 'backend/authController.php';






?>


<!DOCTYPE html>
<html lang="en">
<head>
	<title>Help</title>
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
	
</head>

<body >

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
<div class="contianer">
<div class="row">
  <div class="col"></div>

<div class="col-4">

<h2> Apply for refund</h2>

<form action="help.php" method="post" enctype="multipart/form-data">
  <fieldset>
    <legend>Refund application form</legend>

    <label for="name">Name</label>
    <input type="text" class="form-control" id="name"  placeholder="FULL NAME" data-toggle="tooltip" data-placement="bottom" title="Full name as contained in the payment evidence/ slip" reguired>

  
    <label for="email">Email address</label>
    <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" data-toggle="tooltip" data-placement="bottom" title="The email address you register for appoinment with" reguired>

    <label for="phonenumber">Phone Number</label>
    <input type="number" class="form-control" id="phonenumber" name="phonenumber" placeholder="08030000000" data-toggle="tooltip" data-placement="bottom" title="The phone number you register for appoinment with" required>
    
    <label for="Bankname">Bank Name</label>
    <input type="text" class="form-control" id="bankname" name="bankname" placeholder="XYZ BANK" data-toggle="tooltip" data-placement="bottom" title="The Bank name you made payment from " required>

    <label for="accountnumber">Account number</label>
    <input type="number" class="form-control" id="accountnumber"  name = "accountnumber" placeholder="0458745241" data-toggle="tooltip" data-placement="bottom" title="The Bank Accoun number you made payment with " required>
  

    <button type="submit" id="submitform" name="refund-submit-btn" class="btn btn-primary btn-inline-block btn-lg">Refund</button>
						<input type="reset" value="Reset">
  </fieldset>
</form>
</div>
<div class="col"></div>
</div></div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>


  <script>

$(document).ready(function() {
  	  $("#submitform").click(function(){
alert("You have applied for fund, you will hear from us between 3 - 5 working days. Please, always check your email "+ $('#email').val()+" for further information. ");
return true;
});

  $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
});
</script>
</body>
</html>