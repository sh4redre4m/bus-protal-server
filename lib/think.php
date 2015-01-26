<?php
class think{
	// 实例化对象
	private static $_instance = array();
	/**
	* 应用程序初始化
	*/
	public static function init() {
		// 注册AUTOLOAD方法
		spl_autoload_register('think::autoload');
		// 设定错误和异常处理
		//register_shutdown_function('think::fatalError');
		//set_error_handler('think::appError'); 
		// 设置系统时区
		date_default_timezone_set('Asia/Shanghai');
	}
	public static function start(){
		//查找controller 和 action
		self::init();
		$scriptName = $_SERVER['SCRIPT_NAME'];
		$scriptNameLower = strtolower($scriptName);
		if($scriptNameLower!==$scriptName){
			header('HTTP/1.1 301 Moved Permanently');  
			header('Location: '.$scriptNameLower); 
			exit();
		}
		$scriptNameLowerStr = str_replace('index.php','',$scriptNameLower);
		$scriptNameLowerArr = explode('/',$scriptNameLowerStr);
		if(isset($scriptNameLowerArr[1])){
			if(''==$scriptNameLowerArr[1]){
				$c = 'main'.'_controller';
				$GLOBALS['checkandre'] = true;
			}else{	
				$c = $scriptNameLowerArr[1].'_controller';
			}
		}else{
			$c = 'main'.'_controller';
			$GLOBALS['checkandre'] = true;
		}
		if(isset($scriptNameLowerArr[2])){
			if(''==$scriptNameLowerArr[2]){
				$a = 'index';
			}else{
				$a = $scriptNameLowerArr[2];
			}
		}else{
			$a = 'index';
		}
		self::instance($c,$a);
	}
	public static function cron(){
		self::init();
	}
	public static function autoload($class){
		$class_arr = explode('_',$class);
		if(count($class_arr)==1){
			if(TRUE == is_readable(APP_PATH.DS.'lib'.DS.$class_arr[0].'.php')){
				include APP_PATH.DS.'lib'.DS.$class_arr[0].'.php';				
			}
		}else{
			if(TRUE == is_readable(APP_PATH.DS.$class_arr[1].DS.$class_arr[0].'.php')){
				include APP_PATH.DS.$class_arr[1].DS.$class_arr[0].'.php';
			}
		}		
	}
	public static function instance($class,$method='') {
		$identify   =   $class.$method;
		if(!isset(self::$_instance[$identify])) {
			if(class_exists($class)){
				$o = new $class();
				if($o->ignoreLogin===true){
					if($o->openSession){
						$session = new session();
						session_set_save_handler(array($session,"open"),array($session,"close"),array($session,"read"),array($session,"write"),array($session,"destroy"),array($session,"gc"));
						session_start();
					}
				}else{
					$session = new session();
					session_set_save_handler(array($session,"open"),array($session,"close"),array($session,"read"),array($session,"write"),array($session,"destroy"),array($session,"gc"));
					session_start();
					$login = $_SESSION['login_in'];
					$db_type = $_SESSION['login_db_type'];
					if(true!==$login){						
						if($o->ajaxadmin === true){
							$o = new login_controller();							
							$method = 'ajaxadmin';
						}else{
							$o = new login_controller();
							$method = 'index';
						}
					}else{
						$o = new main_controller();
						$method = 'index';						
					}
					//$o = new 
				}
				if($method!=''){
					if(method_exists($o,$method)){
						self::$_instance[$identify] = call_user_func(array($o, $method));
					}else{
						error_msg('没有这个action',2001);
					}
				}else{
					self::$_instance[$identify] = $o;
				}
			}else{
				error_msg('没有这个class',2000);
			}                
		}
		return self::$_instance[$identify];
	}
	public static function appError($errno, $errstr, $errfile, $errline) {
		if($GLOBALS['CONFIG']['mode']==='online'){
			error_msg('系统错误',1000+$errno);
		}else{
			print_r(array($errno,$errstr,$errfile,$errline));
		}		
	}
	// 致命错误捕获
	public static function fatalError() {
		if ($e = error_get_last()){
			switch($e['type']){
				case E_ERROR:break;
				case E_PARSE:break;
				case E_CORE_ERROR:break;
				case E_COMPILE_ERROR:break;
				case E_USER_ERROR:break;
			}
		}
	}

}
?>