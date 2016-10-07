<div class="event-dates input-append date">
	<div class="ev-date-left date-no-border">
		<div class="ttl">[[%lf_events_more_head:htmlent]]</div>
	</div>
</div>
[[pdoResources@asideEvents?
	&parents=`[[++themeclubcube.events_resource]]`
	&includeTVs=`img,timeStart,price,lineUp,topEvent`
	&processTVs=`img`
	&tvPrefix=``
	&tpl=`eventsItemAsideCommon`
	&tvFilters=`timeStart>=[[getDate? &format=`Y-m-d 00:00:00`]],topEvent==1`
]]