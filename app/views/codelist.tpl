{extends file="layout.tpl"}
{block name=title}你的代码列表{/block}
{block name=script}
{/block}
{block name=body}

<li><a href="#" onclick="$.ajax({
                    url: '{site_url('/code/delete/' .$code._id)}',
                    success:function(){
                        
                    }
            });">删除</a></li>

{/block}