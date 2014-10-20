<div>
	<article class="gallery-default-item">
		<div class="img-cont">
			<img alt="[[+pagetitle:htmlent]]" title="[[+longtitle:htmlent:default=`[[+pagetitle:htmlent]]`]]" class="img-h-responsive img-preload"
                 data-src="<768:[[+img:phpthumbof=`w=330&h=415&zc=1`]],
					>767:[[+img:phpthumbof=`w=295&h=370&zc=1`]],
					>1199:[[+img:phpthumbof=`w=360&h=452&zc=1`]]"
                 data-src2x="<768:[[+img:phpthumbof=`w=660&h=830&zc=1`]],
                    >767:[[+img:phpthumbof=`w=590&h=740&zc=1`]],
				    >1199:[[+img:phpthumbof=`w=720&h=904&zc=1`]]"
                 src="">
		</div>
		<div class="top-gallery-title">
			<h3><a href="[[~[[+id]]]]" title="[[+longtitle:htmlent:default=`[[+pagetitle:htmlent]]`]]">[[+pagetitle:htmlent]]</a></h3>
			<hr>
	  		<time class="gallery-default-dates" datetime="[[+publishedon:date=`%Y-%m-%d %H:%M`]]">[[+publishedon:dateAgo]]</time>
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
		<a class="top-href" href="[[~[[+id]]]]" title="[[+longtitle:htmlent:default=`[[+pagetitle:htmlent]]`]]"></a>
	</article>
</div>