<!DOCTYPE html>
<html lang="[[++cultureKey]]">
    <head>
        <title>[[*longtitle:notempty=`[[*longtitle:htmlent]]`:default=`[[*pagetitle:htmlent]][[%lf_site_name:htmlent]]`]]</title>
        <meta name="description" content="[[*description:notempty=`[[*description:htmlent]]`:default=`[[%lf_description:htmlent]]`]]" />
        <base href="[[++site_url]]" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
        <meta name="apple-mobile-web-app-capable" content="yes">

		<meta name="cmsmagazine" content="a39ef97fd1d4cf6d3e103f0ff48ea4f6" />

        <meta property="og:title" content="[[*longtitle:notempty=`[[*longtitle]]`:default=`[[*pagetitle]] / [[++site_name]]`]]" />
        <meta property="og:description" content="[[*description:notempty=`[[*description:htmlent]]`:default=`[[%lf_description:htmlent]]`]]" />
        <meta property="og:type" content="website" />
        <meta property="og:url" content="[[~[[*id]]? &scheme=`full`]]" />
        <meta property="og:image" content="[[*img:notempty=`[[++site_url:replace=`/[[++cultureKey]]/==`]][[*img]]`:default=`[[++site_url]]assets/design/images/logo.png`]]" />
        <meta property="og:site_name" content="[[++site_name]]" />

        <link rel="dns-prefetch" href="http://code.jquery.com" />
        <link rel="dns-prefetch" href="http://fonts.googleapis.com" />
        <link rel="dns-prefetch" href="http://www.google-analytics.com" /> 

        <link rel="author" href="humans.txt" />
        <link rel="icon" href="[[++site_url]]favicon.ico" type="image/x-icon" /> 
        <link rel="shortcut icon" href="[[++site_url]]favicon.ico" type="image/x-icon" />
        
        [[Molt?
            &minifyCss=`1`
            &minifyJs=`1`
            &cacheFolder=`[[++themeclubcube.design_url]]min/`
            &jsSources=`
				[[++themeclubcube.design_url]]js/otherlibs/bootstrap.min.js
                ,[[++themeclubcube.design_url]]js/jquery/plugins/jquery.imgpreload.js
                ,[[++themeclubcube.design_url]]js/jquery/plugins/form/jquery.form.js
                ,[[++themeclubcube.design_url]]js/jquery/plugins/validation/jquery.validate.js
				[[++cultureKey:notis=`en`:then=`,[[++themeclubcube.design_url]]js/jquery/plugins/validation/localization/messages_[[++cultureKey]].js`:else=``]]
				,[[++themeclubcube.design_url]]js/jquery/plugins/slick/slick.min.js
				,[[++themeclubcube.design_url]]js/jquery/plugins/bootstrap-datapicker/bootstrap-datepicker.js
				,[[++themeclubcube.design_url]]js/jquery/plugins/tileSlide.js
				,[[++themeclubcube.design_url]]js/jquery/plugins/topEventsAnimate.js
				,[[++themeclubcube.design_url]]js/jquery/plugins/tinyAnimations.js
				,[[++themeclubcube.design_url]]js/jquery/plugins/flat-calendar.js
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
				,[[++themeclubcube.design_url]]js/init.js
            `
            &cssSources=`
				[[++themeclubcube.design_url]]css/style.min.css
				,[[++themeclubcube.design_url]]js/jquery/plugins/slick/slick.css
            `
        ]]
        
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