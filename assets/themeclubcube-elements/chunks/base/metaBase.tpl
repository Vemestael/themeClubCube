<!DOCTYPE html>
<html lang="[[++cultureKey]]">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>[[*longtitle:notempty=`[[*longtitle:htmlent]]`:default=`[[*pagetitle:htmlent]][[%lf_site_name:htmlent]]`]]</title>
        <meta name="description" content="[[*description:notempty=`[[*description:htmlent]]`:default=`[[%lf_description:htmlent]]`]]" />
        <base href="[[++site_url]]" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta name="apple-mobile-web-app-title" content="[[*pagetitle:htmlent]]">

        <meta property="og:title" content="[[*longtitle:htmlent:default=`[[*pagetitle:htmlent]] / [[++site_name]]`]]" />
        <meta property="og:description" content="[[*description:htmlent:default=`[[%lf_description:htmlent]]`]]" />
        <meta property="og:type" content="website" />
        <meta property="og:url" content="[[~[[*id]]? &scheme=`full`]]" />
        <meta property="og:image" content="[[*img:notempty=`[[++site_url:replace=`/[[++cultureKey]]/==`]][[*img]]`:default=`[[++site_url]]assets/design/images/logo.png`]]" />
        <meta property="og:site_name" content="[[++site_name]]" />

        <meta http-equiv="x-dns-prefetch-control" content="on">
        <link rel="dns-prefetch" href="http://code.jquery.com" />
        <link rel="dns-prefetch" href="http://fonts.googleapis.com" />
        <link rel="dns-prefetch" href="http://www.google-analytics.com" /> 

        <link rel="icon" href="[[++site_url]]assets/design/images/favicon.ico" type="image/x-icon" /> 
        <link rel="shortcut icon" href="[[++site_url]]favicon.ico" type="image/x-icon" />
        
        [[Molt?
            &minifyCss=`1`
            &minifyJs=`1`
            &cacheFolder=`[[++themeclubcube.design_url]]min/`
            &jsSources=`
				[[++themeclubcube.design_url]]js/otherlibs/bootstrap.min.js
                ,[[++themeclubcube.design_url]]js/jquery/plugins/jquery.imgpreload.js
                ,[[++themeclubcube.design_url]]js/jquery/plugins/jquery.form.js
                ,[[++themeclubcube.design_url]]js/jquery/plugins/validation/jquery.validate.js
				,[[++themeclubcube.design_url]]js/jquery/plugins/slick/slick.min.js
				,[[++themeclubcube.design_url]]js/jquery/plugins/tileSlide.js
				,[[++themeclubcube.design_url]]js/jquery/plugins/topEventsAnimate.js
				,[[++themeclubcube.design_url]]js/jquery/plugins/tinyAnimations.js
				,[[++themeclubcube.design_url]]js/jquery/plugins/imagelightbox/imagelightbox.js
                ,[[++themeclubcube.design_url]]js/jquery/plugins/jquery.sharrre.js
				,[[++themeclubcube.design_url]]js/app/lib/site.js
				,[[++themeclubcube.design_url]]js/app/lib/siteMode.js
				,[[++themeclubcube.design_url]]js/app/mode/themeMode.js
				,[[++themeclubcube.design_url]]js/app/modules/images.js
				,[[++themeclubcube.design_url]]js/app/modules/loaderMain.js
				,[[++themeclubcube.design_url]]js/app/modules/fullHeightSlider.js
				,[[++themeclubcube.design_url]]js/app/modules/eventAnimate.js
				,[[++themeclubcube.design_url]]js/app/modules/blogAnimate.js
				,[[++themeclubcube.design_url]]js/app/modules/partners.js
				,[[++themeclubcube.design_url]]js/app/modules/scrollAtOnce.js
				,[[++themeclubcube.design_url]]js/app/modules/menuToTop.js
				,[[++themeclubcube.design_url]]js/app/modules/gallerySlider.js
                ,[[++themeclubcube.design_url]]js/app/modules/topEventsSlider.js
                ,[[++themeclubcube.design_url]]js/app/modules/ticketsEventsSlider.js
				,[[++themeclubcube.design_url]]js/app/modules/formContacts.js
                ,[[++themeclubcube.design_url]]js/app/modules/formSubscribe.js
				,[[++themeclubcube.design_url]]js/app/modules/galleryPage.js
                ,[[++themeclubcube.design_url]]js/app/modules/sharrre.js
                ,[[++themeclubcube.design_url]]js/app/modules/eventsTickets.js
                ,[[++themeclubcube.design_url]]js/app/modules/dropDownClick.js
				,[[++themeclubcube.design_url]]js/init.js
            `
            &cssSources=`
				[[++themeclubcube.design_url]]js/jquery/plugins/slick/slick-custom.css
				,[[++themeclubcube.design_url]]css/style.min.css
                ,[[++themeclubcube.design_url]]css/[[++themeclubcube.color_scheme]]-color.css
            `
        ]]
		<script>
			var designUrl = '[[++themeclubcube.design_url]]';
		</script>
        
        <!--[if lt IE 9]>
            <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
        <![endif]-->
        <!--[if IE]>
            <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

		[[++themeclubcube.ga_tracking_id:notempty=`
		<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
				(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
					m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
			ga('create', '[[++themeclubcube.ga_tracking_id]]', 'auto');
			ga('send', 'pageview');
		</script>
		`]]
    </head>
    <body>