<div style="height:50px;" id="header">
    <h2>Codesgist-您的在线代码助手</h2>
</div>
<div class="row">
    <div id="main-header">
         <input type="text" name="search" placeholder="搜索内容" 
                data-provide="typeahead" class="typeahead"
                style="margin-top:5px;margin-left:20px;width:500px;">
        <ul class="nav nav-pills pull-right" >
            {if $smarty.session.uid|default: false }
            <li><a href="{site_url('/pages/mycode')}">我的代码库</a></li>
            {/if}
            <li><a href="{site_url('/')}">代码提交</a></li>
            <li><a href="{site_url('/pages/code')}">代码库</a></li>
            <li><a href="{site_url('/pages/api')}">API</a></li>
            <li><a href="{site_url('/pages/help')}">帮助</a></li>
        </ul>
    </div>
</div>