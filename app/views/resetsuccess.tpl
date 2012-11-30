{extends file="layout.tpl"}
{block name=title}Code{/block}
{block name=script}
{literal}
$('#frm-resetpass').validate({
    rules:{
        email: {required:true, email:true}
        pasword: {required:true},
        c_password:{required:true, equalTo: password}
    }
})
{/literal}
{/block}
{block name=body}
<div class="row">
    <h2>重置密码</h2>
        <form action="{site_url('/user/save')}" method="POST" id="frm-save">
        <input type="text" name="email" value="{$email}">
        <input type="password" name="password">
        <input type="password" name="c_password">
        <button class="btn btn-primary" >重置密码</button>
        </form>
    </div>
{/block}
