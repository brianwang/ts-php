{extends file="layout.tpl"}
{block name=title}首页{/block}
{block name=script}{literal}
    $('#frm-login').validate({
    rules: {email: {required: true,email:true}},
    messages:{email: {required: "请输入邮箱",email:"邮箱格式不正确"}}
    });
    $('#frm-code').validate({
    rules: {description: {required: true},code:{required: true}},
    messages:{
    description: {required: "请输入代码描述"},
    code: {required: "请输入代码"}
    },
    highlight: function(element, errorClass, validClass) {
    $(element).addClass('error');
    },
    unhighlight: function(element, errorClass) {
    $(element).removeClass('error');
    },
    errorPlacement: function(error, element) {
        element.focus();
        element.attr('placeholder',error.text());
    }
    });
    $('textarea[name=code]').keyup(function(e){
        var text =$('.editor').val();
        $('#preview').text(text);
        prettyPrint();
    });
    $('#btn-savecode').click(function(e){
        if($('#frm-code').valid() ==true){
            $('#frm-code').ajaxSubmit({
            success:function(data,xhr,option){
        }
    });
    }
    });
{/literal}{/block}
{block name=body}
<div class="row" id="content">
    <div class="span8">
        
        <form action="{site_url('/code/save')}" method="POST" id="frm-code" class="form-horizontal">
            <div class="row-fluid">
                <div class="span5">
                    <select name="language" SIZE=19>
                        {foreach $langs as $key=>$lang}
                            <option value="{$key}" {if $key == 62 }selected="selected"{/if}>{$lang}</option>
                        {/foreach}
                    </select>
                </div>
                <div class="span7">
                    <div class="control-group">
                        <input type="text" name="description" placeholder="描述" style="width:100%;">
                    </div>
                    <textarea name="code" rows="15"  placeholder="您的代码 " style="width:100%;" class="editor"></textarea>
                </div>
            </div>
            <h2>{__('Preview')}</h2>
            <pre class="prettyprint" id="preview"><code class="language-java">
                    <br/><br/><br/>
                </code></pre>
            <div style="width:400px;float:left;">
                <div style="margin:10px 0 10px 0;">
                    <span style="width:100px;float:left;line-height: 24px;">{__('duration')}</span>
                    <select name="duration">
                        <option value=1>{__('days',[1])}</option>
                        <option value=3>{__('days',[3])}</option>
                    </select>
                </div>
                <div style="margin:10px 0 10px 0;" >
                    <span style="width:100px;float:left;line-height: 24px;">{__('public')}</span>
                    <select name="public">
                        <option value="true">{__('public')}</option>
                        <option value="false">{__('private')}</option>
                    </select>
                </div>
            </div>
            <div style="width:200px;float:left;">
                <button type="button" class="btn btn-primary" style="width: 150px;height:54px;" id="btn-savecode">提交代码</button>
            </div>
        </form>
        <hr style="clear:both;">
    </div>
    <div class="span3">
        {if !isset($smarty.session.user)}
        <div id="login" class="tab-pane active">
            <form action="{site_url('/user/login')}" id="frm-login" method="POST">
                <div class="control-group">
                    <input type="text" name="email" placeholder="{__('email')}">
                    <input type="password" name="password" placeholder="{__('password')}">
                </div>
                <div class="control-group">
                    <button class="btn btn-primary" >{__('Login/register')}</button>
                    <button class="btn btn-info" type="button" 
                            onclick="
                                window.location='{site_url('/user/forgetpassword')}';
                                return false;">{__('Forget password?')}</button>
                </div>
            </form>
        </div>
                {else}
             <div id="login">
                    Welcome, {$smarty.session.user.email}
                    <button class="btn btn-primary" onclick="window.location='user/logout';return false;">{__('logout')}</button>
            </div>
         {/if}
        <hr>
        <div>
            <h3>目前有{$codecount} 段代码</h3>
            <h3>有{$usercount} 注册用户</h3>
            <h3>有{$useronline}人同时在线</h3>
        </div>
        <hr>
        <div>
            <h2>{__('Latest')}</h2>
            {foreach from=$codes item=c}
                <div style="margin-bottom: 10px;line-height: 24px;">
                    <a href="{site_url('/code/get/')}{$c._id}">{$c.description}</a>
                    <span style="float:right">{$c.createtime|date_format:"%Y-%m-%d"}</span>
                </div>
            {/foreach}
        </div><hr>
        <div>
            <h2> {__('Category')}</h2>
            <ul class="nav nav-pills" style="font-size:24px;">
                {foreach from=$tags item=t}
                    <li><a href="{site_url('/code/tag/')}{$t.language}">{$t.language}({$t.count})</a></li>
                {/foreach}
            </ul>
        </div><hr>
        <div>
            <h2>{__('Top')}</h2>
            {foreach from=$greatcodes item=c}
                <div style="margin-bottom: 10px;line-height: 24px;">
                    <a href="{site_url('/code/get')}{$c._id}">{$c.description}</a>
                    <span style="float:right">{$c.createtime|date_format:"%Y-%m-%d"}</span>
                </div>
            {/foreach}
        </div>
    </div>
</div>
{/block}

