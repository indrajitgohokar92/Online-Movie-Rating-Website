<?php
    session_start();
    $dbcon = new mysqli("localhost", "root", "root", "moviedb");
    $username = $_SESSION['username'];
    $usertypequery = "select is_admin from users where username=".$username.";";
    $usertyperesult = mysqli_query($dbcon,$usertypequery);
    while($row1 = mysqli_fetch_array($usertyperesult))
    {
      //get the user type here and get tabs based on that type
      echo $row1['is_admin'];
    }
?>
<div class="col-sm-2 logo"><a href="index.php"><img src="images/logo.png" alt=""/></a></div>
<div class="col-sm-5 nav">
    <div class="search">
        <form id="searchForm" method="post" action="getmovies.php">
            <input type="text" name="searchterm" value="Search Movies..." onfocus="this.value='';" onblur="if (this.value == '') {this.value ='';}">
            <select name="moviegenre" id="genre" class="quicksearch_dropdown navbarSprite">
            	<option value="all" selected="selected">All</option>
                <option value="action">Action</option>
                <option value="adventure">Adventure</option>
                <option value="comedy">Comedy</option>
                <option value="crime">Crime</option>
                <option value="drama">Drama</option>
                <option value="horror">Horror</option>
                <option value="romance">Romance</option>
            </select>
            <input type="submit" value="">
        </form>
    </div>
</div>
<div class="col-sm-2 header_right">
    <ul class="header_right_box">
        <li class="last"><p>
            <?php
                // if(isset($_SESSION["loggedIn"]) and $_SESSION["loggedIn"] == 1){
                //     echo $_SESSION["firstname"];
                // }
                echo $_SESSION['firstname']." ".$_SESSION['lastname'];
            ?>
        </p></li>
        <div class="clearfix"></div>
    </ul>
</div>
<div class="col-sm-1 nav">
<?php
if(isset($_SESSION["username"])){
    echo '<ul>
          <!-- <li> <span class="simptip-position-bottom simptip-movable" data-tooltip="comic"><a href="movie.php"> </a></span></li> -->
          <!-- <li><span class="simptip-position-bottom simptip-movable" data-tooltip="movie"><a href="movie.php"> </a> </span></li> -->
          <li><span class="simptip-position-bottom simptip-movable" data-tooltip="Wishlist"><a href="movie.php"> </a></span></li>
          <!-- <li><span class="simptip-position-bottom simptip-movable" data-tooltip="game"><a href="movie.php"> </a></span></li> -->
          <!-- <li><span class="simptip-position-bottom simptip-movable" data-tooltip="tv"><a href="movie.php"> </a></span></li> -->
          <!-- <li><span class="simptip-position-bottom simptip-movable" data-tooltip="more"><a href="movie.php"> </a></span></li> -->
          </ul>';
}
?>
</div>
<div class="col-sm-2 header_right">
    <ul class="header_right_box">
        <!-- <li><img src="images/navLogin1.png" alt=""/></li> -->
        <li class="last"><p>
            <?php
                if(!isset($_SESSION["firstname"])){
                    echo '<a href="login.php">';
                    echo 'Login</a>';
                }
                if(isset($_SESSION["firstname"])){
                    echo '<a href="logout.php">';
                    echo "Logout</a>";
                }
            ?>
        </p></li>
        <div class="clearfix"></div>
    </ul>
</div>
<div class="clearfix"></div>
