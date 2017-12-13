<?php
namespace app\admin\controller;

use Gregwar\Captcha\CaptchaBuilder;
use houdunwang\core\Controller;
use houdunwang\view\View;
use system\model\Admin;
use Gregwar\Captcha\PhraseBuilder;
/**
 * 登录管理控制器
 * Class Login
 *
 * @package app\admin\controller
 */
class Login extends Controller
{
	//登录首页
	public function index(){
		//p($_SESSION);
		//先输出一个加密的密码，手动写到数据库中
		//md5
		//echo password_hash ('admin888',PASSWORD_DEFAULT);
		//die;
		if(IS_POST){
			//1.接受post数据，并且打印测试是否正常
			$post = $_POST;
			//p($post);die;
			//2.比对用户名是否正确
			$userInfo = Admin::where("username='{$post['username']}'")->first();
			//Admin::q("select * from admin where username='{$post['username']}'")
			//如果返回false，说明数据表找不到数据
			//p($userInfo);die;
			if(!$userInfo){
				//运行到这里说明数据表没有对应数据
				return $this->setRedirect ()->message ('用户名不正确');
			}
			//3.比对密码上是否正确
			if(!password_verify ($post['password'],$userInfo['password'])){
				return $this->setRedirect ()->message ('密码不正确');
			}
			//4.比对验证码是否正确
			if(strtolower ($post['captcha']) != $_SESSION['phrase']){
				return $this->setRedirect ()->message ('验证码不正确');
			}
			//5.说明登录成功
			//p($userInfo);die;
			//将用户信息存到session
			$_SESSION['admin_id'] = $userInfo['admin_id'];
			$_SESSION['username'] = $userInfo['username'];
			//成功提示并且跳转到首页
			return $this->setRedirect (u('admin/entry/index'))->message ('登录成功');
		}
		return View::make();
	}

	//生成验证码
	public function captcha(){
		$phraseBuilder = new PhraseBuilder(3);
		$builder = new CaptchaBuilder(null, $phraseBuilder);
		$builder->build();
		header('Content-type: image/jpeg');
		$_SESSION['phrase'] = strtolower ($builder->getPhrase());
		$builder->output();
	}
}