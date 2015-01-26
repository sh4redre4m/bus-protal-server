<?php
class feedback_controller{
	public $openSession = false;
	public $ignoreLogin = true;
	public $ajaxadmin = false;
	public function index(){
		$call = $_GET['call'];
		$qq = urldecode($_GET['qq']);
		$question = urldecode($_GET['question']);
		$ip = $_SERVER['REMOTE_ADDR'];
		$db = new db('feedback');
		$db->insert(array('qq'=>$qq,'question'=>$question,'ip'=>$ip));
		echo $call.'();';
	}
}
?>