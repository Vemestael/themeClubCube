[[+idx:mod=`4`:is=`1`:then=`[[+idx:is=`1`:then=``:else=`</div><div class="clear-mard clearfix visible-lg"></div><div class="row">`]]`:esle=``]]
<div class="col-lg-3 col-md-6 col-xs-12 col-xm-6 col-sm-6 gall-item">
	<div class="img-gal">
		<a href="[[~[[+id]]]]" title="[[+longtitle:default=`[[+pagetitle:htmlent]]`]]" class="img-overfl">
            <img alt="[[+pagetitle:htmlent]]" title="[[+longtitle:default=`[[+pagetitle:htmlent]]`]]" class="img-responsive img-preload"
                 data-src="<768:[[+img:phpthumbof=`w=360&h=202&zc=1`]],
					>767:[[+img:phpthumbof=`w=485&h=272&zc=1`]],
					>1199:[[+img:phpthumbof=`w=360&h=202&zc=1`]]"
                 data-src2x="<768:[[+img:phpthumbof=`w=720&h=404&zc=1`]],
                    >767:[[+img:phpthumbof=`w=970&h=544&zc=1`]],
				    >1199:[[+img:phpthumbof=`w=720&h=404&zc=1`]]"
                 src="">
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