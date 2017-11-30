<?php

$root = request()->root();

define('__ROOT__',str_replace('/index.php','',$root));

return [

    // 视图输出字符串内容替换
    'view_replace_str'       => [
    	'__PUBLIC__'	=> __ROOT__.'/index/',
    	'__CSS__'		=> __ROOT__.'/index/css',
    	'__JS__'		=> __ROOT__.'/index/js'
    ],

];