<?php

session_start();

include_once 'config/config.php';
$bottom_scripts = 'assets/js/app.js';

if ($userObj->isSignedIn()) {
    Utils::redirect('index.php');
} else {
    $body = 'templates/login.tpl.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $userObj->loginUser();
        Utils::redirect('index.php');
        unset($_SERVER['REQUEST_METHOD']);
    }

    $errors = $userObj->getErrors();
}

include_once 'layouts/base.php';
