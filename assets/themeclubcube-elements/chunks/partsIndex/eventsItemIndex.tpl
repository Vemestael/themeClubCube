[[+idx:mod=`3`:is=`1`:then=`[[+idx:is=`1`:then=``:else=`</div><div class="rows default-tickets">`]]`:else=``]]
<article class="ticket-event">
	<div class="ticket-event-date">
		<div class="date-event">
			<div class="month">[[%lf_month_short.[[+timeStart:strtotime:date=`%m`]]]]</div>
			<div class="day">[[+timeStart:strtotime:date=`%d`]]</div>
			<div class="week-day">[[%lf_week.[[+timeStart:strtotime:date=`%w`]]]]</div>
		</div>
		<div class="line-mg"></div>
		<div class="date-event last">
			<div class="month">[[%lf_events_start:htmlent]]</div>
			<div class="day time-ev">
				[[++themeclubcube.style_events_time_format:is=`1`:then=`[[+timeStart:strtotime:date=`%I:%M %p`]]`:else=`[[+timeStart:strtotime:date=`%H:%M`]]`]]
			</div>
		</div>
		<div class="ticket-triangle-top"></div>
		<div class="ticket-triangle-bt"></div>
		<div class="rombs"></div>
	</div>
	<a href="[[~[[+id]]]]" title="[[+longtitle:htmlent:default=`[[+pagetitle:htmlent]]`]]" class="ticket-event-img img-contain">
		<img class="img-responsive img-preload" alt="[[+pagetitle:htmlent]]" title="[[+longtitle:htmlent:htmlent:default=`[[+pagetitle:htmlent]]`]]"
            data-src=">0:[[+img:phpthumbof=`w=360&h=190&zc=1`]]"
            data-src2x=">0:[[+img:phpthumbof=`w=720&h=380&zc=1`]]"
			src="">
		<div class="ticket-triangle-top"></div>
		<div class="ticket-triangle-bt"></div>
		<div class="rombs"></div>
	</a>
	<div class="ticket-event-lineup">
		<h3><a href="[[~[[+id]]]]" title="[[+longtitle:htmlent:default=`[[+pagetitle:htmlent]]`]]">[[+pagetitle:htmlent]] - [[+total]] - [[+idx]]</a></h3>
		<hr>
		<div class="ticket-line-cont">
			<div class="ticket-line-up sh">
				<div class="col-md-2 col-sm-2">[[%lf_events_lineup:htmlent]]</div>
				<div class="col-md-10 col-sm-10 uppercase">
					<p>
						[[getImageList?
							&tpl=`@CODE:<span class="brown-color">[[+name:htmlent]]</span> ([[+location:htmlent]]) / `
							&tvname=`lineUp`
							&docid=`[[+id]]`
							&outputSeparator=``
                            &limit=`5`
						]]
					</p>
				</div>
			</div>
			<div class="ticket-line-up hid">
				<div class="col-md-2 col-sm-2">[[%lf_events_about]]</div>
				<div class="col-md-10 col-sm-10">
					<p class="ticket-text">[[+introtext:htmlent]]</p>
				</div>
			</div>
		</div>
		<div class="ticket-triangle-top"></div>
		<div class="ticket-triangle-bt"></div>
		<div class="rombs"></div>
	</div>
	<div class="ticket-event-price">
		<div class="ticket-price uppercase"><span class="hidden-xs hidden-sm">[[%lf_events_price:htmlent]]<br></span><span class="ticket-doll uppercase">[[+price:htmlent]]</span></div>
		<div class="ticket-arrow-right"></div>
		<div class="ticket-triangle-top"></div>
		<div class="ticket-triangle-bt"></div>
		<div class="ticket-triangle-top last"></div>
		<div class="ticket-triangle-bt last"></div>
	</div>
</article>