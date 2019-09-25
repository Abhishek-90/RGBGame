<?php include('server.php')
	
	$query = "UPDATE users SET highest_score='$_GET['hscore']' WHERE username='$username' ";
	mysqli_query($db, $query);
?>