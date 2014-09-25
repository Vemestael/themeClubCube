[[+idx:mod=`4`:is=`1`:then=`[[+idx:is=`1`:then=``:else=`</div><div class="clear-mard clearfix visible-lg"></div><div class="row">`]]`:esle=``]]
<div class="col-lg-3 col-md-6 col-xs-12 col-sm-6 gall-item">
	<div class="img-gal">
		<a href="[[~[[+id]]]]" title="[[+longtitle:default=`[[+pagetitle:htmlent]]`]]" class="img-overfl">
			<img alt="[[+pagetitle:htmlent]]" title="[[+longtitle:default=`[[+pagetitle:htmlent]]`]]" class="img-responsive img-preload"
				data-imgsrc="<520:[[+img:phpthumbof=`w=464&h=330&zc=1`]],
					<800:[[+img:phpthumbof=`w=350&h=249&zc=1`]],
					<1280:[[+img:phpthumbof=`w=547&h=389&zc=1`]],
					>1900:[[+img:phpthumbof=`w=573&h=407&zc=1`]]"
				src="[[+img:pthumb=`w=261&h=263&zc=c&f=jpg`]]">
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