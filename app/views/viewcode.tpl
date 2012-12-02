{extends file="layout.tpl"}
{block name=title}Code{/block}
{block name=script}
{literal}
    prettyPrint();
    $('#frm-comment').validate({
        rules: {
            comment: {required: true}
        },
        messages: {
            comment: {required: '没有输入任何comments'}
        }
    });
{/literal}
{/block}
{block name=body}
<div class="span11">
    <h3 style="font-size:16px;">
        {__('The url of code')}:<a href="{$code.url}">{$code.url}</a>
        <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000"
                    width="110"
                    height="14" 
                    id="clippy" >
                <param name="movie" value="/public/clippy.swf"/>
                <param name="allowScriptAccess" value="always" />
                <param name="quality" value="high" />
                <param name="scale" value="noscale" />
                <param name="wmode" value="transparent" />
                <param name="FlashVars" value="{$code.url}">
                <embed src="/public/clippy.swf"
                       width="110"
                       height="14"
                       name="clippy"
                       quality="high"
                       allowScriptAccess="always"
                       type="application/x-shockwave-flash"
                       pluginspage="http://www.macromedia.com/go/getflashplayer"
                       FlashVars="text={$code.url}&copyto=&copiedText="
                       wmode="transparent"
                       />
            </object>
    </h3>
    <hr>
  <h2 style="margin: 20px 0 20px 0;">标题：{$code.description} </h2>
        <ul class="nav nav-tabs pull-right">
            {if $code.creator == $smarty.session.uid|default: NULL}
            <li><a href="javascript:;" onclick="
                if($('.edit').is(':visible')){
                    $('.edit').hide();
                    $(this).text('{__('modify')}');
                }
                else{
                    $('.edit').show();
                    $('.edit').find('textarea').focus();
                    $(this).text('{__('close')}');
                }
                return false;
                ">{__('modify')}</a></li>
                {/if}
            <li><a href="javascript:;" onclick="
        m = $('#modal-code');
         m.mouseup(function() {
                                       // Prevent further mouseup intervention
                                       $(this).unbind('mouseup');
                                       return false;
                                   });
        m.modal();m.find('textarea').focus().select();
        return false;">复制代码内容</a></li>
            <li><a href="javascript:;" onclick="window.print();">打印</a></li>
        </ul>
    <pre class="prettyprint">
        <code class="language-java">{$code.code|escape}</code>
    </pre>
    <div class="edit row hide">
        <form action="{site_url('/code/savecode/')}{$code._id}" method="post">
            <textarea style="width:100%; height: 150px;" name="code">{$code.code|escape}</textarea>
            <div>
            <button class="btn btn-primary">{__('save')}</button>
            <a href="javascript:;" class="btn btn-primary" onclick="$('.edit').hide();return false;">{__('hide')}</a>
            </div>
        </form>
    </div>
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
                window.location.hash = 'comment';
                $('textarea[name=comment]').focus();
            }else{
                $('#comment').hide();
            }
                return false;
        {/literal}
    ">留言</a>
    </div>
   </div>
    <hr>
    <div id="comment" class="hide" style="
         border-bottom: 0.5px  dotted #ddd;
         margin-bottom: 20px;">
    <form action="{site_url('/code/comment')}" method="POST" id="frm-comment">
        <input type="hidden" name="id" value="{$code._id}">
        <textarea placeholder="留言" rows=4 style="width:100%;" name="comment"></textarea>
        <div>
            <button class="btn btn-primary" id="btn_submitcomment">提交</button>
        </div>
    </form>
     </div>
    <div id="comments">
        {if isset($code.comments)}
         {foreach from=$code.comments item=cm}
              <div class="row comment">
            <div class="span1">
                <a href="{$cm.uid|default: ''}">
                    <img src='http://placehold.org/50x50'></a>
            </div>
            <div class="span9">
               <p>{$cm.comment|escape}</p>
            </div>
       </div>
         {/foreach}
         {/if}
    </div>
</div>
         
        <div class="modal hide" id="modal-code">
        <div class="modal-header">请复制下列内容
            <button data-dismiss="modal" class="close" type="button">×</button>
        </div>

        <div class="modal-body">
            <textarea style="width: 100%; height: 350px;">{$code.code}</textarea>
        </div>
        <div class="modal-footer">
            <!--button class="btn btn-primary" onclick="copyIntoClipboard($(this).parent().parent().find('textarea').text()); return false;">复制</button-->
            <button class="btn btn-primary" data-dismiss="modal" >关闭</button>
        </div>
    </div>
{literal}
    <script id="tmp-comment" type="tmp/javascript">
        <div class="row">
            <div class="span2">
                <a href="${url}"><img src='http://placehold.org/200x100'></a>
            </div>
            <div class="span10">
               ${comment}
            </div>
       </div>
    </script>
{/literal}
{/block}
