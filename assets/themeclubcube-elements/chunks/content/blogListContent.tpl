<div class="page-header">
	<h1>[[*pagetitle]]</h1>
</div>
<div class="row">
	[[!pdoPage@listResources?
		&parents=`[[*id]]`
		&includeTVs=`img`
		&processTVs=`img`
		&tvPrefix=``
		&tpl=`itemIndex`
		&tplPageWrapper=`@INLINE <ul class="pagination">[[+first]][[+prev]][[+pages]][[+next]][[+last]]</ul>`
	]]
</div>
[[*content]]