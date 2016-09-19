<main class="b-main content b-blog-inr col-sm-8 col-lg-7">
    <div class="txt-intro">
        <p>
            [[+introtext]]
        </p>
    </div>

    <!-- видео -->
    [[pdoResources?
        &tpl=`videoItemCommon`
        &parents=`0`
        &resources=`[[*videoId]]`
        &limit=`1`
        &tvPrefix=``
        &includeTVs=`videoLink`
    ]]

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
            <span>share
                <a data-pin-do="buttonBookmark" data-pin-custom="true" data-pin-lang="ru" data-pin-save="false" href="https://ru.pinterest.com/pin/create/button/">
                    <svg x="0px" y="0px"
                         viewBox="0 0 55 20.4" style="enable-background:new 0 0 55 20.4;" xml:space="preserve">
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
</main>

        <!-- доп.ивенты -->