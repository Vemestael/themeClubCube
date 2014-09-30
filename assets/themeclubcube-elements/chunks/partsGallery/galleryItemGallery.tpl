[[+idx:mod=`4`:is=`1`:then=`[[+idx:is=`1`:then=``:else=`</div><div class="clear-mard clearfix visible-lg"></div><div class="row">`]]`:esle=``]]
<div class="col-lg-3 col-md-6 col-xs-12 col-xm-6 col-sm-6 gall-item">
	<div class="img-gal">
		<a href="[[~[[+id]]]]" title="[[+longtitle:default=`[[+pagetitle:htmlent]]`]]" class="img-overfl">
            <img alt="[[+pagetitle:htmlent]]" title="[[+longtitle:default=`[[+pagetitle:htmlent]]`]]" class="img-responsive img-preload"
                 data-imgsrc="<479:[[+img:phpthumbof=`w=450&h=253&zc=1`]],
					<767:[[+img:phpthumbof=`w=354&h=199&zc=1`]],
					<899:[[+img:phpthumbof=`w=245&h=143&zc=1`]],
					>1200:[[+img:phpthumbof=`w=313&h=176&zc=1`]]"
                 src="[[-+img:pthumb=`w=261&h=263&zc=c&f=jpg`]]">
		</a>
		<div class="bord-fr"></div>
		<div class="bord-sc"></div>
	</div>
	<div class="item-title">
		<div class="item-aside">
			<h3><a href="[[~[[+id]]]]" title="[[+longtitle:default=`[[+pagetitle:htmlent]]`]]" class="top-event-title">[[+pagetitle:htmlent]] - [[+idx:mod=`4`]]</a></h3>
			<time class="top-event-place">[[+publishedon:dateAgo]]</time>
		</div>
		[[getImageList?
            &tpl=`@CODE: `
			&tvname=`gallery`
			&docid=`[[+id]]`
			&outputSeparator=``
		]]
		<div class="item-icons">
			<div class="icon-row">
				<div class="pict-sm photo-cm"></div>
				<span>[[+total]]</span>
			</div>
		</div>
	</div>
</div>