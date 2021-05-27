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
include "./oop.php";
$check = new Validator();



if (isset($_POST["change_uname"])) {
 $check->set($_POST, $_SESSION['user'], $conn);
$check->changeName();
  
}
if (isset($_POST["delete"])) {
 $check->set($_POST, $_SESSION['user'], $conn);
 $check->deleteAccount();
  
}
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
            <?php $check->checkLogin('myAccount')?>
            </ul>
        </nav>
    </header>


    <div class="kontainer">
        <h1>Hello <?php echo $_SESSION['user'];?></h1> 
        <div>
        <h2>Account settings</h2>
        <form action="#" method="post">
        <label for="unameChange"><b>Username</b></label>
            <br>
            <input type="text" placeholder=" <?php echo $_SESSION['user'] ?>" name="unameChange" >
            <br>
            <?php $check->showErrors('unameChange'); ?>
            <br>
            <button type="submit" name="change_uname" class="btn ">Change username</button>
        </form>
            <button data-toggle="modal" data-target="#delete" style="margin: 10px 0px" class="btn">DELETE Account</button>
        </div>
        <h2>highscores</h2>
    <div class="flexbox">
        <div class="score">
        <p>pong highscore</p>   
        <?php
    $check->getScore("pong_highscore", $conn);
   ?>
        </div>
        <div class="score">
        <p>breakout highscore</p>
        <?php
      $check->getScore("breakout_highscore", $conn);
       
        ?>
        </div>

        </div>
    </div>

    <footer>
    </footer>





</body>


<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Delete account</h5>
      
      </div>
      <div class="modal-body">
        <!-- form to login -->
          <form action="#" method="post">
            <label for="delete"><b>Are you sure you want to delete your account? <br>
        This is permanent and cant be restored.</b></label>
            <button type="submit"  name="delete" value="Login" class="btn btn-success">yes</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
          </form>
      </div>
      <div class="modal-footer">
        
       
      </div>
      <?php

      ?>
    </div>
  </div>
</div>
</html>
