<?php
namespace app\index\controller;

use think\Controller;

class Member extends Controller {

	public function index() {
		return $this->fetch();
	}

}