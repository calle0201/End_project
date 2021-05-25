<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

/*
1. Skapa en klass
2. Skapa en konstruktor
3. Kontrollera att inga fält saknas
4. Skapa funktioner för att validera
4.1 En funktion för att validera username
4.1 En funktion för att validera email
4.2 En funktion för att validera lösenord
5. Returnera en array med alla fel
*/

class Validator
{
    // Properties
    private $errors = [];
    private $user;
    private $sql;
    private $data;
    private $conn;
    private $resu;
    private $result;
    public function set($postdata, $usernow, $connNow) {
        $this->data = $postdata;
        $this->user = $usernow;
        $this->conn = $connNow;
    }
    public function login() {
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
    }
    public function changeName() {

        $this->sql = "SELECT * FROM users WHERE user='$this->user'";
    $this->resu = $this->conn->query($this->sql);
    var_dump(  $this->sql);
    if (mysqli_num_rows($this->resu) > 0) {
       
        $this->errors['password'][] = "the name already exists";
    } else { 
        $this->sql = "UPDATE users SET user='$this->data    ' WHERE user='$this->user'";
     $this->result =  $this->conn->query($this->sql);
        
    }
}
    public function showErrors($type)
    {
        if (array_key_exists($type, $this->errors)) {
            echo "<p>";
            foreach ($this->errors[$type] as $error) {
                echo $error;
            }
            echo "</p>";
        }
    }
};