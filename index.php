<?php

  session_start();
  include_once 'config/config.php';
  $bottom_scripts = 'assets/js/app.js';

  if (isset($_GET['id'], $_GET['quantity'])) {
      if ($productsObj->addToCart()) {
          utils::redirect('index.php'); // Cleaning the query string
      }
  }

  $products = $productsObj->listProducts();

  $body = 'templates/index.tpl.php';

  $errors = $productsObj->getErrors();

  include_once 'layouts/base.php';
