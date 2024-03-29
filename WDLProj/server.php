<?php
	// session_start();
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

	// variable declaration
	$username = "";
	$email    = "";
	$errors = array();
	$_SESSION['success'] = "";

	// connect to database
	$db = mysqli_connect('localhost', 'root', '', 'rgbgame');

	// REGISTER USER
	if (isset($_POST['reg_user'])) {
		// receive all input values from the form
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$email = mysqli_real_escape_string($db, $_POST['email']);
		$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
		$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

		// form validation: ensure that the form is correctly filled
		if (empty($username)) { array_push($errors, "Username is required"); }
		if (empty($email)) { array_push($errors, "Email is required"); }
		if (empty($password_1)) { array_push($errors, "Password is required"); }

		if ($password_1 != $password_2) {
			array_push($errors, "Passwords do not match");
		}

		//Check db for existing user with same username
		$user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
		$result = mysqli_query($db, $user_check_query);
		$user = mysqli_fetch_assoc($result);

		if($user)	{

			if($user['username'] === $username)	{
				array_push($errors, "Username already exists");
			}

			if($user['email'] === $email)	{
				array_push($errors, "This Email id already has a registered username");
			}
		}


		// register user if there are no errors in the form
		if (count($errors) == 0) {
			$highestscore = 0;
			$password = md5($password_1);//encrypt the password before saving in the database
			$query = "INSERT INTO users (username, email, password, highest_score)
					  VALUES('$username', '$email', '$password', '$highestscore')";
			mysqli_query($db, $query);

			$_SESSION['username'] = $username;
			$_SESSION['success'] = "You are now logged in";
			header('location: Login.php');
		}

	}

	// LOGIN USER
	if (isset($_POST['login_user'])) {
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$password = mysqli_real_escape_string($db, $_POST['password']);

		if (empty($username)) {
			array_push($errors, "Username is required");
		}
		if (empty($password)) {
			array_push($errors, "Password is required");
		}

		if (count($errors) == 0) {
			$password = md5($password);
			$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
			$results = mysqli_query($db, $query);

			if (mysqli_num_rows($results) == 1) {
				$_SESSION['username'] = $username;
				$hscore = mysqli_query($db,"SELECT highest_score FROM users WHERE username='$username';");
				$_SESSION['highestscore'] = mysqli_fetch_assoc($hscore);
				
				$_SESSION['success'] = "You are now logged in";
				header('location: colorGamenew.php');

			}
			else {
				array_push($errors, "Wrong username/password combination. Please try again");
			}
		}
	}
?>