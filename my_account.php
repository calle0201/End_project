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
    <title>My account</title>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/landing_page.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="./css/mypage.css">
</head>
<body>
 
    <header>
        <!-- <img src="" alt="" class="logo"> -->

        <nav>
            <ul>
                <li><a class=" nav" href="./landing_page.php">Homepage</a></li>
                <?php
                //checks if logged in else boots to landing page
                 if (!$_SESSION['logged_in'] == true) {
                  header( 'Location:./landing_page.php');
                } else {
                  ?>  
                <li  id="logout"><a class="nav" href="logout.php">Logout</a></li>
                <li id="account" ><a class="active nav"  href="#">My account</a></li>
                <?php
                }
                ?>
            </ul>
        </nav>
    </header>


    <div class="kontainer">
        <h1>Hello <?php echo $_SESSION['user'];?></h1> 
        <h2>highscores</h2>
    <div class="flexbox">
        <div class="score">
        <p>pong highscore</p>
                 
        <?php
        //sets a var to the session var "user"
     $user =  $_SESSION['user'];
     //finds the id of the user that is logged in
       $sql = "SELECT id FROM users WHERE user='$user'";
       $result = $conn->query($sql);
      $userid = $result->fetch_assoc();
     
      //finds the highscores using the id of the logged in person
      $sql = "SELECT * FROM highscore WHERE id_person='$userid[id]'";
        $result = $conn->query($sql);
            $userscore = $result->fetch_assoc();

      echo "<p>$userscore[pong_highscore]</p>";
   ?>
        </div>
        <div class="score">
        <p>breakout highscore</p>
        <?php
        //sets a var to the session var "user"
           $user =  $_SESSION['user'];
             //finds the id of the user that is logged in
            $sql = "SELECT id FROM users WHERE user='$user'";
                $result = $conn->query($sql);
                    $userid = $result->fetch_assoc();
        //finds the highscores using the id of the logged in person
          $sql = "SELECT * FROM highscore WHERE id_person='$userid[id]'";
            $result = $conn->query($sql);
                $userscore = $result->fetch_assoc();

        echo "<p>$userscore[breakout_highscore]</p>";
        ?>
        </div>

        </div>
    </div>

    <footer>
    </footer>





</body>



</html>
