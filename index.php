<?php 
session_start();
header("Content-type:text/html; charset=utf-8");
define("DB_HOST","localhost");
define("DB_USER","root");
define("DB_PASS","");
define("DB_DB","weixiubaodian");
require_once 'DB.class.php';
require_once 'ads.class.php';
require_once 'Article.class.php';
require_once 'string.class.php';
require_once 'User.class.php';
DB::connect();

 ?>