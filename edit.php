<?php

/*
 * 引入配置
 */
require 'lib/inc.config.php';
//设置页面标题
$view->setAttr("title", "修改用户资料");

/*
 * 数据处理
 */


//检测是否登录
isLogin('PHPSESSID','login.php',null);

$url = 'http://120.25.205.100:88/opencart/index.php?route=moblie';

$cookie = "PHPSESSID=".$_COOKIE['PHPSESSID'];

$data = curl_request($url.'/account/edit',null,$cookie);
$result = json_decode($data);

//未登录
if(isset($result->tip) && $result->tip == 'nologin'){
	var_dump($result->tip);
}


 
 /*
  * 渲染页面
  */

  foreach($result as $key => $value){

	  $userDetails[$key] = $value;
  }


$view->userDetails = $userDetails;

//输入页头、内容、页脚
$view->display("header.php")->display('edit.php')->display('footer.php')->render();

