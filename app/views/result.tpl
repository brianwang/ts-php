{extends file="layout.tpl"}
{block name=title}Code{/block}
{block name=body}
<div class="row">
    <div class="row">
        <center>
            <input type="text" name="search">
            <button class="btn btn-primary">搜索</button>
        </center>
    </div>
    <hr>
    <div class="row">
        <div class="row-fluid">
            <div class="span2">
                <h3>分类</h3>
                <ul class="nav nav-stacked">
                    {foreach from=cache('langs') item=l}
                    <li><a href="{site_url('/code/tag/')}/{$l}">{$l}</a></li>
                    {/foreach}
                </ul>
            </div>
            <div class="span8">
                {foreach from=$codes item=c}
                    <div style="margin-bottom:40px;">
                        {__('The url of code')}<a href="{site_url('/code/get')}/{$c._id}">{site_url('/code/get')}/{$c._id}</a>
                        <div>
                            <h2>{$c.description}</h2>
                            <span>共多少个字符</span>
                            <a href="#">*****</a>
                        </div>
                        <div>
                            <a href="#">给作者留言</a>
                            <a href="#">加入自己的代码库</a>
                        </div>
                    </div>
                    {/foreach}
            </div>
            <div class="span2">
                右边
            </div>
        </div>
    </div>
</div>
{/block}
