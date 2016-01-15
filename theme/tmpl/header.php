<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <meta charset="utf-8" />
        <title>{$title}</title>
		<link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link rel="stylesheet" href="{$CSSPATH}/style.css" type="text/css" />
        <script src="{$JSPATH}/common.js"></script>
        <script src="{$JSPATH}/jquery-1.11.0.js"></script>
        <!--<script src="{$JSPATH}/angular.min.js"></script>-->
    </head>
    <body>
    	{$loginstatus}
    	{if $loginstatus =='nologin'}
    		<a href="login.php">登录</a>
    	{else}
    		<a href="CtrUserLogout.php">退出</a>
    	{/if}
    	<p>
    	<p>	
    	<a href="index.php">首页</a>
    	{if $nav}
    	{foreach $nav as $key=>$value}
    		{foreach $nav[$key] as $key2=>$value2}
    		{if $key2 == 'name'}
    			<a href="javascript:void(0)" onclick="toList('{$value2}','{$nav[$key]['href']}')">{$value2}</a>
    		{/if}
    			
    		{/foreach}
    	{/foreach}
    	{/if}
    	<!--</p>
    	
		<a href="viewlist.php">景点</a>
		<a href="hotellist.php">民宿</a>
		<a href="#">特产</a>
		<a href="#">餐饮</a>
		<a href="#">游线</a>-->
		<a href="user.php">个人中心</a>
		
		<a href="javascript:void(0)" onclick='toClear()'>更新模板</a>
    	</p>
    	{if $title == '用户中心'}
		<p><a href="edit.php">修改资料</a></p>
		{/if}
   