<!DOCTYPE html>
<html>
<head>
	<title>ScoreBoard</title>
	<link rel="stylesheet" type="text/css" href="colorGame.css">
	<link rel="stylesheet" type="text/css" href="scrbrd.css">
	<!-- <style type="text/css">
		table {
			margin: auto;
		}
		h1 {
			text-align: center;
		}
	</style> -->
</head>
<body>
	<?php 
		include('server.php');
		$score = mysqli_query($db,"SELECT highest_score, username FROM users ORDER BY highest_score DESC LIMIT 3;");
	?>
	<div id="scrbrd" class='container'>
		<h2 style="font-size: 1.8rem; text-decoration: underline;">ScoreBoard</h2>
		<table>
			<tr>
				<th>Username</th>
				<th>Highest Score</th>
			</tr>
			<?php
				while($row=mysqli_fetch_assoc($score))
				{
			?>
			<tr>
					<td>
						<?php
					 		echo $row['username'];
						?>
					</td>
					
					<td>
						<?php
					 		echo $row['highest_score'];
						?>
					</td>		
			</tr>
			<?php } ?>
		</table>

		<button class="scoreboard" style="float: center; margin-top: 20px"><a href="colorGamenew.php" style="text-decoration: none;">Home</a></button> 

	</div>

	<div>
		
	</div>
	
</body>
</html>