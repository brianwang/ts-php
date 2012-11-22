{extends file="layout.tpl"}
{block name=title}Code{/block}
{block name=script}
{literal}
    prettyPrint();
    $('#btn_submitcomment').click(function(){
            $('#frm-comment').ajaxSubmit({
                    success:function(data){
                        
                    }
            });
    });
{/literal}
{/block}
{block name=body}
<div class="span11">
    <h3 style="font-size:16px;">
        {__('The url of code')}:<a href="{$code.url}">{$code.url}</a>
        <a href="#">{__('Copy')}</a>
    </h3>
    <center style="margin: 20px 0 20px 0;">{$code.description} </center>
        <ul class="nav nav-tabs pull-right">
            <li><a href="#">修改</a></li>
            <li><a href="#">复制代码内容</a></li>
            <li><a href="#">打印</a></li>
        </ul>
    <pre class="prettyprint"><code class="language-java">{$code.code|escape}</code>
    </pre>
    <div class="row">
        <div class="span8">
        {include file="partial/rate.tpl" l=$code}
        </div>
        <div class="span2 pull-right">
        <a href="#" class="btn btn-primary btn-large" 
        onclick="
            {literal}
            if(!$('#comment').is(':visible')){
                $('#comment').show();
                $('#comment').focus();
            }else{
                $('#comment').hide();
            }
                return false;
        {/literal}
    ">留言</a>
    </div>
   </div>
    <hr>
    <div id="comment" class="hide">
    <form action="{site_url('code/comment')}" method="POST" id="frm-comment">
        <textarea placeholder="留言" rows=4 style="width:100%;" name="comment"></textarea>
        <div>
            <button class="btn btn-primary" id="btn_submitcomment">提交</button>
        </div>
    </form>
     </div>
    <div id="comments">
         <div class="row">
            <div class="span2">
                <a href="{literal}{site_url('user/'.$uid)}{/literal}"><img src=''/></a>
            </div>
            <div class="span10">
                {literal}${comment}{/literal}
            </div>
       </div>
    </div>
</div>
    <script id="tmp-comment" type="tmp/javascript">
        <div class="row">
            <div class="span2">
                <a href="{literal}{site_url('user/'.$uid)}{/literal}">
                    <img src='http://placehold.org/200x100'></img></a>
            </div>
            <div class="span10">
                {literal}${comment}{/literal}
            </div>
       </div>
    </script>
{/block}
