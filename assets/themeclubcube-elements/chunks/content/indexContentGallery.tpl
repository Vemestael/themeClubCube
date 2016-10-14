[[pdoResources@indexSlider?
    &tpl=`eventsItemPromoIndex`
    &tplWrapper=`eventsListPromoIndex`
    &parents=`[[++themeclubcube.events_resource]]`
    &tvPrefix=``
    &includeTVs=`timeStart, viewType, ticketPrice, img, promoImg`
]]
[[pdoResources@pastEventsIndexGallery?
    &tpl=`pastEventsItemCommon`
    &tplWrapper=`pastEventsListIndexGallery`
    &parents=`[[++themeclubcube.events_resource]]`
    &tvPrefix=``
    &includeTVs=`timeStart, topEvent, img`
    &tvFilters=`topEvent==2`
]]
[[pdoResources@indexBlogGallery?
    &tpl=`blogItemCommon`
    &tplWrapper=`bigBlogListIndex`
    &parents=`[[++themeclubcube.blog_resource]]`
    &tvPrefix=``
    &includeTVs=`blogViewType, img`
]]
[[pdoResources@indexGallery?
    &tpl=`galleryItemCommon`
    &tplWrapper=`galleryListCommon`
    &parents=`[[++themeclubcube.gallery_resource]]`
    &tvPrefix=``
    &includeTVs=`img`
]]