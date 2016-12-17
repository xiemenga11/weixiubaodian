<?php 
header("Content-type:text/html; charset=utf-8");
define("DB_HOST","localhost");
define("DB_USER","root");
define("DB_PASS","");
define("DB_DB","weixiubaodian");
require_once 'DB.class.php';
require_once 'ads.class.php';
require_once 'Article.class.php';
require_once 'string.class.php';
require_once 'User.class.php';
DB::connect();
$ads = new Ads();
$art = new Article();
$user = new User(1);
var_dump($user->getAllUser());
// var_dump($ads->adViewed(1));
var_dump($ads->adViewIncrement(1));
var_dump($ads->adShowToggle(1));
var_dump($art->getAllArticle());
var_dump($ads->getAllAds());
$art->setArtId(1);
$art->setPayment(5);
var_dump($art->getAllComments());
$art->artViewIncrement();
var_dump($user->pay(10));
var_dump($art->getPayment());
var_dump($user->getGold());
 ?>