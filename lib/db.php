<?php
require 'db_mysqli.php';
class db{
	protected $tablename;
	private static $db_class = null;
	public function __construct($table_name = null){
		if(self::$db_class==null){
			self::$db_class= self::GetDB();
		}
		if($table_name !== null){
		   $this->setTableName($table_name);
		}
	}	
	public static function GetDB(){
		$db_config = $GLOBALS['CONFIG']['db'];
		switch ($db_config['method']){
			case 'mysql':
				$db = new db_mysql($db_config);
				self::$db_class = $db;
				return $db;
			case 'mysqli':
				$db = new db_mysqli($db_config);
				self::$db_class = $db;
				return $db;
		}
		return false;
	}
	public static function returnDB(){
		return self::$db_class;
	}
	public function setTableName($tablename,$rewrite = true){
		if($rewrite){
			$this->tablename = '`'.$tablename.'`';
		}else{
			$this->tablename = $tablename;
		}
	}
	/**
	 * @whereArr eg1:   array('email'=>'123e234@sina.com','password'=>'pasdfe')  ,
	 *eg2:  array('email' => array('type' => 'IS NOT','value' => null))           type :   // '=.!=,>,<,>=,<=,IS ,is not ,like
	 * 
	 * 
	 * @what eg1: *  eg2:array('email' => 'user_email')
	 *
	 * @index eg1:array('email','email_phone') 
	 * @order eg1:array('email'=>'asc') 
	 * @limit eg1:array('offset'=>0,'limit'=>30) 
	 */
	public function findOne($whereArr = array(),$what = '*',$order = array(),$index = array()){
		$data = $this->find($whereArr,$what,$order,$index,$limit = array('offset'=>0,'limit'=>1));
		if(empty($data)){
			return false;
		}else{
			return $data[0];
		}
	}
	public function find($whereArr = array(),$what = '*',$order = array(),$index = array(),$limit = array('offset'=>0,'limit'=>30)){
		if(is_array($what)){
			$whatStr = '';
			foreach($what as $k => $v){
				if($whatStr!='') $whatStr .= ',';
				$whatStr .= '`'.$k.'` as '.$v; 
			}
		}else{
			$whatStr = '*';
		}
		$forceIndex = '';
		if(!empty($index)){
			$forceIndex = 'force index('.join(',',$index).')';
		}
		$whereStr = '';
		if(!empty($whereArr)){
			$whereStr = 'where';
			foreach($whereArr as $k => $v){
				//if(is_null($v))
				if($whereStr!='where') $whereStr .= ' and';
				if(is_array($v)){
					$whereStr .= ' `'.$k.'`';
					$whereStr .= ' '.$v['type'].' ';  // '=.!=,>,<,>=,<=,IS ,is not ,like'
					if(is_string($v['value'])){
						$whereStr .= "'".addslashes($v['value'])."'";
					}else if(is_null($v['value'])){
						$whereStr .= 'NULL';
					}else if(is_int($v['value'])){
						$whereStr .= $v['value'];
					}
				}else{
					$whereStr .= ' `'.$k.'`';
					$whereStr .= ' = ';  // '=.!=,>,<,>=,<=,IS ,is not ,like'
					if(is_string($v)){
						$whereStr .= "'".addslashes($v)."'";
					}else if(is_null($v)){
						$whereStr .= 'NULL';
					}else if(is_int($v)){
						$whereStr .= $v;
					}
				}

			}
		}
		$orderStr = '';
		if(!empty($order)){
			$orderStr = 'order by ';
			foreach ($order as $k => $v) {
				if($orderStr!='order by ')  $orderStr .= ',';
				$orderStr .= '`'.$k.'`'.' '.$v;
			}
		}
		$sql = 'select '.$whatStr.' from '.$this->tablename.' '.$forceIndex.' '.$whereStr.' '.$orderStr.' limit '.$limit['offset'].','.$limit['limit'];
		$data = self::$db_class->ExecuteArray($sql);
		return $data;		
	}
	/**
	 * @keyArr eg1:array('email','andy') 
	 * @valueArr eg1:array(array(421707429@qq.com','andy'),array(421707429@qq.com','andy'),array(421707429@qq.com','andy'),array(421707429@qq.com','andy'),...); 
	 */
	public function insertArr($keyArr,$valueArr){
		$sql = 'insert into '.$this->tablename;
		$keyStr .= '(';
		foreach ($keyArr as  $v) {
			if($keyStr != '(') $keyStr .= ',';
			$keyStr .= '`'.addslashes($v).'`';
		}
		$keyStr .= ')';
		$valStr = '';
		foreach($valueArr as $l){
			if($valStr!='') $valStr .= ',';
			$valStr .= '(';
			$dStr = '';
			foreach ($l as $v) {
				if($dStr!='') $dStr .= ',';
				if(is_string($v)){
					$dStr .= "'".addslashes($v)."'";
				}else if(is_null($v)){
					$dStr .= 'NULL';
				}else if(is_int($v)){
					$dStr .= $v;
				}
			}
			$valStr .= $dStr.')';

		}
		$sql .= $keyStr.'  values  '.$valStr;
		self::$db_class->ExecuteQuery($sql);
		return self::$db_class->LastInsertID();
	}
	/**
	 * @keyValueArr eg1:array('email'=>'421707429@qq.com','name'=>'andy')
	 */
	public function insert($keyValueArr){
		$sql = 'insert into '.$this->tablename;
		$keyStr .= '(';
		foreach ($keyValueArr as  $k=>$v) {
			if($keyStr != '(') $keyStr .= ',';
			$keyStr .= '`'.addslashes($k).'`';
		}
		$keyStr .= ')';
		$valStr = '(';
		foreach ($keyValueArr as  $k=>$v) {
			if($valStr!='(') $valStr .= ',';
			if(is_string($v)){
				$valStr .= "'".addslashes($v)."'";
			}else if(is_null($v)){
				$valStr .= 'NULL';
			}else if(is_int($v)){
				$valStr .= $v;
			}
		}
		$valStr .= ')';
		$sql .= ' '.$keyStr.' value '.$valStr;
		self::$db_class->ExecuteQuery($sql);
		return self::$db_class->LastInsertID();
	}
	/**
	 * @keyValueArr eg1:array('email'=>'421707429@qq.com','name'=>'andy')
	 * * @whereArr eg1:   array('email'=>'123e234@sina.com','password'=>'pasdfe')  ,
	 *eg2:  array('email' => array('type' => 'IS NOT','value' => null))           type :   // '=.!=,>,<,>=,<=,IS ,is not ,like
	 * 
	 */
	public function update($keyValueArr,$whereArr){
		$sql = 'update '.$this->tablename;
		//$sql = 'set '
		$setSql = 'set ';
		foreach ($keyValueArr as $k => $v) {
			if($setSql!='set ') $setSql .= ',';
			$setSql .= '`'.$k.'`' .' = ';
			if(is_string($v)){
				$setSql .= "'".addslashes($v)."'";
			}else if(is_null($v)){
				$setSql .= 'NULL';
			}else if(is_int($v)){
				$setSql .= $v;
			}
		}
		$whereStr = '';
		if(!empty($whereArr)){
			$whereStr = 'where';
			foreach($whereArr as $k => $v){
				//if(is_null($v))
				if($whereStr!='where') $whereStr .= ' and';
				if(is_array($v)){
					$whereStr .= ' `'.$k.'`';
					$whereStr .= ' '.$v['type'].' ';  // '=.!=,>,<,>=,<=,IS ,is not ,like'
					if(is_string($v['value'])){
						$whereStr .= "'".addslashes($v['value'])."'";
					}else if(is_null($v['value'])){
						$whereStr .= 'NULL';
					}else if(is_int($v['value'])){
						$whereStr .= $v['value'];
					}
				}else{
					$whereStr .= ' `'.$k.'`';
					$whereStr .= ' = ';  // '=.!=,>,<,>=,<=,IS ,is not ,like'
					if(is_string($v)){
						$whereStr .= "'".addslashes($v)."'";
					}else if(is_null($v)){
						$whereStr .= 'NULL';
					}else if(is_int($v)){
						$whereStr .= $v;
					}
				}

			}
		}
		$sql .= $setSql.' '.$whereStr;
		self::$db_class->ExecuteQuery($sql);
	}
	/**
	 * @whereArr eg1:   array('email'=>'123e234@sina.com','password'=>'pasdfe')  ,
	 *eg2:  array('email' => array('type' => 'IS NOT','value' => null))           type :   // '=.!=,>,<,>=,<=,IS ,is not ,like
	 * 
	 */
	public function del($whereArr){
		$sql = 'delete from '.$this->tablename;
		$whereStr = '';
		if(!empty($whereArr)){
			$whereStr = 'where';
			foreach($whereArr as $k => $v){
				//if(is_null($v))
				if($whereStr!='where') $whereStr .= ' and';
				if(is_array($v)){
					$whereStr .= ' `'.$k.'`';
					$whereStr .= ' '.$v['type'].' ';  // '=.!=,>,<,>=,<=,IS ,is not ,like'
					if(is_string($v['value'])){
						$whereStr .= "'".addslashes($v['value'])."'";
					}else if(is_null($v['value'])){
						$whereStr .= 'NULL';
					}else if(is_int($v['value'])){
						$whereStr .= $v['value'];
					}
				}else{
					$whereStr .= ' `'.$k.'`';
					$whereStr .= ' = ';  // '=.!=,>,<,>=,<=,IS ,is not ,like'
					if(is_string($v)){
						$whereStr .= "'".addslashes($v)."'";
					}else if(is_null($v)){
						$whereStr .= 'NULL';
					}else if(is_int($v)){
						$whereStr .= $v;
					}
				}

			}
		};
		$sql .= $setSql.' '.$whereStr;
		self::$db_class->ExecuteQuery($sql);
	}
}
?>