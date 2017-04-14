<?php
  define ('SITE_ROOT', realpath("C:/MAMP/htdocs"));
  ini_set('display_errors',1);
  error_reporting(E_ALL);
  $movieid = $_POST["movie_id"];
	$movietitle = $_POST["movietitle"];
	$releasedate = $_POST["releasedate"];
	$criticsrating = $_POST["criticsrating"];
	$releaseyear = $_POST["releaseyear"];
	$country = $_POST["country"];
	$agerestriction = $_POST["agerestriction"];
  $synopsis = $_POST["synopsis"];
  $audiencerating = $_POST["audiencerating"];
  $movie_image = $_FILES["movie_image"]["name"];

	$dbcon = new mysqli("localhost", "root", "root", "moviedb");

	if(isset($movietitle) && isset($releasedate) && isset($criticsrating) && isset($releaseyear) && isset($country) && isset($agerestriction)
  && isset($synopsis) && isset($audiencerating)){

    $releasedate = date('Y-m-d', strtotime($releasedate));


    //movie poster part

    echo $target_dir;
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
        //echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "jpeg") {
        echo "Sorry, only JPG, JPEG files are allowed.";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["movie_image"]["tmp_name"], $target_file)) {
            echo "The file ". basename( $_FILES["movie_image"]["name"]). " has been uploaded.";

            $updateMovie_query = "update movies set movie_title='".$movietitle."',release_date='".$releasedate."',
            avg_critics_rating='".$criticsrating."',year_of_release='".$releaseyear."',country='".$country."',
            age_restriction='".$agerestriction."',synopsis='".$synopsis."',avg_audience_rating='".$audiencerating."',
            img_location='".$movie_image."' where movie_id='".$movieid."';";

            $updateMovieResult = mysqli_query($dbcon, $updateMovie_query) or die("Error updating movie into db".mysqli_error($dbcon));

            mysqli_close($dbcon);
            $port = $_SERVER['SERVER_PORT'];
            $locationUrl = "http://localhost:".$port."/adminhome.php";
            header("Location:".$locationUrl); /* Redirect to login.php */
            exit();
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

	}
  else {
    echo "Variables not set";
    $port = $_SERVER['SERVER_PORT'];
    $locationUrl = "http://localhost:".$port."/index.php";
    header("Location:".$locationUrl); /* Redirect to login.php */
  }


?>
