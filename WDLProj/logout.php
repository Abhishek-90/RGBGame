<?php include('server.php');
	
	$highestscore=mysqli_real_escape_string($db,$_POST['hs']);
	$qry=mysqli_query($db,"UPDATE users set highest_score=$highestscore WHERE username=$username;");
	session_start();
	session_destroy();
	unset($_SESSION['username']);
	header("location: login.php");
?>