<?php

session_start();

include_once 'config/config.php';
$bottom_scripts = 'assets/js/app.js';
$body = 'templates/register.tpl.php';

$userObj = new User($db);

$userObj->registerUser();
include_once 'layouts/base.php';

?>
