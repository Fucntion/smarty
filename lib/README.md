#JTemplate
简单快速的php模板引擎，这个代码只有147行
- 2015.5.7    增加缓存
- 2015.5.6    提交代码

#php 调用
```
<?php
require 'view.php';
 
$view=new view();

$view->setPath('theme/views/');//设置模板文件存放目录，必须以/结尾
 
//第一种设置输出参数的方法
$view->setAttr("title", "Variable example");
//第二种设置输出参数的方法
$view->array = array(
            '1' => "First array item",
            '2' => "Second array item",
            'n' => "N-th array item",
);
$view->j = 5;
//输入页头、内容、页脚
$view->display("header.php")->display('index.php')->display('footer.php')->render();

```
直接输出单一文件
```
$view=new ('index.php');
$view->render();
```
#模板文件
判断
```
{if $array}
    ...
{elseif $array[0]!=null}
    ...
{else}
    ...
{/if}
```
foreach 循环
```
{foreach $array as $key => $value}
    {$key} => {$value}<br />
{/foreach}
```
while 循环
```
{$i = 1}
{while $i < $j}
  当前 no. {$i}<br />
  {$i++}
{/while}
```
for 循环 
```
{for ($i=0;$i<count($array);$i++)}
    {$array[$i]}
{/for}
```
赋值 计算
```
{$i = 1}//等号=前后必须有一个空格
{$i++}
{$i--}
```