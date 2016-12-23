<?php 
class Userpage{
	public function userInfo(){
		$id = $_GET['userid'];
		$user = new User($id);
		$sql = "
			SELECT 
				wx_user.id,
				wx_user.userid,
				wx_user.nickname,
				wx_user.description,
				wx_user.phone,
				wx_user.address,
				wx_user.mail,
				wx_user.headimg,
				wx_user.score,
				wx_user.gold,
				wx_user.level,
				wx_user.role,
				wx_user.regtime,
				count(art_id) as art_amount,
				count(c_id) as collection_amount,
				count(f_id) as friend_amount
			FROM 
				wx_user 
			LEFT JOIN 
				wx_article
			ON 
				wx_user.id = wx_article.art_poster_id
			LEFT JOIN 
				wx_collection
			ON 
				wx_user.id = wx_collection.c_user_id
			LEFT JOIN 
				wx_friend
			ON 
				wx_user.id = wx_friend.f_hoster_id
			WHERE 
				id = ".$id;
		$userinfo = $user->query($sql);
		echo encode_json($userinfo[0]);
	}
}
 ?>