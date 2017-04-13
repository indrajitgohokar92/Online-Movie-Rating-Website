<?php
    $movieId = intval($_POST["movie_id"]);
    $username = $_POST["username"];
    $movieRating = intval($_POST["movieRating"]);

    $dbcon = new mysqli("localhost", "root", "root", "moviedb");

    $selectUsername_query = "select user_id from users where username = '".$username."'";
    $resultUsername = mysqli_query($dbcon, $selectUsername_query) or die("Error getting username from db". mysqli_error($dbcon));

    while($row = mysqli_fetch_assoc($resultUsername)){
        $userId = intval($row['user_id']);
    }

    $updateRatings_query = "replace into ratings(user_id, movie_id, rating) values(".$userId.",".$movieId.",".$movieRating.");";
    $resultRatings = mysqli_query($dbcon, $updateRatings_query) or die("Error updating rating into db". mysqli_error($dbcon));
?>
