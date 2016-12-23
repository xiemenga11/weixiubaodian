<?php 
class Cate extends DB{
	private $cateId;
	public function __construct(){
		$this->table = "wx_cate";
	}

	public function getAllCate(){
		return $this->fetchAll();
	}
	public function setCateId($id){
		$this->cateId = $id;
		return $this->cateId;
	}
	public function getCateId(){
		return $this->cateId;
	}
	public function addCate($data){
		$notNull = array(
				"cate_name" => "分类名称"
			);
		str::cleanAll($data);
		$res['status'] = "success";
		$res['error'] = false;
		foreach($notNull as $k => $v){
			if(str::isEmpty($data[$k])){
				$res['insertId'] = -1;
				$res['status'] = "failed";
				$res['error'] = $v."不能为空";
			}
		}
		if(!$res['error']){
			$res['insertId'] = $this->insert($data);
			if(!$res['insertId'] || $res['insertId'] == -1){
				$res['insertId'] = -1;
				$res['status'] = "failed";
				$res['error'] = "添加分类失败";
			}else{
				$res['status'] = "success";
				$res['error'] = false;
			}	
		}
		
		return $res;
	}
}
 ?>