<?php
session_start();

include_once 'config/config.php';
$bottom_scripts = 'assets/js/app.js';
$body = 'templates/login.tpl.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
  $userObj->loginUser();
}

$errors = $userObj->getErrors();

include_once 'layouts/base.php';

?>