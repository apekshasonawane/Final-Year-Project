<?php
include 'db.php';
$tid = $_REQUEST['tid'];
// Create connection
$conn = new mysqli($servername, $username_db, $password_db, $database);
if ($conn->connect_error) { 
 die("Connection failed: " . $conn->connect_error);
} 
$sql = "SELECT * FROM tbl_ticket where ticket_id='$tid'";
/*echo $sql;
exit;*/
$result = $conn->query($sql);
if ($result->num_rows >0) {
  while($row[] = $result->fetch_assoc()) {
  $tem = $row;
  $json = json_encode($tem);
 }
 
} else {
 echo "No Results Found.";
}
 echo $json;
 $conn->close();
?>