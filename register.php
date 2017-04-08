<!DOCTYPE HTML>
<html>
<head>
	<title>Best Movie rating</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="Movie_store" />
	<script type="application/x-javascript">
		 addEventListener("load", function() {
		 	setTimeout(hideURLbar, 0);
		 }, false);
		 function hideURLbar(){
		 	window.scrollTo(0,1);
		 }
	</script>
	<link href="css/bootstrap-datepicker.css" rel='stylesheet' type='text/css' />
	<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
	<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
	<!-- start plugins -->
	<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="js/bootstrap-datepicker.js"></script>
	<script type="text/javascript" src="js/validate.js"></script>
	<link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:100,200,300,400,500,600,700,800,900' rel='stylesheet' type='text/css'>
	<script>
		$(function () {
			$('#dob').datepicker();
		});
	</script>
</head>
<body>
	<div class="container">
		<div class="container_wrap">
			<div class="header_top">
				<?php include('header.php');?>
			</div>
		      <div class="content">
	      	     <div class="register">
			  	  	<form action="db/adduser.php" method="post">
						<div class="register-top-grid">
							<h3>Personal Information</h3>
							 <div>
								<span>First Name<label>*</label></span>
								<input type="text" name="fname" id="fname">
							 </div>
							 <div>
								<span>Last Name<label>*</label></span>
								<input type="text" name="lname" id="lname">
							 </div>
							 <div>
								 <span>Email Address<label>*</label></span>
								 <input type="text" name="email" id="email">
							 </div>
							 <div>
								<span>Date of Birth<label>*</label></span>
		        				<input id="dob" size="16" name="dob" type="text"/>
		      				</div>
						</div>
						<div class="clearfix"> </div>
						<div class="register-bottom-grid">
						    <h3>Login Information</h3>
							 <div>
								<span>Username<label>*</label></span>
								<input type="text" name="username" id="username">
							 </div>
							 <div>
								<span>Password<label>*</label></span>
								<input type="password" name="password" id="password"/>
							 </div>
							 <div class="clearfix"> </div>
						</div>
				  		<div class="clearfix"> </div>
						<div class="register-but">
							<input type="submit" value="submit">
							<div class="clearfix"> </div>
						</div>
			  		</form>
			   </div>
	        </div>
	    </div>
	</div>
	<div class="container">
		<footer id="footer">
			<?php include('footer.php');?>
		</footer>
	</div>
</body>
</html>
