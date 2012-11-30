{extends file="layout.tpl"}
{block name=title}Code{/block}
{block name=script}
{literal}

{/literal}
{/block}
{block name=body}
<div class="row">
    <h2>欢迎您来到codesgist.com</h2>
        <div class="success">验证成功！</div>
        <button class="btn btn-primary" onclick="window.location='/';return false;">返回首页</button>
    </div>
{/block}
