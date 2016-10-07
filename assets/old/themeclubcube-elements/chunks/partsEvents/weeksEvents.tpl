<a href="[[~[[*id]]]]?startDate=[[+startDate:date=`%Y-%m-%d`]]&endDate=[[+endDate:date=`%Y-%m-%d`]]" class="tab-custom [[+active:is=`1`:then=`pressed`]]">
	<div class="dropdown-text-title">
		[[+weekNum:is=`1`:then=`[[%lf_events_this_week]]`]]
		[[+weekNum:is=`2`:then=`[[%lf_events_next_week]]`]]
		[[+weekNum:gt=`2`:then=`[[+weekNum]] [[%weeks later]]`]]
	</div>
	<div class="dropdown-text-dates">[[+startDate:date=`%d`]] [[%lf_month.[[+startDate:date=`%m`]]]] ... [[+endDate:date=`%d`]] [[%lf_month.[[+endDate:date=`%m`]]]]</div>
	<div class="tab-custom-line"></div>
</a>