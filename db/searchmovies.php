<?php
$search_term = $_REQUEST['searchterm'];
$movie_category = $_REQUEST['moviegenre'];
$movie_category = strtolower($movie_category);

$dbcon = new mysqli("localhost", "root", "root", "moviedb");
// echo $search_term."<br>";
// echo $movie_category."<br>";
if(isset($search_term) && isset($movie_category)){
  if(($search_term == "SearchMovies...") && ($movie_category == "all")){
		$querymovie = "select movie_id, img_location from movies;";
	} elseif(($search_term == "SearchMovies...") && !($movie_category == "all")) {
    $querymovie = "select movies.movie_id, movies.img_location from movies,categories,movies_categories where
            movies.movie_id=movies_categories.movie_id and categories.category_id=movies_categories.category_id
            and categories.category_name='".$movie_category."';";
	} elseif(!($search_term == "SearchMovies...") && ($movie_category == "all")) {
    $querymovie = "select movies.movie_id, movies.img_location from movies,categories,movies_categories where
            movies.movie_id=movies_categories.movie_id and categories.category_id=movies_categories.category_id
            and movies.movie_title LIKE '%$search_term%';";
	} else {
    $querymovie = "select movies.movie_id, movies.img_location from movies,categories,movies_categories where
            movies.movie_id=movies_categories.movie_id and categories.category_id=movies_categories.category_id
            and categories.category_name='".$movie_category."' and movies.movie_title LIKE '%$search_term%';";
	}
  echo $querymovie;
  $result = mysqli_query($dbcon, $querymovie);
  $rows = array();
  if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result))
    {
      $movietitle = $row['movie_id'];
      $location = $row['img_location'];
      $rows[] = array("movie_title" => $movietitle, "movie_location" => $location,);
    }
    session_start();
    $_SESSION['movie_array'] = json_encode($rows);
    mysqli_close($dbcon);
  }
}
$port = $_SERVER['SERVER_PORT'];
$locationUrl = "http://localhost:".$port."/getmovies.php";
header("Location:".$locationUrl);
exit();
?>
