<?php
	include 'db.php';
 
	$bus_number = $_REQUEST['bus_number'];
	$destination = $_REQUEST['destination'];
	$ticket_date = $_REQUEST['ticket_date'];
	$ticket_time = $_REQUEST['ticket_time'];
	$total_elder = $_REQUEST['total_elder'];
	$total_child = $_REQUEST['total_child'];
	$total_senior = $_REQUEST['total_senior'];
	$total_fair = $_REQUEST['total_fair'];
	$mobile = $_REQUEST['mobile'];
	
	if($db->exec("insert into tbl_ticket(bus_number,destination,ticket_date,ticket_time,total_elder,total_child,total_senior,total_fair,mobile)
				    values('$bus_number','$destination','$ticket_date','$ticket_time','$total_elder','$total_child','$total_senior','$total_fair','$mobile')"))
		{
			//$jsonarray = array('result'=>'success','msg'=>'success');	
			$last_id = $db->lastInsertId();	

			//update available_seats
			$tot=$total_elder+$total_child+$total_senior;
			$db->exec("update tbl_bus_details set available_seats=available_seats-$tot where bus_number='$bus_number'");
			echo json_encode($last_id);
		}
		else
		{
			//$jsonarray = array('result'=>'fail','msg'=>'fail');			
			echo json_encode('Ticket Fail');
		}	
	
?>