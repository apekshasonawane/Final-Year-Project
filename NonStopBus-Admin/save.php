<?php
  include_once('db.php');
  $firstName = $_POST["firstName1"];
  $lastName = $_POST["lastName1"];
  $inputEmail = $_POST["inputEmail1"];
  $inputPassword = $_POST["inputPassword1"];   
  $date_created = date('Y-m-d');
	
  $rs=$db->prepare("select * from tbl_admin where email='$inputEmail'");
  $rs->execute();
  $rw=$rs->fetch();
	
  if($rw!=0){
	echo "Email Id already Exists.";
  }
  else if($db->exec("insert into tbl_admin(first_name,last_name,email,password,date_created) values('$firstName','$lastName','$inputEmail',
                     '$inputPassword','$date_created')"))
  {
	echo "Admin registered Successfully. Plz  Login";
  }
  else
  {
    echo "Admin registeration failed";
  }
?>