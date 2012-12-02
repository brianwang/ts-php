<div class='movie_choice' >
    <div class="rate_title">当前分 <span class="avgvalue">{$l.avgvalue|default:0}</span>
    (<span class="votes">{$l.votes|count|default: 0}</span>{__('votes')})
    </div>
    <div class="rate_widget" id="{$l._id}">
        <div class="star_1 ratings_stars" id="star_1" hint="看不懂"></div>
        <div class="star_2 ratings_stars" id="star_2" hint="有点意思"></div>
        <div class="star_3 ratings_stars" id="star_3" hint="普通"></div>
        <div class="star_4 ratings_stars" id="star_4" hint="不错"></div>
        <div class="star_5 ratings_stars" id="star_5" hint="绝了"></div>
        <div class="total_votes"></div>
    </div>
</div>