 <?php

  session_start();
  include_once 'config/config.php';
  $bottom_scripts = 'assets/js/app.js';

  if (!$userObj->isSignedIn()) {
      Utils::redirect('login.php');
  } else {
      $body = 'templates/profile.tpl.php';
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $userObj->updateUserProfile();
        unset($_SERVER['REQUEST_METHOD']);
    }
  }

  include_once 'layouts/base.php';