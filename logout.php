<?php 

require 'config/constants.php';
session_start();

// destroy all session and redirect user to home page 

session_destroy();
$_SESSION = array();

header('Location: ' . ROOT_URL);
exit();