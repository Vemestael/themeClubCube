<main>
    <section class="all-events events-tiles">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-sm-6 events-tile-h1">
                    <h1>[[*pagetitle:htmlent]]</h1>
                </div>
            </div>
            <div class="rows">
                <div class="button-dropdown hidd">
                    [[!getWeeksEvents]]
                </div>
            </div>
        </div>
    </section>
    <div class="container gr-bg tab-content">
        <div class="tab-pane show row">
            [[!getParamsWeeksEvents]]
            [[!+week:is=`1`:then=`
                [[!pdoResources@eventsListWeek?
                    &parents=`[[*id]]`
                    &includeTVs=`img,timeStart,price,lineUp,topEvent`
                    &processTVs=`img,lineUp`
                    &tvPrefix=``
                    &tplWrapper=`eventsListWrapperEvents`
                    &wrapIfEmpty=`1`
                    &tpl=`eventsItemTileEvents`
                    &tvFilters=`[[!+params]]`
                ]]
            `:else=`
                [[!pdoPage@eventsListAll?
                    &parents=`[[*id]]`
                    &includeTVs=`img,timeStart,lineUp,price`
                    &processTVs=`img,lineUp`
                    &tvFilters=`timeStart>=[[getDate? &format=`Y-m-d 00:00:00`]]`
                    &tvPrefix=``
                    &tplWrapper=`eventsListWrapperEvents`
                    &wrapIfEmpty=`1`
                    &tpl=`eventsItemTileEvents`
                    &tplPage=`@INLINE <li><a href="[[+href]]">[[+pageNo]]</a></li>`
                    &tplPageWrapper=`@INLINE <div class="container"><div class="rows paging single-paging">[[+prev]]<ul class="middle-paging">[[+pages]]</ul>[[+next]]</div></div>`
                    &tplPageActive=`@INLINE <li class="off"><span>[[+pageNo]]</span></li>`
                    &tplPageFirst=``
                    &tplPageLast=``
                    &tplPagePrev=`@INLINE <a class="left-pag sm" href="[[+href]]">
                        <div class="pad-arr"><i></i></div>
                        <div class="pad-text">
                            <div class="pad-title">[[%lf_page_prev:htmlent]]</div>
                        </div>
                    </a>`
                    &tplPageNext=`@INLINE <a class="right-pag sm" href="[[+href]]">
                        <div class="pad-arr"><i></i></div>
                        <div class="pad-text">
                            <div class="pad-title">[[%lf_page_next:htmlent]]</div>
                        </div>
                    </a>`
                    &tplPageSkip=`@INLINE <li class="dots-pagination"><span>...</span></li>`
                    &tplPageFirstEmpty=``
                    &tplPageLastEmpty=``
                    &tplPagePrevEmpty=`@INLINE <div class="left-pag sm off" >
                        <div class="pad-arr"><i></i></div>
                        <div class="pad-text">
                            <div class="pad-title">[[%lf_page_prev:htmlent]]</div>
                        </div>
                    </div>`
                    &tplPageNextEmpty=`@INLINE <div class="right-pag sm off">
                        <div class="pad-arr">
                            <i></i>
                        </div>
                        <div class="pad-text">
                            <div class="pad-title">[[%lf_page_next:htmlent]]</div>
                        </div>
                    </div>`
                ]]
            `]]
        </div>
    </div>
    [[!+week:is=`1`:then=``:else=`
        [[!+page.nav]]
    `]]
</main>