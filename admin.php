<?php 
require_once 'include.php';
 ?>
 <!doctype html>
 <html>
 <head>
 	<meta charset="UTF-8">
 	<title>后台管理</title>
 	<link rel="stylesheet" href="css/leo.css">
 	<style>
 		body{
 			padding:20px;
 		}
		.mar-tb{
			font-size:20px;
			font-weight: bold;
			color:#007aff;
		}
 	</style>
 </head>
 <body>
	<form action="index.php?c=add&m=addArticle" method="post">
 		<div id="addArticleBox" class="container col-span-8">
 			<div class="mar-tb">添加文章</div>
 			<hr>
	 		<input class="mar-bottom" type="text" name="art_title" placeholder="请输入文章标题">
	 		<input class="mar-bottom" type="text" name="art_des" placeholder="请输入文章简介">
	 		<select class="mar-bottom" name="art_cate">
	 			<option value="1">冰箱</option>
	 		</select>
	 		<textarea class="ckeditor mar-bottom" name="art_content" placeholder="文章内容"></textarea>
	 		<input type="submit" value="发表文章">
	 	
 		</div>
 	</form>

 	<form action="index.php?c=add&m=addCate" method="post">
 		<div class="container col-span-8">
 			<div class="mar-tb">添加分类</div>
 			<hr>
 			<input class="mar-bottom"  type="text" name="cate_name" placeholder="分类名称">
 			<select  class="mar-bottom" name="cate_parent_id" id="">
 				<option value="">无</option>
 				<option value="1">冰箱</option>
 			</select>
 			<input class="mar-bottom"  type="file" name="cate_icon">
 			<input class="mar-bottom"  type="submit" value="添加分类">
 		</div>
 	</form>
 <script src="js/selector.js"></script>
 <script src="CKEditor/ckeditor.js"></script>
 </body>
 </html>