{extends file="layout.tpl"}
{block name=title}Code{/block}
{block name=body}
<div class="row">
    <div><a href="{$url}">{$url}</a></div>
    <h2>{$code.code}</h2>
    <p>
    <pre><code>
            {$code.description}
    </code></pre>
</p>
</div>
{/block}
