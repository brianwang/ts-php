<?php /* Smarty version Smarty-3.1.11, created on 2012-10-18 09:07:54
         compiled from "/home/brian/www/codesgist/app/views/header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:19617792165080295aacb317-24878516%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '394ccb1058546aceb818e4841785f5e4c50b1956' => 
    array (
      0 => '/home/brian/www/codesgist/app/views/header.tpl',
      1 => 1348716215,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19617792165080295aacb317-24878516',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5080295ab37876_48147333',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5080295ab37876_48147333')) {function content_5080295ab37876_48147333($_smarty_tpl) {?><div style="height:50px;" id="header">
    <h2>CodesGist-您的在线代码助手</h2>
</div>
<div class="row">
    <div id="main-header">
        <ul class="nav nav-tabs pull-right">
            <li><a href="<?php echo site_url('/');?>
">代码提交</a></li>
            <li><a href="<?php echo site_url('/pages/code');?>
">代码库</a></li>
            <li><a href="<?php echo site_url('/pages/api');?>
">API</a></li>
            <li><a href="<?php echo site_url('/pages/help');?>
">帮助</a></li>
        </ul>
    </div>
</div><?php }} ?>