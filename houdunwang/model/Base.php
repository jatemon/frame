<?php
namespace houdunwang\model;			//定义一个命名空间
use Exception;						//使用一个Exception的空间
use PDO;							//使用一个PDO的空间

class Base							//定义一个类Base，作为model类的基本类
{
	//声明一个私有的静态属性$pdo
	//给$pdo赋值为null
	private static $pdo = null;
	protected      $table;//操作数据表
	protected      $where;//sql语句where条件
	protected      $field = '';//指定查询的字段

	public function __construct ( $class )
	{
		//获取数据表名方式一：
		//$this->table = strtolower (ltrim (strrchr($class,'\\'),'\\'));
		//获取数据表名方式二：
		$info          = explode ( '\\' , $class );
		$this -> table = strtolower ( $info[ 2 ] );
		//p($this->table);
		//1.连接数据库
		if ( is_null ( self ::$pdo ) ) {
			$this -> connect ();
		}
	}

	/**
	 * 连接数据库
	 */
	private function connect ()
	{
		try {
			$dsn        = c ( 'database.driver' ) . ":host=" . c ( 'database.host' ) . ";dbname=" .
						  c ( 'database.dbname' );
			$user       = c ( 'database.user' );
			$password   = c ( 'database.password' );
			self ::$pdo = new PDO( $dsn , $user , $password );
			//字符集
			self::$pdo->query ('set names '.c('database.charset'));
			//设置错误属性
			self::$pdo->setAttribute (PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		} catch ( Exception $e ) {
			exit( $e -> getMessage () );
		}
	}


	//查询结果排序
	//声明一个公开的方法order($str)
	//传入参数
	public function order($str){
		//      在传过来的参数上连上一个逗号，
		//      是为了防止用户只传一个参没加逗号（这时转数组会报错，因为转数组时以逗号做条件的）
		$newstr=$str.',';
		//      将字符串 $newstr以逗号转为数组
		$arr=explode(',', $newstr);
		//      获取数组$arr的长度，在后面用于做判断
		//      return count($arr);
		//      但数组长度等于2时执行里面的程序，反之执行else里面的程序
		if(count($arr)==2){
			//      连接的时候注意用空格隔开（遵循MySQL语句的正确格式）
			$this->order='order by '.$arr[0];

		}else{
			//      调用属性$this->order存储--'order by '.$arr[0]
			//      连接的时候注意用空格隔开（遵循MySQL语句的正确格式）
			$this->order='order by '.$arr[0];
			//      调用属性$this->desc存储$arr[1]
			$this->desc=$arr[1];
		}
		//      返回对象$this保证其链式调用的正常运行
		return $this;

		//       return $arr;
		//       return $this->desc;
		//       $str="select {$this->fields} from {$this->table} {$this->where} {$this->order} {$this->desc}";
		//      调用方法slc()并传参，返回其返回值
		//       return $this->slc($str);
	}





	/**
	 * 根据主键获取数据库单一一条数据
	 *
	 * @param $pk    主键值
	 *
	 * @return mixed
	 */
	public function find ( $pk )
	{
		//p($this->table);
		//获取查询数据表的主键
		$priKey = $this -> getPriKey ();
		$this->field  = $this->field ? : '*';
		//$sql = "select * from student where id=1";
		$sql = "select {$this->field} from {$this->table} where {$priKey}={$pk}";
		$res = $this -> q ( $sql );

		return current ( $res );
	}

	/**
	 * 查询单一一条数据
	 *
	 * @return mixed
	 */
	public function first ()
	{
		//$sql = "select * from student where sname='赵虎'";
		$this->field  = $this->field ? : '*';

		$sql  = "select {$this->field} from {$this->table} {$this->where}";
		$data = $this -> q ( $sql );

		//p($data);
		return current ( $data );
	}

	/**
	 * 查找指定列的字段
	 * @param $field	字段名称
	 *
	 * @return $this
	 */
	public function field ( $field )
	{
		//p ( $field );//sname,sex
		$this->field = $field;

		return $this;
	}

	/**
	 * sql语句中where条件
	 *
	 * @param $where
	 *
	 * @return $this
	 */
	public function where ( $where )
	{
		//p($where);//age>30
		//"where age>30"
		$this -> where = 'where ' . $where;

		return $this;
	}

	/**
	 * 获取数据表中所有数据
	 *
	 * @return mixed    所有数据数组
	 */
	public function getAll ()
	{
		//$this->field  = $this->field ? $this->field : '*';
		$this->field  = $this->field ? : '*';
		//$sql = "select * from aa";
		$sql = "select {$this->field} from {$this -> table}  {$this->where}";

		//p($sql);die;
		return $this -> q ( $sql );
	}

	/**
	 * 获取数据表中主键的名称
	 *
	 * @return mixed    主键名称
	 */
	public function getPriKey ()
	{
		$sql = "desc {$this->table}";
		$res = $this -> q ( $sql );
		//p($res);//这里一定要打印看数据
		foreach ( $res as $k => $v ) {
			if ( $v[ 'Key' ] == 'PRI' ) {
				$priKey = $v[ 'Field' ];
				break;
			}
		}

		return $priKey;
	}

	/**
	 * 更新数据
	 * @param $data	要更新的数组数据
	 *
	 * @return bool
	 */
	public function update($data){
		//如果没有where条件不允许更新
		if(!$this->where){
			return false;
		}
		$set = '';
		foreach($data as $k=>$v){
			if(is_int ($v)){
				$set .= $k . '=' . $v . ',';
			}else{
				$set .= $k . '=' . "'$v'" . ',';
			}
		}
		$set = rtrim($set,',');
		//p($set);die;
		//sql = "update student set sname='',age=19,sex='男' where id=1";
		$sql = "update {$this->table} set {$set} {$this->where}";
		return $this->e ($sql);
	}

	public function delete(){
		//如果没有where条件不允许更新
		if(!$this->where){
			return false;
		}
		//$sql = "delete from student where id=1";
		$sql = "delete from {$this->table} {$this->where}";
		return $this->e ($sql);
	}

	/**
	 * 数据表写入数据
	 * @param $data
	 *
	 * @return mixed
	 */
	public function insert($data){
		//p($data);die;
		$field = '';
		$value = '';
		foreach($data as $k=>$v){
			$field .= $k . ',';
			if(is_int ($v)){
				$value .= $v . ',';
			}else{
				$value .= "'$v'" . ',';
			}
		}
		$field = rtrim ($field,',');
		//p($field);die;
		$value = rtrim ($value,',');
		//p($value);die;
		//$sql = "insert into student (age,sname,sex,cid) values (1,'超人','男',1)";
		$sql = "insert into {$this->table} ({$field}) values ({$value})";
		//p($sql);die;
		return $this->e ($sql);
	}

	//执行有结果集的查询
	//select
	public function q ( $sql )
	{
		try {
			//执行sql语句
			$res = self ::$pdo -> query ( $sql );

			//将结果集取出来
			return $res -> fetchAll ( PDO::FETCH_ASSOC );
		} catch ( Exception $e ) {
			die( $e -> getMessage () );
		}
	}

	//执行无结果集的sql
	//insert、update、delete
	public function e ( $sql )
	{
		try {
			return self ::$pdo -> exec ( $sql );
		} catch ( Exception $e ) {
			//输出错误消息
			die( $e -> getMessage () );
		}
	}
}



