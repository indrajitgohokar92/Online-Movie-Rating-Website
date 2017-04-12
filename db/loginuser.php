<?php
    session_start();
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
            $isAdminFromDB = $row['is_admin'];
		}

        $input_saltedPassword = $saltFromDB.$input_password;

        if (password_verify($input_saltedPassword, $passwordfromDB)) {

            $selectUserid = "select fname, lname from user_details where user_id = '".$user_idfromDB."'";
    		$resultUserid = mysqli_query($dbcon, $selectUserid) or die("Error getting user id and salt from db". mysqli_error($dbcon));

            while($row = mysqli_fetch_assoc($resultUserid)){
    			$fnamefromDB = $row['fname'];
                $lnameFromDB = $row['lname'];
    		}

            $_SESSION['user_id'] = $user_idfromDB;
            $_SESSION['username'] = $usernameFromDB;
            $_SESSION['firstname'] = $fnamefromDB;
            $_SESSION['lastname'] = $lnameFromDB;
            $_SESSION['isAdmin'] = $isAdminFromDB;

            $port = $_SERVER['SERVER_PORT'];
          	$locationUrl = "http://localhost:".$port."/index.php";
          	header("Location:".$locationUrl); /* Redirect to index.php */
        } else {
            echo ('<script> alert("Incorrect password!") </script>');
            $_SESSION['LoginError'] = 'Incorrect Username/Password!';
            $port = $_SERVER['SERVER_PORT'];
            $locationUrl = "http://localhost:".$port."/login.php";
            header("Location:".$locationUrl); /* Redirect to login.php */
            exit();
        }
    }
?>
