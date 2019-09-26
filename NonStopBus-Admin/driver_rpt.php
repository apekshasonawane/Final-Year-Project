<?php
  include_once('db.php');
  echo "<div class='table-responsive' id='dataTable'><table class='table table-bordered'>
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
        </tr>";
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
              
              echo "</tr>";     
        }
      echo "</table></div>";

?>

