[[pdoResources?indexSlider
    &tpl=`eventsItemPromoIndex`
    &tplWrapper=`eventsListPromoIndex`
    &parents=`[[++themeclubcube.events_resource]]`
    &tvPrefix=``
    &includeTVs=`timeStart, viewType`
]]
[[pdoResources?pastEventsIndexGallery
    &tpl=`pastEventsItemIndexGallery`
    &tplWrapper=`pastEventsListIndexGallery`
    &parents=`[[++themeclubcube.events_resource]]`
    &tvPrefix=``
    &includeTVs=`timeStart, topEvent, img`
    &tvFilters=`topEvent==2`
]]
[[pdoResources?indexBlogGallery
    &tpl=`bigBlogItemIndex`
    &tplWrapper=`bigBlogListIndex`
    &parents=`[[++themeclubcube.blog_resource]]`
    &tvPrefix=``
    &includeTVs=`blogViewType, img`
]]
[[pdoResources?indexGallery
    &tpl=`galleryItemIndexEvents`
    &tplWrapper=`galleryListIndexEvents`
    &parents=`[[++themeclubcube.gallery_resource]]`
    &tvPrefix=``
    &includeTVs=`img`
]]