<div class="c-box c-box--lg col-xs-12 col-md-8 col-lg-6">
    <div class="c-box__inner">
        <div class="c-box__cont">
            <h2 class="c-box__ttl-s2">[[+pagetitle]]</h2>
            <hr class="hr-pattern">
            <p class="c-box__txt c-box__txt--display">[[+pagetitle]]</p>
        </div>
        <div data-bgimage="[[+img]]" class="b-box__img-wrap b-box__grdnt-b bg-image"></div>
        <div class="c-box__date-item c-box__date-item--float">
            <time datetime="[[+publishedon]]" class="date c-box__date c-box__date--lg"><span class="date__dt">[[+publishedon:date=`%d`]]</span><span class="date__rh"><span class="date__rh-m">[[%lf_month_short.[[+publishedon:date=`%m`]]]]</span><span class="date__rh-d">[[+publishedon:date=`%Y`]]</span></span></time>
        </div>
        <div class="c-box__link-wrap c-box__link-wrap--indent">
            <div class="btn-pointer__wrap">
                <a class="btn btn-pointer__sm btn-anim-a" href="[[~[[+id]]]]"><b>open event & Gallery</b></a>
                <svg class="btn-pointer__left" x="0px" y="0px"
                     viewBox="0 0 10 50" style="enable-background:new 0 0 10 50;" xml:space="preserve">
                    <path fill="#A82743" d="M10,50H0l5-5l-5-5l0,0v0l0,0l5-5l-5-5l0,0v0l0,0l5-5l-5-5l0,0v0l0,0l5-5l-5-5l0,0v0l0,0l5-5L0,0l0,0v0h10V50z"/></svg>

            </div>
        </div>

        [[getImageList?
            &tvname=`imgList`
            &docid=`[[+id]]`
            &tpl=`@CODE: `
        ]]

        <ul class="c-box__views">
            <li class="c-box__view txt">[[+total]]</li>
            <!-- <li class="c-box__video txt">2</li> -->
        </ul><a href="[[~[[+id]]]]" rel="nofollow" class="b-box__link"></a>
    </div>
</div>