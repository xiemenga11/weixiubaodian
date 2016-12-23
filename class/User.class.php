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
	public function addUser($data){
		$res['status'] = false;
		$res['insertId'] = -1;
		if(str::isEmpty($data['userid'])){
			$res['err'] = "用户名不能为空";
		}else if(str::isEmpty($data['password']) || str::isEmpty($data['repassword'])){
			$res['err'] = "密码不能为空";
		}else if(str::isEmpty($data['nickname'])){
			$res['err'] = "昵称不能为空";
		}else if ($data['password'] != $data['repassword']){
			$res['err'] = "两次密码输入不一致";
		}else if(str::isEmpty($data['phone'])){
			$res['err'] = "电话不能为空";
		}else{
			$res['status'] = true;
			unset($data['repassword']);
		}
		if($res['status'] == true){
			$res['insertId'] = $this->insert($data);
		}
		return $res;
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
		$config = array(
				"key" => "id,userid,nickname,description,phone,address,mail,headimg,score,gold,level,role,regtime"
			);
		return $this->fetchAll($config);
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