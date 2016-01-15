<?php



/*
 * 引入配置
 */
require 'lib/inc.config.php';

/*
 * 数据处理
 */

 
 
$history = $_GET['history'];
//清除模板
$view->clearTmpl();



 /*
* 渲染页面
*/
echo $history;
//输入页头、内容、页脚
header("location:".$history);

