<?php 
class Article extends DB{
	public function __construct(){
		$this->table = "wx_article";
	}

	public function getAllArticle(){
		return $this->fetchAll();
	}
	/**
	 * 判断文章是否为显示状态
	 * @param  int $art_id 文章ID
	 * @return boolean         如果文章的状态为显示：true,否则：false
	 */
	public function artIsShow($art_id){
		$config = array(
				"key" => "is_show",
				"where" => "art_id = ".$art_id
			);
		$isShow = $this->fetchOne($config);
		$isShow = $isShow['is_show'];
		if($isShow == 0){
			return false;
		}else{
			return true;
		}
	}
	/**
	 * 文章浏览数自增
	 * @param  int $art_id 浏览要自增的文章ID
	 * @return boolean         自增成功：true;否则：false
	 */
	public function artViewIncrement($art_id){
		$config = array(
				"key" => "art_view",
				"where" => "art_id = ".$art_id
			);
		return $this->increment($config);
	}

	public function artToggles($art_id,$toggle_key){
		$config = array(
				"key" => $toggle_key,
				"where" => "art_id = ".$art_id,
				"true" => 1,
				"false" =>0
			);
		return $this->toggle($config);
	}
}
 ?>