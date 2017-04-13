<!DOCTYPE HTML>
<?php
//Step1
    session_start();
    $username = $_SESSION['username'];
    $adminLogin = $_SESSION['isAdmin'];

    $dbcon = new mysqli("localhost", "root", "root", "moviedb");
    $mov_id = $_GET['id'];
    $queryheading = "select avg_audience_rating,img_location from movies where movie_id='".$mov_id."';";
    $querymovie = "select movie_title,release_date,year_of_release,avg_critics_rating, country,age_restriction from movies where movie_id='".$mov_id."';";
    $querysynopsis = "select synopsis from movies where movie_id='".$mov_id."';";
    $queryactors = "select actor_name from actors,movies_actors where movies_actors.actor_id = actors.actor_id and movies_actors.movie_id='".$mov_id."';";
    $queryproducers = "select producer_name from producers,movies_producers where movies_producers.producer_id = producers.producer_id and movies_producers.movie_id='".$mov_id."';";
    $querydirectors = "select director_name from directors,movies_directors where movies_directors.director_id= directors.director_id and movies_directors.movie_id='".$mov_id."';";
    $querycategory = "select category_name from categories,movies_categories where movies_categories.category_id = categories.category_id and movies_categories.movie_id='".$mov_id."';";

    $queryUserId = "select user_id from users where username = '".$username."'";
    $resultUserId = mysqli_query($dbcon, $queryUserId) or die("Error getting user id from db". mysqli_error($dbcon));

    while($row5 = mysqli_fetch_assoc($resultUserId)){
        $userId = intval($row5['user_id']);
    }
    // var_dump($userId);
    if (isset($userId)){
        $queryRating = "select rating from ratings where user_id = ".$userId." and movie_id =".$mov_id.";";
    } else {
        $queryRating = "select rating from ratings where movie_id =".$mov_id.";";
    }
    // echo $queryRating;
    $resultRating = mysqli_query($dbcon, $queryRating) or die("Error getting rating from db". mysqli_error($dbcon));

    if(isset($userId)){
        while($row6 = mysqli_fetch_assoc($resultRating)){
            $yourRating = intval($row6['rating']);
        }
    } else {
        $yourRating = "(Login to set)";
    }

    $resultheading = mysqli_query($dbcon,$queryheading);
    $resultmovie = mysqli_query($dbcon,$querymovie);
    $resultactors = mysqli_query($dbcon,$queryactors);
    $resultproducers = mysqli_query($dbcon,$queryproducers);
    $resultdirectors = mysqli_query($dbcon,$querydirectors);
    $resultcategory = mysqli_query($dbcon,$querycategory);
    $resultsynopsis = mysqli_query($dbcon,$querysynopsis);
?>
<html>
    <head>
        <title>Best Movie rating</title>
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
                                    if(isset($username) and $adminLogin == 'n'){
                                        echo '<div class="movie_rate">
                                            <form id="user_ratings" action="" class="sky-form">
                                                <div class="rating_desc">
                                                    <p>Your Vote :</p>
                                                </div>
                                                <p>
                                                    <select name="quicksearch" id="movieRatingAdd" class="quicksearch_dropdown navbarSprite">
                                                        <option value="all" selected="selected">Your Rating</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                        <option value="9">9</option>
                                                        <option value="10">10</option>
                                                    </select>
                                                </p>
                                                <br/>
                                                <div class="rating_desc">
                                                    <p>Add to Watchlist :</p>
                                                </div>
                                                <p><input type="checkbox" name="watchlist" id="watchlistAdd" value="Add to WatchList"></p>
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
                                        echo "<p class='movie_option'><strong>Your Rating: </strong>".$yourRating;
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
                            <form method="post" action="contact-post.html">
                                <div class="to">
                                    <input type="text" class="text" value="<?php if (isset($_SESSION["firstname"])) {
                                        echo $_SESSION['firstname'];
                                        } else {
                                        echo 'Name';
                                        } ?>" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Name';}">
                                    <input type="text" class="text" value="Email" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email';}" style="margin-left:3%">
                                </div>
                                <div class="text">
                                    <textarea value="Message:" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Message';}">Message:</textarea>
                                </div>
                                <div class="form-submit1">
                                    <input name="submit" type="submit" id="submit" value="Submit Your Message"><br>
                                </div>
                                <div class="clearfix"></div>
                            </form>
                            <div class="single">
                                <h1>10 Comments</h1>
                                <ul class="single_list">
                                    <li>
                                        <div class="preview"><a href="#"><img src="images/2.jpg" class="img-responsive" alt=""></a></div>
                                        <div class="data">
                                            <div class="title">Movie  /  2 hours ago  /  <a href="#">reply</a></div>
                                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
                                        </div>
                                        <div class="clearfix"></div>
                                    </li>
                                    <li>
                                        <div class="preview"><a href="#"><img src="images/3.jpg" class="img-responsive" alt=""></a></div>
                                        <div class="data">
                                            <div class="title">Wernay  /  2 hours ago  /  <a href="#">reply</a></div>
                                            <p>Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent </p>
                                        </div>
                                        <div class="clearfix"></div>
                                    </li>
                                    <li>
                                        <div class="preview"><a href="#"><img src="images/4.jpg" class="img-responsive" alt=""></a></div>
                                        <div class="data">
                                            <div class="title">mr.dev  /  2 hours ago  /  <a href="#">reply</a></div>
                                            <p>Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum clari, fiant sollemnes in futurum. qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram,</p>
                                        </div>
                                        <div class="clearfix"></div>
                                    </li>
                                    <li class="middle">
                                        <div class="preview"><a href="#"><img src="images/5.jpg" class="img-responsive" alt=""></a></div>
                                        <div class="data-middle">
                                            <div class="title">Wernay  /  2 hours ago  /  <a href="#">reply</a></div>
                                            <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
                                        </div>
                                        <div class="clearfix"></div>
                                    </li>
                                    <li class="last-comment">
                                        <div class="preview"><a href="#"><img src="images/6.jpg" class="img-responsive" alt=""></a></div>
                                        <div class="data-last">
                                            <div class="title">mr.dev  /  2 hours ago  /  <a href="#">reply</a></div>
                                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit </p>
                                        </div>
                                        <div class="clearfix"></div>
                                    </li>
                                    <li>
                                        <div class="preview"><a href="#"><img src="images/7.jpg" class="img-responsive" alt=""></a></div>
                                        <div class="data">
                                            <div class="title">denpro  /  2 hours ago  /  <a href="#">reply</a></div>
                                            <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
                                        </div>
                                        <div class="clearfix"></div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <p><strong>Featured Movies</strong></p>
                            <br />
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
