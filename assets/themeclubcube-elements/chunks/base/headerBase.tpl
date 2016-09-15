<div class="wrap">
    <header id="header" class="header">
        <div class="container-fluid line">
            <div class="navbar-header"><a href="/" class="navbar-brand"><img src="[[++themeclubcube.design_url]]images/logo-w.png" alt=""></a>
                <button id="navbarToogle" type="button" class="navbar-toogle"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
            </div>
            <nav id="navbarCollapse" class="navbar-collapse">
                <ul id="navigation" class="navbar-list dl-menu">
                  [[pdoMenu@mainMenu?
                    &startId=`0`
                    &tplParentRow=`@INLINE
                      <li>
                        <a href="[[+link]]" [[+attributes]]>[[+menutitle]]<i class="fa fa-angle-right"></i></a>
                        <ul class="navbar-dropdown__menu dl-submenu">[[+wrapper]]</ul>
                      </li>`
                    &tplParentRowHere=`@INLINE
                      <li>
                        <a href="#" [[+attributes]]>[[+menutitle]]<i class="fa fa-angle-right"></i></a>
                        <ul class="navbar-dropdown__menu dl-submenu">[[+wrapper]]</ul>
                      </li>`
                    &tplParentRowActive=`@INLINE
                      <li>
                        <a href="[[+link]]" [[+attributes]]>[[+menutitle]]<i class="fa fa-angle-right"></i></a>
                        <ul class="navbar-dropdown__menu dl-submenu">[[+wrapper]]</ul>
                      </li>`
                    &tplHere=`@INLINE <li class="[[+classnames]]"><span>[[+menutitle]]</span></li>`
                    &tplOuter=`@INLINE [[+wrapper]]`
                  ]]
                </ul>
            </nav>
        </div>
    </header>
