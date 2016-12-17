<?php 
require_once 'index.php';
$data = array(
		"art_title"=>"放叶",
		"art_des"=>"seletadfasd",
		"art_content"=>"asdfsdaf",
		"art_cate"=>1,
		"art_poster_id"=>1
	);
$art = new Article();
$checkpass = $art->checkData($data);
echo json_encode($art->addArticle($data));
 ?>