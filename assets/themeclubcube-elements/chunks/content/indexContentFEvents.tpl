[[pdoResources?
    &tpl=`eventsItemPromoIndex`
    &tplWrapper=`eventsListPromoIndex`
    &parents=`[[++themeclubcube.events_resource]]`
    &tvPrefix=``
    &includeTVs=`timeStart, viewType`
]]
[[pdoResources?
    &tpl=`topEventsSquareItemIndexEvents`
    &tplWrapper=`topEventsSquareListIndexEvents`
    &parents=`[[++themeclubcube.events_resource]]`
    &tvPrefix=``
    &limit=`9`
    &includeTVs=`imgSquare, timeStart, topEvent`
    &tvFilters=`topEvent==1`
]]
[[pdoResources?
    &tpl=`topEventsRectangleItemIndexEvents`
    &tplWrapper=`topEventsRectangleListIndexEvents`
    &parents=`[[++themeclubcube.events_resource]]`
    &tvPrefix=``
    &limit=`9`
    &includeTVs=`img, timeStart, topEvent`
    &tvFilters=`topEvent==1`
]]
[[pdoResources?
    &tpl=`pastEventsItemIndex`
    &tplWrapper=`pastEventsListIndex`
    &parents=`[[++themeclubcube.events_resource]]`
    &tvPrefix=``
    &limit=`2`
    &includeTVs=`timeStart, topEvent`
    &tvFilters=`topEvent==2`
]]
[[pdoResources?
    &tpl=`galleryItemIndexEvents`
    &tplWrapper=`galleryListIndexEvents`
    &parents=`[[++themeclubcube.gallery_resource]]`
    &tvPrefix=``
    &includeTVs=`img`
]]