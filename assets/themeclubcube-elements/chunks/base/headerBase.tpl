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
			<div class="navbar-header col-lg-4 col-lg-offset-1">
				<div class="tile">
					<button class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<span class="home-btn">Home</span>
				</div>
				<a href="" class="navbar-brand first"></a>
			</div>
			<nav class="collapse navbar-collapse col-lg-8 main-navig" id="navbar-collapse-1">
				<ul class="nav navbar-nav navbar-right">
					[[pdoMenu@mainMenu?
						&startId=`0`
						&level=`2`
						&tplParentRow=`@INLINE
						<li class="[[+classnames]] dropdown">
							<a href="#" class="dropdown-toggle main-heading-a" [[+attributes]]>[[+menutitle]]<b class="caret"></b></a>
							<ul class="dropdown-menu">[[+wrapper]]</ul>
						</li>`
						&tplOuter=`@INLINE [[+wrapper]]`
					]]
				</ul>
			</nav>
		</div>
	</div>
</header>