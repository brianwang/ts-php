{extends file="layout.tpl"}
{block name=title}{__('Code')}{/block}
{block name=body}
<div class="row">
    <div class="row-fluid">
        <div class="span2">
            <h3>分类</h3>
            <ul class="nav nav-stacked">
                {foreach from=cache('langs') item=l}
                    <li><a href="{site_url('/code/tag/')}{substr($l, 0, stripos($l, '('))}">{substr($l, 0, stripos($l, '('))}</a></li>
                {/foreach}
            </ul>
        </div>
        <div class="span10">
            <ul class="breadcrumb">
                <li><a href="/">Home</a> <span class="divider">/</span></li>
                <li class="active">{__('Code')}</li>
            </ul>
            {foreach from=$codes item=c}
                <div class="snipt">
                    <div class="span7">
                        <header>
                            <h2><a href="{site_url('/code/tag/'|cat: $c.language)}">{$c.language}</a></h2>
                            <h1><a href="{site_url('/code/get')}/{$c._id}" style="float:left;">{$c.description}</a></h1>
                            <span style="float:right;margin-right:  10px;">分值:{$c.rank|default: 0}</span>
                        </header>
                        <div style="clear:both;"></div>
                        <div>
                            <pre style="height:150px;"><code>{$c.code|escape}</code></pre>
                            <a href="#" class="expand">
                                <span class="expand">Expand</span>
                                <span class="collapse">Collapse</span>
                                <span class="lines">(23 lines)</span>
                            </a>
                        </div>
                        <div style="padding: 10px;">
                            <span>共{mb_strlen($c.code)}个字符</span>
                            <span><a href="#">留言</a></span>
                            <span><a href="#">收藏</a></span>
                        </div>
                    </div>
                    <div class="span2">
                        <aside>
                            <ul class="options">
                                <li>
                                    <a href="#" class="embed">Embed</a>
                                </li>
                                <li>
                                    <a href="#" class="copy">Copy</a>
                                </li>
                            </ul>
                        </aside>
                    </div>
                            <div style="clear:both;"></div>
                </div>
            {/foreach}
        </div>
    </div>
</div>
{/block}