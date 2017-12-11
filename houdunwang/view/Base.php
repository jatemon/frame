<?php
namespace houdunwang\view;			//定义一个命名空间
class Base{							//定义一个类Base
	private $data = [];				//声明一个私有的属性$data，存储变量
	private $file = '';				//声明一个私有的属性$file，模板文件
	/**
	 * 显示模板文件
	 */
	//声明一个公开的make()方法
	public function make(){
		//p(MODULE);
		//p(CONTROLLER);
		//p(ACTION);
		//include '../app/home/view/index/index.html';
		//include '../app/'.MODULE.'/view/'.strtolower (CONTROLLER).'/'.ACTION.'.php';
		//组建引入的文件地址
		$this->file =  '../app/'.MODULE.'/view/'.strtolower (CONTROLLER).'/'.ACTION.'.' . c('view.suffix');
		//将组建的结果返回给调用者
		return $this;
	}

	/**
	 * 分配变量，
	 */
	//声明一个公开的with()方法
	//给with()方法传入一个默认的空数据作为形式参数
	public function with($var = []){
		//p($var);die;
		$this->data = $var;
		//将结果返回给调用者
		return $this;
	}

	//声明一个公开的__toString()魔术方法
	public function __toString ()
	{
		//p($this->data);die;
		//将键名变为变量名字，将键值变为变量值
		extract ($this->data);
		//经过extract之后，就会产生变量
		//产生变量名叫什么：看调用With时候给的变量名字是什么
		//p($data);
		//p($a);
		//die;
		//加载模板文件
		//为了防止调用时候只调用with，不调用make出现的报错
		//你在调用时候View::with(),就会出现报错
		if($this->file){
			//加载模板文件
			include $this->file;
		}
		//如果不符合判断条件，就返回空字符串
		//将结果返回给调用者
		return '';
	}
}
