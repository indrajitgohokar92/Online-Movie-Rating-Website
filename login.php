<!DOCTYPE HTML>
<html>
<head>
<title>Best Movie rating</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="Movie_store Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
	<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
	<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
	<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
	<!-- start plugins -->
	<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="js/validatelogin.js"></script>
	<link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:100,200,300,400,500,600,700,800,900' rel='stylesheet' type='text/css'>
</head>
<body>
	<div class="container">
		<div class="container_wrap">
			<div class="header_top">
				<?php include('header.php');?>
			</div>
			<div class="content">
				<div class="register">
					<div class="col-md-6 login-left">
						<h3>New Customers</h3>
						<p>By creating an account with our store, you will be able to move through the checkout process faster, store multiple shipping addresses, view and track your orders in your account and more.</p>
						<a class="acount-btn" href="register.php">Create an Account</a>
					</div>
					<div class="col-md-6 login-right">
						<h3>Registered Customers</h3>
						<p>If you have an account with us, please log in.</p>
						<form action="db/loginuser.php" method="post">
							<div>
								<span>Username<label>*</label></span>
								<input type="text" name="input_username" id="input_username">
							</div>
							<div>
					  		<span>Password<label>*</label></span>
					  		<input type="password" name="input_password" id="input_password">
							</div>
							<input class="acount-btn" type="submit" value="Login">
							<i id="formstatus">
								<?php if (isset($_SESSION['LoginError']))
								{
    							echo $_SESSION['LoginError'];
    							unset($_SESSION['LoginError']);
								}
								?>
							</i>
						</form>
					</div>
					<div class="clearfix"> </div>
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
