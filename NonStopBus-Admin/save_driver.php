<?php
  include_once('db.php');
  $Flag=$_POST["Flag"];
  if($Flag=="Save"){
      $firstname=$_POST["firstname"];
      $middlename=$_POST["middlename"];
      $lastname=$_POST["lastname"];  
      $email_id=$_POST["email_id"];
      $mobile_number=$_POST["mobile_number"];
      $driver_id=$_POST["driver_id"];   
      $date_of_birth=$_POST["date_of_birth"];
      $address=$_POST["address"];
      $city=$_POST["city"]; 
      $busno=$_POST["busno"]; 
   
    $rs=$db->prepare("select * from tbl_driver where driver_id='$driver_id'");
    $rs->execute();
    $rw=$rs->fetch();
  
    if($rw==0){
       if($db->exec("INSERT INTO tbl_driver(firstname,middlename,lastname,email_id,mobile_number, driver_id,date_of_birth,address,city,busno) VALUES ('$firstname','$middlename','$lastname','$email_id','$mobile_number','$driver_id','$date_of_birth','$address','$city','$busno')"))
       {
         echo "Driver details inserted successfully";
       }
       else
      {
        echo mysql_error();
      }
  } 
  else{ 
     if($db->exec("update tbl_driver set firstname='$firstname',middlename='$middlename',lastname='$lastname',email_id='$email_id',mobile_number='$mobile_number',date_of_birth='$date_of_birth',address='$address',city='$city',busno='$busno' where driver_id='$driver_id'"))
      {
          echo "Driver details updated successfully";
      }
      else
      {
        echo "Record Exists";
      }    
 }
}

else if($Flag=="ShowRecords")
{
  echo "<link href='dt/vendor/datatables/dataTables.bootstrap4.css' rel='stylesheet'>";
  echo "<script src='dt/vendor/datatables/jquery.dataTables.js'></script>";
  echo "<script src='dt/vendor/datatables/dataTables.bootstrap4.js'></script>";
  echo "<script type='text/javascript'>
        $(document).ready(function() {
          $('#dataTable').DataTable();
        });
    </script>";
  echo "<div class='row><div class='table-responsive'><table class='table table-bordered' id='dataTable'>
        <thead>
        <tr>
          <th class='hidden'>_id</th>
          <th>First Name</th>
          <th>Middle Name</th>
          <th>Last Name</th>
          <th>Email Id</th>
          <th>Mobile</th>
          <th>Driver Id</th>
          <th>Birth Date</th>
          <th>Address</th>
          <th>City</th>
          <th>Bus No</th>
          <th>Action</th>
        </tr></thead><tbody>";
        $rs=$db->prepare("select * from tbl_driver order by driver_id");
        $rs->execute(); 
        while($row=$rs->fetch()){
              $_id=$row['_id'];
              $driver_id=$row['driver_id'];
              echo "<tr>"; 
              echo "<td class='hidden' id='tdId$_id'>".$_id."</td>";         
              echo "<td id='tdfirstname$_id'>".$row['firstname']."</td>"; 
              echo "<td id='tdmiddlename$_id'>".$row['middlename']."</td>";  
              echo "<td id='tdlastname$_id'>".$row['lastname']."</td>"; 
              echo "<td id='tdemail_id$_id'>".$row['email_id']."</td>";   
              echo "<td id='tdmobile_number$_id'>".$row['mobile_number']."</td>";   
              echo "<td id='tddriver_id$_id'>".$row['driver_id']."</td>";
              echo "<td id='tddate_of_birth$_id'>".$row['date_of_birth']."</td>";
              echo "<td id='tdaddress$_id'>".$row['address']."</td>";
              echo "<td id='tdcity$_id'>".$row['city']."</td>";
              echo "<td id='tdbusno$_id'>".$row['busno']."</td>";
              echo "<td><i class='btn btn-info pe-7s-credit btn-xs' id='btnUpdate$driver_id' onclick='ShowInEditor($_id);'></i>&nbsp;&nbsp;&nbsp;<i class='btn btn-danger pe-7s-delete-user btn-xs' id='btnDelete$_id' onclick='DeleteRecord($_id);'></i></td>";
              echo "</tr>";     
        }
      echo "</tbody></table></div></div>";
}
else if($Flag=="DeleteRecord")
{
    $_id=$_POST["PrimaryKey"];

    if($db->exec("delete from tbl_driver where _id='$_id'"))
    {
      echo "Deleted Successfully";
    }
    else
    {
      echo mysql_error();
    }  
}

?>


 