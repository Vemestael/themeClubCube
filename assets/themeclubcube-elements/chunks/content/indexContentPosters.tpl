[[pdoResources?
    &tpl=`eventsItemPromoIndex`
    &tplWrapper=`eventsListPromoIndex`
    &parents=`[[++themeclubcube.events_resource]]`
    &tvPrefix=``
    &includeTVs=`timeStart, viewType`
]]
[[pdoResources?
    &tpl=`topEventsSquareItemIndex`
    &tplWrapper=`topEventsSquareListIndex`
    &parents=`[[++themeclubcube.events_resource]]`
    &tvPrefix=``
    &limit=`6`
    &includeTVs=`imgSquare, timeStart, topEvent`
    &tvFilters=`topEvent==1`
]]
[[pdoResources?
    &tpl=`topEventsRectangleItemIndex`
    &tplWrapper=`topEventsRectangleListIndex`
    &parents=`[[++themeclubcube.events_resource]]`
    &tvPrefix=``
    &limit=`6`
    &includeTVs=`img, timeStart, topEvent`
    &tvFilters=`topEvent==1`
]]
[[pdoResources?
    &tpl=`socialItemIndexPosters`
    &parents=`0`
    &tvPrefix=``
    &limit=`1`
    &includeTVs=`twitterLogin, facebookLink`
]]