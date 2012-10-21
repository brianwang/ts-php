<?php /* Smarty version Smarty-3.1.11, created on 2012-10-20 23:28:23
         compiled from "/home/brian/www/codesgist/app/views/viewcode.tpl" */ ?>
<?php /*%%SmartyHeaderCode:162987290250839607294ef3-62032348%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '01de7d29c393e926d8cd43dd87bb5a399da82b75' => 
    array (
      0 => '/home/brian/www/codesgist/app/views/viewcode.tpl',
      1 => 1350743073,
      2 => 'file',
    ),
    'c3b8e6dd64b6f3a062ec82ee567200b4738ecc3e' => 
    array (
      0 => '/home/brian/www/codesgist/app/views/layout.tpl',
      1 => 1350701734,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '162987290250839607294ef3-62032348',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5083960754c8f6_12859225',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5083960754c8f6_12859225')) {function content_5083960754c8f6_12859225($_smarty_tpl) {?><!DOCTYPE html>
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
    <div><a href="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['url']->value;?>
</a></div>
    <h2><?php echo $_smarty_tpl->tpl_vars['code']->value['code'];?>
</h2>
    <p>
    <pre><code>
            <?php echo $_smarty_tpl->tpl_vars['code']->value['description'];?>

    </code></pre>
</p>
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