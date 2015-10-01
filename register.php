<?php
session_start();

include_once 'config/config.php';
$bottom_scripts = 'assets/js/app.js';
$body = 'templates/register.tpl.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
  $userObj->registerUser();
}

$errors = $userObj->getErrors();

include_once 'layouts/base.php';

?>
