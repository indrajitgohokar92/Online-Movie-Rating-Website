<!DOCTYPE HTML>
<?php
session_start();

$dbcon = new mysqli("localhost", "root", "root", "moviedb");

$limit = 3;
if (isset($_GET["page"])) {
	 $page  = $_GET["page"];
 } else {
	 $page=1;
 };
$start_from = ($page-1) * $limit;
if(isset($_SESSION["admin_update_movie"]) && isset($_SESSION["admin_update_paging_sql"])){
  $qmovie = $_SESSION["admin_update_movie"];
  $pagingsql = $_SESSION["admin_update_paging_sql"];
  $querymovie =  $qmovie."$start_from, $limit;";
}else{
	$qmovie = "select movie_id, movies.movie_title, img_location from movies LIMIT ";
	$querymovie =  $qmovie."$start_from, $limit;";
	$pagingsql = "select COUNT(movie_id) FROM movies;";
	$_SESSION["admin_update_movie"]=$qmovie;
	$_SESSION["admin_update_paging_sql"]=$pagingsql;
}
$movieresult = mysqli_query($dbcon, $querymovie);
$paging_result = mysqli_query($dbcon,$pagingsql);
$row = mysqli_fetch_row($paging_result);
$total_records = $row[0];
$total_pages = ceil($total_records / $limit);

?>
<html>
<head>
	<title>Best Movie rating</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="Movie_store" />
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="js/bootstrap-datepicker.js"></script>
	<script type="application/x-javascript">
		 addEventListener("load", function() {
		 	setTimeout(hideURLbar, 0);
		 }, false);
		 function hideURLbar(){
		 	window.scrollTo(0,1);
		 }
	</script>
	<link href="css/bootstrap-datepicker.css" rel='stylesheet' type='text/css' />
	<!-- <link href="css/bootstrap.css" rel='stylesheet' type='text/css' /> -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
	<!-- start plugins -->
	<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="js/bootstrap-datepicker.js"></script>
	<script type="text/javascript" src="js/validate.js"></script>
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
						 <h1 class="m_2">Update Movies</h1>
						 <div class="clearfix"> </div>
						</div>
							<div id="page-content" class="well">
								<table class="table table-bordered table-striped">
									<tbody>
										<tr>
											<?php
												if(mysqli_num_rows($movieresult)== 0){
				   								echo "<td><h4 class='m_2'>No Results!</h4></td>";
												}else{
													while ($row = mysqli_fetch_array($movieresult)) {
														$imgloc = $row["img_location"];
														$id= $row["movie_id"];
														$title=$row["movie_title"];
														$loc="images/movie_posters/".$imgloc;
														$link="updatemovie.php?id=".$id;
														echo "<td><a href=".$link."><img src=".$loc." height='300' width='220' /></a>";
														echo "<br /><h3><a href=".$link.">".$title."</a></h3></td>";
													}
												}
											?>
										</tr>
									</tbody>
								</table>
								<?php
									$pagLink = "<div class='pagination' align='justify'>";
									for ($i=1; $i<=$total_pages; $i++) {
										 $pagLink .= "<a href='/updatemovies.php?page=".$i."'>".$i."</a>";
									};
									echo $pagLink."</div>";
								?>
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
