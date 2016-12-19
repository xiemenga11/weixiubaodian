<?php 
require_once 'index.php';

$arts = new Article();
var_dump($arts->getAllArticle());
     
echo encode_json($arts->getAllArticle());
 ?>