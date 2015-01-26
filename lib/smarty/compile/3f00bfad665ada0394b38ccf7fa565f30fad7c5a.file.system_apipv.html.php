<?php /* Smarty version Smarty-3.1.18, created on 2014-11-20 14:24:04
         compiled from "/home/andy/wifi/wifi-manage/templates/system_apipv.html" */ ?>
<?php /*%%SmartyHeaderCode:166147265954323f77b267f5-69868267%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3f00bfad665ada0394b38ccf7fa565f30fad7c5a' => 
    array (
      0 => '/home/andy/wifi/wifi-manage/templates/system_apipv.html',
      1 => 1412912116,
      2 => 'file',
    ),
    '0fa9beb3c073e07c609871848e830917894ad01d' => 
    array (
      0 => '/home/andy/wifi/wifi-manage/templates/master/master.html',
      1 => 1416419381,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '166147265954323f77b267f5-69868267',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_54323f77b70b84_57086870',
  'variables' => 
  array (
    'main_nav' => 0,
    'sub_nav' => 0,
    'mangerName' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54323f77b70b84_57086870')) {function content_54323f77b70b84_57086870($_smarty_tpl) {?><!DOCTYPE html>
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
    
    <style type="text/css">
    .container-fluid{
      min-width: 700px;
    }
    </style>

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
          日常日志<br/>
          <?php echo $_smarty_tpl->tpl_vars['date1']->value;?>

          <div class="panel-btn">
                  <label class="panel-hid">收起</label>
                  <label class="panel-show">展开</label>
          </div>
      </div>
      <table class="table table-striped table-hover table-responsive">
          <thead>
            <tr>
                    <th>API</th>
                    <th>总PV</th>
                    <th>qps</th>
                    <th>平均占用内存</th>
                    <th>平均响应时间</th>
                    <th>占用总内存</th>
            </tr>
          </thead>
          <tbody>
              <?php  $_smarty_tpl->tpl_vars['list'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['list']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['smartLog1']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['list']->key => $_smarty_tpl->tpl_vars['list']->value) {
$_smarty_tpl->tpl_vars['list']->_loop = true;
?>
              <tr>
                    <td><?php echo $_smarty_tpl->tpl_vars['list']->value['api'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['list']->value['pv'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['list']->value['qps'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['list']->value['mem'];?>
M</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['list']->value['time'];?>
ms</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['list']->value['allmem'];?>
G</td>
              </tr>  
              <?php } ?>
          </tbody>
      </table>
    </div>
<div class="panel panel-default">
      <div class="panel-heading">
          日常日志<br/>
          <?php echo $_smarty_tpl->tpl_vars['date2']->value;?>

          <div class="panel-btn">
                  <label class="panel-hid">收起</label>
                  <label class="panel-show">展开</label>
          </div>
      </div>
      <table class="table table-striped table-hover table-responsive">
          <thead>
            <tr>
                    <th>API</th>
                    <th>总PV</th>
                    <th>qps</th>
                    <th>平均占用内存</th>
                    <th>平均响应时间</th>
                    <th>占用总内存</th>
            </tr>
          </thead>
          <tbody>
              <?php  $_smarty_tpl->tpl_vars['list'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['list']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['smartLog2']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['list']->key => $_smarty_tpl->tpl_vars['list']->value) {
$_smarty_tpl->tpl_vars['list']->_loop = true;
?>
              <tr>
                    <td><?php echo $_smarty_tpl->tpl_vars['list']->value['api'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['list']->value['pv'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['list']->value['qps'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['list']->value['mem'];?>
M</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['list']->value['time'];?>
ms</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['list']->value['allmem'];?>
G</td>
              </tr>  
              <?php } ?>
          </tbody>
      </table>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">
          日常日志<br/>
          <?php echo $_smarty_tpl->tpl_vars['date3']->value;?>

          <div class="panel-btn">
                  <label class="panel-hid">收起</label>
                  <label class="panel-show">展开</label>
          </div>
      </div>
      <table class="table table-striped table-hover table-responsive">
          <thead>
            <tr>
                    <th>API</th>
                    <th>总PV</th>
                    <th>qps</th>
                    <th>平均占用内存</th>
                    <th>平均响应时间</th>
                    <th>占用总内存</th>
            </tr>
          </thead>
          <tbody>
              <?php  $_smarty_tpl->tpl_vars['list'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['list']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['smartLog3']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['list']->key => $_smarty_tpl->tpl_vars['list']->value) {
$_smarty_tpl->tpl_vars['list']->_loop = true;
?>
              <tr>
                    <td><?php echo $_smarty_tpl->tpl_vars['list']->value['api'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['list']->value['pv'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['list']->value['qps'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['list']->value['mem'];?>
M</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['list']->value['time'];?>
ms</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['list']->value['allmem'];?>
G</td>
              </tr>  
              <?php } ?>
          </tbody>
      </table>
    </div>
    
</div>
<script type="text/javascript">
$('.panel-hid').click(function(e){
      $(this).parent().find('.panel-show').show();
      $(this).hide();
      $(this).parent().parent().parent().find('table').stop().hide(500);
})
$('.panel-show').click(function(e){
      $(this).parent().find('.panel-hid').show();
      $(this).hide();
      $(this).parent().parent().parent().find('table').stop().show(500);
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
