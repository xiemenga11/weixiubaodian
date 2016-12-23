<?php 
require_once 'include.php';

if($_POST){
	foreach($_POST as $k => $v){
		$_SESSION[$k] = $v;
	}
}
echo encode_json($_SESSION);
 ?>