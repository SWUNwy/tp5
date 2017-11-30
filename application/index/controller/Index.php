<?php

namespace app\index\controller;

use think\Controller;

class Index extends Controller {

    public function index() {
        return view();
    }

    public function main() {
        //mysql版本信息
        $mysql_version =  db()->query('SELECT VERSION() AS ver');
        $config = [
            'url' => $_SERVER['HTTP_HOST'],
            'document' => $_SERVER['DOCUMENT_ROOT'],
            'server_os' => PHP_OS,
            'server_port' => $_SERVER['SERVER_PORT'],
            'server_soft' => $_SERVER['SERVER_SOFTWARE'],
            'php_version' => PHP_VERSION,
            'mysql_version' => $mysql_version[0]['ver'],
            'max_upload_size' => ini_get('upload_max_filesize')
        ];

        $this->assign('config', $config);
        return view('main');
    }

}
