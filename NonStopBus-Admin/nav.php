<?php
	session_start();
	if(!isset($_SESSION["admin"]))
		header("Location: index.php");
	
	include_once('db.php'); 
?>
<nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="dashboard.php">Welcome <?php echo $_SESSION["admin"];?> to Online Non-Stop Bus Ticket Generation System</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-left">
                        <li>
                            <a href="dashboard.php" class="dropdown-toggle" data-toggle="dropdown">
                               <p class="hidden-lg hidden-md">Dashboard</p>
                            </a>
                        </li>
                     </ul>
                      <ul class="nav navbar-nav navbar-right">  
                        <li>
                            <a href="logout.php">
                                <p>Log out</p>
                            </a>
                        </li>
						<li class="separator hidden-lg"></li>
                    </ul>
                </div>
            </div>
        </nav>
