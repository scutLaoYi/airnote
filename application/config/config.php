<?php

/**
 * Configuration
 *
 * For more info about constants please @see http://php.net/manual/en/function.define.php
 * If you want to know why we use "define" instead of "const" @see http://stackoverflow.com/q/2447791/1114320
 */

/**
 * Configuration for: Error reporting
 * Useful to show every little problem during development, but only show hard errors in production
 */
error_reporting(E_ALL);
ini_set("display_errors", 1);

/**
 * Configuration for: Project URL
 * Put your URL here, for local development "127.0.0.1" or "localhost" (plus sub-folder) is fine
 */
define('URL', 'http://127.0.0.1:9999/');

/**
 * Configuration for: Database
 * This is the place where you define your database credentials, database type etc.
 */
define('DB_TYPE', 'mysql');
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'airnote');
define('DB_USER', 'airnote');
define('DB_PASS', '123456');

/**
  * Some path config
  */

define('CONTROLLER_PATH', './application/controller/');
define('VIEW_PATH', './application/views/');
define('MODEL_PATH', './application/models/');
define('TEMPLATE_PATH', './application/views/_templates/');
define('SERVICE_PATH', './application/service/');


