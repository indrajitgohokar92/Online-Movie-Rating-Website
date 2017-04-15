<?php
  session_start();
  $movieid = $_POST["movie_id"];
	$movietitle = $_POST["movietitle"];
	$releasedate = $_POST["releasedate"];
	$criticsrating = $_POST["criticsrating"];
	$releaseyear = $_POST["releaseyear"];
	$country = $_POST["country"];
	$agerestriction = $_POST["agerestriction"];

  $synopsis_temp1 = str_replace('"', "", $_POST["synopsis"]);
  $synopsis_temp2 = str_replace("'", "", $synopsis_temp1);
  $synopsis = $synopsis_temp2;
  
  $audiencerating = $_POST["audiencerating"];
  $movie_image = $_FILES["movie_image"]["name"];

	$dbcon = new mysqli("localhost", "root", "root", "moviedb");

	if(isset($movietitle) && isset($releasedate) && isset($criticsrating) && isset($releaseyear) && isset($country) && isset($agerestriction)
  && isset($synopsis) && isset($audiencerating)){

    $releasedate = date('Y-m-d', strtotime($releasedate));


    //movie poster part
    $target_dir = "../images/movie_posters/";
    $target_file = $target_dir . basename($_FILES["movie_image"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    echo "target_file: ".$target_file."\n";
    // Check if image file is a actual image or fake image
    echo "\n";
    echo "imageFileType: ".$imageFileType."\n";
    // Check if image file is a actual image or fake image
    if($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
        $movie_error= 'File is not an image!';
    }


    // Check if file already exists
    if (file_exists($target_file)) {
        unlink($target_file);
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "jpeg") {
        $uploadOk = 0;
        $movie_error = 'Sorry, only JPG, JPEG files are allowed!';
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
      $_SESSION['Update_Movie_Error'] = $movie_error;
      $port = $_SERVER['SERVER_PORT'];
      $locationUrl = "http://localhost:".$port."/updatemovie.php";
      header("Location:".$locationUrl); /* Redirect to login.php */
      exit();
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["movie_image"]["tmp_name"], $target_file)) {
            echo "The file ". basename( $_FILES["movie_image"]["name"]). " has been uploaded.";

            $updateMovie_query = "update movies set movie_title='".$movietitle."',release_date='".$releasedate."',
            avg_critics_rating='".$criticsrating."',year_of_release='".$releaseyear."',country='".$country."',
            age_restriction='".$agerestriction."',synopsis='".$synopsis."',avg_audience_rating='".$audiencerating."',
            img_location='".$movie_image."' where movie_id='".$movieid."';";

            $updateMovieResult = mysqli_query($dbcon, $updateMovie_query);
            if(!$updateMovieResult){
              $movie_error = 'Synopsis cannot contain special characters!';
              $_SESSION['Update_Movie_Error'] = $movie_error;
              $port = $_SERVER['SERVER_PORT'];
              $locationUrl = "http://localhost:".$port."/updatemovie.php";
              header("Location:".$locationUrl); /* Redirect to login.php */
              exit();
            }

            mysqli_close($dbcon);
            $port = $_SERVER['SERVER_PORT'];
            $locationUrl = "http://localhost:".$port."/adminhome.php";
            header("Location:".$locationUrl); /* Redirect to login.php */
            exit();
        } else {
          $movie_error = 'Sorry, your file was not uploaded!';
          $_SESSION['Update_Movie_Error'] = $movie_error;
          $port = $_SERVER['SERVER_PORT'];
          $locationUrl = "http://localhost:".$port."/updatemovie.php";
          header("Location:".$locationUrl); /* Redirect to login.php */
          exit();
        }
    }

	}
  else {
    $movie_error = 'Variables not set!';
    $_SESSION['Update_Movie_Error'] = $movie_error;
    $port = $_SERVER['SERVER_PORT'];
    $locationUrl = "http://localhost:".$port."/updatemovie.php";
    header("Location:".$locationUrl); /* Redirect to login.php */
    exit();
  }


?>
