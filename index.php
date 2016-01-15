<?php


/*
 * 引入配置
 */
require 'lib/inc.config.php';


$view->setAttr("title", "首页");

/*
 * 数据处理
 */
 

 
 /*
  * 渲染页面
  */
  
  
//输入页头、内容、页脚
$view->display("header.php")->display('index.php')->display('footer.php')->render();
//$view->display('index.php')->render();

