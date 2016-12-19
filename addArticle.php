<?php 
require_once 'index.php';
$art = new Article();
$checkpass = $art->checkData($_POST);
echo json_encode($art->addArticle($_POST));
?>