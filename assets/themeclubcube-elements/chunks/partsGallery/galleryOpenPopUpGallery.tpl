<div class="b-gallery__tiles">
    <div class="b-headlines b-headlines--color-a">
        <div class="container">
            <div class="b-breadcrumbs b-breadcrumbs--wht">
                <ul class="b-breadcrumbs__list x-small-txt">
                    <li><a href="/" class="link">main</a></li>
                    <li><a href="/gallery" class="link">gallery</a></li>
                    <li>[[*pagetitle]]</li>
                </ul>
            </div>
            <h1 class="b-headlines__ttl">[[*pagetitle]]</h1>
        </div>
    </div>
    <div id="GlrMagic" class="b-gallery__popup">
        [[getImageList?
            &tvname=`imgList`
            &tpl=`@CODE:<div class="col-xs-6 col-md-4 col-lg-2"><a href="/[[+image]]"><img src="/[[+imageMin]]" alt="foto-gallery"></a></div>`
        ]]
    </div>
</div>
<div class="b-gallery__border">
    <div class="container">
        <ul class="c-box__views">
            <li class="c-box__view txt">[[+total]]</li>
            <li class="c-box__video txt">2</li>
        </ul>
        <ul class="b-likes b-likes--wht">
            <li class="b-likes__heading">share:</li>
            <li class="b-likes__facebook">
                              <span>share
								<a href="http://www.facebook.com/sharer.php?s=100&p[url]=[[~[[*id]] ]]&p[title]=[[*pagetitle]]&p[summary]=[[*longtitle]]" onclick="window.open(this.href, this.title, 'toolbar=0, status=0, width=548, height=325'); return false" title="Поделиться ссылкой на Фейсбук" target="_parent">
									<svg x="0px" y="0px"
                                         viewBox="0 0 55 20.4" style="enable-background:new 0 0 55 20.4;" xml:space="preserve">
									<path class="svg__fill" d="M53,2v16.5H10.9l-8.1-8.3L10.9,2H53 M55,0H10.1L0,10.2l10.1,10.3H55V0L55,0z"/>
									</svg>
								</a>
                              </span>
            </li>
            <li class="b-likes__pinterest-p">
                              <span>share
									<a data-pin-do="buttonBookmark" data-pin-custom="true" data-pin-lang="ru" data-pin-save="false" href="https://ru.pinterest.com/pin/create/button/">
										<svg x="0px" y="0px" viewBox="0 0 55 20.4" style="enable-background:new 0 0 55 20.4;" xml:space="preserve">
										  <path class="svg__fill" d="M53,2v16.5H10.9l-8.1-8.3L10.9,2H53 M55,0H10.1L0,10.2l10.1,10.3H55V0L55,0z"/>
										</svg>
									</a>
                              </span>
            </li>
        </ul>
    </div>
</div>
<div class="b-scroll">
    <div id="scrlBtnGlr" class="btn-pointer-b__wrap">
        <span class="btn-pointer-b"><b>About this event</b></span>
        <svg class="left" x="0px" y="0px" viewBox="0 0 5 50" enable-background="new 0 0 5 50" xml:space="preserve">
          <path fill="#000000" d="M5.0001,49.0002H0V33.8014l4.4054-4.4053L0,24.9905v-0.9612l4.4054-4.4051L0,15.2184V0h5.0001V49.0002z"/>
          </svg>

          <svg class="right" x="0px" y="0px" viewBox="0 0 5 50" enable-background="new 0 0 5 50" xml:space="preserve">
          <path fill="#000000" d="M0,0l5.0001,0v15.1988l-4.4054,4.4053l4.4054,4.4056v0.9612L0.5947,29.376l4.4054,4.4058v15.2184H0L0,0z"/>
          </svg>

    </div>
</div>