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
    <title>Game_site</title>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/landing_page.css">
    <link rel="stylesheet" href="css/header.css">
 
</head>
<body>
 
    <header>
        <!-- <img src="" alt="" class="logo"> -->

        <nav>
            <ul>
                <li><a class="active nav" href="#">Homepage</a></li>
                <?php
                 $_SESSION['logged_in'] = false;
                 if ($_SESSION['logged_in'] == true) {
                ?> 
                <li ><a data-toggle="modal" data-target="#login" class="nav" href="">login</a></li>
                <li  id="register"><a class="active nav" href="">register</a></li> 
                <?php
                } else {
                  ?>  
                <li  id="logout"><a class="nav" href="logout.php">logout</a></li>
                <li id="account" ><a class="nav"  href="">my account</a></li>
                <?php
                }
                ?>
            </ul>
        </nav>
    </header>


    <div class="kontainer">
        <h1>Our games</h1> 
        <div class="flexbox">
            <a href=""><img src="./img/jonathan-petersson-a6N685qLsHQ-unsplash_large.jpg" alt="breakout"></a>
            <a href="./game.html"><img src="./img/steven-skerritt-vljZeX-WdQs-unsplash_large.jpg" alt="pong"> </a>
            <p class="game">PONG</p>
        </div>
    </div>

    <footer>


    </footer>


<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Login</h5>
      
      </div>
      <div class="modal-body">
          <form action="#" method="post">
            <label for="uname"><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="uname" required>
        <br>
            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="psw" required>
        <br>
            <button type="submit" class="btn ">Login</button>
           
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       
      </div>
      <?php
         $nameLogin = filter_input(INPUT_POST,"unameLogin", FILTER_SANITIZE_STRING);
         $passLogin = filter_input(INPUT_POST,"pswLogin", FILTER_SANITIZE_STRING);
     
         if ($nameLogin and  $passLogin  ) {
          $sql = "SELECT * FROM users";
          $result = $conn->query($sql);
          
          
          while ($rad = $result->fetch_assoc()) {
             if (!$rad['user'] == $nameLogin ) {
                continue;
             } else {
      if (!$rad['pass'] == $passLogin) {
          continue;
      } else {
          echo "<p>you are logged in</p>";
          $_SESSION['logged_in'] = true;
          var_dump($_SESSION['logged_in']);
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
