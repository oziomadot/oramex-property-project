<!-- <head> -->
<?php

//index.php

//include('class/Appointment.php');
require_once 'backend/authController.php';

//include('header.php');

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>book appointment</title>
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

	<body>

<body>
<div id ="bookappo">
<div class="container">
	<div class="row justify-content-md-center">
		<div class="col col-md-6">
			<span id="message"></span>
			<div class="card" >
				<div class="card-header">Confirm Appointment</div>
				<div class="card-body">

				<form method="Post" id="book_appointment_form" action="bookappointment.php">
					
				<h4 class="text-center">Customer Details</h4>

		
		<!-- <table class="table">
		

		
	
			<tr>

	
				<th width="40%" class="text-right"> -->
				<div class="input-group mb-3">
				<label><span class="input-group-text" id="basic-addon1">Customer Name</span></label>
  				<input type="text" class="form-control" name ="customer_name" value ="<?php echo($_SESSION['Client_name']); ?>" readonly aria-describedby="basic-addon1"/>
				</div>

				
				<div class="input-group mb-3">
				<label><span class="input-group-text" id="basic-addon1">Contact No.</span></label>
			<input type="text" class="form-control" name ="customer_phone_number" value ="<?php echo($_SESSION['Phonenumber']); ?>" readonly /><aria-describedby="basic-addon1"/>
				</div>

				<div class="input-group mb-3">
				<label><span class="input-group-text" id="basic-addon1">Property Number</span></label>
				<input type="text" class="form-control" name ="Property_number" value ="<?php echo($_SESSION['Property_number']); ?>" readonly aria-describedby="basic-addon1"/>
				</div>
			<input type="hidden" class="form-control" name ="weaked_agent_schedule_id"  value ="<?php echo($_SESSION["agent_schedule_id"]);?>" readonly />
			<input type="hidden" class="form-control" name ="customer_id"  value ="<?php echo($_SESSION["customerid"]);?>" readonly />
			<input type="hidden" class="form-control" name ="email" value ="<?php echo($_SESSION['email']); ?>" readonly />
				
			
		
	
		<hr />
		<h4 class="text-center">Appointment Details</h4>
		
		
		<div class="input-group mb-3">
				<label><span class="input-group-text" id="basic-addon1">Agent Name</span></label>
				<input type="text" class="form-control" name ="agent_firstname"  value ="<?php echo($_SESSION["agent_firstname"]) ?>" readonly aria-describedby="basic-addon1"/>
				</div>
			
				<div class="input-group mb-3">
				<label><span class="input-group-text" id="basic-addon1">Appointment Date</span></label>
				<input type="text" class="form-control" name ="agent_schedule_date"  value ="<?php echo($_SESSION["agent_schedule_date"]); ?>" readonly aria-describedby="basic-addon1"/>
				</div>

				<div class="input-group mb-3">
				<label><span class="input-group-text" id="basic-addon1">Appointment Day</span></label>
				<input type="text" class="form-control" name ="agent_schedule_day"  value ="<?php echo($_SESSION["agent_schedule_day"]); ?>" readonly aria-describedby="basic-addon1"/>
				</div>

				<div class="input-group mb-3">
				<label><span class="input-group-text" id="basic-addon1">Available Time</span></label>
				<!-- <input type="text" class="form-control" name ="agent_schedule_start_time"  value ="<?php echo($_SESSION["agent_schedule_start_time"]. '-' .$_SESSION["agent_schedule_end_time"]); ?>" readonly /> -->
				   </div>
				
			<input type="hidden" class="form-control" name ="hidden_agent_id"  value ="<?php echo($_SESSION["agent_id"]);?>" readonly />
			
			
		
		
		<div class="form-group text-center">
							
							<input type="submit" name="book_appointment" class="btn btn-primary" value="Confirm" />
							<!-- //id="customer_book_button"  -->
						</div>
						
					</form>

					</div>
			</div>
			<br />
			<br />
		</div>
	</div>
</div>
</div>
		





					
				


<?php

include('footer.php');

?>

<!-- </body> -->