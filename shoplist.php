<?php

/*
 * 引入配置
 */
require 'lib/inc.config.php';
//设置页面标题
$view->setAttr("title", "特产列表");

/*
 * 数据处理
 */




$url = 'http://120.25.205.100:88/opencart/index.php?route=moblie';

//$cookie = "PHPSESSID=".$_COOKIE['PHPSESSID'];

$data = curl_request($url.'/productList&path=62');
$result = json_decode($data,true);
//exit;


 /*
  * 渲染页面
  */



$view->shopList = $result['products'];

//echo '<pre>';var_dump($view->shopList);exit;

//输入页头、内容、页脚
$view->display("header.php")->display('shoplist.php')->display('footer.php')->render();

