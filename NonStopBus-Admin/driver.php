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
                <li>
                    <a href="bus.php">
                        <i class="pe-7s-note2"></i>
                        <p>Bus Time table</p>
                    </a>
                </li>
                <li class="active">
                    <a href="driver.php">
                        <i class="pe-7s-add-user"></i>
                        <p>New Driver</p>
                    </a>
                </li>
                <li>
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
                    <div class="col-md-8">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Add new driver + Assign Bus</h4>
                            </div>
                            <div class="content">
                                <form id="frmUser" name="frmUser" method="post">
                                  <input type="hidden" class="form-control" id="txtid" name="txtid">
                                    <div class="row">                                       
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Firstname</label>
                                                <input type="text" id="firstname" name="firstname" class="form-control" placeholder="Firstname" value="">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Middlename</label>
                                                <input type="text" id="middlename" name="middlename" class="form-control" placeholder="Middlename" value="">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Lastname</label>
                                                <input type="text" id="lastname" name="lastname" class="form-control" placeholder="Lastname" value="">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>Email-id</label>
                                                <input type="text" id="email_id" name="email_id" class="form-control" placeholder="email_id" value="">
                                           </div>
                                        </div>    
                                         <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Mobile Number</label>
                                                <input type="text" id="mobile_number" name="mobile_number" class="form-control" placeholder="mobile" value="">
                                           </div>
                                        </div>                                        
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Driver Id</label>
                                                <input type="text" id="driver_id" name="driver_id" class="form-control" placeholder="driver id" value="">
                                            </div>
                                         </div>   
                                         <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Date of Birth</label>
                                                <input type="Date" id="date_of_birth" name="date_of_birth" class="form-control" placeholder="date_of_birth" value="">
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
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Bus Number</label>
                                                <select id="busno" name="busno" class="form-control">
                                                    <option value="">--Select--</option>
                                                    <?php
        $rs=$db->prepare("select * from tbl_bus_details order by bus_number");
        $rs->execute(); 
        while($row=$rs->fetch()){
              $_id=$row['_id'];
              $bus_no=$row['bus_number'];
              echo "<option value='$bus_no'>$bus_no</option>";
          }
          ?>
        
                                                </select>
                                            </div>
                                         </div>   
                                         <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Destination</label>
                                                <input type="text" id="destination" name="destination" class="form-control" placeholder="Bus Details" value="" readonly>
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
                    </div> </div>   
              
                </div>
                   
                   <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Driver Details</h4>
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
    formData.append("Flag","Save");
    $.ajax({
        url: "save_driver.php", 
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

//for busno & destination
 $(document).ready(function(){
    $("#busno").change(function(){
      var busno1 = $(this).val(); 
      var dataString = "busno2="+busno1;       
      $.ajax({ 
        type: "POST", 
        url: "get-destination.php", 
        data: dataString, 
        success: function(result){ 
          $("#destination").val(result); 
        }
      });

    });
  });
function ShowRecords()
{
    $.post('save_driver.php',
    {
        Flag:'ShowRecords'
    },function(data,success)
    {
        $('#DivRecords').html(data);
    });
}
function DeleteRecord(PrimaryKey)
{
    $.post('save_driver.php',
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
    $("#firstname").val('');
    $("#middlename").val('');
    $("#lastname").val('');
    $("#email_id").val('');
    $("#mobile_number").val('');
    $("#driver_id").val('');    
    $("#date_of_birth").val('');    
    $("#address").val('');    
    $("#city").val('');     
    $("#busno").val('');     
}
function ShowInEditor(PrimaryKey)
{
    $('#txtid').val($('#tdId'+PrimaryKey).html());   
    $('#firstname').val($('#tdfirstname'+PrimaryKey).html());
    $('#middlename').val($('#tdmiddlename'+PrimaryKey).html());      
    $('#lastname').val($('#tdlastname'+PrimaryKey).html()); 
    $('#email_id').val($('#tdemail_id'+PrimaryKey).html()); 
    $('#mobile_number').val($('#tdmobile_number'+PrimaryKey).html()); 
    $('#driver_id').val($('#tddriver_id'+PrimaryKey).html()); 
    $('#date_of_birth').val($('#tddate_of_birth'+PrimaryKey).html()); 
    $('#address').val($('#tdaddress'+PrimaryKey).html()); 
    $('#city').val($('#tdcity'+PrimaryKey).html()); 
    $('#busno').val($('#tdbusno'+PrimaryKey).html()); 
}
</script>



