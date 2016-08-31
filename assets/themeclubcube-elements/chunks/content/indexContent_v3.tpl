[[pdoResources?
    &tpl=`eventsItemPromoIndex`
    &tplWrapper=`eventsListPromoIndex`
    &parents=`[[++themeclubcube.events_resource]]`
    &tvPrefix=``
    &includeTVs=`timeStart, viewType`
]]
[[pdoResources?
    &tpl=`topEventsSquareItemIndex_v3`
    &tplWrapper=`topEventsSquareListIndex`
    &parents=`[[++themeclubcube.events_resource]]`
    &tvPrefix=``
    &includeTVs=`imgSquare, timeStart, topEvent`
    &tvFilters=`topEvent==1`
]]
[[pdoResources?
    &tpl=`topEventsRectangleItemIndex_v3`
    &tplWrapper=`topEventsRectangleListIndex`
    &parents=`[[++themeclubcube.events_resource]]`
    &tvPrefix=``
    &includeTVs=`img, timeStart, topEvent`
    &tvFilters=`topEvent==1`
]]
[[pdoResources?
    &tpl=`musicItemIndex`
    &tplWrapper=`musicListIndex`
    &parents=`0`
    &limit=`1`
    &tvPrefix=``
    &includeTVs=`audioLink`
]]
[[pdoResources?
    &tpl=`bigBlogItemIndex`
    &tplWrapper=`bigBlogListIndex`
    &parents=`[[++themeclubcube.blog_resource]]`
    &limit=`8`
    &tvPrefix=``
    &includeTVs=`blogViewType, img`
]]