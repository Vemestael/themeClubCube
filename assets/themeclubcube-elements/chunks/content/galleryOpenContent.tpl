[[pdoResources?
    &tpl=`galleryOpenPopUpGallery`
    &parents=`0`
    &resources=`[[*eventId]]`
    &includeContent=`1`
    &limit=`1`
]]
<div class="b-gallery__content">
    [[pdoResources?
        &tpl=`galleryOpenHeadGallery`
        &parents=`0`
        &resources=`[[*eventId]]`
        &includeContent=`1`
        &limit=`1`
        &tvPrefix=``
        &includeTVs=`timeStart`
    ]]
    <div class="b-content container">
        <div class="row">
            [[pdoResources?
                &tpl=`galleryOpenGallery`
                &parents=`0`
                &resources=`[[*eventId]]`
                &includeContent=`1`
                &limit=`1`
                &tvPrefix=``
                &includeTVs=`videoId, annotationText`
            ]]
            <aside class="b-aside col-sm-4 col-lg-4 col-lg-offset-1">
                <div class="row">
                    [[pdoResources?
                        &tpl=`leftPanelItemGallery_1`
                        &tplWrapper=`leftPanelListGallery_1`
                        &parents=`[[++themeclubcube.events_resource]]`
                        &limit = `2`
                        &tvPrefix=``
                        &includeTVs=`img, timeStart`
                    ]]
                    [[pdoResources?
                        &tpl=`leftPanelItemGallery_2`
                        &tplWrapper=`leftPanelListGallery_2`
                        &parents=`[[++themeclubcube.events_resource]]`
                        &limit = `3`
                        &tvPrefix=``
                        &includeTVs=`timeStart, img`
                    ]]
                </div>
            </aside>
        </div>
    </div>