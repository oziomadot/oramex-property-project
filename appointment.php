<?php require_once 'backend/authController.php';

$_SESSION['agentid'] = '1D1BPA7';






?>

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
		<link href="https://fonts.googleapis.com/css2?family=Alfa+Slab+One&family=Open+Sans:wght@300&display=swap" rel="stylesheet">
		<!-- <link rel="stylesheet" href="style.css"> -->
	</head>

	<body>
    
			
	
	
	
	
	
	
	
	
	<div class="container mt-3">
            <h4>Days and Time available for inspection</h4>
		<p>Please, select days and dates you are sure you will be available for inspection. Bear in mind that not keeping to these selected appointment will make our client unhappy.</p>

        <form action="appointment.php" method="post">           
		<section style="display:inline-block"> 
            <h5>Days</h5>
        
        <label for="Monday">Monday</label>
		<input type="checkbox" id="Monday" name="monday" value='A'>

        <label for="Tuesday">Tuesday</label>
		<input type="checkbox" id="Tuesday" name="tuesday" value='A'>

        <label for="Wednesday">Wednesday</label>
		<input type="checkbox" id="Wednesday" name="wednesday" value='A'>

        <label for="Thursday">Thursday</label>
		<input type="checkbox" id="Thursday" name="thursday" value='A'>

        <label for="Friday">Friday</label>
		<input type="checkbox" id="friday" name="friday" value='A'>

        <label for="Saturday">Saturday</label>
		<input type="checkbox" id="Saturday" name="saturday" value='A'>

        <label for="Sunday">Sunday</label>
		<input type="checkbox" id="Sunday" name="sunday" value='A'>
        </setion>

        <section style="display:inline-block"> 
            <h5>Time</h5>
              
            <label for="8am-9am">8am-9am</label>
			<input type="checkbox" id="8am-9am" name="8am-9am" value='A'><br>
            
            <label for="9am-10am">9am-10am</label>
			<input type="checkbox" id="9am-10am" name="9am-10am" value='A'>
                  
            <label for="10am-11am">10am-11am</label>
			<input type="checkbox" id="10am-11am" name="10am-11am" value='A'>
                   
            <!-- <label for="11am-12noon">11am-12noon</label>
			<input type="checkbox" id="11am-12noon" name="11am-12noon" value='A'>
                   
            <label for="12noon-1pm">12noon-1pm</label>
			<input type="checkbox" id="12noon-1pm" name="12noon-1pm" value='A'>
                   
            <label for="1pm-2pm">1pm-2pm</label>
			<input type="checkbox" id="1pm-2pm" name="1pm-2pm" value='A'>
                  
            <label for="2pm-3pm">2pm-3pm</label>
			<input type="checkbox" id="2pm-3pm" name="2pm-3pm" value='A'>

            <label for="3pm-4pm">3pm-4pm</label>
			<input type="checkbox" id="3pm-4pm" name="3pm-4pm" value='A'>
                        
            <label for="4pm-5pm">4pm-5pm</label>
			<input type="checkbox" id="4pm-5pm" name="4pm-5pm" value='A'>
         
            <label for="5pm-6pm">5pm-6pm</label>
			<input type="checkbox" id="5pm-6pm" name="5pm-6pm" value='A'> -->
            </section>
        			
<section>
			<label for="Meeting">Meeting Place </label>
			<input type="text" id="meeting" name="meeting"><br>
			<p><strong>NB: </strong>Please, always give an address of a popular place, known by many people, and easy to find. This will make it easy for our client to get to you and also boast their confidence and trust that they are safe</p>
</section>

            </div>
            <!-- <h6><label for="declaration">Appointment</label></h6>
<p><input type="checkbox" id="declaration" name="appointmentdeclaration" required>I declare that I will be avialable of these days and times selected about. I will take responsibility of any outcome resulting from me not keeping to appointment with my client. </p>
	<br> -->

	<input type="submit"  name= "appointment" class="btn btn-primary btn-block btn-lg"></input>	
    </form>
            </body>
</html>