[[pdoResources?
    &tpl=`blogOpenTitleBlog`
    &parents=`[[++themeclubcube.blog_resource]]`
    &limit=`1`
    &tvPrefix=``
    &includeTVs=`img`
]]
<div class="b-content container">
    <div class="row">
        <main class="b-main b-blog-inr content col-md-8 col-lg-7">
            [[pdoResources?
                &tpl=`blogOpenCommon`
                &parents=`[[++themeclubcube.blog_resource]]`
                &limit=`1`
                &tvPrefix=``
                &includeTVs=`videoId, annotationBlog, annotationText, img`
            ]]
        </main>
        <aside class="b-aside b-aside--display col-md-4 col-lg-4 col-lg-offset-1">
            <div class="row">
                [[pdoResources@blogEventsSidebar?
                    &tpl=`sidebarEventsItemCommon_[[*typeSidebar]]`
                    &tplWrapper=`sidebarEventsListCommon`
                    &parents=`[[++themeclubcube.events_resource]]`
                    &tvPrefix=``
                    &includeTVs=`img, timeStart, typeSidebar`
                ]]
                [[pdoResources@blogEventsSidebar?
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
