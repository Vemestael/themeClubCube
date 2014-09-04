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
				<img alt="[[+pagetitle:htmlent]]" title="[[+longtitle:notempty=`[[+longtitle:htmlent]]`:default=`[[+pagetitle:htmlent]]`]]" class="img-responsive img-preload"
					data-imgsrc="<520:[[+img:phpthumbof=`w=464&h=330&zc=1`]],
						<800:[[+img:phpthumbof=`w=350&h=249&zc=1`]],
						<1280:[[+img:phpthumbof=`w=547&h=389&zc=1`]],
						>1900:[[+img:phpthumbof=`w=573&h=407&zc=1`]]"
					 src="[[+img:pthumb=`w=360&h=172&zc=c&f=jpg`]]">
			</a>
		</div>
		`]]
		<p>[[+introtext:html]]</p>
		<a href="[[~[[+id]]]]" title="[[+longtitle:notempty=`[[+longtitle:htmlent]]`:default=`[[+pagetitle:htmlent]]`]]" class="read-more">[[%lf_blog_item_more:htmlent]]</a>
	</article>
</div>