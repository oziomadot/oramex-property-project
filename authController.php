<?php
require_once "pdo.php";
require_once "emailController.php";

// include('class/Appointment.php');
// $object = new Appointment;

session_start();
$_SESSION['verified'] = false;



//Signup for agents



if (isset($_POST['signup-btn'])) {
	
	if (strlen($_POST['surname']) < 1) {
		$_SESSION['error'] = "Please, add surname";
		header("Location:register.php");
		return;
	}

	if (strlen($_POST['firstname']) < 1) {
		$_SESSION['error'] = "Please, add your first name";
		header("Location:register.php");
		return;
	}

	if (strlen ($_POST['email']) < 1) {
			$_SESSION['error'] = "Please, add an email";
			header("Location:register.php");
			return;
	}

	if (!empty($_POST['email']) && !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
			$_SESSION['error'] = "Please, invalid email";
			header("Location:register.php");
			return;
	} else {
		$emailQuery = "SELECT * FROM agent WHERE email = :email LIMIT 1";
		$stmt = $pdo->prepare($emailQuery);
		$stmt->execute(array (
		':email' => $_POST['email'],
		));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		if ($row > 0) {
		$_SESSION['error'] = "Email already esists";
		header("Location:register.php");
		return;
		} 
	} 


	if (strlen ($_POST['password']) < 1) {
			$_SESSION['error'] = "Please, choose a password";
			header("Location:register.php");
			return;
	} 

	if (strlen($_POST['password']) < 8 || strlen($_POST['password']) > 16) {
			$_SESSION['error'] = "Password should be min 8 characters and max 16 characters";
			header("Location:register.php");
			return;
		}
		if (!preg_match("/\d/", $_POST['password'])) {
			$_SESSION['error']  = "Password should contain at least one digit";
			header("Location:register.php");
			return;
		}
		if (!preg_match("/[A-Z]/", $_POST['password'])) {
			$_SESSION['error']  = "Password should contain at least one Capital Letter";
			header("Location:register.php");
			return;
		}
		if (!preg_match("/[a-z]/", $_POST['password'])) {
			$_SESSION['error']  = "Password should contain at least one small Letter";
			header("Location:register.php");
			return;
		}
		
		if (preg_match("/\s/", $_POST['password'])) {
			$_SESSION['error']  = "Password should not contain any white space";
			header("Location:register.php");
			return;
		}
	

	if (isset($_POST['password']) && isset($_POST['passwordConf']) && $_POST['password'] !== $_POST['passwordConf']) {
			$_SESSION['error'] = "Password and password confirmation are not same";
			header("Location:register.php");
			return;
	}

	

	if (strlen ($_POST['phonenumber']) < 11) {
			$_SESSION['error'] = "Please, add a complete phone number";
			header("Location:register.php");
			return;
	}

	 if(!isset($_SESSION['error']) ) {

		if(strlen($_POST['refeeralid'] >1)){
	$refeelid = $_POST['refeeralid'] ;
	//|| 'S1O0NWE';
		}elseif (strlen($_POST['refeeralid'] <1)){
			$refeelid = '3TQHOM3' ;
		}
		    
		    
		
			$refeeralidQuery = "SELECT * FROM agent WHERE agent_id = :agentid LIMIT 1";
			$stmt = $pdo->prepare($refeeralidQuery);
			$stmt->execute(array(
				':agentid' => $refeelid));
			

		// } else if (strlen($_POST['refeeralid']) < 1) {
		    
			
		// 	//$refeelid= '3TQHOM3';
	   
		//    $refeeralidQuery = "SELECT * FROM agent WHERE agent_id = :agentid LIMIT 1";
		//    $stmt = $pdo->prepare($refeeralidQuery);
		//    $stmt->execute(array(
		// 	   ':agentid' => $_POST['refeeralid']));
		   $row = $stmt->fetch(PDO::FETCH_ASSOC);
		   $ref =$row; 


		   if ($ref > 0) {
				// $result = $stmt->fetch(PDO::FETCH_ASSOC);
				// $user = $result;
	
	   function getRandomString($n) 
	   {
			   $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
			   $randomString = ''; 
	 
				   for ($i = 0; $i < $n; $i++) {
				   $index = rand(0, strlen($characters) - 1);
				   $randomString .= $characters[$index];
				   } 
				   return $randomString; 
		   } 
		   
			   $n = 7;
			   $agentid = getRandomString($n);
			   global $agentid;

//return $agentid;

 
			

		
				
		
	
		//$_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
		$token = bin2hex(random_bytes(50));
		//$agentid =  $agentid;
		$sql = "INSERT INTO agent (agent_id, Surname, First_name, Other_names, Email, Password, Phone_number, Refeeral_id, verified, token)
		VALUES (:agentid, :surname, :firstname, :othernames, :email, :password, :phonenumber, :refeeralid, :verified, :token)";
		$stmt = $pdo->prepare($sql);
		$stmt->execute(array(
		':agentid' =>  $agentid,
		':surname' => $_POST['surname'],
		':firstname' => $_POST['firstname'],
		':othernames' => $_POST['othername'],
		':email' => $_POST['email'],
		':password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
		':phonenumber' => $_POST['phonenumber'],
		':refeeralid' => $refeelid, 
		
		':verified' => $_SESSION['verified'],
		':token' => $token)); 


		
		$to      = $_POST['email'];
		$subject = 'Verify email';
		$message = 'Thank you for registering with Oramex property. Please, 
		click on the link below to verify your email 
		<a href="http://www.oramexpropt.com/backend/email_verify.php?token='.$token.'">link</a>
		Verify your email address
		<br>
		
		<p><strong>
		Disclaimer: 
			Oramex Property agency and management will never ask for sensitive informations from our customers or works for any reason.
			Oramex Property agency and management will always communicate to your through our offical email admin@oramexpropt.com, official phone number
			and whatsapp number if need be 09157387503
			
			signed:
			Ugbede Micheal,
		 Admin, Oramex Property agency and management
		 1 University Market road, Nsukka, Enugu State.
		 </strong>
		 </p>';
		$headers = 'From: admin@oramexpropt.com' . "\r\n" .
			'Reply-To: oramexproperty@gmail.com, admin@oramexpropt.com' . "\r\n" .
			'X-Mailer: PHP/' . phpversion();
		
		mail($to, $subject, $message, $headers);
		
		//sendVerificationEmail($_POST['email'], $token);
		
		$_SESSION['success'] = 'Thank you for registering with Oramex Property. To continue, please sign in to your email account and click on 
						the verification link we just emailed you at <strong>'.$_SESSION['email'].'</strong>';
			header('Location: index.php');

		
			return;

		  }	
		
		}
		//unset();
		$_SESSION['error'] = "Please, check the details you entered and try again. Your registration is unsuccessful";
		header('Location: register.php');
		return;
		
	} 


//agent login
// awa malvin login code
// if agent click on login button
if (isset($_POST ['agentlogin-btn'])) {

	$username= $_POST['username'];
	$password = $_POST['password'];
	
	function Is_email($user)
	{
	//If the username input string is an e-mail, return true
	if(filter_var($user, FILTER_VALIDATE_EMAIL)) {
	return true;
	} else {
	return false;
	}
	}
	
	//validation
	if (strlen($_POST['username']) < 1) {
		 
		$_SESSION['error'] = 'email or phone number required';
		header("Location:register.php");
				return;
	}
	
	if (strlen($_POST['password']) < 1) {
		$_SESSION['error'] = 'password required';
		header("Location:register.php");
		return;
		
	}

	if(!isset($_SESSION['error'])) {

		$check_email = Is_email($username);
		if($check_email){ 
			$sql = "SELECT * FROM agent WHERE Email = :email  AND verified = 1 LIMIT 1";
			$stmt = $pdo->prepare($sql);
			$stmt->execute(array( 
			':email' => $_POST['username'], 
			//':password' => $_POST['password']
			 )); 
			// $result = $stmt->fetch(PDO::FETCH_ASSOC);
			//$user = $result;
			} else {
			$sql = "SELECT * FROM agent WHERE Phone_number= :phonenumber 	AND verified = 1	LIMIT 1";
			$stmt = $pdo->prepare($sql);
			
			$stmt->execute(array( 
				':phonenumber' => $_POST['username'],
				//':password' => $_POST['password']
			 ));
		//$result = $stmt->fetch(PDO::FETCH_ASSOC);
		//$user = $result;
		 }

		//if (isset($user)) {
		
			if ($stmt->execute()) {
				$result = $stmt->fetch(PDO::FETCH_ASSOC);
				$user = $result;
	 

// checking if agent is disabled
				$sql = "SELECT * FROM agent WHERE Phone_number= :phonenumber 		LIMIT 1";
			$stmt = $pdo->prepare($sql);
			
			$stmt->execute(array( 
				':phonenumber' => $user['Phone_number'],
			
			 ));
			 $result = $stmt->fetch(PDO::FETCH_ASSOC);
			$userd = $result;


			if($userd['Disabled'] == 1) {
					$_SESSION['error'] = "This account has been disabled, please contact Oramex Property staff";
					header('Location: register.php');
					return;
				}else{
	

				

			if (password_verify($password, $user['Password'])) {
			//login sucess
			//$stmt->close();
			


				$_SESSION['id'] = $user['User_id'];
				$_SESSION['agentid'] = $user['agent_id'];
				$_SESSION['firstname'] = $user['First_name'];
				$_SESSION['Surname'] = $user['Surname'];
				$_SESSION['phonenumber'] = $user['Phone_number'];
				$_SESSION['email'] = $user['Email'];
				$_SESSION['verified'] = $user['verified'];
				$_SESSION['type'] = 'Agent';

				
			// set flash message
				$_SESSION['success'] = "You are now logged in! Continue with your upload";
				
					
						header('location: admin/agent_schedule.php');
				
				return;
			}
				else {
				$_SESSION['errors']= "Wrong username/password";
				header('Location: register.php');
				return;
				}
			}
		} else {
			$_SESSION['errors']= "Your account has not been verified. Please click on the verification link sent to you in your email.";
			header('Location: register.php');
			return;
		}
	}
}	
	





	//for staff sign up

	


	if (isset($_POST['staffsignup-btn'])) {
		if (strlen($_POST['surname']) < 1) {
			$_SESSION['error'] = "Please, add surname";
			header("Location: about.php");
			return;
		}
	
		if (strlen($_POST['firstname']) < 1) {
			$_SESSION['error'] = "Please, add your first name";
			header("Location: about.php");
			return;
		}
	
		if (strlen ($_POST['email']) < 1) {
				$_SESSION['error'] = "Please, add an email";
				header("Location: about.php");
				return;
		}
	
		if (!empty($_POST['email']) && !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
				$_SESSION['error'] = "Please, invalid email";
				header("Location: about.php");
				return;
		} else {
			$emailQuery = "SELECT * FROM staff WHERE email = :email LIMIT 1";
			$stmt = $pdo->prepare($emailQuery);
			$stmt->execute(array (
			':email' => $_POST['email'],
			));
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
	
			if ($row > 0) {
			$_SESSION['error'] = "Email already esists";
			header("Location: about.php");
			return;
			} 
		} 
		
	
		if (strlen ($_POST['phonenumber']) < 11) {
				$_SESSION['error'] = "Please, add a complete phone number";
				header("Location:about.php");
				return;
		}
	
		if (strlen ($_POST['password']) < 1) {
			$_SESSION['error'] = "Please, choose a password";
			header("Location:about.php");
			return;
	} 

	if (strlen($_POST['password']) < 8 || strlen($_POST['password']) > 16) {
			$_SESSION['error'] = "Password should be min 8 characters and max 16 characters";
			header("Location:about.php");
			return;
		}
		if (!preg_match("/\d/", $_POST['password'])) {
			$_SESSION['error']  = "Password should contain at least one digit";
			header("Location:about.php");
			return;
		}
		if (!preg_match("/[A-Z]/", $_POST['password'])) {
			$_SESSION['error']  = "Password should contain at least one Capital Letter";
			header("Location:about.php");
			return;
		}
		if (!preg_match("/[a-z]/", $_POST['password'])) {
			$_SESSION['error']  = "Password should contain at least one small Letter";
			header("Location:about.php");
			return;
		}
		
		if (preg_match("/\s/", $_POST['password'])) {
			$_SESSION['error']  = "Password should not contain any white space";
			header("Location:about.php");
			return;
		}
	

	if (isset($_POST['password']) && isset($_POST['passwordConf']) && $_POST['password'] !== $_POST['passwordConf']) {
			$_SESSION['error'] = "Password and password confirmation are not same";
			header("Location:about.php");
			return;
	}

	
		

		
			

			
		
	
						
			
		
	if(!isset($_SESSION['error']) ) {

		function getRandomString($n) 
	{
		$characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$randomString = ''; 

			for ($i = 0; $i < $n; $i++) {
			$index = rand(0, strlen($characters) - 1);
			$randomString .= $characters[$index];
			} 
		  return $randomString;
	} 

		$n = 5;
		//$agentid = 
		global $staffid;



		$staffid = 'OrP' .getRandomString($n);


		$target_dir = "profilepic/";
		$target_file = $target_dir .$staffid . basename($_FILES["profile_pic"]["name"]);
		
		$imageExt = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
		$allowd_file_ext = array ("jpg", "jpeg", "png");

	if(!file_exists($_FILES["profile_pic"]["tmp_name"])) {
			
		$_SESSION['error'] = "Select image to upload";

	} else if (!in_array($imageExt, $allowd_file_ext)) {
		
		$_SESSION['error'] = "Allowed file formats .jpg, .jpeg and .png";

	} else if ($_FILES["profile_pic"]["size"] > 2097152) {
		
		$_SESSION['error'] = "File is too large. File size should be less than 2megabytes.";

	} else if(file_exists($target_file)){
		
		$_SESSION['error'] = "File already exists. If you think this is wrong, contact oramex regional coordinator of your state.";

	}

		
		if(!isset($_SESSION['error'])){
	
		move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $target_file);

	
	$sql = "INSERT INTO staff (Staff_id, Surname, First_name, Other_names, email, Phone_number, Work_Phonenumber, designation, profile_pic, password, Approved, tweeter, instagram, philosophy  )
	VALUES (:Staff_id, :Surname, :First_name, :Other_names, :email, :Phone_number, :work_phonenumber, :designation, :profilepix, :password, :approved, :tweeter, :instagram, :philosophy )";
	$stmt = $pdo->prepare($sql);
	$stmt->execute(array(
	':Staff_id' => $staffid, 
	':Surname' => $_POST['surname'],
	':First_name' => $_POST['firstname'],
	':Other_names' => $_POST['othername'],
	':email' => $_POST['email'],
	':Phone_number' => $_POST['phonenumber'],
	':work_phonenumber' => $_POST['workphonenumber'],
	':designation' => $_POST['designation'],
	':profilepix' => $_FILES["profile_pic"],
	':password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
	':approved' => 'No',
	':tweeter' => $_POST['tweeter'],
	':instagram' => $_POST['instagram'] ,
	':philosophy' => $_POST['philosophy'],
	
	)); 

	
			

			$_SESSION['success'] = 'Thank you for having interest to work with us at Oramex Property. In a few seconds, you will recieve and email from the Admin.
			This email contains you staff Id. This is the ID that you will use for login and identification. Please, keep an eye on your email.' ;
				header('Location: about.php');
	
			
				return;
	
				
			
			//}
		}
	}
		
			//unset();
			header('Location: about.php');
			return;
			
		
} 




		//staff login

if (isset($_POST['stafflogin-btn'])) {


	$password = $_POST['password'];
	//$staff_id = $_POST['staff_id'];
	
	//unset($_SESSION[""]);	
	
	$logintype = $_POST["logintype"];
	//validation
	if (strlen($_POST['staff_id']) < 1) {
		$_SESSION['error'] = 'staff id required';
		header("Location:about.php");
			return;
	}

		
	if (strlen($_POST['password']) < 1) {
		$_SESSION['error'] = 'Password required';
		header("Location:about.php");
			return;
	}

	
	if(!isset($_SESSION['error'])) {


		$logintype = $_POST["logintype"];


	if($logintype == 'admin'){

		$sql = "SELECT * FROM admin WHERE staff_id = :staffid  LIMIT 1";
		$stmt = $pdo->prepare($sql);
		$stmt->execute(array( 
		':staffid' => $_POST['staff_id'],

		 )); 

		 
		
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		$adminlog = $result;
	
		if($adminlog['staff_id'] > 0){		
	
			$sql = "SELECT * FROM staff WHERE Staff_id = :staffid  LIMIT 1";
			$stmt = $pdo->prepare($sql);
			$stmt->execute(array( 
			':staffid' => $adminlog['staff_id']
	
			 )); 
			
			
			//if (isset($user)) {
			
				if ($stmt->execute()) {
					$result = $stmt->fetch(PDO::FETCH_ASSOC);
					$user = $result;
		
					
		if (password_verify($password, $user['password'])) {
			
			
			
				$_SESSION['id'] = $user['user_id'];
				$_SESSION['Staff_id'] = $user['Staff_id'];
				$_SESSION['firstname'] = $user['First_name'];
				$_SESSION['Surname'] = $user['Surname'];
				$_SESSION['type'] = 'Admin';
				$_SESSION['group'] = 'Staff';

				
			// set flash message
				$_SESSION['success'] = "You are now logged in!";
				
				
				 header('location: admin/dashboard.php');
				return;
			}
		}
	} else {
		$_SESSION['error'] = 'you are not an admin, please login as a staff';
		header('location: about.php');
		return;
	}

}else {


			$sql = "SELECT * FROM staff WHERE Staff_id = :staffid  AND Approved = 'Yes' LIMIT 1";
			$stmt = $pdo->prepare($sql);
			$stmt->execute(array( 
			':staffid' => $_POST['staff_id']
	
			 )); 
			
			
			//if (isset($user)) {
			
				if ($stmt->execute()) {
					$result = $stmt->fetch(PDO::FETCH_ASSOC);
					$user = $result;
		
					
		
				if (password_verify($password, $user['password'])) {
				//login sucess
				//$stmt->close();*/
				
				
					$_SESSION['id'] = $user['user_id'];
					$_SESSION['Staff_id'] = $user['Staff_id'];
					$_SESSION['firstname'] = $user['First_name'];
					$_SESSION['Surname'] = $user['Surname'];
					$_SESSION['profile_pic'] = $user['profile_pic'];
					$_SESSION['type'] = 'Staff';
					$_SESSION['group'] = 'Staff';

				// set flash message
					$_SESSION['success'] = "You are now logged in! Continue with your upload";
					//$_SESSION['alert-class'] = "alert-success";
					header('location: admin/dashboard.php');
					return;
				}
				else {
				$_SESSION['errors']= "Wrong Staff ID/password";
				header('Location: about.php');
				return;
				}
				
			} else {
				$_SESSION['errors']= "statement is wrong";
				header('Location: about.php');
				return;
			}
			}
}	

}


  



// if agent click on login button
/*if (isset($_POST ['agentlogin-btn'])) {

 $_POST['phonenumber'] || $_POST['email'] = ':username';
 $_POST['password'] = ':password';



	//validation
	if (strlen($_POST['username']) < 1) {
		$_SESSION['error'] = 'email address or phone number required';
		header("Location:register.php");
			return;
	
	}

	if (strlen($password) < 1) {
		$_SESSION['error'] = 'password  required';
		header("Location:register.php");
			return;
	
	
	}

	if (!empty($_POST['email']) && !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
		$_SESSION['error'] = 'Email address is invalid';
		header("Location:register.php");
			return;
	
	}


	if(count($_SESSION) === 0){
		$check = hash('md5', $salt.$_POST['password']);
		$stmt = $pdo->prepare('SELECT user_id, firstname, surname FROM agent
   	 WHERE email = :em AND password = :pw');
		$stmt->execute(array( ':em' => $_POST['email'], ':pw' => $check));
		$row = $stmt->fetch(PDO::FETCH_ASSOC); 
 
	}

}*/

	

// logout user
if (isset($_GET['logout'])){
	session_destroy();
	unset($_SESSION['id']);
	unset($_SESSION['firstname']);
	unset($_SESSION['email']);
	unset($_SESSION['verified']);
	header('location: index.php');
	exit();
}



//verify user by token
function verifyUser($token) {
	global $pdo;
	$sql = "SELECT * FROM agent WHERE token = :token LIMIT 1";
	$stmt = $pdo->prepare($sql);
	$stmt->execute(array( 
		':token' => $token

	 )); 
	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	$user = $result;

	if ($user > 0) {
	
		$sql = "UPDATE agent SET verified=1 WHERE token='$token'";
		$stmt = $pdo ->prepare($sql);
		
		if($stmt->execute){
		
			//log user in

			$_SESSION['id'] = $user['id'];
			$_SESSION['firstname'] = $user['firstname'];
			$_SESSION['email'] = $user['email'];
			$_SESSION['verified'] = 1;
			$_SESSION['agentid']= $user['agent_id'];
			$_SESSION['type'] = 'Agent';
		// set flash message
			$_SESSION['success'] = "You email address has been successfully verified";
			$_SESSION['alert-class'] = "alert-success";
			header('location: admin/agent_schedule.php');
			return;
			
		}
	} else {
		echo 'User not found';
		return;
	}
}



//to upload apartment information apartmentupload

if (isset($_POST["apartmentupload"])){

	$Property_number = uniqid();
	$buildingtype = $_POST["buildingtype"];
	$flattype= $_POST["flatbuildingtype"];
	

	if($buildingtype == 'singlerooms'){

		$target_dir = "singlerooms/";
		$target_file = $target_dir .$Property_number .'sittingroom' . basename($_FILES["sittingroom"]["name"]); 
		$target_file1 = $target_dir .$Property_number . basename($_FILES["bedroom1"]["name"]);
		$target_file2 = $target_dir .$Property_number . basename($_FILES["bedroom2"]["name"]);
		$target_file3 = $target_dir .$Property_number . basename($_FILES["bedroom3"]["name"]);
		$target_file4 = $target_dir .$Property_number . basename($_FILES["bedroom4"]["name"]);
		$target_file5 = $target_dir .$Property_number . basename($_FILES["bedroom5"]["name"]);
		$target_file6 = $target_dir .$Property_number . basename($_FILES["kitchen"]["name"]);
		
		$imageExt = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
		$allowd_file_ext = array ("jpg", "jpeg", "png");

		if(!file_exists($_FILES["sittingroom"]["tmp_name"]) && ($_FILES["bedroom1"]["tmp_name"])) {
			
			$_SESSION['error'] = "Select image to upload";

		} //else 
		if (!in_array($imageExt, $allowd_file_ext)) {
			
			$_SESSION['error'] = "Allowed file formats .jpg, .jpeg and .png";

		} //else 
		if (($_FILES["sittingroom"]["size"]) > 2097152 ) {//|| ($_FILES["bederoom1"]["size"])  
			
			$_SESSION['error'] = "File is too large. File size should be less than 2megabytes.";

		} //else  
		if(file_exists($target_file)){
			
			$_SESSION['error'] = "File already exists. If you think this is wrong, contact oramex regional coordinator of your state.";

		}
		if(!isset($_SESSION['error'])){
			move_uploaded_file($_FILES["sittingroom"]["tmp_name"], $target_file);
			move_uploaded_file($_FILES["bedroom1"]["tmp_name"], $target_file1);
			move_uploaded_file($_FILES["bedroom2"]["tmp_name"], $target_file2);
			move_uploaded_file($_FILES["bedroom3"]["tmp_name"], $target_file3);
			move_uploaded_file($_FILES["bedroom4"]["tmp_name"], $target_file4);
			move_uploaded_file($_FILES["bedroom5"]["tmp_name"], $target_file5);
			move_uploaded_file($_FILES["kitchen"]["tmp_name"], $target_file6);


		$sql = "INSERT INTO property (Property_number, agent_id, building, floor, buildingtype, flat_type, Address, Rent, Agent_fee, Barr, Caution_fee, Security_fee, Compound_cleaning, Sitting_room, room1, Dinning, electricity, Meter, overheadtank, well, fenced, car_parkingspace, security, Compound_cleaner, toilet, suite, kitchen, kitchen_cabinet, woodrope, woodrope_cabinet)
		VALUES (:Property_number,  :agent_id, :building, :floor, :buildingtype, :flattype, :Address, :Rent, :Agent_fee, :Barr, :Caution_fee, :Security_fee, :Compound_cleaning, :Sitting_room, :room1, :Dinning, :electricity, :Meter,	:overheadtank, :well, :fenced, :car_parkingspace, :security, :Compound_cleaner, :toilet, :suite, :kitchen, :kitchen_cabinet, :woodrope, :woodrope_cabinet)";
		$stmt = $pdo->prepare($sql);
		$stmt->execute(array(
		':Property_number' => $Property_number,
		':agent_id' => $_SESSION['agentid'],
		':building' => $_POST['building'],
		':floor' => $_POST['floor'],
		':buildingtype' => $_POST['buildingtype'],
		':flattype' => $_POST['flatbuildingtype'],
		':Address' => $_POST['address'],
		':Rent' => $_POST['Rentpaymentmethod'] .$_POST['amount'], 
		':Agent_fee' => $_POST['agentfee'],
		':Barr' => $_POST['barristerfee'],
		':Caution_fee' => $_POST['cautionfee'],
		':Security_fee' => $_POST['securityfee'],
		':Compound_cleaning' => $_POST['compoundcleaninglevy'],
		':Sitting_room' => $_FILES['sittingroom'],
		':room1' => $_FILES['bedroom1'],
		':Dinning' => $_POST['dinning'],
		':electricity' => $_POST['electricity'],
		':Meter' => $_POST['meter'],
		':overheadtank' => $_POST['overheadtank'],
		':well' => $_POST['well'],
		':fenced' => $_POST['fenced'],
		':car_parkingspace' => $_POST['parkingspace'],
		':security' => $_POST['security'],
		':Compound_cleaner' => $_POST['compoundcleaner'],
		':toilet' => $_POST['numberoftoilets'],
		':suite' => $_POST['numberofroomsaresuite'],
		':kitchen' => $_POST['kitchen'],
		':kitchen_cabinet' => $_POST['kitchencabinet'],
		':woodrope' => $_POST['woodrope'],
		':woodrope_cabinet' => $_POST['woodropecabinet']));

	


	$_SESSION['success'] = 'Apartment uploaded.';
	header('location: admin/agent_schedule.php');
		
			return;} else{
				$_SESSION['error'] = "Your upload was not successful, Please check if you images are correctly uploaded";
				header('Location: apartment-information.php');
		
			}
	
		}//else
		
	

//selfcon

	if($buildingtype == 'selfcon'){

			$target_dir = "selfcon/";
			$target_file = $target_dir .$Property_number .'sittingroom' .basename($_FILES["sittingroom"]["name"]); 
			$target_file1 = $target_dir .$Property_number . basename($_FILES["bedroom1"]["name"]);
			$target_file2 = $target_dir .$Property_number . basename($_FILES["bedroom2"]["name"]);
			$target_file3 = $target_dir .$Property_number . basename($_FILES["bedroom3"]["name"]);
			$target_file4 = $target_dir .$Property_number . basename($_FILES["bedroom4"]["name"]);
			$target_file5 = $target_dir .$Property_number . basename($_FILES["bedroom5"]["name"]);
			$target_file6 = $target_dir .$Property_number . basename($_FILES["kitchen"]["name"]);
				
			$imageExt = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
			$allowd_file_ext = array ("jpg", "jpeg", "png");
		
			if(!file_exists($_FILES["sittingroom"]["tmp_name"]) ) {
					
			$_SESSION['error'] = "Select image to upload";
		
			} //else 
			if (!in_array($imageExt, $allowd_file_ext)) {
					
			$_SESSION['error'] = "Allowed file formats .jpg, .jpeg and .png";
		
			} //else 
			if (($_FILES["sittingroom"]["size"]) > 2097152 ) {//|| ($_FILES["bederoom1"]["size"])  
					
			$_SESSION['error'] = "File is too large. File size should be less than 2megabytes.";
		
			} //else  
			if(file_exists($target_file)){
					
			$_SESSION['error'] = "File already exists. If you think this is wrong, contact oramex regional coordinator of your state.";
		
			}
			if(!isset($_SESSION['error'])){
			move_uploaded_file($_FILES["sittingroom"]["tmp_name"], $target_file);
			move_uploaded_file($_FILES["bedroom1"]["tmp_name"], $target_file1);
			move_uploaded_file($_FILES["bedroom2"]["tmp_name"], $target_file2);
			move_uploaded_file($_FILES["bedroom3"]["tmp_name"], $target_file3);
			move_uploaded_file($_FILES["bedroom4"]["tmp_name"], $target_file4);
			move_uploaded_file($_FILES["bedroom5"]["tmp_name"], $target_file5);
			move_uploaded_file($_FILES["kitchen"]["tmp_name"], $target_file6);
		
					
					
			$sql = "INSERT INTO property (Property_number, agent_id, building, floor, buildingtype, flat_type, Address, Rent, Agent_fee, Barr, Caution_fee, Security_fee, Compound_cleaning, Sitting_room, room1, Dinning, electricity, Meter, overheadtank, well, fenced, car_parkingspace, security, Compound_cleaner, toilet, suite, kitchen, kitchen_cabinet, woodrope, woodrope_cabinet)
			VALUES (:Property_number,  :agent_id, :building, :floor, :buildingtype, :flattype, :Address, :Rent, :Agent_fee, :Barr, :Caution_fee, :Security_fee, :Compound_cleaning, :Sitting_room, :room1, :Dinning, :electricity, :Meter,	:overheadtank, :well, :fenced, :car_parkingspace, :security, :Compound_cleaner, :toilet, :suite, :kitchen, :kitchen_cabinet, :woodrope, :woodrope_cabinet)";
			$stmt = $pdo->prepare($sql);
			$stmt->execute(array(
			':Property_number' => $Property_number,
			':agent_id' => $_SESSION['agentid'],
			':building' => $_POST['building'],
			':floor' => $_POST['floor'],
			':buildingtype' => $_POST['buildingtype'],
			':flattype' => $_POST['flatbuildingtype'],
			':Address' => $_POST['address'],
			':Rent' => $_POST['Rentpaymentmethod'] .$_POST['amount'], 
			':Agent_fee' => $_POST['agentfee'],
			':Barr' => $_POST['barristerfee'],
			':Caution_fee' => $_POST['cautionfee'],
			':Security_fee' => $_POST['securityfee'],
			':Compound_cleaning' => $_POST['compoundcleaninglevy'],
			':Sitting_room' => $_FILES['sittingroom'],
			':room1' => $_FILES['bedroom1'],
			':Dinning' => $_POST['dinning'],
			':electricity' => $_POST['electricity'],
			':Meter' => $_POST['meter'],
			':overheadtank' => $_POST['overheadtank'],
			':well' => $_POST['well'],
			':fenced' => $_POST['fenced'],
			':car_parkingspace' => $_POST['parkingspace'],
			':security' => $_POST['security'],
			':Compound_cleaner' => $_POST['compoundcleaner'],
			':toilet' => $_POST['numberoftoilets'],
			':suite' => $_POST['numberofroomsaresuite'],
			':kitchen' => $_POST['kitchen'],
			':kitchen_cabinet' => $_POST['kitchencabinet'],
			':woodrope' => $_POST['woodrope'],
			':woodrope_cabinet' => $_POST['woodropecabinet']));
	
		
	
	
		$_SESSION['success'] = 'Apartment uploaded.';
		header('location: admin/agent_schedule.php');
			
			return;} else{
			$_SESSION['error'] = "Your upload was not successful, Please check if you images are correctly uploaded";
			header('Location: apartment-information.php');
			
				}
		
	}//else
			
				
				
	


	//duplex
	if($buildingtype == 'duplex'){

			$target_dir = "duplex/";
			$target_file = $target_dir .$Property_number .'sittingroom' .basename($_FILES["sittingroom"]["name"]); 
			$target_file1 = $target_dir .$Property_number . basename($_FILES["bedroom1"]["name"]);
			$target_file2 = $target_dir .$Property_number . basename($_FILES["bedroom2"]["name"]);
			$target_file3 = $target_dir .$Property_number . basename($_FILES["bedroom3"]["name"]);
			$target_file4 = $target_dir .$Property_number . basename($_FILES["bedroom4"]["name"]);
			$target_file5 = $target_dir .$Property_number . basename($_FILES["bedroom5"]["name"]);
			$target_file6 = $target_dir .$Property_number . basename($_FILES["kitchen"]["name"]);
				
			$imageExt = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
			$allowd_file_ext = array ("jpg", "jpeg", "png");
				
			if(!file_exists($_FILES["sittingroom"]["tmp_name"]) ) {
							
			$_SESSION['error'] = "Select image to upload";
				
			} //else 
			if (!in_array($imageExt, $allowd_file_ext)) {
							
			$_SESSION['error'] = "Allowed file formats .jpg, .jpeg and .png";
			
			} //else 
			if (($_FILES["sittingroom"]["size"]) > 2097152 ) {//|| ($_FILES["bederoom1"]["size"])  
							
			$_SESSION['error'] = "File is too large. File size should be less than 2megabytes.";
				
			} //else  
			if(file_exists($target_file)){
							
			$_SESSION['error'] = "File already exists. If you think this is wrong, contact oramex regional coordinator of your state.";
				
			}
			if(!isset($_SESSION['error'])){
			move_uploaded_file($_FILES["sittingroom"]["tmp_name"], $target_file);
			move_uploaded_file($_FILES["bedroom1"]["tmp_name"], $target_file1);
			move_uploaded_file($_FILES["bedroom2"]["tmp_name"], $target_file2);
			move_uploaded_file($_FILES["bedroom3"]["tmp_name"], $target_file3);
			move_uploaded_file($_FILES["bedroom4"]["tmp_name"], $target_file4);
			move_uploaded_file($_FILES["bedroom5"]["tmp_name"], $target_file5);
			move_uploaded_file($_FILES["kitchen"]["tmp_name"], $target_file6);
				
							
			$sql = "INSERT INTO property (Property_number, agent_id, building, floor, buildingtype, flat_type, Address, Rent, Agent_fee, Barr, Caution_fee, Security_fee, Compound_cleaning, Sitting_room, room1, Dinning, electricity, Meter, overheadtank, well, fenced, car_parkingspace, security, Compound_cleaner, toilet, suite, kitchen, kitchen_cabinet, woodrope, woodrope_cabinet)
			VALUES (:Property_number,  :agent_id, :building, :floor, :buildingtype, :flattype, :Address, :Rent, :Agent_fee, :Barr, :Caution_fee, :Security_fee, :Compound_cleaning, :Sitting_room, :room1, :Dinning, :electricity, :Meter,	:overheadtank, :well, :fenced, :car_parkingspace, :security, :Compound_cleaner, :toilet, :suite, :kitchen, :kitchen_cabinet, :woodrope, :woodrope_cabinet)";
			$stmt = $pdo->prepare($sql);
			$stmt->execute(array(
			':Property_number' => $Property_number,
			':agent_id' => $_SESSION['agentid'],
			':building' => $_POST['building'],
			':floor' => $_POST['floor'],
			':buildingtype' => $_POST['buildingtype'],
			':flattype' => $_POST['flatbuildingtype'],
			':Address' => $_POST['address'],
			':Rent' => $_POST['Rentpaymentmethod'] .$_POST['amount'], 
			':Agent_fee' => $_POST['agentfee'],
			':Barr' => $_POST['barristerfee'],
			':Caution_fee' => $_POST['cautionfee'],
			':Security_fee' => $_POST['securityfee'],
			':Compound_cleaning' => $_POST['compoundcleaninglevy'],
			':Sitting_room' => $_FILES['sittingroom'],
			':room1' => $_FILES['bedroom1'],
			':Dinning' => $_POST['dinning'],
			':electricity' => $_POST['electricity'],
			':Meter' => $_POST['meter'],
			':overheadtank' => $_POST['overheadtank'],
			':well' => $_POST['well'],
			':fenced' => $_POST['fenced'],
			':car_parkingspace' => $_POST['parkingspace'],
			':security' => $_POST['security'],
			':Compound_cleaner' => $_POST['compoundcleaner'],
			':toilet' => $_POST['numberoftoilets'],
			':suite' => $_POST['numberofroomsaresuite'],
			':kitchen' => $_POST['kitchen'],
			':kitchen_cabinet' => $_POST['kitchencabinet'],
			':woodrope' => $_POST['woodrope'],
			':woodrope_cabinet' => $_POST['woodropecabinet']));
	
		
	
	
		$_SESSION['success'] = 'Apartment uploaded.';
		header('location: admin/agent_schedule.php');
	
		return;} else{
			$_SESSION['error'] = "Your upload was not successful, Please check if you images are correctly uploaded";
			header('Location: apartment-information.php');
	
		}

	}//else
							
						
if($buildingtype == 'flats')	{					

	if(!$flattype){
		$_SESSION['error'] = "Please, Select the type of flat";
			header('Location: apartment-information.php');}

	//one bedroom flat

	if($flattype == 'onebedroom'){

		$target_dir = "1bedrooflat/";
			$target_file = $target_dir .$Property_number .'sittingroom' . basename($_FILES["sittingroom"]["name"]); 
			$target_file1 = $target_dir .$Property_number . basename($_FILES["bedroom1"]["name"]);
			$target_file2 = $target_dir .$Property_number . basename($_FILES["bedroom2"]["name"]);
			$target_file3 = $target_dir .$Property_number . basename($_FILES["bedroom3"]["name"]);
			$target_file4 = $target_dir .$Property_number . basename($_FILES["bedroom4"]["name"]);
			$target_file5 = $target_dir .$Property_number . basename($_FILES["bedroom5"]["name"]);
			$target_file6 = $target_dir .$Property_number . basename($_FILES["kitchen"]["name"]);
								
			$imageExt = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
			$allowd_file_ext = array ("jpg", "jpeg", "png");
						
			if(!file_exists($_FILES["sittingroom"]["tmp_name"]) ) {
									
			$_SESSION['error'] = "Select image to upload";
						
			} //else 
			if (!in_array($imageExt, $allowd_file_ext)) {
									
			$_SESSION['error'] = "Allowed file formats .jpg, .jpeg and .png";
						
			} //else 
			if (($_FILES["sittingroom"]["size"]) > 2097152 ) {//|| ($_FILES["bederoom1"]["size"])  
									
			$_SESSION['error'] = "File is too large. File size should be less than 2megabytes.";
						
			} //else  
			if(file_exists($target_file)){
									
			$_SESSION['error'] = "File already exists. If you think this is wrong, contact oramex regional coordinator of your state.";
						
			}
			if(!isset($_SESSION['error'])){
			move_uploaded_file($_FILES["sittingroom"]["tmp_name"], $target_file);
			move_uploaded_file($_FILES["bedroom1"]["tmp_name"], $target_file1);
			move_uploaded_file($_FILES["bedroom2"]["tmp_name"], $target_file2);
			move_uploaded_file($_FILES["bedroom3"]["tmp_name"], $target_file3);
			move_uploaded_file($_FILES["bedroom4"]["tmp_name"], $target_file4);
			move_uploaded_file($_FILES["bedroom5"]["tmp_name"], $target_file5);
			move_uploaded_file($_FILES["kitchen"]["tmp_name"], $target_file6);
						
			$sql = "INSERT INTO property (Property_number, agent_id, building, floor, buildingtype, flat_type, Address, Rent, Agent_fee, Barr, Caution_fee, Security_fee, Compound_cleaning, Sitting_room, room1, Dinning, electricity, Meter, overheadtank, well, fenced, car_parkingspace, security, Compound_cleaner, toilet, suite, kitchen, kitchen_cabinet, woodrope, woodrope_cabinet)
			VALUES (:Property_number,  :agent_id, :building, :floor, :buildingtype, :flattype, :Address, :Rent, :Agent_fee, :Barr, :Caution_fee, :Security_fee, :Compound_cleaning, :Sitting_room, :room1, :Dinning, :electricity, :Meter,	:overheadtank, :well, :fenced, :car_parkingspace, :security, :Compound_cleaner, :toilet, :suite, :kitchen, :kitchen_cabinet, :woodrope, :woodrope_cabinet)";
			$stmt = $pdo->prepare($sql);
			$stmt->execute(array(
			':Property_number' => $Property_number,
			':agent_id' => $_SESSION['agentid'],
			':building' => $_POST['building'],
			':floor' => $_POST['floor'],
			':buildingtype' => $_POST['buildingtype'],
			':flattype' => $_POST['flatbuildingtype'],
			':Address' => $_POST['address'],
			':Rent' => $_POST['Rentpaymentmethod'] .$_POST['amount'], 
			':Agent_fee' => $_POST['agentfee'],
			':Barr' => $_POST['barristerfee'],
			':Caution_fee' => $_POST['cautionfee'],
			':Security_fee' => $_POST['securityfee'],
			':Compound_cleaning' => $_POST['compoundcleaninglevy'],
			':Sitting_room' => $_FILES['sittingroom'],
			':room1' => $_FILES['bedroom1'],
			':Dinning' => $_POST['dinning'],
			':electricity' => $_POST['electricity'],
			':Meter' => $_POST['meter'],
			':overheadtank' => $_POST['overheadtank'],
			':well' => $_POST['well'],
			':fenced' => $_POST['fenced'],
			':car_parkingspace' => $_POST['parkingspace'],
			':security' => $_POST['security'],
			':Compound_cleaner' => $_POST['compoundcleaner'],
			':toilet' => $_POST['numberoftoilets'],
			':suite' => $_POST['numberofroomsaresuite'],
			':kitchen' => $_POST['kitchen'],
			':kitchen_cabinet' => $_POST['kitchencabinet'],
			':woodrope' => $_POST['woodrope'],
			':woodrope_cabinet' => $_POST['woodropecabinet']));
	
		
	
	
		$_SESSION['success'] = 'Apartment uploaded.';
		header('location: admin/agent_schedule.php');
	
		return;} else{
			$_SESSION['error'] = "Your upload was not successful, Please check if you images are correctly uploaded";
			header('Location: apartment-information.php');
	
		}

	}//elseif
									
								
	

	//two bedroom flat

	if($flattype == 'twobedroom'){

			$target_dir = "2bedroomflat/";
			$target_file = $target_dir .$Property_number .'sittingroom' .basename($_FILES["sittingroom"]["name"]); 
			$target_file1 = $target_dir .$Property_number . basename($_FILES["bedroom1"]["name"]);
			$target_file2 = $target_dir .$Property_number . basename($_FILES["bedroom2"]["name"]);
			$target_file3 = $target_dir .$Property_number . basename($_FILES["bedroom3"]["name"]);
			$target_file4 = $target_dir .$Property_number . basename($_FILES["bedroom4"]["name"]);
			$target_file5 = $target_dir .$Property_number . basename($_FILES["bedroom5"]["name"]);
			$target_file6 = $target_dir .$Property_number . basename($_FILES["kitchen"]["name"]);
										
			$imageExt = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
			$allowd_file_ext = array ("jpg", "jpeg", "png");
								
			if(!file_exists($_FILES["sittingroom"]["tmp_name"]) ) {
											
			$_SESSION['error'] = "Select image to upload";
								
			} //else 
			if (!in_array($imageExt, $allowd_file_ext)) {
											
			$_SESSION['error'] = "Allowed file formats .jpg, .jpeg and .png";
								
			} //else 
			if (($_FILES["sittingroom"]["size"]) > 2097152 ) {//|| ($_FILES["bederoom1"]["size"])  
											
			$_SESSION['error'] = "File is too large. File size should be less than 2megabytes.";
								
			} //else  
			if(file_exists($target_file)){
											
			$_SESSION['error'] = "File already exists. If you think this is wrong, contact oramex regional coordinator of your state.";
								
			}
			if(!isset($_SESSION['error'])){
			move_uploaded_file($_FILES["sittingroom"]["tmp_name"], $target_file);
			move_uploaded_file($_FILES["bedroom1"]["tmp_name"], $target_file1);
			move_uploaded_file($_FILES["bedroom2"]["tmp_name"], $target_file2);
			move_uploaded_file($_FILES["bedroom3"]["tmp_name"], $target_file3);
			move_uploaded_file($_FILES["bedroom4"]["tmp_name"], $target_file4);
			move_uploaded_file($_FILES["bedroom5"]["tmp_name"], $target_file5);
			move_uploaded_file($_FILES["kitchen"]["tmp_name"], $target_file6);
								
											
			$sql = "INSERT INTO property (Property_number, agent_id, building, floor, buildingtype, flat_type, Address, Rent, Agent_fee, Barr, Caution_fee, Security_fee, Compound_cleaning, Sitting_room, room1, Dinning, electricity, Meter, overheadtank, well, fenced, car_parkingspace, security, Compound_cleaner, toilet, suite, kitchen, kitchen_cabinet, woodrope, woodrope_cabinet)
			VALUES (:Property_number,  :agent_id, :building, :floor, :buildingtype, :flattype, :Address, :Rent, :Agent_fee, :Barr, :Caution_fee, :Security_fee, :Compound_cleaning, :Sitting_room, :room1, :Dinning, :electricity, :Meter,	:overheadtank, :well, :fenced, :car_parkingspace, :security, :Compound_cleaner, :toilet, :suite, :kitchen, :kitchen_cabinet, :woodrope, :woodrope_cabinet)";
			$stmt = $pdo->prepare($sql);
			$stmt->execute(array(
			':Property_number' => $Property_number,
			':agent_id' => $_SESSION['agentid'],
			':building' => $_POST['building'],
			':floor' => $_POST['floor'],
			':buildingtype' => $_POST['buildingtype'],
			':flattype' => $_POST['flatbuildingtype'],
			':Address' => $_POST['address'],
			':Rent' => $_POST['Rentpaymentmethod'] .$_POST['amount'], 
			':Agent_fee' => $_POST['agentfee'],
			':Barr' => $_POST['barristerfee'],
			':Caution_fee' => $_POST['cautionfee'],
			':Security_fee' => $_POST['securityfee'],
			':Compound_cleaning' => $_POST['compoundcleaninglevy'],
			':Sitting_room' => $_FILES['sittingroom'],
			':room1' => $_FILES['bedroom1'],
			':Dinning' => $_POST['dinning'],
			':electricity' => $_POST['electricity'],
			':Meter' => $_POST['meter'],
			':overheadtank' => $_POST['overheadtank'],
			':well' => $_POST['well'],
			':fenced' => $_POST['fenced'],
			':car_parkingspace' => $_POST['parkingspace'],
			':security' => $_POST['security'],
			':Compound_cleaner' => $_POST['compoundcleaner'],
			':toilet' => $_POST['numberoftoilets'],
			':suite' => $_POST['numberofroomsaresuite'],
			':kitchen' => $_POST['kitchen'],
			':kitchen_cabinet' => $_POST['kitchencabinet'],
			':woodrope' => $_POST['woodrope'],
			':woodrope_cabinet' => $_POST['woodropecabinet']));
	
		
	
	
		$_SESSION['success'] = 'Apartment uploaded.';
		header('location: admin/agent_schedule.php');
	
		return;} else{
			$_SESSION['error'] = "Your upload was not successful, Please check if you images are correctly uploaded";
			header('Location: apartment-information.php');
	
		}

	}//else
										
											
	


	//Three bedroom flat
									
									
	if($flattype == 'threebedroom'){

			$target_dir = "3bedroomflat/";
			$target_file = $target_dir .$Property_number .'sittingroom' . basename($_FILES["sittingroom"]["name"]); 
			$target_file1 = $target_dir .$Property_number . basename($_FILES["bedroom1"]["name"]);
			$target_file2 = $target_dir .$Property_number . basename($_FILES["bedroom2"]["name"]);
			$target_file3 = $target_dir .$Property_number . basename($_FILES["bedroom3"]["name"]);
			$target_file4 = $target_dir .$Property_number . basename($_FILES["bedroom4"]["name"]);
			$target_file5 = $target_dir .$Property_number . basename($_FILES["bedroom5"]["name"]);
			$target_file6 = $target_dir .$Property_number . basename($_FILES["kitchen"]["name"]);
												
			$imageExt = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
			$allowd_file_ext = array ("jpg", "jpeg", "png");
										
			if(!file_exists($_FILES["sittingroom"]["tmp_name"]) ) {
													
			$_SESSION['error'] = "Select image to upload";
										
			} //else 
			if (!in_array($imageExt, $allowd_file_ext)) {
													
			$_SESSION['error'] = "Allowed file formats .jpg, .jpeg and .png";
										
			} //else 
			if (($_FILES["sittingroom"]["size"]) > 2097152 ) {//|| ($_FILES["bederoom1"]["size"])  
													
			$_SESSION['error'] = "File is too large. File size should be less than 2megabytes.";
										
			} //else  
			if(file_exists($target_file)){
													
			$_SESSION['error'] = "File already exists. If you think this is wrong, contact oramex regional coordinator of your state.";
										
			}
			if(!isset($_SESSION['error'])){
			move_uploaded_file($_FILES["sittingroom"]["tmp_name"], $target_file);
			move_uploaded_file($_FILES["bedroom1"]["tmp_name"], $target_file1);
			move_uploaded_file($_FILES["bedroom2"]["tmp_name"], $target_file2);
			move_uploaded_file($_FILES["bedroom3"]["tmp_name"], $target_file3);
			move_uploaded_file($_FILES["bedroom4"]["tmp_name"], $target_file4);
			move_uploaded_file($_FILES["bedroom5"]["tmp_name"], $target_file5);
			move_uploaded_file($_FILES["kitchen"]["tmp_name"], $target_file6);
										
			$sql = "INSERT INTO property (Property_number, agent_id, building, floor, buildingtype, flat_type, Address, Rent, Agent_fee, Barr, Caution_fee, Security_fee, Compound_cleaning, Sitting_room, room1, Dinning, electricity, Meter, overheadtank, well, fenced, car_parkingspace, security, Compound_cleaner, toilet, suite, kitchen, kitchen_cabinet, woodrope, woodrope_cabinet)
			VALUES (:Property_number,  :agent_id, :building, :floor, :buildingtype, :flattype, :Address, :Rent, :Agent_fee, :Barr, :Caution_fee, :Security_fee, :Compound_cleaning, :Sitting_room, :room1, :Dinning, :electricity, :Meter,	:overheadtank, :well, :fenced, :car_parkingspace, :security, :Compound_cleaner, :toilet, :suite, :kitchen, :kitchen_cabinet, :woodrope, :woodrope_cabinet)";
			$stmt = $pdo->prepare($sql);
			$stmt->execute(array(
			':Property_number' => $Property_number,
			':agent_id' => $_SESSION['agentid'],
			':building' => $_POST['building'],
			':floor' => $_POST['floor'],
			':buildingtype' => $_POST['buildingtype'],
			':flattype' => $_POST['flatbuildingtype'],
			':Address' => $_POST['address'],
			':Rent' => $_POST['Rentpaymentmethod'] .$_POST['amount'], 
			':Agent_fee' => $_POST['agentfee'],
			':Barr' => $_POST['barristerfee'],
			':Caution_fee' => $_POST['cautionfee'],
			':Security_fee' => $_POST['securityfee'],
			':Compound_cleaning' => $_POST['compoundcleaninglevy'],
			':Sitting_room' => $_FILES['sittingroom'],
			':room1' => $_FILES['bedroom1'],
			':Dinning' => $_POST['dinning'],
			':electricity' => $_POST['electricity'],
			':Meter' => $_POST['meter'],
			':overheadtank' => $_POST['overheadtank'],
			':well' => $_POST['well'],
			':fenced' => $_POST['fenced'],
			':car_parkingspace' => $_POST['parkingspace'],
			':security' => $_POST['security'],
			':Compound_cleaner' => $_POST['compoundcleaner'],
			':toilet' => $_POST['numberoftoilets'],
			':suite' => $_POST['numberofroomsaresuite'],
			':kitchen' => $_POST['kitchen'],
			':kitchen_cabinet' => $_POST['kitchencabinet'],
			':woodrope' => $_POST['woodrope'],
			':woodrope_cabinet' => $_POST['woodropecabinet']));
	
		
	
	
		$_SESSION['success'] = 'Apartment uploaded.';
		header('location: admin/agent_schedule.php');
	
		return;} 
		else{
			$_SESSION['error'] = "Your upload was not successful, Please check if you images are correctly uploaded";
			header('Location: apartment-information.php');
	
		}

	}
													
												
	
		
			
	//four bedroom flate


	//else
	if($flattype == 'fourbedroom'){

			$target_dir = "4bedroomflat/";
			$target_file = $target_dir .$Property_number .'sittingroom' . basename($_FILES["sittingroom"]["name"]); 
			$target_file1 = $target_dir .$Property_number . basename($_FILES["bedroom1"]["name"]);
			$target_file2 = $target_dir .$Property_number . basename($_FILES["bedroom2"]["name"]);
			$target_file3 = $target_dir .$Property_number . basename($_FILES["bedroom3"]["name"]);
			$target_file4 = $target_dir .$Property_number . basename($_FILES["bedroom4"]["name"]);
			$target_file5 = $target_dir .$Property_number . basename($_FILES["bedroom5"]["name"]);
			$target_file6 = $target_dir .$Property_number . basename($_FILES["kitchen"]["name"]);
														
			$imageExt = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
			$allowd_file_ext = array ("jpg", "jpeg", "png");
			if(!file_exists($_FILES["sittingroom"]["tmp_name"]) ) {
															
			$_SESSION['error'] = "Select image to upload";
												
			} //else 
			if (!in_array($imageExt, $allowd_file_ext)) {
															
															$_SESSION['error'] = "Allowed file formats .jpg, .jpeg and .png";
												
														} //else 
														if (($_FILES["sittingroom"]["size"]) > 2097152 ) {//|| ($_FILES["bederoom1"]["size"])  
															
															$_SESSION['error'] = "File is too large. File size should be less than 2megabytes.";
												
														} //else  
														if(file_exists($target_file)){
															
															$_SESSION['error'] = "File already exists. If you think this is wrong, contact oramex regional coordinator of your state.";
												
														}
														if(!isset($_SESSION['error'])){
															move_uploaded_file($_FILES["sittingroom"]["tmp_name"], $target_file);
															move_uploaded_file($_FILES["bedroom1"]["tmp_name"], $target_file1);
															move_uploaded_file($_FILES["bedroom2"]["tmp_name"], $target_file2);
															move_uploaded_file($_FILES["bedroom3"]["tmp_name"], $target_file3);
															move_uploaded_file($_FILES["bedroom4"]["tmp_name"], $target_file4);
															move_uploaded_file($_FILES["bedroom5"]["tmp_name"], $target_file5);
															move_uploaded_file($_FILES["kitchen"]["tmp_name"], $target_file6);
												
															
			$sql = "INSERT INTO property (Property_number, agent_id, building, floor, buildingtype, flat_type, Address, Rent, Agent_fee, Barr, Caution_fee, Security_fee, Compound_cleaning, Sitting_room, room1, Dinning, electricity, Meter, overheadtank, well, fenced, car_parkingspace, security, Compound_cleaner, toilet, suite, kitchen, kitchen_cabinet, woodrope, woodrope_cabinet)
			VALUES (:Property_number,  :agent_id, :building, :floor, :buildingtype, :flattype, :Address, :Rent, :Agent_fee, :Barr, :Caution_fee, :Security_fee, :Compound_cleaning, :Sitting_room, :room1, :Dinning, :electricity, :Meter,	:overheadtank, :well, :fenced, :car_parkingspace, :security, :Compound_cleaner, :toilet, :suite, :kitchen, :kitchen_cabinet, :woodrope, :woodrope_cabinet)";
			$stmt = $pdo->prepare($sql);
			$stmt->execute(array(
			':Property_number' => $Property_number,
			':agent_id' => $_SESSION['agentid'],
			':building' => $_POST['building'],
			':floor' => $_POST['floor'],
			':buildingtype' => $_POST['buildingtype'],
			':flattype' => $_POST['flatbuildingtype'],
			':Address' => $_POST['address'],
			':Rent' => $_POST['Rentpaymentmethod'] .$_POST['amount'], 
			':Agent_fee' => $_POST['agentfee'],
			':Barr' => $_POST['barristerfee'],
			':Caution_fee' => $_POST['cautionfee'],
			':Security_fee' => $_POST['securityfee'],
			':Compound_cleaning' => $_POST['compoundcleaninglevy'],
			':Sitting_room' => $_FILES['sittingroom'],
			':room1' => $_FILES['bedroom1'],
			':Dinning' => $_POST['dinning'],
			':electricity' => $_POST['electricity'],
			':Meter' => $_POST['meter'],
			':overheadtank' => $_POST['overheadtank'],
			':well' => $_POST['well'],
			':fenced' => $_POST['fenced'],
			':car_parkingspace' => $_POST['parkingspace'],
			':security' => $_POST['security'],
			':Compound_cleaner' => $_POST['compoundcleaner'],
			':toilet' => $_POST['numberoftoilets'],
			':suite' => $_POST['numberofroomsaresuite'],
			':kitchen' => $_POST['kitchen'],
			':kitchen_cabinet' => $_POST['kitchencabinet'],
			':woodrope' => $_POST['woodrope'],
			':woodrope_cabinet' => $_POST['woodropecabinet']));
	
		
	
	
		$_SESSION['success'] = 'Apartment uploaded.';
		header('location: admin/agent_schedule.php');
	
		return;} 
		
		else{
			$_SESSION['error'] = "Your upload was not successful, Please check if you images are correctly uploaded";
			header('Location: apartment-information.php');
	
		}

	}

}											
}




if(isset($_POST['appointment'])){

	
	
	$agentfid =  $_SESSION['agentid'];

	$sql = "SELECT Property_number FROM property WHERE agent_id = :agentid LIMIT 1";
	$stmt = $pdo->prepare($sql);
	$stmt ->execute(array(
		':agentid' => $agentfid,
	));

	$result = $stmt->fetch(PDO::FETCH_ASSOC);
		$user = $result;
		
		
		
		$sql = "INSERT INTO appointment ( Property_number, agent_id, monday, tuesday, wednesday, thursday, friday, saturday, sunday, 
		8am_9am, 9am_10am, 10am_11am, 11am_12noon, 12noon_1pm, 1pm_2pm, 2pm_3pm, 3pm_4pm, 4pm_5pm, 5pm_6pm, 
		Meetingaddress)
		VALUES (:Property_number, :agent_id, :monday, :tuesday, :wednesday, :thursday, :friday, :saturday, :sunday, 
		:8am, :9am, :10am, :11am, :12noon, :1pm, :2pm, :3pm, :4pm, :5pm, 
		:Meetingaddress)";
		$stmt = $pdo->prepare($sql);
		$stmt->execute(array(
		':Property_number' => $user['Property_number'], 
		':agent_id' => $agentfid,
		':monday' => $_POST['monday'],
		':tuesday' => $_POST['tuesday'],
		':wednesday' => $_POST['wednesday'],
		':thursday' => $_POST['thursday'],
		':friday' => $_POST['friday'],
		':saturday' => $_POST['saturday'],
		':sunday' => $_POST['sunday'],
		':8am' => $_POST["8am-9am"],
		':9am' => $_POST["9am-10am"],
		':10am' => $_POST["10am-11am"],
		':11am' => $_POST['11am-12noon'],
		':12noon' => $_POST['12noon-1pm'],
		':1pm' => $_POST['1pm-2pm'],
		':2pm' => $_POST['2pm-3pm'],
		':3pm' => $_POST['3pm-4pm'],
		':4pm' => $_POST['4pm-5pm'],
		':5pm' => $_POST['5pm-6pm'],
		':Meetingaddress' => $_POST['meeting'],
		)); 	
		$_SESSION['success'] = 'Apartment uploaded.';
		header('Location: profilepage.php');

		return;
}



//complete registeration for agents 

if (isset($_POST['completereg'])) {
	if (strlen($_POST['bankname']) < 1) {
		$_SESSION['error'] = "Please, Bank name required";
		header("Location:completeregisteration.php");
		return;
	}

	if (strlen($_POST['accountnumber']) < 1) {
		$_SESSION['error'] = "Bank account number required";
		header("Location:completeregisteration.php");
		return;
	}

	if (!empty($_FILES['govtid'])){
	$target_dir = "govt_id/";
		$govtid = $target_dir . basename($_FILES["govtid"]["name"]);
		$imageExt = strtolower(pathinfo($govtid, PATHINFO_EXTENSION));
		$allowd_file_ext = array ("jpg", "jpeg", "png");

		if(!file_exists($_FILES["govtid"]["tmp_name"])) {
			
			$_SESSION['error'] = "Select image to upload";

		} else if (!in_array($imageExt, $allowd_file_ext)) {
			
			$_SESSION['error'] = "Allowed file formats .jpg, .jpeg and .png";

		} else if ($_FILES["govtid"]["size"] > 2097152) {
			
			$_SESSION['error'] = "File is too large. File size should be less than 2megabytes.";

	
		}else {
			move_uploaded_file($_FILES["govtid"]["tmp_name"], $govtid);

			
		}
						
	}

	if (!empty($_FILES['passport'])){
		$target_dir = "passport/";
			$passport = $target_dir . basename($_FILES["govtid"]["name"]);
			$imageExt = strtolower(pathinfo($passport, PATHINFO_EXTENSION));
			$allowd_file_ext = array ("jpg", "jpeg", "png");
	
			if(!file_exists($_FILES["passport"]["tmp_name"])) {
				
				$_SESSION['error'] = "Select image to upload";
	
			} else if (!in_array($imageExt, $allowd_file_ext)) {
				
				$_SESSION['error'] = "Allowed file formats .jpg, .jpeg and .png";
	
			} else if ($_FILES["passport"]["size"] > 2097152) {
				
				$_SESSION['error'] = "File is too large. File size should be less than 2megabytes.";
	
		
			}else {
				move_uploaded_file($_FILES["passport"]["tmp_name"], $passport);
	
				
			}
							
		}

		
				
		if(!isset($_SESSION['error']) ) {

			$agentfid = $_SESSION['agentid'];

			$sql = "SELECT agent_id FROM agent WHERE agent_id = :agentid LIMIT 1";
			$stmt = $pdo->prepare($sql);
			$stmt ->execute(array(
				':agentid' => $agentfid,
			));

			$result = $stmt->fetch(PDO::FETCH_ASSOC);
				$user = $result;

	
		
		$sql = "INSERT INTO verfied_agent (agent_id, Bank_name, Account_number, Govt_id,  passport)
		VALUES (:agent_id, :Bank_name, :Account_number, :Govt_id, :passport)";
		$stmt = $pdo->prepare($sql);
		$stmt->execute(array(
			':agent_id' =>  $user['agent_id'],
			':Bank_name' =>$_POST['bankname'],
			':Account_number' => $_POST['accountnumber'], 
			':Govt_id' => $_FILES['govtid'],
			':passport' => $_FILES['passport']
		)); 

	
		
		$_SESSION['success'] = 'Thank you for completing your registering with Oramex Enterpris. This will help us work better with you.';
		header('location: admin/agent_schedule.php');

		
			return;

			
		
		}else {

			$_SESSION['error'] = 'Please, check the information you filled in';
			header('Location: completeregistration.php');
		}

		//unset();
		return;
		
	} 


	//forgot password

	if (isset($_POST['forgotpassword'])){
		$email = $_POST['email'];

		if (strlen($_POST['email']) < 1) {
			$_SESSION['error'] = "Please, email required";
			header("Location:forgotpassword.php");
			return;
		}

		if (!empty($_POST['email']) && !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
			$_SESSION['error'] = "Please, invalid email";
			header("Location:register.php");
			return;
	} else {
		$emailQuery = "SELECT * FROM agent WHERE email = :email LIMIT 1";
		$stmt = $pdo->prepare($emailQuery);
		$stmt->execute(array (
		':email' => $email,
		));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$token= $row['token'];



		$to      = $row['email'];
		$subject = 'Password Recovery';
		$message = ' <p> 
		Hello, 
		Please click on the link below to reset your password. 
		</p>
		</p>
		 <a href="http://localhost/oramexhomes/register.php?password-token='. $token .'">
		 reset your password
		 </p>
<br><br>
		<p><strong>
		 Ojoechem Ozioma,
		 Admin, Oramex Property
		 1 University Market road, Nsukka 
		 09157387503
		 </strong>
		 </p>';
		$headers = 'From: admin@oramexpropt.com' . "\r\n" .
			'Reply-To: oramexproperty@gmail.com, admin@oramexpropt.com' . "\r\n" .
			'X-Mailer: PHP/' . phpversion();
		
		mail($to, $subject, $message, $headers);
		//sendPasswordResetLink ($email, $token);

		header('location:passwordmessage.php');
		return;
		
		} 

		
	} 
	

	if(isset($_POST['resetpassword'])){
		if (strlen ($_POST['password']) < 1) {
			$_SESSION['error'] = "Please, choose a password";
			header("Location:reset_password.php");
			return;
		} 

		if (strlen($_POST['password']) < 8 || strlen($_POST['password']) > 16) {
			$_SESSION['error'] = "Password should be min 8 characters and max 16 characters";
			header("Location:reset_password.php");
			return;
			}
		if (!preg_match("/\d/", $_POST['password'])) {
			$_SESSION['error']  = "Password should contain at least one digit";
			header("Location:reset_password.php");
			return;
		}
		if (!preg_match("/[A-Z]/", $_POST['password'])) {
			$_SESSION['error']  = "Password should contain at least one Capital Letter";
			header("Location:reset_password.php");
			return;
		}
		if (!preg_match("/[a-z]/", $_POST['password'])) {
			$_SESSION['error']  = "Password should contain at least one small Letter";
			header("Location:reset_password.php");
			return;
		}
		
		if (preg_match("/\s/", $_POST['password'])) {
			$_SESSION['error']  = "Password should not contain any white space";
			header("Location:reset_password.php");
			return;
		}
	

	if (isset($_POST['password']) && isset($_POST['passwordConf']) && $_POST['password'] !== $_POST['passwordConf']) {
			$_SESSION['error'] = "Password and password confirmation are not same";
			header("Location:reset_password.php");
			return;
	}

	$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
	$email = $_SESSION['email'];

if(!isset($_SESSION['error'])){
	$sql="UPDATE agent SET password = '$password' WHERE email= '$email'";
	$stmt = $pdo ->prepare($sql);
	if($stmt->execute){
		header("location:register.php");
	}

	return;
}

	}

	function resetPassword($token)
	{
		global $pdo;
		$sql = "SELECT * FROM agent WHERE token ='$token' LIMIT 1";
		$stmt = $pdo ->prepare($sql);
	
		$user = $stmt->fetch(PDO::FETCH_ASSOC);
		$_SESSION['email'] = $user['email'];
		header('location:reset_password.php');

		return;
	}



	//customer interest form

	if (isset($_POST['customer_reg'])) {

		$ghr = $_POST['apartment_number'];

		if (strlen($_POST['Client_name']) < 1) {
			$_SESSION['error'] = "Please,  name required";
			header("Location:interestform.php?Property_number=$ghr");
			return;
		}
	
		if (strlen($_POST['Phone_number']) < 1) {
			$_SESSION['error'] = "Phone number required";
			header("Location:interestform.php?Property_number=$ghr");
			return;
		}


		if (strlen($_POST['Phone_number']) < 11) {
			$_SESSION['error'] = "Invalid phone number, please check your number";
			header("Location:interestform.php?Property_number=$ghr");
			return;
		}

		if (strlen($_POST['whatsapp_number']) < 1) {
			$_SESSION['error'] = "whatsapp number required";
			header("Location:interestform.php?Property_number=$ghr");
			return;
		}

		if (strlen($_POST['whatsapp_number']) < 11) {
			$_SESSION['error'] =  "Invalid phone number, please check your number";
			header("Location:interestform.php?Property_number=$ghr");
			return;
		}
	
		if (!empty($_POST['email']) && !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
			$_SESSION['error'] = "Please, invalid email";
			header("Location:interestform.php?Property_number=$ghr");
			return;
	}
			if(!isset($_SESSION['error']) ) {
		
				$newcustomerid = uniqid(rand());

			$sql = "INSERT INTO rent_interest (Property_number, Client_name, Phone_number, email, whatsapp_number, customer_id)
			VALUES (:Property_number, :Client_name, :Phone_number, :email, :whatsapp_number, :customer_id)";
			$stmt = $pdo->prepare($sql);
			$stmt->execute(array(
				':customer_id' => $newcustomerid,
				':Property_number' => $_POST['apartment_number'], 
				':Client_name' => $_POST['Client_name'],
				':Phone_number' => $_POST['Phone_number'],
				':whatsapp_number' => $_POST['whatsapp_number'],
				':email' => $_POST['email'],
			));

			
			
// 			$sql = "SELECT * FROM agent_schedule_table 
//  INNER JOIN agent 
//  ON agent.agent_id = agent_schedule_table.agent_id 
// INNER JOIN property
// ON property.agent_id = agent.agent_id
// INNER JOIN rent_interest
// ON rent_interest.Property_number = property.Property_number

// WHERE (agent_schedule_table.agent_schedule_date >= '$todaysdate' AND property.Property_number = '".$_POST['apartment_number']."')";

// $stmt = $pdo->prepare($sql);
// $stmt ->execute(array());

// $result = $stmt->fetch(PDO::FETCH_ASSOC);
var_dump($result); 

// $_SESSION['name'] = $result['Surname'] .' '. $result['First_name'];
// $_SESSION['agent_schedule_date'] = $result['agent_schedule_date'];
// $_SESSION['agent_schedule_day'] = $result['agent_schedule_day'];
// $_SESSION['agent_schedule_start_time'] = $result['agent_schedule_start_time'];
// $_SESSION["agent_id"] = $result["agent_id"];
// $_SESSION["agent_schedule_id"] = $result["agent_schedule_id"];
// $_SESSION["customerid"] = $result["customer_id"];

$_SESSION["customerid"] = $newcustomerid;
$_SESSION["apartment_number"] = $_POST['apartment_number']; 
			 
			$_SESSION['success'] = 'pick suitable date ';
			header('Location: dashboard.php');
	
		return;

	
	}else{
		$_SESSION['error'] = "There is error";
		header('Location: interestform.php');

	
	

	}

	}





	if(isset($_POST['get_appointment']))
	{
	
		$agent_schedule_id = $_POST['hidden_agent_schedule_id'];
		 
		$customerid = $_POST['customer_id'];

		$sql = "SELECT * FROM rent_interest
		WHERE customer_id = '".$customerid."'
		";
		$stmt = $pdo->prepare($sql);
		$stmt ->execute(array());
		
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		

		$customer_data = $result;
		
		var_dump($customer_data);

		// $object->query 
		$sql = "
		SELECT * FROM agent_schedule_table 
		INNER JOIN agent 
		ON agent.agent_id = agent_schedule_table.agent_id 
		WHERE agent_schedule_table.agent_schedule_id = '".$agent_schedule_id."'
		";


		$stmt = $pdo->prepare($sql);
		$stmt ->execute(array());
		
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		

		// $customer_data = 
		$agent_schedule_data = $result;
		
		//var_dump($agent_schedule_data);
		//$object->get_result();

		$_SESSION['email'] = $customer_data['email'];
		$_SESSION['Client_name'] = $customer_data['Client_name'];
$_SESSION['Phonenumber'] = $customer_data["Phone_number"];
$_SESSION['Property_number'] = $customer_data["Property_number"];
$_SESSION["agent_firstname"] = $agent_schedule_data["First_name"];
$_SESSION["agent_schedule_date"] = $agent_schedule_data["agent_schedule_date"];
$_SESSION["agent_schedule_day"] = $agent_schedule_data["agent_schedule_day"];
$_SESSION["agent_schedule_start_time"] = $agent_schedule_data["agent_schedule_start_time"];
$_SESSION["customerid"] = $customer_data["customer_id"];
$_SESSION["agent_schedule_id"] = $agent_schedule_data["agent_schedule_id"];
$_SESSION["agent_id"] = $agent_schedule_data["agent_id"];

		$_SESSION['success'] = 'Confirm your appointent';
			header('Location: bookappointment.php');


	
	}
	



		//To book appointment

		if(isset($_POST['book_appointment'])){

		$customer_id = $_SESSION["customerid"];

		$agent_schedule_id	= $_SESSION["agent_schedule_id"];	
		//$_POST['hidden_agent_schedule_id'];
		$property_number = $_SESSION['Property_number'];
		//$_POST['Property_number'];
		$email = $_SESSION['email'];
		//$_POST['email'];
		$agent_id = $_SESSION["agent_id"];
		

		$sql = "SELECT * FROM appointment 
		WHERE customer_id = :customer_id 
		AND agent_schedule_id = :agent_schedule_id
		AND Property_number = :Property_number
		";

		$stmt = $pdo->prepare($sql);
		$stmt ->execute(array(
			':customer_id' => $customer_id,
			'agent_schedule_id' => $agent_schedule_id,
			':Property_number' => $property_number,
		));
		
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		

		if($result > 0)
		{
			$error = '<div class="alert alert-danger">You have already applied for appointment for this property, try for another property.</div>';
		}
		else
		{
			$sql = "
			SELECT * FROM agent_schedule_table 
			WHERE agent_schedule_id = '$agent_schedule_id'
			";

			$stmt = $pdo->prepare($sql);
		$stmt ->execute(array(
			
			
			
		));
		
		$schedule_data = $stmt->fetch(PDO::FETCH_ASSOC);

			$sql = "SELECT COUNT(appointment_id) AS total FROM appointment 
			WHERE agent_schedule_id = '.$agent_schedule_id.' 
			";

			$stmt = $pdo->prepare($sql);
			$stmt ->execute(array(
				
				
				
			));
			
			$appointment_data = $stmt->fetch(PDO::FETCH_ASSOC);

			 //= $object->get_result();

			 $total_agent_available_minute = 0;
			 $average_consulting_time = 0;
			 $total_appointment = 0;

			 
			// foreach($schedule_data as $schedule_row)
			// {
		
				$end_time = strtotime($schedule_data["agent_schedule_end_time"] . ':00');
				
				$start_time = strtotime($schedule_data["agent_schedule_start_time"] . ':00');

				$total_agent_available_minute = ($end_time - $start_time) / 60;

				$average_inspection_time = $schedule_data["average_inspection_time"];
				

			//  foreach($appointment_data as $appointment_row)
			//  {

				$total_appointment = $appointment_data["total"];
				
			//}
			//}

			$total_appointment_minute_use = $total_appointment * $average_inspection_time;
			
			$appointment_time = date("H:i", strtotime('+'.$total_appointment_minute_use.' minutes', $start_time));
			
			$status = '';

			//$appointment_number = $object->Generate_appointment_no();

			$sql = "SELECT MAX(appointment_number) as appointment_number FROM appointment 
			-- WHERE agent_schedule_id = '.$agent_schedule_id.' 
		";

		$stmt = $pdo->prepare($sql);
		$stmt ->execute(array(
			
			
			
		));
		
		$result= $stmt->fetch(PDO::FETCH_ASSOC);
		
		
		 //= $this->get_result();

		//$appointment_number = 0;

		// foreach($result as $row)
		// {
			$appointment_number = $result["appointment_number"];
		//}
		

		if($appointment_number > 0)
		{
			$appointment_number = $appointment_number + 1;

			
		}
		else
		{
			$appointment_number = 0;
		}

		if(strtotime($end_time) > strtotime($appointment_time . ':00'))
		{
			
			$status = 'Booked';
		}
		else
		{
			$status = 'Waiting';
		}
		


		// $data = array(
		// 	':agent_id'				=>	$_POST['hidden_agent_id'],
		// 	':customer_id'				=>	$_SESSION['customerid'],
		// 	':agent_schedule_id'		=>	$_POST['hidden_agent_schedule_id'],
		// 	':appointment_number'		=>	$appointment_number,
		// 	//':reason_for_appointment'	=>	$_POST['reason_for_appointment'],
		// 	':appointment_time'			=>	$appointment_time,
		// 	':status'					=>	'Booked'
		// );

		$sql = "INSERT INTO appointment (Property_number, agent_id, customer_id, agent_schedule_id, appointment_number,  appointment_time, status) 
		VALUES (:property_number, :agent_id, :customer_id, :agent_schedule_id, :appointment_number, :appointment_time, :status)
		";

		$stmt = $pdo->prepare($sql);
			$stmt->execute(array(
				':property_number' => $property_number,
				':agent_id'				=>	$agent_id,
			':customer_id'				=>	$customer_id,
			':agent_schedule_id'		=>	$agent_schedule_id,
			':appointment_number'		=>	$appointment_number,
			//':reason_for_appointment'	=>	$_POST['reason_for_appointment'],
			':appointment_time'			=>	$appointment_time,
			':status'					=>	$status,
			));

			$appointment_number = $_SESSION["appointment_number"];
			
			

		


		//sendappointmentEmail ($_SESSION['email'], $appointment_time);

	$to      = $email;
  $subject = 'Appointment Confirmation';
  
  $message = ' <head>
      <title>Confirmation of appointment </title>
        
      
      </head>
      <body>
          
          <div>
             <p> This is to confirm that your appointment has been booked successfully </p>
<p>
<h4 class="text-center">Things to bear in mind</h4>
		<ul>
		<li>You are not allowed/expected to pay any agent for inspection or services rendered in this course</li>
		<li>Your safety is very important. It is your duty to be conscious of any activity in the course inspection </li>
		<li>At any point, you feel uncomfortable with the inspection activity, abort it and report suspicious or unpleasant activity to Oramex enterprises for proper action</li>
		<li>Make sure that the meeting place is a well known public place</li>
		<li>Time is very important, try to be at the meeting place 10mins before the appointment time.</li>
		<li>All transaction related to the apartment should be done through Oramex enterprises official Bank account details provided to you by oramex.</li>
		<li>Making any transaction outside Oramex enterprises account details is at your own risk. Oramex enterprise will not be responsible for any lost</li>
		<li>Bank Details: Account Name: Oramex Enterprise</li>
		<li>Bank Name: Access Bank</li>
		<li>Account number: 0071906262</li>
		<li>Follow the link sent to you, in your SMS, whatsapp and/or Email for feedback and complain. You can also contact any of your staff listed in our website</li>
		<li> Your appointment is '.$appointment_time.'</li>
    <li> Your apartment number '.$property_number.'</li>
		</ul>;
    
</p>
<p>Your 

              <a href="http://www.oramexpropt.com/customerfeedback.php?customerid='.$customer_id.'&propertynumber='.$property_number.'">
              Follow this link for feedback

			  Disclaimer: 
			  Oramex Property agency and management will never ask for sensitive informations from our customers or works for any reason.
			  Oramex Property agency and management will always communicate to your through our offical email admin@oramexpropt.com, official phone number
			  and whatsapp number if need be 09157387503

              <p><strong>
             
			
			signed:
			Ugbede Micheal,
		 Admin, Oramex Property agency and management
		 1 University Market road, Nsukka, Enugu State. 
              </strong>
              </p>
  </div>
  </body>
  </html>';
// Create a message
$headers = 'MIME-Version: 1.0';
$headers = 'Content-type: text/html; charset=iso-8859-1';
$headers  = 'From: Oramex Property Agency and Managment <admin@oramexpropt.com>';
			'Reply-To: oramexproperty@gmail.com, admin@oramexpropt.com' . "\r\n" .
			'X-Mailer: PHP/' . phpversion();
;

// Send the message
mail($to, $subject, $message, $headers);








		$sql= "SELECT * FROM agent WHERE agent_id = :agent_id"; 
		$stmt = $pdo->prepare($sql);
		$stmt->execute(array( 
			':agent_id' => $agent_id,
		)); 
		 $result = $stmt->fetch(PDO::FETCH_ASSOC);


		 
	
		 $to      = $result['email'];
		 $subject = 'Appointment Confirmation';
		 
		 $message = '
  <html>
      <head>
      <title>Confirmation of appointment </title>
          
      
      </head>
      <body>
				 
				 <div>
					<p> This is to Inform you  that one of your appointment has been booked for inspection </p>
	   <p>
	   <h4>Things to bear in mind</h4>
			   <ul>
			   <li>You are not allowed/expected to money for inspection or services rendered in this course</li>
			   <li> Your safety and the safety our customer is very important so keep this inspection as safe as possible. </li>
			   <li>At any point, you feel uncomfortable with the inspection activity, abort it and report suspicious or unpleasant activity to Oramex enterprises for proper action</li>
			   <li>Make sure that the meeting place is a well known public place</li>
			   <li>Time is very important, try to be at the meeting place 10mins before the appointment time.</li>
			   <li>All transaction related to the apartment should be done through Oramex enterprises official Bank account details provided to the customer.</li>
			   <li>Always advice customers to use the company account details</li>
			   <li>Bank Details: Account Name: Oramex Enterprise</li>
			   <li>Bank Name: Access Bank</li>
			   <li>Account number: 0071906262</li>
			   <li>The company will not be liable to any danger or lost that occurs from not keeping to the guidelines.</li>
		   <li>Report to your regional coordinator of any unfriendly behaviour from any customer.</li>
			   <li> Your appointment is '.$appointment_time.'</li>
		   <li> Your apartment number '.$property_number.'</li>
			   </ul>;
		   
	   </p>
	   <p>
	   Disclaimer: 
			Oramex Property agency and management will never ask for sensitive informations from our customers or works for any reason.
			Oramex Property agency and management will always communicate to your through our offical email admin@oramexpropt.com, official phone number
			and whatsapp number if need be 09157387503
			<strong>
			signed:
			Ugbede Micheal,
		 Admin, Oramex Property agency and management
		 1 University Market road, Nsukka, Enugu State. 
	   </strong>
	   </p>
					 
		 </div>
		 </body>
		 </html>';
	   // Create a message
	   $headers = 'MIME-Version: 1.0';
		$headers = 'Content-type: text/html; charset=iso-8859-1';
	   $headers  = 'From: Oramex Property Agency and Managment <admin@oramexpropt.com>';
	   
			'Reply-To: oramexproperty@gmail.com, admin@oramexpropt.com';
			'X-Mailer: PHP/' . phpversion();
;
	   
	   // Send the message
	   mail($to, $subject, $message, $headers);
	   
		//sendappointmentagentEmail ($result['email'], $appointment_time);

		// $number = $_SESSION['Phone_number'];
		// $message_body = urlencode('Ur appointment is '.$appointment_time.', Your apartment number is: '.$property_number.', Bank Details: Account Name: Oramex Enterprise
		// Bank Name: Access Bank,
		// Account number: 0071906262, http://localhost/oramexhomes/customerfeedback.php?customerid='.$customer_id.'
		// Follow this link for feedback');

		// function CURLsendsms($number, $message_body){

		// 	//$baseurl = 'http://web.springedge.com/api/web/send?apikey='.$apikey;
		// 	$api_params = $api_element.'?apikey='.$apikey.'&sender='.$sender.'&to='.$mobileno.'&message='.$textmessage;  
		// 	$smsGatewayUrl = "http://springedge.com";  
		// 	$smsgatewaydata = $smsGatewayUrl.$api_params;
		// 	$url = $smsgatewaydata;
	
		// 	$ch = curl_init();                       // initialize CURL
		// 	curl_setopt($ch, CURLOPT_POST, false);    // Set CURL Post Data
		// 	curl_setopt($ch, CURLOPT_URL, $url);
		// 	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// 	$output = curl_exec($ch);
		// 	curl_close($ch);                         // Close CURL
	
		// 	// Use file get contents when CURL is not installed on server.
		// 	if(!$output){
		// 	   $output =  file_get_contents($smsgatewaydata);  
		// 	}
	
		// }

		// //Send SMS, whatsapp and email
		
		// //$_SESSION['Phone_number'] = $result['Phone_number'];
		// //$_SESSION['whatsapp_number'] = $result['whatsapp_number'];


		


	//echo 'customerappointmentpdf.php';
		
	$_SESSION['appointment_message'] = '<div class="alert alert-success">Your Appointment has been <b>'.$status.'</b> with Appointment No. <b>'.$appointment_number.'</b></div>';
	
		header('Location: customerappointmentpdf.php');
	
	
		
	//echo json_encode(['error' => $error]);
} 
	
		}



		//ADMIN PAGE FUNCTIONS 

		//To disable Agent account

	if (isset($_POST['disableagentid'])) {

		$disableagid =	$_POST['disableagent'];

		$stmt = $pdo->prepare("UPDATE  agent SET Disabled = 1 WHERE agent_id = :agentid");
		$stmt->execute([ ':agentid' => $disableagid ]);
		$rows = array();

   		 $_SESSION['success'] = 'Agent account has been disabled';
    	header("Admin.php");
		return;
   }

   

   //TO VERIFY NEWLY EMPLOYED STAFF
   if (isset($_POST['newstaffverify'])) {

	$newstaff=	$_POST['newstaffverify'];

	$stmt = $pdo->prepare("UPDATE  staff SET Approved = 'Yes' WHERE Staff_id = :staff_id");
	$stmt->execute([ ':staff_id' => $newstaff ]);
	$rows = array();


	$sql ="SELECT * FROM staff WHERE  Staff_id = :staff_id";
			$stmt = $pdo->prepare($sql);
			$stmt->execute(array( 
				':staff_id' => $newstaff,
			)); 

			 $result = $stmt->fetch(PDO::FETCH_ASSOC);

			 $result['email'];
			 $staffid = $result['Staff_id'];


			 
		$to      = $result['email'];
		$subject = 'Staff Confirmation';
		$message = '<p> This is to confirm to you that you have approved as one of our staff "ORAMEX PROPERTY"
		<img src="../imagereation\R.gif" width="500" height="600">

		Staff ID =' .$staffid.'

		Use your staff id to login and then generate your ID card. 
		</p>

		<p><strong>
		Disclaimer: 
		Oramex Property agency and management will never ask for sensitive informations from our customers or works for any reason.
		Oramex Property agency and management will always communicate to your through our offical email admin@oramexpropt.com, official phone number
		and whatsapp number if need be 09157387503
		
		signed:
		Ugbede Micheal,
	 Admin, Oramex Property agency and management
	 1 University Market road, Nsukka, Enugu State.
		 </strong>
		 </p>';
		$headers = 'From: admin@oramexpropt.com' . "\r\n" .
			'Reply-To: oramexproperty@gmail.com, admin@oramexpropt.com' . "\r\n" .
			'X-Mailer: PHP/' . phpversion();
		
		mail($to, $subject, $message, $headers);
		
	//sendVerificationstaffEmail($result['email'], $staffid);

		$_SESSION['success'] = 'Staff Verification, successful';
	header("Admin.php");
	return;
}

   //To get property details for Admin to query property discripancy

   



   // STAFF PAGE FUNCTIONS

		//Customer details function


		// if ( isset($_POST['verifiedbtn']) ) {
		// 	$sql = "UPDATE verfied_agent SET verified = '1' WHERE user_id = :userid";
		// 	$stmt = $pdo->prepare($sql);
		// 	$stmt->execute(array(':userid' => $_POST['verifiedbtn']));
		// 	$_SESSION['success'] = 'Record updated';
		// 	header( 'Location: customerdetails.php' ) ;
		// 	return;
		// }


		// if ( isset($_POST['Rented']) && isset($_POST['Property_number']) ) {
		// 	$sql = "DELETE  FROM rent_interest  WHERE Property_number = :userid";
		// 	$stmt = $pdo->prepare($sql);
		// 	$stmt->execute(array(':userid' => $_POST['Property_number']));
		// 	$_SESSION['success'] = 'Record updated';
		// 	header( 'Location: customerdetails.php' ) ;
		// 	return;
		// }



		//Agent verified account
		
if(isset($_POST['agentverifiedbtn'])) {

	

	$agentid =	$_POST['agentverifiedbtn'];
$stmt = $pdo->prepare("UPDATE  verfied_agent SET verified = 1 WHERE agent_id = :agentid");
$stmt->execute([ ':agentid' => $agentid ]);
$rows = array();

$_SESSION['success'] = 'Agent account has been verified';
header("customerdetails.php");
return;
}
  




// When an apartment is rented 

if(isset($_POST['proprentedbtn'])) {
 	
	$rentapart =	$_POST['proprentedbtn'];
	$stmt = $pdo->prepare("UPDATE  property SET rented = 1 WHERE Property_number = :rentapart");
	$stmt->execute([ ':rentapart' => $rentapart ]);

sleep(172800);

	$sql = "DELETE  FROM rent_interest  WHERE Property_number = :rentapart";
		$stmt = $pdo->prepare($sql);
	$stmt->execute(array(':rentapart' => $rentapart));

	if ($stmt->execute()) {
	$_SESSION['success'] = 'Rent Completed';
	header( 'Location: customerdetails.php' ) ;
	return;
	
  }
}


//if apartment is inspected 
//i need jquery code to put fire

if(isset($_POST['inspectbtn'])){
	$propnumber =$_POST['inspectbtn'];

	header( 'Location: agentdetail.php' ) ;
			return;
}



// customer feedback

if(isset($_POST['feedbacksubmit'])){

	
	$customer_id = $_POST['customer_id'];
	$property_number = $_POST['property_number'];
	$uploadedfeatures = $_POST['building'];
	$agentaskmoney = $_POST['agentmoney'];
	$agentpolite =$_POST['agentpolite'];
	$expectation = $_POST['apartmentexpectation'];
	$remark = $_POST['remark'];


	$to      = 'staff@oramexpropt.com';
							$subject = 'Customer Inspection Feedback';
							$message = 'A customer has given feedback from his/her recent inspection: <br>

							Customer ID = '.$customer_id.'; 
							Property Number = '.$property_number.';

							Does this building have all the features as listed online? = '.$uploadedfeatures.';

							Did the agent ask for money? = '.$agentaskmoney.';
							Was the agent polite in his/her relationship with you? = '.$agentpolite.';
							Did this apartment meet up with your expectation? = '.$expectation.';
							Remark = '.$remark.';
							';
							$headers = 'From: admin@oramexpropt.com' . "\r\n" .
								'Reply-To: oramexproperty@gmail.com, admin@oramexpropt.com' . "\r\n" .
								'X-Mailer: PHP/' . phpversion();
							
							mail($to, $subject, $message, $headers);
							
	
	

		
			
		$_SESSION['success'] = 'Thanks for your feedback';
		sleep(3);
		header('Location: customerrulespdf.php');

		return;
}


//agent delete his apartment
if(isset($_POST['agentdeleteapartment'])) {
 	
	$apartnum =	$_POST['agentdeleteapartment'];



	$sql = "DELETE  FROM property  WHERE Property_number = :apartnum";
		$stmt = $pdo->prepare($sql);
	$stmt->execute(array(':apartnum' => $apartnum));

 
	
	$_SESSION['success'] = 'Apartment Completed';
	header( 'Location: agent_schedule.php' ) ;
	return;
	
  
}



if(isset($_POST['jobapplication'])){
					$Surname = $_POST['surname'];
					$Othernames = $_POST['othernames'];
					$phonenumber = $_POST['phonenumber'];
					$whatsappnumber = $_POST['whatsappnumber'];
					$email = $_POST['email'];
					$address = $_POST['address'];
					$stateofresidence = $_POST['stateofresidence'];
					$stateoforigin = $_POST['stateoforigin'];
					$levelofeducation = $_POST['levelofeducation'];
					$positionapplied = $_POST['positionapplied'];




					$to      = $_POST['email'];
		$subject = 'Application recieved';
		$message = 'Thank you for showing interest to work us. We will get back to you soon through your email. Keep an eye on your email.
		
		Disclaimer: 
			Oramex Property agency and management will never ask for sensitive informations from our customers or works for any reason.
			Oramex Property agency and management will always communicate to your through our offical email admin@oramexpropt.com, official phone number
			and whatsapp number if need be 09157387503
			
			signed:
			Ugbede Micheal,
		 Admin, Oramex Property agency and management
		 1 University Market road, Nsukka, Enugu State.
		';
		$headers = 'From: admin@oramexpropt.com' . "\r\n" .
			'Reply-To: oramexproperty@gmail.com, admin@oramexpropt.com' . "\r\n" .
			'X-Mailer: PHP/' . phpversion();
		
		mail($to, $subject, $message, $headers);
		

					


					$to      = 'oramexpropt@gmail.com, admin@oramexpropt.com';
					$subject = 'Application recieved';
					$message = 'Surname: '.$Surname.'; Othernames: '.$Othernames.';  Phone Number: '.$phonenumber.'; 
					Whatsapp Number: '.$whatsappnumber.';  Email: '.$email.';  Address: '.$address.';  State of Resident: '.$stateofresidence.';  
					State of Origin: '.$stateoforigin.';  Level of Education: '.$levelofeducation.';  Position applied for: '.$positionapplied.';';
					$headers = 'From: admin@oramexpropt.com' . "\r\n" .
						'Reply-To: oramexproperty@gmail.com, admin@oramexpropt.com' . "\r\n" .
						'X-Mailer: PHP/' . phpversion();
					
					mail($to, $subject, $message, $headers);
					}


//APPLICATION FOR REFUND

if(isset($_POST['refund-submit-btn'])){
						$name = $_POST['name'];						
						$phonenumber = $_POST['phonenumber'];
						$email = $_POST['email'];
						$banknmae = $_POST['bankname'];
						$accountnumber = $_POST['accountnumber'];
						
	
	
	
	
						$to      = $_POST['email'];
			$subject = 'Application for refund';
			$message = 'We have recieved an application from you for refund. If this is wrong, please send and email to admin@oramexpropt.com. 
			If you initiated this process, Have in mind that process refund will take 3 - 5 working days. We will be communicating to you via this email '.$email.'.
			
			
			In case of any complain, do not hesitate to communicate to us through any of the channel of communication available on our website.
			
			Disclaimer: 
			Oramex Property agency and management will never ask for sensitive informations from our customers or works for any reason.
			Oramex Property agency and management will always communicate to your through our offical email admin@oramexpropt.com, official phone number
			and whatsapp number if need be 09157387503
			
			signed:
			Ugbede Micheal,
		 Admin, Oramex Property agency and management
		 1 University Market road, Nsukka, Enugu State. 
			';
			$headers = 'From: admin@oramexpropt.com' . "\r\n" .
				'Reply-To: oramexproperty@gmail.com, admin@oramexpropt.com' . "\r\n" .
				'X-Mailer: PHP/' . phpversion();
			
			mail($to, $subject, $message, $headers);
			
	
						
	
	
						$to      = 'oramexpropt@gmail.com, admin@oramexpropt.com';
						$subject = 'Application for refund';
						$message = 'A customer with the following details have applied for fund
						Name: '.$name.'; Phone Number: '.$phonenumber.';   Email: '.$email.';  Bank Name: '.$banknmae.'; Account number: '.$accountnumber.';';
						$headers = 'From: admin@oramexpropt.com' . "\r\n" .
							'Reply-To: oramexproperty@gmail.com, admin@oramexpropt.com' . "\r\n" .
							'X-Mailer: PHP/' . phpversion();
						
						mail($to, $subject, $message, $headers);
						}



//CONTACT US FORM SUBMITED



if(isset($_POST['contact-us-form-btn'])){
							$name = $_POST['name'];						
							$phonenumber = $_POST['phonenumber'];
							$email = $_POST['email'];
							$messagepost = $_POST['message'];
							
							
		
		
		
		
							$to      = $_POST['email'];
				$subject = 'Contact Us';
				$message = 'Thank you for contacting us. We will get back to you as soon as possible via this email '.$email.'.
				
				
				In case of any complain, do not hesitate to communicate to us through any of the channel of communication available on our website.
				
				Disclaimer: 
				Oramex Property agency and management will never ask for sensitive informations from our customers or works for any reason.
				Oramex Property agency and management will always communicate to your through our offical email admin@oramexpropt.com, official phone number
				and whatsapp number if need be 09157387503
				
				signed:
				Ugbede Micheal,
			 Admin, Oramex Property agency and management
			 1 University Market road, Nsukka, Enugu State. 
				';
				$headers = 'From: admin@oramexpropt.com' . "\r\n" .
					'Reply-To: oramexproperty@gmail.com, admin@oramexpropt.com' . "\r\n" .
					'X-Mailer: PHP/' . phpversion();
				
				mail($to, $subject, $message, $headers);
				
		
							
		
		
							$to      = 'oramexpropt@gmail.com, staff@oramexpropt.com';
							$subject = 'Contact us';
							$message = 'A customer has contacted us through contact us form with the following message and details
							Name: '.$name.'; Phone Number: '.$phonenumber.';   Email: '.$email.';  Message: '.$messagepost.';';
							$headers = 'From: admin@oramexpropt.com' . "\r\n" .
								'Reply-To: oramexproperty@gmail.com, admin@oramexpropt.com' . "\r\n" .
								'X-Mailer: PHP/' . phpversion();
							
							mail($to, $subject, $message, $headers);
							}
	
	


					

					?>