<?php

/*
 * 引入配置
 */
require 'lib/inc.config.php';
//设置页面标题
$view->setAttr("title", "美食列表");

/*
 * 数据处理
 */




$url = 'http://120.25.205.100:88/opencart/index.php?route=moblie';

//$cookie = "PHPSESSID=".$_COOKIE['PHPSESSID'];

$data = curl_request($url.'/productList&path=61');
$result = json_decode($data,true);
//exit;


 /*
  * 渲染页面
  */



$view->restaurantList = $result['products'];

//echo '<pre>';var_dump($result);exit;

//输入页头、内容、页脚
$view->display("header.php")->display('restaurantlist.php')->display('footer.php')->render();

