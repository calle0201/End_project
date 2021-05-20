const WINNING_SCORE = 3;
var canvas;
var ctx;

//class OOP for the player paddels
class players {
  constructor(paddle, playerScore) {
    this.paddle = 250;
    this.PADDLE_HEIGHT = 100;
    this.PADDLE_THICKNESS = 10;
    this.playerScore = 0;

  }


}
//OOP stuff for the game logic
class gameInfo {
  constructor() {
    this.showingWinScreen = false;
    this.ballx = 50;
    this.bally = 50;
    this.ballspeedx = 10;
    this.ballspeedy = 4;
  }
}
//making var arrays with the logic and player paddles
var game = new gameInfo();
var player1 = new players();
var player2 = new players();

window.onload = () => { //only loads once the site is finnished loading
  //finds the canvas by the id
  canvas = document.getElementById('gamecanvas');
  ctx = canvas.getContext('2d');

  //makes the canvas black
  ctx.fillStyle = 'black';
  ctx.fillRect(0, 0, canvas.width, canvas.height);


  //function to see if you pressed the mouse
  canvas.addEventListener('mousedown', handleMouseClick);

  //to check where the mouse is on the screen
  canvas.addEventListener('mousemove',
    (evt) => {
      var mousePos = calcuateMousePos(evt);
      player1.paddle = mousePos.y - (player1.PADDLE_HEIGHT - 125);
    });

  var FramesPerSecond = 30;

  //the interval everything will move
  setInterval(function () {
    drawEverything();
    moveEverthing();
    console.log(player2.paddle);
  }, 1000 / FramesPerSecond);
}
//to check where the mouse is on the screen
function calcuateMousePos(evt) {
  var rect = canvas.getBoundingClientRect()
  var root = document.documentElement;
  var mouseX = evt.clientX - rect.left - root.scrollLeft;
  var mouseY = evt.clientY - rect.top - root.scrollTop;
  return {
    x: mouseX,
    y: mouseY
  };
}

//resets the ball unless the score is above the winnig score for either players
function ballReset() {
  if (player1.playerScore >= WINNING_SCORE ||
    player2.playerScore >= WINNING_SCORE) {
    game.showingWinScreen = true;
  }
//reverses the ball speed so it changes direction when its respawned and spawns it in the middle
  game.ballspeedx = -game.ballspeedx;
  game.ballx = canvas.width / 2;
  game.bally = canvas.height / 2;
}

//ai movement for the second paddle
function computerMovement() {
  var paddleCenter = player2.paddle + (player2.PADDLE_HEIGHT / 2);
  if (paddleCenter < game.bally - 35) {
    player2.paddle += 9;
  } else if (paddleCenter > game.bally + 35) {
    player2.paddle -= 9;
  }
}


 //function to see if you pressed the mouse
function handleMouseClick(evt) {
  if (game.showingWinScreen) {
    player1.playerScore = 0;
    player2.playerScore = 0;
    game.showingWinScreen = false;
  }
}

//moves everything every set interval
function moveEverthing() { //gör så saker rör sig
  if (game.showingWinScreen) {
    return;
  }
//the call for the ai to move
  computerMovement();


  //changes the location of the ball depending on the speed of the ball
  game.ballx = game.ballx + game.ballspeedx;
  game.bally = game.bally + game.ballspeedy;
  //if the ball hits the cealing bounce back
  if (game.bally < 0) {
    game.ballspeedy = -game.ballspeedy;
  }
//check if the ball hit the paddle or not and give score or not
  if (game.ballx < 0) {
    if (game.bally > player1.paddle &&
      game.bally < player1.paddle + player1.PADDLE_HEIGHT) {
      game.ballspeedx = -game.ballspeedx;

      var deltay = game.bally - (player1.paddle + player1.PADDLE_HEIGHT / 2);
      game.ballspeedy = deltay * 0.35;
    } else {
      player2.playerScore += 1;
      //call for ball reset
      ballReset();
    }
  }
  if (game.bally > canvas.height) {
    game.ballspeedy = -game.ballspeedy;
  }
  //if balls hits wall on ai score point
  if (game.ballx > canvas.width) {
    if (game.bally > player2.paddle &&
      game.bally < player2.paddle + player2.PADDLE_HEIGHT) {
      game.ballspeedx = -game.ballspeedx;
      var deltay = game.bally - (player2.paddle + player2.PADDLE_HEIGHT / 2);
      game.ballspeedy = deltay * 0.35;
    } else {
      player1.playerScore += 1;
      ballReset();
    }
  }
}

//draws all of the stuff on the canvas
function drawEverything() {

  if (game.showingWinScreen) {
    if (player1.playerScore >= WINNING_SCORE) {
      ctx.fillText("player one wins", 350, 280);
    } else if (player2.playerScore >= WINNING_SCORE) {
      ctx.fillText("player two wins", 350, 280);
    }



    ctx.fillText("click to continue", 350, 320);
    return;

  }
  //the canvas
  ctx.fillStyle = 'black';
  ctx.fillRect(0, 0, canvas.width, canvas.height,);

  //den vänstra paddlen
  ctx.fillStyle = 'white';
  ctx.fillRect(0, player1.paddle, player1.PADDLE_THICKNESS, player1.PADDLE_HEIGHT)

  // den högra paddlen den är stryd av en dator
  ctx.fillStyle = 'white';
  ctx.fillRect(canvas.width - player2.PADDLE_THICKNESS, player2.paddle, player2.PADDLE_THICKNESS, player2.PADDLE_HEIGHT)

  //bollen
  colorCircle(game.ballx, game.bally, 10, 'white')


  //score of players
  ctx.font = "bold 30px sans-serif";
  ctx.fillText(player1.playerScore, 100, 100);
  ctx.fillText(player2.playerScore, canvas.width - 150, 100);

}
//gives the circle its color and draws it
function colorCircle(centerX, centerY, radius, drawColor) {
  ctx.fillStyle = drawColor;
  ctx.beginPath();
  ctx.arc(centerX, centerY, radius, 0, Math.PI * 2, true);
  ctx.fill();
}

