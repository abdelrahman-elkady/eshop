<?php

define('DB_HOSTNAME','localhost');
define('DB_NAME','test');
define('DB_USER','dummy');
define('DB_PASS','dummyPass');

// Absolute path to current file's dir
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');


$db = new PDO("mysql:host=".DB_HOSTNAME.";dbname=" . DB_NAME , DB_USER, DB_PASS);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>
