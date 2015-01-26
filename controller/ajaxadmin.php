<?php
class ajaxadmin_controller{
	public $ajaxadmin = true;
	public function delapp(){
		$ids = $_REQUEST['ids'];
		$idArr = explode(',',$ids);
		$db = new db();
		$db->setTableName('wifipublic.`customer_base_info`',false);
		$re = new re();
		$rediss = $re->getRedisByKey(array('live','test','staging1','staging2'));
		foreach ($idArr as $k => $v) {
			$id = intval($v);
			$deldata = $db->findOne(array('id'=>$id),'token,id');
			$token = $deldata['token'];
			foreach ($rediss as $redis) {
				$redis->del($token);
			}
			$db->del(array('id'=>$id));
		}
		$view = new view();
		$view->addVars('result',0);
		$view->display();
	}
	public function changeapp(){
		$id = $_REQUEST['id'];
		$id = intval($id);
		$view = new view();
		if($id==''){
			$view->addVars('result',1);
			$view->display();
			exit();
		}
		$update_arr = array();
		if(isset($_REQUEST['user_quantity'])){
			$user_quantity = intval($_REQUEST['user_quantity']);
			if($user_quantity==''){
				$view->addVars('result',1);
				$view->display();
				exit();
			}else{
				$update_arr['user_quantity'] = $user_quantity;
			}
		}

		if(isset($_REQUEST['concurrent_quantity'])){
			$concurrent_quantity = intval($_REQUEST['concurrent_quantity']);
			if($concurrent_quantity==''){
				$view->addVars('result登陆信息已过期登陆',1);
				$view->display();
				exit();
			}else{
				$update_arr['concurrent_quantity'] = $concurrent_quantity;
			}
		}

		if(isset($_REQUEST['db_ltime'])){
			$db_ltime = $_REQUEST['db_ltime'];

			$db_ltime = intval($_REQUEST['db_ltime']);
			if($db_ltime==''){
				$view->addVars('result',1);
				$view->display();
				exit();
			}else{
				$update_arr['ltime'] = $db_ltime;
			}
		}

		if(isset($_REQUEST['ltime'])){
			$ltime = intval($_REQUEST['ltime']);
			if($ltime==''){
				$view->addVars('result',1);
				$view->display();
				exit();
			}else{
				$ltime = $ltime;
			}
		}else{
			$ltime = null;
		}
		$db = new db();
		$db->setTableName('wifipublic.`customer_base_info`',false);
		if(count($update_arr)!=0){
			$db->update($update_arr,array('id'=>$id));
		}
		if(count($update_arr)!=0 || isset($_REQUEST['ltime'])){
			$token = $db->findOne(array('id'=>$id),'token');
			$token = $token['token'];

			$re = new re();
			$rediss = $re->getRedisByKey(array('live','test','staging1','staging2'));

			unset($update_arr['ltime']);
			if(isset($_REQUEST['ltime'])){
				$update_arr['ltime'] = $_REQUEST['ltime'];
			}
			foreach ($rediss as $redis) {
				$redis->hmset($token, $update_arr);
			}
			
		}
		$view->addVars('result',0);
		$view->display();
	}
	public function addapp(){
		$view = new view();		
		if(!isset($_REQUEST['name']) || !isset($_REQUEST['pack_name']) || !isset($_REQUEST['token']) || !isset($_REQUEST['user_quantity']) || !isset($_REQUEST['concurrent_quantity']) || !isset($_REQUEST['ltime'])){
			$view->addVars('result',1);
			$view->display();
			exit();
		}
		$data = array(
			'name' => $_REQUEST['name'],
			'token' => $_REQUEST['token'],
			'pack_name' => $_REQUEST['pack_name'],
			'buy_pack_type' => 1,
			'use_pack_type' => 1,
			'user_quantity' => intval($_REQUEST['user_quantity']),
			'concurrent_quantity' => intval($_REQUEST['concurrent_quantity']),
			'time_pack_price' => 1,
			'flow_pack_price' => 1,
			'account_type' => 1,
			'user_cnt_limit' => 0,
			'ltime' => intval($_REQUEST['ltime'])
		);
		$db = new db();
		$db->setTableName('wifipublic.`customer_base_info`',false);
		$db->insert($data);
		$info = array(
			'ltime' => $data['ltime'],
			'user_cnt_limit' => $data['user_cnt_limit'],
			'concurrent_quantity' => $data['concurrent_quantity'],
			'current' => 0,
			'aberrant_total' => 0,
			'aberrant_current' => 0,
			'time' => 0,
			'flow' => 0,
		);
		$re = new re();
		$rediss = $re->getRedisByKey(array('live','test','staging1','staging2'));
		foreach ($rediss as $redis) {
			$redis -> hmset($data['token'],$info);
		}
		
		$view->addVars('result',0);
		$view->display();
	}
}
?>