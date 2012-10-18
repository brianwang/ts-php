{extends file="layout.tpl"}
{block name=title}Code{/block}
{block name=body}
<div class="row">
    <div class="row offset2">
        <input type="text" name="search">
        <button class="btn btn-primary">搜索</button>
    </div>
    <hr>
    <div class="row">
        <div class="row-fluid">
            <div class="span2">
                <h3>分类</h3>
                <ul class="nav nav-stacked">
                    <li><a href="#">C++</a></li>
                </ul>
            </div>
            <div class="span8">
                <div>
                    <div>
                        该段代码链接：<a href="#">http://ww.codesgist.com/code/1233213</a>
                        <div>
                            <h2>计算加和</h2>
                            <span>共多少个字符</span>
                            <a href="#">*****</a>
                        </div>
                        <div>
                            <a href="#">给作者留言</a>
                            <a href="#">加入自己的代码库</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="span2">
                右边
            </div>
        </div>
    </div>

</div>
{/block}