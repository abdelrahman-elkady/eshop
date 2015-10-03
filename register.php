<?php
session_start();

include_once 'config/config.php';
$bottom_scripts = 'assets/js/app.js';
if($userObj->isSignedIn()){

	$body = 'templates/index.tpl.php';

}else{

	$body = 'templates/register.tpl.php';

	if($_SERVER['REQUEST_METHOD'] == 'POST') {
	  $userObj->registerUser();
	  unset($_SERVER['REQUEST_METHOD']);
	}

}

$errors = $userObj->getErrors();
include_once 'layouts/base.php';

?>
