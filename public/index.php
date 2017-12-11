<?php
//function __autoload( $name ){
//    include '../houdunwang/core/' . ucfirst( $name ) . '.php';
//}


//必须且只加载一次自动加载文件
require_once '../vendor/autoload.php';

//调用命名空间中的run()方法
\houdunwang\core\Boot::run ();


