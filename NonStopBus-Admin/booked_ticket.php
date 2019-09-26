<?php
  include_once('db.php');
  
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
          <th>Ticket ID</th>
          <th>Bus Number</th>
          <th>Destination</th>
          <th>Ticket Date</th>
          <th>Ticket Time</th>
          <th>Total Elder</th>
          <th>Total Child</th>
          <th>Total Senior</th>
          <th>Total Fair</th>    
          <th>Seat Nos.</th>    
        </tr></thead><tbody>";
        $rs=$db->prepare("select * from tbl_ticket order by ticket_date");
        $rs->execute(); 
        while($row=$rs->fetch()){
              echo "<tr>"; 
              echo "<td>".$row['ticket_id']."</td>"; 
              echo "<td>".$row['bus_number']."</td>"; 
              echo "<td>".$row['destination']."</td>";  
              echo "<td>".$row['ticket_date']."</td>"; 
              echo "<td>".$row['ticket_time']."</td>";   
              echo "<td>".$row['total_elder']."</td>";   
              echo "<td>".$row['total_child']."</td>";
              echo "<td>".$row['total_senior']."</td>";
              echo "<td>".$row['total_fair']."</td>";
              echo "<td>".$row['seat_nos']."</td>";
              echo "</tr>";     
        }
      echo "</tbody></table></div></div>";
  
?>


 