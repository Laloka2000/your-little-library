<?php 

require_once '../config.php';
require_once '../includes/functions.php';

initSession();
session_destroy();
redirect('login.php');
?>