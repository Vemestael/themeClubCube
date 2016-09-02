<div class="b-gallery__border">
    <div class="container">
        <ul class="c-box__views">
            <li class="c-box__view txt">32</li>
            <li class="c-box__video txt">2</li>
        </ul>
        <ul class="b-likes b-likes--wht">
            <li class="b-likes__heading">share:</li>
            <li class="b-likes__facebook">
              <span>1.45K
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
<div class="b-gallery__content">
    <div class="c-headlines b-gallery__headlines">
        <div class="container">
            <div class="c-headlines__ttl">[[+pagetitle]]</div>
            <div class="c-headlines__date-lg b-gallery__date-lg">
                <time datetime="[[+timeStart]]" class="date-lg"><span class="date-lg__dt">[[+timeStart:strtotime:date=`%d`]]</span><span class="date-lg__rh"><span class="date-lg__rh-m">[[%lf_month.[[+timeStart:strtotime:date=`%m`]]]] [[+timeStart:strtotime:date=`%Y`]]</span><span class="date-lg__rh-d">[[%lf_week.[[+timeStart:strtotime:date=`%w`]]]]</span><span class="date-lg__rh-t">[[+timeStart:strtotime:date=`%H`]]:[[+timeStart:strtotime:date=`%M`]] [[+timeStart:strtotime:date=`%P`]]</span></span></time>
            </div>
        </div>
    </div>
    <div class="b-content container">
        <div class="row">
            <main class="b-main content b-blog-inr col-md-8 col-lg-7">
                <div class="txt-intro">
                    <p>
                        [[+introtext]]
                    </p>
                </div>

                [[pdoResources?
                    &tpl=`videoItemGallery`
                    &parents=`0`
                    &resources=`[[+videoId]]`
                    &limit=`1`
                    &tvPrefix=``
                    &includeTVs=`videoLink`
                ]]

                [[+content]]

                <div class="b-footnote">
                    <p>
                        <sup class="b-footnote__mark">*</sup> - [[+annotationText]]

                    </p>
                </div>
                <div class="b-share" style="display:inline!important">
                    <div class="b-item__header">
                        <h6 class="s6-heading b-item__ttl-header">Share this point</h6>
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
                    <span>1.45K
                    <svg x="0px" y="0px"
                         viewBox="0 0 55 20.4" style="enable-background:new 0 0 55 20.4;" xml:space="preserve">
                    <path class="svg__fill" d="M53,2v16.5H10.9l-8.1-8.3L10.9,2H53 M55,0H10.1L0,10.2l10.1,10.3H55V0L55,0z"/>
                    </svg>
                    </span>

                        </li>
                    </ul>
                </div>
            </main>