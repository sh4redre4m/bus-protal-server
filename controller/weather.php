<?php
class weather_controller{
	public $openSession = false;
	public $ignoreLogin = true;
	public $ajaxadmin = false;
	public function index(){
		$call = $_GET['call'];
		$weather = file_get_contents('http://www.weather.com.cn/data/cityinfo/101281601.html');
		echo $call.'(\''.$weather.'\');';
	}
}
?>