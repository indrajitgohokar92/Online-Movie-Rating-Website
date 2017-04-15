<!DOCTYPE HTML>
<?php
$mov_id = $_GET['id'];
$dbcon = new mysqli("localhost", "root", "root", "moviedb");

//queries to fetch movies
$movietitle_query = "select movie_title from movies where movie_id=".$mov_id.";";
$releasedate_query = "select release_date from movies where movie_id=".$mov_id.";";
$critics_query = "select avg_critics_rating from movies where movie_id=".$mov_id.";";
$releaseyear_query = "select year_of_release from movies where movie_id=".$mov_id.";";
$country_query = "select country from movies where movie_id=".$mov_id.";";
$age_query = "select age_restriction from movies where movie_id=".$mov_id.";";
$synopsis_query = "select synopsis from movies where movie_id=".$mov_id.";";
$audience_query = "select avg_audience_rating from movies where movie_id=".$mov_id.";";
$img_query = "select img_location from movies where movie_id=".$mov_id.";";


$movietitle_result = mysqli_query($dbcon, $movietitle_query);
while($row = mysqli_fetch_array($movietitle_result)){
  $movietitle = $row['movie_title'];
}
$critics_result = mysqli_query($dbcon, $critics_query);
while($row = mysqli_fetch_array($critics_result)){
  $avg_critics_rating = $row['avg_critics_rating'];
}
$releasedate_result = mysqli_query($dbcon, $releasedate_query);
while($row = mysqli_fetch_array($releasedate_result)){
  $release_date = $row['release_date'];
}
$critics_result = mysqli_query($dbcon, $critics_query);
while($row = mysqli_fetch_array($critics_result)){
  $movie_title = $row['movie_title'];
}
$releaseyear_result = mysqli_query($dbcon, $releaseyear_query);
while($row = mysqli_fetch_array($releaseyear_result)){
  $year_of_release = $row['year_of_release'];
}
$country_result = mysqli_query($dbcon, $country_query);
while($row = mysqli_fetch_array($country_result)){
  $country = $row['country'];
}
$age_result = mysqli_query($dbcon, $age_query);
while($row = mysqli_fetch_array($age_result)){
  $age_restriction = $row['age_restriction'];
}
$synopsis_result = mysqli_query($dbcon, $synopsis_query);
while($row = mysqli_fetch_array($synopsis_result)){
  $synopsis = $row['synopsis'];
}
$audience_result = mysqli_query($dbcon, $audience_query);
while($row = mysqli_fetch_array($audience_result)){
  $avg_audience_rating = $row['avg_audience_rating'];
}

$img_result = mysqli_query($dbcon, $img_query);
while($row = mysqli_fetch_array($img_result)){
  $img_location = $row['img_location'];
}

?>
<html>
<head>
    <title>Admin - update movie</title>
	<link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="Movie_store" />
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
  <script type="text/javascript" src="js/bootstrap-datepicker.js"></script>
  <script type="text/javascript" src="js/validateMovie.js"></script>
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
						 <h1 class="m_2">Update Movie</h1>
						 <div class="clearfix"> </div>
						</div>
              <div class="register">
                  <form id="movieform" action="db/changemovie.php" method="post" name="movieform"  enctype="multipart/form-data">
                      <div class="register-top-grid">
                          <input type="hidden" name="movie_id" id="movie_id" value="<?php echo htmlentities($mov_id); ?>"/>
                          <div>
                              <span>Movie Title<label>*</label></span>
                              <input type="text" name="movietitle" id="movietitle" value="<?php echo htmlentities($movietitle); ?>">
                          </div>
                          <div>
                              <span>Release Date<label>*</label></span>
                              <input id="releasedate" size="16" name="releasedate" type="text" value="<?php echo htmlentities($release_date); ?>">
                          </div>
                          <div>
                              <span>Average Critics Rating<label>*</label></span>
                              <input type="text" name="criticsrating" id="criticsrating" value="<?php echo htmlentities($avg_critics_rating); ?>">
                          </div>
                          <div>
                              <span>Year of Release<label>*</label></span>
                              <input id="releaseyear" size="16" name="releaseyear" type="text" value="<?php echo htmlentities($year_of_release); ?>">
                          </div>
                          <div>
                              <span>Country<label>*</label></span>
                              <input type="text" name="country" id="country" value="<?php echo htmlentities($country); ?>">
                          </div>
                          <div>
                              <span>Age Restriction<label>*</label></span>
                              <input type="text" name="agerestriction" id="agerestriction" value="<?php echo htmlentities($age_restriction); ?>">
                          </div>
                          <div>
                              <span>Synopsis<label>*</label></span>
                              <textarea name="synopsis" id="synopsis" rows="5" cols="80"><?php echo htmlspecialchars($synopsis); ?></textarea>
                          </div>
                          <div>
                              <span>Average Audience Rating<label>*</label></span>
                              <input type="text" name="audiencerating" id="audiencerating" value="<?php echo htmlentities($avg_audience_rating); ?>">
                          </div>
                          <div>
                              <span>Upload Movie Poster<label>*</label></span>
                              <input type="file" name="movie_image" id="movie_image" value="<?php echo htmlentities($img_location); ?>">
                          </div>
                          <div class="clearfix"> </div>
                      </div>
                      <div class="clearfix"> </div>
                      <input class="acount-btn" type="submit" value="Update Movie">
                      <i id="movieformstatus"></i>
                      <div class="clearfix"> </div>
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
