<div class="b-gallery__tiles">
    <div class="b-headlines b-headlines--color-a">
        <div class="container">
            <div class="b-breadcrumbs b-breadcrumbs--wht">
                <ul class="b-breadcrumbs__list x-small-txt">
                    <li><a href="/" class="link">main</a></li>
                    <li><a href="/gallery" class="link">gallery</a></li>
                    <li>[[+pagetitle]]</li>
                </ul>
            </div>
            <h1 class="b-headlines__ttl">[[+pagetitle]]</h1>
        </div>
    </div>
    <div id="GlrMagic" class="b-gallery__popup">
        [[getImageList?
            &tvname=`imgList`
            &tpl=`@CODE:<div class="col-xs-6 col-md-4 col-lg-2"><a href="/[[+image]]"><img src="/[[+imageMin]]" alt="foto-gallery"></a></div>`
        ]]
    </div>
</div>