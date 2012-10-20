<?php /* Smarty version Smarty-3.1.11, created on 2012-10-19 21:28:44
         compiled from "/home/brian/www/codesgist/app/views/code.tpl" */ ?>
<?php /*%%SmartyHeaderCode:13496596835082287c660940-13834382%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2d2a88096fb05fd61f1269cdbd23fa2a12bc4066' => 
    array (
      0 => '/home/brian/www/codesgist/app/views/code.tpl',
      1 => 1348678850,
      2 => 'file',
    ),
    'c3b8e6dd64b6f3a062ec82ee567200b4738ecc3e' => 
    array (
      0 => '/home/brian/www/codesgist/app/views/layout.tpl',
      1 => 1350701734,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13496596835082287c660940-13834382',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5082287c884970_82025574',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5082287c884970_82025574')) {function content_5082287c884970_82025574($_smarty_tpl) {?><!DOCTYPE html>
<html>
    <head>
        <title>Code</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <LINK REL="icon" type="image/gif" href="<?php echo assert_url('/si.gif');?>
">
        <link rel="stylesheet" href="<?php echo assert_url('/css/bootstrap.css');?>
">
        <link rel="stylesheet" href="<?php echo assert_url('/css/bootstrap-notify.css');?>
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

            
<div class="row">
    <div class="row offset2">
        <input type="text" name="search">
        <button class="btn btn-primary">搜索</button>
    </div>
    <hr>
    <div class="row">
        <div class="row-fluid">
            <div class="span2">
                <h3>分类</h3>
                <ul class="nav nav-stacked">
                    <li><a href="#">C++</a></li>
                </ul>
            </div>
            <div class="span8">
                <div>
                    <div>
                        该段代码链接：<a href="#">http://ww.codesgist.com/code/1233213</a>
                        <div>
                            <h2>计算加和</h2>
                            <span>共多少个字符</span>
                            <a href="#">*****</a>
                        </div>
                        <div>
                            <a href="#">给作者留言</a>
                            <a href="#">加入自己的代码库</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="span2">
                右边
            </div>
        </div>
    </div>

</div>

            <?php echo $_smarty_tpl->getSubTemplate ('footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

        </div>
        <div class="progress progress-striped active hide" id="loading" 
             style="position:fixed;top:45%; left:45%;width: 200px; z-index:2000;">
            <div class="bar" style="width: 100%; "></div>
        </div>
        <div class="alerts" id="notify" style="display:none;">
            <div class="alert-message">
                <a class="close" href="#">×</a>
                <div id="notify-content"></div>
            </div>
        </div>
        <div class='notifications top-right'></div>
        <script>
            
                 $(function(){
                     $.ajaxSetup({
                            error: function(jqXHR, exception) {
                                    if (jqXHR.status === 0) {
                                            message ='Not connect.\n Verify Network.';
                                    } else if (jqXHR.status == 404) {
                                            message ='Requested page not found. [404]';
                                    } else if (jqXHR.status == 500) {
                                            message ='Internal Server Error [500].';
                                    } else if (exception === 'parsererror') {
                                            message ='Requested JSON parse failed.';
                                    }else if (exception === 'timeout') {
                                            message ='Time out error.';
                                    } else if (exception === 'abort') {
                                            message ='Ajax request aborted.';
                                    } else {
                                            message ='Uncaught Error.\n' + jqXHR.responseText;
                                    }
                                        var r = JSON.parse(jqXHR.responseText);
                                          if(r.message !=undefined || r.message != ''){
                                              message = r.result;
                                         }
                                    $('#notify-content').text(message);
                                    $('.alert-message').addClass('error');
                                    $('#notify').fadeIn().fadeOut(2500);
                            }
            });
            
            
            
                 
                }).ajaxStart(function(){$('#loading').show();})
                  .ajaxStop(function(){$('#loading').delay(5000).hide();})
                  .ajaxSuccess(function(event,xhr,option){
                                $('#loading').delay(5000).hide();
                                if(event != undefined && event.result !=undefined){
                                    $('#notify-content').text(event.message);
                                    $('.alert-message').addClass('success');
                                    $('#notify').fadeIn().fadeOut(1500);
                                }
                            }
);
            
        
        </script>
    </body>
</html><?php }} ?>