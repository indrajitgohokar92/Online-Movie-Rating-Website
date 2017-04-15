<?php
  $userId = intval($_POST["user_id"]);
  $movieId = intval($_POST["movie_id"]);
  $comment = $_POST["comment"];
  $datetime = date("Y-m-d H:i:s");
  echo $datetime;
  $dbcon = new mysqli("localhost", "root", "root", "moviedb");
  $insertComment_query = "insert into comments(movie_id, user_id, comment,comment_timestamp) values('".$movieId."','".$userId."','".$comment."','".$datetime."')";
  echo$insertComment_query;
  $resultInsertComment = mysqli_query($dbcon, $insertComment_query) or die("Error inserting comment into db".mysqli_error($dbcon));
  mysqli_close($dbcon);
  $port = $_SERVER['SERVER_PORT'];
  $link="/single.php?id=".$movieId;
  $locationUrl = "http://localhost:".$port.$link;
  header("Location:".$locationUrl); /* Redirect to login.php */
  exit();
 ?>
