<?php 
 include_once('db.php'); 
 $statement = $db->prepare("select _id as SrNo,bus_number as 'Bus Number',date as 'Departure Date',departure_time as 'Deptarture Time',source as Source,destination as Destination,total_seats as 'Total Seats',route as 'Route No.',trip as Trip,fare as Fare,service as Service from tbl_bus_details order by _id");
$statement->execute();

//Fetch all of the rows from our MySQL table.
$rows = $statement->fetchAll(PDO::FETCH_ASSOC);
 
//Get the column names.
$columnNames = array();
if(!empty($rows)){
    //We only need to loop through the first row of our result
    //in order to collate the column names.
    $firstRow = $rows[0];
    foreach($firstRow as $colName => $val){
        $columnNames[] = $colName;
    }
}
 
//Setup the filename that our CSV will have when it is downloaded.
$fileName = 'bus-export.csv';
 
//Set the Content-Type and Content-Disposition headers to force the download.
header('Content-Type: application/excel');
header('Content-Disposition: attachment; filename="' . $fileName . '"');
 
//Open up a file pointer
$fp = fopen('php://output', 'w');
 
//Start off by writing the column names to the file.
fputcsv($fp, $columnNames);
 
//Then, loop through the rows and write them to the CSV file.
foreach ($rows as $row) {
    fputcsv($fp, $row);
}
 
//Close the file pointer.
fclose($fp);

?>