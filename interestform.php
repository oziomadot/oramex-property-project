<?php 

require_once 'backend/authController.php';


//include('class/Appointment.php');


//$utye = $_GET['$gid'];
  $gid = $_GET['Property_number'];
  //$dyyde = $_SESSION['Property_number'];

//   $sql = "SELECT  agent_id
//    FROM property
//    WHERE Property_number = :xyz"; 
//      $stmt = $pdo->prepare($sql);

//    $stmt->execute(array( ':xyz' => $dyyde));
//    $rows = array();
  
//    $row = $stmt->fetch(PDO::FETCH_ASSOC);

// 		$agentid4appointment = $row;


// //if (!isset($_GET['Property_number']))  {
// 	if (!isset($gid))  {
// 	$_SESSION['error'] = "Missing Property Number";
// 	header('Location: index.php');
// 	return;
//   }
  




?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Interest Form</title>

		
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
	<?php

//login.php

//include('header.php');

?>




<div class="container">
	<div class="row justify-content-md-center">
		<div class="col col-md-6">
			<span id="message"></span>
			<div class="card">
				<div class="card-header">Register</div>
				<p>Please fill in this form to register for appointment with the agent for inspection. These details are needed to contact you.</p>
				<div class="card-body">
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
    ?>
	</div>
					<form method="post" id="customer_register_form" action="interestform.php">
					<div class="form-group">

							
							<input type="hidden" name="apartment_number" id="apartment_number" value ="<?php echo($gid); ?>" class="form-control" required  readonly  />
						</div>
						<div class="form-group">
							<label>Email Address<span class="text-danger">*</span></label>
							<input type="text" name="email" id="customer_email_address" class="form-control" required autofocus  />
						</div>
						
						<div class="row">
							
								<div class="form-group">
									<label> Name<span class="text-danger">*</span></label>
									<input type="text" name="Client_name" id="customer_first_name" class="form-control" required  />
								</div>
							</div>
							
							<div class="row">
							
								<div class="form-group">
									<label>Whatsapp number<span class="text-danger">*</span></label>
									<input type="tel" name="Phone_number" id="customer_whatsapp" class="form-control" placeholder="080-000-00000" pattern="[0-9{3}-[0-9]{3}-[0-9]{5}" required maxlength="11"  />
								</div>
							</div>
						
						<div class="row">
							
								<div class="form-group">
									<label>Phone number<span class="text-danger">*</span></label>
									<input type="tel" name="whatsapp_number" id="customer_phone_no" class="form-control" placeholder="080-000-00000" pattern="[0-9{3}-[0-9]{3}-[0-9]{5}" required maxlength="11"  />
								</div>
							</div>
							
						
						<div class="form-group text-center">
						<input type="hidden" name="action" value="patient_login" />
							<input type="submit" name="customer_reg" id="customer_register_button" class="btn btn-primary btn-inline-block btn-lg" value="Submit">
						</div>

					</form>
				</div>
			</div>
			<br />
			<br />
		</div>
	</div>
</div>




<script>

$(document).ready(function(){

	// $('#patient_date_of_birth').datepicker({
    //     format: "yyyy-mm-dd",
    //     autoclose: true
    // });
	// $('#customer_register_form').on('submit', function(event){
	// 	//$("#customer_register_button").click(function () {
	// $('#customer_register_button').attr('disabled', 'disabled');
	// $("#bookappo").toggle()
	
	
	
	//$("#hiddentag1").click(function () {
//$("#stafflogin").toggle()

});
	
	// $('#customer_register_form').parsley();

	// $('#customer_register_form').on('submit', function(event){

	// 	event.preventDefault();

	// 	if($('#patient_register_form').parsley().isValid())
	// 	{
	// 		$.ajax({
	// 			url:"action.php",
	// 			method:"POST",
	// 			data:$(this).serialize(),
	// 			dataType:'json',
	// 			beforeSend:function(){
	// 				$('#patient_register_button').attr('disabled', 'disabled');
	// 			},
	// 			success:function(data)
	// 			{
	// 				$('#patient_register_button').attr('disabled', false);
	// 				$('#patient_register_form')[0].reset();
	// 				if(data.error !== '')
	// 				{
	// 					$('#message').html(data.error);
	// 				}
	// 				if(data.success != '')
	// 				{
	// 					$('#message').html(data.success);
	// 				}
	// 			}
	// 		});
	// 	}

	// });

//});

</script>

</body>
</html>