{extends file="layout.tpl"}
{block name=title}Code{/block}
{block name=script}
{literal}

{/literal}
{/block}
{block name=body}
<div class="row">
    <h2>重置密码</h2>
        <form action="{site_url('/user/resetpassword')}">
        <div class="success">重置地址已经发送到您的邮箱，请查收</div>
        <button class="btn btn-primary" onclick="window.location='/';return false;">返回首页</button>
        </form>
    </div>
{/block}
