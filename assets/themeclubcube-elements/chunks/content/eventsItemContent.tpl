<section class="fullwidth-bg event-view ">
	[[*img:notempty=`
		<img src="[[*img:pthumb=`w=1900&h=338&zc=c&f=jpg&fltr[]=blur|55`]]" class="img-responsive img-preload" alt="[[+pagetitle:htmlent]]" title="[[+longtitle:default=`[[+pagetitle:htmlent]]`]]">
	`]]
	<div class="pattern"></div>
	<div class="container z-top">
		<div class="row">
			<div class="col-md-8 col-sm-8">
				<h1 class="event-h1 text-left">[[*pagetitle:htmlent]]</h1>
			</div>
			<div class="col-md-4 col-sm-4"><div class="event-about view-evt">
					<div class="date">
						<div class="month">[[%lf_month.[[*timeStart:strtotime:date=`%m`]]]]</div>
						<div class="day">[[*timeStart:strtotime:date=`%d`]]</div>
						<div class="year">[[%lf_week.[[*timeStart:strtotime:date=`%w`]]]]</div>
					</div>
					<div class="col-lg-6 col-sm-7">
						<h1 class="slider-heading event-h1 text-left">
							<span class="trs">[[%lf_events_start:htmlent]]</span><br>
							[[++themeclubcube.style_events_time_format:is=`1`:then=`[[*timeStart:strtotime:date=`%I:%M %p`]]`:else=`[[*timeStart:strtotime:date=`%H:%M`]]`]]
						</h1>
					</div>
				</div></div>
		</div>
	</div>
</section>
<div class="main-content">
	<div class="container text-contain">
		<div class="row">
			<main class="col-lg-8 col-md-12 col-sm-12 content-main">
				<div class="content-page">
					<div class="line-up z-top event-line-up">
						<div class="top-line-up">
							<span class="line-up-title pull-left">[[%lf_events_lineup:htmlent]]</span>
							<span class="line-up-title pull-right">[[%lf_events_price:htmlent]] <span class="wh-text">[[*price:htmlent]]</span></span>
						</div>
						<div class="bottom-line-up">
							<div class="pull-left col-md-8 col-sm-8 line-up-guests">
								<ul>
									[[getImageList?
										&tpl=`@CODE:<li><div class="wh-text">[[+name:htmlent]]</div><div class="under-descr">[[+location:htmlent]]</div></li>`
										&tvname=`lineUp`
										&docid=`[[*id]]`
										&outputSeparator=``
									]]
								</ul>
							</div>
							[[-<div class="pull-right col-md-4 col-sm-4 text-right line-up-contacts">
								<ul>
									<li><i class="letter-img-white"></i><a href="mailto:tickets@cumeclub.com" class="border-bottom">tickets@cumeclub.com</a></li>
									<li><span class="pull-right"><i class="phone-img-white"></i>(096) 977-60-11</span></li>
								</ul>
							</div>]]
						</div>
						<div class="line-up-arrow"></div>
						<div class="empt">
							<div class="socials brown-sc pull-right">
								<div class="share">[[%lf_share]]</div>
                                <div class="fb-soc ver2" data-url="[[~[[*id]]? &scheme=`full`]]" data-text="[[*longtitle:default=`[[*pagetitle:htmlent]]`]]"></div>
                                <div class="tw-soc ver2" data-url="[[~[[*id]]? &scheme=`full`]]" data-text="[[*longtitle:default=`[[*pagetitle:htmlent]]`]]"></div>
							</div>
						</div>
					</div>
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