<?php
  session_start();
  ini_set('display_errors',1);
  error_reporting(E_ALL);
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
  $movie_actor = $_POST["movie_actor"];
  $movie_director = $_POST["movie_director"];
  $movie_producer = $_POST["movie_producer"];
  $movie_category = $_POST["movie_category"];
  $movie_image = $_FILES["movie_image"]["name"];

	$dbcon = new mysqli("localhost", "root", "root", "moviedb");

	if(isset($movietitle) && isset($releasedate) && isset($criticsrating) && isset($releaseyear) && isset($country) && isset($agerestriction)
  && isset($synopsis) && isset($audiencerating) && isset($movie_actor) && isset($movie_director) && isset($movie_producer) && isset($movie_category)){

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
      $_SESSION['Add_Movie_Error'] = $movie_error;
      $port = $_SERVER['SERVER_PORT'];
      $locationUrl = "http://localhost:".$port."/addmovie.php";
      header("Location:".$locationUrl); /* Redirect to login.php */
      exit();
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["movie_image"]["tmp_name"], $target_file)) {
            echo "The file ". basename( $_FILES["movie_image"]["name"]). " has been uploaded.";


            $insertMovie_query = "insert into movies(movie_title, release_date, avg_critics_rating, year_of_release, country, age_restriction, synopsis, avg_audience_rating, is_deleted, img_location)
            values('".$movietitle."','".$releasedate."','".$criticsrating."','".$releaseyear."','".$country."','".$agerestriction."',
            '".$synopsis."','".$audiencerating."','n','".$movie_image."')";
            $resultMovie = mysqli_query($dbcon, $insertMovie_query);
            if(!$resultMovie){
              $movie_error = 'Synopsis cannot contain special characters!';
              $_SESSION['Add_Movie_Error'] = $movie_error;
              $port = $_SERVER['SERVER_PORT'];
              $locationUrl = "http://localhost:".$port."/addmovie.php";
              header("Location:".$locationUrl); /* Redirect to login.php */
              exit();
            }

            //get inserted movie_id
            $selectMovie_query = "select movie_id from movies where movie_title = '".$movietitle."'";
            $resultSelectMovie = mysqli_query($dbcon, $selectMovie_query) or die("Error getting movie id from db". mysqli_error($dbcon));
            while($row = mysqli_fetch_assoc($resultSelectMovie)){
              $movie_id = $row['movie_id'];
            }
            echo "MovieId:".$movie_id;
            echo "ActorNAme:".$movie_actor;
            //get actor id
            $selectActor_query = "select actor_id from actors where actor_name = '".$movie_actor."'";
            $resultSelectActor = mysqli_query($dbcon, $selectActor_query) or die("Error getting actor id from db". mysqli_error($dbcon));
            while($row = mysqli_fetch_assoc($resultSelectActor)){
              $actor_id = $row['actor_id'];
            }
            echo "ActorId:".$actor_id;

            //insert actor for that movie_id
            $insertMovieActor_query = "insert into movies_actors(movie_id,actor_id) values ('".$movie_id."','".$actor_id."')";
            echo $insertMovieActor_query;
            $resultMovieActor = mysqli_query($dbcon, $insertMovieActor_query) or die("Error inserting actor id". mysqli_error($dbcon));

            //get director id
            $selectDirector_query = "select director_id from directors where director_name = '".$movie_director."'";
            $resultSelectDirector = mysqli_query($dbcon, $selectDirector_query) or die("Error getting director id from db". mysqli_error($dbcon));
            while($row = mysqli_fetch_assoc($resultSelectDirector)){
              $director_id = $row['director_id'];
            }

            //insert director for that movie_id
            $insertMovieDirector_query = "insert into movies_directors(movie_id,director_id) values ('".$movie_id."','".$director_id."')";
            $resultMovieDirector = mysqli_query($dbcon, $insertMovieDirector_query) or die("Error inserting director_id". mysqli_error($dbcon));


            //get producer_id
            $selectProducer_query = "select producer_id from producers where producer_name = '".$movie_producer."'";
            $resultSelectProducer = mysqli_query($dbcon, $selectProducer_query) or die("Error getting producer_id from db". mysqli_error($dbcon));
            while($row = mysqli_fetch_assoc($resultSelectProducer)){
              $producer_id = $row['producer_id'];
            }

            //insert producer for that movie_id
            $insertMovieProducer_query = "insert into movies_producers(movie_id,producer_id) values ('".$movie_id."','".$producer_id."')";
            $resultMovieProducer = mysqli_query($dbcon, $insertMovieProducer_query) or die("Error inserting producer_id". mysqli_error($dbcon));

            //get category_id
            $selectCategory_query = "select category_id from categories where category_name = '".$movie_category."'";
            $resultSelectCategory = mysqli_query($dbcon, $selectCategory_query) or die("Error getting category_id from db". mysqli_error($dbcon));
            while($row = mysqli_fetch_assoc($resultSelectCategory)){
              $category_id = $row['category_id'];
            }

            //insert category_id for that movie_id
            $insertMovieCategory_query = "insert into movies_categories(movie_id,category_id) values ('".$movie_id."','".$category_id."')";
            $resultMovieCategory = mysqli_query($dbcon, $insertMovieCategory_query) or die("Error inserting category id". mysqli_error($dbcon));
            mysqli_close($dbcon);
            $port = $_SERVER['SERVER_PORT'];
            $locationUrl = "http://localhost:".$port."/adminhome.php";
            header("Location:".$locationUrl); /* Redirect to login.php */
            exit();
        } else {
            // echo "Sorry, there was an error uploading your file.";
            $movie_error = 'Sorry, your file was not uploaded!';
            $_SESSION['Add_Movie_Error'] = $movie_error;
            $port = $_SERVER['SERVER_PORT'];
            $locationUrl = "http://localhost:".$port."/addmovie.php";
            header("Location:".$locationUrl); /* Redirect to login.php */
            exit();
        }
    }

	}
  else {
    $movie_error = 'Variables not set!';
    $_SESSION['Add_Movie_Error'] = $movie_error;
    $port = $_SERVER['SERVER_PORT'];
    $locationUrl = "http://localhost:".$port."/addmovie.php";
    header("Location:".$locationUrl); /* Redirect to login.php */
    exit();
  }


?>
