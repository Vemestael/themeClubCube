<div class="col-lg-12">
    <div class="content-main__side-header">[[%lf_events_more_head:htmlent]]</div>
</div>
<div class="row null-m">
[[pdoResources@asideEvents?
    &parents=`[[++themeclubcube.events_resource]]`
    &includeTVs=`img,timeStart,price,lineUp,topEvent`
    &processTVs=`img`
    &tvPrefix=``
    &tpl=`eventsItemAsideCenterCommon`
    &tvFilters=`timeStart>=[[getDate? &format=`Y-m-d 00:00:00`]],topEvent==1`
]]
</div>