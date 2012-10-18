{extends file="layout.tpl"}
{block name=title}首页{/block}
{block name=script}{literal}
$(function(){
    $('#btn-savecode').click(function(){
        $('#frm-code').ajaxSubmit();
    });
});
{/literal}{/block}
{block name=body}
<div class="row" id="content">
    <div class="row-fluid">
        <div class="span7">
            <form action="{site_url('/code/save')}" method="POST" id="frm-code">
                <input type="text" name="description" placeholder="描述" style="width:500px;">
                <textarea name="code" rows="14" style="width:500px;" placeholder="您的代码 "></textarea>
                <input type="text" name="guestname" placeholder="您的名字" style="width:500px;">
                <div class="control-group ">
                    <label class="control-label help-inline">{__('language')}:</label>
                    <select name="language">
                        <option>TEXT</option>
                        <option>PHP</option>
                        <option>JAVASCRIPT</option>
                        <option>C++</option>
                        <option>JAVA</option>
                    </select>
                    </div>
                    <div class="control-group">
                    <label class="control-label help-inline">{__('duration')}</label>
                    <select name="public">
                        <option>1days</option>
                        <option>Private</option>
                    </select>
                    </div>
                    <div class="control-group">
                    <label class="control-label help-inline">{__('public')}</label>
                    <select name="public">
                        <option>{__('public')}</option>
                        <option>{__('private')}</option>
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
{/block}

