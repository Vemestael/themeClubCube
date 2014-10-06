<div class="loader-container" id="loaderContainer">
	<div class="backstage"></div>
	<div class="loader" id="loader">
		<div class="fr-bl"></div>
		<div class="sc-bl"></div>
		<div class="thr-bl"></div>
		<div class="fth-bl"></div>
	</div>
</div>
<header id="header">
	<div class="container-fluid">
		<div class="row">
			<div class="navbar-header col-lg-2 col-lg-offset-1">
				<div class="tile">
					<button class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<span class="home-btn">Home</span>
				</div>
                [[*id:is=`[[++site_start]]`:then=`
                    <span class="navbar-brand first">
                        <img src="[[++themeclubcube.design_url]]images/logo-w.png" alt="[[++site_name]]" class="site-logo">
                    </span>
                `:else=`
                    <a href="[[++site_url]]" class="navbar-brand first">
                        <img src="[[++themeclubcube.design_url]]images/logo-w.png" alt="[[++site_name]]" class="site-logo">
                    </a>
                `]]
			</div>
			<nav class="collapse navbar-collapse col-lg-8 main-navig" id="navbar-collapse-1">
				<ul class="nav navbar-nav navbar-right">
					[[pdoMenu@mainMenu?
						&startId=`0`
						&tplParentRow=`@INLINE
						<li class="[[+classnames]] dropdown">
							<a href="[[+link]]" class="dropdown-toggle main-heading-a" [[+attributes]] data-toggle="dropdown">[[+menutitle]]<b class="caret"></b></a>
							<ul class="dropdown-menu">[[+wrapper]]</ul>
						</li>`
                        &tplParentRowHere=`@INLINE
                        <li class="[[+classnames]] dropdown">
                            <a href="#" class="dropdown-toggle main-heading-a" [[+attributes]] data-toggle="dropdown">[[+menutitle]]<b class="caret"></b></a>
                            <ul class="dropdown-menu">[[+wrapper]]</ul>
                        </li>`
                        &tplParentRowActive=`@INLINE
                        <li class="[[+classnames]] dropdown">
                            <a href="[[+link]]" class="dropdown-toggle main-heading-a" [[+attributes]] data-toggle="dropdown">[[+menutitle]]<b class="caret"></b></a>
                            <ul class="dropdown-menu">[[+wrapper]]</ul>
                        </li>`
                        &tplHere=`@INLINE <li class="[[+classnames]]"><span>[[+menutitle]]</span></li>`
						&tplOuter=`@INLINE [[+wrapper]]`
					]]
                    [[++themeclubcube.demo:is=`1`:then=`
                    <li class="dropdown left-dropdow">
                        <a href="" class="dropdown-toggle main-heading-a color-btn" data-toggle="dropdown">
                            <i class="fa fa-tint"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right" id="colorScheme">
                            <li [[+color:is=`default`:then=`class="active"`]]>
                                [[+color:is=`default`:then=`
                                    <span><i class="color-ic color-ic-reg"></i>Origin</span>
                                `:else=`
                                    <a href="?color=default" data-color="default"><i class="color-ic color-ic-reg"></i>Origin</a>
                                `]]
                            </li>
                            <li [[+color:is=`gold`:then=`class="active"`]]>
                                [[+color:is=`gold`:then=`
                                    <span><i class="color-ic color-ic-gd"></i>Gold</span>
                                `:else=`
                                    <a href="?color=gold" data-color="gold"><i class="color-ic color-ic-gd"></i>Gold</a>
                                `]]
                            </li>
                            <li [[+color:is=`basketball`:then=`class="active"`]] >
                                [[+color:is=`basketball`:then=`
                                    <span><i class="color-ic color-ic-bb"></i>Basketball</span>
                                `:else=`
                                    <a href="?color=basketball" data-color="basketball"><i class="color-ic color-ic-bb"></i>Basketball</a>
                                `]]
                            </li>
                            <li class="last [[++themeclubcube.color_scheme:is=`blueberry`:then=`active`]]">
                                [[+color:is=`blueberry`:then=`
                                    <span><i class="color-ic color-ic-bbr"></i>Blueberry</span>
                                `:else=`
                                    <a href="?color=blueberry" data-color="blueberry"><i class="color-ic color-ic-bbr"></i>Blueberry</a>
                                `]]
                            </li>
                        </ul>
                    </li>
                    `]]
				</ul>
			</nav>
		</div>
	</div>
</header>