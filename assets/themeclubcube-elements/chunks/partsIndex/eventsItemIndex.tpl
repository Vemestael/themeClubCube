[[+idx:mod=`4`:is=`0`:then=`</div><div class="rows default-tickets">`:else=``]]
<article class="ticket-event">
	<div class="ticket-event-date">
		<div class="date-event">
			<div class="month">[[%lf_month.[[+timeStart:strtotime:date=`%m`]]]]</div>
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
	<div class="ticket-event-img img-contain">
		<img class="img-responsive img-preload" alt="[[+pagetitle:htmlent]]" title="[[+longtitle:notempty=`[[+longtitle:htmlent]]`:default=`[[+pagetitle:htmlent]]`]]"
			data-imgsrc="<520:[[+img:phpthumbof=`w=464&h=330&zc=1`]],
				<800:[[+img:phpthumbof=`w=350&h=249&zc=1`]],
				<1280:[[+img:phpthumbof=`w=547&h=389&zc=1`]],
				>1900:[[+img:phpthumbof=`w=573&h=407&zc=1`]]"
			src="[[+img:pthumb=`w=359&h=179&zc=c&f=jpg`]]">
		<div class="ticket-triangle-top"></div>
		<div class="ticket-triangle-bt"></div>
		<div class="rombs"></div>
	</div>
	<div class="ticket-event-lineup">
		<h2><a href="[[~[[+id]]]]" title="[[+longtitle:notempty=`[[+longtitle:htmlent]]`:default=`[[+pagetitle:htmlent]]`]]">[[+pagetitle:htmlent]]</a></h2>
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