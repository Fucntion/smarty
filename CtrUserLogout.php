<?php

/*
 * 引入配置
 */
require 'lib/inc.config.php';


/*
 * 数据处理
 */

//删除登录信息
setcookie("PHPSESSID",'', time()-1);
	
 /*
  * 跳转页面
  */

  
//输入页头、内容、页脚

//清除模板
$view->clearTmpl();

//$view->display("header.php")->display('index.php')->display('footer.php')->render();
header('location:index.php');
  

