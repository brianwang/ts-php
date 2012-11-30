{extends file="layout.tpl"}
{block name=title}Code{/block}
{block name=script}
{literal}
$('#frm-forgetpass').validate({
    rules: { email:{required:true, email:true}},
    messages:{email:{required: "need email"}}
});
{/literal}
{/block}
{block name=body}
<div class="row">
    <form action="{site_url('/user/resetpassword')}" method="POST" id="frm-forgetpass">
        <input type="text"  name="email" placeholder="{__('please input your email')}">
        <button class="btn btn-primary">{__('reset')}</button>
    </form>
    </div>
{/block}
