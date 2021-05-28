<?php

session_start();

class Validator{
    // Properties
    private $errors = [];
    private $user;
    private $data;
    private $conn;
    //set some vars to use
    public function set($postdata, $usernow, $connNow) {
        $this->data = $postdata;
        $this->user = $usernow;
        $this->conn = $connNow;
    }
    //check if logged in
    public function checkLogin($siteCheck) {
        switch ($siteCheck) {
            //checks if the site is the landing page
            case 'landing': 
            
                    echo "<li><a class=\"active nav\" href=\"#\">Homepage</a></li>";
                //checks if logged in if not show login and register
                if (!$_SESSION['logged_in'] == true) {
           
                    echo '<li><a data-toggle="modal" data-target="#login" class="nav" href="#">Login</a></li>';
                    echo "<li><a class=\" nav\" href=\"./register.php\">Register</a></li>" ;
           
                } else {
            
                    echo "<li><a class=\"nav\" href=\"logout.php\">Logout</a></li>";
                    echo "<li><a class=\"nav\"  href=\"./my_account.php\">My account</a></li>";
            
                }
          
                    echo "<li><a class=\"nav\" href=\"./time.php\">Time</a></li>";
                    echo "<li><a class=\"nav\" href=\"./api.php\">API</a></li>";
            break;
                //checks if the site is the Myaccount page
            case 'myAccount':
                    echo "<li><a class=\" nav\" href=\"./landing_page.php\">Homepage</a></li>";
          
                //checks if logged in if not show login and register
                if (!$_SESSION['logged_in'] == true) {
           
                    echo '<li><a data-toggle="modal" data-target="#login" class="nav" href="#">Login</a></li>';
                    echo "<li><a class=\" nav\" href=\"./register.php\">Register</a></li>" ;
            
                } else {
                    echo "<li><a class=\"nav\" href=\"logout.php\">Logout</a></li>";
                    echo "<li><a class=\"active nav\"  href=\"./my_account.php\">My account</a></li>";
           
                }
          
                echo "<li><a class=\"nav\" href=\"./time.php\">Time</a></li>";
                echo "<li><a class=\"nav\" href=\"./api.php\">API</a></li>";
            break;
                //checks if the site is the Time page
            case 'time':
                echo "<li><a class=\" nav\" href=\"./landing_page.php\">Homepage</a></li>";
          
                //checks if logged in if not show login and register
                 if (!$_SESSION['logged_in'] == true) {
               
                   echo '<li><a data-toggle="modal" data-target="#login" class="nav" href="#">Login</a></li>';
                    echo "<li><a class=\" nav\" href=\"./register.php\">Register</a></li>" ;
               
                } else {
                
                   echo "<li><a class=\"nav\" href=\"logout.php\">Logout</a></li>";
                    echo "<li><a class=\"nav\"  href=\"./my_account.php\">My account</a></li>";
                
                }
              
                echo "<li><a class=\"active nav\" href=\"./time.php\">Time</a></li>";
                echo "<li><a class=\"nav\" href=\"./api.php\">API</a></li>";
            break;
                //checks if the site is the Register page
            case 'register':
                echo "<li><a class=\" nav\" href=\"./landing_page.php\">Homepage</a></li>";
          
                //checks if logged in if not show login and register
                 if (!$_SESSION['logged_in'] == true) {
               
                   echo '<li><a data-toggle="modal" data-target="#login" class="nav" href="#">Login</a></li>';
                    echo "<li><a class=\"active nav\" href=\"./register.php\">Register</a></li>" ;
               
                } else {
                
                   echo "<li><a class=\"nav\" href=\"logout.php\">Logout</a></li>";
                    echo "<li><a class=\"nav\"  href=\"./my_account.php\">My account</a></li>";
                
                }
              
                echo "<li><a class=\"nav\" href=\"./time.php\">Time</a></li>";
                echo "<li><a class=\"nav\" href=\"./api.php\">API</a></li>";
            break;
                //checks if the site is the API page
            case 'api':
                echo "<li><a class=\" nav\" href=\"./landing_page.php\">Homepage</a></li>";
          
                //checks if logged in if not show login and register
                 if (!$_SESSION['logged_in'] == true) {
               
                   echo '<li><a data-toggle="modal" data-target="#login" class="nav" href="#">Login</a></li>';
                    echo "<li><a class=\" nav\" href=\"./register.php\">Register</a></li>" ;
               
                } else {
                
                   echo "<li><a class=\"nav\" href=\"logout.php\">Logout</a></li>";
                    echo "<li><a class=\"nav\"  href=\"./my_account.php\">My account</a></li>";
                
                }
              
                echo "<li><a class=\"nav\" href=\"./time.php\">Time</a></li>";
                echo "<li><a class=\"active nav\" href=\"./api.php\">API</a></li>";
            break;
                //an extra for later
            case '':
                echo "<li><a class=\" nav\" href=\"#\">Homepage</a></li>";
          
                //checks if logged in if not show login and register
                 if (!$_SESSION['logged_in'] == true) {
               
                   echo '<li><a data-toggle="modal" data-target="#login" class="nav" href="#">Login</a></li>';
                    echo "<li><a class=\" nav\" href=\"./register.php\">Register</a></li>" ;
               
                } else {
                
                   echo "<li><a class=\"nav\" href=\"logout.php\">Logout</a></li>";
                    echo "<li><a class=\"nav\"  href=\"./my_account.php\">My account</a></li>";
                
                }
              
                echo "<li><a class=\"nav\" href=\"./time.php\">Time</a></li>";
                echo "<li><a class=\"nav\" href=\"./api.php\">API</a></li>";
                    break;
                case 'myAccount':
                    echo "<li><a class=\" nav\" href=\"#\">Homepage</a></li>";
              
                //checks if logged in if not show login and register
                 if (!$_SESSION['logged_in'] == true) {
               
                  echo '<li><a data-toggle="modal" data-target="#login" class="nav" href="#">Login</a></li>';
                    echo "<li><a class=\" nav\" href=\"./register.php\">Register</a></li>" ;
                
                } else {
             
                    echo "<li><a class=\"nav\" href=\"logout.php\">Logout</a></li>";
                    echo "<li><a class=\"active nav\"  href=\"./my_account.php\">My account</a></li>";
               
                }
              
              echo "<li><a class=\"nav\" href=\"./time.php\">Time</a></li>";
              echo "<li><a class=\"nav\" href=\"./api.php\">API</a></li>";
            break;
            //if its none of the sites
            default:
                echo "<li><a class=\" nav\" href=\"#\">Homepage</a></li>";
          
                //checks if logged in if not show login and register
                if (!$_SESSION['logged_in'] == true) {
           
                    echo '<li><a data-toggle="modal" data-target="#login" class="nav" href="#">Login</a></li>';
                    echo "<li><a class=\"nav\" href=\"./register.php\">Register</a></li>" ;
           
                } else {
            
                    echo "<li><a class=\"nav\" href=\"logout.php\">Logout</a></li>";
                    echo "<li><a class=\"nav\"  href=\"./my_account.php\">My account</a></li>";
                }
                    echo "<li><a class=\"nav\" href=\"./time.php\">Time</a></li>";
                    echo "<li><a class=\"nav\" href=\"./api.php\">API</a></li>";
            break;
        }
          
    }
    //to login
    public function login() {
         //sanites the login inputs
         $nameLogin = filter_input(INPUT_POST,"unameLogin", FILTER_SANITIZE_STRING);
         $passLogin = filter_input(INPUT_POST,"pswLogin", FILTER_SANITIZE_STRING);
        //makes sure both name and pass is filled in
        if ($nameLogin and  $passLogin  ) {
            //gets all info from the DB
            $sql = "SELECT user FROM users ";
            $resu = $this->conn->query($sql);
            while ($name = $resu->fetch_assoc()) {
                $username = $name['user'];
                //checks if the username that is being fetched is the same as the one you try to login with
                if ($username == $nameLogin) {
                    break;
                } else {
                    continue;
                }
        }
        //checks if the username that is being fetched is the same as the one you try to login with
        if ($username == $nameLogin) {
           $sql = "SELECT pass FROM users WHERE user='$username'";
           $resu = $this->conn->query($sql);
           $pass = $resu->fetch_assoc();
           $hashpass = $pass['pass'];
           //checks the pass to the password of the user you are trying to login to
           if (password_verify($passLogin, $hashpass))
                //changes the session to logged in
                $_SESSION['logged_in'] = true;
                //changes the session var to log what user is logged in
                $_SESSION['user'] = $nameLogin;
                //refresh site so you can update som
                header("Refresh:0");
            } else {
                $this->errors['pass'][] = "the password you typed is incorrect <br>";
            }
        } else {
            $this->errors['username'][] = "your username is not in our database <br>";
       }
    }
    //to register
    Public function Register() {
        //outputs of the register that get filtered for unwanted code
        $name = filter_input(INPUT_POST,"uname", FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST,"Email", FILTER_SANITIZE_STRING);
        $pass = filter_input(INPUT_POST,"psw", FILTER_SANITIZE_STRING);
        $passCon = filter_input(INPUT_POST,"pswCon", FILTER_SANITIZE_STRING);
        //checks if every field is used
        if ($name and $email and $pass and $passCon ) {

        //checks mail stuff
        switch ($email) {
            case !strpos($email, "@"):
                $this->errors['register'][] = "Your mail has no @ in it. <br>";
            break;

            case !strpos($email, "."):
                $this->errors['register'][] = "Your mail has no dot. <br>";
            break;
            default:
                //makes sure the pass is correct for both versions
                if ($pass != $passCon) {
                    $this->errors['register'][] = "Your password does not match. <br>";
                } else {
                    //hashes the password for more security
                    $hashedPass = password_hash($pass,PASSWORD_DEFAULT);
                    //checks if the name already exists
                    $sql_user = "SELECT * FROM users WHERE user='$name'";
                    $resu = $this->conn->query($sql_user);
                    if (mysqli_num_rows($resu) > 0) {
                        $this->errors['register'][] = "The username already exists <br>";
                    } else { 
                        //inserts the user in to the DB
                        $sql = "INSERT INTO users (mail, user, pass) VALUES ( '$email', '$name', '$hashedPass')";
                        $register = $this->conn->query($sql);
                        //checks for the id of the newly made user
                        $sql = "SELECT id FROM users WHERE user='$name'";

                        $resu = $this->conn->query($sql);

                        $userid = $resu->fetch_assoc();
                        //inserts a new user in the highscore DB with the same id as the new account
                        $base = "0";

                        $sql = "INSERT INTO highscore (person_id,pong_highscore,	breakout_highscore) VALUES ( '$userid[id]', '$base', '$base')";
        
                        $resu =  $this->conn->query($sql);
       
                        if (!$register) {
                            die("something went wrong");
                        } else {
                            $this->errors['register'][] = "Registered <br>";
     
                        }
                    }
                $this->conn->close();
            break;
                }
            }   
        }

    }
    //to change names
    public function changeName() {
        //gets some data that is the new name of the person
        $name = $this->data['unameChange'];
        $sql = "SELECT * FROM users WHERE user='$name'";
        $resu = $this->conn->query($sql);
        //checks if the name already exists
        if (mysqli_num_rows($resu) > 0) {
            $this->errors['unameChange'][] = "the name already exists";
        } else { 
            //if it doesnt change the old to the new name
            $sql = "UPDATE users SET user='$name' WHERE user='$this->user'";
            $resu =  $this->conn->query($sql);
        }
    }
    //to delete account
    public function deleteAccount() {
        //gets current user
        $usercurrent = $this->user;
       //get the ID of the account
        $sql = "SELECT id FROM users WHERE user='$usercurrent'";
        $userId = $this->conn->query($sql);
            while ($ID = $userId->fetch_assoc()) {
                break;
            }
        //makes the id a var instead of an array
        $userId = $ID['id'];
        //delete account and highscores
        $sql = "DELETE FROM users WHERE id='$userId'";
        $this->conn->query($sql);
        $sql = "DELETE FROM highscore WHERE person_id='$userId'";
        $this->conn->query($sql);
        header( 'Location:./logout.php');
    }    
    //get score for my account
    public function getScore($score, $conn) {
        //sets a var to the session var "user"
        $user =  $_SESSION['user'];
     
        //finds the id of the user that is logged in
       $sql = "SELECT id FROM users WHERE user='$user'"; 
       $resu = $conn->query($sql);
       
        $userid = $resu->fetch_assoc();
        $userid = $userid['id'];
     
        //finds the highscores using the id of the logged in person
        $sql = "SELECT * FROM highscore WHERE person_id='$userid'";
        $resu = $conn->query($sql);
        $userscore = $resu->fetch_assoc();

        echo "<p>$userscore[$score]</p>";
    }
    //apicall
    public function apiCall($type, $moneyType, $moneystring) {
        // Url TO API
        $url = "https://api.coindesk.com/v1/bpi/currentprice/BTC.json";
        // Make a calll
        $json = file_get_contents($url);
        // decode the json
        $jsonData = json_decode($json);    
            //check if the incoming data is empty or not and give info depending on what it is 
        if (!empty($type) AND empty($moneyType) AND empty($moneystring) AND empty($desc)) {
            $money = $jsonData->$type;

            echo "<p class=\"crypto\">$money</p>" . " ";

        } elseif (!empty($type)  AND !empty($moneyType)  AND empty($moneystring) AND empty($desc) ) {

            $money = $jsonData->$type->$moneyType;
          
            echo "<p class=\"crypto\">$money</p>" . " ";

        } elseif (!empty($type) AND !empty($moneyType) AND !empty($moneystring) AND empty($desc) ) { 

            $money = $jsonData->$type->$moneyType->$moneystring;
     
            echo "<p class=\"crypto\">$money</p>" . " ";
        } 
    }
    //show errors
    public function showErrors($type){
        if (array_key_exists($type, $this->errors)) {
            echo "<p>";
            foreach ($this->errors[$type] as $error) {
                echo $error;
            }
            echo "</p>";
        } else {
         
        }
    }
};