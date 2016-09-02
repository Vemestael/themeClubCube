<div class="b-headlines">
    <div class="container">
        <div class="b-breadcrumbs">
            <ul class="b-breadcrumbs__list x-small-txt">
                <li><a href="index.html" class="link">main</a></li>
                <li><a href="blog.html" class="link">blog</a></li>
                <li>[[+pagetitle]]</li>
            </ul>
        </div>
        <h1 class="b-headlines__ttl">[[+pagetitle]]</h1>
        <time datetime="[[+publishedon]]" class="b-headlines__date">[[%lf_month.[[+publishedon:date=`%m`]]]] [[+publishedon:date=`%d, %H:%M`]]</time>
    </div>
</div>
<div class="b-content container">
    <div class="row">
        <main class="b-main b-main--center-pg content b-blog-inr col-xs-12">
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

            [[*content]]

            <div class="b-footnote">
                <p>
                    <sup class="b-footnote__mark">*</sup> - [[+annotationText]]


                </p>
            </div>


            [[getImageList?
                &tvname=`annotationBlog`
                &tpl=`blockquoteBlog`
            ]]


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