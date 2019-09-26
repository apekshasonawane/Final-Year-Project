<?php
	include 'db.php';
 
    $ctid = $_REQUEST['ctid'];
	$bus_number = $_REQUEST['bus_number'];
	$destination = $_REQUEST['destination'];
	$ticket_date = $_REQUEST['ticket_date'];
	$ticket_time = $_REQUEST['ticket_time'];
	$total_elder = $_REQUEST['total_elder'];
	$total_child = $_REQUEST['total_child'];
	$total_senior = $_REQUEST['total_senior'];
	$total_fair = $_REQUEST['total_fair'];
	
	
	if($db->exec("insert into tbl_cticket
				    values('$ctid','$bus_number','$destination','$ticket_date','$ticket_time','$total_elder','$total_child','$total_senior','$total_fair')"))
		{
			//update available_seats
			$tot=$total_elder+$total_child+$total_senior;
			$db->exec("update tbl_bus_details set available_seats=available_seats+$tot where bus_number='$bus_number'");
			echo json_encode('Ticket Cancelled');
		}
		else
		{
			echo json_encode('Ticket Cancellation Fail');
		}		
?>