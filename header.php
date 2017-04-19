<?php
    session_start();
    $username = $_SESSION['username'];
    $adminLogin = $_SESSION['isAdmin'];
?>
<div class="col-sm-2 logo"><a href="index.php"><img src="images/logo.png" alt=""/></a></div>
<div class="col-sm-5 ">
    <div class="search">
        <form id="searchForm" method="post" action="getmovies.php">
            <input type="text" name="searchterm" id="searchterm" value="Search Movies..." onfocus="this.value='';" onblur="if (this.value == '') {this.value ='';}">
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
<div class="col-sm-2 text-center">
    <ul class="header_right_box">
        <li class="last"><p>
            <?php
                echo $_SESSION['firstname']." ".$_SESSION['lastname'];
            ?>
        </p></li>
        <div class="clearfix"></div>
    </ul>
</div>
<div class="col-sm-1 text-center header_right">
    <ul class="header_right_box">
        <li><p>
<?php
if(isset($username) and $adminLogin == 'n'){
    echo '<a href="watchList.php"><span style="font-size:1.5em" class="glyphicon glyphicon-list"></span></a>';
}
if(isset($username) and $adminLogin == 'y'){
    echo '
    <li class="dropdown">
      <button type="button" class="dropdown-toggle" data-toggle="dropdown">
        <span class="glyphicon glyphicon-cog"><span class="caret"></span></span>
      </button>
      <ul class="dropdown-menu">
        <li><a href="adminhome.php">Admin Home</a></li>
        <li><a href="addmovie.php">Add New Movie</a></li>
        <li><a href="deletemovie.php">Delete Movie</a></li>
        <li><a href="updatemovies.php">Update Movie</a></li>
      </ul>
    </li>
    ';
}
?>
</p></li>
</ul>
</div>
<div class="col-sm-2 header_right">
    <ul class="header_right_box">
        <!-- <li><img src="images/navLogin1.png" alt=""/></li> -->
        <li><p>
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
