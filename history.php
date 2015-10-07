<?php

session_start();

include_once 'config/config.php';
$bottom_scripts = 'assets/js/app.js';
$body = 'templates/history.tpl.php';

if (!$userObj->isSignedIn()) {
    Utils::redirect('login.php');
} else {
    $history = $userObj->getHistory();
}
$errors = $userObj->getErrors();
include_once 'layouts/base.php';
