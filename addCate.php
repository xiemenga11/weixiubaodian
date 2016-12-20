<?php 
require_once 'index.php';

$cate = new Cate();
echo encode_json($cate->addCate($_POST));
 ?>