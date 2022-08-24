<?php 
require_once 'backend/authController.php';
include('class/Appointment.php');

if($_SESSION['type'] != 'Agent')
 {
     header("location: index.php");
 }

?>


<!DOCTYPE html>
<head>
	<html lang="en">
	<title>Apartment Information</title>
	<meta charset ="UTF-8">
	<meta name="keywords" content="rent, flats, rooms,apartments,house">
	<meta name="author" content="Ezeomeke Ozioma">
	<meta name="description" content="rent a home at your finger tip">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	
	<script src="https://kit.fontawesome.com/8842871648.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="normalize.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel="icon" type="image/x-icon" href="favicon.ico">
	<link rel="stylesheet" href="style.css">
</head>
<body>
<?php
	include('header.php');
	?>
<header>
	<div class="container">
<div class="row">
<h2>APARTMENT INFORMATION</h2>
</div>
<div class="row">
	<p>This form is expected to be filled by only agents or landlords who have buildings/apartment for rent</p>
</div>
	</div>
</header>
<div class="container">
<div class="row">
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
			
				</div>

<div class="row">
	<div class="col-md-6">
<h3>Apartment Details</h3>
</div></div><br>

<div  class="form-group">
	
<form action="register.php" method="post" enctype="multipart/form-data">

<div class="row">
<div class="col-md-4">
	<h4>Type of building</h4>

	
    <div class="form-check">
	<input type="radio" class="form-check-input" name="building" value="Bungalow">
	<label for="building" class="form-check-label">Bungalow</label><br>
	<input type="radio" class="form-check-input" name="building" value="Upstair">
	<label for="building" class="form-check-label">Upstair</label><br>
	</div>

	<h4>Type of rent</h4>

	
    <div class="form-check">
	<input type="radio" class="form-check-input" name="buildingtype" value="singlerooms">
	<label for="buildingtype" class="form-label">Single rooms</label><br>
	<input type="radio" class="form-check-input" name="buildingtype" value="selfcon">
	<label for="buildingtype" class="form-label">Selfcon</label><br>
	<input type="radio" class="form-check-input" name="buildingtype" value="duplex">
	<label for="buildingtype" class="form-label">Duplex</label><br>
	<input id="flats" class="form-check-input" type="radio" name="buildingtype" value="flats">
	<label for="buildingtype" class="form-label">Flats</label><br>
		<div id= "flattype" class= "flatbuildingtype" style= "display: none;">
		<div class="col-md-3">
		<select class="form-select" id="buildingtype" name="flatbuildingtype">
		<option value="onebedroom">One bedroom</option>
		<option value="twobedroom">Two bedroom</option>
		<option value="threebedroom">Three bedroom</option>
		<option value="fourbedroom">Four bedroom</option>
		</select></br></div>

		</div></div>

		
	<label for="buildingincompound" class="form-label">How many building in the compound</label>
	<input type="number" class="form-control" id="buildingincompound" name="buildingincompound">
		
<br>
	<h4>Available floor</h4>


	
    <div class="form-check">
	<input type="checkbox" class="form-check-input" id="firstfloor" name= "floor" value= "firstfloor">
	<label for="firstfloor" class="form-check-label">First floor</label>
	<br>
	<input type="checkbox"  class="form-check-input"id="secondfloor" name="floor" value= "secondfloor">
	<label for="secondfloor" class="form-check-label">Second floor</label>
	<br>
	<input type="checkbox" class="form-check-input" id="thirdfloor" name="floor" value= "thirdfloor">
	<label for="thirdfloor" class="form-check-label">Third floor</label>
	<br>
	<input type="checkbox" class="form-check-input" id="fourthfloor" name="floor" value= "fourthfloor">
	<label for="fourthfloor" class="form-check-label">Fourth floor</label>
	<br>
	<input type="checkbox" class="form-check-input" id="fifthfloor" name="floor" value= "fifthfloor">
	<label for="fifthfloor" class="form-check-label">Fifth floor</label>
	<br>
	<input type="checkbox" class="form-check-input"id="sixthfloor" name="floor" value= "sixthfloor">
	<label for="sixthfloor" class="form-check-label">Sixth floor</label>
	<br>
	</div><br>

	<h4>Facilities available:</h4>
	
	<div class="form-check">
	
	<input type="checkbox" class="form-check-input" id="dinning" name="dinning" value ='Yes'>
	<label for="dinning" class="form-check-label">Dinning Space</label><br>
	
	<input type="checkbox" class="form-check-input" id="electricity" name="electricity" value ='Yes'>
	<label for="electricity" class="form-check-label">Electricity</label><br>

	<input type="checkbox" class="form-check-input" id="fenced" name="fenced" value = 'Yes' >
	<label for="fenced" class="form-check-label">Fenced</label><br>

	<input type="checkbox" id="parkingspace" class="form-check-input" name="parkingspace" value = 'Yes'>
	<label for="Parkingspace" class="form-check-label">Car Parking Space</label><br>

	<input type="checkbox" class="form-check-input" id="compoundcleaner" name="compoundcleaner" value="yes">
	<label for="compoundcleaner" class="form-check-label">Compound Cleaner</label><br>

	<input type="checkbox" class="form-check-input" id="kitchen" name="kitchen" value = 'Yes'>
	<label for="kitchen" class="form-check-label">Kitchen</label><br>

	<input type="checkbox" class="form-check-input" id="kitchencabinet" name="kitchencabinet" value = 'Yes'>
	<label for="kitchencabinet" class="form-check-label">Kitchen cabinet</label><br>

	<input type="checkbox" class="form-check-input" id="woodrope" name="woodrope" value = 'Yes'>
	<label for="woodrope" class="form-check-label">Woodrope</label>	<br>

	<input type="checkbox" class="form-check-input" id="woodropecabinet" name="woodropecabinet" value = 'Yes'>
	<label for="woodropecabinet" class="form-check-label">Woodrope cabinet</label><br>

	</div>
		
	<label for="typeofmeter" class="form-label">Type of meter</label>
	<select id="typeofmeter" name="meter">
		<option value="nometer">No meter</option>
		<option value="prepaid">Prepaid Meter</option>
		<option value="postpaid">Postpaid Meter</option>
		</select><br>
	<label for="overheadtank" class="form-label">Overhead Tank</label>
	<select id="overheadtanke" name="overheadtank">
		<option value="none">No overhead tank</option>
		<option value="shared">Shared overhead tank</option>
		<option value="perflat">Overhead tank Per Flat</option>
		</select><br>
	<label for="well" class="form-label">Well</label>
		<select id="well" name="well">
		<option value="none">No Well</option>
		<option value="withsumo">Well with Sumo</option>
		<option value="withoutsumo">Well without Sumo</option>
		</select><br>
		
	<label for="security" class="form-label">Security</label>
		<select id="security" name="security">
		<option value="nosecurity">No Security</option>
		<option value="compoundsecurity">Security for the Compound</option>
		<option value="streetsecurity">Security for the street</option>
		<option value="bothsecurity">Security for both the street and the compound</option>
		</select><br>
	
		
	
	<label for="numberoftoilets" class="form-label">Number of toilets</label>
	<input type="number" id="numberoftoilets" name="numberoftoilets"><br>
	<label for="numberofroomsaresuite" class="form-label">Number of rooms are suite</label>
	<input type="number" id="numberofroomsaresuite" name="numberofroomsaresuite"><br>
		
	




	<h4>Rent Payment</h4><br>
	
		<label for="Rentpaymentmethod" class="form-label">Rent Payment Method</label>
		<select id="rentpayment" name="Rentpaymentmethod">
		<option value="yearly">Annually</option>
		<option value="halfyear">Biannually</option>
		<option value="quarteryear">Quarterly</option>
		<option value="2years">2 Years</option>
		</select>
		<br>
	<label for="amount" class="form-label">Rent Amount</label>
	<input type="number" id="amount" name="amount" placeholder="500,000">
	<br>
	<h4>Additional Service Charges</h4>
	
	<label for="barristerfee" class="form-label">Barrister fee N</label>
	<input type="Number" class="form-control" id="barristerfee" name="barristerfee"><br>
	<label for="agentfee" class="form-label">Agent fee N</label>
	<input type="Number" class="form-control" id="agentfee" name="agentfee" readonly><br>
	<label for="cautionfee" class="form-label">Caution fee N</label>
	<input type="Number" class="form-control" id="cautionfee" name="cautionfee"><br>
	<label for="securityfee" class="form-label">Security fee N</label>
	<input type="Number" class="form-control" id="securityfee" name="securityfee"><br>
	<label for="compoundcleaninglevy" class="form-label">Compound Cleaning Levy N</label>
	<input type="Number" class="form-control"id="compoundcleaninglevy" name="compoundcleaninglevy"><br>

	</div>
	
<div class="col-md-6">

	<h4>Upload images of the apartment accordingly</h4>
		<label for="sittingroom" class="form-label">Sitting Room</label>
		<input type="file" id="sittingroom" name="sittingroom" accept="image/*" required><br>
		<p id="imagesize1"></p>
						<div class="user-image mb-3 text-center">
        
          
		<img src="..." class="figure-img img-fluid rounded" id="imgPlaceholder1" alt="">
		
        </div><br>

		<label for="bedroom" class="form-label">Master's Bed Room</label>
		<input type="file" id="bedroom1" name="bedroom1" accept="image/*"><br>
		<p id="imagesize2"></p>
						<div class="user-image mb-3 text-center">
        
          
		<img src="..." class="figure-img img-fluid rounded" id="imgPlaceholder2" alt="">
		
        </div><br>

		<label for="bedroom" class="form-label">Bed Room</label>
		<input type="file" id="bedroom2" name="bedroom5" accept="image/*"><br>
		<p id="imagesize3"></p>
						<div class="user-image mb-3 text-center">
        
          
		<img src="..." class="figure-img img-fluid rounded" id="imgPlaceholder3" alt="">
		
        </div><br>

		<label for="kitchen" class="form-label">Kitchen</label>
		<input type="file" id="kitchen" name="kitchen" accept="image/*"><br>
		<p id="imagesize4"></p>
						<div class="user-image mb-3 text-center">
        
          
		<img src="..." class="figure-img img-fluid rounded" id="imgPlaceholder4" alt="">
		
        </div><br>
		
		<label for="bedroom" class="form-label">Toilet</label>
		<input type="file" id="toilet" name="bedroom2" accept="image/*"><br>
		<p id="imagesize5"></p>
						<div class="user-image mb-3 text-center">
        
          
		<img src="..." class="figure-img img-fluid rounded" id="imgPlaceholder5" alt="">
		
        </div><br>

		<label for="bedroom" class="form-label">Rooms</label>
		<input type="file" id="bedroom" name="bedroom3" accept="image/*"><br>

		<label for="bedroom" class="form-label">Any other image</label>
		<input type="file" id="bedroom" name="bedroom4" accept="image/*"><br><br><br><br><br><br><br>

		

		

		<h4>Address</h4>
		<label for="address"  class="form-label">Address of the available</label>
		<input type="textarea" id="address" name="address" required><br>
		<label for="area" class="form-label">AREA</label>
		<input type="textarea" id="area" name="area" required><br>
		<label for="address" class="form-label">LGA</label>
		<input type="textarea" id="lga" name="lga" required><br>
		<label for="state"  class="form-label">STATE</label>
		<input type="textarea" id="state" name="state" required><br>

		

</div>
<div class="row" style="display: block">
<div class="col">
	
		<div class="col-3">
<h5>Declaration</h5>
		</div>
		<div class="form-check">
<input type="checkbox" class="form-check-input" id="declaration" name="declaration" required>
<label for="declaration" class="form-check-lable">I declare that all the information and images provided above are true representation of the said apartment. If at any point, any of the information are found to be false, I am ready to bear the punishment</label>
</div>	</div>
<br>
<div class="row">
<div class="col-2">
	<input type="submit"  name= "apartmentupload" class="btn btn-primary btn-inline-block btn-lg"></input>
</div>
<div class="col-2">
	<input type="reset" value="Reset">
</div>
<div class="col-2">
	<a href="admin/agent_schedule.php">
	<i class="fa fa-arrow-circle-left" aria-hidden="true">Back</i>
</a>	</div>
	
</div></div>
		
</div>

</form>
				</div>

				</div>
				</div>
				<?php
                include('footer.php');
                ?>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script>

$(document).ready(function() {
	$("#flats").click(function () {
$("#flattype").toggle()
});




$('#amount').change(function() { 
	
	var inputValue = $("#amount").val();
	agentFee = inputValue * 0.18;
	$('#agentfee').val(agentFee);
});


//sittingroom image
$('#sittingroom').bind('change', function() {
        var a=(this.files[0].size);
		if(a < 2000000){ $('#imagesize1').html(a);
		};
     
        if(a > 2000000) {
			$('#imagesize1').addClass('error');
			$('#imagesize1').html("Image is more tna 200mb. Please reduce the image");
           
        };
    });

	function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
          $('#imgPlaceholder1').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]); // convert to base64 string
      }
    }
    $("#sittingroom").change(function () {
      readURL(this);
    });



//bedroom 1 image
	$('#bedroom1').bind('change', function() {
        var a=(this.files[0].size);
		if(a < 2000000){ $('#imagesize2').html(a);
		};
     
        if(a > 2000000) {
			$('#imagesize2').addClass('error');
			$('#imagesize2').html("Image is more tna 200mb. Please reduce the image");
           
        };
    });

	function readURL(input) {
      if (input.files && input.files[1]) {
        var reader = new FileReader();
        reader.onload = function (e) {
          $('#imgPlaceholder2').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[1]); // convert to base64 string
      }
    }
    $("#bedroom1").change(function () {
      readURL(this);
    });


	//bedroom 2 image
	$('#bedroom2').bind('change', function() {
        var a=(this.files[0].size);
		if(a < 2000000){ $('#imagesize3').html(a);
		};
     
        if(a > 2000000) {
			$('#imagesize3').addClass('error');
			$('#imagesize3').html("Image is more tna 200mb. Please reduce the image");
           
        };
    });

	function readURL(input) {
      if (input.files && input.files[2]) {
        var reader = new FileReader();
        reader.onload = function (e) {
          $('#imgPlaceholder3').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[2]); // convert to base64 string
      }
    }
    $("#bedroom2").change(function () {
      readURL(this);
    });


	//kitchen image
	$('#kitchen').bind('change', function() {
        var a=(this.files[0].size);
		if(a < 2000000){ $('#imagesize4').html(a);
		};
     
        if(a > 2000000) {
			$('#imagesize4').addClass('error');
			$('#imagesize4').html("Image is more tna 200mb. Please reduce the image");
           
        };
    });

	function readURL(input) {
      if (input.files && input.files[3]) {
        var reader = new FileReader();
        reader.onload = function (e) {
          $('#imgPlaceholder4').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[3]); // convert to base64 string
      }
    }
    $("#kitchen").change(function () {
      readURL(this);
    });


//bedroom3 image
$('#toilet').bind('change', function() {
        var a=(this.files[0].size);
		if(a < 2000000){ $('#imagesize5').html(a);
		};
     
        if(a > 2000000) {
			$('#imagesize5').addClass('error');
			$('#imagesize5').html("Image is more tna 200mb. Please reduce the image");
           
        };
    });

	function readURL(input) {
      if (input.files && input.files[4]) {
        var reader = new FileReader();
        reader.onload = function (e) {
          $('#imgPlaceholder5').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[4]); // convert to base64 string
      }
    }
    $("#toilet").change(function () {
      readURL(this);
    });



});

</script>
</body>
</html>
