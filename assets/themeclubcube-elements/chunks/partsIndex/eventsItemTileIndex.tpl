[[+idx:mod=`4`:is=`0`:then=`</div></div><div class="top-evt-slide"><div class="row">`:else=``]]
<div class="col-lg-4 col-md-4 col-sm-4">
	<article class="top-event">
		<img class="img-h-responsive" src="[[+img:pthumb=`w=394&h=398&zc=c&f=jpg`]]" alt="[[+pagetitle:htmlent]]" title="[[+longtitle:notempty=`[[+longtitle:htmlent]]`:default=`[[+pagetitle:htmlent]]`]]">
		<div class="top-event-descr">
			<div class="date-event">
				<div class="month">[[%lf_month.[[+publishedon:date=`%m`]]]]</div>
				<div class="day">[[+publishedon:date=`%d`]]</div>
				<div class="week-day">[[%lf_week.[[+publishedon:date=`%w`]]]]</div>
			</div>
			<div class="item-title">
				<a href="[[~[[+id]]]]" title="[[+longtitle:notempty=`[[+longtitle:htmlent]]`:default=`[[+pagetitle:htmlent]]`]]" class="top-event-title">[[+pagetitle:htmlent]]</a>
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
						[[- TODO разобраться с отображением времени в 12ти часовом формате
						++themeclubcube.style_events_time_format:is=`1`:then=`[[+timeStart:date=`%h %a`]]`:else=`[[+timeStart:date=`%H:%i`]]`]]
						[[+timeStart:date=`%H:%i`]]
					</div>
				</div>
				<div class="what-row row">
					<div class="left-evt-inner">[[%lf_events_lineup:htmlent]]</div>
					<div class="right-evt-inner">
						[[getImageList?
							&tpl=`@INLINE:<div><span class="evt-guest">[[+name]] </span><span class="sm-tx">([[+location]])</span></div>`
							&tvname=`Price`
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
						<div>[[+price]]</div>
					</div>
				</div>
			</div>
		</div>
	</article>
</div>