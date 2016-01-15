<?php

/*
 * 引入配置
 */
require 'lib/inc.config.php';
//设置页面标题
$view->setAttr("title", "用户中心");

/*
 * 数据处理
 */


//检测是否登录
isLogin('PHPSESSID','login.php',null);

$url = 'http://120.25.205.100:88/opencart/index.php?route=moblie';

//$cookie = "PHPSESSID=".$_COOKIE['PHPSESSID'];

//$data = curl_request($url.'/index',null,$cookie);
$data = curl_request($url.'/index');
$result = json_decode($data,true);

echo '<pre>';var_dump($result);exit;

//未登录
if(isset($result->tip) && $result->tip == 'nologin'){
	var_dump($result->tip);
}


 
 /*
  * 渲染页面
  */



$view->userDetails = $result;

//输入页头、内容、页脚
$view->display("header.php")->display('user.php')->display('footer.php')->render();

