<?php
	// $firstname = $_POST["fname"]
	// $lastname = $_POST["lname"]
	// $dateofbirth = $_POST["dob"]
	$username = $_POST["username"];
	$password = $_POST["password"];

	// echo $firstname;
	// echo $lastname;
	// echo $dateofbirth;
	echo $username;
	echo $password;

	// echo "<script>console.log('Your stuff here')</script>";
	echo "<script>console.log('.$username.')</script>";
	echo "<script>console.log('.$password.')</script>";

	// todo: not able to display output in console but go ahead and add values to db and see what comes there

	// $dbcon = new mysqli("localhost", "root", "root", "moviedb");

	// stored procs or just individual queries

?>
