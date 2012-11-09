{extends file="layout.tpl"}
{block name=title}Cache管理{/block}
{block name=body}
<form action="{site_url('/service/clearcache')}">
<button class="btn btn-primary">清空缓存</button>
</form>
{/block}