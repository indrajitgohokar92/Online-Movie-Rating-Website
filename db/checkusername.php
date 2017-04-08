<?php
    $dbcon = new mysqli("localhost", "root", "root", "moviedb");
    $username = $_POST['input_username'];

    $selectUsername_query = "select username from users where username = '".$username."'";
    $resultUsername = mysqli_query($dbcon, $selectUsername_query) or die("Error getting username from db". mysqli_error($dbcon));

    if(mysqli_num_rows($resultUsername) == 0){
        echo "not registered";
    } else {
        echo "already registered";
    }
?>
