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
    	<?php include("sidebar.php");?>
    	<!--End of SideBar -->

    <div class="main-panel">
    	<!--Start of top nav-->
    	<?php include("nav.php");?>
    	<!--End of top nav-->

        
        <?php                   
           $rs=$db->prepare("select sum(total_fair) as tfair from tbl_ticket where destination='Barshi'");
           $rs->execute();
           $rw=$rs->fetch();
           $bfair=$rw["tfair"];
           
            $rs2=$db->prepare("select sum(total_fair) as tfair2 from tbl_ticket where destination='Pandharpur'");
            $rs2->execute();
            $rw2=$rs2->fetch();
            $pfair=$rw2["tfair2"];

            $rs3=$db->prepare("select sum(total_fair) as tfair3 from tbl_ticket where destination='Tuljapur'");
            $rs3->execute();
            $rw3=$rs3->fetch();
            $tfair=$rw3["tfair3"];
            
            $dataPoints = array( 
                                    array("label"=>"Barshi", "y"=>$bfair),
                                    array("label"=>"Pandharpur", "y"=>$pfair),
                                    array("label"=>"Tuljapur", "y"=>$tfair)
                                );
                    
                   
                ?>

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">	
                       <div id="chartContainer" style="height: 370px; width: 100%;"></div>
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
 <script src="js/canvasjs.min.js"></script>

<script>
    window.onload = function() { 
    var chart = new CanvasJS.Chart("chartContainer", {
    animationEnabled: true,
    title: {
        text: "City-wise Collection"
    },
    subtitles: [{
        text: "CITY-TOTAL FARE"
    }],
    data: [{
        type: "pie",
        yValueFormatString: "#,##0.00\"\"",
        indexLabel: "{label} ({y})",
        dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
    }]
});
chart.render();
 
}
</script>
</html>