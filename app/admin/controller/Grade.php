<?php
namespace app\admin\controller;

use houdunwang\view\View;
use system\model\Grade as GradeModel;
/**
 * 班级管理控制器类
 * 继承Common因为要使用登录验证
 * Class Grade
 *
 * @package app\admin\controller
 */
class Grade extends Common
{
	//班级首页
	public function index(){
		//测试u函数参数
		//$res = u('edit',['id'=>1,'name'=>'hd']);
		//$res = u('edit');
		//p($res);//?s=admin/Grade/edit&id=1&name=hd

		//获取所有数据
		//$field = GradeModel::getAll();
		//原生写法
		$field = GradeModel::q('select * from grade');
		//p($field);
		return View::make()->with(compact ('field'));
	}
	//班级添加页面
	public function add(){
		//1.创建班级表(grade)  id name
		if(IS_POST){
			//2.接受post数据
			$name = $_POST['name'];
			//p($_POST);die;
			//var_dump ($name);die;
			//3.验证数据不能为空
			if(!trim ($name)){
				return $this->setRedirect ()->message ('班级名称不能为空');
			}
			//6.增加一步，班级名称不能重复
			//if($res = GradeModel::where("name='{$name}'")->first()){
			//原生写法
			if($res = GradeModel::q("select * from grade where name='{$name}'")){
				return $this->setRedirect ()->message ('班级已存在');
			}
			//p($res);die;
			//4.将数据写入数据库
			//GradeModel::insert($_POST);
			//原生写法
			GradeModel::e("insert into grade (name) values ('{$name}')");
			//5.成功提示
			$this->setRedirect (u('index'))->message ('操作成功');
		}
		return View::make();
	}

	//编辑
	public function edit(){
		//1.接受编辑的数据的主键id
		$id = $_GET['id'];
		//2.获取主键id=$id的这一条数据
		$oldData = GradeModel::find($id);
		//$oldData = current (GradeModel::q("select * from grade where id=$id"));
		//p($oldData);
		if(IS_POST){
			//3.接受post数据
			$name = $_POST['name'];
			//4.判断是否为空
			if(!trim ($name)){
				return $this->setRedirect ()->message ('班级名称不能为空');
			}
			// c90  c90修改
			//7.在更新之前，增加判断，判断班级名称不能重复
			if($res = GradeModel::where("name='{$name}'")->first()){
			//原生写法
			//if($res = GradeModel::q("select * from grade where name='{$name}'")){
				return $this->setRedirect ()->message ('班级已存在');
			}
			//5.执行更新
			GradeModel::where("id=$id")->update($_POST);
			//GradeModel::e("update grade set name='$name' where id=$id");
			//6.成功提示
			$this->setRedirect (u('index'))->message ('操作成功');
		}
		return View::make()->with(compact ('oldData'));
	}

	//删除
	public function del(){
		//1.接收删除元素主键id
		$id = $_GET['id'];
		//2.删除
		//GradeModel::where("id=$id")->delete();
		GradeModel::e("delete from grade where id=$id");
		//3.成功提示
		$this->setRedirect (u('index'))->message ('操作成功');
	}
}