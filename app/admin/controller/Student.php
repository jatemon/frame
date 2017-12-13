<?php

namespace app\admin\controller;
use houdunwang\view\View;
use system\model\Grade;
use system\model\Student as StudentModel;
/**
 * 学生管理控制器类
 * Class Student
 *
 * @package app\admin\controller
 */
class Student extends Common
{
	//首页
	public function index(){
		//这里join新增加的关联方法
		$field = StudentModel::join('grade','student.gid','=','grade.id')->field("student.id,student.sname,student.ssex,student.sage,grade.name")->getAll();
		//$field = StudentModel::q("select s.id,s.sname,s.ssex,s.sage,g.name from student s join grade g on s.gid=g.id");
		//p($field);die;
		return View::make()->with(compact ('field'));
	}

	//添加
	public function add(){
		//1.创建学生表：包含主键id、姓名、性别、年龄、所在班级id
		//2.获取是所有班级数据
		$gradeData = Grade::getAll();
		if(IS_POST){
			//3.接受post数据
			$post = $_POST;
			//var_dump($post);die;
			//6.在写入数据之前增加判断
			if(!trim ($post['sname'])){
				 $this->setRedirect ()->message ('请输入学生姓名');
			}
			if(!isset ($post['ssex'])){
				$this->setRedirect ()->message ('请选择学生性别');
			}
			if(!trim ($post['sage'])){
				$this->setRedirect ()->message ('请输入学生年龄');
			}
			if(!$post['gid']){
				$this->setRedirect ()->message ('请选择学生班级');
			}
			//4.写入数据表student
			//StudentModel::insert($_POST);
			StudentModel::e("insert into student (sname,ssex,sage,gid) values ('{$post['sname']}','{$post['ssex']}',{$post['sage']},{$post['gid']})");
			//5.成功提示
			$this->setRedirect (u('index'))->message ('操作成功');
		}
		return View::make()->with(compact ('gradeData'));
	}

	//编辑
	public function edit(){
		//获取所有班级数据
		$gradeData = Grade::getAll();
		//p($gradeData);
		//接受要编辑数据的id
		$id = $_GET['id'];
		//获取旧数据
		$oldData = StudentModel::find($id);
		//p($oldData);
		if(IS_POST){
			//3.接受post数据
			$post = $_POST;
			//var_dump($post);die;
			//6.在写入数据之前增加判断
			if(!trim ($post['sname'])){
				$this->setRedirect ()->message ('请输入学生姓名');
			}
			if(!isset ($post['ssex'])){
				$this->setRedirect ()->message ('请选择学生性别');
			}
			if(!trim ($post['sage'])){
				$this->setRedirect ()->message ('请输入学生年龄');
			}
			if(!$post['gid']){
				$this->setRedirect ()->message ('请选择学生班级');
			}
			//4.更新数据
			StudentModel::where("id=$id")->update($_POST);
			//StudentModel::e("update student set sname='{$post['sname']}',sage={$post['sage']},ssex='{$post['ssex']}',gid={$post['gid']} where id={$id}" );
			//5.成功提示
			$this->setRedirect (u('index'))->message ('操作成功');
		}
		return View::make()->with(compact ('gradeData','oldData'));
	}

	//删除
	public function del(){
		//接受删除数据id
		$id = $_GET['id'];
		//p($id);
		//执行删除
		//StudentModel::where("id=$id")->delete();
		//StudentModel::e("delete from student where id=$id");
		//提示
		$this->setRedirect (u('index'))->message ('操作成功');
	}
}