
		var canvas; 
		var ctx;
		var ballx = 50;
		var bally = 50;
		var ballspeedx = 10;
		var ballspeedy = 4;
		
		var player1Score = 0;
		var player2Score = 0;
		const WINNING_SCORE = 3;
		
		var showingWinScreen = false;



		var paddle1y = 250;
	 var paddle2y = 250;
		const PADDLE_HEIGHT = 100; // constant thing
		const PADDLE_THICKNESS = 10;
		
		function calcuateMousePos(evt) {
				var rect = canvas.getBoundingClientRect()
				var root = document.documentElement;
				var mouseX = evt.clientX - rect.left -root.scrollLeft;
				var mouseY = evt.clientY - rect.top -root.scrollTop;
				return {
				x:mouseX,
				y:mouseY
			};
}

				function handleMouseClick(evt) {
				if(showingWinScreen) {
				player1Score =0;
				player2Score =0;
				showingWinScreen = false;
			}
}
		
		window.onload = ()  => { // laddas bara när sidan är ladad kalart
		canvas = document.getElementById('gamecanvas');
		ctx = canvas.getContext('2d');
		ctx.fillStyle = 'black';
		ctx.fillRect(0,0,canvas.width,canvas.height);
		
		canvas.addEventListener('mousedown',handleMouseClick);
		
		canvas.addEventListener('mousemove',
			(evt) =>{
				var mousePos = calcuateMousePos(evt);
				paddle1y = mousePos.y-(PADDLE_HEIGHT/2);
			});
		
		var FramesPerSecond = 24;
		setInterval(function() {
				drawEverything();
				moveEverthing();
	}		, 1000/FramesPerSecond );
}

		function ballReset() {
				if(player1Score >= WINNING_SCORE ||
					player2Score >= WINNING_SCORE) { 
						showingWinScreen = true;
					}
		
				ballspeedx = -ballspeedx;
				ballx =canvas.width/2;
				bally =canvas.height/2;
		}
		
		function computerMovement() {
			var paddle2yCenter = paddle2y + (PADDLE_HEIGHT/2) 
				if(paddle2yCenter < bally-35) {
					paddle2y += 6;
				} else if(paddle2yCenter > bally+35) {
					paddle2y -= 6;
				}
				console.log(paddle2y);
		}
		
		function moveEverthing() { //gör så saker rör sig
			if(showingWinScreen) {
					return;
			}
		
			computerMovement();
			
			ballx = ballx + ballspeedx; 
			bally = bally + ballspeedy; 
			if(bally < 0) {
				ballspeedy = -ballspeedy;
		}
		
			if(ballx < 0) {
				if(bally > paddle1y &&
				   bally < paddle1y+PADDLE_HEIGHT) {
					ballspeedx = -ballspeedx;
					
					var deltay = bally -(paddle1y+PADDLE_HEIGHT/2);
						ballspeedy = deltay * 0.35;
				}	else {
					player2Score += 1;
					ballReset();
				}
		}
		if(bally > canvas.height) {
			ballspeedy = -ballspeedy;
		}
		//if balls hits wall on ai score point
		if(ballx > canvas.width) {
				if(bally > paddle2y &&
				   bally < paddle2y+PADDLE_HEIGHT) {
					ballspeedx = -ballspeedx;
					var deltay = bally -(paddle2y+PADDLE_HEIGHT/2);
						ballspeedy = deltay * 0.35;
				}	else {
					player1Score += 1;
					ballReset();
				}
			}
		}

		function drawEverything() { 
					
		if(showingWinScreen) {
					if(player1Score >= WINNING_SCORE) {
					ctx.fillText("player one wins", 350,280);
					}else if(player2Score >= WINNING_SCORE) {
					ctx.fillText("player two wins", 350,280);
					}
			
			
		
			ctx.fillText("click to continue", 350,320);
			return;
	
		}
		//the canvas
		ctx.fillStyle = 'black';
		ctx.fillRect(0,0,canvas.width,canvas.height,);
		
		//den vänstra paddlen
		ctx.fillStyle = 'white';
		ctx.fillRect(0,paddle1y,PADDLE_THICKNESS,PADDLE_HEIGHT)
		
		// den högra paddlen den är stryd av en dator
		ctx.fillStyle = 'white';
		ctx.fillRect(canvas.width-PADDLE_THICKNESS,paddle2y,PADDLE_THICKNESS,PADDLE_HEIGHT)
		
		//bollen
		colorCircle(ballx, bally, 10, 'white')


		//score of players
		ctx.font = "bold 30px sans-serif";
		ctx.fillText(player1Score, 100,100);
		ctx.fillText(player2Score, canvas.width-150,100);
		
		}
		
		function colorCircle(centerX, centerY, radius, drawColor) {
		ctx.fillStyle = drawColor;
		ctx.beginPath();
		ctx.arc(centerX,centerY,radius,0,Math.PI*2, true);
		ctx.fill();
		}
		
