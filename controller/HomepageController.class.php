<?php 
class Homepage{
	public function home(){
		$ads = new Ads();
		$art = new Article();
		$data['ads'] = $ads->getAllAds(4);
		$data['article'] = $art->getAllArticle(0);
		echo encode_json($data);
	}
}

 ?>