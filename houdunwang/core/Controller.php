<?php
namespace houdunwang\core;
//定义命名空间
class Controller
//定义类Controller
{
    //声明一个私有属性$url
    private $url;
    /**
     * 消息提示
     * @param $msg   提示消息
     */
    //声明一个公开的message()方法
    public function message($msg){
        //加载模板视图文件
        include './view/message.php';
    }

    /**
     * 跳转连接
     * @param string $url
     */
    //声明一个公开的setRedirect()方法
    public function setRedirect($url = ''){
        //判断是否有参数$url传入
        if($url){
            //说明指定了跳转地址
            $this->url = "location.href='$url'";
        }else{
            //说明没有给跳转地址，默认back
            //就给一个默认的跳转地址
            $this->url  = "window.history.back()";
        }
        //返回指定的跳转链接地址
        return $this;
    }
}