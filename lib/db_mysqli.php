<?php
/**
 * MySQL Data access
 * @author Andy
 */
function return_new_mysqli_obj($db_server){
	$mysqli = new mysqli($db_server['host'],$db_server['user'],$db_server['pw'],$db_server['name'],$db_server['port']);
	if($mysqli){
		$mysqli->set_charset('UTF8');
		return $mysqli;
	}else{
		throw new ErrorException("Cannot connect to the MySQL Database ".$db_server['host'].":".$db_server['port'].".",1);
	}
}
class db_mysqli {
	private static $db_connect_arr = array();
	private static $query_list = array();
	private static $query_async_list = array();
	
	public function __construct($dbConfig = null){
		$this->dbConfig = $GLOBALS['CONFIG']['db'];
	}
	private function return_mysqli_obj($key){
		//$this->dbConfig
		if(!isset(self::$db_connect_arr[$key])){
			$db_server = $this->dbConfig['servers'][$key];
			self::$db_connect_arr[$key] = return_new_mysqli_obj($db_server);
		}
		return self::$db_connect_arr[$key];
	}
	public static function addQuery_list($arr){
		self::$query_list[] = $arr;
	}
	public function  __destruct(){
		$write_key = $this->dbConfig['write'];
		if(!empty(self::$query_async_list)){
			foreach(self::$query_async_list as $k => $l){
				if($k==0){
					if(!isset(self::$db_connect_arr[$key])){
						$mysqli = return_new_mysqli_obj($this->dbConfig['servers'][$write_key]);
					}else{
						$mysqli = self::$db_connect_arr[$key];
					}
					$mysqli->query($l,MYSQLI_ASYNC);
				}else{
					$mysqli = return_new_mysqli_obj($this->dbConfig['servers'][$write_key]);
					$mysqli->query($l,MYSQLI_ASYNC);
					$mysqli->close();
				}
			}
		}
		foreach(self::$db_connect_arr as $mysqli){
			$mysqli->close();
		}
	}
	public function __changeDB($db_name,$key){
		if(isset(self::$db_connect_arr[$key])){
			self::$db_connect_arr[$key]->select_db($db_name);
		}
	}
	/**
	 * Reconnect to database
	 */
	public function Reconnect($key=null){
		if($key===null) $key = $this->dbConfig['write'];
		if ($this->dbConfig['debug_echo_sql']){
			self::$query_list[] = array( "sql" => "Reconnect MySQL", "stack" => array(), "error"=> "" ) ;
		}
		if (isset(self::$db_connect_arr[$key])){
			self::$db_connect_arr[$key]->close();
		}	
		self::$db_connect_arr[$key] = $this->return_mysqli_obj($key);
	}
	public function select_db($db_name,$key){
		$mysqli=$this->return_mysqli_obj($key);
		$mysqli->select_db($db_name);
		self::$db_connect_arr[$key]=$mysqli;
	}
	public function return_dbkey_by_sql($sql){
		if(preg_match('/^(insert|drop|turncate|update|delete|alter|create|replace|load|add|rename|grant|revoke|call)\s[\s\S]*$/i',trim($sql))){
			return $this->dbConfig['write'];
		}else{
			return $this->dbConfig['read'];
		}
	}
	public function ExecuteQuery($exec,$if_async=false,$key=null){	
		if($key===null) $key = $this->return_dbkey_by_sql($exec);
		$db = $this->return_mysqli_obj($key);
		if ($db) {
			if ($this->dbConfig['debug_echo_sql']){
				list($s1, $s2) = explode(' ', microtime());
				$star_time =  (float)sprintf('%.0f', (floatval($s1) + floatval($s2)) * 1000);
			}
			if($if_async){
				self::$query_async_list[] = $exec;
			}else{
				$query_result = $db->query($exec);
			}
			if ($this->dbConfig['debug_echo_sql']){
				list($s1, $s2) = explode(' ', microtime());
				$end_time =  (float)sprintf('%.0f', (floatval($s1) + floatval($s2)) * 1000);
			}
			if ($this->dbConfig['debug_echo_sql']){
				$stack = @debug_backtrace();
                			if($if_async){
					self::$query_list[] = array( "sql" => $exec, "stack" => $stack, "error"=> 'db_key: '.$key.'--'.$this->GetLastError($key),'runtime'=>'async:'.($end_time-$star_time),'php_mem'=>memory_get_usage()) ;
				}else{
					self::$query_list[] = array( "sql" => $exec, "stack" => $stack, "error"=> 'db_key: '.$key.'--'.$this->GetLastError($key),'runtime'=>$end_time-$star_time,'php_mem'=>memory_get_usage()) ;
				}				
			}
			if (($query_result === FALSE && !$if_async)){
				error_msg("$exec <br />Error: ".'db_key: '.$key.'--'.$this->GetLastError($key),2002);
			}
			return $query_result;
		}else{
			throw new ErrorException("mysql connection is missing",1);
		}
	}
	
	/**
	 * Execution a MySQL query, return the result array.
	 *
	 * @param string $exec The MySQL query
	 */
	public function ExecuteArray($exec,$if_async=false,$key=null){
		$query_result = $this->ExecuteQuery($exec,$if_async,$key);
		if ($query_result===false || $query_result===true) return FALSE;
		$rows = array();
		while($rows[] = $query_result->fetch_array(MYSQL_ASSOC)){
		}
		$query_result->free();
		array_pop($rows);
		return $rows;
	}
	public function ExecuteObject($exec,$if_async=false,$key=null){
		$query_result = $this->ExecuteQuery($exec,$if_async,$key);
		if ($query_result===false || $query_result===true) return FALSE;
		$rows = array();
		while($rows[] = $query_result->fetch_object()){
		}
		array_pop($rows);
		$query_result->free();	
		return $rows;
	}
	public function ExecuteRowsNumber($exec){
		$query_result = $this->ExecuteQuery($exec);
		if ($query_result!==true) return FALSE;
		$key = $this->dbConfig['write'];
		$mysqli = $this->return_mysqli_obj($key);
		$number = $mysqli->affected_rows;
		return $number;
	}

	public function FreeResult(){
		/*if (self::$db_connect_id) {
			$result = @mysql_free_result(self::$db_connect_id);
			return $result;
		}else{
			return FALSE;
		}*/
	}

	/**
	 * Get the last insert id
	 */
	public function LastInsertID($key = null){
		if($key === null){
			$key = $this->dbConfig['write'];
		}
		if (isset(self::$db_connect_arr[$key])) {
			$result = self::$db_connect_arr[$key]->insert_id;
			return $result;
		}else{
			return FALSE;
		}
	}

	public function FilterValue($value){
		if(is_null($value))return 'NULL';
		if(is_bool($value))return $value ? 1 : 0;
		return "'".addslashes($value)."'";
	}

	public function GetFields($exce){
		if (self::$db_connect_id) {
			$query_result = $this->ExecuteQuery($exec);
			if (!$query_result) return FALSE;
			$fields = array();
			while ($property = $query_result->fetch_field())
			{
				$fields[] = $property->name;
			}
			return $fields;
		}
	}
	public function GetLastError($key){
		if (isset(self::$db_connect_arr[$key])) {
			$result = self::$db_connect_arr[$key]->error;
			return $result;
		}else{
			return FALSE;
		}
	}
	public function GetQueryHistory(){
		return self::$query_list;
	}
}
