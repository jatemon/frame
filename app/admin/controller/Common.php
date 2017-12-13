<?php

namespace app\admin\controller;
use houdunwang\core\Controller;

class Common extends Controller
{
	public function __construct ()
	{
		//检测是否登录
		if(!isset($_SESSION['admin_id'])){
			//说明没有登录，跳转登录页面
			$this->setRedirect (u('admin/login/index'))->message ('请先登录');
		}
	}
}