<article class="[[+blogViewType]]">
    [[+blogViewType:is=`b-box b-box--clr-b`:or:if=`[[+blogViewType]]`:is=`b-box b-box-sm b-box--clr-b`:then=`
    <div data-bgimage="[[+img]]" class="b-box__img-wrap bg-image"></div>
    `]]
    <div class="b-box__date">
        <time datetime="[[+publishedon]]">[[%lf_month_short.[[+publishedon:date=`%m`]]]] [[+publishedon:date=`%d, %H:%M`]]</time>
    </div>
    <h6 class="b-box__s6-ttl">
        [[+pagetitle]]
    </h6><a href="[[~[[+id]]]]" class="b-box__link"></a>
</article>