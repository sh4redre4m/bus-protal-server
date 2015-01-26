<?php /* Smarty version Smarty-3.1.18, created on 2015-01-21 15:41:35
         compiled from "/home/andy/chebao/bus-protal-server/templates/login.html" */ ?>
<?php /*%%SmartyHeaderCode:151079787054bf582f951192-03524179%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b50dca17a1eb7ebf25efe833337623718bed23df' => 
    array (
      0 => '/home/andy/chebao/bus-protal-server/templates/login.html',
      1 => 1419863823,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '151079787054bf582f951192-03524179',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_54bf582f9b9d22_57198888',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54bf582f9b9d22_57198888')) {function content_54bf582f9b9d22_57198888($_smarty_tpl) {?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<title>wifi manage login</title>
<link href="/css/bootstrap.min.css" rel="stylesheet">
<script type="text/javascript" src="/js/jquery.min.js"></script>
<script type="text/javascript" src="/js/bootstrap.min.js"></script>
<style type="text/css">
body {
  padding-top: 40px;
  padding-bottom: 40px;
  background-color: #eee;
}

.form-signin {
  width: 330px;
  padding: 15px;
  margin: 0 auto;
}
.form-signin .form-signin-heading,
.form-signin .checkbox {
  margin-bottom: 10px;
}
.form-signin .checkbox {
  font-weight: normal;
}
.form-signin .form-control {
  position: relative;
  height: auto;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
  padding: 10px;
  font-size: 16px;
}
.form-signin .form-control:focus {
  z-index: 2;
}
.form-signin input[type="email"] {
  margin-bottom: 3px;
}
.form-signin input[type="password"] {
  margin-bottom: 3px;
}
.form-signin input[type="text"] {
  margin-bottom: 10px;
  width: 28%;
  float: left;
}
#yan{
  float: left;
  width: 150px;
  border-radius: 4px;
  margin-left: 5px;
  margin-top: 3px;
}
.chang_yan a{
  display: inline-block;
  color: #000;
  font-size: 12px;
  font-weight: normal;
  margin: 24px auto auto 10px;
}
.dropdown{
   margin-bottom: 10px;
}
</style>

</head>
<body>

<div class="container">
    <form class="form-signin" role="form">
        <h2 class="form-signin-heading">WI-FI Manage 登录</h2>
        <div class="dropdown">
          <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
            选择要管理的系统
            <span class="caret"></span>
          </button>
          <ul class="dropdown-menu" id="select_dropmenu" role="menu" aria-labelledby="dropdownMenu1">
            <li role="presentation" dbval="live"><a role="menuitem" tabindex="-1" href="javascript:void(0)">生产</a></li>
            <li role="presentation" dbval="test"><a role="menuitem" tabindex="-1" href="javascript:void(0)">测试1</a></li>
            <li role="presentation" dbval="staging1"><a role="menuitem" tabindex="-1" href="javascript:void(0)">staging1</a></li>
            <li role="presentation" dbval="staging2"><a role="menuitem" tabindex="-1" href="javascript:void(0)">staging2</a></li>
            <li role="presentation" dbval="andy"><a role="menuitem" tabindex="-1" href="javascript:void(0)">andy</a></li>
          </ul>
        </div>
        <input id="email" autocomplete="off" type="email" auto class="form-control"  placeholder="邮件地址" required autofocus>
        <input id="pw" autocomplete="off" type="password" class="form-control" placeholder="密码" required>
        <input  id="code" autocomplete="off" type="text" class="form-control" placeholder="验证码" required>
        <img id="yan" src="/yan.php" alt="" />
        <label class="chang_yan"><a href="javascript:changeyan()" >换一张</a></label>
        <button class="btn btn-lg btn-primary btn-block" type="submit">登录</button>
    </form>
</div>
</body>

<script type="text/javascript">
function changeyan(){
      $('#yan').get(0).src = '/yan.php?r='+new Date().getTime();
      $('#code').val('');
}
$('.form-signin').submit(function(e){
        var e_val = $('#email').val();
        var pw_val = $('#pw').val();
        var yan_val = $('#code').val();
        if(db_type == null){
                changeyan();
                var error_msg = '先选择系统';
                $('.alert-warning').remove();
                $('.form-signin-heading').after('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button><strong>Error!</strong> '+error_msg+'</div>');
        }
        $.post('/ajax/checkuser?rand='+new Date().getTime(),{
            'yan':yan_val,
            'email':e_val,
            'pw':pw_val,
            'db_type':db_type
        },function(json){
            if(json.result==0){
                window.location.href =  window.location.href
            }else{
                if(json.error==1){
                    var error_msg = '验证码错误';
                }else{
                  var error_msg = 'Email 或 密码错误';
                }
                changeyan();
                $('.alert-warning').remove();
                $('.form-signin-heading').after('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button><strong>Error!</strong> '+error_msg+'</div>');
            }
        });

        e.preventDefault();
        return false;
})
var db_type = null;
$("#select_dropmenu").find('li').click(function(e){
  $("#dropdownMenu1").html($(this).text()+'<span class="caret"></span>');
  db_type = $(this).attr('dbval');

})
</script>
</html>



<?php }} ?>
