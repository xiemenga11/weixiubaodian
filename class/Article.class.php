<?php 
class Article extends DB{
	protected $art_id;

	public function __construct($art_id = null){
		$this->table = "wx_article";
		if($art_id!=null){
			$this->art_id = $art_id;
		}
	}

	public function checkData(&$data){
		$notnull = array(
				"art_title" => "标题",
				"art_content" => "内容",
				"art_cate" => "分类",
				"art_poster_id" => "发布人"
			);
		$checkpass['status'] = true;
		$checkpass['error'] = false;
		//净化数据，防止入侵
		// foreach($data as $k => $v){
		// 	$data[$k] = str::clean($v);
		// }
		str::cleanAll($data);

		foreach($notnull as $k => $v){
			if(str::isEmpty($data[$k])){
				$checkpass['status'] = false;
				$checkpass['error'] = $v."不能为空";
			}
		}
		return $checkpass;
	}

	public function addArticle($data){
		$pass = @$this->checkData($data);

		if($pass['status']){
			$info['insertId'] = $this->insert($data);
			$info['status'] = "success";
			$info['error'] = false;
		}else{
			$info['insertId'] = -1;
			$info['status'] = "failed";
			$info['error'] = $pass['error'];
		}
		return $info;
	}

	public function getAllArticle($limit = false,$length = 10){
		$limit = $limit !== false? " LIMIT ".$limit.",".$length : "";

		$sql = "
			SELECT
				wx_article.*,
				wx_user.id,
				wx_user.userid,
				wx_user.nickname
			FROM 
				wx_article
			LEFT JOIN 
				wx_user 
			ON 
				wx_article.art_poster_id = wx_user.id
			".$limit;
		return DB::query($sql);
	}

	public function setArtId($art_id){
		$this->art_id = $art_id;
		return $this->art_id;
	}

	public function getArtId(){
		return $this->art_id;
	}
	/**
	 * 判断文章是否为显示状态
	 * @param  int $art_id 文章ID
	 * @return boolean         如果文章的状态为显示：true,否则：false
	 */
	public function artIsShow(){
		$config = array(
				"key" => "is_show",
				"where" => "art_id = ".$this->art_id
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
	public function artViewIncrement(){
		$config = array(
				"key" => "art_view",
				"where" => "art_id = ".$this->art_id
			);
		return $this->increment($config);
	}
	/**
	 * 文章各种开关
	 * @param  int $art_id     要开关的文章ID
	 * @param  string $toggle_key 要开关的字段名
	 * @return boolean             成功：true;失败：false
	 */
	public function artToggles($toggle_key){
		$config = array(
				"key" => $toggle_key,
				"where" => "art_id = ".$this->art_id,
				"true" => 1,
				"false" =>0
			);
		return $this->toggle($config);
	}

	public function getAllcomments(){
		$sql = "
			SELECT
				wx_art_comment.*,
				wx_user.id,
				wx_user.userid,
				wx_user.nickname,
				count(wx_art_comment.com_id) as com_total
			FROM 
				wx_art_comment
			LEFT JOIN 
				wx_user
			ON 
				wx_art_comment.com_poster_id = wx_user.id
			WHERE 
				wx_art_comment.com_art_id = ".$this->art_id
		;
		return DB::query($sql);
	}

	public function setPayment($gold){
		$this->update(array(
				"data" => array(
						"art_pay_for_view" => $gold
					),
				"where" => "art_id = ".$this->art_id
			));
	}
	public function getPayment(){
		$pay = $this->fetchOne(array(
				"key" => "art_pay_for_view",
				"where" => "art_id = ".$this->art_id
			));
		return $pay['art_pay_for_view']*1;
	}
}
 ?>