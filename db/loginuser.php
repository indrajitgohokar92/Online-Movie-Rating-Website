<?php

    $input_username = $_POST["input_username"];
    $input_password = $_POST["input_password"];

    $dbcon = new mysqli("localhost", "root", "root", "moviedb");
    if(isset($input_username) && isset($input_password)){

        $selectUser = "select * from users where username = '".$input_username."'";
		$resultUseridNsalt = mysqli_query($dbcon, $selectUser) or die("Error getting user id and salt from db". mysqli_error($dbcon));

        $user_idfromDB = $user_idfromDB = $saltFromDB = "";
		while($row = mysqli_fetch_assoc($resultUseridNsalt)){
			$user_idfromDB = $row['user_id'];
            $usernameFromDB = $row['username'];
            $saltFromDB = $row['salt'];
            $passwordfromDB = $row['password'];
		}

        $input_saltedPassword = $saltFromDB.$input_password;

        if (password_verify($input_saltedPassword, $passwordfromDB)) {
            session_start();            // session_start should be at start of the page

            $selectUserid = "select fname, lname from user_details where user_id = '".$user_idfromDB."'";
    		$resultUserid = mysqli_query($dbcon, $selectUserid) or die("Error getting user id and salt from db". mysqli_error($dbcon));

            while($row = mysqli_fetch_assoc($resultUserid)){
    			$fnamefromDB = $row['fname'];
                $lnameFromDB = $row['lname'];
    		}

            $_SESSION['loggedIn'] = True;	              // sign in the user upon successful authentication and store in session variable
			      $_SESSION['username'] = $usernameFromDB;	    // store other neccessary data as session variable
            $_SESSION['firstname'] = $fnamefromDB;
            $_SESSION['lastname'] = $lnameFromDB;
            $port = $_SERVER['SERVER_PORT'];
          	$locationUrl = "http://localhost:".$port."/index.php";
          	header("Location:".$locationUrl); /* Redirect to login.php */
        } else {
          echo ('<script> alert("Incorrect password!") </script>');
          $port = $_SERVER['SERVER_PORT'];
        	$locationUrl = "http://localhost:".$port."/login.php";
        	header("Location:".$locationUrl); /* Redirect to login.php */
        	exit();
        }
    }
?>
