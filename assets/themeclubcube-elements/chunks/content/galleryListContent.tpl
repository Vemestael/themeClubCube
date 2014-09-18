<section class="all-blogs blog">
	<div class="container">
		<div class="row head">
			<div class="col-sm-6 col-md-6 col-lg-6 all-blogs-h1">
				<h1>[[*pagetitle:htmlent]]</h1>
			</div>
		</div>
	</div>
</section>
<main>
	<div class="container gr-bg all-blogs-container">
		<div class="row">
			[[!pdoPage@galleryList?
				&parents=`[[*id]]`
				&includeTVs=`img`
				&processTVs=`img`
				&tvPrefix=``
				&tplWrapper=`galleryListWrapperGallery`
				&wrapIfEmpty=`1`
				&tpl=`galleryItemGallery`
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
		</div>
	</div>
	[[!+page.nav]]
</main>