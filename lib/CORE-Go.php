<?php
error_reporting(E_ALL & ~E_NOTICE);
ini_set("display_errors", 1);

$DATABASE_HOST = "localhost";
$DATABASE_USER = "root";
$DATABASE_PASS = "";
$DATABASE_NAME = "exampledb";

$PATH_LIB = __DIR__ . DIRECTORY_SEPARATOR;
$PATH_BASE = dirname(PATH_LIB) . DIRECTORY_SEPARATOR;

session_start();

require PATH_LIB . "LIB-Core.php";
$_CORE = new Core();
?>