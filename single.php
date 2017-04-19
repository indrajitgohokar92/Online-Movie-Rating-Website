<!DOCTYPE HTML>
<?php
//Step1
    session_start();
    $username = $_SESSION['username'];
    $userId = intval($_SESSION['user_id']);
    $adminLogin = $_SESSION['isAdmin'];
    $mov_id = $_GET['id'];

    $dbcon = new mysqli("localhost", "root", "root", "moviedb");

    $queryheading = "select avg_audience_rating,img_location from movies where movie_id='".$mov_id."';";
    $querymovie = "select movie_title,release_date,year_of_release,avg_critics_rating, country,age_restriction from movies where movie_id='".$mov_id."';";
    $querysynopsis = "select synopsis from movies where movie_id='".$mov_id."';";
    $queryactors = "select actor_name from actors,movies_actors where movies_actors.actor_id = actors.actor_id and movies_actors.movie_id='".$mov_id."';";
    $queryproducers = "select producer_name from producers,movies_producers where movies_producers.producer_id = producers.producer_id and movies_producers.movie_id='".$mov_id."';";
    $querydirectors = "select director_name from directors,movies_directors where movies_directors.director_id= directors.director_id and movies_directors.movie_id='".$mov_id."';";
    $querycategory = "select category_name from categories,movies_categories where movies_categories.category_id = categories.category_id and movies_categories.movie_id='".$mov_id."';";
    $queryComments = "select user_details.fname,comments.comment,comments.comment_timestamp from comments,user_details
                      where user_details.user_id=comments.user_id and comments.movie_id='".$mov_id."' order by comments.comment_timestamp ;";

    // var_dump($userId);
    if (isset($userId)){
        $queryRating = "select rating from ratings where user_id = ".$userId." and movie_id =".$mov_id.";";
        $queryWatchlist = "select * from users_watchlists where user_id = ".$userId." and movie_id =".$mov_id.";";
    } else {
        $queryRating = "select rating from ratings where movie_id =".$mov_id.";";
        $queryWatchlist = "select rating from ratings where movie_id =".$mov_id.";";
    }

    $resultheading = mysqli_query($dbcon,$queryheading) or die("Error getting heading from db". mysqli_error($dbcon));
    $resultmovie = mysqli_query($dbcon,$querymovie) or die("Error getting movie from db". mysqli_error($dbcon));
    $resultactors = mysqli_query($dbcon,$queryactors) or die("Error getting actors from db". mysqli_error($dbcon));
    $resultproducers = mysqli_query($dbcon,$queryproducers) or die("Error getting producers from db". mysqli_error($dbcon));
    $resultdirectors = mysqli_query($dbcon,$querydirectors) or die("Error getting directors from db". mysqli_error($dbcon));
    $resultcategory = mysqli_query($dbcon,$querycategory) or die("Error getting category from db". mysqli_error($dbcon));
    $resultsynopsis = mysqli_query($dbcon,$querysynopsis) or die("Error getting synopsis from db". mysqli_error($dbcon));
    $resultComments = mysqli_query($dbcon,$queryComments) or die("Error getting comments from db". mysqli_error($dbcon));

    $numOfComments = mysqli_num_rows($resultComments);
    // echo $queryRating;
    $resultRating = mysqli_query($dbcon, $queryRating) or die("Error getting rating from db". mysqli_error($dbcon));
    $resultWatchlist = mysqli_query($dbcon, $queryWatchlist) or die("Error getting watchlist from db". mysqli_error($dbcon));

    if(isset($userId)){
        while($row6 = mysqli_fetch_assoc($resultRating)){
            $yourRating = intval($row6['rating']);
        }
        if (mysqli_num_rows($resultWatchlist)!=0) {
          $checkWatchList=1;
        }else{
          $checkWatchList=0;
        }
    } else {
        $yourRating = "(Login to set)";
    }


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
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/ratingsNwatchlist.js"></script>
        	<script type="text/javascript" src="js/validatecomment.js"></script>
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
                        <div class="col-md-9 movie_box">
                            <div class="grid images_3_of_2">
                                <div class="movie_image">
                                    <?php
                                        while ($row1 = mysqli_fetch_array($resultheading)) {
                                            echo "<span class='movie_rating'>".$row1['avg_audience_rating']."</span>";
                                            echo "<img src='images/movie_posters/".$row1['img_location']."'class='img-responsive' alt=''/>";
                                        }
                                        ?>
                                </div>

                                <script>
                                    $(document).ready(function() {
                                        var movie_id ="<?php echo $mov_id; ?>";
                                        var username ="<?php echo $username; ?>";

                                        $('#movieRatingAdd').change(function() {
                                            movieRating = $('#movieRatingAdd').val();
                                            addMovieRating(movie_id, username, movieRating);
                                        });

                                        $('#watchlistAdd').change(function(event) {
                                            shouldAddToWatchlist = $('#watchlistAdd').prop('checked');
                                            addToWatchList(movie_id, username, shouldAddToWatchlist);
                                        });
                                    });
                                </script>
                                <?php
                                    // display only if user is not an admin
                                    if(isset($userId) and $adminLogin == 'n'){
                                        $rating_array = array(1, 2, 3 , 4, 5, 6, 7, 8, 9, 10);
                                        echo '<div class="movie_rate">
                                            <form id="user_ratings" action="" class="sky-form">
                                                <div class="rating_desc">
                                                    <p>Your Vote :</p>
                                                </div>
                                                <p>';
                                                echo'<select name="quicksearch" id="movieRatingAdd" class="quicksearch_dropdown navbarSprite">';
                                                if (isset($yourRating)) {
                                                  foreach($rating_array as $value) {
                                                      if ($value == $yourRating) { //if the province==the user's setting, make it default
                                                        echo '<option value="'.$value.'" selected="selected">'.$value.'</option>';
                                                      } else { //else, echo it as regular
                                                        echo '<option value="'.$value.'">'.$value.'</option>';
                                                      }
                                                  }
                                                }else{
                                                  echo '<option value="all" selected="selected">Your Rating</option>
                                                         <option value="1">1</option>
                                                         <option value="2">2</option>
                                                         <option value="3">3</option>
                                                         <option value="4">4</option>
                                                         <option value="5">5</option>
                                                         <option value="6">6</option>
                                                         <option value="7">7</option>
                                                         <option value="8">8</option>
                                                         <option value="9">9</option>
                                                         <option value="10">10</option>';
                                                }
                                                echo'</select>
                                                </p>
                                                <br/>
                                                <div class="rating_desc">';
                                                if ($checkWatchList == 1){
                                                  echo "<p>Remove from Watchlist :</p>";
                                                }
                                                else {
                                                  echo "<p>Add to Watchlist :</p>";
                                                }
                                                echo '</div>
                                                <p><input type="checkbox" name="watchlist" id="watchlistAdd" value="Add to WatchList"';
                                                if ($checkWatchList == 1) echo "checked='checked'";
                                                echo '></p>
                                            </form>
                                            <div class="clearfix"></div>
                                        </div>';
                                    }
                                ?>
                            </div>
                            <div class="desc1 span_3_of_2">
                                <?php
                                    while ($row2 = mysqli_fetch_array($resultmovie)) {
                                        echo "<p class='movie_option'><strong>Title: </strong>".$row2['movie_title']."</p>";
                                        echo "<p class='movie_option'><strong>Country: </strong>".$row2['country']."</p>";
                                        echo "<p class='movie_option'><strong>Release Date (Y-M-D): </strong>".$row2['release_date']."</p>";
                                        echo "<p class='movie_option'><strong>Year of Release: </strong>".$row2['year_of_release']."</p>";
                                        echo "<p class='movie_option'><strong>Average Critics Rating: </strong>".$row2['avg_critics_rating']."</p>";
                                        if(isset($userId) and $adminLogin == 'n'){
                                          if(isset($yourRating)){
                                            echo "<p class='movie_option'><strong>Your Rating: </strong>".$yourRating;
                                          }
                                          else{
                                            echo "<p class='movie_option'><strong>Your Rating: </strong>"."No Rating";
                                          }
                                        }
                                        echo "<p class='movie_option'><strong>Age Restriction: </strong>".$row2['age_restriction']."</p>";
                                    }
                                    ?>
                                <p class="movie_option"><strong>Actors: </strong>
                                    <?php
                                        $actors = array();
                                        while ($row3 = mysqli_fetch_array($resultactors)) {
                                            $actors[] = $row3['actor_name'];
                                        }
                                        echo "".implode(', ', $actors)."";
                                    ?>
                                </p>
                                <p class="movie_option"><strong>Directors: </strong>
                                    <?php
                                        $directors = array();
                                        while ($row3 = mysqli_fetch_array($resultdirectors)) {
                                            $directors[] = $row3['director_name'];
                                        }
                                        echo "".implode(', ', $directors)."";
                                        ?>
                                </p>
                                <p class="movie_option"><strong>Producers: </strong>
                                    <?php
                                        $producers = array();
                                        while ($row3 = mysqli_fetch_array($resultproducers)) {
                                            $producers[] = $row3['producer_name'];
                                        }
                                        echo "".implode(', ', $producers)."";
                                        ?>
                                <p class="movie_option"><strong>Categories: </strong>
                                    <?php
                                        $categories = array();
                                        while ($row3 = mysqli_fetch_array($resultcategory)) {
                                            $categories[] = ucfirst($row3['category_name']);
                                        }
                                        echo "".implode(', ', $categories)."";
                                        ?>
                                </p>
                            </div>
                            <div class="clearfix"> </div>
                            <p class="m_4"><strong>Synopsis: </strong>
                                <?php
                                    while ($row7 = mysqli_fetch_array($resultsynopsis)) {
                                        echo "".$row7['synopsis']."";
                                    }
                                    ?>
                            </p>
                            <?php
                              if (isset($_SESSION['user_id'])) {
                                echo '<form method="post" action="db/addcomment.php" id="commentform">
                                        <input type="hidden" name="user_id" id="user_id" value="'.$userId.'"/>
                                        <input type="hidden" name="movie_id" id="movie_id" value="'.$mov_id.'"/>
                                        <strong>Name: </strong><br/>
                                        <div class="to">
                                          <input type="text" class="text" value="';
                                          echo $_SESSION['firstname'];
                                          echo '" readonly>
                                        </div>
                                        <div class="clearfix"></div>
                                        <strong>Comment: </strong><br/>
                                        <div class="text">
                                            <textarea  name="comment" id="comment" value=""></textarea>
                                        </div>
                                        <div class="form-submit1">
                                            <input name="submit" type="submit" id="submit" value="Add Comment">
                                            <i id="commentformstatus"></i>
                                        </div>
                                        <div class="clearfix"></div>
                                      </form>';
                              }
                             ?>
                            <div class="single">
                              <?php
                              if(!($numOfComments)==0){
                                  if($numOfComments==1){ echo  '<h1>'.$numOfComments.' Comment</h1>';}
                                  else { echo  '<h1>'.$numOfComments.' Comments</h1>';}
                                  echo  '<ul class="single_list">';
                                        while ($row = mysqli_fetch_array($resultComments)) {
                                              $movie_user = $row['fname'];
                                              $movie_user_comment = $row['comment'];
                                              $timestamp1 = $row['comment_timestamp'];
                                              $timestamp = date("F j, Y, g:i a",strtotime($timestamp1));
                                              echo '<li>
                                                      <div class="preview"></div>
                                                      <div class="data">
                                                        <div class="title">'.$movie_user.' commented at '.$timestamp.'</div>
                                                          <p>'.$movie_user_comment.'</p>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                   </li>';
                                        }
                                  echo '</ul>';
                              } else{
                                 echo  '<h1>No Comments!</h1>';
                              }
                              ?>
                        </div>
                        </div>
                        <div class="col-md-3">
                            <p><strong>Featured Movies</strong></p>
                            <br />
                            <div class="movie_img">
                                <div class="grid_2">
                                    <a href="single.php?id=2"><img src="images/movie_posters/2.jpg" class="img-responsive" alt=""></a>
                                    <div class="caption1">
                                    </div>
                                </div>
                            </div>
                            <div class="grid_2 col_1">
                                <a href="single.php?id=3"><img src="images/movie_posters/3.jpg" class="img-responsive" alt=""></a>
                                <div class="caption1">
                                </div>
                            </div>
                            <div class="grid_2 col_1">
                                <a href="single.php?id=1"><img src="images/movie_posters/1.jpg" class="img-responsive" alt=""></a>
                                <div class="caption1">
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
