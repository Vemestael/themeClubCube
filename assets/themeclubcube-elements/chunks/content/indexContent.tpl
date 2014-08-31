[[pdoResources@indexEvents?
	&parents=`[[++themeclubcube.events_resource]]`
	&includeTVs=`img,timeStart,price,lineUp`
	&processTVs=`img`
	&tvPrefix=``
	&tplWrapper=`[[++themeclubcube.style_index_events_list:is=`1`:then=`eventsListIndex`:else=`eventsListTileIndex`]]`
	&tpl=`[[++themeclubcube.style_index_events_list:is=`1`:then=`eventsItemIndex`:else=`eventsItemTileIndex`]]`
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