<!DOCTYPE HTML>
<?php
session_start();
?>
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
	<script type="text/javascript" src="js/jquery.twbsPagination.js"></script>
	<link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:100,200,300,400,500,600,700,800,900' rel='stylesheet' type='text/css'>
	<script>
	    $(document).ready(function(){

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
			<div id="page-content" class="well">
				<div class="center">
				  <div class="pagination">
				    <a href="#">1</a>
				    <a href="#" class="active">2</a>
				    <a href="#">3</a>
				    <a href="#">4</a>
				    <a href="#">5</a>
				    <a href="#">6</a>
				  </div>
				</div>
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
