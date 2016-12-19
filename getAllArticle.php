<?php 
require_once 'index.php';

$arts = new Article();
     
echo encode_json($arts->getAllArticle());
 ?>