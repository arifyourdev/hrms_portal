<?php
ob_start(); // turn on output buffering
 
$base_url_admin = "https://".$_SERVER['HTTP_HOST']."/admin/";
$base_url = "https://".$_SERVER['HTTP_HOST']."";

 
// Assign file paths to PHP constants
// __FILE__ returns the current path to this file
// dirname() returns the path to the parent directory
define("PRIVATE_PATH", dirname(__FILE__));
define("PROJECT_PATH", dirname(PRIVATE_PATH));
defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
define('SITE_ROOT', $base_url_admin);

// Assign the root URL to a PHP constant
// * Do not need to include the domain
// * Use same document root as webserver
// * Can set a hardcoded value:ni
// define("WWW_ROOT", '');
// * Can dynamically find everything in URL up to "/public"
$public_end = strpos($_SERVER['SCRIPT_NAME'], '/admin') + 7;
$doc_root = substr($_SERVER['SCRIPT_NAME'], 0, $public_end);
define("WWW_ROOT", $doc_root);
// define('SITE_ROOT', 'C:' . DS . 'XAMPP' . DS . 'htdocs' . DS . 'karchi-king');

require_once('functions.php');
require_once('status_error_functions.php');
require_once('db_credentials.php');
require_once('database_functions.php');
require_once('validation_functions.php');

// Load class definitions manually

// Autoload class definitions
function my_autoload($class)
{
  if (preg_match('/\A\w+\Z/', $class)) {
    include  'classes/'  . $class . '.class.php';
  }
}

spl_autoload_register('my_autoload');
 

$database = db_connect();
DatabaseObject::set_database($database);

$session = new Session;