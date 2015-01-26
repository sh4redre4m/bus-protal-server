<?php
/**
* 
*/
class serverapi_model{	
	public $serverType = 'cmcc'; // cmcc,chinanat
	//private $CmccSecretKey = '894u9iduyfuejdiu';
	private $CmccSecretKey = '1987056fdfehAhTB';
	private static $HexKey = null;
	public function __construct($serverType='cmcc'){
		$this->serverType = $serverType;
	}
	/**
	 * @return int(1)  
	 *0:change Success,
	 *1:acount not exiet,
	 *2:old password Incorrect 
	 *3:curl require Parameters wrong,
	 *4:parfrom user wrong,
	 *5:prafrom change pw not success,
	 *6:curl r equire can not return correctly
	 */
	public function ChangePw($acount,$oldPw,$newPw,$serverType='cmcc'){
		if($serverType=='cmcc'){
			$ShareKey = $this->CmccEncode('1987_Uh78th9gg');
			$PhoneNumber =  $this->CmccEncode($acount);
			$PingNumber =  $this->CmccEncode($oldPw);
			$NewPingNumber =  $this->CmccEncode($newPw);
			
			$xml_data ='<ModPwdService><Security><SourceName>STANDAR_A</SourceName><ShareKey>'.$ShareKey.'</ShareKey><Sequence>BAIDU20120302115032</Sequence></Security><Body><PhoneNumber>'.$PhoneNumber.'</PhoneNumber><PingNumber>'.$PingNumber.'</PingNumber><NewPingNumber>'.$NewPingNumber.'</NewPingNumber></Body></ModPwdService>';
			$header[] = "Content-type: text/xml";
			$url = "http://221.179.9.18:8080/bpss/servlet/modWLANPWDService";
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_data);
			curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)"); 
			$response = curl_exec($ch);
			curl_close($ch);
			$p =preg_match('/<ReCode>(\d{1})<\/ReCode>/U', $response,$data);
			if($p){
				if(in_array($data[1],array(0,1,2,3,4,5))){
					return intval($data[1]);
				}else{
					return 6;
				}
			}else{
				die($response);
			}
		}
	}
	private function GetHexkey($keyStr = null){
		if(is_null($keyStr)){
			$k = $this->CmccSecretKey;
		}else{
			$k = $keyStr;
		}
		if(!isset(self::$HexKey[$k])){
			$str = $this->String2Hex($k).'2468101214161820';
			$key = $this->Hex2String(md5($this->Hex2String($str)));
			self::$HexKey[$k] = $key;
		}
		return self::$HexKey[$k];
	}
	private function CmccEncode($str){
		//$key = $this->Hex2String(MD5($this->Hex2String($str)));
		$key = $this->GetHexkey('1987056fdfehAhTB');
		$data = $this->String2Hex($str)."80";
		while (strlen($data)%32!=0) {
			$data.='00';
		}
		$adata = $this->Hex2String($data);
		/*********aes 加密过程 *******/
		$iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128,MCRYPT_MODE_ECB),MCRYPT_RAND); 
		$en = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $adata, MCRYPT_MODE_ECB, $iv);
		/*********aes 加密过程 end *******/
		return strtoupper($this->String2Hex($en)); 
	}
	private function String2Hex($string){
		$hex='';
		for ($i=0; $i < strlen($string); $i++){
			$temp = dechex(ord($string[$i]));
			if (strlen($temp) == 1)
			$hex .= '0';
			$hex .= $temp;
		}
		return $hex;
	}
	private function Hex2String($hex){
		$string='';
		for ($i=0; $i < strlen($hex)-1; $i+=2){
			$string .= chr(hexdec($hex[$i].$hex[$i+1]));
		}
		return $string;
	}
	public function createPw(){
		$Str[0] = "ABCDEFGHJKMNPQRSTUVWXYZ";
		$Str[1] = "abcdefghjkmnpqrstuvwxyz";
		$Str[2] = "123456789";
		$Str[3] = "!@#$%^&*";
		$pwArr = array();
		$i = 0;
		while ($i < 3) {
			$pwArr[] = $Str[0][rand(0,22)];
			$i++;
		}
		$i = 0;
		while ($i < 3) {
			$pwArr[] = $Str[1][rand(0,22)];
			$i++;
		}
		$i = 0;
		while ($i < 3) {
			$pwArr[] = $Str[2][rand(0,8)];
			$i++;
		}

		shuffle($pwArr);
		$pw = join('',$pwArr);
		return $pw;
	}
	public function checkAccout(){
		$SourceName = 'THRTEST_A';
		$ShareKey =  $this->CmccEncode('201412_thrtest');
		$Sequence = $SourceName.date('YmdHis');//YYYYMMDDHHMMSS
		$PhoneNumber =  $this->CmccEncode('13927217091');;
		$PingNumber =  $this->CmccEncode('2014abcd');;
		$OperatorType =  'qrycustaccbalance';
		$xml_data = '<QueryWLANBusinessService>
<Security>
<SourceName>'.$SourceName.'</SourceName>
<ShareKey>'.$ShareKey.'</ShareKey>
<Sequence>'.$Sequence.'</Sequence>
</Security>
<Body>
<PhoneNumber>'.$PhoneNumber.'</PhoneNumber>
<PingNumber>'.$PingNumber.'</PingNumber>
<OperatorType>'.$OperatorType.'</OperatorType>
</Body>
</QueryWLANBusinessService>';
		$header[] = "Content-type: text/xml";
		$url = "http://221.179.9.22:8080/bpss/servlet/QueryWLANBusinessService";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_data);
		//curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)"); 
		$response = curl_exec($ch);
		curl_close($ch);
		echo $xml_data;
		exit();
		$p =preg_match('/<ReCode>(\d{1})<\/ReCode>/U', $response,$data);
		if($p){
			if(in_array($data[1],array(0,1,2,3,4,5))){
				return intval($data[1]);
			}else{
				return 6;
			}
		}else{
			die($response);
		}
	}
	public function forceLogoutAccout(){
		//14778322731|Aj9rxJvv

		$sourceName = 'THRTEST_A';
		$shareKey =  $this->CmccEncode('201412_thrtest');
		$sequence = $sourceName.date('YmdHis');//YYYYMMDDHHMMSS
		$phoneNumber =  $this->CmccEncode('13927217091');;
		$pingNumber =  $this->CmccEncode('yCb67dWK');;
		$operatorType =  'kickuserlogout';  //qryuserstatus
		$xml_data = '<OperatorWLANService>
<Security>
<SourceName>'.$sourceName.'</SourceName>
<ShareKey>'.$shareKey.'</ShareKey>
<Sequence>'.$sequence.'</Sequence>
</Security>
<Body>
<PhoneNumber>'.$phoneNumber.'</PhoneNumber>
<PingNumber>'.$pingNumber.'</PingNumber>
<OperatorType>'.$operatorType.'</OperatorType>
</Body>
</OperatorWLANService>';
		


		echo $xml_data;exit();
		$header[] = "Content-type: text/xml";
		$url = "http://221.179.9.22:8080/bpss/servlet/OperatorWLANService";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_data);
		//curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)"); 
		$response = curl_exec($ch);
		curl_close($ch);
		echo $response;
		exit();
		$p =preg_match('/<ReCode>(\d{1})<\/ReCode>/U', $response,$data);
		if($p){
			if(in_array($data[1],array(0,1,2,3,4,5))){
				return intval($data[1]);
			}else{
				return 6;
			}
		}else{
			die($response);
		}		
	}
}

/*
<?xml version="1.0" encoding="UTF-8"?>
<QueryWLANBusinessService>
	<Header>
	<Sequence>THRTEST_A20141219152934</Sequence>
	<OperatorType>qrycustaccbalance</OperatorType>
	<RespTime>20141219152934</RespTime>
	<PhoneNumber>13927217091</PhoneNumber>
	<RetCode>7</RetCode>
	<RetMsg>请求报文格式有误:查找业务[ccchkauthcheck]对应的业务解析方式失败，错误信息[渠道[bsacPortal] 协议[UniformProtocolID] 业务[ccchkauthcheck]的流程脚本为空]</RetMsg>
</Header>
<Body>
	<MonthrealTime></MonthrealTime>
	<AvailBalance></AvailBalance>
</Body>
</QueryWLANBusinessService>*/

?>
