# smarty
云宿项目部分前端

#2016-1-4

1.添加清除模板功能
```
//删除文件夹内元素
public function deldir($dir){
    //删除目录下的文件：
    $dh=opendir($dir);
    while ($file=readdir($dh)) {
        if($file!="." && $file!="..") {
            $fullpath=$dir."/".$file;
            echo $fullpath;
            if(!is_dir($fullpath)){
                unlink($fullpath);
            } 
            else{
            deldir($fullpath);
            }
        }
    }
}

public function clearTmpl(){
    $this->deldir('theme/cache/');
}

```
2.常见错误,千万不要把模板缓存地址和静态页面生成地址搞混淆。

```
$view->setPath('theme/tmpl/'); //静态页面生成

private $temp_cache= "theme/cache/"; //配置缓存
private $temp_path = "theme/views/"; //配置临时文件路劲

```

3.再也不要乱往开发环境加莫名其妙的js!!!花了两个小时就这个了。。。。

4.//检测是否登录
//isLogin('PHPSESSID','login.php',null);
在需要判断登录的地方加上这个功能
