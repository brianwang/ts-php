{extends file="layout.tpl"}
{block name=title}首页{/block}
{block name=script}{literal}
    $('#btn-savecode').click(function(){
    $('#frm-code').ajaxSubmit({
    success:function(data,xhr,option){
    var lik = "<a href='"+data.result.url+"'>"+data.result.url+"</a>";
    $('#url').html(lik);
    }
    });
    });
     $('.ratings_stars').hover(
            // Handles the mouseover
            function() {
                $(this).prevAll().andSelf().addClass('ratings_over');
                $(this).nextAll().removeClass('ratings_vote'); 
            },
            // Handles the mouseout
            function() {
                $(this).prevAll().andSelf().removeClass('ratings_over');
            }
        );
        
     function set_votes(widget) {
        var avg = $(widget).data('fsr').avg;
        var votes = $(widget).data('fsr').number_votes;
        var exact = $(widget).data('fsr').dec_avg;

        window.console && console.log('and now in set_votes, it thinks the fsr is ' + $(widget).data('fsr').number_votes);

        $(widget).find('.star_' + avg).prevAll().andSelf().addClass('ratings_vote');
        $(widget).find('.star_' + avg).nextAll().removeClass('ratings_vote'); 
        $(widget).find('.total_votes').text( votes + ' votes recorded (' + exact + ' rating)' );
    }
        // This actually records the vote
        $('.ratings_stars').bind('click', function() {
            var star = this;
            var widget = $(this).parent();
            
            var clicked_data = {
                clicked_on : $(star).attr('class'),
                value: $(star).attr('id'),
                id : $(star).parent().attr('id')
            };
            $.post(
            '{/literal}{site_url('/code/vote/')}{literal}',
                clicked_data,
                function(INFO) {
                    widget.data( 'fsr', INFO.result);
                    set_votes(widget);
                },
                'json'
            ); 
        });
    
{/literal}{/block}
{block name=body}
<div class="row" id="content">
    <div class="span8">
        <div id="url"></div>
        <form action="{site_url('/code/save')}" 
              method="POST" id="frm-code" class="form-horizontal">
            <input type="text" name="description" placeholder="描述" style="width:100%;">
            <textarea name="code" rows="14" style="width:100%;" placeholder="您的代码 "></textarea>
            <input type="text" name="guestname" placeholder="您的名字" style="width:100%;">
            <div style="width:400px;float:left;">
                <div style="margin:10px 0 10px 0;">
                    <span style="width:100px;float:left;line-height: 24px;">{__('language')}</span>
                    <select name="language">
                        {foreach $langs as $lang}
                            <option>{$lang}</option>
                        {/foreach}
                    </select>
                </div>
                <div style="margin:10px 0 10px 0;">
                    <span style="width:100px;float:left;line-height: 24px;">{__('duration')}</span>
                    <select name="public">
                        <option>1days</option>
                        <option>Private</option>
                    </select>
                </div>
                <div style="margin:10px 0 10px 0;">
                    <span style="width:100px;float:left;line-height: 24px;">{__('public')}</span>
                    <select name="public">
                        <option>{__('public')}</option>
                        <option>{__('private')}</option>
                    </select>
                </div>
            </div>
            <div style="width:200px;float:left;">
                <button type="button" class="btn btn-primary" style="width: 150px;height:54px;" id="btn-savecode">提交代码</button>
                <button type="button" class="btn btn-info"  style="width: 150px;height:54px;">运行代码</button>
            </div>
        </form>
        <hr style="clear:both;">
        <div>
            <pre><code>
                adfadsfdasfdas
</code></pre>
            <button >评价</button>
        <div class='movie_choice'>
            <div id="{$_id}" class="rate_widget">
                <div class="star_1 ratings_stars" id="star_1"></div>
                <div class="star_2 ratings_stars" id="star_2"></div>
                <div class="star_3 ratings_stars" id="star_3"></div>
                <div class="star_4 ratings_stars" id="star_4"></div>
                <div class="star_5 ratings_stars" id="star_5"></div>
                <div class="total_votes">vote data</div>
            </div>
        </div>
        </div>
    </div>
    <div class="span3">
        <div>
            <ul class="nav nav-tabs">
                <li class="active"><a href="#login" data-toggle="tab">{__('Login')}</a></li>
                <li><a href="#register" data-toggle="tab">{__('Register')}</a></li>
            </ul>
            <div class="tab-content">
                <div id="login" class="tab-pane active">
                    <form action="/user/login">
                        <div class="control-group" style="margin-top:15px;">
                            <input type="text" name="username" placeholder="{__('Username')}">
                            <input type="password" name="password" placeholder="{__('Password')}">
                        </div>
                        <div class="control-group">
                            <button class="btn btn-primary">登录</button>
                            <button class="btn btn-info">忘记密码</button>
                        </div>
                    </form>
                </div>
                <div id="register" class="tab-pane">
                    <form action="/user/register">
                        <div class="control-group" style="margin-top:15px;">
                            <input type="text" name="username" placeholder="{__('Username')}">
                            <input type="password" name="password" placeholder="{__('Password')}">
                            <input type="password" name="c_password" placeholder="{__('Password')}">
                        </div>
                        <div class="control-group">
                            <button class="btn btn-primary">注册</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <hr>
        <div>
            <h3>目前有{$codecount} 段代码</h3>
            <h3>有{$usercount} 注册用户</h3>
            <h3>有{$useronline}人同时在线</h3>
        </div>
        <hr>
        <div>
            <h2>{__('Latest')}</h2>
            {foreach from=$codes item=c}
                <div style="margin-bottom: 10px;line-height: 24px;">
                    <a href="{site_url('/code/get/')}{$c._id}">{$c.description}</a>
                    <span style="float:right">{$c.createtime|date_format:"%Y-%m-%d"}</span>
                </div>
            {/foreach}
        </div><hr>
        <div>
            <h2> {__('Category')}</h2>
            <ul class="nav nav-pills" style="font-size:24px;">
                {foreach from=$tags item=t}
                    <li><a href="{site_url('/code/tag/')}{$t.language}">{$t.language}({$t.count})</a></li>
                {/foreach}
            </ul>
        </div><hr>
        <div>
            <h2>{__('Top')}</h2>
            {foreach from=$greatcodes item=c}
                <div style="margin-bottom: 10px;line-height: 24px;">
                    <a href="{site_url('/code/get')}{$c._id}">{$c.description}</a>
                    <span style="float:right">{$c.createtime|date_format:"%Y-%m-%d"}</span>
                </div>
            {/foreach}
        </div>
    </div>
</div>
{/block}

