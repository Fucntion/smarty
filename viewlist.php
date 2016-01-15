<?php

/*
 * 引入配置
 */
require 'lib/inc.config.php';
//设置页面标题
$view->setAttr("title", "景区列表");

/*
 * 数据处理
 */



$url = 'http://120.25.205.100:88/opencart/index.php?route=moblie';

//获取列表无需带cookie
//$cookie = "PHPSESSID=".$_COOKIE['PHPSESSID'];

$data = curl_request($url.'/productList&path=59');
$result = json_decode($data,true);
//var_dump($result);exit;


 /*
  * 渲染页面
  */



$view->viewList = $result['products'];

//echo '<pre>';var_dump($result['products']);exit;

//输入页头、内容、页脚
$view->display("header.php")->display('viewlist.php')->display('footer.php')->render();

