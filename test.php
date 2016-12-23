<?php 
require_once 'include.php';

// $data['ads'] = array(
// 		"title"=>"leo"
// 	);
// $art = new Article();
// $data['article'] = $art->getAllArticle();
// echo encode_json($data);
$str = array('<selecleoxie""aldkfla""adlkf>');
function haha(&$str){
	str::cleanAll($str);
}
function v($data){
	haha($data);
	var_dump($data);
}
v($str);
 ?>
 <!doctype html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<title>Document</title>
 	<style>
		.leo *{
			color:red;
		}
 	</style>
 </head>
 <body>
 	<h1>xie</h1>
	<div>meng</div>
	<p>hahah</p>
 	<div class="leo">
 		<h1>xie</h1>
 		<div>meng</div>
 		<p>hahah</p>
 	</div>
 </body>
 </html>