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
					[[- TODO убрать ссылки с активных пунктов меню]]
					[[pdoMenu@mainMenu?
						&startId=`0`
						&level=`2`
						&tplParentRow=`@INLINE
						<li class="[[+classnames]] dropdown">
							<a href="[[+link]]" class="dropdown-toggle main-heading-a" [[+attributes]] data-toggle="dropdown">[[+menutitle]]<b class="caret"></b></a>
							<ul class="dropdown-menu">[[+wrapper]]</ul>
						</li>`
                        &tplHere=`@INLINE <li class="[[+classnames]]"><span>[[+menutitle]]</span></li>`
						&tplOuter=`@INLINE [[+wrapper]]`
					]]
				</ul>
			</nav>
		</div>
	</div>
</header>