 {foreach from=$codes item=c}
<div class="snipt">
   {include file='partial/code-content.tpl'}
    <div class="span2 copytool">
        <aside>
            <ul class="options">
                <li>
                    <a href="#" class="embed" onclick="
                                        var m = $('#modal-{$c._id}');
                                        m.mouseup(function() {
                                        // Prevent further mouseup intervention
                                        $(this).unbind('mouseup');
                                        return false;
                                    });
                                    m.modal();
                                    m.find('textarea').focus().select();
                                    return false;">{__("Embed")}</a>
                </li>
                <li>
                    <a href="#" class="copy" 
                       onclick="
                                       var m = $('#modal-code{$c._id}');
                                       m.mouseup(function() {
                                       // Prevent further mouseup intervention
                                       $(this).unbind('mouseup');
                                       return false;
                                   });
                                   m.modal();
                                   m.find('textarea').focus().select();
                                   return false;
                                   
                       ">{__("Copy")}</a>
                </li>
            </ul>
        </aside>
    </div>
    <div style="clear:both;"></div>
    <div class="modal hide" id="modal-{$c._id}">
        <div class="modal-header">请复制下列内容添加到您的网页中
            <button data-dismiss="modal" class="close" type="button">×</button>
        </div>

        <div class="modal-body">
            <textarea style="width: 100%; "><script type="text/javascript" src="{site_url('/code/script/'|cat: $c._id)}"></script></textarea>
        </div>
        <div class="modal-footer">
            <!--button class="btn btn-primary" onclick="copyIntoClipboard($(this).parent().parent().find('textarea').text()); return false;">复制</button-->
            <button class="btn btn-primary" data-dismiss="modal" >关闭</button>
        </div>
    </div>
    <div class="modal hide" id="modal-code{$c._id}">
        <div class="modal-header">请复制下列内容
            <button data-dismiss="modal" class="close" type="button">×</button>
        </div>

        <div class="modal-body">
            <textarea style="width: 100%; height: 350px;">{$c.code}</textarea>
        </div>
        <div class="modal-footer">
            <!--button class="btn btn-primary" onclick="copyIntoClipboard($(this).parent().parent().find('textarea').text()); return false;">复制</button-->
            <button class="btn btn-primary" data-dismiss="modal" >关闭</button>
        </div>
    </div>
</div>
{/foreach}