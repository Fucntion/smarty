<?php 

require 'view.class.php';
$view=new viewTmpl();


require 'curl.class.php';
require 'common.class.php';

//设置静态文件路径
$view->CSSPATH = 'assets/css';
$view->IMGPATH = 'assets/img';
$view->JSPATH = 'assets/js';
//登录状态
$view->loginstatus = isLogin('PHPSESSID',null,null)?'login':'nologin';

