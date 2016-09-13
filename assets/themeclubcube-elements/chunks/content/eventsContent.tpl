<div class="b-headlines">
    <div class="container">
        <div class="b-breadcrumbs">
            <ul class="b-breadcrumbs__list x-small-txt">
                <li><a href="/" class="link">main</a></li>
                <li>Events</li>
            </ul>
        </div>
        <h1 class="b-headlines__ttl">Events</h1>
    </div>
</div>
<div class="b-content container">
    <main class="b-main">
        <div class="b-box-wrap">
            <div class="row">
                <ul role="tablist" class="b-tabs__nav b-tabs__nav-tabs b-tabs__nav-tabs--center">
                    <li role="presentation" class="active"><a href="#block-a" aria-controls="block-a" role="tab" data-toggle="tab">
                            <svg baseProfile="tiny" width="10" height="10" x="0px" y="0px" viewBox="0 0 10 10" xml:space="preserve">
                    <path fill="#231F20" d="M0,4h4V0H0V4z M6,0v4h4V0H6z M0,10h4V6H0V10z M6,10h4V6H6V10z"/>
                    </svg></a></li>
                    <li role="presentation"><a href="#block-b" aria-controls="block-b" role="tab" data-toggle="tab">
                            <svg baseProfile="tiny" width="10" height="10"
                                 x="0px" y="0px" viewBox="0 0 10 10" xml:space="preserve">
                    <path fill="#231F20" d="M0,0v4h10V0H0z M10,10V6H0v4H10z"/>
                    </svg></a></li>
                </ul>
            </div>
            <div class="b-tabs__content">
                [[pdoResources?eventsList
                    &tpl=`eventsSquareItemEvents`
                    &tplWrapper=`eventsSquareListEvents`
                    &parents=`[[++themeclubcube.events_resource]]`
                    &tvPrefix=``
                    &includeTVs=`timeStart, img`
                ]]
                [[pdoResources?eventsList
                    &tpl=`eventsRectangleItemEvents`
                    &tplWrapper=`eventsRectangleListEvents`
                    &parents=`[[++themeclubcube.events_resource]]`
                    &tvPrefix=``
                    &includeTVs=`timeStart, viewType`
                ]]
            </div>
        </div>
        <div class="b-box__btn-wrap txt--centr">
            <div class="btn-icon__wrap">
                <a href="#" class="btn btn-icon">More events</a>
                <svg x="0px" y="0px"
                     width="20px" height="20px" viewBox="0 0 20 20" enable-background="new 0 0 20 20" xml:space="preserve">
              <path fill-rule="evenodd" clip-rule="evenodd" stroke="#000000" stroke-width="2" stroke-miterlimit="10" d="M10.004,17V3"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" stroke="#000000" stroke-width="2" stroke-miterlimit="10" d="M3,9.98h14"/>
              </svg>

            </div>
        </div>
    </main>
</div>