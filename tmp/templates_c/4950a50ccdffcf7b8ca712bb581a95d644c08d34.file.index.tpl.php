<?php /* Smarty version Smarty-3.1.11, created on 2012-10-18 09:07:54
         compiled from "/home/brian/www/codesgist/app/views/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:15602366745080295a880733-18288904%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4950a50ccdffcf7b8ca712bb581a95d644c08d34' => 
    array (
      0 => '/home/brian/www/codesgist/app/views/index.tpl',
      1 => 1350574823,
      2 => 'file',
    ),
    'c3b8e6dd64b6f3a062ec82ee567200b4738ecc3e' => 
    array (
      0 => '/home/brian/www/codesgist/app/views/layout.tpl',
      1 => 1350575514,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '15602366745080295a880733-18288904',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5080295aabea95_60618798',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5080295aabea95_60618798')) {function content_5080295aabea95_60618798($_smarty_tpl) {?><!DOCTYPE html>
<html>
    <head>
        <title>首页</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <LINK REL="icon" type="image/gif" href="<?php echo assert_url('/si.gif');?>
">
        <link rel="stylesheet" href="<?php echo assert_url('/css/bootstrap.css');?>
">
        <link rel="stylesheet" href="<?php echo assert_url('/css/Style.css');?>
">
        <script src="<?php echo assert_url('/js/jquery1.7.js');?>
" type="text/javascript"></script>
        <script src="<?php echo assert_url('/js/jquery.form.js');?>
" type="text/javascript"></script>
        <script src="<?php echo assert_url('/js/jquery.tmpl.js');?>
" type="text/javascript"></script>

        
    </head>
    <body>
        <div class="container">
            
            <?php echo $_smarty_tpl->getSubTemplate ('header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

            
<div class="row" id="content">
    <div class="row-fluid">
        <div class="span7">
            <form action="<?php echo site_url('/code/save');?>
" method="POST" id="frm-code">
                <input type="text" name="description" placeholder="描述" style="width:500px;">
                <textarea name="code" rows="14" style="width:500px;" placeholder="您的代码 "></textarea>
                <input type="text" name="guestname" placeholder="您的名字" style="width:500px;">
                <div class="control-group ">
                    <label class="control-label help-inline"><?php echo __('language');?>
:</label>
                    <select name="language">
                        <option>TEXT</option>
                        <option>PHP</option>
                        <option>JAVASCRIPT</option>
                        <option>C++</option>
                        <option>JAVA</option>
                    </select>
                    </div>
                    <div class="control-group">
                    <label class="control-label help-inline"><?php echo __('duration');?>
</label>
                    <select name="public">
                        <option>1days</option>
                        <option>Private</option>
                    </select>
                    </div>
                    <div class="control-group">
                    <label class="control-label help-inline"><?php echo __('public');?>
</label>
                    <select name="public">
                        <option><?php echo __('public');?>
</option>
                        <option><?php echo __('private');?>
</option>
                    </select>
                </div>
                <button type="button" class="btn btn-primary" id="btn-savecode">提交代码</button>
                <button type="button" class="btn btn-info">运行代码</button>
            </form>
        </div>
        <div class="span5">
            <div style="margin: 10px 0px 0 0px;">
                <p><button type="button" class="btn">新浪</button>
                <button type="button" class="btn">腾讯帐号</button></p>
                <p><button type="button" class="btn">百度帐号</button>
                <button type="button" class="btn">百度帐号</button>
                </p>
                <p><button type="button" class="btn">Facebook</button>
                <button type="button" class="btn">Twiitter</button>
                </p>
            </div>
            <form action="/user/login">
                <div class="control-group" style="margin-top:15px;">
                    <input type="text" name="username" placeholder="UserName">
                    <input type="password" name="password" placeholder="Password">
                </div>
                <div class="control-group">
                    <button class="btn btn-primary">登录</button>
                    <button class="btn btn-info">忘记密码</button>
                </div>
            </form>
            <h2>1000段代码</h2>
            <h2>500个注册用户</h2>
            <h2>400人在线</h2>
        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="row-fluid">
        <div class="span4">
            <h2>最新更新的代码</h2>
            <div>
                <a href="#">123213123</a>
                <a href="#">C++</a>
                <a href="#">用户1</a>
            </div>
             <div>
                <a href="#">123213123</a>
                <a href="#">C++</a>
                <a href="#">用户1</a>
            </div>
        </div>
        <div class="span4">
            <h2> 代码分类</h2>
            <ul class="nav nav-pills" style="font-size:24px;">
                <li><a href="#">C++(40)</a></li>
                <li><a href="#">C++(50)</a></li>
            </ul>
        </div>
        <div class="span4">
            <h2>评分最高的代码</h2>
            <div>
                <a href="#">123123</a>
                <a href="#">C++</a>
                <a href="#">用户1</a>
            </div>
        </div>
    </div>
</div>

            <?php echo $_smarty_tpl->getSubTemplate ('footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

        </div>
        <script>
$(function(){
    $('#btn-savecode').click(function(){
        $('#frm-code').ajaxSubmit();
    });
});
</script>
    </body>
</html><?php }} ?>