<article class="c-box c-box--sm [[*alias:is=`gallery`:then=`col-xs-12 col-xm-6 col-md-4 col-lg-3`]]">
    <div class="c-box__inner">
        <div data-bgimage="[[+img]]" class="b-box__img-wrap b-box__grdnt-b bg-image"></div>
        <div class="c-box__date-item c-box__date-item--float">
            <time datetime="[[+publishedon]]" class="date-sm c-box__date"><span class="date-sm__dt">[[+publishedon:date=`%d`]]</span><span class="date-sm__rh"><span class="date-sm__rh-m">[[%lf_month_short.[[+publishedon:date=`%m`]]]]</span><span class="date-sm__rh-d">[[+publishedon:date=`%Y`]]</span></span></time>
        </div>
        [[getImageList?
            &tvname=`imgList`
            &docid=`[[*id]]`
            &tpl=`@CODE: `
        ]]
        <ul class="c-box__views">
            <li class="c-box__view txt">[[+total]]</li>
            <li class="c-box__video txt">#</li>
        </ul><a href="[[~[[+id]]]]" rel="nofollow" class="b-box__link"></a>
    </div>
    <h6><a href="[[~[[+id]]]]" class="c-box__link">[[+pagetitle]]</a></h6>
</article>