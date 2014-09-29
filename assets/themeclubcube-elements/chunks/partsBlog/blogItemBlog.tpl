[[+idx:mod=`3`:is=`1`:then=`[[+idx:is=`1`:then=``:else=`</div><div class="row">`]]`:else=``]]
<div class="col-sm-4 col-md-4 col-lg-4">
	<article class="blog-item [[+img:default=`no-img`]]">
		<div class="item-title">
			<div class="item-aside">
				<h2><a href="[[~[[+id]]]]" title="[[+longtitle:default=`[[+pagetitle:htmlent]]`]]" class="top-event-title">[[+pagetitle]]</a></h2>
				<time class="top-event-place">[[+publishedon:dateAgo]]</time>
			</div>
		</div>
		[[+img:notempty=`
		<div class="blog-img">
			<a href="[[~[[+id]]]]" title="[[+longtitle:default=`[[+pagetitle:htmlent]]`]]">
                <img alt="[[+pagetitle:htmlent]]" title="[[+longtitle:default=`[[+pagetitle:htmlent]]`]]" class="img-responsive img-preload"
                     data-imgsrc="<479:[[+img:phpthumbof=`w=450&h=253&zc=1`]],
						<767:[[+img:phpthumbof=`w=354&h=199&zc=1`]],
						<899:[[+img:phpthumbof=`w=220&h=124&zc=1`]],
						>1200:[[+img:phpthumbof=`w=360&h=203&zc=1`]]"
                     src="[[-+img:pthumb=`w=360&h=172&zc=c&f=jpg`]]">
			</a>
		</div>
		`:default=`
            <div class="lines-no-img">
                <div class="part-no-img"></div>
            </div>
        `]]
		<p>[[+introtext:html]]</p>
		<a href="[[~[[+id]]]]" title="[[+longtitle:default=`[[+pagetitle:htmlent]]`]]" class="read-more">[[%lf_blog_item_more:htmlent]]</a>
	</article>
</div>
[[-+idx:mod=`3`:is=`0`:then=`<div class="clear visible-lg visible-md visible-sm"></div>`:else=``]]