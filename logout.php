<?php
session_start();
unset($_SESSION['logged_in']);
session_destroy();
session_write_close();
header('Location: landing_page.php');
exit;
?>