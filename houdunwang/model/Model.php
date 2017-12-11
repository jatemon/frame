<?php
namespace houdunwang\model;			//定义一个命名空间
class Model							//定义一个类Model
{
	//声明一个公开的__call魔术方法
	public function __call ( $name , $arguments )
	{
		//返回一段类自身内部的执行runParse()方法的结果
		return self ::runParse ( $name , $arguments );
	}

	//声明一个静态公开的__call魔术方法
	public static function __callStatic ( $name , $arguments )
	{
		//返回一段类自身内部的执行runParse()方法的结果
		return self ::runParse ( $name , $arguments );
	}

	//声明一个静态公开的runParsel魔术方法
	public static function runParse ( $name , $arguments )
	{
		//p(get_called_class ());
		//获取当前调用的模型的名称，因为我们要使用其作为查询的数据表名
		$class = get_called_class ();
		//p($class);//system\model\Student

		//调用回调函数，并把一个数组参数作为回调函数的参数
		//第一个参数作为回调函数
		//第二个参数是要被传入回调函数的数组，并且这个数组得是索引数组
		//第二个参数是被第一个参数传参的
		//返回回调函数的结果。如果出错的话就返回FALSE
		//将这个结果返回出去，返回给调用者
		return call_user_func_array ( [ new Base($class) , $name ] , $arguments );
	}
}

