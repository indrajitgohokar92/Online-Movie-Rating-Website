<?php
	$firstname = $_POST["fname"];
	$lastname = $_POST["lname"];
	$dateofbirth = $_POST["dob"];
	$email = $_POST["email"];
	$username = $_POST["username"];
	$password = $_POST["password"];

	$dbcon = new mysqli("localhost", "root", "root", "moviedb");

	if(isset($firstname) && isset($lastname) && isset($dateofbirth) && isset($email) && isset($username) && isset($password)){

		$salt = bin2hex(random_bytes(8));	// generate new random select for every user who signs up

		$insertUnameNsalt_query = "insert into users(username, salt, is_admin) values('".$username."','".$salt."','n')";
		$resultUnameNsalt = mysqli_query($dbcon, $insertUnameNsalt_query) or die("Error inserting username and salt into db".mysqli_error($dbcon));

		$selectUseridNsalt_query = "select user_id, salt from users where username = '".$username."'";
		$resultUseridNsalt = mysqli_query($dbcon, $selectUseridNsalt_query) or die("Error getting user id and salt from db". mysqli_error($dbcon));

		$user_id = $saltFromDB = "";
		while($row = mysqli_fetch_assoc($resultUseridNsalt)){
			$user_id = $row['user_id'];
			$saltFromDB = $row['salt'];
		}

		$saltedPassword = $saltFromDB.$password;
		$hashedPassword = password_hash($saltedPassword, PASSWORD_DEFAULT);

		$updatePwd_query = "update users set password = '".$hashedPassword."' where username = '".$username."' and user_id = '".$user_id."'";
		// echo $updatePwd_query;
		$resultPwd = mysqli_query($dbcon, $updatePwd_query) or die("Error updating DB".mysqli_error($dbcon)); // store the results of $query

		$dateofbirth = date('Y-m-d', strtotime($dateofbirth));

		$insertDetails_query = "insert into user_details(user_id, fname, lname, email, dob) values ('".$user_id."', '".$firstname."', '".$lastname."', '".$email."','".$dateofbirth."')";
		$resultDetails = mysqli_query($dbcon, $insertDetails_query) or die("Error inserting data". mysqli_error($dbcon));

		mysqli_close($dbcon);
	}

	$port = $_SERVER['SERVER_PORT'];
	$locationUrl = "http://localhost:".$port."/login.php";
	header("Location:".$locationUrl); /* Redirect to login.php */
	exit();
?>
