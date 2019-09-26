 
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
	<link rel="icon" type="image/png" href="assets/img/bus.png">
    <title>Online NonStopBus Ticket Generation System - Admin Login</title>

    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">

  </head>

  <body class="bg-dark">

    <div class="container">
      <div class="card card-login mx-auto mt-5">
        <div class="card-header">Admin Login</div>
        <div class="card-body">
          <form>
            <div class="form-group">
              <div class="form-label-group">
                <input type="email" name="inputEmail" id="inputEmail" class="form-control" placeholder="Email address" required="required" autofocus="autofocus">
                <label for="inputEmail">Email address</label>
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                <input type="password" name="inputPassword" id="inputPassword" class="form-control" placeholder="Password" required="required">
                <label for="inputPassword">Password</label>
              </div>
            </div>
            
            <a class="btn btn-primary btn-block" href="#" id="btnlogin">Login</a>
          </form>
          <div class="text-center">
            <a class="d-block small mt-3" href="register.php">Register an Account</a>
            <a class="d-block small" href="forgot-password.php">Forgot Password?</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  </body>

</html>

<script type="text/javascript">
$(document).ready(function(){
	$("#btnlogin").click(function(){		
		var inputEmail = $("#inputEmail").val();
		var inputPassword = $("#inputPassword").val();
		
		// Returns successful login successful message when the entered information is checked in database.
		var dataString = 'inputEmail1='+ inputEmail + '&inputPassword1='+ inputPassword;
		if(inputEmail==''||inputPassword=='')
		{
			alert("Please Fill All Fields");
		}
		else
		{
			// AJAX Code To Submit Form.
			$.ajax({
				type: "POST",
				url: "login.php",
				data: dataString,
				cache: false,        
				success: function(result){	
            var result=$.trim(result);        
				    if(result=="success"){
						alert("Admin Login successful");
						window.location.href ='dashboard.php';
					}else{
						alert("Admin Login fail");
					}	
				}
			});
		}
		return false;
	});
});
</script>
