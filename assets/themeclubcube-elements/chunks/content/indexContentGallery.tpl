[[pdoResources?
    &tpl=`eventsItemPromoIndex`
    &tplWrapper=`eventsListPromoIndex`
    &parents=`[[++themeclubcube.events_resource]]`
    &tvPrefix=``
    &includeTVs=`timeStart, viewType`
]]
[[pdoResources?
    &tpl=`pastEventsItemIndexGallery`
    &tplWrapper=`pastEventsListIndexGallery`
    &parents=`[[++themeclubcube.events_resource]]`
    &tvPrefix=``
    &limit=`4`
    &includeTVs=`timeStart, topEvent, img`
    &tvFilters=`topEvent==2`
]]
[[pdoResources?
    &tpl=`bigBlogItemIndex`
    &tplWrapper=`bigBlogListIndex`
    &parents=`[[++themeclubcube.blog_resource]]`
    &limit=`8`
    &tvPrefix=``
    &includeTVs=`blogViewType, img`
]]
[[pdoResources?
    &tpl=`galleryItemIndexEvents`
    &tplWrapper=`galleryListIndexEvents`
    &parents=`[[++themeclubcube.gallery_resource]]`
    &tvPrefix=``
    &includeTVs=`img`
]]