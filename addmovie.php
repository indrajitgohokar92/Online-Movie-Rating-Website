<!DOCTYPE HTML>
<?php
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
                  <form id="movieform" action="" method="post" name="movieform">
                      <div class="register-top-grid">
                          <div>
                              <span>Movie Title<label>*</label></span>
                              <input type="text" name="movietitle" id="movietitle">
                          </div>
                          <div>
                              <span>Release Date<label>*</label></span>
                              <input id="releasedate" size="16" name="releasedate" type="text"/>
                          </div>                          <div>
                              <span>Average Critics Rating(1-10)<label>*</label></span>
                              <input type="text" name="criticsrating" id="criticsrating" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                          </div>
                          <div>
                              <span>Year of Release<label>*</label></span>
                              <input id="releaseyear" size="16" name="releaseyear" type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57"/>
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
                              <span>Average Audience Rating(1-10)<label>*</label></span>
                              <input type="text" name="audiencerating" id="audiencerating" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
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
