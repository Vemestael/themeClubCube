[[pdoResources?
    &tpl=`blogOpenNoTitleBlog`
    &parents=`[[++themeclubcube.blog_resource]]`
    &limit=`1`
]]
<div class="b-content container">
    <div class="row">
        <main class="b-main b-blog-inr content col-md-8 col-lg-7">
            [[pdoResources?
                &tpl=`blogOpenCommon`
                &parents=`[[++themeclubcube.blog_resource]]`
                &tvPrefix=``
                &includeTVs=`videoId, annotationBlog, annotationText`
                &limit=`1`
            ]]
        </main>
        <aside class="b-aside b-aside--display col-md-4 col-lg-4 col-lg-offset-1">
            <div class="row">
                [[pdoResources?blogEventsSidebar
                    &tpl=`sidebarEventsItemBlog`
                    &tplWrapper=`sidebarEventsListBlog`
                    &parents=`[[++themeclubcube.events_resource]]`
                    &tvPrefix=``
                    &includeTVs=`img, timeStart`
                ]]
                [[pdoResources?blogEventsSidebar
                    &tpl=`sidebarBlogItemBlog`
                    &tplWrapper=`sidebarBlogListBlog`
                    &parents=`[[++themeclubcube.blog_resource]]`
                    &tvPrefix=``
                    &includeTVs=`img`
                ]]
            </div>
        </aside>
    </div>
</div>
