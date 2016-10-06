<div class="b-headlines">
    <div class="container">
        <div class="b-breadcrumbs">
            <ul class="b-breadcrumbs__list x-small-txt">
                <li><a href="/" class="link">main</a></li>
                <li>Blog</li>
            </ul>
        </div>
        <h1 class="b-headlines__ttl">Blog</h1>
    </div>
</div>
<div class="b-content container">
	[[!pdoPage@blogList?
	    &tpl=`blogItemBlog`
	    &tplWrapper=`blogListBlog`
	    &parents=`[[++themeclubcube.blog_resource]]`
	    &tvPrefix=``
	    &limit=`6`
	    &includeTVs=`blogViewType, img`
	    &tplPage=`@INLINE <li><a href="[[+href]]">[[+pageNo]]</a></li>`
      &tplPageWrapper=`@INLINE <div class="container"><div class="rows paging single-paging">[[+prev]]<ul class="middle-paging">[[+pages]]</ul>[[+next]]</div></div>`
      &tplPageActive=`@INLINE <li class="off"><span>[[+pageNo]]</span></li>`
      &tplPageFirst=``
      &tplPageLast=``
      &tplPagePrev=`@INLINE <a class="left-pag sm" href="[[+href]]">
          <div class="pad-arr"><i class="fa fa-angle-left"></i></div>
          <div class="pad-text">
              <div class="pad-title">[[%lf_page_prev:htmlent]]</div>
          </div>
      </a>`
      &tplPageNext=`@INLINE <a class="right-pag sm" href="[[+href]]">
          <div class="pad-arr"><i class="fa fa-angle-right"></i></div>
          <div class="pad-text">
              <div class="pad-title">[[%lf_page_next:htmlent]]</div>
          </div>
      </a>`
      &tplPageSkip=`@INLINE <li class="dots-pagination"><span>...</span></li>`
      &tplPageFirstEmpty=``
      &tplPageLastEmpty=``
      &tplPagePrevEmpty=`@INLINE <div class="left-pag sm off" >
          <div class="pad-arr"><i class="fa fa-angle-left"></i></div>
          <div class="pad-text">
              <div class="pad-title">[[%lf_page_prev:htmlent]]</div>
          </div>
      </div>`
      &tplPageNextEmpty=`@INLINE <div class="right-pag sm off">
          <div class="pad-arr">
              <i class="fa fa-angle-right"></i>
          </div>
          <div class="pad-text">
              <div class="pad-title">[[%lf_page_next:htmlent]]</div>
          </div>
      </div>`
	]]
	[[!+page.nav]]
<!-- <div class="b-box__btn-wrap txt--centr">
        <div class="btn-icon__wrap">
            <a href="#" class="btn btn-icon">More blogs</a>
            <svg x="0px" y="0px"
                 width="20px" height="20px" viewBox="0 0 20 20" enable-background="new 0 0 20 20" xml:space="preserve">
            <path fill-rule="evenodd" clip-rule="evenodd" stroke="#000000" stroke-width="2" stroke-miterlimit="10" d="M10.004,17V3"/>
                <path fill-rule="evenodd" clip-rule="evenodd" stroke="#000000" stroke-width="2" stroke-miterlimit="10" d="M3,9.98h14"/>
            </svg>
        </div>
    </div>-->
</div> 