<div class="container-fluidss">
	<div class="s-panel">
		<img class="img-preload" alt="[[+pagetitle:htmlent]]" title="[[+longtitle:htmlent:default=`[[+pagetitle:htmlent]]`]]"
             data-src="<768:[[+promoImg:phpthumbof=`w=960&h=640&zc=1`]],
                <1200:[[+promoImg:phpthumbof=`w=1152&h=768&zc=1`]],
				>1199:/themeclubcube/[[+promoImg]]"
             src="[[+promoImg]]">
	</div>
	<div class="pattern"></div>
	<div class="rowss">
		<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 text-left slide-title">
			<div class="slider-heading col-sm-7 col-lg-6">[[+pagetitle:htmlent]]</div>
			<div class="event-about col-sm-5 col-lg-6">
                <time class="date vid-date" datetime="[[+timeStart]]">
					<div class="month">[[%lf_month_short.[[+timeStart:strtotime:date=`%m`]]]]</div>
					<div class="day">[[+timeStart:strtotime:date=`%d`]]</div>
					<div class="year">[[%lf_week.[[+timeStart:strtotime:date=`%w`]]]]</div>
				</time>
				<div class="col-lg-6 col-sm-6 event-times">
					<div class="slider-heading time-evt">
						<span class="trs">[[%lf_events_start:htmlent]]</span>
					</div>
					<div class="slider-heading time-evt">
						[[++themeclubcube.style_events_time_format:is=`1`:then=`[[+timeStart:strtotime:date=`%I:%M %p`]]`:else=`[[+timeStart:strtotime:date=`%H:%M`]]`]]
					</div>
				</div>
			</div>
			<div class="half-line visible-lg col-lg-12">
				<hr class="col-lg-4">
			</div>
			<p class="col-sm-12 col-md-12 col-lg-5 col-lg-offset-1 slider-texts hidden-sm hidden-md">[[+introtext:htmlent]]</p>
			<hr class="col-sm-12 col-md-12">
			<ul class="slide-list col-sm-12 col-md-6 col-lg-6">
				[[getImageList?
					&tpl=`@CODE:<li>[[+name:htmlent]] </li>`
					&tvname=`lineUp`
					&docid=`[[+id]]`
					&outputSeparator=``
                    &limit=`5`
				]]
			</ul>
			<hr>
			<a href="[[~[[+id]]]]" title="[[+longtitle:htmlent:default=`[[+pagetitle:htmlent]]`]]" class="get-in col-lg-offset-7">
				<span class="price">
					<span class="trs">[[%lf_events_price:htmlent]]</span>&nbsp;[[+price:htmlent]]
				</span>
				<span class="get-into">[[%lf_events_get_in:htmlent]]</span>
			</a>
			<div class="socials col-sm-12 col-md-12 col-md-offset-0 col-lg-3">
				<div class="share">[[%lf_share]]</div>
                <div class="fb-soc ver1" data-url="[[~[[+id]]? &scheme=`full`]]" data-text="[[+longtitle:htmlent:default=`[[+pagetitle:htmlent]]`]]"></div>
                <div class="tw-soc ver1" data-url="[[~[[+id]]? &scheme=`full`]]" data-text="[[+longtitle:htmlent:default=`[[+pagetitle:htmlent]]`]]"></div>
			</div>
		</div>
	</div>
</div>