[[pdoResources?
    &tpl=`blogOpenTitleBlog`
    &parents=`[[++themeclubcube.blog_resource]]`
]]
<div class="b-content container">
    <div class="row">
        <main class="b-main b-main--center-pg content b-blog-inr col-xs-12">
            [[pdoResources?
                &tpl=`blogOpenCommon`
                &parents=`[[++themeclubcube.blog_resource]]`
                &tvPrefix=``
                &includeTVs=`videoId, annotationBlog, annotationText, img`
            ]]
            [[pdoResources?
                &tpl=`eventsDownItemBlog`
                &tplWrapper=`eventsDownListBlog`
                &parents=`[[++themeclubcube.events_resource]]`
                &limit=`2`
                &tvPrefix=``
                &includeTVs=`img, timeStart`
            ]]
        </main>
    </div>
</div>