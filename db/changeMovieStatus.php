<?php
    $movieId = intval($_POST["movie_id"]);
    $isdeleted = $_POST[$movieId];
    echo $movietitle;
    echo $isdeleted;
    if(isset($movieId) && isset($isdeleted)){
      $dbcon = new mysqli("localhost", "root", "root", "moviedb");
      $updateMovieStatus_query = "update movies set is_deleted='".$isdeleted."' where movie_id='".$movieId."'";
      $resultupdateMovieStatus = mysqli_query($dbcon, $updateMovieStatus_query) or die("Error updating movie". mysqli_error($dbcon));
      mysqli_close($dbcon);
      $port = $_SERVER['SERVER_PORT'];
      $locationUrl = "http://localhost:".$port."/deletemovie.php";
      header("Location:".$locationUrl); /* Redirect to login.php */
      exit();
    }
    else {
      $port = $_SERVER['SERVER_PORT'];
      $locationUrl = "http://localhost:".$port."/deletemovie.php";
      header("Location:".$locationUrl); /* Redirect to login.php */
    }
 ?>
