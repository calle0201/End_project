<?php
session_start();
$_SESSION['logged_in'] = false;
unset($_SESSION['user']);
header( 'Location:./landing_page.php');
?>