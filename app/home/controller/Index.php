<?php
namespace app\home\controller;          //定义命名空间
use houdunwang\core\Controller;         //引入另外3个命名空间，此处是编辑器自动加载，在涉及类调用的时候触发
use houdunwang\model\Model;
use houdunwang\view\Base;

class Index extends Controller          //声明一个类Index，继承另一个Controller类
{
    public function index(){
    	//echo 'vnnbn';
    	//声明一个公共的index()方法

		//$cc = Model::q('select * from aa where a=1');

		//$cc = Model::first('select * from aa');

		//$data = Aa::where('a>300')->order('a desc')->getAll();

		//p(33);

		return View::make();

        //echo 'index';
        //1.public/view放入message.php模板文件，详情参考模板文件
        //2.在houdunwang/core/创建Controller.php类
        //3.Index继承Controller类
        //4.测试能否调用Controller类里面message方法
        //链式操作，关键$this->setRedirect ()需要返回$this

        //调用父级类Controller中的页面调转函数
        //调用父级类Controller中message()方法
        //$this->setRedirect ()->message('添加成功');
        //echo '首页';
        //p(u('member/index'));//?s=home/member/index
        //p(u('member'));//?s=home/Index/member
        //p(u('member/Entry/index'));//?s=member/Entry/index

		/*********第一步************/
		//实力化View类，调用make方法
		//下一步该去View(在哪看命名空间)类里面找make方法
		//View中没有make方法，那么这个时候会触发__call方法
		//__call方法调用View类中runParse方法
		//runParse方法：实例化Base调用make方法
		//(new View())->make();
		//View中没有make方法，那么这个时候会触发__callStatic方法
		//__call方法调用View类中runParse方法
		//runParse方法：实例化Base调用make方法
		//View::make();
		/*********第二步,解决变量************/
		//$a = 1;
		//$data = ['name'=>'后盾人','age'=>10];
		//分配变量时候使用compact函数
		//能把数据变成什么样，一定要打印：compact ('data')
		//函数：把变量变成数组下标
		//变量值变成下标对应的值
		//p(compact ('data','a'));die;
		//return View::with();
		//return View::with(compact ('data','a'))->make();
		//View::make()->with();
		/*********第三步：封装model************/
		//测试获取数据库所有数据
		//$data = Model::getAll();
		//测试Model类中e和q方法是否有效
		//$res = Model::q('select * from aa');
		//p($res);
		/*********第四步：测试读取配置项数据************/
		//读取配置项数据
		//c    config
		//$res = c('database');
		//p($res);
		//$res = c('database.driver');
		//p($res);
    }
}