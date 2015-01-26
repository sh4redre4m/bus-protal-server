<?php
	$CONFIG = require(APP_PATH.DS.'config'.DS.'config.php');
	if($GLOBALS['CONFIG']['mode']==='online'){
		error_reporting(~E_ALL);		
	}else{
		ini_set('display_errors','On');
		error_reporting(E_ALL&~E_NOTICE);
	}
	function error_msg($msg='',$code='1000'){
		if($GLOBALS['CONFIG']['mode']==='online'){
			//echo 'error_code:'.$code.'<br/>error msg:'.$code;
			echo '404!';
			exit();
		}else{
			echo 'error_code:'.$code.'<br/>error msg:'.$msg;
			echo '<pre>';
			print_r(debug_backtrace());
			exit();
		}
	}
	require(APP_PATH.DS.'lib'.DS.'think.php');
?>