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
                <li class="active">
                    <a href="bus.php">
                        <i class="pe-7s-note2"></i>
                        <p>Bus Time table</p>
                    </a>
                </li>
                <li>
                    <a href="driver.php">
                        <i class="pe-7s-add-user"></i>
                        <p>New Driver</p>
                    </a>
                </li>
                <li>
                    <a href="driver.php">
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
                    <div class="col-md-8">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Add/Update Bus Details</h4>
                            </div>
                            <div class="content">
                                <form id="frmUser" name="frmUser" method="post">
                                  <input type="hidden" class="form-control" id="txtid" name="txtid">
                                    <div class="row">                                       
                                         <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Bus number</label>
                                                <input type="text" id="bus_number" name="bus_number" class="form-control" placeholder="Bus Number" value="MH-13 ">
                                            </div>
                                         </div>   
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Date</label>
                                                <input type="Date" id="date" name="date" class="form-control" placeholder="Date">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Source</label>
                                                <input type="text" id="source" name="source" class="form-control" placeholder="Source" value="Solapur">
                                            </div>
                                         </div>   
                                         <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Destination</label>
                                                <!-- <input type="text" id="destination" name="destination" class="form-control" placeholder="Destination"> -->
                                                <select id="destination" name="destination" class="form-control" >
                                                    <option value="">--Select--</option>
                                                     <option value="Barshi">Barshi </option>
                                                    <option value="Pandharpur">Pandharpur </option>
                                                    <option value="Tuljapur">Tuljapur </option>
                                                 </select>
                                            </div>
                                        </div>                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Departure Time</label>
                                                <input type="time" id="departure_time" name="departure_time" class="form-control" placeholder="Departure Time">
                                            </div>
                                         </div>   
                                         <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Total seats</label>
                                                <input type="text" id="total_seats" name="total_seats" class="form-control" placeholder="total_seats">
                                            </div>
                                         </div>                                  
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Route No.</label>
                                                <input type="text" id="route" name="route" class="form-control" placeholder="Route Number">
                                            </div>
                                         </div>   
                                         <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Trip No.</label>
                                                <input type="text" id="trip" name="trip" class="form-control" placeholder="Trip Number">
                                            </div>
                                         </div>                                  
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Fare</label>
                                                <input type="text" id="fare" name="fare" class="form-control" placeholder="Bus Fare">
                                            </div>
                                         </div>   
                                         <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Service Type</label>
                                                <input type="text" id="service" name="service" class="form-control" placeholder="Service Type">
                                            </div>
                                         </div>                                  
                                    </div>
                                    <button type="submit" class="btn btn-info btn-fill pull-right" id="btnprofile" name="btnprofile">Save</button>
                                    <div class="clearfix"></div>

                                    
                                </form>
                            </div>
                        </div>
                    </div>   


                    <div class="col-md-4">
                        <img src="assets/img/msrtc3.jpg" class="responsive"/>
                    </div>               
                </div>
                 </div>
                   
                   <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Bus Details</h4>
                                <form method="post" action="excel2.php">
                <p><button type="submit" id="btnExport" name="export"
                value="Export to Excel" class="btn btn-info">Export to
                excel</button></p></form>
                            </div>
                            <div class="content">
                                <div class="table-responsive">                                   
                                      <div id="DivRecords"></div> 
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

</html>


   

<script type="text/javascript">
$(document).ready(function(){
    ShowRecords();
	$("#frmUser").submit(function(event){       
        event.preventDefault();

            var formData = new FormData($(this)[0]);

/*if(bus_number==''||date==''||source==''||destination=='' || departure_time==''||total_seats==''||route==''||
                trip==''||fare==''||service=='')
        {
            alert("Please Fill All Fields");
        }
        else
        {
            */

               formData.append("Flag","Save");
    
    $.ajax({
        url: "save_bus.php", 
        type: 'POST',
        data: formData,
        async: false,
        success: function (data) {
                alert(data);
                ResetEditor();
                ShowRecords();
            },
        cache: false,
        contentType: false,
        processData: false,
    });
});
});

function ShowRecords()
{
    $.post('save_bus.php',
    {
        Flag:'ShowRecords'
    },function(data,success)
    {
        $('#DivRecords').html(data);
    });
}
function DeleteRecord(PrimaryKey)
{
    $.post('save_bus.php',
    {
        Flag:'DeleteRecord',
        PrimaryKey:PrimaryKey
    },
    function(data,success)
    {
        alert(data);   
        ResetEditor();
        ShowRecords();
        
    });
}
function ResetEditor()
{
    $("#bus_number").val('');
    $("#date").val('');
    $("#source").val('');
    $("#destination").val('');
    $("#departure_time").val('');
    $("#total_seats").val(''); 
    $("#available_seats").val(''); 
    $("#route").val('');   
    $("#trip").val('');   
    $("#fare").val('');   
    $("#service").val('');   

}
function ShowInEditor(PrimaryKey)
{
    $('#txtid').val($('#tdId'+PrimaryKey).html());   
    $('#bus_number').val($('#tdbus_no'+PrimaryKey).html());
    $('#date').val($('#tddate'+PrimaryKey).html());      
    $('#source').val($('#tdsource'+PrimaryKey).html()); 
    $('#destination').val($('#tddestination'+PrimaryKey).html()); 
    $('#departure_time').val($('#tddeparture_time'+PrimaryKey).html()); 
    $('#total_seats').val($('#tdtotal_seats'+PrimaryKey).html()); 
    $('#available_seats').val($('#tdavailable_seats'+PrimaryKey).html()); 
    $('#route').val($('#tdroute'+PrimaryKey).html()); 
    $('#trip').val($('#tdtrip'+PrimaryKey).html()); 
    $('#fare').val($('#tdfare'+PrimaryKey).html()); 
    $('#service').val($('#tdservice'+PrimaryKey).html()); 
}
</script>