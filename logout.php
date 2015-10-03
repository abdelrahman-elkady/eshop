<?php
session_start();

session_unset();

session_destroy();

header("Location: http://localhost:1234/index.php"); /* Redirect browser */
exit();
?>