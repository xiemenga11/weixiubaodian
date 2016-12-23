<?php 
class Add{
	public function addCate(){
		$cate = new Cate();
		echo encode_json($cate->addCate($_POST));
	}
	public function addArticle(){
		$_POST['art_poster_id'] = 1;
		$art = new Article();
		echo encode_json($art->addArticle($_POST));
	}
	public function addUser(){
		$user = new User();
		echo encode_json($user->addUser($_POST));
	}
}
 ?>