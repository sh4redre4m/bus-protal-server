<?php
class view{
	private $type = 'smarty'; // smarty,json
	private $smarty = null; // smarty obj
	private $jsonview = array(); // smarty,json
	private $smarty_tmp = ''; // smarty,json
	public function __construct($tmp=''){
		if($tmp==''){
			$this->type = 'json';
		}else{
			require_once(APP_PATH.DS.'lib'.DS.'smarty'.DS.'Smarty.class.php');
			//echo APP_PATH.DS.'lib'.DS.'smarty'.DS.'Smarty.class.php';
			$this->smarty = new Smarty();
			$this->smarty->force_compile = false;
			$this->smarty->debugging = false;
			$this->smarty->caching = false;
			$this->smarty->left_delimiter = '{#';
			$this->smarty->right_delimiter = '#}';
			$this->smarty->cache_dir = dirname(__FILE__).DS.'smarty'.DS.'cache';
			$this->smarty->compile_dir = dirname(__FILE__).DS.'smarty'.DS.'compile';
			$this->smarty ->template_dir = APP_PATH.DS.'templates';
			$this->smarty_tmp = $tmp;
		}
	}
	/**
	 * @url  http://www.speedphp.com/smarty/api.register.plugin.html
	 *$type  eg:  'function','block','modifier'
	 *
	 */	
	public function registerSmatyPlugin($type,$name,$fun){
		$this->smarty->registerPlugin($type,$name,$fun);
	}
	public function addVars($k,$value){
		if($this->type=='smarty'){
			$this->smarty->assign($k,$value);
		}else{
			$this->jsonview[$k] = $value;
		}
	}
	public function display(){
		if($this->type=='smarty'){
			$this->smarty->display($this->smarty_tmp);
		}else{
			header('Content-Type:application/json; charset=utf-8');
			echo json_encode($this->jsonview);
		}
	}
}
?>