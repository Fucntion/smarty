<?php

/*
 * 引入配置
 */
require 'lib/inc.config.php';

//设置页面标题
$view->setAttr("title", "登录");

/*
 * 数据处理
 */
 
 
//检测是否登录,如果已经登录则跳转到首页
isLogin('PHPSESSID',null,'index.php');


 /*
  * 渲染页面
  */
  
//输入页头、内容、页脚
$view->display("header.php")->display('login.php')->display('footer.php')->render();

