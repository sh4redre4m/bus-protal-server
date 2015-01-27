<?php
class android_controller{
	public $openSession = false;
	public $ignoreLogin = true;
	public $ajaxadmin = false;
	public function getapp(){
		$call = $_GET['call'];
		$redis = re::GetIntance();
		$recommend_ser = $redis->get('an_recommend');
		$app_ser = $redis->get('an_app');
		$game_ser = $redis->get('an_game');

		$recommend = unserialize($recommend_ser);
		$app = unserialize($app_ser);
		$game = unserialize($game_ser);
		
		$return = array();
		$return['recommend'] = array_slice($recommend,0,8);
		$return['app'] = array_slice($app,0,8);
		$return['game'] = array_slice($game,0,8);

		$json = json_encode($return);
		echo $call.'(\''.$json.'\');';
	}
}
?>