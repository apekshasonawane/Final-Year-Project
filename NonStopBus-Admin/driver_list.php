<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/bus.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Online NonStopBus Ticket Generation System-Admin Panel</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="assets/css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="assets/css/demo.css" rel="stylesheet" />


    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
 
    <!-- Page level plugin CSS-->
    <link href="dt/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    
</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-color="purple" data-image="assets/img/mstrc.png">

    	<!--Start of SideBar-->
    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="#" class="simple-text">
                  ADMIN PANEL
                </a>
            </div>

            <ul class="nav">
                <li>
                    <a href="dashboard.php">
                        <i class="pe-7s-graph"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li>
                    <a href="profile.php">
                        <i class="pe-7s-user"></i>
                        <p>Admin Profile</p>
                    </a>
                </li>
                <li>
                    <a href="bus.php">
                        <i class="pe-7s-note2"></i>
                        <p>Bus Time table</p>
                    </a>
                </li>
                <li >
                    <a href="driver.php">
                        <i class="pe-7s-add-user"></i>
                        <p>New Driver</p>
                    </a>
                </li>
                <li class="active">
                    <a href="driver_list.php">
                        <i class="pe-7s-users"></i>
                        <p>Driver List</p>
                    </a>
                </li>
                <li>
                    <a href="reports.php">
                        <i class="pe-7s-print"></i>
                        <p>Reports</p>
                    </a>
                </li>
               

				<li class="active-pro">
                    <a href="dashboard.php">
                        <i class="pe-7s-rocket"></i>
                        <p> ONLINE NON-STOP BUS TICKET GENERATION SYSTEM </p>
                    </a>
                </li>
            </ul>
    	</div>
    </div>
    	<!--End of SideBar -->

    <div class="main-panel">
    	<!--Start of top nav-->
    	<?php include("nav.php");?>
    	<!--End of top nav-->

        

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Driver List</h4>
                                <form method="post" action="excel.php">
                <p><button type="submit" id="btnExport" name="export"
                value="Export to Excel" class="btn btn-info">Export to
                excel</button></p></form>
                            </div>
                            <div class="content">
                                

                                   <div class="row">
                                      
                                        <div class="table-responsive">
                <table class="table table-bordered" id="dataTable">
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
                    </tr>
                  </thead>
                  
                  <tbody>
                    <?php
                      $rs=$db->prepare("select * from tbl_driver order by driver_id");
                      $rs->execute(); 
                      while($row=$rs->fetch()){
                         $_id=$row['_id'];
                         $driver_id=$row['driver_id'];
                         echo "<tr>"; 
                         echo "<td class='hidden'>".$_id."</td>";         
                         echo "<td>".$row['firstname']."</td>"; 
                         echo "<td>".$row['middlename']."</td>";  
                         echo "<td>".$row['lastname']."</td>"; 
                         echo "<td>".$row['email_id']."</td>";   
                         echo "<td>".$row['mobile_number']."</td>";   
                         echo "<td>".$row['driver_id']."</td>";
                         echo "<td>".$row['date_of_birth']."</td>";
                         echo "<td>".$row['address']."</td>";
                         echo "<td>".$row['city']."</td>";
                         echo "<td>".$row['busno']."</td>";
                         echo "</tr>";   
                        } 
                     ?>    
                    
                  </tbody>
                </table>
              </div>
          </div>
      </div>
       </div>
   </div>
</div>
</div>
</div>
</div>
</div>


</body>

  <!--   Core JS Files   -->
    <script src="assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
    <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

    <!--  Charts Plugin -->
    <script src="assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="assets/js/bootstrap-notify.js"></script>

    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
    <script src="assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>

    <!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
    <script src="assets/js/demo.js"></script>   
    

    <!-- Page level plugin JavaScript-->
    <script src="dt/vendor/datatables/jquery.dataTables.js"></script>
    <script src="dt/vendor/datatables/dataTables.bootstrap4.js"></script>

    <script type="text/javascript">
        // Call the dataTables jQuery plugin
        $(document).ready(function() {
          $('#dataTable').DataTable();
        });

    </script>

</html>





