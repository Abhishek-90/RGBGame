<!DOCTYPE html>
<html>
<head>
	<title>Color Game</title>
	<link rel="stylesheet" type="text/css" href="colorGame.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
<h1>
	The Great 
	<br>
	<span id="colorDisplay">RGB</span> 
	<br>
	Color Game
</h1>

<div id="stripe">
	<button id="reset">New Colors</button>
	<span id="message"></span>
	<button class="mode">Easy</button>
	<button class="mode selected">Hard</button>
	<button name="logout" id="logout" style="float: right;"><a href="logout.php" style="text-decoration: none;">Log out</a></button> 
	<button id="scoreboard" style="float: left;"><a href="scrbrd.php" style="text-decoration: none;">Scoreboard</a></button>
</div>	

<div class="playerName" style="color: white; margin-top: 10px">
	Player:
	<span>
		<?php include('server.php');
			echo $_SESSION['username'];
		?>
	</span>
</div>

<div class="score" style="color: white;font-size: 2rem; margin-right: 25px; float: right" align="center">
	Score:
	<span id='score'>0</span>
</div>

<div class="HighScore" style="color: white; margin-top: 10px; font-size: 21px">
	High Score:
	<span id='highscore'>
		<?php include('server.php');
			echo implode(" ",$_SESSION['highestscore']);
		?>
	</span>
</div>

	<div id="container">
		<div class="square"></div>
		<div class="square"></div>
		<div class="square"></div>
		<div class="square"></div>
		<div class="square"></div>
		<div class="square"></div>
	</div>

<!-- <form action="logout.php" method="Post" name="updatehs">
	<input type="text" name="hscore" id="Hscore" style="display: none;"></input>
</form>
 -->
<script type="text/javascript" src="colorGame.js">
	document.getElementById('logout').onclick=function (){
		document.getElementById('updatehs').submit();
	}
</script>

</body>
</html>