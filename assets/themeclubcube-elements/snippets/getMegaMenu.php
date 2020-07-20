<?php
$mmId = $modx->getOption('themeclubcube.mega_menu', null, '12');
$flag = false;
if ($mmId == $resId)$flag = true;
else
{
    $parent = $modx->getObject('modResource', array('id' => $resId,))->get('parent');
    if ($parent == $mmId) $flag = true;
}
////////////////////////////////////////
//$menutitle.='['.$resId.'/'.$parent.'/'.$place.']';
if ($flag)
{
    if ($type == 'getClasses')
    {
        if ($place == 'tplHere')
        {
            return '
                <li class="col-sm-6 col-lg-3">
                    <a href="#"'.$attributes.'><b>'.$menutitle.'</b></a>
                </li>';
        }
        if ($place == 'tpl')
        {
            return '
                <li class="col-sm-6 col-lg-3">
                    <a href="'.$link.'" '.$attributes.'><b>'.$menutitle.'</b></a>
                    '.$wrapper.'
                </li>';
        }
        if ($place == 'tplParentRowActive')
        {
            return '
                <li class="navbar__item-mega-menu">
                    <a href="#" '.$attributes.'>'.$menutitle.'<i class="fa fa-angle-right"></i></a>
                    <div class="mega-menu dl-submenu">
                        <ul class="mega-menu__list">
                            '.$wrapper.'
                        
                    </div>
                </li>';
        }
        if ($place == 'tplParentRowHere')
        {
            return '
                <li class="navbar__item-mega-menu">
                    <a href="#" '.$attributes.'>'.$menutitle.'<i class="fa fa-angle-right"></i></a>
                    <div class="mega-menu dl-submenu">
                        <ul class="mega-menu__list">
                            '.$wrapper.'
                        
                    </div>
                </li>';
        }
        if ($place == 'tplParentRow')
        {
            return '
                <li class="navbar__item-mega-menu">
                    <a href="#" '.$attributes.'>'.$menutitle.'<i class="fa fa-angle-right"></i></a>
                    <div class="mega-menu dl-submenu">
                        <ul class="mega-menu__list">
                            '.$wrapper.'
                        
                    </div>
                </li>';
        }
    }elseif ($type == 'setMenu')
    {
        if ($mmId == $resId)
        {
            $eventsOne = $modx->runSnippet('pdoResources',array(
                'tpl' => '@INLINE 
                            <div class="c-box c-box--sm">
                                <div class="c-box__inner">
                                    <div data-bgimage="[[+imgSquare]]" class="b-box__img-wrap b-box__grdnt-b bg-image"></div>
                                    <div class="c-box__cont">
                                        <h6 class="c-box__ttl-s6">[[+pagetitle]]</h6>
                                    </div>
                                    <div class="c-box__date-item c-box__date-item--float">
                                        <time datetime="[[+timeStart]]" class="date-sm c-box__date c-box__date--sm"><span class="date-sm__dt">[[+timeStart:strtotime:date=`%d`]]</span><span class="date-sm__rh"><span class="date-sm__rh-m">[[%lf_month_short.[[+timeStart:strtotime:date=`%m`]]]]</span><span class="date-sm__rh-d">[[+timeStart:strtotime:date=`%Y`]]</span></span><span class="date__ad">[[+timeStart:strtotime:date=`%H`]]:[[+timeStart:strtotime:date=`%M`]] [[+timeStart:strtotime:date=`%P`]]</span></time>
                                    </div><a href="[[~[[+id]]]]" class="b-box__link"></a>
                                </div>
                            </div>',
                'parents' => $modx->getOption('themeclubcube.events_resource'),
                'tvPrefix' => '',
                'limit' => '3',
                'includeTVs' => 'imgSquare, timeStart, topEvent',
                'tvFilters' => 'topEvent==1',
            ));
            $eventsTwo = $modx->runSnippet('pdoResources',array(
                'tpl' => '@INLINE 
                            <div class="c-box__inner">
                                <div data-bgimage="[[+imgSquare]]" class="b-box__img-wrap b-box__grdnt-b bg-image"></div>
                                <div class="c-box__cont">
                                    <h6 class="c-box__ttl-s6">[[+pagetitle]]</h6>
                                </div>
                                <div class="c-box__date-item c-box__date-item--float">
                                    <time datetime="[[+timeStart]]" class="date-sm c-box__date c-box__date--sm"><span class="date-sm__dt">[[+timeStart:strtotime:date=`%d`]]</span><span class="date-sm__rh"><span class="date-sm__rh-m">[[%lf_month_short.[[+timeStart:strtotime:date=`%m`]]]]</span><span class="date-sm__rh-d">[[+timeStart:strtotime:date=`%Y`]]</span></span><span class="date__ad">[[+timeStart:strtotime:date=`%H`]]:[[+timeStart:strtotime:date=`%M`]] [[+timeStart:strtotime:date=`%P`]]</span></time>
                                </div>
                                <div class="c-box__link-wrap">
                                    <div class="btn-pointer__wrap">
                                        <a class="btn btn-pointer__sm btn-anim-a" href="[[~[[+id]]]]"><b>join event</b></a>
                                        <svg class="btn-pointer__left" x="0px" y="0px"
                                             viewBox="0 0 10 50" style="enable-background:new 0 0 10 50;" xml:space="preserve">
                                        <path class="st0" fill="#A82743" d="M10,50H0l5-5l-5-5l0,0v0l0,0l5-5l-5-5l0,0v0l0,0l5-5l-5-5l0,0v0l0,0l5-5l-5-5l0,0v0l0,0l5-5L0,0l0,0v0h10V50z"/></svg>

                                    </div>
                                </div><a href="[[~[[+id]]]]" class="b-box__link"></a>
                            </div>',
                'parents' => $modx->getOption('themeclubcube.events_resource'),
                'tvPrefix' => '',
                'limit' => '1',
                'offset' => '3',
                'includeTVs' => 'imgSquare, timeStart, topEvent',
                'tvFilters' => 'topEvent==1',
            ));
            //////////////
            return '</ul>
                    <div class="navbar__hr-wrap">
                        <div class="hr-line"></div>
                        <div class="hr-line"></div>
                        <div class="hr-line"></div>
                    </div>
                    <div class="mega-menu__events-wrap row">
                        <div class="mega-menu__events col-lg-6">
                            <div class="row">
                                <div class="mega-menu__events-list col-sm-6">
                                    '.$eventsOne.'
                                </div>
                                <div class="c-box c-box--sm col-sm-6">
                                    '.$eventsTwo.'
                                </div>
                            </div>
                        </div>
                        <div class="mega-menu__content col-lg-6">
                            <div class="row">
                                <div class="mega-menu__item-cont col-sm-6">
                                    <h6 class="mega-menu__ttl-s6">[[%lf_megamenu_title_one]]</h6>
                                    <p>
                                        [[%lf_megamenu_text_one]]
                                    </p>
                                </div>
                                <div class="mega-menu__item-cont col-sm-6">
                                    <h6 class="mega-menu__ttl-s6">[[%lf_megamenu_title_two]]</h6>
                                    <p class="mega-menu__txt">
                                        [[%lf_megamenu_text_two]]
                                    </p>
                                    <form action="/" method="GET" class="b-form b-form--inline">
                                        <div class="b-form__group">
                                            <input type="email" placeholder="Your E-mail" class="b-form__control">
                                        </div>
                                        <button type="submit" class="b-form__btn">Subscribe</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>';
        }
    }
}else
{
    if ($place == 'tplHere')
    {
        return '
                    <li class="'.$classnames.'"><span>'.$menutitle.'</span></li>';
    }
    if ($place == 'tpl')
    {
        return '
                    <li'.$classes.'>
                        <a href="'.$link.'" '.$attributes.'>'.$menutitle.'</a>
                        '.$wrapper.'
                    </li>';
    }
    if ($place == 'tplParentRowActive')
    {
        return '
                    <li>
                        <a href="#" '.$attributes.'>'.$menutitle.'<i class="fa fa-angle-right"></i></a>
                        <ul class="navbar-dropdown__menu dl-submenu">'.$wrapper.'</ul>
                    </li>';
    }
    if ($place == 'tplParentRowHere')
    {
        return '
                    <li>
                        <a href="#" '.$attributes.'>'.$menutitle.'<i class="fa fa-angle-right"></i></a>
                        <ul class="navbar-dropdown__menu dl-submenu">'.$wrapper.'</ul>
                    </li>';
    }
    if ($place == 'tplParentRow')
    {
        return '
                    <li>
                        <a href="#" '.$attributes.'>'.$menutitle.'<i class="fa fa-angle-right"></i></a>
                        <ul class="navbar-dropdown__menu dl-submenu">'.$wrapper.'</ul>
                    </li>';
    }
}
//$mmId = $modx->getOption('themeclubcube.mega_menu', null, '12');
//
