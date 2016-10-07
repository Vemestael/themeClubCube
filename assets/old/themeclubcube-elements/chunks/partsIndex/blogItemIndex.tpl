[[+idx:mod=`3`:is=`1`:then=`[[+idx:is=`1`:then=``:else=`</div><div class="row">`]]`:else=``]]
<div class="col-md-4 col-sm-4 col-xm-6">
	<article class="blog-item [[+img:default=`no-img`]]">
		<div class="item-title">
			<div class="item-aside">
				<h3><a href="[[~[[+id]]]]" title="[[+longtitle:htmlent:default=`[[+pagetitle:htmlent]]`]]" class="top-event-title">[[+pagetitle]]</a></h3>
				<time class="top-event-place" datetime="[[+publishedon:date=`%Y-%m-%d %H:%M`]]">[[+publishedon:dateAgo]]</time>
			</div>
		</div>
		[[+img:notempty=`
		<div class="blog-img">
			<a href="[[~[[+id]]]]" title="[[+longtitle:htmlent:default=`[[+pagetitle:htmlent]]`]]">
				<img alt="[[+pagetitle:htmlent]]" title="[[+longtitle:htmlent:default=`[[+pagetitle:htmlent]]`]]" class="img-responsive img-preload"
					data-src="<768:[[+img:phpthumbof=`w=360&h=202&zc=1`]],
						>767:[[+img:phpthumbof=`w=325&h=182&zc=1`]],
						>1199:[[+img:phpthumbof=`w=430&h=243&zc=1`]]"
                    data-src2x="<768:[[+img:phpthumbof=`w=720&h=404&zc=1`]],
						>767:[[+img:phpthumbof=`w=650&h=364&zc=1`]],
                        >1199:[[+img:phpthumbof=`w=860&h=486&zc=1`]]"
					 src="[[+img:phpthumbof=`w=360&h=202&zc=1`]]">
			</a>
		</div>
        `:default=`
            <div class="lines-no-img">
                <div class="part-no-img"></div>
            </div>
        `]]
		<p>[[+introtext:html]]</p>
		<a href="[[~[[+id]]]]" title="[[+longtitle:htmlent:default=`[[+pagetitle:htmlent]]`]]" class="read-more">[[%lf_blog_item_more:htmlent]]</a>
	</article>
</div>