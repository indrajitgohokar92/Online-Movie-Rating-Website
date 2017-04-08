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
	<script type="text/javascript" src="js/jquery.bootpag.min.js"></script>
	<link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:100,200,300,400,500,600,700,800,900' rel='stylesheet' type='text/css'>
	<script typ>
	$(document).ready(function(){
		var myArray = JSON.parse(<?php echo json_encode($_SESSION['movie_array']); ?>);
		$('#page-selection').bootpag({
				total: myArray.length

		}).on("page", function(event, num){
			var myArray = JSON.parse(<?php echo json_encode($_SESSION['movie_array']); ?>);
			var html="<table>";
			for (i in myArray)
			{
				var imgloc = JSON.parse(JSON.stringify(myArray[i].movie_location));
				var loc="images/movie_posters/"+imgloc;
				html += "<tr><td><a href='single.php'><img src="+loc+" height='375' width='220' /></a></td></tr>";
			}
			html += "</table>";
			$("#content").html(html); // some ajax content loading...
		});
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
							<div id="content" align="center">

							</div>
					    <div id="page-selection" align="center"></div>
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
