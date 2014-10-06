[[pdoResources@indexSlider?
	&parents=`[[++themeclubcube.events_resource]]`
	&includeTVs=`timeStart,price,lineUp,promoEvent,promoImg`
	&processTVs=`promoImg`
	&tvPrefix=``
	&tplWrapper=`[[++themeclubcube.style_events_promo_slider:is=`1`:then=`eventsListPromoIndex`:else=`eventsListFixedPromoIndex`]]`
	&tpl=`[[++themeclubcube.style_events_promo_slider:is=`1`:then=`eventsItemPromoIndex`:else=`eventsItemFixedPromoIndex`]]`
	&tvFilters=`timeStart>=[[getDate? &format=`Y-m-d 00:00:00`]],promoEvent==1`
]]

[[pdoResources@indexEvents?
	&parents=`[[++themeclubcube.events_resource]]`
	&includeTVs=`img,timeStart,price,lineUp,topEvent`
	&processTVs=`img`
	&tvPrefix=``
	&tplWrapper=`[[++themeclubcube.style_index_events_list:is=`1`:then=`eventsListIndex`:else=`eventsListTileIndex`]]`
	&tpl=`[[++themeclubcube.style_index_events_list:is=`1`:then=`eventsItemIndex`:else=`eventsItemTileIndex`]]`
    &tplLast=`[[++themeclubcube.style_index_events_list:is=`1`:then=`eventsItemLastIndex`:else=`eventsItemTileIndex`]]`
	&tvFilters=`timeStart>=[[getDate? &format=`Y-m-d 00:00:00`]],topEvent==1`
]]

[[pdoResources@indexGallery?
	&parents=`[[++themeclubcube.gallery_resource]]`
	&includeTVs=`img`
	&processTVs=`img`
	&tvPrefix=``
	&tplWrapper=`[[++themeclubcube.style_index_gallery_list:is=`1`:then=`galleryListIndex`:else=`galleryListSliderIndex`]]`
	&tpl=`[[++themeclubcube.style_index_gallery_list:is=`1`:then=`galleryItemIndex`:else=`galleryItemBigIndex`]]`
]]

[[pdoResources@indexBlog?
	&parents=`[[++themeclubcube.blog_resource]]`
	&includeTVs=`img`
	&processTVs=`img`
	&tvPrefix=``
	&tplWrapper=`blogListIndex`
	&tpl=`[[++themeclubcube.style_index_blog_list:is=`1`:then=`blogItemIndex`:else=`blogItemTileIndex`]]`
]]

[[pdoResources@indexPartners?
	&parents=`[[++themeclubcube.partners_resource]]`
	&includeTVs=`img`
	&processTVs=`img`
	&tvPrefix=``
	&tplWrapper=`partnersListIndex`
	&tpl=`partnersItemIndex`
]]