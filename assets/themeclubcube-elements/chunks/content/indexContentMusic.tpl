[[pdoResources@indexSlider?
    &tpl=`eventsItemPromoIndex`
    &tplWrapper=`eventsListPromoIndex`
    &parents=`[[++themeclubcube.events_resource]]`
    &tvPrefix=``
    &includeTVs=`timeStart, viewType`
]]
<div class="b-events">
    <div class="container">
        <div class="row">
            <div class="b-tabs col-lg-8">
                <h6 class="s6-heading b-tabs__ttl">Top events</h6>
                <ul role="tablist" class="b-tabs__nav b-tabs__nav-tabs">
                    <li role="presentation" class="active"><a href="#block-a" aria-controls="block-a" role="tab" data-toggle="tab">
                            <svg baseProfile="tiny" width="10" height="10" x="0px" y="0px" viewBox="0 0 10 10" xml:space="preserve">
                    <path fill="#231F20" d="M0,4h4V0H0V4z M6,0v4h4V0H6z M0,10h4V6H0V10z M6,10h4V6H6V10z"/>
                    </svg></a></li>
                    <li role="presentation"><a href="#block-b" aria-controls="block-b" role="tab" data-toggle="tab">
                            <svg baseProfile="tiny" width="10" height="10" x="0px" y="0px" viewBox="0 0 10 10" xml:space="preserve">
                    <path fill="#231F20" d="M0,0v4h10V0H0z M10,10V6H0v4H10z"/>
                    </svg></a></li>
                </ul>
                <div class="b-tabs__content">
                    [[pdoResources@topEvents?
                        &tpl=`eventsSquareCommon`
                        &tplWrapper=`eventsSquareListCommon`
                        &parents=`[[++themeclubcube.events_resource]]`
                        &tvPrefix=``
                        &includeTVs=`imgSquare, timeStart, topEvent`
                        &tvFilters=`topEvent==1`
                    ]]
                    [[pdoResources@topEvents?
                        &tpl=`eventsRectangleCommon`
                        &tplWrapper=`eventsRectangleListCommon`
                        &parents=`[[++themeclubcube.events_resource]]`
                        &tvPrefix=``
                        &includeTVs=`img, timeStart, topEvent`
                        &tvFilters=`topEvent==1`
                    ]]
                </div>
            </div>
            [[pdoResources?
                &tpl=`musicItemIndex`
                &tplWrapper=`musicListIndex`
                &parents=`0`
                &limit=`1`
                &tvPrefix=``
                &includeTVs=`audioLink`
            ]]
        </div>
    </div>
</div>
[[pdoResources@indexBlogGallery?
    &tpl=`blogItemCommon`
    &tplWrapper=`bigBlogListIndex`
    &parents=`[[++themeclubcube.blog_resource]]`
    &tvPrefix=``
    &includeTVs=`blogViewType, img`
]]