<?php 
class CatePage{
	private $cateId;

	public function home(){
		$cate = new Cate();
		echo encode_json($cate->getAllCate());
	}

	public function getCateArticle($limit = false,$length = 10){
		$cateId = $_GET['cateid'];
		// $limit = $limit !== false ? " LIMIT ".$limit.",".$length:"";
		$cate = new Article();
		$config = array(
				"where" => "art_cate = ".$cateId,
				"limit" => $limit,
				"order" => "art_id",
				"desc"  => true
			);
		echo encode_json($cate->fetchAll($config));
	}
}
 ?>