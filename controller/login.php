<?php
class login_controller{
	public function index(){
		$view = new view('login.html');
		$view->display();
	}
	public function ajaxadmin(){
		$view = new view();
		$view->addVars('error',0);
		$view->display();
	}
}
?>