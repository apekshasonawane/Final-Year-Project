<?php
include 'db.php';
$dest = $_REQUEST['dest'];
// Create connection
$conn = new mysqli($servername, $username_db, $password_db, $database);
if ($conn->connect_error) { 
 die("Connection failed: " . $conn->connect_error);
} 
date_default_timezone_set('Asia/Kolkata');
$tm=date("H:i");
$today=date('Y-m-d');

$sql = "SELECT * FROM tbl_bus_details where destination='$dest' and available_seats>'0' and date='$today' and departure_time>'$tm'";
/*
$sql = "SELECT * FROM tbl_bus_details where destination='$dest'";
*/

/*echo $sql;
exit;*/
$result = $conn->query($sql);
if ($result->num_rows >0) {
  while($row[] = $result->fetch_assoc()) {
  $tem = $row;
  $json = json_encode($tem);
 }
 echo $json;
} else {
 echo "No Results Found.";
}
 
 $conn->close();
?>