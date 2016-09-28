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
                    [[pdoResources@eventsOpenSidebar?
                        &tpl=`sidebarEventsItemCommon_[[*typeSidebar]]`
                        &tplWrapper=`sidebarEventsListCommon`
                        &parents=`[[++themeclubcube.events_resource]]`
                        &tvPrefix=``
                        &includeTVs=`img, timeStart, typeSidebar`
                    ]]
                </div>
            </aside>
        </div>
    </div>