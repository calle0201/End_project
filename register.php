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
                <li><a class=" nav" href="./landing_page.php">Homepage</a></li>
                
                
                <?php
               
               
                if (!$_SESSION['logged_in'] == true) {
                ?> 
                <li ><a data-toggle="modal" data-target="#login" class="nav" href="">Login</a></li>
                <li  id="register"><a class="active nav" href="">Register</a></li> 
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
    <h1>register</h1>
    <div class="flexbox">
    <form class="register" action="#" method="post">
    <label for="Email"><b>Email</b></label>
            <br>
            <input type="text" placeholder="Enter Email" name="Email" required>
        <br>
            <label for="uname"><b>Username</b></label>
            <br>
            <input type="text" placeholder="Enter Username" name="uname" required>
        <br>
            <label for="psw"><b>Password</b></label>
            <br>
            <input type="password" placeholder="Enter Password" name="psw" required>
        <br>
        <label for="pswCon"><b>Confirm password</b></label>
        <br>
            <input type="password" placeholder="Confirm password" name="pswCon" required>
        <br>
            <button type="submit" class="btn ">register</button>
          
          </form>
          </div>
          <?php
   $name = filter_input(INPUT_POST,"uname", FILTER_SANITIZE_STRING);
   $email = filter_input(INPUT_POST,"Email", FILTER_SANITIZE_STRING);
   $pass = filter_input(INPUT_POST,"psw", FILTER_SANITIZE_STRING);
   $passCon = filter_input(INPUT_POST,"pswCon", FILTER_SANITIZE_STRING);

   
   if ($name and $email and $pass and $passCon ) {


switch ($email) {
   case !strpos($email, "@"):
      echo "<p>din mail har inget @ tecken</p>";
       break;
   case !strpos($email, "."):
       echo "<p>din mail har ingen punkt</p>";
       break;
   
   default:
      if (!$pass == $passCon) {
        echo "<p>Your password dont match</p>";
      } else {
        $hashedPass = password_hash($pass,PASSWORD_DEFAULT);
        $sql_user = "SELECT * FROM users WHERE user='$name'";
        $res_u = $conn->query($sql_user);
        if (mysqli_num_rows($res_u) > 0) {
          echo "<p>användarnamn finns redan</p>";
        } else { 
          $sql = "INSERT INTO users (mail, user, pass) VALUES ( '$email', '$name', '$hashedPass')";
          
          $register = $conn->query($sql);
          $sql = "SELECT id FROM users WHERE user='$name'";
          $result = $conn->query($sql);
         $userid = $result->fetch_assoc();
          $sql = "INSERT INTO highscore (	id_person,pong_highscore,breakout_highscore) VALUES ( '$userid[id]', '0', '0')";
          $conn->query($sql);
          if (!$register) {
              die("something went wrong");
          } else {
              echo "<p>registered</p>";
             
        }}
       
      $conn->close();
       break;
}
}   
   }

   ?>
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
         $nameLogin = filter_input(INPUT_POST,"unameLogin", FILTER_SANITIZE_STRING);
         $passLogin = filter_input(INPUT_POST,"pswLogin", FILTER_SANITIZE_STRING);
      
         if ($nameLogin and  $passLogin  ) {
          $sql = "SELECT * FROM users";
          $result = $conn->query($sql);
          
          
          while ($rad = $result->fetch_assoc()) {
             if (!$rad['user'] == $nameLogin ) {
                continue;
             } else {
      if (!$rad['pass'] == password_hash($passLogin, PASSWORD_DEFAULT)) {
          continue;
      } else {
          echo "<p>you are logged in</p>";
          $_SESSION['logged_in'] = true;
          $_SESSION['user'] = $nameLogin;
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
