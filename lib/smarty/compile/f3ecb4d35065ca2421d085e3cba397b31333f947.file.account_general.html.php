<?php /* Smarty version Smarty-3.1.18, created on 2014-11-20 11:39:26
         compiled from "/home/andy/wifi/wifi-manage/templates/account_general.html" */ ?>
<?php /*%%SmartyHeaderCode:113337287654322957498106-94001981%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f3ecb4d35065ca2421d085e3cba397b31333f947' => 
    array (
      0 => '/home/andy/wifi/wifi-manage/templates/account_general.html',
      1 => 1412573283,
      2 => 'file',
    ),
    '0fa9beb3c073e07c609871848e830917894ad01d' => 
    array (
      0 => '/home/andy/wifi/wifi-manage/templates/master/master.html',
      1 => 1416419381,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '113337287654322957498106-94001981',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_54322957504bc2_84969913',
  'variables' => 
  array (
    'main_nav' => 0,
    'sub_nav' => 0,
    'mangerName' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54322957504bc2_84969913')) {function content_54322957504bc2_84969913($_smarty_tpl) {?><!DOCTYPE html>
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
          常规帐号
          <div class="dropdown" style="float: right;">
              <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
              排列方式
              <span class="caret"></span>
              </button>
              <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                  <li <?php if ($_smarty_tpl->tpl_vars['o']->value==1) {?>class="active" <?php }?>role="presentation"><a role="menuitem" href="/account?<?php echo searchParameterHandle(array('add'=>"o=1",'remove'=>'p'),$_smarty_tpl);?>
">按剩余时长排序</a></li>
                  <li <?php if ($_smarty_tpl->tpl_vars['o']->value==2) {?>class="active" <?php }?>role="presentation"><a role="menuitem" href="/account?<?php echo searchParameterHandle(array('add'=>"o=2",'remove'=>'p'),$_smarty_tpl);?>
">按剩余流量排序</a></li>
                  <li <?php if ($_smarty_tpl->tpl_vars['o']->value==3) {?>class="active" <?php }?>role="presentation"><a role="menuitem" href="/account?<?php echo searchParameterHandle(array('add'=>"o=3",'remove'=>'p'),$_smarty_tpl);?>
">按下发数排序</a></li>
              </ul>
          </div>
          <div class="dropdown" style="float: right;margin-right:20px;">
              <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
              过滤
              <span class="caret"></span>
              </button>
              <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                  <li <?php if ($_smarty_tpl->tpl_vars['f']->value==1) {?>class="active" <?php }?>role="presentation"><a role="menuitem" href="/account?<?php echo searchParameterHandle(array('add'=>"f=1",'remove'=>'p,o'),$_smarty_tpl);?>
">只显示不可用</a></li>
                  <li <?php if ($_smarty_tpl->tpl_vars['f']->value==2) {?>class="active" <?php }?>role="presentation"><a role="menuitem" href="/account?<?php echo searchParameterHandle(array('add'=>"f=2",'remove'=>'p,o'),$_smarty_tpl);?>
">只显示CMCC</a></li>
                  <li <?php if ($_smarty_tpl->tpl_vars['f']->value==3) {?>class="active" <?php }?>role="presentation"><a role="menuitem" href="/account?<?php echo searchParameterHandle(array('add'=>"f=3",'remove'=>'p,o'),$_smarty_tpl);?>
">只显示chinanet</a></li>
              </ul>
          </div>
          <div style="clear:both"></div>
      </div>

      <table class="table table-striped table-hover table-responsive">
          <thead>
            <tr>
                    <th><input type="checkbox"></th>
                    <th>帐号</th>
                    <th>营运商</th>
                    <th>已下发数</th>
                    <th>总时长</th>
                    <th>剩余时长</th>
                    <th>总流量</th>
                    <th>剩余流量</th>
                    <th>是否可用</th>
            </tr>
          </thead>
          <tbody>
              <tr>
                    <td><input type="checkbox"></td>
                    <td>14716415731</td>
                    <td>cmcc</td>
                    <td>10</td>
                    <td>20:00:00</td>
                    <td>50G</td>
                    <td>20:00:00</td>
                    <td>50G</td>
                    <td>是</td>
              </tr>
          </tbody>
      </table>
    </div>
    <ul class="pagination pagination-lg" style="float: right;margin-top:0px">
      <?php echo $_smarty_tpl->tpl_vars['pageStr']->value;?>

    </ul>
    
</div>

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
