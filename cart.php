<?php

session_start();
include_once 'config/config.php';
$bottom_scripts = 'assets/js/app.js';

if (!$userObj->isSignedIn()) {
    Utils::redirect('login.php');
} else {
    $cart = $cartObj->listCart();
    if (!$cart) {
        $body = 'templates/emptyCart.tpl.php';
    } else {
        $body = 'templates/cart.tpl.php';
    }
}

include_once 'layouts/base.php';
