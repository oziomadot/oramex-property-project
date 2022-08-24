<?php require_once 'backend/authController.php';?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Oramex Homes</title>
		<meta charset ="UTF-8">
		<meta name="keywords" content="rent, flats, rooms,apartments,house">
		<!-- Bootstrap link -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
		<meta name="author" content="Ezeomeke Ozioma">
		<meta name="description" content="rent a home at your finger tip">
		<meta name="viewport" content="width=device-width,initial-scale=1.0">
		<link rel="icon" type="image/x-icon" href="favicon.ico">
		<link rel="stylesheet" href="style.css">
	</head>

	<body>
        <div class ="container".
        <div class="row">
            <div class="col-md-4 offset-md-4 form-div login">
                <form action="forgotpassword.php" method="post">
                    <h3 class="text-center"> Recover your password </h3>
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
                <div class="form-group">

				<p style="margin: 2em 0em"> Have your forgotten your password? <br> Don't worry, enter the email you used to signup on this website and we will help you to recover your password </p>
                <label for="email"> Email</label>
						<input type="text" id="email" class="form-control form-control.lg">
                </div>

                <div class="form-group">
                    <button type = "submit" name="forgotpassword" class="btn btn-primary btn-block btn-lg"> Recover your password</button><br>
					<div style = "font-size: 1.2em; text-align: left;">Click here to<a href="register.php"> Login</a></div>

                </div>
                </form>
            </div>
        </div>