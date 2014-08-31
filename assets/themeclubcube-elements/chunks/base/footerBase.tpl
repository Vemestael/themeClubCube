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
				<div class="subscribe-here soc-marg">
					<h6>[[%lf_footer_subscribe_head:htmlent]]</h6>
					<p>[[%lf_footer_subscribe_line:htmlent]]</p>
					<!-- TODO Подключить и проверить форму подписки. Добавить Плагин unisender-->
					<form action="#" id="email-footer-form">
						<div class="subscribe">
							<input type="email" name="email" id="email-subscribe" placeholder="[[%lf_footer_subscribe_email_placeholder:htmlent]]">
							<button type="submit" id="subscribe-btn" >[[%lf_footer_subscribe_send:htmlent]]</button>
						</div>
					</form>
				</div>
			</div>
			<div class="col-lg-4 col-md-12 col-sm-12 footer-block last">
				<div class="soc-marg soc-webs">
					<h6>[[%lf_footer_follow_head:htmlent]]</h6>
					<p>[[%lf_footer_follow_line:htmlent]]</p>
					<ul class="social-icons">
						[[%lf_footer_follow_facebook:notempty=`
							<li><a href="[[%lf_footer_follow_facebook:htmlent]]"><span class="soc-icon-fb"></span></a></li>
						`]]
						[[%lf_footer_follow_gplus:notempty=`
							<li><a href="[[%lf_footer_follow_gplus:htmlent]]"><span class="soc-icon-g"></span></a></li>
						`]]
						[[%lf_footer_follow_linkedin:notempty=`
							<li><a href="[[%lf_footer_follow_linkedin:htmlent]]"><span class="soc-icon-in"></span></a></li>
						`]]
						[[%lf_footer_follow_twitter:notempty=`
							<li><a href="[[%lf_footer_follow_twitter:htmlent]]"><span class="soc-icon-tw"></span></a></li>
						`]]
						[[%lf_footer_follow_skype:notempty=`
							<li><a href="skype:[[%lf_footer_follow_skype:htmlent]]?call"><span class="soc-icon-skype"></span></a></li>
						`]]
						[[%lf_footer_follow_skype:notempty=`
							<li><a href="[[%lf_footer_follow_pinterest:htmlent]]"><span class="soc-icon-pint"></span></a></li>
						`]]
						[[%lf_footer_follow_youtube:notempty=`
							<li><a href="[[%lf_footer_follow_youtube:htmlent]]"><span class="soc-icon-yout"></span></a></li>
						`]]
						[[%lf_footer_follow_flickr:notempty=`
							<li><a href="[[%lf_footer_follow_flickr:htmlent]]"><span class="soc-icon-th"></span></a></li>
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
</body>
</html>