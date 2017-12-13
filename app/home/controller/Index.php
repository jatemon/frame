<?php

namespace app\home\controller;

use houdunwang\core\Controller;
use houdunwang\view\View;
use system\model\Grade;
use system\model\Student;

class Index extends Controller
{
	public function index ()
	{
		//获取是所有班级
		$gradeData = Grade::getAll();
		//p($gradeData);
		return View ::make ()->with(compact ('gradeData'));
	}

	/**
	 * 学生列表
	 */
	public function lists(){
		//获取当前班级id
		$id = $_GET['id'];
		//获取当前班级数据
		$currentData = Grade::find($id);
		//p($currentData);
		//获取当前班级全部学生
		$stuData = Student::where("gid=$id")->getAll();
		//p($stuData);

		//加载模板页面
		return View::make()->with(compact ('currentData','stuData'));
	}
}