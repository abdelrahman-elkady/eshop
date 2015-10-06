<?php


  include_once realpath(dirname(__FILE__).'/..').'/config/config.php';

  $id = $_GET['id'];

  $stmt = $db->prepare('SELECT * FROM `products` WHERE `product_id`=:id');

  $stmt->bindParam(':id', $id, PDO::PARAM_INT);

  $stmt->execute();

  $data = $stmt->fetch(PDO::FETCH_BOTH);

  header('Content-Type: application/json');

  echo json_encode($data);
