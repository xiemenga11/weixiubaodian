<?php 
class Ads extends DB{
	public function __construct(){
		$this->table = "wx_ads";
	}

	
	public function getAllAds($limit = null){
		$config = array(
				"key"   => "ad_id,ad_title,ad_position,ad_time,ad_expire_time,ad_view,is_show",
				"order" => "ad_id",
				"desc"  => true,
				"limit" => $limit
			);
		return $this->fetchAll($config);
	}
	
	public function adViewIncrement($ad_id){
		$config = array(
				"key" => "ad_view",
				"where" => "ad_id = ".$ad_id
			);
		return $this->increment($config);
	}

	public function adShowToggle($ad_id){
		$config = array(
				"key" => "is_show",
				"where" => "ad_id = ".$ad_id,
				"true" => 1,
				"false" => 0
			);
		return $this->toggle($config);
	}
}
 ?>