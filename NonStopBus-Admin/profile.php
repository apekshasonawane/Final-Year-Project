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
                <li >
                    <a href="dashboard.php">
                        <i class="pe-7s-graph"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="active">
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
                                <h4 class="title">Edit Profile</h4>
                            </div>
                            <div class="content">
                                <form>
                                    <div class="row">                                       
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input type="password" id="password" name="password" class="form-control" placeholder="Password" value="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Mobile</label>
                                                <input type="number" id="mobile" name="mobile" class="form-control" placeholder="Mobile No." value="">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Address</label>
                                                <input type="text" id="address" name="address" class="form-control" placeholder="Home Address" value="">
                                            </div>
                                         </div>   
                                         <div class="col-md-6">
                                            <div class="form-group">
                                                <label>City</label>
                                                <input type="text" id="city" name="city" class="form-control" placeholder="City" value="">
                                            </div>
                                        </div>                                        
                                    </div>
                                    
                                    <button type="submit" class="btn btn-info btn-fill pull-right" id="btnprofile" name="btnprofile">Update Profile</button>
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
	$("#btnprofile").click(function(){	
		var password = $("#password").val();
		var mobile = $("#mobile").val();
		var address = $("#address").val();
		var city = $("#city").val();
				
		// Returns successful data submission message when the entered information is stored in database.
		var dataString = 'password1='+ password + '&mobile1='+ mobile+ '&address1='+ address+ '&city1='+ city ;
		if(password==''||mobile=='' || address=='' || city=='')
		{
			alert("Please Fill All Fields");
		}
		else
		{
			// AJAX Code To Submit Form.
			$.ajax({
				type: "POST",
				url: "update.php",
				data: dataString,
				cache: false,
				success: function(result){
					alert(result);
				}
			});
		}
		return false;
	});
});
</script>