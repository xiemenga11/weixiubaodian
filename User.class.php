<?php 
class User extends DB{
	protected $id;
	protected $userInfo;

	public function __construct($id = null){
		$this->table = "wx_user";
		if($id != null){
			$this->id = $id;
			$this->userInfo = $this->fetchOne(array(
					"where" => "id = ".$this->id
				));
		}
	}
	public function setId($id){
		$this->id = $id;
		return $this->id;
	}
	public function getId(){
		return $this->id;
	}
	public function getGold(){

		return $this->userInfo['gold']*1;
	}
	public function getAllUser(){
		return $this->fetchAll();
	}
	public static function isLogin(){
		if(!isset($_SESSION["id"])||!isset($_SESSION["userid"])){
			return false;
		}else{
			return true;
		}
	}
	public function pay($gold){
		if($this->getGold()<$gold){
			return false;
		}
		return $this->increment(array(
				"key" => "gold",
				"where" => "id = ".$this->id,
				"plus" => $gold*-1
			));
	}
	public function earn($gold){
		return $this->increment(array(
				"key" => "gold",
				"where" => "id = ".$this->id,
				"plus" => $gold*1
			));
	}
}
 ?>