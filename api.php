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


?>

<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Crypto</title>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/landing_page.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="./css/crypto.css">
   
    
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a class=" nav" href="./landing_page.php">Homepage</a></li>
                <?php
                //checks if logged in if not show login and register
                 if (!$_SESSION['logged_in'] == true) {
                ?> 
                    <li ><a data-toggle="modal" data-target="#login" class="nav" href="">Login</a></li>
                    <li  id="register"><a class=" nav" href="./register.php">Register</a></li> 
                <?php
            } else {
                  ?>  
                    <li  ><a class="nav" href="logout.php">Logout</a></li>
                    <li  ><a class="nav"  href="./my_account.php">My account</a></li>
                <?php
            }
                ?>
                <li><a class=" nav" href="./time.php">Time</a></li>
                <li><a class="active nav" href="./api.php">API</a></li>
            </ul>
        </nav>
    </header>
    <div class="kontainer">
        <div class="flexbox"> <?php $check->apiCall('bpi', 'BTC', 'rate'); ?>
    <?php $check->apiCall('bpi', 'BTC', 'code'); ?>
    
    <p class="crypto">is</p>
    <?php $check->apiCall('bpi', 'USD', 'rate'); ?>
    <?php $check->apiCall('bpi', 'USD', 'code'); ?>
    <p class="crypto">at</p>
    <?php $check->apiCall('time', 'updated', null); ?>
</div>
   
    
    </div>

 <footer>
    <p>Powered by CoinDesk</p>
</footer>
</body>
<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Login</h5>
      
      </div>
      <div class="modal-body">
        <!-- form to login -->
          <form action="#" method="post">
            <label for="unameLogin"><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="unameLogin" required>
        <br>
            <label for="pswLogin"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="pswLogin" required>
        <br>
        
        <br>
            <button type="submit"  name="action" value="Login" class="btn ">Login</button>
           
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       
      </div>
      
    </div>
  </div>
</div>
</html>