<?php

/*
 * 引入配置
 */
require 'lib/inc.config.php';


/*
 * 数据处理
 */

$url = 'http://120.25.205.100:88/opencart/index.php?route=moblie';
$data = curl_request($url.'/login',$_POST,null,true);
$content = json_decode($data['content']);
//var_dump($data);
if($content->status == 'success'){
	
	//保存cookie
	setcookie("PHPSESSID",'', time()-1);
	setcookie("PHPSESSID",substr($data['cookie'], 10), time()+3600);
	//清除模板
	$view->clearTmpl();
	header('location:index.php');
	
}else{
	header('location:login.php');
	
}

 
 /*
  * 渲染页面
  */
  

