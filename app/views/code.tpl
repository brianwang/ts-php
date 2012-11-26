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
            <div id="codelist">
               {include file='partial/code-tmpl.tpl' codes=$codes}
            </div>
            <button class="btn" style="width:100%;height: 30px;"
                    onclick="
                        $(this).addClass('loading');
                        window.location = '{site_url("/pages/code/")}{$curpage+1}';
//                        $.get('{site_url("/partial/code/")}#{$curpage+1}',function(data){
//                           $('#codelist').append(data);
//                           window.location.hash = window.location.hash 
//                        });
                        return false;
                     "
                    >{__('NextPage')}</button>
        </div>
    </div>
</div>
{/block}