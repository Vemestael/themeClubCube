[[+idx:mod=`4`:is=`0`:then=`</div><div class="row">`:else=``]]
<div class="col-md-4 col-sm-4">
	<article class="blog-item">
		<div class="item-title">
			<div class="item-aside">
				<a href="[[~[[+id]]]]" title="[[+longtitle:notempty=`[[+longtitle:htmlent]]`:default=`[[+pagetitle:htmlent]]`]]" class="top-event-title">[[+pagetitle]]</a>
				<div class="top-event-place">[[+publishedon:dateAgo]]</div>
			</div>
		</div>
		[[+img:notempty=`
		<div class="blog-img">
			[[- TODO Проверить маштабируемость и подготавливать разные картинки в зависимости от разрешения ]]
			<a href="[[~[[+id]]]]" title="[[+longtitle:notempty=`[[+longtitle:htmlent]]`:default=`[[+pagetitle:htmlent]]`]]">
				<img src="[[+img:pthumb=`w=360&h=240&zc=c&f=jpg`]]" alt="[[+pagetitle:htmlent]]" title="[[+longtitle:notempty=`[[+longtitle:htmlent]]`:default=`[[+pagetitle:htmlent]]`]]" class="img-responsive">
			</a>
		</div>
		`]]
		<p>[[+introtext:html]]</p>
		<a href="[[~[[+id]]]]" title="[[+longtitle:notempty=`[[+longtitle:htmlent]]`:default=`[[+pagetitle:htmlent]]`]]" class="read-more">[[%lf_blog_item_more:htmlent]]</a>
	</article>
</div>