const WINNING_SCORE = 3;
var canvas;
var ctx;


class players {
  constructor(paddle, playerScore) {
    this.paddle = 250;
    this.PADDLE_HEIGHT = 100;
    this.PADDLE_THICKNESS = 10;
    this.playerScore = 0;

  }


}
class gameInfo {
  constructor() {
    this.showingWinScreen = false;
    this.ballx = 50;
    this.bally = 50;
    this.ballspeedx = 10;
    this.ballspeedy = 4;
  }
}

var game = new gameInfo();
var player1 = new players();
var player2 = new players();

window.onload = () => { // laddas bara när sidan är ladad kalart
  canvas = document.getElementById('gamecanvas');
  ctx = canvas.getContext('2d');
  ctx.fillStyle = 'black';
  ctx.fillRect(0, 0, canvas.width, canvas.height);

  canvas.addEventListener('mousedown', handleMouseClick);

  canvas.addEventListener('mousemove',
    (evt) => {
      var mousePos = calcuateMousePos(evt);
      player1.paddle = mousePos.y - (player1.PADDLE_HEIGHT - 125);
    });

  var FramesPerSecond = 30;
  setInterval(function () {
    drawEverything();
    moveEverthing();
    console.log(player2.paddle);
  }, 1000 / FramesPerSecond);
}

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


function ballReset() {
  if (player1.playerScore >= WINNING_SCORE ||
    player2.playerScore >= WINNING_SCORE) {
    game.showingWinScreen = true;
  }

  game.ballspeedx = -game.ballspeedx;
  game.ballx = canvas.width / 2;
  game.bally = canvas.height / 2;
}

function computerMovement() {
  var paddleCenter = player2.paddle + (player2.PADDLE_HEIGHT / 2);
  if (paddleCenter < game.bally - 35) {
    player2.paddle += 9;
  } else if (paddleCenter > game.bally + 35) {
    player2.paddle -= 9;
  }
}



function handleMouseClick(evt) {
  if (game.showingWinScreen) {
    player1.playerScore = 0;
    player2.playerScore = 0;
    game.showingWinScreen = false;
  }
}

function moveEverthing() { //gör så saker rör sig
  if (game.showingWinScreen) {
    return;
  }

  computerMovement();

  game.ballx = game.ballx + game.ballspeedx;
  game.bally = game.bally + game.ballspeedy;
  if (game.bally < 0) {
    game.ballspeedy = -game.ballspeedy;
  }

  if (game.ballx < 0) {
    if (game.bally > player1.paddle &&
      game.bally < player1.paddle + player1.PADDLE_HEIGHT) {
      game.ballspeedx = -game.ballspeedx;

      var deltay = game.bally - (player1.paddle + player1.PADDLE_HEIGHT / 2);
      game.ballspeedy = deltay * 0.35;
    } else {
      player2.playerScore += 1;
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

function colorCircle(centerX, centerY, radius, drawColor) {
  ctx.fillStyle = drawColor;
  ctx.beginPath();
  ctx.arc(centerX, centerY, radius, 0, Math.PI * 2, true);
  ctx.fill();
}

