<?php

/**
 *
 * @author Joe
 * 
 */
class viewTmpl {

    private $file;
    private $extension = 0;
    private $temp_cache= "theme/cache/";
    private $temp_path = "theme/tmpl/";

    /* 未声明变量数组 */
    public $vars = array();

    public function __construct($template = NULL) {
        if (!empty($template)) {
            $this->setFile($template);
        }
        return $this;
    }

    // 获取所有未声明变量 
    public function getVars() {
        return $this->vars;
    }

    // 获取类中未声明变量 
    public function &__get($key) {
        if (array_key_exists($key, $this->vars)) {
            return $this->vars[$key];
        }
    }

    // 设置类中未声明变量
    public function __set($key, $val) {
        $this->vars[$key] = $val;
    }

    public function setAttr($key, $val) {
        $this->__set($key, $val);
    }

    // 设定模板路径
    public function setPath($path) {
        $this->temp_path = $path;
        return $this;
    }

    // 设置缓存时间，以分钟为单位
    public function setExtens($time) {
        $this->extension = $time * 60;
        return $this;
    }
    
    //设置缓存路径
    public function setCache($path) {
        if (is_dir($path)) {
            $this->temp_cache = $path;
        } else {
            $this->show_error("致命错误", "您设置的模板缓存路径未找到！" . $path);
        }
        return $this;
    }

    // 转换
    private function compile($file) {
        $filestr = '';

        require_once 'Cache.php';
        $temp_cache = new Cache(array(
            'cache_name' => md5($file),
            'cache_path' => $this->temp_cache,
            'cache_extension' => $this->extension * 60
        ));

        if ($temp_cache->cached("html")) {
            $filestr = $temp_cache->get("html");
        } else {
            $keys = array(
                '{if %%}' => '<?php if (\1): ?>',
                '{elseif %%}' => '<?php ; elseif (\1): ?>',
                '{for %%}' => '<?php for (\1): ?>',
                '{foreach %%}' => '<?php foreach (\1): ?>',
                '{while %%}' => '<?php while (\1): ?>',
                '{/if}' => '<?php endif; ?>',
                '{/for}' => '<?php endfor; ?>',
                '{/foreach}' => '<?php endforeach; ?>',
                '{/while}' => '<?php endwhile; ?>',
                '{else}' => '<?php ; else: ?>',
                '{continue}' => '<?php continue; ?>',
                '{break}' => '<?php break; ?>',
                '{$%% = %%}' => '<?php $\1 = \2; ?>',
                '{$%%++}' => '<?php $\1++; ?>',
                '{$%%--}' => '<?php $\1--; ?>',
                '{$%%}' => '<?php echo $\1; ?>',
                '{comment}' => '<?php /*',
                '{/comment}' => '*/ ?>',
                '{/*}' => '<?php /*',
                '{*/}' => '*/ ?>',
            );

            foreach ($keys as $key => $val) {
                $patterns[] = '#' . str_replace('%%', '(.+)', preg_quote($key, '#')) . '#U';
                $replace[] = $val;
            }
            $filestr = preg_replace($patterns, $replace, file_get_contents($file));
            $temp_cache->set("html", $filestr);
        }
        return $filestr;
    }

    // 设置要显示的内容文件
    public function display($template) {
        if (is_file($this->temp_path . $template)) {
            $this->file[] = $this->temp_path . $template;
        } else {
            $this->show_error("致命错误", "模板文件未找到！" . $this->temp_path . $template);
        }
        return $this;
    }

    // 输出模板文件
    public function render() {
        $template = '';

        foreach ($this->file as $file) {
            $template .= $this->compile($file);
        }

        return $this->evaluate($template, $this->getVars());
    }

    // 转换成php
    private function evaluate($code, array $variables = NULL) {
        if ($variables != NULL) {
            extract($variables);
        }
        return eval('?>' . $code);
    }
	
	
	
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
//		$this->deldir($temp_cache);
	}
	
	public function show_error($str1,$str2){
		echo $str.$str2;
	}
	
	

}