<?php
	define('APP_PATH',dirname(dirname(__FILE__)));
	define("DS", DIRECTORY_SEPARATOR);
	require(APP_PATH.DS.'lib'.DS.'lib.php');
	think::cron();

	$PingYing = new pinyin();
	// ios recommend
	$data_recommend = file_get_contents("http://baidu.app111.com/index?menu=index&tab=history&currentPage=1");
	
	$json = json_decode($data_recommend,true);
	$AppList = $json['AppList'];
	$len = count($AppList);
	$data_recommend_arr = array();
	if($len>0){
		foreach ($AppList as $l) {
			$d = array();
			$d['name'] = $l['AppName'];
			$d['pinyin'] = $PingYing->getAllPY($l['AppName']);
			$d['logo_orignurl'] = $l['AppLogo'];
			$d['summary'] = $l['BriefSummary'];
			$d['AppSource'] = $l['AppSource'];
			$data_recommend_arr[] = $d;
		}
	}

	// ios summary
	$data_game = file_get_contents("http://baidu.app111.com/index?menu=index&tab=game&currentPage=1");
	
	$json = json_decode($data_game,true);
	$AppList = $json['AppList'];
	$len = count($AppList);
	$data_game = array();
	if($len>0){
		foreach ($AppList as $l) {
			$d = array();
			$d['name'] = $l['AppName'];
			$d['pinyin'] = $PingYing->getAllPY($l['AppName']);
			$d['logo_orignurl'] = $l['AppLogo'];
			$d['summary'] = $l['BriefSummary'];
			$d['AppSource'] = $l['AppSource'];
			$data_game_arr[] = $d;
		}
	}

	// ios bibei
	$data_app = file_get_contents("http://baidu.app111.com/index?menu=index&tab=bibei&currentPage=1");
	
	$json = json_decode($data_app,true);
	$AppList = $json['AppList'];
	$len = count($AppList);
	$data_app_arr= array();
	if($len>0){
		foreach ($AppList as $l) {
			$d = array();
			$d['name'] = $l['AppName'];
			$d['pinyin'] = $PingYing->getAllPY($l['AppName']);
			$d['logo_orignurl'] = $l['AppLogo'];
			$d['summary'] = $l['BriefSummary'];
			$d['AppSource'] = $l['AppSource'];
			$data_app_arr[] = $d;
		}
	}

	// an recommend

	$an_recommend = file_get_contents("http://mobile.baidu.com/app?action=index&type=home&from=0&pn=0");
	
	$json = json_decode($an_recommend,true);
	$AppList = $json['data']['recommend'];
	$len = count($AppList);
	$an_recommend_arr = array();
	if($len>0){
		foreach ($AppList as $l) {
			$d = array();
			$d['name'] = $l['sname'];
			$d['pinyin'] = $PingYing->getAllPY($l['sname']);
			$d['logo_orignurl'] = $l['icon'];
			$d['summary'] = $l['icon'];
			$d['AppSource'] = $l['download_url'];
			$an_recommend_arr[] = $d;
		}
	}

	// an summary
	$an_recsoft = file_get_contents("http://mobile.baidu.com/app?action=list&type=recsoft&from=0&pn=0");
	
	$json = json_decode($an_recsoft,true);

	$AppList = $json['data'];
	$len = count($AppList);
	$an_recsoft_arr = array();
	if($len>0){
		foreach ($AppList as $l) {
			$d = array();
			$d['name'] = $l['sname'];
			$d['pinyin'] = $PingYing->getAllPY($l['sname']);
			$d['logo_orignurl'] = $l['icon'];
			$d['summary'] = $l['icon'];
			$d['AppSource'] = $l['download_url'];
			$an_recsoft_arr[] = $d;
		}
	}
	// an bibei
	$an_game = file_get_contents("http://mobile.baidu.com/app?action=list&type=recgame&from=0&pn=0");
	
	$json = json_decode($an_game,true);
	$AppList = $json['data'];
	$len = count($AppList);
	$an_game_arr = array();
	if($len>0){
		foreach ($AppList as $l) {
			$d = array();
			$d['name'] = $l['sname'];
			$d['pinyin'] = $PingYing->getAllPY($l['sname']);
			$d['logo_orignurl'] = $l['icon'];
			$d['summary'] = $l['icon'];
			$d['AppSource'] = $l['download_url'];
			$an_game_arr[] = $d;
		}
	}


	$data_recommend_len = count($data_recommend_arr);
	$data_game_len = count($data_game_arr);
	$data_app_len = count($data_app_arr);

	$an_recommend_len = count($an_recommend_arr);
	$an_recsoft_len = count($an_recsoft_arr);
	$an_game_len = count($an_game_arr);

	$redis = re::GetIntance();
	if($data_recommend_len==15){
		$data_recommend_ser = serialize($data_recommend_arr);
		$redis->set('ios_recommend',$data_recommend_ser);
	}
	if($data_game_len==15){
		$data_game_ser = serialize($data_game_arr);
		$redis->set('ios_game',$data_game_ser);		
	}
	if($data_app_len==15){
		$data_app_ser = serialize($data_app_arr);
		$redis->set('ios_app',$data_app_ser);	
	}


	if($an_recommend_len==15){
		$an_recommend_ser = serialize($an_recommend_arr);
		$redis->set('an_recommend',$an_recommend_ser);
	}
	if($an_recsoft_len==15){
		$an_recsoft_ser = serialize($an_recsoft_arr);
		$redis->set('an_app',$an_recsoft_ser);		
	}
	if($an_game_len==15){
		$an_game_ser = serialize($an_game_arr);
		$redis->set('an_game',$an_game_ser);		
	}
	exit();
/*
anzuo:
http://mobile.baidu.com/app?action=index&type=home&from=0&pn=0
http://mobile.baidu.com/app?action=list&type=recsoft&from=0&pn=0
http://mobile.baidu.com/app?action=list&type=recgame&from=0&pn=0	
*/
	

	// ios 
	/*$header[] = "Content-type: text/xml";
	$url = "http://baidu.app111.com/index?menu=index&tab=history&currentPage=1";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)"); 
	$response = curl_exec($ch);
	curl_close($ch);
	var_dump($response);
	exit();*/


	//$db = $dbObj->insertArr($inKey,$inArr);






	
?>