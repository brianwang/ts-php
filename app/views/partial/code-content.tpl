 <div class="span7">
        <header>
            <h2><a href="{site_url('/code/tag/'|cat: $c.language)}">{$c.language}</a></h2>
            <h1><a href="{site_url('/code/get')}/{$c._id}" style="float:left;">{$c.description}</a></h1>
            <span style="float:right;margin-right:  10px;">分值:{$c.rank|default: 0}</span>
        </header>
        <div id="url">
            {$url = site_url("/code/get/"|cat: $c._id)}
            <a href="{$url}">{$url}</a>
            <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000"
                    width="110"
                    height="14" 
                    id="clippy" >
                <param name="movie" value="/public/clippy.swf"/>
                <param name="allowScriptAccess" value="always" />
                <param name="quality" value="high" />
                <param name="scale" value="noscale" />
                <param name="wmode" value="transparent" />
                <param name="FlashVars" value="{$url}">
                <embed src="/public/clippy.swf"
                       width="110"
                       height="14"
                       name="clippy"
                       quality="high"
                       allowScriptAccess="always"
                       type="application/x-shockwave-flash"
                       pluginspage="http://www.macromedia.com/go/getflashplayer"
                       FlashVars="text={$url}&copyto=&copiedText="
                       wmode="transparent"
                       />
            </object>
        </div>
        <div style="clear:both;"></div>
        <div>
            <pre><code>{$c.code|escape}</code></pre>
            <a href="javascript:;" class="expand" onclick="
                var co = $(this).parent().find('pre');
                var expand= $(this).find('.expand');
                var collaps = $(this).find('.collapse');
                if(expand.is(':visible')){
                    co.animate({
                              'height': '100%'
                    }, {
                            duration: 'fast'
                    });
                        collaps.show();
                        expand.hide();
                }
                else{
                    co.animate({
                              'height': '150px'
                    }, {
                            duration: 'fast'
                    });
                    collaps.hide();
                    expand.show();
                }
                      ">
                <span class="expand">{__('Expand')}</span>
                <span class="collapse hide">{__('Collapse')}</span>
                <span class="lines">({__('lines',["\n"|explode: $c.code|count])})</span>
            </a>
        </div>
        <div style="padding: 10px;">
            <span>共{mb_strlen($c.code)}个字符</span>
            <span><a href="#" onclick="
                $('#modal-comments').find('input[name=cid]').val('{$c._id}');
                 $('#modal-comments').modal();
                 return false;
                 ">留言</a></span>
            <span><a href="#">收藏</a></span>
        </div>
    </div>