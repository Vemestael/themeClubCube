<div class="container-fluidss">
	<div class="s-panel">
		<img class="img-preload" src="[[+promoImg]]" alt="[[+pagetitle:htmlent]]" title="[[+longtitle:default=`[[+pagetitle:htmlent]]`]]">
	</div>
	<div class="pattern"></div>
	<div class="rowss">
		<div class="col-lg-5 col-lg-offset-1 col-md-10 col-md-offset-1 slide-title">
			<div class="o-h">
				<div class="slider-heading col-sm-6 col-lg-12">[[+pagetitle:htmlent]]</div>
				<div class="event-about visible-sm visible-xs visible-md col-sm-6">
					<time class="date" datetime="[[+timeStart]]">
						<div class="month">[[%lf_month_short.[[+timeStart:strtotime:date=`%m`]]]]</div>
						<div class="day">[[+timeStart:strtotime:date=`%d`]]</div>
						<div class="year">[[%lf_week.[[+timeStart:strtotime:date=`%w`]]]]</div>
					</time>
					<div class="col-lg-6 col-sm-6">
						<div class="slider-heading time-evt">
							<span class="trs">[[%lf_events_start:htmlent]]</span>
						</div>
						<div class="slider-heading time-evt">
							[[++themeclubcube.style_events_time_format:is=`1`:then=`[[+timeStart:strtotime:date=`%I:%M %p`]]`:else=`[[+timeStart:strtotime:date=`%H:%M`]]`]]
						</div>
					</div>
				</div>
			</div>
			<hr>
			<div class="slider-description">
				[[getImageList?
				&tpl=`@CODE:<span class="guest-slider">[[+name:htmlent]] </span>`
				&tvname=`lineUp`
				&docid=`[[+id]]`
				&outputSeparator=``
				]]
			</div>
			<hr>
		</div>
		<div class="col-lg-5 col-md-10 col-md-offset-1 col-lg-offset-0 text-left slide-desc">
			<div class="event-about">
				<time class="date" datetime="[[+timeStart]]">
                    <div class="month">[[%lf_month_short.[[+timeStart:strtotime:date=`%m`]]]]</div>
                    <div class="day">[[+timeStart:strtotime:date=`%d`]]</div>
                    <div class="year">[[%lf_week.[[+timeStart:strtotime:date=`%w`]]]]</div>
				</time>
				<div class="col-lg-6 ">
					<div class="slider-heading time-evt">
						<span class="trs">[[%lf_events_start:htmlent]]</span></div>
					<div class="slider-heading time-evt">
                        [[++themeclubcube.style_events_time_format:is=`1`:then=`[[+timeStart:strtotime:date=`%I:%M %p`]]`:else=`[[+timeStart:strtotime:date=`%H:%M`]]`]]
					</div>
				</div>
			</div>
			<p>[[+introtext:htmlent]]</p>
			<!-- Added href instead of div.get-in -->
			<a href="[[~[[+id]]]]" title="[[+longtitle:default=`[[+pagetitle:htmlent]]`]]" class="get-in">
				<span class="price">
					<span class="trs">[[%lf_events_price:htmlent]]</span>&nbsp;[[+price:htmlent]]
				</span>
				<span class="get-into">[[%lf_events_get_in:htmlent]]</span>
			</a>
			<div class="socials">
				<div class="share">[[%lf_share]]</div>
                <div class="fb-soc ver1" data-url="[[~[[+id]]? &scheme=`full`]]" data-text="[[+longtitle:default=`[[+pagetitle:htmlent]]`]]"></div>
                <div class="tw-soc ver1" data-url="[[~[[+id]]? &scheme=`full`]]" data-text="[[+longtitle:default=`[[+pagetitle:htmlent]]`]]"></div>
			</div>
		</div>
	</div>
</div>