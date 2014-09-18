<main>
<section class="all-events events-tiles">
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-sm-6 events-tile-h1">
				<h1>[[*pagetitle:htmlent]]</h1>
			</div>
		</div>
		<div class="rows">
			<div class="button-dropdown hidd">
				[[!getWeeksEvents]]
			</div>
		</div>
	</div>
</section>
<div class="container gr-bg tab-content">
	<div class="tab-pane show">
		[[!getParamsWeeksEvents]]
		[[!+week:notempty=`
			[[!pdoResources@eventsListWeek?
				&parents=`[[*id]]`
				&includeTVs=`img,timeStart,price,lineUp,topEvent`
				&processTVs=`img,lineUp`
				&tvPrefix=``
				&tplWrapper=`eventsListWrapperEvents`
				&wrapIfEmpty=`1`
				&tpl=`eventsItemTileEvents`
				&tvFilters=`[[!+params]]`
			]]
		`:isempty=`
			[[!pdoPage@eventsListAll?
				&parents=`[[*id]]`
				&includeTVs=`img,timeStart,lineUp,price`
				&processTVs=`img,lineUp`
				&tvFilters=`timeStart>=[[getDate? &format=`Y-m-d 00:00:00`]]`
				&tvPrefix=``
				&tplWrapper=`eventsListWrapperEvents`
				&wrapIfEmpty=`1`
				&tpl=`eventsItemTileEvents`
				&tplPage=`@INLINE <li><a href="[[+href]]">[[+pageNo]]</a></li>`
				&tplPageWrapper=`@INLINE <div class="container"><div class="rows paging single-paging">[[+prev]]<ul class="middle-paging">[[+pages]]</ul>[[+next]]</div></div>`
				&tplPageActive=`@INLINE <li class="off"><a href="[[+href]]">[[+pageNo]]</a></li>`
				&tplPageFirst=``
				&tplPageLast=``
				&tplPagePrev=`@INLINE <a href="[[+href]]"><div class="event-dates input-append date pull-left">
						<div class="ev-date-right pull-left left-paging">
							<i class="arr-left"></i>
						</div>
						<div class="ev-date-left">
							<div class="ttl">[[%lf_page_prev:htmlent]]</div>
						</div>
					</div></a>`
				&tplPageNext=`@INLINE <a href="[[+href]]"><div class="event-dates input-append date pull-right">
						<div class="ev-date-right right-paging">
							<i class="arr-right"></i>
						</div>
						<div class="ev-date-left">
							<div class="ttl">[[%lf_page_next:htmlent]]</div>
						</div>
					</div></a>`
				&tplPageSkip=`@INLINE <li class="dots-pagination"><span>...</span></li>`
				&tplPageFirstEmpty=``
				&tplPageLastEmpty=``
				&tplPagePrevEmpty=`@INLINE <div class="event-dates input-append date pull-left off">
					<div class="ev-date-right pull-left left-paging">
						<i class="arr-left"></i>
					</div>
					<div class="ev-date-left">
						<div class="ttl">[[%lf_page_prev:htmlent]]</div>
					</div>
				</div>`
				&tplPageNextEmpty=`@INLINE <div class="event-dates input-append date pull-right off">
					<div class="ev-date-right right-paging">
						<i class="arr-right"></i>
					</div>
					<div class="ev-date-left">
						<div class="ttl">[[%lf_page_next:htmlent]]</div>
					</div>
				</div>`
			]]
		`]]
	</div>
</div>
[[!+week:isempty=`
	[[!+page.nav]]
`]]
</main>