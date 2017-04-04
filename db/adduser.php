<?php
	$firstname = $_POST["fname"];
	$lastname = $_POST["lname"];
	$dateofbirth = $_POST["dob"];
	$email = $_POST["email"];
	$username = $_POST["username"];
	$password = $_POST["password"];

	$dbcon = new mysqli("localhost", "root", "root", "moviedb");

	if(isset($firstname) && isset($lastname) && isset($dateofbirth) && isset($email) && isset($username) && isset($password)){

		$insertUnameNpwd_query = "insert into users(username, password) values('".$username."','".$password."')";
		$resultUnameNpwd = mysqli_query($dbcon, $insertUnameNpwd_query) or die("Error inserting into DB".mysqli_error($dbcon)); // store the results of $query

		$selectUserId_query = "select user_id from users where username = '".$username."' and password = '".$password."'";
		$resultUserId = mysqli_query($dbcon, $selectUserId_query) or die("Error selecting from DB".mysqli_error($dbcon)); // store the results of $query

		while ($row = mysqli_fetch_array($resultUserId)) {
			$user_id = $row['user_id'];
		}

		$dateofbirth = date('Y-m-d', strtotime($dateofbirth));

		$insertDetails_query = "insert into user_details(user_id, fname, lname, email, dob) values ('".$user_id."', '".$firstname."', '".$lastname."', '".$email."','".$dateofbirth."')";
		$resultDetails = mysqli_query($dbcon, $insertDetails_query) or die("Error inserting data". mysqli_error($dbcon));
	}

	// header("Location: http://localhost:8888/login.php"); /* Redirect to login.php */
	// exit();
?>
