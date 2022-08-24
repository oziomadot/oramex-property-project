<?php 
require_once 'backend/authController.php';
        //require_once 'backend/getjson.php';

if(($_SESSION['type'] != "Admin")) {
	header('location: about.php');
	die();
}


?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>ADMIN PAGE</title>
		<meta charset ="UTF-8">
		<meta name="keywords" content="rent, flats, rooms,apartments,house">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
		<meta name="author" content="Ezeomeke Ozioma">
		<meta name="description" content="rent a home at your finger tip">
		<meta name="viewport" content="width=device-width,initial-scale=1.0">
		<link rel="icon" type="image/x-icon" href="favicon.ico">
		<link rel="stylesheet" href="style.css">
		<script type="text/javascript" src="js/myScript.js"></script>
		
	</head>

	<body>

	<?php
if ( isset($_SESSION['error'])) {
    echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
    unset($_SESSION['error']);
}
if ( isset($_SESSION['success'])  ) {
    echo '<p style="color:green">'.$_SESSION['success']."</p>\n";
    unset($_SESSION['success']);
}

?>

<div>
  <?php

//staff table for salary
echo('<table border="1.2" class="table table-striped" >'."\n");


$sql = "SELECT Staff_id, Surname, First_name, email, Work_Phonenumber, Phone_number, designation, Salary, Account_number, Bank_name
   FROM staff";
     $stmt = $pdo->prepare($sql);

   $stmt->execute(array( ));
   $rows = array();
   






    echo"<tr class= 'table-success' border='1'><th>";
    echo("STAFF ID");
    echo("</th><th>");
    echo("SURNAME");
    echo("</th><th>");
    echo("FIRST NAME");
    echo("</th><th>");
    echo("EMAIL");
    echo("</th><th>");
    echo("WORK PHONE");
    echo("</th><th>");
    echo("HOME PHONE");
    echo("</th><th>");
    echo("DESIGNATION");
    echo("</th><th>");
    echo("SALARY");
    echo("</th><th>");
    echo("ACCOUNT NO");
    echo("</th><th>");
    echo("BANK NAME");
    echo("</th></tr>\n");


    while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
      
   $staffsalary = $row;
    //data 
    echo "<tr class= 'bg-info' border='1'><td>";
    echo(htmlentities($staffsalary['Staff_id']));
    echo("</td><td>");
    echo(htmlentities($staffsalary['Surname']));
    echo("</td><td>");
    echo(htmlentities($staffsalary['First_name']));
    echo("</td><td>");
    echo(htmlentities($staffsalary['email']));
    echo("</td><td>");
    echo(htmlentities($staffsalary['Work_Phonenumber']));
    echo("</td><td>");
    echo(htmlentities($staffsalary['Phone_number']));
    echo("</td><td>");
    echo(htmlentities($staffsalary['designation']));
   echo("</td><td>");
   echo(htmlentities($staffsalary['Salary']));
   echo("</td><td>");
   echo(htmlentities($staffsalary['Account_number']));
   echo("</td><td>");
   echo(htmlentities($staffsalary['Bank_name']));
   echo("</td></tr>\n");
}

if($row == 0){
  echo "<tr class= 'bg-white' border='1'><td>";
  echo('NO ENTRY FOUND');
  echo("</td></tr>\n");
}

  ?>
</div>
<div>
  <?php 

//to pay for rented property

echo('<table border="1.2" class="table table-striped" >'."\n");


$stmt = $pdo->query("SELECT  property.Property_number, property.buildingtype, property.Address, property.agent_id, property.Rent, property.Agent_fee, property.Barr, property.Caution_fee, property.Security_fee, property.Compound_cleaning,	
	 agent.agent_id, agent.Surname, agent.First_name, agent.Email, agent.Phone_number, agent.Refeeral_id
   FROM property 
   LEFT JOIN  agent ON property.agent_id = agent.agent_id
   WHERE property.rented = '1' ");
   
   $rows = array();
   
    echo"<tr class= 'bg-warning' border='1'><th>";
    echo("PROPERTY NUMBER");
    echo("</th><th>");
    echo("BUILDING TYPE");
    echo("</th><th>");
    echo("ADDRESS");
    echo("</th><th>");
    echo("AGENT ID");
    echo("</th><th>");
    echo("RENT PRICE");
    echo("</th><th>");
    echo("AGENT FEE");
    echo("</th><th>");
    echo("LEGAL FEE");
    echo("</th><th>");
    echo("CAUTION FEE");
    echo("</th><th>");
    echo("SECURITY FEE");
    echo("</th><th>");
    echo("COMPOUND CLEANING LEVY");
    echo("</th><th>");
    echo("PAY TO AGENT");
    echo("</th><th>");
    echo("PAY TO PARENT AGENT");
    echo("</th><th>");
    echo("PAY TO LANDLORD");
    echo("</th><th>");
    echo("AGENT SURNAME");
    echo("</th><th>");
    echo("AGENT FIRST NAME");
    echo("</th><th>");
    echo("AGENT EMAIL");
    echo("</th><th>");
    echo("AGENT PHONE NUMBER");
    echo("</th><th>");
    echo("AGENT DETAILS");
    echo("</th><th>");
    echo("PARENT AGENT DETAILS");
    echo("</th></tr>\n");


    while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
    
   $propertyagent = $row;
   
   
   
   $agentdes = htmlentities($propertyagent['agent_id']);
   $parentagentdes = htmlentities($propertyagent['Refeeral_id']);
   $agfee = htmlentities($row['Agent_fee']);
   $comppercentvalue = 30/100;
   $refpercentvalue = 16/100;
   $comppercent = $agfee * $comppercentvalue;
   $refpercent  =  $comppercent * $refpercentvalue;
   
    //data 
    echo "<tr class= 'table-light' border='1'><td>";
    echo(htmlentities($propertyagent['Property_number']));
    echo("</td><td>");
    echo(htmlentities($propertyagent['buildingtype']));
    echo("</td><td>");
    echo(htmlentities($propertyagent['Address']));
    echo("</td><td>");
    echo(htmlentities($propertyagent['agent_id']));
    echo("</td><td>");
    echo(htmlentities($propertyagent['Rent']));
    echo("</td><td>");
    echo(htmlentities($propertyagent['Agent_fee']));
    echo("</td><td>");
    echo(htmlentities($propertyagent['Barr']));
    echo("</td><td>");
    echo(htmlentities($propertyagent['Caution_fee']));
    echo("</td><td>");
    echo(htmlentities($propertyagent['Security_fee']));
    echo("</td><td>");
    echo(htmlentities($propertyagent['Compound_cleaning']));
    echo("</td><td>");
    echo($comppercent);
    echo("</td><td>");
    echo($refpercent);
    echo("</td><td>");
    echo((htmlentities($propertyagent['Rent']))+(htmlentities($propertyagent['Barr']))+(htmlentities($propertyagent['Caution_fee']))+(htmlentities($propertyagent['Security_fee']))+(htmlentities($propertyagent['Compound_cleaning'])));
        echo("</td><td>");
    echo(htmlentities($propertyagent['Surname']));
    echo("</td><td>");
    echo(htmlentities($propertyagent['First_name']));
    echo("</td><td>");
    echo(htmlentities($propertyagent['Email']));
    echo("</td><td>");
    echo(htmlentities($propertyagent['Phone_number']));
     echo("</td><td>");
    echo('<form action="Admin.php" method="post"> <button type = "submit" id="agentdetails" name ="agentdetails"
    value = '.$agentdes.'> DISPLAY </button> </form>');
    echo("</td><td>");
    echo('<form action="Admin.php" method="post"> <button type = "submit" id="agentdetails" name ="parentagentdetails"
    value = '.$parentagentdes.'> DISPLAY </button> </form>');    
    echo("</td></tr>\n");
}
if($row == 0){
  echo "<tr class= 'bg-white' border='1'><td>";
  echo('NO ENTRY FOUND');
  echo("</td></tr>\n");
}


?>
</div>

</table>


<div>
  <?php 

//FOR AGENT ACCOUNT DETAILS
if(isset($_POST['agentdetails'])) {

$agentiddetails = $_POST['agentdetails'];
  


echo('<table border="1.2" class="table table-striped" >'."\n");


$sql = "SELECT  agent_id, Bank_name, Account_number, verified
   FROM verfied_agent 
   WHERE agent_id = :agentid ";
     $stmt = $pdo->prepare($sql);

   $stmt->execute(array( ':agentid' => $agentiddetails));
   $rows = array();
  




    echo"<tr class= 'table-info' border='1'><th>";
    echo("AGENT ID");
    echo("</th><th>");
    echo("BANK NAME");
    echo("</th><th>");
    echo("ACCOUNT NUMBER");
    echo("</th><th>");
    echo("VERIFIED");
    echo("</th></tr>\n");

    while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
      
   $agentbankdetails = $row;
   

    //data 
    echo "<tr class= 'bg-danger' border='1'><td>";
    echo(htmlentities($agentbankdetails['agent_id']));
    echo("</td><td>");
    echo(htmlentities($agentbankdetails['Bank_name']));
    echo("</td><td>");
    echo(htmlentities($agentbankdetails['Account_number']));
    echo("</td><td>");
    echo(htmlentities($agentbankdetails['verified']));
    


  
   echo("</td></tr>\n");
}
if($row == 0){
  echo "<tr class= 'bg-white' border='1'><td>";
  echo('NO ENTRY FOUND');
  echo("</td></tr>\n");
}
}


?>
</div>

</table>

<div>
  <?php 

//FOR PARENT AGENT ACCOUNT DETAILS 

if(isset($_POST['parentagentdetails'])) {

  
  $parentagentdetails = $_POST['parentagentdetails'];
    
  echo('<table border="1.2" class="table table-striped" >'."\n");
  
  
  $sql = "SELECT  agent_id, Bank_name, Account_number, verified FROM verfied_agent WHERE agent_id = :agentid ";
  $stmt = $pdo->prepare($sql);
   $stmt->execute(array( ':agentid' => $parentagentdetails));
 

  $rows = array();
   
  
  
  
  
  
      echo"<tr class= 'table-info' border='1'><th>";
      echo("AGENT ID");
      echo("</th><th>");
      echo("BANK NAME");
      echo("</th><th>");
      echo("ACCOUNT NUMBER");
      echo("</th><th>");
      echo("VERIFIED");
      echo("</th></tr>\n");
  
  
      while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
      
        $parentagentbankdetails = $row;
        
      //data 
      echo "<tr class= 'bg-primary' border='1'><td>";
      echo(htmlentities($parentagentbankdetails['agent_id']));
      echo("</td><td>");
      echo(htmlentities($parentagentbankdetails['Bank_name']));
      echo("</td><td>");
      echo(htmlentities($parentagentbankdetails['Account_number']));
      echo("</td><td>");
      echo(htmlentities($parentagentbankdetails['verified']));
      

     
    
     echo("</td></tr>\n");
  } 
  if($row == 0){
    echo "<tr class= 'bg-white' border='1'><td>";
    echo('NO ENTRY FOUND');
    echo("</td></tr>\n");
  }
  }


?>
</div>

</table>



<div class="container">
  <div class="row">
    <div class="col-6 col-md-4">
    <div  class="form-group" >
	

					<form action="Admin.php" method="post"  enctype="multipart/form-data">
          <fieldset>
  <legend>Property details for query</legend>
						<label for="propertynumber">Property Number</label>
						<input type="text" id="propertynumber" name= "pronumber"  required class="form-control" >

						<button type="submit" name="propertynumber" class="btn btn-primary btn-block btn-lg">SUBMIT</button>
						<input type="reset" value="Reset"> 
					
					</form>
          
          
          <form action="Admin.php" method="post"  enctype="multipart/form-data">
						<label for="agentid">Agent ID</label>
						<input type="text" id="agentid" name="disableagent"  required class="form-control" >

						
						<button type="submit" name="disableagentid" class="btn btn-primary btn-block btn-lg">SUBMIT</button>
						<input type="reset" value="Reset"> 
						
</fieldset>
					</form>
				</div>
    </div>
  </div>
</div>




<div>

<?php 

//FOR APARTMENT COMPLETE INFORMATION

if (isset($_POST['propertynumber'])) {


  
  $partails = $_POST['pronumber'];
    
echo('<table border="1.2" class="table table-striped" >'."\n");
  
  
//   $sql = "SELECT  agent_id, Bank_name, Account_number, verified FROM verfied_agent WHERE agent_id = :agentid ";
//   $stmt = $pdo->prepare($sql);
//    $stmt->execute(array( ':agentid' => $parentagentdetails));
 

//   $rows = array();
   
  $sql = "SELECT * FROM property WHERE Property_number = :propertynumber";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array( 
    ':propertynumber' => $partails

     )); 
     $rows = array();
     

    

 
  
	 
  
      echo"<tr class= 'table-info' border='1'><th>";
      echo("PROPERTY NUMBER");
      echo("</th><th>");
      echo("FLOOR");
      echo("</th><th>");
      echo("BUILDING TYPE");
      echo("</th><th>");
      echo("ADDRESS");
      echo("</th><th>");
      echo("AGENT ID");
      echo("</th><th>");
      echo("RENT");
      echo("</th><th>");
      echo("AGENT FEE");
      echo("</th><th>");
      echo("LEGAL FEE");
      echo("</th><th>");
      echo("CAUTION FEE");
      echo("</th><th>");
      echo("SECURITY FEE");
      echo("</th><th>");
      echo("COMPOUND CLEANING FEE");
      echo("</th><th>");
      echo("SITTING ROOM");
      echo("</th><th>");
      echo("ROOM");
      echo("</th><th>");
      echo("DINNING");
      echo("</th><th>");
      echo("ELECTRICITY");
      echo("</th><th>");
      echo("METER TYPE");
      echo("</th><th>");
      echo("OVER HEAD TANK");
      echo("</th><th>");
      echo("WELL");
      echo("</th><th>");
      echo("FENCED");
      echo("</th><th>");
      echo("CAR PARKING SPACE");
      echo("</th><th>");
      echo("SECURITY");
      echo("</th><th>");
      echo("COMPOUND CLEANER");
      echo("</th><th>");
      echo("TOILET");
      echo("</th><th>");
      echo("SUITE");
      echo("</th><th>");
      echo("KITCHEN");
      echo("</th><th>");
      echo("KITCHEN-CABINET");
      echo("</th><th>");
      echo("WARDROPE");
      echo("</th><th>");
      echo("WARDROPE CABINET");
      echo("</th><th>");
      echo("BUILDING");
      echo("</th><th>");
      echo("FLAT TYPE");
      echo("</th></tr>\n");
  
  
      while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
      
        $parentagentban = $row; 

      
      
         
        
      //data 
      echo "<tr class= 'bg-warning' border='1'><td>";
      echo(htmlentities($parentagentban['Property_number']));
      echo("</td><td>");
      echo(htmlentities($parentagentban['floor']));
      echo("</td><td>");
      echo(htmlentities($parentagentban['buildingtype']));
      echo("</td><td>");
      echo(htmlentities($parentagentban['Address']));
      echo("</td><td>");
      echo(htmlentities($parentagentban['agent_id']));
      echo("</td><td>");
      echo(htmlentities($parentagentban['Rent']));
      echo("</td><td>");
      echo(htmlentities($parentagentban['Agent_fee']));
      echo("</td><td>");
      echo(htmlentities($parentagentban['Barr']));
      echo("</td><td>");
      echo(htmlentities($parentagentban['Caution_fee']));
      echo("</td><td>");
      echo(htmlentities($parentagentban['Security_fee']));
      echo("</td><td>");
      echo(htmlentities($parentagentban['Compound_cleaning']));
      echo("</td><td>");
      echo(htmlentities($parentagentban['Sitting_room']));
      echo("</td><td>");
      echo(htmlentities($parentagentban['room1']));
      echo("</td><td>");
      echo(htmlentities($parentagentban['Dinning']));
      echo("</td><td>");
      echo(htmlentities($parentagentban['electricity']));
      echo("</td><td>");
      echo(htmlentities($parentagentban['Meter']));
      echo("</td><td>");
      echo(htmlentities($parentagentban['overheadtank']));
      echo("</td><td>");
      echo(htmlentities($parentagentban['well']));
      echo("</td><td>");
      echo(htmlentities($parentagentban['fenced']));
      echo("</td><td>");
      echo(htmlentities($parentagentban['car_parkingspace']));
      echo("</td><td>");
      echo(htmlentities($parentagentban['security']));
      echo("</td><td>");
      echo(htmlentities($parentagentban['Compound_cleaner']));
      echo("</td><td>");
      echo(htmlentities($parentagentban['toilet']));
      echo("</td><td>");
      echo(htmlentities($parentagentban['suite']));
      echo("</td><td>");
      echo(htmlentities($parentagentban['kitchen']));
      echo("</td><td>");
      echo(htmlentities($parentagentban['kitchen_cabinet']));
      echo("</td><td>");
      echo(htmlentities($parentagentban['woodrope']));
      echo("</td><td>");
      echo(htmlentities($parentagentban['woodrope_cabinet']));
      echo("</td><td>");
      echo(htmlentities($parentagentban['building']));
      echo("</td><td>");
      echo(htmlentities($parentagentban['flat_type']));
      

     
    
     echo("</td></tr>\n");
  } 
  if($row == 0){
    echo "<tr class= 'bg-white' border='1'><td>";
    echo('NO ENTRY FOUND');
    echo("</td></tr>\n");
  }
 }


?>
</div>

</table>

//FOR AGENT ACCOUNT DETAILS
<?php

  


echo('<table border="1.2" class="table table-striped" >'."\n");


$sql = "SELECT Staff_id, Surname, First_name, Other_names, email, Work_Phonenumber, Phone_number FROM staff
   WHERE Approved = 'No' ";
     $stmt = $pdo->prepare($sql);

   $stmt->execute(array( ));
   $rows = array();
  




    echo"<tr class= 'table-info' border='1'><th>";
    echo("STAFF ID");
    echo("</th><th>");
    echo("SURNAME");
    echo("</th><th>");
    echo("FIRST NAME");
    echo("</th><th>");
    echo("OTHER NAMES");
    echo("</th><th>");
    echo("EMAIL");
    echo("</th><th>");
    echo("WORK PHONE NUMBER");
    echo("</th><th>");
    echo("PHONE NUMBER");
    echo("</th><th>");
    echo("Verify");
    echo("</th></tr>\n");

    while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
      
   $newstaff = $row;
   
   $numstaff = $newstaff['Staff_id'];
    //data 
    echo "<tr class= 'bg-danger' border='1'><td>";
    echo(htmlentities($newstaff['Staff_id']));
    echo("</td><td>");
    echo(htmlentities($newstaff['Surname']));
    echo("</td><td>");
    echo(htmlentities($newstaff['First_name']));
    echo("</td><td>");
    echo(htmlentities($newstaff['Other_names']));
    echo("</td><td>");
    echo(htmlentities($newstaff['email']));
    echo("</td><td>");
    echo(htmlentities($newstaff['Work_Phonenumber']));
    echo("</td><td>");
    echo(htmlentities($newstaff['Phone_number']));
    echo("</td><td>");
    echo('<form action="Admin.php" method="post"> <button type = "submit" id="staffverify" name ="newstaffverify"
    value ='.$numstaff.'> Verify </button> </form>');  
    


  
   echo("</td></tr>\n");
}
if($row == 0){
  echo "<tr class= 'bg-white' border='1'><td>";
  echo('NO ENTRY FOUND');
  echo("</td></tr>\n");
}
//}


?>
</div>

</table>



<div><a href="index.php?logout=1" class="logout"> logout</a></div>
<div><a href="admin/dashboard.php" > Previous page</a></div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script type="text/javascript">




// Simple htmlentities leveraging JQuery
function htmlentities(str) {
   return $('<div/>').text(str).html();
}
 </script>

<script type="text/javascript">
// Do this *after* the table tag is rendered


$(document).ready(function() {

$("#agentsverificationb" ).click(function() {
    $("#agentsverification").toggle()
});


$( "#apartmentrentb" ).click(function() {
    $("#apartmentrent").toggle()
});


$.getJSON('getjson.php', function(verifyagent) {
    $("#mytab").empty();
    console.log(verifyagent);
    found = false;
    for (var i = 0; i < verifyagent.length; i++) {
        row = verifyagent[i];
        found = true;
        window.console && console.log('Row: '+i+' '+row.agent_id);
        $("#mytab").append("<tr><td>"+htmlentities(row.agent_id)+'</td><td>'
            + htmlentities(row.Account_number)+'</td><td>'
			+ htmlentities(row.Govt_id)+'</td><td>'
            + htmlentities(row.passport)+'</td><td>'
            + htmlentities(row.Bank_name)+"</td><td>\n"
            + '<a href="authController.php?id='+htmlentities(row.user_id)+'">'
            + 'Verified</a>\n</td></tr>');
    }
    if ( ! found ) {
        $("#mytab").append("<tr><td>No entries found</td></tr>\n");
    }
});




//Rented Apartment


$.getJSON('getjson.php', function(apartmentrent) {
    $("#yourtab").empty();
    console.log(apartmentrent);
    found = false;
    for (var i = 0; i < apartmentrent.length; i++) {
        row = apartmentrent[i];
        found = true;
        window.console && console.log('Row: '+i+' '+row.Property_number);
        $("#yourtab").append("<tr><td>"+htmlentities(row.Property_number)+'</td><td>'


            + htmlentities(row.Client_name)+'</td><td>'
			+ htmlentities(row.Phone_number)+'</td><td>'
            + htmlentities(row.email)+'</td><td>'
            + htmlentities(row.date_inspection)+'</td><td>'
            + htmlentities(row.agent_id)+'</td><td>'
            + htmlentities(row.buildingtype)+'</td><td>'
            + htmlentities(row.Address)+'</td><td>'
            + htmlentities(row.floor)+'</td><td>'
            + htmlentities(row.Rent)+'</td><td>'
            + htmlentities(row.Agent_fee)+'</td><td>'
            + htmlentities(row.Barr)+"</td><td>\n"
            + '<form ><a href="authController.php?id='+htmlentities(row.Property_number)+'">'
            + 'Supervised</a>\n</td><td>'
            + '<button id="rented"><a href="authController.php?id='+htmlentities(row.Property_number)+'">'
            + 'Rented</a></button>\n</td></tr>');
    }
    if ( ! found ) {
        $("#yourtab").append("<tr><td>No entries found</td></tr>\n");
    }
});

$('#rented').off('click');


(function () {
  var count = 0;

  $('#supervised').click(function () {
    count += 1;

    if (count == 3) {
      // come code
    }
  });
})();





});
</script>











</body>
</html>