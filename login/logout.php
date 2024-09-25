<?php
include ('../app/config.php');

session_start(); 

$_SESSION = [];

session_destroy();

header("Location: " . APP_URL . "/login");
exit();
?>