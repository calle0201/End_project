<?php
/*
* en enkel blogg som använder en databas
* 
* PHP version 7
* @category   End project
* @author     Carl Edenflod <Carl.edenflodhoglund@elev.ga.ntig.se>
* @license    PHP CC
*/
include "./resurser/conn.php";
session_start();
?>

<!DOCTYPE html>
<html lang="sv">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>pong</title>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/landing_page.css">
    <link rel="stylesheet" href="css/header.css">
	<link rel="stylesheet" href="./css/pong.css">
</head>
<body>
	<header>
        <!-- <img src="" alt="" class="logo"> -->

        <nav>
            <ul>
                <li><a class=" nav" href="#">Homepage</a></li>
                   
                
                <?php
               
               //checks if logged in if not show login and register
                if (!$_SESSION['logged_in'] == true) {
                ?> 
                <li ><a data-toggle="modal" data-target="#login" class="nav" href="">Login</a></li>
                <li  id="register"><a class=" nav" href="">Register</a></li> 
                <?php
                } else {
                  ?>  
                <li  id="logout"><a class="nav" href="logout.php">Logout</a></li>
                <li id="account" ><a class="nav"  href="./my_account.php">My account</a></li>
                <?php
                }
                ?>
            </ul>
        </nav>
    </header>
	<div class="kontainer">
        <h1>PONG</h1>
		<canvas id="gamecanvas" width="800" height="600"> </canvas>
		<script src="./javascript/pong_OOP.js"></script>
	</div>
	


    
    <div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Login</h5>
      
      </div>
      <div class="modal-body">
         <!-- form to login -->
          <form action="#" method="post">
            <label for="uname"><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="unameLogin" required>
        <br>
            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="pswLogin" required>
        <br>
            <button type="submit" class="btn ">Login</button>
            <label>
              
            </label>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       
      </div>
      <?php
      //sanites the login inputs
         $nameLogin = filter_input(INPUT_POST,"unameLogin", FILTER_SANITIZE_STRING);
         $passLogin = filter_input(INPUT_POST,"pswLogin", FILTER_SANITIZE_STRING);
      //makes sure both name and pass is filled in
         if ($nameLogin and  $passLogin  ) {
           //gets all info from the DB
          $sql = "SELECT * FROM users";
          $result = $conn->query($sql);
          
          
          while ($rad = $result->fetch_assoc()) {
            //checks if the username exists
             if (!$rad['user'] == $nameLogin ) {
                continue;
             } else {
               //and then checks if the pass is correct to the username
      if (!$rad['pass'] == password_hash($passLogin, PASSWORD_DEFAULT)) {
          continue;
      } else {
        //you are now logged in 
          echo "<p>you are logged in</p>";
          //changes the session to logged in
          $_SESSION['logged_in'] = true;
          //changes the session var to log what user is logged in
          $_SESSION['user'] = $nameLogin;
          //refresh site so you can update som
          header("Refresh:0");
          break;
      }
      
               
             }
             
          
          }
      
         }
      ?>
    </div>
  </div>
  
</div>
</body>
</html>