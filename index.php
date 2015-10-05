<?php
  session_start();
  include_once('config/config.php');
  $bottom_scripts = 'assets/js/app.js';

  $products = $productsObj->listProducts();

  $body = 'templates/index.tpl.php';

  $errors = $productsObj->getErrors();

  include_once('layouts/base.php');

?>
