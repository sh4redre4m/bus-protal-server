<?php
class re{
	private static $redis_intance = null;
	private static $redislist = null;
	public function __construct(){
		self::GetIntance();
	}
	public static function getRedis(){
		return self::$redis_intance;
	}
	/**
	 * example:$keys: array('live','test','staging1','staging2')  see in config.php -> server_list
	 * return : array('live'=>$redisObj,'test'=>$redisObj,'staging1'=>$redisObj,'staging2'=>$redisObj)
	 */
	public static function GetIntance(){
		if(is_null(self::$redis_intance)){
			$redis_config = $GLOBALS['CONFIG']['redis'];
			$r = new redis();
			$result = $r->connect($redis_config[0]['host'],$redis_config[0]['port'],1);
			if(isset($redis_config[0]['db'])){
				$r->select($redis_config[0]['db']);
			}			
			if(!$result){
				$result = $r->connect($redis_config[1]['host'],$redis_config[1]['port'],1);
				if(isset($redis_config[1]['db'])){
					$r->select($redis_config[1]['db']);
				}
				if(!$result){
					return false;
				}else{
					self::$redis_intance = $r;
				}
			}else{
				self::$redis_intance = $r;
			}

		}
		return self::$redis_intance;
	}
	public function __destruct (){
		if(!is_null(self::$redis_intance)){
			self::$redis_intance->close();
		}
		if(!is_null(self::$redislist)){
			$returnobj = self::$redislist;
			foreach ($returnobj as $k => $l) {
				$l->close();
			}
		}
	}
}
?>