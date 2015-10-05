<?php

/* Database credentials
 *
 * It should define the following variables :
 *
 * [ DB_HOSTNAME, DB_NAME, DB_USER, DB_PASS ]
 *
 */
include_once 'config/db_credentials.php';

// Absolute path to current file's dir
if (!defined('ABSPATH')) {
    define('ABSPATH', dirname(__FILE__).'/');
}

// The host name
if (!defined('HOSTNAME')) {
  define('HOSTNAME','http://localhost:1234/');
}

$db = new PDO('mysql:host='.DB_HOSTNAME.';dbname='.DB_NAME, DB_USER, DB_PASS);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

function __autoload($className)
{
    // All our classes should be included into files with the same name but in lowercase!
    include 'classes/'.strtolower($className).'.class.php';
}

$userObj = new User($db);
$productsObj = new Products($db);
?>
