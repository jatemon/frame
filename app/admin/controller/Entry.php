<?php
namespace app\admin\controller;

use houdunwang\core\Controller;
use houdunwang\view\View;

/**
 * 后台首页
 * Class Entry
 *
 * @package app\admin\controller
 */
class Entry extends Common
{
	public function index(){
		//加载模板页面
		return View::make();
	}
}