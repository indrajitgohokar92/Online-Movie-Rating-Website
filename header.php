
<div class="col-sm-3 logo"><a href="index.php"><img src="images/logo.png" alt=""/></a></div>
<div class="col-sm-6 nav">
    <!-- <ul>
        <li> <span class="simptip-position-bottom simptip-movable" data-tooltip="comic"><a href="movie.php"> </a></span></li>
        <li><span class="simptip-position-bottom simptip-movable" data-tooltip="movie"><a href="movie.php"> </a> </span></li>
        <li><span class="simptip-position-bottom simptip-movable" data-tooltip="video"><a href="movie.php"> </a></span></li>
        <li><span class="simptip-position-bottom simptip-movable" data-tooltip="game"><a href="movie.php"> </a></span></li>
        <li><span class="simptip-position-bottom simptip-movable" data-tooltip="tv"><a href="movie.php"> </a></span></li>
        <li><span class="simptip-position-bottom simptip-movable" data-tooltip="more"><a href="movie.php"> </a></span></li>
    </ul> -->
    <div class="search">
        <form id="searchForm" method="post" action="db/searchmovies.php">
            <input type="text" name="searchterm" value="SearchMovies..." onfocus="this.value='';" onblur="if (this.value == '') {this.value ='';}">
            <select name="moviegenre" id="genre" class="quicksearch_dropdown navbarSprite">
            	<option value="all" selected="selected">All</option>
                <option value="action" >Action</option>
                <option value="adventure" >Adventure</option>
                <option value="comedy" >Comedy</option>
                <option value="crime" >Crime</option>
                <option value="drama" >Drama</option>
                <option value="horror" >Horror</option>
                <option value="romance" >Romance</option>
            </select>
            <input type="submit" value="">
        </form>
    </div>
</div>
<div class="col-sm-3 header_right">
    <ul class="header_right_box">
        <li><img src="images/navLogin1.png" alt=""/></li>
        <li class="last"><p><a href="login.php">Login</a></p></li>
        <!-- <li class="last"><i class="edit"> </i></li> -->
        <div class="clearfix"></div>
    </ul>
</div>
<div class="clearfix"></div>
