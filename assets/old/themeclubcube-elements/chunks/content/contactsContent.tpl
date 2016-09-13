<section class="all-blogs blog">
	<div class="container">
		<div class="row head">
            <div class="col-xs-12 col-sm-12 col-md-12 content-header__center-list">
				<h1 class="content-h1 text-left">[[*pagetitle:htmlent]]</h1>
			</div>
		</div>
	</div>
</section>
<div class="main-content">
	<div class="container text-contain">
		<div class="row">
            <main class="col-lg-8 col-md-12 col-sm-12 content-main content-main__center-list">
				<div class="content-page">
					<div class="page-text">
                        <div class="row">
                            <div class="col-lg-6 contact-block">
						        [[*content]]
                            </div>
                            <div class="col-lg-6 contact-block">
                                <h2>[[%lf_contact_head:htmlent]]</h2>
                                <form class="form-horizontal" id="contactForm" action="[[~[[++themeclubcube.ajax_form_contacts]]]]" method="POST">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <input type="text" name="name" class="form-control required" required id="inputName" placeholder="[[%lf_contact_name:htmlent]]">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <input type="email" name="email" class="form-control required email" required id="inputEmail" placeholder="[[%lf_contact_email:htmlent]]">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <textarea name="message" class="form-control" rows="3" required id="inputMessage" placeholder="[[%lf_contact_message:htmlent]]"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-8">
                                            <button type="submit" class="read-more submit">[[%lf_contact_send:htmlent]]</button>
                                        </div>
                                    </div>
                                    <div id="loaderContactsForm" class="suc loader hide">
                                        <div class="loader">
                                            <div class="fr-bl"></div>
                                            <div class="sc-bl"></div>
                                            <div class="thr-bl"></div>
                                            <div class="fth-bl"></div>
                                        </div>
                                    </div>
                                </form>
                                <div id="successMessage" class="suc" style="display: none;">
                                    <div class="suc-title"><span class="glyphicon glyphicon-ok"></span>[[%lf_contact_successMessage:htmlent? &namespace=`sitelang` &language=`[[++cultureKey]]`]]</div>
                                </div>
                            </div>
                        </div>
					</div>
				</div>
			</main>
		</div>
	</div>
</div>