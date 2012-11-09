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
        <div class="span8">
            {foreach from=$codes item=c}
                <div style="margin-bottom:20px; border-bottom: 1px dotted #0088cc;">

                    <div>
                        <a href="{site_url('/code/get')}/{$c._id}"><h2>{$c.description}</h2></a>
                        <pre><code>{$c.code}</code></pre>
                        <span>共{mb_strlen($c.code)}个字符</span>
                        <span><a href="#">留言</a></span>
                        <span><a href="#">收藏</a></span>
                        <a href="#">*****</a>
                    </div>
                    <div>

                    </div>
                </div>
            {/foreach}
        </div>
        <div class="span2">
            右边
        </div>
    </div>
</div>
{/block}