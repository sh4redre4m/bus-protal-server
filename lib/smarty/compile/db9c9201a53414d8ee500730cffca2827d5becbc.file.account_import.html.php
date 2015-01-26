<?php /* Smarty version Smarty-3.1.18, created on 2014-11-20 11:39:28
         compiled from "/home/andy/wifi/wifi-manage/templates/account_import.html" */ ?>
<?php /*%%SmartyHeaderCode:1345971607543230389acab8-72451033%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'db9c9201a53414d8ee500730cffca2827d5becbc' => 
    array (
      0 => '/home/andy/wifi/wifi-manage/templates/account_import.html',
      1 => 1412911657,
      2 => 'file',
    ),
    '0fa9beb3c073e07c609871848e830917894ad01d' => 
    array (
      0 => '/home/andy/wifi/wifi-manage/templates/master/master.html',
      1 => 1416419381,
      2 => 'file',
    ),
    'e78506b642b51023304519c7658250fcc9d815c8' => 
    array (
      0 => '/home/andy/wifi/wifi-manage/templates/common/m.txt',
      1 => 1412923067,
      2 => 'file',
    ),
    '148ba41302742cf42ea1a0dcdbcce678d33a021b' => 
    array (
      0 => '/home/andy/wifi/wifi-manage/templates/common/189.txt',
      1 => 1412907495,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1345971607543230389acab8-72451033',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_54323038a00837_13884263',
  'variables' => 
  array (
    'main_nav' => 0,
    'sub_nav' => 0,
    'mangerName' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54323038a00837_13884263')) {function content_54323038a00837_13884263($_smarty_tpl) {?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>wifi manage,account</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript" src="/js/jquery.min.js"></script>
    <script type="text/javascript" src="/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/js/main.js"></script>
    <link href="/css/main.css" rel="stylesheet">
    

  </head>
  <body>
 <nav role="navigation" class="navbar navbar-inverse">
      <div class="container-fluid">
        <div class="navbar-header">
          <button data-target="#bs-example-navbar-collapse-9" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a href="#" class="navbar-brand">梦享科技</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div id="bs-example-navbar-collapse-9" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
              <li class="dropdown<?php if ($_smarty_tpl->tpl_vars['main_nav']->value==1) {?> active<?php }?>">
              <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">帐号 <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li <?php if ($_smarty_tpl->tpl_vars['main_nav']->value==1&&$_smarty_tpl->tpl_vars['sub_nav']->value==1) {?>class="active"<?php }?>><a href="/account/guide">引导帐号</a></li>
                <li <?php if ($_smarty_tpl->tpl_vars['main_nav']->value==1&&$_smarty_tpl->tpl_vars['sub_nav']->value==2) {?>class="active"<?php }?>><a href="/account/general">常规帐号</a></li>
                <li <?php if ($_smarty_tpl->tpl_vars['main_nav']->value==1&&$_smarty_tpl->tpl_vars['sub_nav']->value==3) {?>class="active"<?php }?>><a href="/account/batch">批量处理</a></li>
              </ul>
            </li>
            <li class="dropdown<?php if ($_smarty_tpl->tpl_vars['main_nav']->value==2) {?> active<?php }?>">
              <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">系统 <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li <?php if ($_smarty_tpl->tpl_vars['main_nav']->value==2&&$_smarty_tpl->tpl_vars['sub_nav']->value==1) {?>class="active"<?php }?>><a href="/system/apipv">各api 访问日志</a></li>
                <li <?php if ($_smarty_tpl->tpl_vars['main_nav']->value==2&&$_smarty_tpl->tpl_vars['sub_nav']->value==2) {?>class="active"<?php }?>><a href="/system/apps">apps</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
 </nav>
 
<div class="container-fluid">
    <div class="panel panel-default">
      <div class="panel-heading">
          批量导入
          <div class="panel-btn">
                  <label class="panel-hid">收起</label>
                  <label class="panel-show">展开</label>
          </div>
      </div>
      <ol>
          <li>先把文件上传到服务器
          <pre>
          文件格式:
          帐号1      密码1
          帐号2      密码2  
          帐号3      密码3
          帐号和密码是tab来分开,帐号和帐号之间是换行符.若是格式不同请修改脚本再导入
        </pre>
          </li>
          <li>利用dumpaccount.php 这个脚本直接用cgi 的方式运行</li>
           <pre>
          参数:
                1: 导入文本的路径
                2: 导入的帐号类型,eg: guide,general
                3: 导入账户的时常
                4: 导入账户的流量
                5: 热点名称,cmcc:1,chinanet:2
                6: 导入帐号的品牌, 动感地带:1,全球通:2,神州行:3,乐享:4,飞young:5
                7: 月结日(整数): 1~31
                8:当前资费每月要付的话费,eg:30
                9:当前帐号余额,eg:30
                10:当前帐号的归属地, 请对照以下的文档查找相应的归属地.  如,移动广东广州, 请输入广州,  移动北京,请输入 北京

                eg: php importaccount.php /var/account.txt guide 500 20000 1 1 31 30 32 广州
           
归属地对照表:
中国移动:
<?php /*  Call merged included template "common/m.txt" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate('common/m.txt', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0, '1345971607543230389acab8-72451033');
content_546d6270dae8a5_96364612($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); 
/*  End of included template "common/m.txt" */?>





中国电信:
<?php /*  Call merged included template "common/189.txt" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate('common/189.txt', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0, '1345971607543230389acab8-72451033');
content_546d6270db4832_70820880($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); 
/*  End of included template "common/189.txt" */?>
           </pre>
          <li>如果中途出错,可以把备份的表还原,再尝试一遍,如果成功了就请删除备份表</li>
      </ol>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">
            批量导出需要充值帐号
            <div class="panel-btn">
                    <label class="panel-hid">收起</label>
                    <label class="panel-show">展开</label>
            </div>
      </div>
      <ol>
            <li>导出文本
           <pre>
          文本的格式:
          帐号1      30      (充值数额)
          帐号2      30
           </pre>
            </li>
          <li>充值数额 = 每月需付话费-帐号余额+1</li>
          <li>会导出4个文本
            <pre>
          cmcc_guide.txt:中国移动引导帐号
          chinanet_guide.txt:中国移动常规帐号
          cmcc_general.txt:中国电信引导帐号
          chinanet_general.txt:中国电信常规帐号
            </pre>
          </li>
          <li>eg:  php dumpaccount.php /var/
            <pre>
            参数:1 要导出的文件夹
            </pre>
          </li>
      </ol>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">
            批量更新帐号余额
          <div class="panel-btn">
                  <label class="panel-hid">收起</label>
                  <label class="panel-show">展开</label>
          </div>
      </div>
      <ol>
            <li>导入文本
           <pre>
          文本的格式:
          帐号1      30      (新的话费余额)
          帐号2      30
           </pre>
            </li>
          <li>php updateaccount.php /var/account.txt all
            <pre>
            参数:1 要导入的文本
            参数:2 要更新的帐号类型,guide:只更新引导帐号,general:只更新常规帐号,all:都更新
            </pre>
          </li>
      </ol>
    </div>
</div>
<script type="text/javascript">
$('.panel-hid').click(function(e){
      $(this).parent().find('.panel-show').show();
      $(this).hide();
       $(this).parent().parent().parent().find('ol').stop().hide(500);
})
$('.panel-show').click(function(e){
      $(this).parent().find('.panel-hid').show();
      $(this).hide();
       $(this).parent().parent().parent().find('ol').stop().show(500);
})
</script>

<div class="user_info" style="display: block; bottom: 10px; position: fixed; left: 3px;">
      <div class="user_div"><i class="icon icon-user"></i></div>
      <div class="user_logout">
              <label>欢迎您:<?php echo $_smarty_tpl->tpl_vars['mangerName']->value;?>
</label>
              <a href="javascript:void(0);" onclick="logout()">登出</a>
      </div>
</div>
</body>
 
</html><?php }} ?>
<?php /* Smarty version Smarty-3.1.18, created on 2014-11-20 11:39:28
         compiled from "/home/andy/wifi/wifi-manage/templates/common/m.txt" */ ?>
<?php if ($_valid && !is_callable('content_546d6270dae8a5_96364612')) {function content_546d6270dae8a5_96364612($_smarty_tpl) {?>北京                                              
广东
        广州  深圳  东莞  佛山  汕头  珠海  惠州  中山  江门  湛江  揭阳  茂名  韶关  清远  肇庆  云浮  梅州  河源  潮州  汕尾  阳江    
上海                              
天津                         
重庆
        主城八区 北碚 璧山 长寿 大足 合川 江津 綦江 荣昌 铜梁 潼南 万盛 永川 垫江 丰都 涪陵 南川 武隆 城口 奉节 开县 梁平 万州 巫山 巫溪 云阳 忠县 彭水 黔江 石柱 秀山 酉阳
辽宁
　　沈阳 铁岭 大连 鞍山 抚顺 本溪 丹东 锦州 营口 阜新 辽阳 朝阳 盘锦 葫芦岛               
江苏                              
湖北                              
四川
　　阿坝  巴中  成都  达州  德阳  甘孜  广安  广元  乐山  凉山   泸州   眉山  绵阳  南充  内江  遂宁  宜宾  雅安  自贡  资阳  攀枝花                      
陕西
        西安  咸阳  宝鸡  渭南  铜川  延安  榆林  汉中  安康  商洛                  
河北
        保定  张家口  承德  唐山  廊坊  沧州  衡水  邢台  邯郸  秦皇岛  石家庄                   
山西
　　太原 大同 阳泉 长治 晋城 朔州 忻州 晋中 临汾 运城 吕梁                           
河南
        郑州  南阳  许昌  商丘  洛阳  开封  信阳  安阳  周口  鹤壁  新乡  濮阳  驻马店  漯河  焦作  三门峡  平顶山  济源                              
吉林
　　长春   吉林   延吉   四平   通化   白城   辽源   松原   白山           
黑龙江
　　哈尔滨   齐齐哈尔   牡丹江   佳木斯   双鸭山   七台河   鸡西   鹤岗   伊春   黑河   绥化   大兴安岭   大庆                                             
内蒙古
        呼和浩特 兴安盟 包头 阿拉善 锡林郭勒 乌兰察布 巴彦淖尔 鄂尔多斯 呼伦贝尔 通辽 赤峰 乌海                         
山东
　　济南   青岛   淄博   德州   烟台   潍坊   济宁   泰安   临沂   菏泽   滨州   东营   威海   枣庄   日照   莱芜   聊城
安徽
　　合肥   芜湖   蚌埠   淮南   马鞍山   淮北   铜陵   安庆   黄山   阜阳   宿州   滁州   六安   宣城   池州   亳州                             
浙江
　　杭州    宁波    温州    绍兴    嘉兴    舟山    金华    衢州    台州    丽水    湖州
福建
        福州  厦门  宁德  莆田  泉州  漳州  龙岩  三明  南平                    
湖南
        长沙  湘潭  株洲  岳阳  衡阳  郴州  常德  益阳  娄底  邵阳  吉首  张家界  怀化  永州                    
广西
        南宁  柳州  桂林  梧州  北海  防城港  钦州  贵港  玉林  百色  贺州  河池  来宾  崇左                
江西
        南昌  九江  上饶  抚州  宜春  吉安  赣州  景德镇  萍乡  新余  鹰潭         
贵州
        贵阳   遵义   安顺   黔南   黔东南   铜仁   毕节   六盘水   黔西南                            
云南
        昆明  版纳  德宏  昭通  大理  红河  曲靖  保山  文山  玉溪  楚雄  普洱  临沧  怒江  迪庆  丽江            
西藏
        拉萨   日喀则  山南地区   林芝   昌都   那曲   阿里                        
海南 
        全省共享  海口  三亚  儋州  白沙  保亭  昌江  澄迈  定安  东方  乐东  临高  陵水  琼海  琼中  屯昌 文昌  万宁  五指山
甘肃
        兰州   天水   白银   平凉   庆阳   陇南   定西   金昌   武威   张掖   酒泉   嘉峪关   临夏   甘南           
宁夏
        银川 石嘴山 吴忠 中卫 固原                             
青海
        西宁  海东  海北藏族自治州  黄南藏族自治州  海南藏族自治州  果洛藏族自治州  玉树藏族自治州  海西蒙古自治州  格尔木市                 
新疆
        乌鲁木齐    昌吉      石河子     奎屯    克拉玛依    博州      阿勒泰     伊犁    塔城      吐鲁番     哈密     巴州    阿克苏     喀什      克州      和田<?php }} ?>
<?php /* Smarty version Smarty-3.1.18, created on 2014-11-20 11:39:28
         compiled from "/home/andy/wifi/wifi-manage/templates/common/189.txt" */ ?>
<?php if ($_valid && !is_callable('content_546d6270db4832_70820880')) {function content_546d6270db4832_70820880($_smarty_tpl) {?>北京
广东
	广州	韶关	深圳	珠海	汕头	佛山	江门	湛江	茂名	肇庆	惠州	梅州	汕尾	河源	阳江	清远	东莞	中山	潮州	揭阳	云浮
上海
天津
重庆
辽宁
	沈阳	大连	鞍山	抚顺	本溪	丹东	锦州	营口	阜新	辽阳	盘锦	铁岭	朝阳	葫芦岛
江苏
	南京	无锡	徐州	常州	苏州	南通	连云港	淮安	盐城	扬州	镇江	泰州	宿迁
湖北
	武汉	黄石	十堰	宜昌	襄樊	鄂州	荆门	孝感	荆州	黄冈	咸宁	恩施土家族苗族自治州	随州	林区（神农架）	省直辖县级行政区划
四川
	成都	自贡	攀枝花	泸州	德阳	绵阳	广元	遂宁	内江	乐山	南充	宜宾	广安	达州	雅安	阿坝藏族羌族自治州	甘孜藏族自治州	凉山彝族自治州	巴中	眉山	资阳
陕西
	西安	铜川	宝鸡	咸阳	渭南	延安	汉中	安康	商洛	榆林
河北
	石家庄	唐山	秦皇岛	邯郸	邢台	保定	张家口	承德	沧州	廊坊	衡水
山西
	太原	大同	阳泉	长治	晋城	朔州	忻州	吕梁	晋中	临汾	运城
河南
	郑州	开封	洛阳	平顶山	安阳	鹤壁	新乡	焦作	濮阳	许昌	漯河	三门峡	南阳	商丘	信阳	周口	驻马店
吉林
	长春	吉林	四平	辽源	通化	白山	松原	白城	延边朝鲜族自治州
黑龙江
	哈尔滨	齐齐哈尔	鸡西	鹤岗	双鸭山	大庆	伊春	佳木斯	七台河	牡丹江	黑河	绥化	大兴安岭地区	绥化-安达	绥化-肇东
内蒙古
	呼和浩特	包头	乌海	赤峰	呼伦贝尔	兴安盟	通辽	锡林郭勒盟	乌兰察布	鄂尔多斯	巴彦淖尔	阿拉善盟
山东
	济南	青岛	淄博	枣庄	东营	烟台	潍坊	济宁	泰安	威海	日照	莱芜	临沂	德州	聊城	滨州	菏泽
安徽
	合肥	芜湖	蚌埠	淮南	马鞍山	淮北	铜陵	安庆	黄山	滁州	阜阳	宿州	六安	宣城	巢湖	池州	亳州
浙江
	杭州	宁波	温州	嘉兴	湖州	绍兴	金华	衢州	舟山	台州	丽水
福建
	福州	厦门	莆田	三明	泉州	漳州	南平	龙岩	宁德
湖南
	长沙	株洲	湘潭	衡阳	邵阳	岳阳	常德	张家界	益阳	郴州	永州	怀化	娄底	湘西土家族苗族自治州
广西
	南宁	柳州	桂林	梧州	北海	防城港	钦州	贵港	玉林	贺州	百色	河池	来宾	崇左
江西
	南昌	景德镇	萍乡	九江	新余	鹰潭	赣州	宜春	上饶	吉安	抚州
贵州
	贵阳	六盘水	遵义	铜仁	黔西南布依族苗族自治州	毕节地区	安顺	黔东南苗族侗族自治州	黔南布依族苗族自治州
云南
	昆明	曲靖	玉溪	昭通	楚雄彝族自治州	红河哈尼族彝族自治州	文山壮族苗族自治州	思茅	西双版纳傣族自治州	大理白族自治州	保山	德宏傣族景颇族自治州	丽江	怒江傈僳族自治州	迪庆藏族自治州	临沧
西藏
	拉萨	昌都地区	山南地区	日喀则地区	那曲地区	阿里地区	林芝地区
海南
甘肃
	兰州	嘉峪关	金昌	白银	天水	酒泉	张掖	武威	定西	陇南	平凉	庆阳	临夏回族自治州	甘南藏族自治州
宁夏
	银川	石嘴山	吴忠	固原	中卫
青海
	西宁	海东地区	海北藏族自治州	黄南藏族自治州	海南藏族自治州	果洛藏族自治州	玉树藏族自治州	海西蒙古族藏族自治州	格尔木
新疆
	乌鲁木齐	克拉玛依	吐鲁番地区	哈密地区	昌吉回族自治州	博尔塔拉蒙古自治州	巴音郭楞蒙古自治州	阿克苏地区	克孜勒苏柯尔克孜自治州	喀什地区	和田地区	奎屯	伊犁哈萨克自治州	塔城地区	阿勒泰地区	石河子<?php }} ?>
