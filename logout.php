<?php
//start session
session_start();
// change logged in to not logged in
$_SESSION['logged_in'] = false;
//unsets users name
unset($_SESSION['user']);
header( 'Location:./landing_page.php');
?>