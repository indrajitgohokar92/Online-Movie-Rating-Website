<!DOCTYPE HTML>
<?php
$dbcon = new mysqli("localhost", "root", "root", "moviedb");
$queryactors = "select actor_id,actor_name from actors;";
$querydirectors = "select director_id,director_name from directors;";
$queryproducers = "select producer_id,producer_name from producers;";
$querycategory = "select category_id,category_name from categories;";
$actor_result = mysqli_query($dbcon, $queryactors);
$director_result = mysqli_query($dbcon,$querydirectors);
$producer_result = mysqli_query($dbcon,$queryproducers);
$category_result = mysqli_query($dbcon,$querycategory);
$row = mysqli_fetch_row($paging_result);
?>
<html>
<head>
	<title>Admin - Add Movie</title>
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
						 <h1 class="m_2">Add Movie</h1>
						 <div class="clearfix"> </div>
						</div>
              <div class="register">
                  <form id="movieform" action="db/insertmovie.php" method="post" name="movieform"  enctype="multipart/form-data">
                      <div class="register-top-grid">
                          <div>
                              <span>Movie Title<label>*</label></span>
                              <input type="text" name="movietitle" id="movietitle">
                          </div>
                          <div>
                              <span>Release Date<label>*</label></span>
                              <input id="releasedate" size="16" name="releasedate" type="text">
                          </div>
                          <div>
                              <span>Average Critics Rating<label>*</label></span>
                              <input type="text" name="criticsrating" id="criticsrating">
                          </div>
                          <div>
                              <span>Year of Release<label>*</label></span>
                              <input id="releaseyear" size="16" name="releaseyear" type="text">
                          </div>
                          <div>
                              <span>Country<label>*</label></span>
                              <input type="text" name="country" id="country">
                          </div>
                          <div>
                              <span>Age Restriction<label>*</label></span>
                              <input type="text" name="agerestriction" id="agerestriction">
                          </div>
                          <div>
                              <span>Synopsis<label>*</label></span>
                              <textarea name="synopsis" id="synopsis" rows="5" cols="80"></textarea>
                          </div>
                          <div>
                              <span>Average Audience Rating<label>*</label></span>
                              <input type="text" name="audiencerating" id="audiencerating">
                          </div>
                          <div>
                              <span>Actor<label>*</label></span>
                              <select name="movie_actor">
                                <option value="-1" selected>Select</option>
                                <?php
        													while ($row = mysqli_fetch_array($actor_result)) {

                                  echo '<option value="'.$row['actor_name'].'">'.$row['actor_name'].'</option>';
        													}
          											?>
                              </select>
                          </div>
                          <div>
                              <span>Director<label>*</label></span>
                              <select name="movie_director">
                                <option value="-1" selected>Select</option>
                                <?php
        													while ($row = mysqli_fetch_array($director_result)) {
                                  echo '<option value="'.$row['director_name'].'">'.$row['director_name'].'</option>';
        													}
          											?>
                              </select>
                          </div>
                          <div>
                              <span>Producer<label>*</label></span>
                              <select name="movie_producer">
                                <option value="-1" selected>Select</option>
                                <?php
        													while ($row = mysqli_fetch_array($producer_result)) {
                                  echo '<option value="'.$row['producer_name'].'">'.$row['producer_name'].'</option>';
        													}
          											?>
                              </select>
                          </div>
                          <div>
                              <span>Category<label>*</label></span>
                              <select name="movie_category">
                                <option value="Select" selected>Select</option>
                                <?php
        													while ($row = mysqli_fetch_array($category_result)) {
                                  echo '<option value="'.$row['category_name'].'">'.$row['category_name'].'</option>';
        													}
          											?>
                              </select>
                          </div>
                          <div>
                              <span>Upload Movie Poster<label>*</label></span>
                              <input type="file" name="movie_image" id="movie_image">
                          </div>
                          <div class="clearfix"> </div>
                      </div>
                      <div class="clearfix"> </div>
                      <input class="acount-btn" type="submit" value="Add Movie">
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
