<div>
	<article class="gallery-default-item">
		<div class="img-cont">
			<img alt="[[+pagetitle:htmlent]]" title="[[+longtitle:default=`[[+pagetitle:htmlent]]`]]" class="img-h-responsive img-preload"
				data-imgsrc="<479:[[+img:phpthumbof=`w=450&h=253&zc=1`]],
					<768:[[+img:phpthumbof=`w=355&h=300&zc=1`]],
					>1200:[[+img:phpthumbof=`w=360&h=462&zc=1`]]"
				src="[[-+img:pthumb=`w=360&h=452&zc=c&f=jpg`]]" >
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