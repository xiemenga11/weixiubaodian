<?php 
$c = isset($_GET['c'])?$_GET['c']:"Homepage";
$m = isset($_GET['m'])?$_GET['m']:"home";

require_once 'include.php';
require_once 'controller/'.$c.'Controller.class.php';

$con = new $c();
$con->$m();
 ?>