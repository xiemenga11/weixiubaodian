<?php 
class Cate extends DB{
	public function __construct(){
		$this->table = "wx_cate";
	}

	public function getAllCate(){
		return $this->fetchAll();
	}
	public function addCate($data){
		$res = $this->insert($data);
		if($res){
			$res = array(
					"insertId"=>$res,
					"status"=>"success"
				);
		}else{
			$res = array(
					"insertId"=>false,
					"status"=>"failed"
				);
		}
		return $res;
	}
}
 ?>