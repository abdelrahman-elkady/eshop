<?php
session_start();
include_once realpath(dirname(__FILE__).'/..').'/config/config.php';

$id = $_GET['id'];

unset($_SESSION['cart'][$id]);
