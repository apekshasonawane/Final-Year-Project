<?php
  include_once('db.php');
  $bus_number = $_POST["busno2"];
  $rs=$db->prepare("select * from tbl_bus_details where bus_number='$bus_number'");
  $rs->execute();
  $rw=$rs->fetch();
  if($rw==0)
  	echo "No Details";
  else
	echo $rw['destination'];
?>