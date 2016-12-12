<?php

/**
 * Config settings
 *
 * @author Ishaq Jound 
 **/

/**
 * Start Session.
 *
 * @author Ishaq Jound 
 **/
session_start();


/**
 * Autoloader for classes.
 *
 * @author Ishaq Jound
 **/
function __autoload($className) {
      if (file_exists("classes/{$className}.php")) {
          require_once "classes/{$className}.php";
          return true;
      }
      return false;
  }

error_reporting(1);

/**
 * Setting up database connection.
 * Change database settings here. For example: $database['database']['dsn'] = mysql:host=YOUR_HOST;dbname=YOUR_DATABASE_NAME;
 * 											   $database['database']['username'] = DATABASE_USERNAME
 * 											   $database['database']['password'] = DATABASE_PASSWORD
 * @author Ishaq Jound 
 **/
$database = array();
$database['database']['dsn'] 		= 'mysql:host=localhost;dbname=shopping;';
$database['database']['username']	= 'root';
$database['database']['password']	= 'root';
$database['database']['drivers']	= array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'");
$db = new Database($database['database']);
