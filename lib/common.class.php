<?php 
/*
 * 第一个参数登录则返回true，第二个参数为ture且未登录时时则跳转到登录页面，第三个参数存在且已经登录跳转到目标页面。
 */
 
function isLogin($cookiename,$target,$url){
	if(isset($_COOKIE["$cookiename"])){
		if($url){
			header("location:$url");
			return;
		}
		return true;
	}else{
		if($target){
			header("location:$target");
			return ;
		} 
		return false;
	}
}


$url = 'http://120.25.205.100:88/opencart/index.php?route=moblie/category';

$data = curl_request($url);
$result = json_decode($data,true);
//echo "<pre>";var_dump($result);
$view->nav = $result;

