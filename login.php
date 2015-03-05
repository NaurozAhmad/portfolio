<?php 
   include("Connections/Connection.php");
	if(isset($_POST['logged'])) {
		echo $_POST['log_user'];
		mysql_select_db($database_connection, $connection);
		$query_users = "SELECT * FROM login_stuff WHERE u_name= '{$_POST['log_user']}' AND u_pass = '{$_POST['log_pass']}'";
		$users = mysql_query($query_users, $connection) or die(mysql_error());
		
		
	

		if(($totalRows_users = mysql_num_rows($users)) > 0) {
			header("Location: add_work.php");
		}
		else{
			header("Location: login_failed.php");
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Portfolio Login</title>

	<link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/respond.js"></script>
    <link rel="stylesheet" href="menu/rmm-css/responsivemobilemenu.css" type="text/css"/>
    <link href="css/scrolling-nav.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/custom.css">
    <link href="css/slider.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/ddmenu.css">
    <script type="text/javascript" src="js/ddmenu.js"></script>
    
    <link href='http://fonts.googleapis.com/css?family=Exo+2|Oxygen|Alegreya+Sans+SC|Raleway:200|Poiret+One|Courgette' rel='stylesheet' type='text/css'>

</head>
<body>

	<div class="banner">
    	<div class="row">
    		<h1 class="cust-banner-h1">Login</h1>
    	</div>
    </div>
    <div class="container">
    	<div class="cust-our-div">
            <h1 class="cust-work cust-our-h1"></h1>

        </div>

        <form class="form-horizontal myform" role="form" id="login_form" method="post" action="login.php">
		  <div class="form-group">
		    <label for="username" class="col-sm-2 control-label col-sm-offset-2">Username</label>
		    <div class="col-sm-5">
		      <input type="text" class="form-control" id="log_user" name="log_user" placeholder="Username">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="password" class="col-sm-2 control-label col-sm-offset-2">Password</label>
		    <div class="col-sm-5">
		      <input type="password" class="form-control" id="log_pass" name="log_pass" placeholder="Password">
		    </div>
		  </div>
		  
		  <div class="form-group">
		    <div class="col-sm-offset-3 col-sm-6">
		    	<input type="hidden" id="logged" name="logged" value="logged">
		    	<button type="submit" class="btn btn-default btn-block">Sign in</button>
		    </div>
		  </div>
		</form>


    </div>

    <?php require_once('footer.php') ?>
	<script src="js/jquery-1.11.0.js"></script>
	<script src="js/bootstrap.min.js"></script>

	<?php mysqli_close($link); ?>
</body>
</html>