[[pdoResources@indexSlider?
    &tpl=`eventsItemPromoIndex`
    &tplWrapper=`eventsListPromoIndex`
    &parents=`[[++themeclubcube.events_resource]]`
    &tvPrefix=``
    &includeTVs=`timeStart, viewType, ticketPrice, img`
]]
<div class="b-events">
    <div class="container">
        <div class="row">
            <div class="b-tabs col-lg-8">
                <h6 class="s6-heading b-tabs__ttl">Top events</h6>
                [[!++themeclubcube.demo:is=`1`:then=`
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
                `:else=``]]
                <div class="b-tabs__content">
                    [[!++themeclubcube.demo:is=`1`:then=`
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
                    `:else=``]]
                    [[!*eventViewType:is=`1`:and:if=`[[++themeclubcube.demo]]`:ne=`1`:then=`
                        [[pdoResources@topEvents?
                            &tpl=`eventsSquareCommon`
                            &tplWrapper=`eventsSquareListCommon`
                            &parents=`[[++themeclubcube.events_resource]]`
                            &tvPrefix=``
                            &includeTVs=`imgSquare, timeStart, topEvent`
                            &tvFilters=`topEvent==1`
                        ]]
                    `:else=``]]
                    [[!*eventViewType:is=`2`:and:if=`[[++themeclubcube.demo]]`:ne=`1`:then=`
                        [[pdoResources@topEvents?
                            &activeClass=`active`
                            &tpl=`eventsRectangleCommon`
                            &tplWrapper=`eventsRectangleListCommon`
                            &parents=`[[++themeclubcube.events_resource]]`
                            &tvPrefix=``
                            &includeTVs=`img, timeStart, topEvent`
                            &tvFilters=`topEvent==1`
                        ]]
                    `:else=``]]
                </div>
            </div>
            <aside class="b-aside col-xs-12 col-lg-4">
                <div class="row">
                    [[pdoResources@indexVideo?
                        &tpl=`videoItemIndex`
                        &tplWrapper=`videoListIndex`
                        &parents=`[[++themeclubcube.video_resource]]`
                        &tvPrefix=``
                        &includeTVs=`videoLink`
                    ]]
                    [[pdoResources@indexBlog?
                        &tpl=`blogItemCommon`
                        &tplWrapper=`blogListIndex`
                        &parents=`[[++themeclubcube.blog_resource]]`
                        &tvPrefix=``
                        &includeTVs=`img, blogViewType`
                    ]]
                </div>
            </aside>
        </div>
    </div>
</div>
<div class="b-promo-sc">
    <div class="container">
        <div class="row">
            [[!getImageList?
                &tvname=`migxPromoSc`
                &tpl=`promoScItemIndex`
            ]]
        </div>
    </div>
</div>
[[pdoResources@pastEvents?
    &tpl=`pastEventsItemCommon`
    &tplWrapper=`pastEventsListIndex`
    &parents=`[[++themeclubcube.events_resource]]`
    &tvPrefix=``
    &includeTVs=`timeStart, topEvent, img`
    &tvFilters=`topEvent==2`
]]
[[pdoResources@indexGallery?
    &tpl=`galleryItemCommon`
    &tplWrapper=`galleryListCommon`
    &parents=`[[++themeclubcube.gallery_resource]]`
    &tvPrefix=``
    &includeTVs=`img`
]]
[[pdoResources?
    &tpl=`partnersItemIndex`
    &tplWrapper=`partnersListIndex`
    &parents=`[[++themeclubcube.partners_resource]]`
    &tvPrefix=``
    &includeTVs=`img, partnerLink`
]]
