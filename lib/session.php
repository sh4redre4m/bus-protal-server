<?php
class session {
    public $lifeTime;
    public $redis;
    function open($savePath, $sessName) {
       // get session-lifetime
       //$this->lifeTime = get_cfg_var("session.gc_maxlifetime");
       $this->lifeTime = 3600; //  1小时后自动失效或回收
        $redis_config = $GLOBALS['CONFIG']['session_redis'];
        $r = new redis();
        $result = $r->connect($redis_config['host'],$redis_config['port'],1);
        $r->select($redis_config['db']);
        if(!$result){
            return false;
        }else{
            $this->redis = $r;
        }
       return true;
    }
    function close() {
        return true;
    }
    function read($sessID) {
        $data = $this->redis->get('session'.$sessID);
        if($data===false){
              return '';
        }else{
              $this->redis->expire('session'.$sessID,$this->lifeTime);
              return $data;
        }
    }
    function write($sessID,$sessData) {
         $this->redis->set('session'.$sessID,$sessData,$this->lifeTime);
         $this->redis->close();
        return true;
    }
    function destroy($sessID) {
            return true;
    }
    function gc($sessMaxLifeTime) {
            return true;
    }
}
?>