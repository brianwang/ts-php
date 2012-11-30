{extends file="layout.tpl"}
{block name=title}Code{/block}
{block name=script}
{literal}

{/literal}
{/block}
{block name=body}
<div class="row">
        <div class="success">重置密码成功，请重新登录</div>
        <button class="btn btn-primary" onclick="window.location='/';return false;">返回首页</button>
    </div>
{/block}
