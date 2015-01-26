<?php
define('APP_PATH',dirname(__FILE__));
define("DS", DIRECTORY_SEPARATOR);
$CONFIG = require(APP_PATH.DS.'config'.DS.'config.php');

//创建真彩色白纸
$im = @imagecreatetruecolor(200, 50) or die("建立图像失败");
//获取背景颜色
$background_color = imagecolorallocate($im, 255, 255, 255);
//填充背景颜色(这个东西类似油桶)
imagefill($im,0,0,$background_color);
//获取边框颜色
$border_color = imagecolorallocate($im,200,200,200);
//画矩形，边框颜色200,200,200
imagerectangle($im,0,0,200,50,$border_color);
//逐行炫耀背景，全屏用1或0
for($i=0;$i<50;$i+=2){ 
	$line_color = imagecolorallocate($im,rand(150,255),rand(150,255),rand(150,255));
	//画线
	imageline($im,0,$i,200,$i,$line_color);
}

//设置字体
$font = dirname(__FILE__).DS.'css'.DS.'arial_bold.ttf';

//设置印上去的文字
$Str[0] = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
$Str[1] = "abcdefghijklmnopqrstuvwxyz";
$Str[2] = "01234567891234567890123456";

$i = 0;
$imstr = array();
while ($i<=5) {
	$ims = array();
	$ims['s'] = $Str[rand(0,2)][rand(0,25)];
	if($i==0){
		$ims['x']  = rand(10,15);
	}else{
		$ims['x']  = rand(-4,6)+$imstr[$i-1]['x'] + 30;
	}
	$ims['agent'] = rand(-10,40);
	$ims['y'] = 46 + rand(-5,5);
	$ims['size'] = 40 + rand(-5,5);
	$imstr[] = $ims;
	$i++;
}
//写入随机字串 
$yanStr = '';
foreach($imstr as $v){
	//获取随机较深颜色
	$text_color = imagecolorallocate($im,rand(50,180),rand(50,180),rand(50,180));
	//画文字
	//imagechar($im,$font_size,$imstr[$i]["x"],$imstr[$i]["y"],$imstr[$i]["s"],$text_color);
	imagettftext($im, $v['size'], $v['agent'] , $v["x"],$v["y"], $text_color, $font, $v["s"]);
	$yanStr .= $v["s"];
}
for($i=0;$i<1000;$i++){
	$pix=imagecolorallocate($im,rand(0,255),rand(0,255),rand(0,255)); 
	imagesetpixel($im,rand(0,200),rand(0,50),$pix);
}
//设置验证码 session 
require(APP_PATH.DS.'lib'.DS.'session.php');
$session = new session();
session_set_save_handler(array($session,"open"),array($session,"close"),array($session,"read"),array($session,"write"),array($session,"destroy"),array($session,"gc"));
session_start();
$_SESSION['yan'] = $yanStr;
//文件头...
header("Content-type: image/png");
//显示图片
imagepng($im);
//销毁图片
imagedestroy($im); 

?>