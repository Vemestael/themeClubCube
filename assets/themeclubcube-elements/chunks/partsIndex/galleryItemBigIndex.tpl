[[+idx:mod=`4`:is=`0`:then=`</div><div class="slide-gall-item"><div class="row">`:else=``]]
<div class="col-md-4 col-sm-4">
	<article class="gallery-default-item">
		<div class="img-cont">
			<img alt="[[+pagetitle:htmlent]]" title="[[+longtitle:default=`[[+pagetitle:htmlent]]`]]" class="img-h-responsive img-preload"
				data-imgsrc="<520:[[+img:phpthumbof=`w=464&h=330&zc=1`]],
					<800:[[+img:phpthumbof=`w=350&h=249&zc=1`]],
					<1280:[[+img:phpthumbof=`w=547&h=389&zc=1`]],
					>1900:[[+img:phpthumbof=`w=573&h=407&zc=1`]]"
				src="[[+img:pthumb=`w=360&h=452&zc=c&f=jpg`]]" >
		</div>
		<div class="top-gallery-title">
			<h3><a href="[[~[[+id]]]]" title="[[+longtitle:default=`[[+pagetitle:htmlent]]`]]">[[+pagetitle:htmlent]]</a></h3>
			<hr>
	  		<time class="gallery-default-dates">[[+publishedon:dateAgo]]</time>
		</div>
        [[getImageList?
			&tpl=`@CODE: `
			&tvname=`gallery`
			&docid=`[[+id]]`
			&outputSeparator=``
		]]
		<div class="bottom">
			<div class="pull-left item-img">
				<div class="photo-c"></div>
				<div class="">[[+total]]</div>
			</div>
		</div>
		<div class="bord-fr"></div>
		<div class="bord-sc"></div>
		<a class="top-href" href="[[~[[+id]]]]" title="[[+longtitle:default=`[[+pagetitle:htmlent]]`]]"></a>
	</article>
</div>