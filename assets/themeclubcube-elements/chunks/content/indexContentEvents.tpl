[[pdoResources?indexSlider
    &tpl=`eventsItemPromoIndex`
    &tplWrapper=`eventsListPromoIndex`
    &parents=`[[++themeclubcube.events_resource]]`
    &tvPrefix=``
    &includeTVs=`timeStart, viewType`
]]
<div class="b-content container">
    <main class="b-main">
        <div class="b-box-wrap">
            <div class="row">
                <div class="col-xs-12">
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
                </div>
            </div>
            <div class="b-tabs__content nobottommargin">
                [[pdoResources?topIndexEvents
                    &tpl=`topEventsSquareItemIndexEvents`
                    &tplWrapper=`topEventsSquareListIndexEvents`
                    &parents=`[[++themeclubcube.events_resource]]`
                    &tvPrefix=``
                    &includeTVs=`imgSquare, timeStart, topEvent`
                    &tvFilters=`topEvent==1`
                ]]
                [[pdoResources?topIndexEvents
                    &tpl=`topEventsRectangleItemIndexEvents`
                    &tplWrapper=`topEventsRectangleListIndexEvents`
                    &parents=`[[++themeclubcube.events_resource]]`
                    &tvPrefix=``
                    &includeTVs=`img, timeStart, topEvent`
                    &tvFilters=`topEvent==1`
                ]]
            </div>
        </div>
    </main>
</div>
[[pdoResources?indexVideo
    &tpl=`videoItemIndexEvents`
    &tplWrapper=`videoListIndexEvents`
    &parents=`[[++themeclubcube.video_resource]]`
    &tvPrefix=``
    &includeTVs=`videoLink`
]]
[[pdoResources?indexGallery
    &tpl=`galleryItemIndexEvents`
    &tplWrapper=`galleryListIndexEvents`
    &parents=`[[++themeclubcube.gallery_resource]]`
    &tvPrefix=``
    &includeTVs=`img`
]]