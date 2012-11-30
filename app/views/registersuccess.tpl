{extends file="layout.tpl"}
{block name=title}Code{/block}
{block name=script}
{literal}

{/literal}
{/block}
{block name=body}
<div class="row">
    <h2>欢迎您来到codesgist.com，</h2>
        <div class="success">注册成功，请到您的邮箱去验证。</div>
        <a class="btn btn-primary" href="{$email}">前往邮箱</a>
    </div>
{/block}
