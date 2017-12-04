<?php
namespace app\index\controller;

use think\Controller;

class Login extends Controller {

	public function index() {
		return $this->fetch();
	}

	public function login() {
		$table = db('user');
        $user = $table->where(array('uname' => input('uname','','htmlspecialchars')))->find();
        if (!$user || $user['pwd'] != input('pwd', '', 'MD5')) {
            $this->error('用户名或密码错误');
        }

        $data = array(
            'last_time' => date('Y-m-d H:i:s'),
            'last_ip' => request()->ip()
        );
        $db = $table->where('id='.$user['id'])->save($data);

        //写入session
        session('admin_id',$user['id']);
        session('admin_username',$res['username']);
        $this->success("登录成功!",U('Index/index'));
	}


    public function logout() {
        session(null);
        $this->redirect('Login/index');
    }

}