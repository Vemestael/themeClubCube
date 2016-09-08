[[pdoResources?
    &tpl=`eventHeadEvents`
    &parents=`[[++themeclubcube.events_resource]]`
    &limit = `1`
    &tvPrefix=``
    &includeTVs=`timeStart, img`
]]
<div class="b-content container">
    <div class="b-panel-t col-xs-12">
        <ul class="b-panel-t__list b-panel-t__arts col-sm-8">
            [[getImageList?
            &tvname=`migxEventArtist`
            &tpl=`artistItemEvents`
            ]]
        </ul>
        <ul class="b-panel-t__list col-sm-4">
            <li><a href="mailto:[[+contactEmail]]" class="link">[[+contactEmail]]</a></li>
            <li class="tel"><a href="tel:[[+contactNumber]]" class="link">[[+contactNumber]]</a></li>
        </ul>
    </div>
    <div class="row">
        [[pdoResources?
            &tpl=`eventsOpen`
            &parents=`[[++themeclubcube.events_resource]]`
            &limit = `1`
            &tvPrefix=``
            &includeTVs=`timeStart, img, migxEventArtist, videoLink, videoId, contactNumber, contactEmail, ticketPrice, annotationText, eventHeaderViewType`
        ]]
        <aside class="b-aside col-sm-4 col-lg-4 col-lg-offset-1">
            <div class="row">
                [[pdoResources?
                    &tpl=`leftPanelItemEvents_1`
                    &tplWrapper=`leftPanelListEvents_1`
                    &parents=`[[++themeclubcube.events_resource]]`
                    &limit = `2`
                    &tvPrefix=``
                    &includeTVs=`img, timeStart`
                ]]
                [[pdoResources?
                    &tpl=`leftPanelItemEvents_2`
                    &tplWrapper=`leftPanelListEvents_2`
                    &parents=`[[++themeclubcube.events_resource]]`
                    &limit = `3`
                    &tvPrefix=``
                    &includeTVs=`timeStart, img`
                ]]
            </div>
        </aside>
    </div>
</div>