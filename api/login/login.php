<?php
session_start();
// DB files
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'id15304214_projectweek';
$DATABASE_PASS = '%/[fWDDH4W25$i\Q';
$DATABASE_NAME = 'id15304214_users';
// Connecting to db
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ( mysqli_connect_errno() ) {
	// Error handling
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}


// preset the values to ""
$_SESSION['loggedin'] = false;
$_SESSION['name'] = "";
$_SESSION['id'] = "";


//prepairing the sql
if ($stmt = $con->prepare('SELECT id, password FROM users WHERE username = ?')) {
	// binding params
	$stmt->bind_param('s', $_POST['username']);
	$stmt->execute();
	// string the results
	$stmt->store_result();

	if ($stmt->num_rows > 0) {
		$stmt->bind_result($id, $password);
		$stmt->fetch();
		// there is an account
		if ($_POST['password'] === $password) {
			// password is correct
			// setting the sessions
			session_regenerate_id();
			$_SESSION['loggedin'] = TRUE;
			$_SESSION['name'] = $_POST['username'];
			$_SESSION['id'] = $id;
			header("Location: https://webdevelopmentlj1.000webhostapp.com/threads.php");
		} else {
			// Incorrect password
			echo 'Incorrect username and/or password!';
		}
	} else {
		// Incorrect username
		echo 'Incorrect username and/or password!';
	}

	$stmt->close();
}
?>