<?php
  session_start();
  $email=$_SESSION['admin'];
  include_once('db.php');  
  $password = $_POST["password1"];
  $mobile = $_POST["mobile1"];    
  $address = $_POST["address1"];  
  $city = $_POST["city1"];  
  
  if($db->exec("update tbl_admin set password='$password',mobile='$mobile',address='$address',city='$city' where email='$email'"))
  {
	echo "Admin profile updated Successfully.";
  }
  else
  {
    echo "Admin updation failed";
  }
?>