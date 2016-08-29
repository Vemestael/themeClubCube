<footer class="contact-us">
	<div class="container">
		<div class="row">
			<div class="col-lg-4 col-md-6 col-sm-6 footer-block">
				<div class="welcome">
					<div class="welcome-inner">
						<div class="corner-welcome"></div>
						<p>[[%lf_footer_welcome_line:htmlent]]</p>
						<span class="welcome-title">[[%lf_footer_welcome_head:htmlent]]</span>
					</div>
				</div>
				<address>
					<ul class="address-list">
						[[%lf_footer_address_email:notempty=`
							<li>
								<img src="[[++themeclubcube.design_url]]images/letter-img.png" alt="">
								<a href="mailto:[[%lf_footer_address_email:htmlent]]">[[%lf_footer_address_email:htmlent]]</a>
							</li>
						`]]
						[[%lf_footer_address_phone1:notempty=`
							<li>
								<img src="[[++themeclubcube.design_url]]images/phone-angle.png" alt="">
								<ul>
									<li>[[%lf_footer_address_phone1:htmlent]]</li>
									<li>[[%lf_footer_address_phone2:htmlent]]</li>
								</ul>
							</li>
						`]]
						[[%lf_footer_address:notempty=`
							<li>
								<img src="[[++themeclubcube.design_url]]images/baloone.png" alt="">
								<ul>
									<li>[[%lf_footer_address:htmlent]]</li>
								</ul>
							</li>
						`]]
					</ul>
				</address>
			</div>
			<div class="col-lg-4 col-md-6 col-sm-6 footer-block">
                [[++themeclubcube.unisender_api_key:notempty=`
				<div class="subscribe-here soc-marg">
					<div class="footer-header">[[%lf_footer_subscribe_head:htmlent]]</div>
					<p>[[%lf_footer_subscribe_line:htmlent]]</p>
					<form action="[[~[[++themeclubcube.ajax_form_subscribe]]]]" id="email-footer-form" method="post">
						<div class="subscribe">
							<input type="email" class="email required" required name="email" id="email-subscribe" placeholder="[[%lf_footer_subscribe_email_placeholder:htmlent]]">
							<button type="submit" id="subscribe-btn" >[[%lf_footer_subscribe_send:htmlent]]</button>
						</div>
                        <div id="loaderSubscribeForm" class="suc loader hide">
                            <div class="loader">
                                <div class="fr-bl"></div>
                                <div class="sc-bl"></div>
                                <div class="thr-bl"></div>
                                <div class="fth-bl"></div>
                            </div>
                        </div>
					</form>
                    <div id="successSubscribe" class="suc" style="display: none;">
                        <div class="suc-title"><span class="glyphicon glyphicon-ok"></span>[[%lf_footer_subscribe_success:htmlent]]</div>
                    </div>
				</div>
                `]]
			</div>
			<div class="col-lg-4 col-md-12 col-sm-12 footer-block last">
				<div class="soc-marg soc-webs">
                    <div class="footer-header">[[%lf_footer_follow_head:htmlent]]</div>
					<p>[[%lf_footer_follow_line:htmlent]]</p>
					<ul class="social-icons">
						[[%lf_footer_follow_facebook:notempty=`
							<li><a href="[[%lf_footer_follow_facebook:htmlent]]"> <i class="fa fa-facebook"></i></a></li>
						`]]
						[[%lf_footer_follow_gplus:notempty=`
							<li><a href="[[%lf_footer_follow_gplus:htmlent]]"><i class="fa fa-google-plus"></i></a></li>
						`]]
						[[%lf_footer_follow_linkedin:notempty=`
							<li><a href="[[%lf_footer_follow_linkedin:htmlent]]"><i class="fa fa-linkedin"></i></a></li>
						`]]
						[[%lf_footer_follow_twitter:notempty=`
							<li><a href="[[%lf_footer_follow_twitter:htmlent]]"><i class="fa fa-twitter"></i></a></li>
						`]]
						[[%lf_footer_follow_skype:notempty=`
							<li><a href="skype:[[%lf_footer_follow_skype:htmlent]]?call"><i class="fa fa-skype"></i></a></li>
						`]]
						[[%lf_footer_follow_skype:notempty=`
							<li><a href="[[%lf_footer_follow_pinterest:htmlent]]"><i class="fa fa-pinterest"></i></a></li>
						`]]
						[[%lf_footer_follow_youtube:notempty=`
							<li><a href="[[%lf_footer_follow_youtube:htmlent]]"><i class="fa fa-youtube-play"></i></a></li>
						`]]
						[[%lf_footer_follow_flickr:notempty=`
							<li><a href="[[%lf_footer_follow_flickr:htmlent]]"><i class="fa fa-flickr"></i></a></li>
						`]]
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="copyrights-bottom">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<p class="copyrigts">
						[[%lf_footer_copyright:htmlent]] [[time:date=`%Y`]] [[%lf_footer_copyright_text:htmlent]] /
						<a href="http://makebecool.com" target="_blank" title="Design development for MODX">Design development for MODX</a> by MakeBeCool
					</p>
				</div>
			</div>
		</div>
	</div>
</footer>
[[+gallClose:is=`1`:then=`</div>`:esle=``]]
</body>
</html>