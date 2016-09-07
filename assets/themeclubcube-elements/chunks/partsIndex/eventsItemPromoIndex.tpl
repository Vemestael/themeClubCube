[[+viewType:is=`a`:then=`
<div class="main-slide__item-a">
  <div data-bgimage="[[+img]]" class="main-slide__img-wrap bg-image"></div>
  <div class="container">
    <div class="main-slide__item-inr">
      <h1 class="main-slide__s1-ttl main-slide__s1-ttl--indent">[[+pagetitle]]</h1>
      <div class="main-slide__date-wrap">
        <time datetime="[[+timeStart]]" class="date-lg"><span class="date-lg__dt">[[+timeStart:strtotime:date=`%d`]]</span><span class="date-lg__rh"><span class="date-lg__rh-m">[[%lf_month.[[+timeStart:strtotime:date=`%m`]]]] [[+timeStart:strtotime:date=`%Y`]]</span><span class="date-lg__rh-d">[[%lf_week.[[+timeStart:strtotime:date=`%w`]]]]</span><span class="date-lg__rh-t">[[+timeStart:strtotime:date=`%H`]]:[[+timeStart:strtotime:date=`%M`]] [[+timeStart:strtotime:date=`%P`]]</span></span></time>
      </div>
      <hr class="hr-pattern">
      <h2 class="main-slide__s2-ttl">[[+longtitle]]</h2>
      <p>
        [[+description]]
      </p>
      <div class="main-slide__footer">
        <ul class="b-likes b-likes--wht b-likes--indent">
          <li class="b-likes__pinterest-p">
                              <span>[[!getSocialShare? &sw=`pinterest`]]
									<a data-pin-do="buttonBookmark" data-pin-custom="true" data-pin-lang="ru" data-pin-save="false" href="https://ru.pinterest.com/pin/create/button/">
										<svg x="0px" y="0px" viewBox="0 0 55 20.4" style="enable-background:new 0 0 55 20.4;" xml:space="preserve">
										  <path class="svg__fill" d="M53,2v16.5H10.9l-8.1-8.3L10.9,2H53 M55,0H10.1L0,10.2l10.1,10.3H55V0L55,0z"/>
										</svg>
									</a>
                              </span>
          </li>
          <li class="b-likes__google-plus">
                              <span>[[!getSocialShare? &sw=`googleplus`]]
								<a href="https://plus.google.com/share?url=[[~[[*id]] ]]" onclick="javascript:window.open(this.href,
  '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
									<svg x="0px" y="0px"
                       viewBox="0 0 55 20.4" style="enable-background:new 0 0 55 20.4;" xml:space="preserve">
									<path class="svg__fill" d="M53,2v16.5H10.9l-8.1-8.3L10.9,2H53 M55,0H10.1L0,10.2l10.1,10.3H55V0L55,0z"/>
									</svg>
								</a>
                              </span>
          </li>
          <li class="b-likes__facebook">
                              <span>[[!getSocialShare? &sw=`facebook`]]
								<a href="http://www.facebook.com/sharer.php?s=100&p[url]=[[~[[*id]] ]]&p[title]=[[+pagetitle]]&p[summary]=[[+longtitle]]" onclick="window.open(this.href, this.title, 'toolbar=0, status=0, width=548, height=325'); return false" title="Поделиться ссылкой на Фейсбук" target="_parent">
									<svg x="0px" y="0px"
                       viewBox="0 0 55 20.4" style="enable-background:new 0 0 55 20.4;" xml:space="preserve">
									<path class="svg__fill" d="M53,2v16.5H10.9l-8.1-8.3L10.9,2H53 M55,0H10.1L0,10.2l10.1,10.3H55V0L55,0z"/>
									</svg>
								</a>
                              </span>
          </li>
        </ul>
        <div class="main-slide__link-wrap"><a href="[[~[[+id]]]]" class="btn btn-info btn-anim-a">
            <span>free</span>
            <span><svg x="0px" y="0px"
                       viewBox="0 0 10 50" style="enable-background:new 0 0 10 50;" xml:space="preserve">
                  <path class="st0" fill="#A82743" d="M10,50H0l5-5l-5-5l0,0v0l0,0l5-5l-5-5l0,0v0l0,0l5-5l-5-5l0,0v0l0,0l5-5l-5-5l0,0v0l0,0l5-5L0,0l0,0v0h10V50z"/></svg>
                   <b>read more</b></span></a></div>
      </div>
    </div>
  </div>
</div>
`]]
[[+viewType:is=`b`:then=`
<div class="main-slide__item-b">
  <div class="main-slide__bg-wrap bg-grdnt"></div>
  <div class="container">
    <div class="main-slide__item-inr">
      <h1 class="main-slide__s1-ttl">[[+pagetitle]]</h1>
      <hr class="hr-pattern">
      <h2 class="main-slide__s2-ttl">[[+longtitle]]</h2>
      <p>
        [[+description]]
      </p>
      <div class="main-slide__footer">
        <ul class="b-likes b-likes--wht b-likes--indent">
          <li class="b-likes__pinterest-p">
                              <span>[[!getSocialShare? &sw=`pinterest`]]
									<a data-pin-do="buttonBookmark" data-pin-custom="true" data-pin-lang="ru" data-pin-save="false" href="https://ru.pinterest.com/pin/create/button/">
										<svg x="0px" y="0px" viewBox="0 0 55 20.4" style="enable-background:new 0 0 55 20.4;" xml:space="preserve">
										  <path class="svg__fill" d="M53,2v16.5H10.9l-8.1-8.3L10.9,2H53 M55,0H10.1L0,10.2l10.1,10.3H55V0L55,0z"/>
										</svg>
									</a>
                              </span>
          </li>
          <li class="b-likes__google-plus">
                              <span>[[!getSocialShare? &sw=`googleplus`]]
								<a href="https://plus.google.com/share?url=[[~[[*id]] ]]" onclick="javascript:window.open(this.href,
  '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
									<svg x="0px" y="0px"
                       viewBox="0 0 55 20.4" style="enable-background:new 0 0 55 20.4;" xml:space="preserve">
									<path class="svg__fill" d="M53,2v16.5H10.9l-8.1-8.3L10.9,2H53 M55,0H10.1L0,10.2l10.1,10.3H55V0L55,0z"/>
									</svg>
								</a>
                              </span>
          </li>
          <li class="b-likes__facebook">
                              <span>[[!getSocialShare? &sw=`facebook`]]
								<a href="http://www.facebook.com/sharer.php?s=100&p[url]=[[~[[*id]] ]]&p[title]=[[+pagetitle]]&p[summary]=[[+longtitle]]" onclick="window.open(this.href, this.title, 'toolbar=0, status=0, width=548, height=325'); return false" title="Поделиться ссылкой на Фейсбук" target="_parent">
									<svg x="0px" y="0px"
                       viewBox="0 0 55 20.4" style="enable-background:new 0 0 55 20.4;" xml:space="preserve">
									<path class="svg__fill" d="M53,2v16.5H10.9l-8.1-8.3L10.9,2H53 M55,0H10.1L0,10.2l10.1,10.3H55V0L55,0z"/>
									</svg>
								</a>
                              </span>
          </li>
        </ul>
        <div class="main-slide__link-wrap">
          <div class="btn-pointer__wrap">
            <a class="btn btn-pointer btn-pointer--lg btn-anim-a" href="[[~[[+id]]]]"><b>More</b></a>
            <svg class="btn-pointer__left" x="0px" y="0px"
                 viewBox="0 0 10 50" style="enable-background:new 0 0 10 50;" xml:space="preserve">
                  <path fill="#A82743" d="M10,50H0l5-5l-5-5l0,0v0l0,0l5-5l-5-5l0,0v0l0,0l5-5l-5-5l0,0v0l0,0l5-5l-5-5l0,0v0l0,0l5-5L0,0l0,0v0h10V50z"/></svg>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
`]]
[[+viewType:is=`c`:then=`
<div class="main-slide__item-b">
  <div class="main-slide__bg-wrap bg-grdnt"></div>
  <div class="container">
    <div class="main-slide__item-inr">
      <h1 class="main-slide__s1-ttl">[[+pagetitle]]</h1>
      <hr class="hr-pattern">
      <div data-year="[[+timeStart:strtotime:date=`%Y`]]" data-month="[[+timeStart:strtotime:date=`%m`]]" data-day="[[+timeStart:strtotime:date=`%d`]]" data-hour="[[+timeStart:strtotime:date=`%H`]]" data-minute="[[+timeStart:strtotime:date=`%M`]]" class="b-timer"></div>
      <div class="main-slide__footer">
        <ul class="b-likes b-likes--wht b-likes--indent">
          <li class="b-likes__pinterest-p">
                              <span>[[!getSocialShare? &sw=`pinterest`]]
									<a data-pin-do="buttonBookmark" data-pin-custom="true" data-pin-lang="ru" data-pin-save="false" href="https://ru.pinterest.com/pin/create/button/">
										<svg x="0px" y="0px" viewBox="0 0 55 20.4" style="enable-background:new 0 0 55 20.4;" xml:space="preserve">
										  <path class="svg__fill" d="M53,2v16.5H10.9l-8.1-8.3L10.9,2H53 M55,0H10.1L0,10.2l10.1,10.3H55V0L55,0z"/>
										</svg>
									</a>
                              </span>
          </li>
          <li class="b-likes__google-plus">
                              <span>[[!getSocialShare? &sw=`googleplus`]]
								<a href="https://plus.google.com/share?url=[[~[[*id]] ]]" onclick="javascript:window.open(this.href,
  '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
									<svg x="0px" y="0px"
                       viewBox="0 0 55 20.4" style="enable-background:new 0 0 55 20.4;" xml:space="preserve">
									<path class="svg__fill" d="M53,2v16.5H10.9l-8.1-8.3L10.9,2H53 M55,0H10.1L0,10.2l10.1,10.3H55V0L55,0z"/>
									</svg>
								</a>
                              </span>
          </li>
          <li class="b-likes__facebook">
                              <span>[[!getSocialShare? &sw=`facebook`]]
								<a href="http://www.facebook.com/sharer.php?s=100&p[url]=[[~[[*id]] ]]&p[title]=[[+pagetitle]]&p[summary]=[[+longtitle]]" onclick="window.open(this.href, this.title, 'toolbar=0, status=0, width=548, height=325'); return false" title="Поделиться ссылкой на Фейсбук" target="_parent">
									<svg x="0px" y="0px"
                       viewBox="0 0 55 20.4" style="enable-background:new 0 0 55 20.4;" xml:space="preserve">
									<path class="svg__fill" d="M53,2v16.5H10.9l-8.1-8.3L10.9,2H53 M55,0H10.1L0,10.2l10.1,10.3H55V0L55,0z"/>
									</svg>
								</a>
                              </span>
          </li>
        </ul>
        <div class="main-slide__link-wrap">
          <div class="btn-pointer__wrap">
            <a class="btn btn-pointer btn-pointer--lg btn-anim-a" href="[[~[[+id]]]]"><b>More</b></a>
            <svg class="btn-pointer__left" x="0px" y="0px" viewBox="0 0 10 50" style="enable-background:new 0 0 10 50;" xml:space="preserve">
                  <path fill="#A82743" d="M10,50H0l5-5l-5-5l0,0v0l0,0l5-5l-5-5l0,0v0l0,0l5-5l-5-5l0,0v0l0,0l5-5l-5-5l0,0v0l0,0l5-5L0,0l0,0v0h10V50z"/></svg>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
`]]
