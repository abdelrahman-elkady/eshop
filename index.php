<?php



  session_start();
  include_once 'config/config.php';
  $bottom_scripts = 'assets/js/app.js';

  if (isset($_GET['id'], $_GET['quantity'])) {
      $id = intval($_GET['id']);
      $quantity = intval($_GET['quantity']);

      if (isset($_SESSION['cart'][$id])) {
          $_SESSION['cart'][$id] = intval($_SESSION['cart'][$id]) + $quantity;
      } else {
          $stmt = $db->prepare('SELECT * FROM `products` WHERE `product_id`=:id');

          $stmt->bindParam(':id', $id, PDO::PARAM_INT);

          $stmt->execute();

          $data = $stmt->fetchAll();

          if (empty($data)) {
              // TODO add some error message
          } else {
              $_SESSION['cart'][$id] = $quantity;
          }
      }

      utils::redirect('index.php'); // Cleaning the query string
  }

  $products = $productsObj->listProducts();

  $body = 'templates/index.tpl.php';

  $errors = $productsObj->getErrors();

  include_once 'layouts/base.php';
