<?php

session_start();
include_once 'config/config.php';
$bottom_scripts = 'assets/js/app.js';
$body = 'templates/confirm.tpl.php';

if (!$userObj->isSignedIn()) {
    Utils::redirect('login.php');
} else {
    $items = $cartObj->listCart();
    $success = $cartObj->processCart($items);
}

$errors = $cartObj->getErrors();

include_once 'layouts/base.php';
