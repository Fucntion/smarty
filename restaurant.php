<?php

/*
 * 引入配置
 */
require 'lib/inc.config.php';
//设置页面标题
$view->setAttr("title", "美食详情");

/*
 * 数据处理
 */




$url = 'http://120.25.205.100:88/opencart/index.php?route=moblie';

//$cookie = "PHPSESSID=".$_COOKIE['PHPSESSID'];


$id = $_GET['id'];
$data = curl_request($url.'/product&product_id='.$id);
$result = json_decode($data,true);



 /*
  * 渲染页面
  */


//$view->featureService = $result['featureService'];
//$view->options = $result['options'];

foreach($result as $key=>$value){
	if(!is_array($value)){
		$tempArr[$key] = $value;
	}
}

$view->restaurantinfo = $tempArr;
//foreach($result)
//echo '<pre>';var_dump($view->shopinfo);exit;
//echo '<pre>';var_dump($result['products']);exit;

//输入页头、内容、页脚

//这里采用不规范命名是因为避免和view类冲突
$view->display("header.php")->display('restaurant.php')->display('footer.php')->render();

