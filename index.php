<?php
require_once 'backend/authController.php';






?>


<!DOCTYPE html>
<html lang="en">
<head>
	<title>Oramex Homes</title>
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


<!-- <script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '1065488314337729',
      xfbml      : true,
      version    : 'v14.0'
    });
    FB.AppEvents.logPageView();
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script> -->

	
	
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


</nav>

<section>
	<div class="advert"> Advertisment here

  <!-- <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a> -->
  </div>
	<div class="advert">Advertisment

  <!-- <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>-->
  </div> 

  <div class="container">
    <div class="row">
	<div class="col">
<h2> Available flats/apartments</h2>
    </div>
    </div>

    <div class="row">
<div id="duplex" class="col-md-6 col-sm-12">
	<h3>DUPLEX</h3>
</div>
    </div>
	
<div class="row">

	<?php
	$sql = "SELECT Sitting_room, Property_number, Rent, Area, State, buildingtype FROM property WHERE buildingtype = 'duplex'";
			$stmt = $pdo->prepare($sql);
			$stmt->execute(array( 
			
	
			 )); 

			  //if($row > 0)
			//{

    while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {

   //$oneroomapartment = $row;
	
   ?>
   <!-- <div  style="border:1px solid #333; background-color:#f1f1f1; border-radius:10px; padding:5px; display: inline-block; width: 15em; height: 18em;" align="center">  -->
   <div class="col-md-3 col-sm-6">
	<div class="card" id ="sittingroom"  stlye= "border: 2px; width: 16rem;" >

   <a href = "<?php echo('apartmentcompletedetails.php?Property_number='.$row['Property_number'].'');?>">
	 <img class='card-img-top' stlye= " width: 18rem;"
	<?php
		
		$imagesDirectory = "duplex/";
		$detg =  $row['Property_number'].'sittingroom';
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
       
      $nameimg = $row['buildingtype'];
  
      

    if(($imgFileType=='jpg' || $imgFileType=='png') && strpos($image, $detg)!==false ){
      echo "<img src='$imagesDirectory".$image."'    class='card-img-top ' alt='image of '.$nameimg.' sittingroom' />" ;
		} 
      }
     closedir($opendirectory);
    };
  
?>
/>

<div class="card-body" >
<!-- style=" background-color:#f1f1f1; border-radius:10px; padding:5px; display: inline-block; width: 15em; height: 4em;" > -->
<p class="card-text">Rent: <?php echo $row['Rent']; ?></p>
<p class = "card-text" style="text-align: left; display: inline-block;">State: <?php echo $row['State']; ?></p> <p class="card-text"  style=" display: inline-block;">Area: <?php echo $row['Area']; ?></p>
</div>
</div>
</a>
</div>
<?php
}; ?> 


    
</div>


    

    <div class="row">
<div id="fourbedroomflat" class="col-md-6 col-sm-12">
	<h3>4 BEDEROOM FLAT</h3>
</div></div>
	
	<div class="row"  stlye= "border: 2px" >
	<?php
	$sql = "SELECT Sitting_room, Property_number, Rent, Area, State, buildingtype FROM property WHERE buildingtype = 'fourbedroom'";
			$stmt = $pdo->prepare($sql);
			$stmt->execute(array( 
			
	
			 )); 

			  //if($row > 0)
			//{

    while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {

   //$oneroomapartment = $row;
	
   ?>
     <div class="col-md-3 col-sm-6">
	<div class="card" id ="sittingroom"  stlye= "border: 2px; width: 16rem;" >
    <a href = "<?php echo('apartmentcompletedetails.php?Property_number='.$row['Property_number'].'');?>">
	<img class='card-img-top' stlye= " width: 18rem;"
	<?php

		
		$imagesDirectory = "4bedroomflat/";
		$detg =  $row['Property_number'].'sittingroom';
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
      
  
      $nameimg = $row['buildingtype'];
  
      

      if(($imgFileType=='jpg' || $imgFileType=='png') && strpos($image, $detg)!==false ){
        echo "<img src='$imagesDirectory".$image."'    class='card-img-top ' alt='image of '.$nameimg.' sittingroom' />" ;
      } 
		 
      }
     closedir($opendirectory);
    };
  
?> 
/>
<div class="card-body" >
<!-- style=" background-color:#f1f1f1; border-radius:10px; padding:5px; display: inline-block; width: 15em; height: 4em;" > -->
<p class="card-text">Rent: <?php echo $row['Rent']; ?></p>
<p class = "card-text" style="text-align: left; display: inline-block;">State: <?php echo $row['State']; ?></p> <p class="card-text"  style=" display: inline-block;">Area: <?php echo $row['Area']; ?></p>
</div>
</div>
</a>
</div>
<?php
}; ?>  
	</div>
		


  <div class="row">
<div id="3bedroomflat" class="col-md-6 col-sm-12">

	<h3> 3 BEDROOM FLATS </h3>	
</div></div>

	<div class="row" stlye= "border: 2px">
	
	<?php
	$sql = "SELECT Sitting_room, Property_number, Rent, Area, State, buildingtype FROM property WHERE buildingtype = 'threebedroom'";
			$stmt = $pdo->prepare($sql);
			$stmt->execute(array( 
			
	
			 )); 

			  //if($row > 0)
			//{

    while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {

   //$oneroomapartment = $row;
	
   ?>
  <div class="col-md-3 col-sm-6">
	<div class="card" id ="sittingroom"  stlye= "border: 2px; width: 16rem;" >

   <a href = "<?php echo('apartmentcompletedetails.php?Property_number='.$row['Property_number'].'');?>">
	 <img class='card-img-top' stlye= " width: 18rem;"
	<?php

		
		$imagesDirectory = "3bedroomflat/";
		$detg =  $row['Property_number'].'sittingroom';
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
      
    
      $nameimg = $row['buildingtype'];
  
      

      if(($imgFileType=='jpg' || $imgFileType=='png') && strpos($image, $detg)!==false ){
        echo "<img src='$imagesDirectory".$image."'    class='card-img-top ' alt='image of '.$nameimg.' sittingroom' />" ;
      } 
		 
      }
     closedir($opendirectory);
    };
  
?> 
/>
<div class="card-body" >
<!-- style=" background-color:#f1f1f1; border-radius:10px; padding:5px; display: inline-block; width: 15em; height: 4em;" > -->
<p class="card-text">Rent: <?php echo $row['Rent']; ?></p>
<p class = "card-text" style="text-align: left; display: inline-block;">State: <?php echo $row['State']; ?></p> <p class="card-text"  style=" display: inline-block;">Area: <?php echo $row['Area']; ?></p>
</div>
</div>
</a>
</div>
<?php
}; ?>  
	</div>

  <div class="row">
<div id="2bedroomflat" class="col-md-6 col-sm-12">
	<h3>2 BEDROOM FLATS</h3>
</div></div>
	
	<div class="row" stlye= "border: 2px" >
		
	<?php
	$sql = "SELECT Sitting_room, Property_number, Rent, Area, State, buildingtype FROM property WHERE buildingtype = 'twobedroom'";
			$stmt = $pdo->prepare($sql);
			$stmt->execute(array( 
			
	
			 )); 

			  //if($row > 0)
			//{

    while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {

   //$oneroomapartment = $row;
	
   ?>
    <div class="col-md-3 col-sm-6">
	<div class="card" id ="sittingroom"  stlye= "border: 2px; width: 16rem;" >

   <a href = "<?php echo('apartmentcompletedetails.php?Property_number='.$row['Property_number'].'');?>">
	 <img class='card-img-top' stlye= " width: 18rem;"
	<?php

		
		$imagesDirectory = "2bedroomflat/";
		$detg =  $row['Property_number'].'sittingroom';
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
      
    
      $nameimg = $row['buildingtype'];
  
      

      if(($imgFileType=='jpg' || $imgFileType=='png') && strpos($image, $detg)!==false ){
        echo "<img src='$imagesDirectory".$image."'    class='card-img-top ' alt='image of '.$nameimg.' sittingroom' />" ;
      } 
		 
      }
     closedir($opendirectory);
    };
  
?> 
/>
<div class="card-body" >
<!-- style=" background-color:#f1f1f1; border-radius:10px; padding:5px; display: inline-block; width: 15em; height: 4em;" > -->
<p class="card-text">Rent: <?php echo $row['Rent']; ?></p>
<p class = "card-text" style="text-align: left; display: inline-block;">State: <?php echo $row['State']; ?></p> <p class="card-text"  style=" display: inline-block;">Area: <?php echo $row['Area']; ?></p>
</div>
</div>
</a>
</div>
<?php
}; ?>  
	</div>



  <div class="row">
<div id="1bedroomflat" class="col-md-6 col-sm-12">
	<h3>1 BEDROOM FLATS</h3>
</div></div>
	
	<div class="row" stlye= "border: 2px">
	
	<?php
	$sql = "SELECT Sitting_room, Property_number, Rent, Area, State, buildingtype FROM property WHERE buildingtype = 'onebedroom'";
			$stmt = $pdo->prepare($sql);
			$stmt->execute(array( 
			
	
			 )); 

			  

    while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {

   
	
   ?>
 <div class="col-md-3 col-sm-6">
	<div class="card" id ="sittingroom"  stlye= "border: 2px; width: 16rem;" >

   <a href = "<?php echo('apartmentcompletedetails.php?Property_number='.$row['Property_number'].'');?>">
	 <img class='card-img-top' stlye= " width: 18rem;"
	<?php

		
		$imagesDirectory = "1bedrooflat/";
		$detg =  $row['Property_number'].'sittingroom';
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
      
  
        
      $nameimg = $row['buildingtype'];
  
      

      if(($imgFileType=='jpg' || $imgFileType=='png') && strpos($image, $detg)!==false ){
        echo "<img src='$imagesDirectory".$image."'    class='card-img-top ' alt='image of '.$nameimg.' sittingroom' />" ;
      } 
		 
      }
     closedir($opendirectory);
    };
  
?> 
/>
<div class="card-body" >
<!-- style=" background-color:#f1f1f1; border-radius:10px; padding:5px; display: inline-block; width: 15em; height: 4em;" > -->
<p class="card-text">Rent: <?php echo $row['Rent']; ?></p>
<p class = "card-text" style="text-align: left; display: inline-block;">State: <?php echo $row['State']; ?></p> <p class="card-text"  style=" display: inline-block;">Area: <?php echo $row['Area']; ?></p>
</div>
</div>
</a>
</div>
<?php
}; ?>  
	</div>


  <div class="row">
<div id="singlerooms" class="col-md-6 col-sm-12">
	<h3>SELFCON</h3>
</div></div>
	
	<div class="row" id ="selfconsittingroom"  stlye= "border: 2px" >
	<?php
	$sql = "SELECT Sitting_room, Property_number, Rent, Area, State, buildingtype FROM property WHERE buildingtype = 'selfcon'";
			$stmt = $pdo->prepare($sql);
			$stmt->execute(array( 
			
	
			 )); 

			  

    while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {


	
   ?>
   <div class="col-md-3 col-sm-6">
	<div class="card" id ="sittingroom"  stlye= "border: 2px; width: 16rem;" >

   <a href = "<?php echo('apartmentcompletedetails.php?Property_number='.$row['Property_number'].'');?>">
	 <img class='card-img-top' stlye= " width: 18rem;"
	<?php

		
		$imagesDirectory = "selfcon/";
		$detg =  $row['Property_number'].'sittingroom';
  	

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
      
    
      $nameimg = $row['buildingtype'];
  
      

      if(($imgFileType=='jpg' || $imgFileType=='png') && strpos($image, $detg)!==false ){
        echo "<img src='$imagesDirectory".$image."'    class='card-img-top ' alt='image of '.$nameimg.' sittingroom' />" ;
      } 
		 
      }
     closedir($opendirectory);
    };
  
?> 
/>
<div class="card-body" >
<!-- style=" background-color:#f1f1f1; border-radius:10px; padding:5px; display: inline-block; width: 15em; height: 4em;" > -->
<p class="card-text">Rent: <?php echo $row['Rent']; ?></p>
<p class = "card-text" style="text-align: left; display: inline-block;">State: <?php echo $row['State']; ?></p> <p class="card-text"  style=" display: inline-block;">Area: <?php echo $row['Area']; ?></p>
</div>
</div>
</a>
</div>
<?php
}; ?>  
	</div>

</div>

  <div class="row">
<div id="singlerooms" class="col-md-6 col-sm-12">
	<h3>SINGLE ROOMS</h3>
</div></div>
	
	<div class="row" id ="singlesittingroom"  stlye= "border: 2px" >
	<?php
	$sql = "SELECT Sitting_room, Property_number, Rent, Area, State, buildingtype FROM property WHERE buildingtype = 'singlerooms'";
			$stmt = $pdo->prepare($sql);
			$stmt->execute(array( 
			
	
			 )); 

			  

    while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {


	
   ?>
   <div class="col-md-3 col-sm-6">
	<div class="card" id ="sittingroom"  stlye= "border: 2px; width: 16rem;" >

   <a href = "<?php echo('apartmentcompletedetails.php?Property_number='.$row['Property_number'].'');?>">
	 <img class='card-img-top' stlye= " width: 18rem;"
	<?php

		
		$imagesDirectory = "singlerooms/";
		$detg =  $row['Property_number'].'sittingroom';
  	

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
      
    
      $nameimg = $row['buildingtype'];
  
      

      if(($imgFileType=='jpg' || $imgFileType=='png') && strpos($image, $detg)!==false ){
        echo "<img src='$imagesDirectory".$image."'    class='card-img-top ' alt='image of '.$nameimg.' sittingroom' />" ;
      } 
		 
      }
     closedir($opendirectory);
    };
  
?> 
/>
<div class="card-body" >
<!-- style=" background-color:#f1f1f1; border-radius:10px; padding:5px; display: inline-block; width: 15em; height: 4em;" > -->
<p class="card-text">Rent: <?php echo $row['Rent']; ?></p>
<p class = "card-text" style="text-align: left; display: inline-block;">State: <?php echo $row['State']; ?></p> <p class="card-text"  style=" display: inline-block;">Area: <?php echo $row['Area']; ?></p>
</div>
</div>
</a>
</div>
<?php
}; ?>  
	</div>

</div>

</section>
<footer>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>

   
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
    <li class="nav-item active">
        <a class="nav-link"  href="index.php"> Home </a>
      </li>
      <li class="nav-item">
        <a class="nav-link"href="About.php">About</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="Register.php">Upload apartment</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="contact.php">Contact</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="vacancy.php">Work with us</a>
      </li><li class="nav-item">
        <a class="nav-link" href="Help.php">Help</a>
      </li>
  
      
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>

</footer>
<!-- <script>
	console.log('hello');
	window.addEventListener('DOMContentLoaded', (event) => {
    console.log('DOM fully loaded and parsed');
let tag = document.createElement("p");
	tag.style.color = "red";
   let text = document.createTextNode("We are learning");
   tag.appendChild(text);
   let element = document.getElementById("duplexsittingroom");
   element.appendChild(tag);
});

</script> -->



<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>


<script type="text/javascript">
// Do this *after* the table tag is rendered


$(document).ready(function() {

// $("#agentveribtn1" ).click(function() {
//     $("#agentsverification").toggle()
// });


// $( "#apartmentrentb" ).click(function() {
//     $("#apartmentrent").toggle()
// });

// $( "#agentdetails" ).click(function() {
//     $("#agentdetailsdiv").toggle()
// });


// $( "#ntb" ).click(function() {
//     $("#rent").toggle()
// });

// $("<img/>", {
//                 id: "div-id",
//                 class: "thumb",
// 				src="",
//                 alt ="duplex apartment"
//             }).appendTo("#duplexsittingroom");




});

</script>








</body>
</html>