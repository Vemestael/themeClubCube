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
                    <li class="navbar__tint"><a href="#"><span class="fa fa-tint"></span><i class="fa fa-angle-right"></i></a>
                        <ul class="navbar-dropdown__menu dl-submenu">
                            <li id="fullWide" class="navbar__tint-wide active wide"><span>wide</span></li>
                            <li class="navbar-dropdown__submenu navbar__tint-wide"><span>boxed<i class="fa fa-angle-right"></i></span>
                                <ul class="navbar-list__inner dl-submenu">
                                    <li data-ptrn="circle" class="pattern circle"><span>Circle pattern</span></li>
                                    <li data-ptrn="triangle" class="pattern triangle"><span>Triangle pattern</span></li>
                                    <li data-ptrn="solid" class="pattern solid"><span>Solid Color</span></li>
                                    <li data-ptrn="waves" class="pattern waves"><span>Waves pattern</span></li>
                                </ul>
                            </li>
                            <li class="navbar__hr-wrap">
                                <div class="hr-line"></div>
                                <div class="hr-line"></div>
                            </li>

                            <li data-skin="green" class="clr-picker green [[-!+color:is=`green-violet`:then=`active`]]">
                                [[-!+color:is=`green-violet`:then=`
                                    <span>green/violet</span>
                                `:else=`]]
                                    <a href="?color=green-violet"><span>green/violet</span></a>
                                [[-`]]
                            </li>
                            <li data-skin="orange" class="clr-picker orange [[-!+color:is=`orange-red`:then=`active`]]">
                                [[-!+color:is=`orange-red`:then=`
                                <span>orange/red</span>
                                `:else=`]]
                                <a href="?color=orange-red"><span>orange/red</span></a>
                                [[-`]]
                            </li>
                            <li data-skin="crimson" class="clr-picker crimson [[-!+color:is=`crimson-cyan`:then=`active`]]">
                                [[-!+color:is=`crimson-cyan`:then=`
                                <span>crimson/cyan</span>
                                `:else=`]]
                                <a href="?color=crimson-cyan"><span>crimson/cyan</span></a>
                                [[-`]]
                            </li>
                            <li data-skin="yellow" class="clr-picker yellow [[-!+color:is=`yellow-pink`:then=`active`]]">
                                [[-!+color:is=`yellow-pink`:then=`
                                <span>yellow/pink</span>
                                `:else=`]]
                                <a href="?color=yellow-pink"><span>yellow/pink</span></a>
                                [[-`]]
                            </li>
                            <li data-skin="brown" class="clr-picker brown [[-!+color:is=`brown-gray`:then=`active`]]">
                                [[-!+color:is=`brown-gray`:then=`
                                <span>brown/gray</span>
                                `:else=`]]
                                <a href="?color=brown-gray"><span>brown/gray</span></a>
                                [[-`]]
                            </li>
                            <!--
                            <li data-skin="green" class="clr-picker green"><span>green/violet</span></li>
                            <li data-skin="orange" class="clr-picker orange"><span>orange/red</span></li>
                            <li data-skin="crimson" class="clr-picker crimson"><span>crimson/cyan</span></li>
                            <li data-skin="yellow" class="clr-picker yellow"><span>yellow/pink</span></li>
                            <li data-skin="brown" class="clr-picker brown"><span>brown/gray</span></li>-->
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </header>
