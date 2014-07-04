<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">[[%lf_brand_name:htmlent]]</a>
		</div>
		<div class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				[[pdoMenu@mainMenu?
					&startId=`0`
					&level=`2`
					&tplParentRow=`@INLINE
					<li class="[[+classnames]] dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" [[+attributes]]>[[+menutitle]]<b class="caret"></b></a>
						<ul class="dropdown-menu">[[+wrapper]]</ul>
					</li>`
					&tplOuter=`@INLINE [[+wrapper]]`
				]]
			</ul>
		</div>
	</div>
</div>
<div class="container" role="main">