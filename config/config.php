<?php

/* Database credentials
 *
 * It should define the following variables :
 *
 * [ DB_HOSTNAME, DB_NAME, DB_USER, DB_PASS ]
 *
 */
include_once('config/db_credentials.php');

// Absolute path to current file's dir
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');


$db = new PDO("mysql:host=".DB_HOSTNAME.";dbname=" . DB_NAME , DB_USER, DB_PASS);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>
