<?php

//dashboard.php

require_once 'backend/authController.php';

include('class/Appointment.php');

$object = new Appointment;

include('header.php');

// if(($_SESSION['type'] != 'customer')) {
// 	header('location: index.php');
// 	die();
// }




?>

<div class="container-fluid">
	


	<?php


	   
	  
	   
	    
	?>
	<br />
	<div class="card">
		<div class="card-header"><h4>Agent Schedule List</h4></div>
			<div class="card-body">
				<div class="table-responsive">
					<?php 

		      		echo('<table class="table table-striped table-bordered" id="appointment_list_table">'."\n");

					 $customerid = $_SESSION["customerid"];
					  $todaysdate = date('Y-m-d'); 

					  $sql = "SELECT * FROM agent_schedule_table 
					  INNER JOIN agent 
					  ON agent.agent_id = agent_schedule_table.agent_id 
					 INNER JOIN property
					 ON property.agent_id = agent.agent_id
					 INNER JOIN rent_interest
					 ON rent_interest.Property_number = property.Property_number
					 
					 WHERE (agent_schedule_table.agent_schedule_date >= '$todaysdate' AND property.Property_number = '".$_SESSION["apartment_number"]."')
					 ORDER BY agent_schedule_table.agent_schedule_date ASC";
		      			
						  $stmt = $pdo->prepare($sql);
						    $stmt ->execute(array());
						  //$result = array();
						 
						echo"<thead>
			      			<tr>
			      				<th>";
								echo("Agent Name");
								echo("</th><th>");
								echo("Appointment Date");
								echo("</th><th>");
								echo("Appointment Day");
								echo("</th><th>");
								echo("Available Time");
								echo("</th><th>");
								echo("Action");
								echo("</th></tr></thead>\n");

								while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
								 // ) {
    
									//$row = $stmt->fetch(PDO::FETCH_ASSOC);
									$result = $row;
									
									// foreach($result as $row){

									
			      		echo"<tbody>
							<tr>
								<td>";
								 echo(htmlentities($result['First_name']));
								 echo("</td><td>");
								 echo (htmlentities($result['agent_schedule_date'])); 
								 echo("</td><td>");
								 echo (htmlentities($result['agent_schedule_day'])); 
								 echo("</td><td>");
								 echo (htmlentities($result['agent_schedule_start_time'])); 
								 echo("</td><td>");
								 echo('<form action="dashboard.php" method="post">
								 <input type = "hidden" value= '.$customerid.' name="customer_id" />
									<input type = "hidden" value= '.htmlentities($result['agent_id']).' name="hidden_agent_id" />
									<input type="hidden" value = '.htmlentities($result["agent_schedule_id"]).' name ="hidden_agent_schedule_id"/> 
									<button type="submit" name="get_appointment" id="get_appointment" class="btn btn-primary btn-sm get_appointment" >Get Appointment</button></form>
			</div>');
			echo("</td>
							</tr>
						</tbody>\n");
								}
					if($row == 0){
					  echo "<tr class= 'bg-white' border='1'><td>";
					  echo('Agent has no appointment');
					  echo("</td></tr>\n");
					}

						?>
			      	</table>
			    </div>
			</div>
		</div>
	</div>

</div>

<?php

include('footer.php');

?>

<div id="appointmentModal" class="modal fade">
  	<div class="modal-dialog">
    	<form method="post" id="appointment_form" >
      		<div class="modal-content">
        		<div class="modal-header">
          			<h4 class="modal-title" id="modal_title">Make Appointment</h4>
          			<button type="button" class="close" data-dismiss="modal">&times;</button>
        		</div>
        		<div class="modal-body">
        			<span id="form_message"></span>
                    <div id="appointment_detail">

					</div>
                    <!-- <div class="form-group">
                    	<label><b>R for Appointment</b></label>
                    	<textarea name="reason_for_appointment" id="reason_for_appointment" class="form-control" required rows="5"></textarea>
                    </div> -->
        		</div>
        		<div class="modal-footer">
          			<input type="hidden" name="hidden_agent_id" id="hidden_agent_id" />
          			<input type="hidden" name="hidden_agent_schedule_id" id="hidden_agent_schedule_id" />
          			<input type="hidden" name="action" id="action" value="book_appointment" />
          			<input type="submit" name="submit" id="submit_button" class="btn btn-success" value="Book" />
          			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        		</div>
      		</div>
    	</form>
  	</div>
</div>


<script>

$(document).ready(function(){

$('#get_appointment').click( function()
	{
				$('#appointmentModal').modal('show');
				$('#hidden_agent_id').val(agent_id);
				$('#hidden_agent_schedule_id').val(agent_schedule_id);
				$('#appointment_detail').html(data);
			});
	// var dataTable = $('#appointment_list_table').DataTable({
	// 	"processing" : true,
	// 	"serverSide" : true,
	// 	"order" : [],
	// 	"ajax" : {
	// 		url:"action.php",
	// 		type:"POST",
	// 		data:{action:'fetch_schedule'}
	// 	},
	// 	"columnDefs":[
	// 		{
    //             "targets":[6],				
	// 			"orderable":false,
	// 		},
	// 	],
	// });

	// $(document).on('click', '.get_appointment', function(){

	// 	var agent_schedule_id = $(this).data('agent_schedule_id');
	// 	var agent_id = $(this).data('agent_id');
		

	// 	$.ajax({
	// 		url:"authController.php",
	// 		method:"POST",
	// 		data:{action:'make_appointment', agent_schedule_id:agent_schedule_id},
	// 		success:function(data)
	// 		{
	// 			$('#appointmentModal').modal('show');
	// 			$('#hidden_agent_id').val(agent_id);
	// 			$('#hidden_agent_schedule_id').val(agent_schedule_id);
	// 			$('#appointment_detail').html(data);
	// 		}
	// 	});

	// });

	$('#appointment_form').parsley();

	$('#appointment_form').on('submit', function(event){

		event.preventDefault();

		if($('#appointment_form').parsley().isValid())
		{

			$.ajax({
				url:"action.php",
				method:"POST",
				data:$(this).serialize(),
				dataType:"json",
				beforeSend:function(){
					$('#submit_button').attr('disabled', 'disabled');
					$('#submit_button').val('wait...');
				},
				success:function(data)
				{
					$('#submit_button').attr('disabled', false);
					$('#submit_button').val('Book');
					if(data.error != '')
					{
						$('#form_message').html(data.error);
					}
					else
					{	
						window.location.href="appointment.php";
					}
				}
			})

		}

	})

});

</script>