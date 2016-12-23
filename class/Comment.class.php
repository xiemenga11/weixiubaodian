<?php 
class Comment extends DB{
	public function __construct(){
		$this->table = "wx_art_comment";
	}
	public function getArtComment($artid){
		$sql = "
			SELECT 
				wx_art_comment.*,
				wx_user.nickname,
				wx_article.art_title
			FROM
				wx_art_comment
			LEFT JOIN 
				wx_user 
			ON 
				wx_art_comment.com_poster_id = wx_user.id
			LEFT JOIN 
				wx_article
			ON
				wx_art_comment.com_art_id = wx_article.art_id
			WHERE 
				wx_art_comment.com_art_id = $artid
		";
		$res = DB::query($sql);
		if(!$res){
			return false;
		}
		return $res;
	}
}
 ?>