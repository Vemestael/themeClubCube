<div class="">
	<article class="top-event">
		<img class="img-h-responsive img-preload" alt="[[+pagetitle:htmlent]]" title="[[+longtitle:default=`[[+pagetitle:htmlent]]`]]"
			data-imgsrc="<520:[[+img:phpthumbof=`w=464&h=330&zc=1`]],
				<800:[[+img:phpthumbof=`w=350&h=249&zc=1`]],
				<1280:[[+img:phpthumbof=`w=547&h=389&zc=1`]],
				>1900:[[+img:phpthumbof=`w=573&h=407&zc=1`]]"
			src="[[+img:pthumb=`w=394&h=398&zc=c&f=jpg`]]">
		<div class="top-event-descr">
			<div class="date-event">
				<div class="month">[[%lf_month.[[+timeStart:strtotime:date=`%m`]]]]</div>
				<div class="day">[[+timeStart:strtotime:date=`%d`]]</div>
				<div class="week-day">[[%lf_week.[[+timeStart:strtotime:date=`%w`]]]]</div>
			</div>
			<div class="item-title">
				<h3><a href="[[~[[+id]]]]" title="[[+longtitle:default=`[[+pagetitle:htmlent]]`]]" class="top-event-title">[[+pagetitle:htmlent]]</a></h3>
			</div>
			<div class="ticket-triangle-left"></div>
			<div class="ticket-triangle-right"></div>
			<div class="ticket-triangle-leftB"></div>
			<div class="ticket-triangle-rightB"></div>
		</div>
		<div class="rombus"></div>
		<div class="popup-evt">
			<div class="poput-evt-inner">
				<div class="start-row row">
					<div class="left-evt-inner">[[%lf_events_start:htmlent]]</div>
					<div class="right-evt-inner">
						[[++themeclubcube.style_events_time_format:is=`1`:then=`[[+timeStart:strtotime:date=`%I:%M %p`]]`:else=`[[+timeStart:strtotime:date=`%H:%M`]]`]]
					</div>
				</div>
				<div class="what-row row">
					<div class="left-evt-inner">[[%lf_events_lineup:htmlent]]</div>
					<div class="right-evt-inner">
						[[getImageList?
							&tpl=`@CODE:<div><span class="evt-guest">[[+name:htmlent]] </span><span class="sm-tx">([[+location:htmlent]])</span></div>`
							&tvname=`lineUp`
							&docid=`[[+id]]`
							&outputSeparator=``
						]]
					</div>
				</div>
				<div class="line-ev row">
					<div class="evt-liner"></div>
				</div>
				<div class="what-row row">
					<div class="left-evt-inner">[[%lf_events_price:htmlent]]</div>
					<div class="right-evt-inner">
						<div>[[+price:htmlent]]</div>
					</div>
				</div>
			</div>
		</div>
        <a href="[[~[[+id]]]]" title="[[+longtitle:default=`[[+pagetitle:htmlent]]`]]" class="top-event__link"></a>
	</article>
</div>