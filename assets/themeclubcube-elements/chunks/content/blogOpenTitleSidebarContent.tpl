[[pdoResources?
    &tpl=`blogOpenTitleBlog`
    &parents=`[[++themeclubcube.blog_resource]]`
]]
<div class="b-content container">
    <div class="row">
        <main class="b-main b-blog-inr content col-md-8 col-lg-7">
            [[pdoResources?
                &tpl=`blogOpenCommon`
                &parents=`[[++themeclubcube.blog_resource]]`
                &tvPrefix=``
                &includeTVs=`videoId, annotationBlog, annotationText, img`
            ]]
        </main>
        <aside class="b-aside b-aside--display col-md-4 col-lg-4 col-lg-offset-1">
            <div class="row">
                [[pdoResources?
                    &tpl=`sidebarEventsItemBlog`
                    &tplWrapper=`sidebarEventsListBlog`
                    &parents=`[[++themeclubcube.events_resource]]`
                    &limit=`3`
                    &tvPrefix=``
                    &includeTVs=`img, timeStart`
                ]]
                [[pdoResources?
                    &tpl=`sidebarBlogItemBlog`
                    &tplWrapper=`sidebarBlogListBlog`
                    &parents=`[[++themeclubcube.blog_resource]]`
                    &limit=`3`
                    &tvPrefix=``
                    &includeTVs=`img`
                ]]
            </div>
        </aside>
    </div>
</div>