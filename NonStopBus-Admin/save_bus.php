<?php
  

  include_once('db.php');
  $Flag=$_POST["Flag"];
  if($Flag=="Save"){
    $bus_number = $_POST["bus_number"];
    $date = $_POST["date"];
    $source = $_POST["source"];
    $destination = $_POST["destination"];
    $departure_time = $_POST["departure_time"];
    $total_seats = $_POST["total_seats"];   
    $route = $_POST["route"];   
    $trip = $_POST["trip"];   
    $fare = $_POST["fare"];   
    $service = $_POST["service"];   
	 
    $rs=$db->prepare("select * from tbl_bus_details where bus_number='$bus_number'");
    $rs->execute();
    $rw=$rs->fetch();
  
    if($rw==0){
       if($db->exec("insert into tbl_bus_details(bus_number,date,source,destination,departure_time,total_seats,available_seats,route,trip,fare,service) values('$bus_number','$date','$source','$destination','$departure_time','$total_seats','$total_seats','$route','$trip','$fare','$service')"))
       {
         echo "Bus details inserted successfully";
       }
       else
      {
        echo mysql_error();
      }
  } 
  else{ 
     if($db->exec("update tbl_bus_details set date='$date',source='$source',destination='$destination',departure_time='$departure_time',total_seats='$total_seats', available_seats='$total_seats',route='$route', trip='$trip',fare='$fare',service='$service' where bus_number='$bus_number'"))
      {
          echo "Bus details updated successfully";
          exit;
      }
      else
      {
        echo "Record Exists";
        exit;
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
          <th>Bus Number</th>
          <th>Date</th>
          <th>Source</th>
          <th>Destination</th>
          <th>Departure Time</th>
          <th>Total Seats</th>
          <th>Available Seats</th>
          <th>ROUTE NO.</th>
          <th>TRIP NO.</th>
          <th>FARE</th>
          <th>SERVICE TYPE</th>
          <th>Action</th>
        </tr></thead><tbody>";
        $rs=$db->prepare("select * from tbl_bus_details order by bus_number");
        $rs->execute(); 
        while($row=$rs->fetch()){
              $_id=$row['_id'];
              $bus_no=$row['bus_number'];
              echo "<tr>"; 
              echo "<td class='hidden' id='tdId$_id'>".$_id."</td>";         
              echo "<td id='tdbus_no$_id'>".$bus_no."</td>"; 
              echo "<td id='tddate$_id'>".$row['date']."</td>";  
              echo "<td id='tdsource$_id'>".$row['source']."</td>"; 
              echo "<td id='tddestination$_id'>".$row['destination']."</td>";   
              echo "<td id='tddeparture_time$_id'>".$row['departure_time']."</td>";   
              echo "<td id='tdtotal_seats$_id'>".$row['total_seats']."</td>";
              echo "<td id='tdavailable_seats$_id'>".$row['available_seats']."</td>";
              echo "<td id='tdroute$_id'>".$row['route']."</td>";
              echo "<td id='tdtrip$_id'>".$row['trip']."</td>";
              echo "<td id='tdfare$_id'>".$row['fare']."</td>";
              echo "<td id='tdservice$_id'>".$row['service']."</td>";
              echo "<td><i class='btn btn-info pe-7s-credit btn-xs' id='btnUpdate$bus_no' onclick='ShowInEditor($_id);'></i>&nbsp;&nbsp;&nbsp;<i class='btn btn-danger pe-7s-delete-user btn-xs' id='btnDelete$_id' onclick='DeleteRecord($_id);'></i></td>";
              echo "</tr>";     
        }
      echo "</tbody></table></div></div>";
}
else if($Flag=="DeleteRecord")
{
    $_id=$_POST["PrimaryKey"];

    if($db->exec("delete from tbl_bus_details where _id='$_id'"))
    {
      echo "Deleted Successfully";
    }
    else
    {
      echo mysql_error();
    }  
}

?>

