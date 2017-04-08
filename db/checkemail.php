<?php
    $dbcon = new mysqli("localhost", "root", "root", "moviedb");
    $emailadd = $_POST['input_email'];

    $selectUserEmail_query = "select email from user_details where email = '".$emailadd."'";
    $resultUserEmail = mysqli_query($dbcon, $selectUserEmail_query) or die("Error getting email from db". mysqli_error($dbcon));

    if(mysqli_num_rows($resultUserEmail) == 0){
        echo "not registered";
    } else {
        echo "already registered";
    }
?>
