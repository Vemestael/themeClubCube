<div class="button-dropdown-text">
	<div class="dropdown-text-title">
		[[+weekNum:isempty=`[[%lf_events_all]]`]]
		[[+weekNum:is=`1`:then=`[[%lf_events_this_week]]`]]
		[[+weekNum:is=`2`:then=`[[%lf_events_next_week]]`]]
		[[+weekNum:gt=`2`:then=`[[+weekNum]] [[%lf_events_later_week]]`]]
	</div>
	<div class="dropdown-text-dates">[[+weekNum:notempty=`[[+startDate:date=`%d`]] [[%lf_month.[[+startDate:date=`%m`]]]] ... [[+endDate:date=`%d`]] [[%lf_month.[[+endDate:date=`%m`]]]]`]]</div>
</div>
<div class="button-dropdown-arr">
	<i></i>
</div>
<div class="hidden-dv hide" id="weeks-tab">
	<a href="[[~[[*id]]]]" class="tab-custom [[+weekNum:isempty=`pressed`]]">
		<div class="dropdown-text-title">[[%lf_events_all]]</div>
		<div class="dropdown-text-dates">[[%lf_events_all_sub]]</div>
		<div class="tab-custom-line"></div>
	</a>
	[[+output]]
</div>