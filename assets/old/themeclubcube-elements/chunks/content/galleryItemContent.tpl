<section class="gallery-tiles" id="galleryContainer">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="gallery-h1">[[*pagetitle]]</div>
			</div>
		</div>
		<div class="row">
			[[getImageList?
				&tpl=`galleryImageItemGallery`
				&tvname=`gallery`
				&docid=`[[*id]]`
				&outputSeparator=``
			]]
		</div>
	</div>
</section>
<div class="border-gall" id="borderGallery">
	<div class="container">
		<div class="row">
			<div class="gall-count pull-left" id="galleryCount">
				<div class="item-img">
					<div class="photo-c"></div>
					<div class="">[[+total]]</div>
				</div>
			</div>
			<div class="all-btn pull-left" id="allImagesBlock">
				<div class="all-icon"></div>
				<div class="all-icon-text">All</div>
			</div>
			<div class="img-counter" id="imagesCounter">

			</div>
			<div class="socials pull-right">
				<div class="share">[[%lf_share]]</div>
                <div class="fb-soc ver1" data-url="[[~[[*id]]? &scheme=`full`]]" data-text="[[*longtitle:htmlent:default=`[[*pagetitle:htmlent]]`]]"></div>
                <div class="tw-soc ver1" data-url="[[~[[*id]]? &scheme=`full`]]" data-text="[[*longtitle:htmlent:default=`[[*pagetitle:htmlent]]`]]"></div>
			</div>
		</div>
	</div>
</div>
<div class="scroll-down white" id="scrollButton">
	<div class="l-s-arr"></div>
	<div class="scroll-down-inner">[[%lf_gallery_item_about]]</div>
	<div class="r-s-arr"></div>
</div>
<div class="gall-close" id="galleryText">
	<section class="content-header white-no-img">
		<div class="container z-top">
			<div class="row">
				<div class="col-md-8 col-sm-8">
					<h1 class="content-h1 text-left">[[*pagetitle]]</h1>
					 <!-- <div class="top-event-place">2<small>nd</small> dancefloor</div>
					 Ask about it  -->
				</div>
				<div class="col-md-4 col-sm-4">
					<div class="event-about view-evt">
						<div class="date">
							<div class="month">[[%lf_month_short.[[*timeStart:strtotime:date=`%m`]]]]</div>
							<div class="day">[[*timeStart:strtotime:date=`%d`]]</div>
							<div class="year">[[%lf_week.[[*timeStart:strtotime:date=`%w`]]]]</div>
						</div>
						<div class="col-lg-6 col-sm-7">
							<h1 class="slider-heading event-h1 text-left">
								[[++themeclubcube.style_events_time_format:is=`1`:then=`[[*timeStart:strtotime:date=`%I:%M %p`]]`:else=`[[*timeStart:strtotime:date=`%H:%M`]]`]]
							</h1>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<div class="main-content gallery-text">
		<div class="container text-contain">
			<div class="row">
				<main class="col-lg-8 col-md-12 col-sm-12 content-main">
					<div class="content-page">
						<div class="page-text">
							[[*content]]
						</div>
					</div>
				</main>
				<aside class="col-lg-4 col-md-12 col-sm-12 items-aside">
					[[$eventsListAsideCommon]]
				</aside>
			</div>
		</div>
	</div>