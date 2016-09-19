<div class="c-headlines">
    <div data-stellar-background-ratio="1.2" data-bgimage="[[+img]]" class="c-headlines__img-wrap parallax bg-image"></div>
    <div class="container">
        <div class="b-breadcrumbs b-breadcrumbs--wht">
            <ul class="b-breadcrumbs__list x-small-txt">
                <li><a href="/" class="link">main</a></li>
                <li><a href="/events" class="link">events</a></li>
                <li>[[+pagetitle]]</li>
            </ul>
        </div>
        <div class="c-headlines__ttl">[[+pagetitle]]</div>
        <div class="c-headlines__date-lg">
            <!-- выбор вида шапки (eventHeaderViewType) -->
            [[+eventHeaderViewType:is=`1`:then=`
            <time datetime="[[+timeStart]]" class="date-lg"><span class="date-lg__dt">[[+timeStart:strtotime:date=`%d`]]</span><span class="date-lg__rh"><span class="date-lg__rh-m">[[%lf_month.[[+timeStart:strtotime:date=`%m`]]]] [[+timeStart:strtotime:date=`%Y`]]</span><span class="date-lg__rh-d">[[%lf_week.[[+timeStart:strtotime:date=`%w`]]]]</span><span class="date-lg__rh-t">[[+timeStart:strtotime:date=`%H`]]:[[+timeStart:strtotime:date=`%M`]] [[+timeStart:strtotime:date=`%P`]]</span></span><span class="date-lg__ad">[[+ticketPrice]]</span></time>
            `:else=`
            <div data-year="[[+timeStart:strtotime:date=`%Y`]]" data-month="[[+timeStart:strtotime:date=`%m`]]" data-day="[[+timeStart:strtotime:date=`%d`]]" data-hour="[[+timeStart:strtotime:date=`%H`]]" data-minute="[[+timeStart:strtotime:date=`%M`]]" class="b-timer"></div>
            `]]
        </div>
        <div class="hr-pattern"></div>
        <ul class="b-likes b-likes--wht c-headlines__likes">
            <li class="b-likes__pinterest-p">
                              <span>share
									<a data-pin-do="buttonBookmark" data-pin-custom="true" data-pin-lang="ru" data-pin-save="false" href="https://ru.pinterest.com/pin/create/button/">
										<svg x="0px" y="0px" viewBox="0 0 55 20.4" style="enable-background:new 0 0 55 20.4;" xml:space="preserve">
										  <path class="svg__fill" d="M53,2v16.5H10.9l-8.1-8.3L10.9,2H53 M55,0H10.1L0,10.2l10.1,10.3H55V0L55,0z"/>
										</svg>
									</a>
                              </span>
            </li>
            <li class="b-likes__google-plus">
                              <span>share
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
                              <span>share
								<a href="http://www.facebook.com/sharer.php?s=100&p[url]=[[~[[*id]] ]]&p[title]=[[+pagetitle]]&p[summary]=[[+longtitle]]" onclick="window.open(this.href, this.title, 'toolbar=0, status=0, width=548, height=325'); return false" title="Поделиться ссылкой на Фейсбук" target="_parent">
									<svg x="0px" y="0px"
                                         viewBox="0 0 55 20.4" style="enable-background:new 0 0 55 20.4;" xml:space="preserve">
									<path class="svg__fill" d="M53,2v16.5H10.9l-8.1-8.3L10.9,2H53 M55,0H10.1L0,10.2l10.1,10.3H55V0L55,0z"/>
									</svg>
								</a>
                              </span>
            </li>
        </ul>
    </div>
</div>