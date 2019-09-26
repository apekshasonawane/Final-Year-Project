<?php
	include 'db.php';
 
	$bus_number = $_REQUEST['bus_number']; 
	$tid = $_REQUEST['tid'];
	$seat_nos = $_REQUEST['seat_nos'];
	$tid=trim($tid, '"');

	if($db->exec("update tbl_ticket set seat_nos='$seat_nos' where ticket_id='$tid'"))
		{
		$db->exec("update tbl_bus_details set seat_nos=CONCAT(seat_nos,'$seat_nos') where bus_number='$bus_number'");	
			echo json_encode('success');
		}
		else
		{
			echo json_encode('fail');
		}	
	
?>