<?php
    session_start();
    if(!isset($_SESSION['user_id'])){ //if login in session is not set
    		$port = $_SERVER['SERVER_PORT'];
    		$locationUrl = "http://localhost:".$port."/index.php";
    		header("Location:".$locationUrl);
    }
    $username = $_SESSION['username'];
    $adminLogin = $_SESSION['isAdmin'];

    $dbcon = new mysqli("localhost", "root", "root", "moviedb");
    $queryUserId = "select user_id from users where username = '".$username."'";
    $resultUserId = mysqli_query($dbcon, $queryUserId) or die("Error getting user id from db". mysqli_error($dbcon));
    while($row = mysqli_fetch_assoc($resultUserId)){
        $userId = $row['user_id'];
    }

    $queryMovieId = "select movie_id from users_watchlists where user_id = ".$userId.";";
    $resultMovieIds = mysqli_query($dbcon, $queryMovieId) or die("Error getting movie ids from db". mysqli_error($dbcon));
    $row_cnt = mysqli_num_rows($resultMovieIds);
?>
<html>
    <head>
        <title>movieDB</title>
    	<link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="keywords" content="Movie_store Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
        <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
        <!-- start plugins -->
        <script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
        <script type="text/javascript" src="js/ratingsNwatchlist.js"></script>
        <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:100,200,300,400,500,600,700,800,900' rel='stylesheet' type='text/css'>
    </head>
    <body>
        <div class="container">
            <div class="container_wrap">
                <div class="header_top">
                    <?php include('header.php');?>
                </div>
                <div class="content">
                    <div class="movie_top">
                        <div class="col-md-9">
                            <div class="col-sm-12">
                                <h1 class="m_2">Your Watch List</h1>
                                <br>
                                <br>
                                <ul>
                                    <?php
                                      if($row_cnt>0){
                                        while($rowMovie = mysqli_fetch_assoc($resultMovieIds)){
                                            $movieId = $rowMovie['movie_id'];
                                            // echo $userId;
                                            echo "<br/>";
                                            $queryMovie = "select movie_title from movies where movie_id = ".$movieId.";";
                                            $resultMovie = mysqli_query($dbcon, $queryMovie) or die("Error getting movie from db". mysqli_error($dbcon));
                                            $oneMovie = mysqli_fetch_assoc($resultMovie);
                                            $movieName = $oneMovie['movie_title'];
                                            echo '<h3><a href='.'"single.php?id='.$movieId.'"><li>'.$movieName.'</li></a></h3>';
                                        }
                                      } else {
                                        echo '<h4 class="m_2">No movies in your Watchlist!</h4>';
                                      }
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <p><strong>Featured Movies</strong></p>
                            <br/>
                            <div class="movie_img">
                                <div class="grid_2">
                                    <a href="single.php?id=2"><img src="images/movie_posters/2.jpg" class="img-responsive" alt=""></a>
                                    <div class="caption1">
                                        <i class="icon4 icon6 icon7"> </i>
                                    </div>
                                </div>
                            </div>
                            <div class="grid_2 col_1">
                                <a href="single.php?id=3"><img src="images/movie_posters/3.jpg" class="img-responsive" alt=""></a>
                                <div class="caption1">
                                    <i class="icon4 icon7"> </i>
                                </div>
                            </div>
                            <div class="grid_2 col_1">
                                <a href="single.php?id=1"><img src="images/movie_posters/1.jpg" class="img-responsive" alt=""></a>
                                <div class="caption1">
                                    <i class="icon4 icon7"> </i>
                                </div>
                            </div>
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
