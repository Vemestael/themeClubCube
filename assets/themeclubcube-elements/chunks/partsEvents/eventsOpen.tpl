<div class="c-headlines">
    <div data-stellar-background-ratio="1.2" data-bgimage="[[+img]]" class="c-headlines__img-wrap parallax bg-image"></div>
    <div class="container">
        <div class="b-breadcrumbs b-breadcrumbs--wht">
            <ul class="b-breadcrumbs__list x-small-txt">
                <li><a href="index.html" class="link">main</a></li>
                <li><a href="events.html" class="link">events</a></li>
                <li>Private house party</li>
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
              <span>457
              <svg x="0px" y="0px"
                   viewBox="0 0 55 20.4" style="enable-background:new 0 0 55 20.4;" xml:space="preserve">
              <path class="svg__fill" d="M53,2v16.5H10.9l-8.1-8.3L10.9,2H53 M55,0H10.1L0,10.2l10.1,10.3H55V0L55,0z"/>
              </svg>
              </span>
            </li>
            <li class="b-likes__google-plus">
              <span>457
              <svg x="0px" y="0px"
                   viewBox="0 0 55 20.4" style="enable-background:new 0 0 55 20.4;" xml:space="preserve">
              <path class="svg__fill" d="M53,2v16.5H10.9l-8.1-8.3L10.9,2H53 M55,0H10.1L0,10.2l10.1,10.3H55V0L55,0z"/>
              </svg>
              </span>
            </li>
            <li class="b-likes__twitter">
              <span>457
              <svg x="0px" y="0px"
                   viewBox="0 0 55 20.4" style="enable-background:new 0 0 55 20.4;" xml:space="preserve">
              <path class="svg__fill" d="M53,2v16.5H10.9l-8.1-8.3L10.9,2H53 M55,0H10.1L0,10.2l10.1,10.3H55V0L55,0z"/>
              </svg>
              </span>
            </li>
            <li class="b-likes__facebook">
              <span>1.45K
              <svg x="0px" y="0px"
                   viewBox="0 0 55 20.4" style="enable-background:new 0 0 55 20.4;" xml:space="preserve">
              <path class="svg__fill" d="M53,2v16.5H10.9l-8.1-8.3L10.9,2H53 M55,0H10.1L0,10.2l10.1,10.3H55V0L55,0z"/>
              </svg>
              </span>

            </li>
        </ul>
    </div>
</div>
<div class="b-content container">
    <div class="b-panel-t col-xs-12">
        <ul class="b-panel-t__list b-panel-t__arts col-sm-8">
            [[getImageList?
                &tvname=`migxEventArtist`
                &tpl=`artistItemEvents`
            ]]
        </ul>
        <ul class="b-panel-t__list col-sm-4">
            <li><a href="mailto:[[+contactEmail]]" class="link">[[+contactEmail]]</a></li>
            <li class="tel"><a href="tel:[[+contactNumber]]" class="link">[[+contactNumber]]</a></li>
        </ul>
    </div>
    <div class="row">
        <main class="b-main content b-blog-inr col-sm-8 col-lg-7">
            <div class="txt-intro">
                <p>
                    [[+introtext]]
                </p>
            </div>

            <!-- видосик -->

            <div class="main-video">
                <div class="main-video__iframe-wrap">
                    <iframe src="https://player.vimeo.com/video/140230038?title=0&amp;byline=0&amp;portrait=0" allowfullscreen></iframe>
                </div>
                <p class="b-video__figcaption">
                    Your inner self will meet the full force of the summer, and we can go back to each witness
                    leaving the pores, we go back to basics!
                </p>
            </div>

            <!-- контент -->

            [[*content]]

            <!-- аннотация -->

            <div class="b-footnote">
                <p>
                    <sup class="b-footnote__mark">*</sup> - [[+annotationText]]
                </p>
            </div>
            <div class="b-share">
                <div class="b-item__header">
                    <h6 class="s6-heading b-item__ttl-header">Share this post</h6>
                </div>
                <ul class="b-likes b-share__list">
                    <li class="b-likes__pinterest-p">
                  <span>457
                    <svg x="0px" y="0px"
                         viewBox="0 0 55 20.4" style="enable-background:new 0 0 55 20.4;" xml:space="preserve">
                    <path class="svg__fill" d="M53,2v16.5H10.9l-8.1-8.3L10.9,2H53 M55,0H10.1L0,10.2l10.1,10.3H55V0L55,0z"/>
                    </svg>
                    </span>
                    </li>
                    <li class="b-likes__google-plus">
                  <span>457
                    <svg x="0px" y="0px"
                         viewBox="0 0 55 20.4" style="enable-background:new 0 0 55 20.4;" xml:space="preserve">
                    <path class="svg__fill" d="M53,2v16.5H10.9l-8.1-8.3L10.9,2H53 M55,0H10.1L0,10.2l10.1,10.3H55V0L55,0z"/>
                    </svg>
                    </span>
                    </li>
                    <li class="b-likes__twitter">
                  <span>457
                    <svg x="0px" y="0px"
                         viewBox="0 0 55 20.4" style="enable-background:new 0 0 55 20.4;" xml:space="preserve">
                    <path class="svg__fill" d="M53,2v16.5H10.9l-8.1-8.3L10.9,2H53 M55,0H10.1L0,10.2l10.1,10.3H55V0L55,0z"/>
                    </svg>
                    </span>
                    </li>
                    <li class="b-likes__facebook">
                  <span>1,45K
                    <svg x="0px" y="0px"
                         viewBox="0 0 55 20.4" style="enable-background:new 0 0 55 20.4;" xml:space="preserve">
                    <path class="svg__fill" d="M53,2v16.5H10.9l-8.1-8.3L10.9,2H53 M55,0H10.1L0,10.2l10.1,10.3H55V0L55,0z"/>
                    </svg>
                    </span>

                    </li>
                </ul>
            </div>
        </main>

        <!-- доп.ивенты -->