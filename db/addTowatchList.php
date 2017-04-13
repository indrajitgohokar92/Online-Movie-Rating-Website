<?php
    $movieId = intval($_POST["movie_id"]);
    $username = $_POST["username"];
    $shouldAddToWatchlist = $_POST["shouldAddToWatchlist"];

    $dbcon = new mysqli("localhost", "root", "root", "moviedb");

    $selectUsername_query = "select user_id from users where username = '".$username."'";
    $resultUsername = mysqli_query($dbcon, $selectUsername_query) or die("Error getting username from db". mysqli_error($dbcon));

    while($row = mysqli_fetch_assoc($resultUsername)){
        $userId = intval($row['user_id']);
    }

    if($shouldAddToWatchlist == "true"){
        $updateWatchlist_query = "replace into users_watchlists(user_id, movie_id) values(".$userId.",".$movieId.");";
        $resultRatings = mysqli_query($dbcon, $updateWatchlist_query) or die("Error updating rating into db". mysqli_error($dbcon));
    } elseif ($shouldAddToWatchlist == "false") {
        $deleteWatchlist_query = "delete from users_watchlists where (user_id = ".$userId." and movie_id =".$movieId.");";
        $resultRatings = mysqli_query($dbcon, $deleteWatchlist_query) or die("Error updating rating into db". mysqli_error($dbcon));
    }
?>
