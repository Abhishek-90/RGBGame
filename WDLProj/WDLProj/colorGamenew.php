<!DOCTYPE html>
<html>
<head>
	<title>Color Game</title>
	<link rel="stylesheet" type="text/css" href="colorGame.css">
	
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
	<button id="Logout" style="float: right;" onclick="formSubmit()"><a href="login.php" style="text-decoration: none;">Log out</a></button>
</div>	
	
<div class="playerName" style="color: white; margin-top: 10px">
	Player:
	<span>
		<?php include('server.php');
			echo $_SESSION['username'];
		?>
	</span>
</div>

<div class="HighScore" style="color: white; margin-top: 10px">
	Highest Score:
	<span id='highscore'>
		<?php include('server.php');
			echo implode(" ",$_SESSION['highestscore']);
		?>
	</span>
</div>

<div class="score" style="color: red;font-size: 30px; margin-right: 25px; float: right" align="center">
	Score:
	<span id='score'>0</span>
</div>

	<div id="container">
		<div class="square"></div>
		<div class="square"></div>
		<div class="square"></div>
		<div class="square"></div>
		<div class="square"></div>
		<div class="square"></div>
	</div>

<form action="logout.php" method="Post" id='updateHS'>
	<input type="text" name="hscore" id="Hscore" style="display: none;"></input>
</form>

<script type="text/javascript" src="colorGame.js"></script>

</body>
</html>