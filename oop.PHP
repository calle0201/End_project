<?php

session_start();

class Validator
{
    // Properties
    private $errors = [];
    private $user;
    private $data;
    private $conn;
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
          $sql = "SELECT user FROM users ";
          $resu = $this->conn->query($sql);
       while ($name = $resu->fetch_assoc()) {
        $username = $name['user'];
       
        if ($username == $nameLogin) {
            break;
        } else {
            continue;
        }
       }
       if ($username == $nameLogin) {
           $sql = "SELECT pass FROM users WHERE user='$username'";
           $resu = $this->conn->query($sql);
           $pass = $resu->fetch_assoc();
           $hashpass = $pass['pass'];
           if (password_verify($passLogin, $hashpass))
          //changes the session to logged in
          $_SESSION['logged_in'] = true;
          //changes the session var to log what user is logged in
          $_SESSION['user'] = $nameLogin;
          //refresh site so you can update som
        // header("Refresh:0");
        } else {
            $this->errors['pass'] = "the password you typed is incorrect";
        }
       } else {
        $this->errors['username'] = "your username is not in our database";
       }
      }
    public function changeName() {
        $name = $this->data['unameChange'];
        $sql = "SELECT * FROM users WHERE user='$this->data'";
    $resu = $this->conn->query($sql);

    if (mysqli_num_rows($resu) > 0) {
       
        $this->errors['unameChange'][] = "the name already exists";
    } else { 
       
        $sql = "UPDATE users SET user='$name' WHERE user='$this->user'";
     $resu =  $this->conn->query($sql);
     var_dump($resu);
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