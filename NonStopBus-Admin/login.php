<?php
  session_start();
  include_once('db.php');  
  $inputEmail = $_POST["inputEmail1"];
  $inputPassword = $_POST["inputPassword1"];	

 

  $rs=$db->prepare("select * from tbl_admin where email='$inputEmail' and password='$inputPassword'");
  $rs->execute();
  $rw=$rs->fetch();
	
  if($rw!=0){
  	$_SESSION['admin']=$inputEmail;
  	echo "success";		
  }
  else{
	   echo "fail";	
  }

?>   