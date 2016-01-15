<?php

/*
 * 引入配置
 */
require 'lib/inc.config.php';
//设置页面标题
$view->setAttr("title", "特产详情");

/*
 * 数据处理
 */



$url = 'http://120.25.205.100:88/opencart/index.php?route=moblie';

//$cookie = "PHPSESSID=".$_COOKIE['PHPSESSID'];


$id = $_GET['id'];
$data = curl_request($url.'/product&product_id='.$id);
$result = json_decode($data,true);


//$view->featureService = $result['featureService'];
//$view->options = $result['options'];

foreach($result as $key=>$value){
	if(!is_array($value)){
		$tempArr[$key] = $value;
	}
}

$view->shopinfo = $tempArr;



 /*
  * 渲染页面
  */


//echo '<pre>';var_dump($view->shopinfo);exit;

$view->display("header.php")->display('shop.php')->display('footer.php')->render();

