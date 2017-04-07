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

		$insertUnameNsalt_query = "insert into users(username, salt) values('".$username."','".$salt."')";
		$resultUnameNsalt = mysqli_query($dbcon, $insertUnameNsalt_query) or die("Error inserting username and salt into db".mysqli_error($dbcon));

		$selectUseridNsalt_query = "select user_id, salt from users where username = ' ".$username."'";
		$resultUseridNsalt = mysqli_query($dbcon, $selectUseridNsalt_query) or die("Error getting user id and salt from db". mysqli_error($dbcon));

		// unable to retrieve user_id and salt


		// echo sizeof($resultUseridNsalt);
		//
		// while($row = mysqli_fetch_array($resultUseridNsalt)){
		// 	$user_id = $row['user_id'];
		// 	echo $user_id;
		// 	$saltFromDB = $row['salt'];
		// 	echo $saltFromDB;
		// }
		// print_r(array_values($row));
		//
		// echo $user_id;
		// echo $saltFromDB;
		//
		// $saltedPassword = $saltFromDB.$password;
		// echo $saltedPassword;











		// $insertUnameNpwd_query = "insert into users(username, password) values('".$username."','".$password."')";
		// $resultUnameNpwd = mysqli_query($dbcon, $insertUnameNpwd_query) or die("Error inserting into DB".mysqli_error($dbcon)); // store the results of $query
		//
		// $selectUserId_query = "select user_id from users where username = '".$username."' and password = '".$password."'";
		// $resultUserId = mysqli_query($dbcon, $selectUserId_query) or die("Error selecting from DB".mysqli_error($dbcon)); // store the results of $query
		//
		// while ($row = mysqli_fetch_array($resultUserId)) {
		// 	$user_id = $row['user_id'];
		// }
		//
		// $dateofbirth = date('Y-m-d', strtotime($dateofbirth));
		//
		// $insertDetails_query = "insert into user_details(user_id, fname, lname, email, dob) values ('".$user_id."', '".$firstname."', '".$lastname."', '".$email."','".$dateofbirth."')";
		// $resultDetails = mysqli_query($dbcon, $insertDetails_query) or die("Error inserting data". mysqli_error($dbcon));
	}

	// header("Location: http://localhost:8888/login.php"); /* Redirect to login.php */
	// exit();
?>
