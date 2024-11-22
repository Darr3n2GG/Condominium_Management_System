<?php
error_reporting(E_ALL & ~E_NOTICE);
ini_set("display_errors", 1);

define("DATABASE_HOST", "localhost");
define("DATABASE_USER", "root");
define("DATABASE_PASS", "");
define("DATABASE_NAME", "exampledb");

// (C) AUTO FILE PATHS
define("PATH_LIB", __DIR__ . DIRECTORY_SEPARATOR);
define("PATH_BASE", dirname(PATH_LIB) . DIRECTORY_SEPARATOR);

session_start();

require PATH_LIB . "LIB-Core.php";
$_CORE = new Core();
?>