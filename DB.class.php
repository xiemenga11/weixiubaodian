<?php 
class DB{
	protected $require;
	protected $table;

	public function __construct($table){
		$this->table = $table;
	}

	public static function connect(){
		if(!mysql_connect(DB_HOST,DB_USER,DB_PASS)){
			return mysql_errno().":".mysql_error();
		}
		if(!mysql_select_db(DB_DB)){
			return mysql_errno().":".mysql_error();
		}
		mysql_query("set names utf8");
	}
	public static function query($sql){
		$sql = mysql_query($sql);
		if(!$sql){
			return false;
		}

		while($data = mysql_fetch_assoc($sql)){
			$d[] = $data;
		}
		return $d;
	}

	/**
	 * 获得全部数据
	 * @param  array $config 配置数组
	 * $config = {
	 * 		key:string 要得到的字段；默认：*（全部）,
	 * 		where:string 要得到的where条件,
	 * 		order:string 根据什么排序
	 * 		desc:boolean 是否倒序排序;默认正序排序
	 * 		limit:int 数据范围；例：1  或   1,4;
	 * }
	 * @return array         返回获取到的数据
	 */
	public function fetchAll($config=null){
		$key   = isset($config['key'])?$config['key']:"*";
		$where = isset($config['where'])?" WHERE ".$config['where']:null;
		$order = isset($config['order'])?" ORDER BY ".$config['order']:null;
		$desc  = isset($config['desc'])&&$config['desc']==true?" DESC":null;
		$limit = isset($config['limit'])?" LIMIT ".$config['limit']:null;
		$sql   = "SELECT ".$key." FROM ".$this->table.$where.$order.$desc.$limit;
		$sql = mysql_query($sql);
		$data = array();
		if($sql){
			while($d = mysql_fetch_assoc($sql)){
				$data[] = $d;
			}
		}else{
			$data = mysql_errno().":".mysql_error();
		}
		return $data;
	}
	/**
	 * 得到一个数据
	 * @param  array $config 配置信息
	 * $config = {
	 * 		key:string 要得到的字段；默认：*（全部）,
	 * 		where:string 要得到的where条件		
	 * }
	 * @return array         得到一条数据的数组
	 */
	public function fetchOne($config = null){
		$key   = isset($config['key'])?$config['key']:"*";
		$where = isset($config['where'])?" WHERE ".$config['where']:null;
		$sql   = "SELECT ".$key." FROM ".$this->table.$where;
		$sql   = mysql_query($sql);
		if($sql){
			return mysql_fetch_assoc($sql);
		}else{
			return mysql_errno().":".mysql_error();
		}
	}
	/**
	 * 添加数据表
	 * @param  array $config 数据表的字段信息
	 * @return string         创建的数据表的数据表名
	 */
	public function creTB($config){
		$config = join(",",$config);
		$sql    = "CREATE TABLE IF NOT EXISTS ".$this->table." (".$config.")";
		if(mysql_query($sql)){
			return $this->table;
		}else{
			return $this->error();
		}
	}
	/**
	 * 添加数据
	 * @param  array $data 要添加的数据数组；例如：$_POST
	 * @return int       返回添加数据后生成的ID
	 */
	public function insert($data){
		foreach ($data as $k => $v) {
			$key[] = $k;
			$val[] = $v;
		}
		$key = join(",",$key);
		$val = "'".join("','",$val)."'";
		$sql = "INSERT INTO ".$this->table." ($key) VALUES ($val)";
		if(mysql_query($sql)){
			return mysql_insert_id();
		}else{
			// return $this->error();
			return false;
		}
	}
	/**
	 * 删除数据
	 * @param  string $where 删除条件
	 * @return boolean        成功返回true
	 */
	public function delete($where){
		$sql = "DELETE FROM ".$this->table." WHERE ".$where;
		if(mysql_query($sql)){
			return true;
		}else{
			return false;
		}
	}
	/**
	 * 修改数据
	 * @param  array $config 修改数据的配置
	 * $config = {
	 * 		data:array 要修改的数据,
	 * 		where:string 修改条件
	 * 
	 * }
	 * @return boolean         成功返回true
	 */
	public function update($config){
		foreach ($config['data'] as $k => $v) {
			$sql[] = $k."='".$v."'";
		}
		$data = join(",",$sql);
		$where = " WHERE ".$config['where'];
		$sql = "UPDATE ".$this->table." SET ".$data.$where;
		if($sql = mysql_query($sql)){
			return true;
		}else{
			return false;
		}
	}
	/**
	 * 执行SQL语句
	 * @param  string $sql sql语句
	 * @return array      返回执行得到的数据
	 */
	public static function selectQuery($sql){
		$d = false;
		if($sql = mysql_query($sql)){
			while($data = mysql_fetch_assoc($sql)){
				$d[] = $data;
			}
		}
		return $d;
	}
	/**
	 * 得到数据的条数
	 * @param  string $where 得到数据的条件
	 * @return int        返回指定数据的条数
	 */
	public function count($where = null){
		$where = $where ?" WHERE ".$where:null;
		$sql = "SELECT COUNT(*) AS count FROM ".$this->table.$where;
		$sql = mysql_query($sql);
		if($sql){
			$count = mysql_fetch_assoc($sql);
			$count = $count['count'];
			return $count;
		}else{
			return false;
		}
	}
	/**
	 * 得到某个字段数据的总数
	 * @param  string $what  要得到数据总数的字段
	 * @param  string $where 得到数据的条件
	 * @return int        返回指定字段的总数
	 */
	public function sum($what,$where = null){
		$where = $where?" WHERE ".$where:null;
		$sql = "SELECT SUM(".$what.") AS total FROM ".$this->table.$where;
		$sql = mysql_query($sql);
		if($sql){
			$total = mysql_fetch_assoc($sql);
			return $total['total'];
		}else{
			return false;
		}
	}
	/**
	 * 得到 mysql 错误数据
	 * @return array 返回错误数据数组
	 */
	public function error(){
		$data['errno'] = mysql_errno();
		$data['error'] = mysql_error();
		return $data;
	}
	/**
	 * 数据自动增长
	 * @param  array $config 同fetchOne的一样 ; 
	 * $config['plus'] int 可选   每次增加多少，默认为 1
	 * @return boolean         成功：true;失败：false
	 */
	public function increment($config){
		$plus = isset($config['plus'])?$config['plus']:1;
		$data = $this->fetchOne($config);
		foreach ($data as $key => $value) {
			$data[$key] = $value+$plus;
		}
		if(!$data){
			return false;
		}
		$res = $this->update(array(
				"data" => $data,
				"where" => $config['where']
			));
		if($res){
			return true;
		}else{
			return false;
		}
	}
	/**
	 *字段开关
	 * @param  array $config 同fetchOne一样 ; 
	 * $config['true'] multiple 为真时的数据 ; 
	 * $config['false'] multiple 为假时的数据
	 * @return boolean         成功：true  失败:false
	 */
	public function toggle($config){
		$data = $this->fetchOne($config);

		if(!$data){
			return false;
		}

		foreach ($data as $key => $value) {
			if($data[$key] == $config['false']){
				$data[$key] = $config['true'];
			}else{
				$data[$key] = $config['false'];
			}
		}

		$res = $this->update(array(
				"data" => $data,
				"where" => $config['where']
			));
		if($data){
			return true;
		}else{
			return false;
		}
	}
	/**
	 * 设置不能为空和必须的字段
	 * @param array $require 需求字段的设置数组
	 * $require = {
	 * 		$key:字段名称
	 * }
	 */
	public function setRequire($require){
		$this->require = $require;
	}
	/**
	 * 检查需求字段是否被设置和是否为空
	 * @param  array $data     被检查的数组
	 * @param  callback $callback 如果为空的回调函数
	 * @return [type]           [description]
	 */
	public function checkRequire($data,$callback){
		foreach ($this->require as $key => $value) {
			if(!isset($data[$key])||str::isEmpty($data[$key])){
				$callback($value);
			}
		}
	}
}
?>