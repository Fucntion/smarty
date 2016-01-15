<?php 



/*
 * 引入配置
 */
require 'lib/inc.config.php';

/*
 * 数据处理
 */

//清除模板




//检测是否登录
isLogin('PHPSESSID','login.php',null);

$cookie = "PHPSESSID=".$_COOKIE['PHPSESSID'];


$url = 'http://120.25.205.100:88/opencart/index.php?route=moblie';
$data = curl_request($url.'/account/edit',$_POST,$cookie);
$result = json_decode($data);




 
 /*
* 渲染页面
*/
if($result->status == 'success'){
	
	header('location:index.php');
	
}else{
	header('location:edit.php');
	
}

//echo $data;exit;


//输入页头、内容、页脚
//header('location:index.php');


