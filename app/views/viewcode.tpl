{extends file="layout.tpl"}
{block name=title}Code{/block}
{block name=script}
{literal}
    prettyPrint();
{/literal}
{/block}
{block name=body}
<div class="span11">
    <h3 style="font-size:16px;">{__('The url of code')}:<a href="{site_url('/code/get')}/{$code._id}">{site_url('/code/get')}/{$code._id}</a></h3>
    <h3 style="font-size:16px;">标题:{$code.description} </h3>
         <h3>分数：1.0</h3>
        <ul class="nav nav-tabs pull-right">
            <li><a href="#">修改</a></li>
            <li><a href="#">复制代码内容</a></li>
            <li><a href="#">打印</a></li>
        </ul>
    <pre class="prettyprint"><code class="language-java">
            {$code.code}
    </code>
    </pre>
    <div class='movie_choice pull-right'>
            <div class="rate_title">打分</div>
            <div id="{$code._id}" class="rate_widget">
                <div class="star_1 ratings_stars" id="star_1"></div>
                <div class="star_2 ratings_stars" id="star_2"></div>
                <div class="star_3 ratings_stars" id="star_3"></div>
                <div class="star_4 ratings_stars" id="star_4"></div>
                <div class="star_5 ratings_stars" id="star_5"></div>
                <div class="total_votes"></div>
            </div>
     </div>
</div>
<div class="span3">
    <form action="">
        <textarea placeholder="留言" rows=4></textarea>
        <div>
            <button class="btn btn-primary">提交</button>
        </div>
    </form>
</div>
{/block}
