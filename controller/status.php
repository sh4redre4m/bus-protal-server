<?php
class status_controller{
	public $openSession = false;
	public $ignoreLogin = true;
	public $ajaxadmin = false;
	public function index(){
		$in = $_GET['in'];
		$arr = $_GET['arr'];
		$in_arr = explode('|',$in);
		if(trim($in_arr[0])!=''){
			$redis = re::GetIntance();
			foreach ($in_arr as $l) {
				$v = trim($l);
				$redis->hincrby('counter',$v,1);
				echo 'if(typeof('.$arr.'.'.$v.')=="undefined"){'.$arr.'.'.$v.'=1}else{'.$arr.'.'.$v.'++};';
			}
		}
		
	}
}
?>