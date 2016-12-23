<?php 
class Get{
	public function getAllCate(){
		$cate = new Cate();
		echo encode_json($cate->getAllCate());
	}
	public function getArtComment($artid){
		$com = new Comment();
	}
}
 ?>