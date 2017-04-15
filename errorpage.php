<!DOCTYPE HTML>
<?php
session_start();
 ?>
<html>
<head>
	<title>movieDB</title>
	<link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="Movie_store" />
	<!-- <script type="application/x-javascript">
		 addEventListener("load", function() {
		 	setTimeout(hideURLbar, 0);
		 }, false);
		 function hideURLbar(){
		 	window.scrollTo(0,1);
		 }
	</script> -->
	<link href="css/bootstrap-datepicker.css" rel='stylesheet' type='text/css' />
	<!-- <link href="css/bootstrap.css" rel='stylesheet' type='text/css' /> -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
	<!-- start plugins -->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
	<!-- <script type="text/javascript" src="js/validate.js"></script> -->
	<script type="text/javascript" src="js/jquery.bootpag.min.js"></script>
	<link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:100,200,300,400,500,600,700,800,900' rel='stylesheet' type='text/css'>
</head>
<body>
		<div class="container">
				<div class="container_wrap">
					<div class="header_top">
						<?php include('header.php');?>
					</div>
					<div class="content">
						<div class="box_1">
						 <h1 class="m_2"><?php echo $_SESSION['Add_Movie_Error']; ?></h1>
						 <div class="clearfix"> </div>
						</div>
							<div id="page-content" class="well">
								<table class="table table-bordered table-striped">
									<tbody>
										<tr>
											<?php
				   								echo "<td><h4 class='m_2'>";
                          if (isset($_SESSION['Add_Movie_Error']))
  												{
  														echo $_SESSION['Add_Movie_Error'];
  														unset($_SESSION['Add_Movie_Error']);
  												}
                          echo "</h4></td>";
											?>
										</tr>
									</tbody>
								</table>
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
