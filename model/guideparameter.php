<?php
/**
* 
*/
class guideparameter_model{
               public static $list = null;
               public static $str = null;
	public function __construct(){
		if(is_null(self::$list)){
			$uri = $_SERVER['REQUEST_URI'];
			$uriArr = explode('?',$uri);
			$len = count($uriArr);
			if($len>1){
				$d = $uriArr[1];
				$pars = explode('&',$d);
				$list = array();
				foreach ($pars as  $v) {
					$parsKeyVal = explode('=',$v);
					$array = array(trim($parsKeyVal[0])=>$parsKeyVal[1]);
					$list = self::setParameter($array,$list);
				}
				self::$list = $list;
			}else{
				self::$list = array();
			}	
		}

	}
	/**
	 * @arr eg: array('p'=>1,'t'=>1)
	 */
	public static function setParameter($arr,$orgList){
		foreach($arr as $k => $v){
			switch ($k) {
				case 'p':
					if(!preg_match('/^[0-9]{1,4}$/',$v)){
						error_msg('p的参数输入不正确',2005);
					}
					$orgList[$k] = array('value'=>$v,'order'=>4);
					break;
				case 'f':
					if(!in_array($v,array('1','2','3'))){
						error_msg('f的参数输入不正确',2005);
					}
					$orgList[$k] = array('value'=>$v,'order'=>2);
					break;
				case 'pid':
					if(!preg_match('/^[0-9]{1,3}$/', $v)){
						error_msg('pid的参数输入不正确',2005);
					}
					$orgList[$k] = array('value'=>$v,'order'=>1);
					break;
				case 'acnum':
					if(!preg_match('/^[A-Za-z]{0,3}[0-9]{8,11}$/', $v)){
						error_msg('acnum的参数输入不正确',2005);
					}
					$orgList[$k] = array('value'=>$v,'order'=>1);
					break;					
				case 'ct':
					if(!in_array($v,array('1','2'))){  // 1:cmcc,2:chinanet
						error_msg('c的参数输入不正确',2005);
					}
					$orgList[$k] = array('value'=>$v,'order'=>1);
					break;
				case 'o':
					if(!in_array($v,array('1','2','3'))){
						error_msg('o的参数输入不正确',2005);
					}
					$orgList[$k] = array('value'=>$v,'order'=>3);
					break;
				default: error_msg('没有'.$k.'这个参数',2005);
			}
		}
		return $orgList;
               }
               public static function removeParameter($k,$list){
               	$arr = explode(',', $k);
               	foreach ($arr as $v) {
               		unset($list[$v]);
               	}
               	return $list;
               }
               public static function returnCurrentList(){
               	return self::$list;
               }
               public static function returnArr(){
              		return self::$list;
               }
               public static function returnStr($list = null){
          		if(is_null($list)){
          			$list = self::$list;
          		}
          		$str = '';
          		$orderList = array();
          		foreach ($list as $k => $v) {
          			$orderList[$v['order']] = array('key'=>$k,'value'=>$v['value']);
          		}
          		ksort($orderList);
          		foreach ($orderList as $k => $v) {
          			if($str !='') $str .= '&';
          			$str .=$v['key'].'='.$v['value'];
          		}
          		return $str;
              }
              public function getValueByKey($key,$default = false){
		if(isset(self::$list[$key])){
			return self::$list[$key]['value'];
		}else{
			return $default;
		}
              }
}
?>