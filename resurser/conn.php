<?php
error_reporting(E_ALL);

$host = "localhost";
$db = "slutproject";
$user = "slutproject";
$pass = "Kp3Kqf58MfF3TsLy";


//steg 1
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("kunde inte ansluta: " . $conn->error);
} else {
   
}
session_start();
?>