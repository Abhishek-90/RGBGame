var numSquares = 6;
var colors = [];
var pickedColor;
var max_try = 3;
var score;
var hscore;
var count = 0;

var squares = document.querySelectorAll(".square");
var colorDisplay = document.getElementById("colorDisplay");
var messageDisplay = document.querySelector("#message");
var h1 = document.querySelector("h1");
var resetButton = document.querySelector("#reset");
var modeButtons = document.querySelectorAll(".mode");

init();

function init(){
	setupModeButtons();
	setupSquares();
	reset();
}

function setupModeButtons(){
	for(var i = 0; i < modeButtons.length; i++){
		modeButtons[i].addEventListener("click", function(){
			modeButtons[0].classList.remove("selected");
			modeButtons[1].classList.remove("selected");
			this.classList.add("selected");
			this.textContent === "Easy" ? numSquares = 3: numSquares = 6;
			
			reset();
		});
	}
}

function setupSquares(){
	for(var i = 0; i < squares.length; i++){
	//add click listeners to squares
		squares[i].addEventListener("click", function(){
			//grab color of clicked square
			var clickedColor = this.style.background;
			//compare color to pickedColor
			if(clickedColor === pickedColor){
				messageDisplay.textContent = "Correct!";
				resetButton.textContent = "Play Again?"
				changeColors(clickedColor);
				h1.style.background = clickedColor;

				//score updation on getting the right color
				score=document.getElementById('score').textContent;
				score=parseInt(score);
				score=score+1;
				document.getElementById('score').innerHTML=score;
				document.getElementById('score').style.color=clickedColor;

				hscore=document.getElementById('highscore').textContent;
				hscore=parseInt(hscore);

				if(hscore<score){
					hscore=score;
					document.getElementById('highscore').innerHTML=score;
					document.getElementById('highscore').style.color=clickedColor;
					hscore=Number(hscore);
					// document.getElementById('Hscore').textContent=hscore;
					updateHS();
				}

			} else {
				this.style.background = "#232323";
				messageDisplay.textContent = "Try Again"
				max_try -= 1;
			}

			if(max_try === 0)    {				
                    messageDisplay.textContent = "You failed!";
					resetButton.textContent = "Try Again?"
					changeColors(clickedColor);
					h1.style.background = clickedColor;
					score = 0;
					document.getElementById('score').innerHTML=score;
               }

		});
	}
}

function updateHS(){
	$.post("logout.php",
	{
		hs:hscore,
	})
}
function reset(){
	colors = generateRandomColors(numSquares);
	//pick a new random color from array
	pickedColor = pickColor();
	//change colorDisplay to match picked Color
	colorDisplay.textContent = pickedColor;
	resetButton.textContent = "New Colors";
	messageDisplay.textContent = "";
	count = 0;
	//change colors of squares
	for(var i = 0; i < squares.length; i++){
		if(colors[i]){
			squares[i].style.display = "block"
			squares[i].style.background = colors[i];
		} else {
			squares[i].style.display = "none";
			count +=1;
		}
	}
	count === 3? max_try = 2:max_try=3;
	h1.style.background = "steelblue";
}

resetButton.addEventListener("click", function(){
	reset();
})

function changeColors(color){
	//loop through all squares
	for(var i = 0; i < squares.length; i++){
		//change each color to match given color
		squares[i].style.background = color;
	}
}

function pickColor(){
	var random = Math.floor(Math.random() * colors.length);
	return colors[random];
}

function generateRandomColors(num){
	//make an array
	var arr = []
	//repeat num times
	for(var i = 0; i < num; i++){
		//get random color and push into arr
		arr.push(randomColor())
	}
	//return that array
	return arr;
}

function randomColor(){
	//pick a "red" from 0 - 255
	var r = Math.floor(Math.random() * 256);
	//pick a "green" from  0 -255
	var g = Math.floor(Math.random() * 256);
	//pick a "blue" from  0 -255
	var b = Math.floor(Math.random() * 256);
	return "rgb(" + r + ", " + g + ", " + b + ")";
}
