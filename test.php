<?php 
require_once 'include.php';
$com = new Comment();
var_dump($com->getArtComment(1));
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