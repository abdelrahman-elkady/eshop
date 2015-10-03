<?php
include_once 'config/config.php';
session_start();

session_unset();

session_destroy();

Utils::redirect('index.php');
?>