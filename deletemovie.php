<!DOCTYPE HTML>
<?php
session_start();
if(!isset($_SESSION['user_id'])){ //if login in session is not set
		$port = $_SERVER['SERVER_PORT'];
		$locationUrl = "http://localhost:".$port."/index.php";
		header("Location:".$locationUrl);
}
$dbcon = new mysqli("localhost", "root", "root", "moviedb");

$limit = 3;
if (isset($_GET["page"])) {
	 $page  = $_GET["page"];
 } else {
	 $page=1;
 };
$start_from = ($page-1) * $limit;
if(isset($_SESSION["admin_movie"]) && isset($_SESSION["admin_paging_sql"])){
  $qmovie = $_SESSION["admin_movie"];
  $pagingsql = $_SESSION["admin_paging_sql"];
  $querymovie =  $qmovie."$start_from, $limit;";
}else{
	$qmovie = "select movies.movie_id, movies.movie_title, img_location from movies order by movies.movie_title LIMIT ";
	$querymovie =  $qmovie."$start_from, $limit;";
	$pagingsql = "select COUNT(movie_id) FROM movies;";
	$_SESSION["admin_movie"]=$qmovie;
	$_SESSION["admin_paging_sql"]=$pagingsql;
}
$movieresult = mysqli_query($dbcon, $querymovie);
$paging_result = mysqli_query($dbcon,$pagingsql);
$row = mysqli_fetch_row($paging_result);
$total_records = $row[0];
$total_pages = ceil($total_records / $limit);

?>
<html>
<head>
	<title>Admin - Delete movie</title>
	<link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
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
						 <h1 class="m_2">Delete/Restore Movies</h1>
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
														$link="single.php?id=".$id;
														echo "<td><a href=".$link."><img src=".$loc." height='300' width='220' /></a>";
														echo "<br /><h3><a href=".$link.">".$title."</a></h3>";
                            $isDeletedSql = "select is_deleted FROM movies where movie_id=".$id.";";
                            $isDeletedResult = mysqli_query($dbcon, $isDeletedSql);

                            while($row = mysqli_fetch_array($isDeletedResult)) {
                              $isdeleted1 = $row['is_deleted'];
                              if($isdeleted1 == 'n'){
                                $deletedVar1 = 'Available';
                                $deletedVar2 = 'Delete';
                                $isdeleted2 = 'y';
                                $submitValue = 'Delete Movie';
                              }
                              else{
                                $deletedVar1 = 'Deleted';
                                $deletedVar2 = 'Add';
                                $isdeleted2 = 'n';
                                $submitValue = 'Add Movie';
                              }
                              echo '<form class="deletemovieform'.$id.'" action="db/changeMovieStatus.php" method="post">';
															echo '<input type="hidden" name="movie_id" value="'.$id.'"/>';
                              echo '<br /><input type="radio" name="'.$id.'" value='.$isdeleted1.' checked="checked"/> '.$deletedVar1.'<br />';
                              echo '<br /><input type="radio" name="'.$id.'" value='.$isdeleted2.' /> '.$deletedVar2.'<br />';
                              echo '<input class="acount-btn" type="submit" value="'.$submitValue.'" />
                                   </form></td>';
                            }
													}
												}
											?>
										</tr>
									</tbody>
								</table>
								<?php
									$pagLink = "<div class='pagination' align='justify'>";
									for ($i=1; $i<=$total_pages; $i++) {
										 $pagLink .= "<a href='/deletemovie.php?page=".$i."'>".$i."</a>";
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
