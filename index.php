<?php
  session_start();
  include_once('config/config.php');

  $bottom_scripts = 'assets/js/app.js';
  $body = 'templates/index.tpl.php';

  $errors = $userObj->getErrors();

  include_once('layouts/base.php');

?>
