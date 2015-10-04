<?php


  session_start();
  include_once 'config/config.php';
  $bottom_scripts = 'assets/js/app.js';

  if (!$userObj->isSignedIn()) {
      Utils::redirect('login.php');
  } else {
      $body = 'templates/profile.tpl.php';
  }

  include_once 'layouts/base.php';
