<?php

/*
* Create documents
*/
function createDocsDemo(&$modx, $context_key, $node, $doc = null){
    $base_params = array(
        'update'        => true,
    );

    if(isset($node['childs'])){
        $menuIndex = 0;
        foreach($node['childs'] as $resource => $options){
            $classKey = 'modResource';
            $keyInName = explode(':',$resource);
            if(isset($keyInName[1])) {
                $classKey = $keyInName[1];
            }

            $menuIndex++;
            $pid = ($doc ? $doc->id : 0);
            $params = array_merge($base_params, $options);
            $params['parent']    =  $pid;
            if(!$doc__ = $modx->getObject($classKey,
                $params['parentCheck'] ?
                    array(
                        'context_key' => $context_key,
                        'alias'     =>  $params['alias'],
                    )
                :
                    array(
                        'context_key' => $context_key,
                        'parent'    =>  $pid,
                        'alias'     =>  $params['alias'],
                    )
            )){
                $params['menuindex'] = $menuIndex;
                $doc__ = $modx->newObject($classKey);
                $doc__->fromArray($params,'',true,true);
                $doc__->cleanAlias($params['alias']);
                if(!$doc__->save()){
                    $modx->log(xPDO::LOG_LEVEL_ERROR, "Can not save {$params['pagetitle']} document");
                } else {
                    $modx->log(modX::LOG_LEVEL_INFO,'Create resource '.$params['pagetitle'].'.');
                }
            }
            else if($params['update'] === true){
                $doc__->fromArray($params);
                if(!$doc__->save()){
                    $modx->log(xPDO::LOG_LEVEL_ERROR, "Can not update {$params['pagetitle']} document");
                } else {
                    $modx->log(modX::LOG_LEVEL_INFO,'Update resource '.$params['pagetitle'].'.');
                }
            }
            if(isset($params['group']) && !empty($params['group'])) {
                $doc__->joinGroup($params['group']);
                $modx->log(modX::LOG_LEVEL_INFO,'Join resource '.$params['pagetitle'].' to group '.$params['group'].'.');
            }

            if(isset($params['tvs']) && !empty($params['tvs'])) {
                foreach($params['tvs'] as $tvName => $value) {
                    $tv = $modx->getObject('modTemplateVar',array('name' => $tvName));
                    if (empty($tv)) {
                        $modx->log(xPDO::LOG_LEVEL_ERROR,'Could not find TV: '.$tvName.' to associate to Templates.');
                        continue;
                    }

                    $templateVarResource = $modx->getObject('modTemplateVarResource',array(
                        'tmplvarid' => $tv->get('id'),
                        'contentid' => $doc__->get('id'),
                    ));
                    if (!$templateVarResource) {
                        $templateVarResource = $modx->newObject('modTemplateVarResource');
                        $templateVarResource->fromArray(array(
                            'tmplvarid' => $tv->get('id'),
                            'contentid' => $doc__->get('id'),
                            'value' => $value,
                        ),'',true,true);

                        if ($templateVarResource->save() == false) {
                            $modx->log(xPDO::LOG_LEVEL_ERROR,'An unknown error occurred while trying to associate the TV '.$tvName.' to the Resource '.$doc__->get('id'));
                        }
                    }
                }
            }

            createDocsDemo($modx, $context_key, $options, $doc__);
        }
    }
}

/*
 * Content
 */

function getIntroDemo($content){
    $intro = substr(strip_tags($content),0, 200);
    return $intro;
}

$content_index_demo1 = '
[[$metaBase]]
[[$headerBase]]
[[pdoResources@indexSlider?
	&parents=`[[++themeclubcube.events_resource]]`
	&includeTVs=`timeStart,price,lineUp,promoEvent,promoImg`
	&processTVs=`promoImg`
	&tvPrefix=``
	&tplWrapper=`eventsListFixedPromoIndex`
	&tpl=`eventsItemFixedPromoIndex`
	&tvFilters=`timeStart>=[[getDate? &format=`Y-m-d 00:00:00`]],promoEvent==1`
]]

[[pdoResources@indexEvents?
	&parents=`[[++themeclubcube.events_resource]]`
	&includeTVs=`img,timeStart,price,lineUp,topEvent`
	&processTVs=`img`
	&tvPrefix=``
	&tplWrapper=`eventsListIndex`
	&tpl=`eventsItemIndex`
	&tvFilters=`timeStart>=[[getDate? &format=`Y-m-d 00:00:00`]],topEvent==1`
]]

[[pdoResources@indexGallery?
	&parents=`[[++themeclubcube.gallery_resource]]`
	&includeTVs=`img`
	&processTVs=`img`
	&tvPrefix=``
	&tplWrapper=`galleryListSliderIndex`
	&tpl=`galleryItemBigIndex`
]]

[[pdoResources@indexBlog?
	&parents=`[[++themeclubcube.blog_resource]]`
	&includeTVs=`img`
	&processTVs=`img`
	&tvPrefix=``
	&tplWrapper=`blogListIndex`
	&tpl=`blogItemTileIndex`
]]

[[pdoResources@indexPartners?
	&parents=`[[++themeclubcube.partners_resource]]`
	&includeTVs=`img`
	&processTVs=`img`
	&tvPrefix=``
	&tplWrapper=`partnersListIndex`
	&tpl=`partnersItemIndex`
]]
[[$footerBase]]
';

$content_article_blog6 = '
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin tincidunt placerat risus, nec pharetra nibh. Donec hendrerit eros non sapien tempor vestibulum. Etiam eu tempus enim. Donec vehicula lectus vitae magna gravida pulvinar. Praesent id dolor tincidunt, malesuada turpis nec, maximus massa. Aenean luctus eget quam sit amet lobortis. Suspendisse et augue varius, blandit quam id, efficitur ipsum. Sed finibus ipsum at velit consectetur iaculis. Etiam volutpat faucibus mauris ut dictum. Duis mattis augue ut ultrices feugiat.</p>
<p>Donec sed elementum sapien. In id ante quis tellus viverra facilisis. Mauris lobortis vestibulum diam. Etiam viverra ac orci molestie dapibus. Aenean pharetra quis nulla ut vestibulum. Nullam dapibus porta magna eu placerat. Maecenas in libero nibh. Suspendisse nec dolor tortor. Nunc convallis felis eu elementum finibus. Vestibulum faucibus nisi massa. Ut cursus velit in lacus tristique accumsan. Quisque pellentesque metus ac sapien lobortis, id efficitur neque maximus. Nullam at nisi vestibulum, pharetra libero vitae, gravida turpis. Integer congue mi viverra, ornare mauris eget, mollis massa. Nam eleifend, mauris vitae posuere auctor, magna felis porttitor magna, quis laoreet dui mauris vitae elit.</p>
<p>Nullam sed nulla in turpis ultricies consectetur non eget quam. Donec aliquet eu urna sed maximus. Curabitur placerat varius aliquam. Nulla ante odio, ullamcorper at dignissim a, imperdiet sit amet lorem. Nulla hendrerit ullamcorper est, at aliquam quam rhoncus vel. Maecenas gravida libero eget dolor rutrum, feugiat blandit nibh malesuada. Curabitur tincidunt imperdiet leo, ut maximus massa scelerisque ac. Vivamus id mauris facilisis, fringilla elit quis, consequat velit. In nulla tellus, porta eu laoreet varius, accumsan id quam. Nullam molestie sodales mollis. Nulla accumsan sapien non posuere eleifend. Maecenas scelerisque in dui vel volutpat. Aliquam id massa non lorem facilisis dignissim in quis urna. Phasellus ac egestas nisi.</p>
<p>Sed at iaculis dolor, vel semper augue. Quisque suscipit nunc volutpat pellentesque sodales. Cras vitae euismod erat. Aenean euismod lorem rhoncus, mollis orci eu, finibus massa. Nunc gravida efficitur orci vitae sollicitudin. Aliquam varius dictum consectetur. In ullamcorper dapibus tincidunt. Nunc neque mi, pharetra eu eros quis, pharetra suscipit metus. Phasellus at ultrices arcu, id fringilla lectus.</p>
<p>Curabitur vel nibh at tortor faucibus facilisis vel nec neque. Nunc ut tempus libero. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aliquam placerat augue velit, ut sodales odio eleifend in. In vehicula lacinia finibus. Nullam condimentum elit et mi dignissim pretium. Praesent auctor, dolor sit amet hendrerit molestie, arcu tortor volutpat tellus, quis sagittis justo felis id odio. Vestibulum dolor ex, accumsan ut efficitur sed, faucibus luctus ex. Ut venenatis euismod fringilla. Donec nec aliquet lacus.</p>
';

$content_contacts = '
<h2>Address:</h2>
<ul>
<li><b>Country:</b> Ukraine</li>
<li><b>City:</b> Mariupol</li>
<li><b>Address:</b> Kazanceva 7b, office 29</li>
<li><b>Phone:</b>+38 (000) 000 00 00</li>
</ul>
';

$content_design_elements = '
<div class="table-responsive">
<table class="table club-table container table-striped">
    <thead>
        <tr>
            <th>ELEMENT</th>
            <th>Inactive</th>
            <th>Regular</th>
            <th>Hover</th>
            <th>Press</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Button 1</td>
            <td> <a href="" class="read-more off">Read more</a></td>
            <td> <a href="" class="read-more">Read more</a></td>
            <td> <a href="" class="read-more hover">Read more</a></td>
            <td> <a href="" class="read-more pressed">Read more</a></td>
        </tr>
        <tr>
            <td>Button 2</td>
            <td>
                <div class="left-pag off">
                    <div class="pad-arr"><i></i></div>
                    <div class="pad-text">
                        <div class="pad-title">Prev week</div>
                        <div class="pad-dates">21 April ... 12 September</div>
                    </div>
                </div>
            </td>
            <td>
                <div class="left-pag">
                    <div class="pad-arr"><i></i></div>
                    <div class="pad-text">
                        <div class="pad-title">Prev week</div>
                        <div class="pad-dates">21 April ... 12 September</div>
                    </div>
                </div>
            </td>
            <td>
                <div class="left-pag hover">
                    <div class="pad-arr"><i></i></div>
                    <div class="pad-text">
                        <div class="pad-title">Prev week</div>
                        <div class="pad-dates">21 April ... 12 September</div>
                    </div>
                </div>
            </td>
            <td>
                <div class="left-pag pressed">
                    <div class="pad-arr"><i></i></div>
                    <div class="pad-text">
                        <div class="pad-title">Prev week</div>
                        <div class="pad-dates">21 April ... 12 September</div>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td>Button Slider</td>
            <td>
                <button class="button-slider off"></button>
            </td>
            <td>
                <button class="button-slider"></button>
            </td>
            <td>
                <button class="button-slider hover"></button>
            </td>
            <td>
                <button class="button-slider pressed"></button>
            </td>
        </tr>
        <tr>
            <td>Button Arrow</td>
            <td>
                <div class="button-arrow-left off">

                </div>
            </td>
            <td>
                <div class="button-arrow-left">

                </div>
            </td>
            <td>
                <div class="button-arrow-left hover">

                </div>
            </td>
            <td>
                <div class="button-arrow-left pressed">

                </div>
            </td>
        </tr>
        <tr>
            <td>Button Filter Checked</td>
            <td>
                <div class="button-filter checked off">
                    <span class="button-filter-text">News</span>
                    <div class="button-filter-arr">
                        <div class="button-filter-line left"></div>
                        <div class="button-filter-line right"></div>
                    </div>
                </div>
            </td>
            <td>
                <div class="button-filter checked">
                    <span class="button-filter-text">News</span>
                    <div class="button-filter-arr">
                        <div class="button-filter-line left"></div>
                        <div class="button-filter-line right"></div>
                    </div>
                </div>
            </td>
            <td>
                <div class="button-filter checked hover">
                    <span class="button-filter-text">News</span>
                    <div class="button-filter-arr">
                        <div class="button-filter-line left"></div>
                        <div class="button-filter-line right"></div>
                    </div>
                </div>
            </td>
            <td>
                <div class="button-filter checked pressed">
                    <span class="button-filter-text">News</span>
                    <div class="button-filter-arr">
                        <div class="button-filter-line left"></div>
                        <div class="button-filter-line right"></div>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td>Button Filter Unchecked</td>
            <td>
                <div class="button-filter unchecked off">
                    <span class="button-filter-text">News</span>
                    <div class="button-filter-arr">
                        <div class="button-filter-line left"></div>
                        <div class="button-filter-line right"></div>
                    </div>
                </div>
            </td>
            <td>
                <div class="button-filter unchecked">
                    <span class="button-filter-text">News</span>
                    <div class="button-filter-arr">
                        <div class="button-filter-line left"></div>
                        <div class="button-filter-line right"></div>
                    </div>
                </div>
            </td>
            <td>
                <div class="button-filter unchecked hover">
                    <span class="button-filter-text">News</span>
                    <div class="button-filter-arr">
                        <div class="button-filter-line left"></div>
                        <div class="button-filter-line right"></div>
                    </div>
                </div>
            </td>
            <td>
                <div class="button-filter unchecked pressed">
                    <span class="button-filter-text">News</span>
                    <div class="button-filter-arr">
                        <div class="button-filter-line left"></div>
                        <div class="button-filter-line right"></div>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td>Button More Blogs</td>
            <td>
                <div class="button-more off">
                    <div class="button-filter-arr">
                        <div class="button-filter-line left"></div>
                        <div class="button-filter-line right"></div>
                    </div>
                    <span class="button-filter-text">More Blogs</span>

                </div>
            </td>
            <td>
                <div class="button-more">
                    <div class="button-filter-arr">
                        <div class="button-filter-line left"></div>
                        <div class="button-filter-line right"></div>
                    </div>
                    <span class="button-filter-text">More Blogs</span>

                </div>
            </td>
            <td>
                <div class="button-more hover">
                    <div class="button-filter-arr">
                        <div class="button-filter-line left"></div>
                        <div class="button-filter-line right"></div>
                    </div>
                    <span class="button-filter-text">More Blogs</span>

                </div>
            </td>
            <td>
                <div class="button-more pressed">
                    <div class="button-filter-arr">
                        <div class="button-filter-line left"></div>
                        <div class="button-filter-line right"></div>
                    </div>
                    <span class="button-filter-text">More Blogs</span>

                </div>
            </td>
        </tr>
        <tr>
            <td>Button DropDown</td>
            <td>
                <div class="button-dropdown off">
                    <div class="button-dropdown-text">
                        <div class="dropdown-text-title">This week</div>
                        <div class="dropdown-text-dates">21 April ... 12 September</div>
                    </div>
                    <div class="button-dropdown-arr">
                        <i></i>
                    </div>
                </div>
            </td>
            <td>
                <div class="button-dropdown">
                    <div class="button-dropdown-text">
                        <div class="dropdown-text-title">This week</div>
                        <div class="dropdown-text-dates">21 April ... 12 September</div>
                    </div>
                    <div class="button-dropdown-arr">
                        <i></i>
                    </div>
                </div>
            </td>
            <td>
                <div class="button-dropdown hover">
                    <div class="button-dropdown-text">
                        <div class="dropdown-text-title">This week</div>
                        <div class="dropdown-text-dates">21 April ... 12 September</div>
                    </div>
                    <div class="button-dropdown-arr">
                        <i></i>
                    </div>
                </div>
            </td>
            <td>
                <div class="button-dropdown pressed">
                    <div class="button-dropdown-text">
                        <div class="dropdown-text-title">This week</div>
                        <div class="dropdown-text-dates">21 April ... 12 September</div>
                    </div>
                    <div class="button-dropdown-arr">
                        <i></i>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td>DropDown List</td>
            <td>
                <div class="dropdown-list off">
                    <div class="button-dropdown-text off">
                        <div class="dropdown-text-title">This week</div>
                        <div class="dropdown-text-dates">21 April ... 12 September</div>
                    </div>
                    <div class="button-dropdown-text off">
                        <div class="dropdown-text-title">This week</div>
                        <div class="dropdown-text-dates">21 April ... 12 September</div>
                    </div>
                    <div class="button-dropdown-text off">
                        <div class="dropdown-text-title">This week</div>
                        <div class="dropdown-text-dates">21 April ... 12 September</div>
                    </div>
                </div>
            </td>
            <td>
                <div class="dropdown-list">
                    <div class="button-dropdown-text">
                        <div class="dropdown-text-title">This week</div>
                        <div class="dropdown-text-dates">21 April ... 12 September</div>
                    </div>
                    <div class="button-dropdown-text">
                        <div class="dropdown-text-title">This week</div>
                        <div class="dropdown-text-dates">21 April ... 12 September</div>
                    </div>
                    <div class="button-dropdown-text">
                        <div class="dropdown-text-title">This week</div>
                        <div class="dropdown-text-dates">21 April ... 12 September</div>
                    </div>
                </div>
            </td>
            <td>
                <div class="dropdown-list">
                    <div class="button-dropdown-text hover">
                        <div class="dropdown-text-title">This week</div>
                        <div class="dropdown-text-dates">21 April ... 12 September</div>
                    </div>
                    <div class="button-dropdown-text hover">
                        <div class="dropdown-text-title">This week</div>
                        <div class="dropdown-text-dates">21 April ... 12 September</div>
                    </div>
                    <div class="button-dropdown-text hover">
                        <div class="dropdown-text-title">This week</div>
                        <div class="dropdown-text-dates">21 April ... 12 September</div>
                    </div>
                </div>
            </td>
            <td>
                <div class="dropdown-list">
                    <div class="button-dropdown-text pressed">
                        <div class="dropdown-text-title">This week</div>
                        <div class="dropdown-text-dates">21 April ... 12 September</div>
                    </div>
                    <div class="button-dropdown-text pressed">
                        <div class="dropdown-text-title">This week</div>
                        <div class="dropdown-text-dates">21 April ... 12 September</div>
                    </div>
                    <div class="button-dropdown-text pressed">
                        <div class="dropdown-text-title">This week</div>
                        <div class="dropdown-text-dates">21 April ... 12 September</div>
                    </div>
                </div>
            </td>
        </tr>
        <tr class="padding-b-no">
            <td>Tab</td>
            <td>
                <div class="tab-custom off">
                    <div class="dropdown-text-title">This week</div>
                    <div class="dropdown-text-dates">21 April ... 12 September</div>
                    <div class="tab-custom-line"></div>
                </div>
            </td>
            <td>
                <div class="tab-custom">
                    <div class="dropdown-text-title">This week</div>
                    <div class="dropdown-text-dates">21 April ... 12 September</div>
                    <div class="tab-custom-line"></div>
                </div>
            </td>
            <td>
                <div class="tab-custom hover">
                    <div class="dropdown-text-title">This week</div>
                    <div class="dropdown-text-dates">21 April ... 12 September</div>
                    <div class="tab-custom-line"></div>
                </div>
            </td>
            <td>
                <div class="tab-custom pressed">
                    <div class="dropdown-text-title">This week</div>
                    <div class="dropdown-text-dates">21 April ... 12 September</div>
                    <div class="tab-custom-line"></div>
                </div>
            </td>
        </tr>
        <tr>
            <td>Menu</td>
            <td>
                <ul class="mob-menu">
                    <li><a href="" class="off">Home Slider</a></li>
                    <li><a href="" class="off">Home Video</a></li>
                </ul>
            </td>
            <td>
                <ul class="mob-menu">
                    <li><a href="">Home Slider</a></li>
                    <li><a href="">Home Video</a></li>
                </ul>
            </td>
            <td>
                <ul class="mob-menu">
                    <li><a href="" class="hover">Home Slider</a></li>
                    <li><a href="" class="hover">Home Video</a></li>
                </ul>
            </td>
            <td>
                <ul class="mob-menu">
                    <li><a href="" class="pressed">Home Slider</a></li>
                    <li><a href="" class="pressed">Home Video</a></li>
                </ul>
            </td>
        </tr>
        <tr>
            <td>Radio</td>
            <td>
                <div class="radio-b">
                    <input class="off-rb" type="radio" name="" id="radio1" >
                    <label class="off-lb rb-lb" for="radio1">Radio 1</label>
                    <input class="off-rb" type="radio" name="" id="radio12" >
                    <label class="off-lb rb-lb" for="radio12">Radio 2</label>
                    <input class="off-rb" type="radio" name="" id="radio2" checked>
                    <label class="off-lb rb-lb" for="radio2">Radio 3</label>
                </div>
            </td>
            <td>
                <div class="radio-b">
                    <input type="radio" name="" id="radio3">
                    <label class="rb-lb" for="radio3">Radio 1</label>
                    <input type="radio" name="" id="radio31">
                    <label class="rb-lb" for="radio31">Radio 2</label>
                    <input type="radio" name="" id="radio4">
                    <label class="rb-lb active" for="radio4">Radio 3</label>
                </div>
            </td>
            <td>
                <div class="radio-b">
                    <input class="hover-rb" type="radio" name="" id="radio5" checked>
                    <label class="hover-lb rb-lb" for="radio5">Radio 1</label>
                    <input class="hover-rb" type="radio" name="" id="radio51" checked>
                    <label class="hover-lb rb-lb" for="radio51">Radio 2</label>
                    <input class="hover-rb" type="radio" name="" id="radio6" checked>
                    <label class="hover-lb rb-lb" for="radio6">Radio 3</label>
                </div>
            </td>
            <td>
                <div class="radio-b">
                    <input class="pressed-rb" type="radio" name="" id="radio7" checked>
                    <label class="pressed-lb rb-lb" for="radio7">Radio 1</label>
                    <input class="pressed-rb" type="radio" name="" id="radio71" checked>
                    <label class="pressed-lb rb-lb" for="radio71">Radio 2</label>
                    <input class="pressed-rb" type="radio" name="" id="radio8" checked>
                    <label class="pressed-lb rb-lb" for="radio8">Radio 3</label>
                </div>
            </td>
        </tr>
        <tr>
            <td>Checkbox</td>
            <td>
                <div class="checkbox-b">
                    <input class="off-chb" type="checkbox" name="" id="checkbox1" checked>
                    <label class="chb-lb off-lb" for="checkbox1">Checkbox 1</label>
                    <input class="off-chb" type="checkbox" name="" id="checkbox2" checked>
                    <label class="chb-lb off-lb" for="checkbox2">Checkbox 2</label>
                </div>
            </td>
            <td>
                <div class="checkbox-b">
                    <input type="checkbox" name="" id="checkbox3" >
                    <label class="chb-lb" for="checkbox3">Checkbox 1</label>
                    <input type="checkbox" name="" id="checkbox4" >
                    <label class="chb-lb" for="checkbox4">Checkbox 2</label>
                </div>
            </td>
            <td>
                <div class="checkbox-b">
                    <input class="hover-chb" type="checkbox" name="" id="checkbox5" checked>
                    <label class="hover-lb chb-lb" for="checkbox5">Checkbox 1</label>
                    <input class="hover-chb" type="checkbox" name="" id="checkbox6" checked>
                    <label class="hover-lb chb-lb" for="checkbox6">Checkbox 2</label>
                </div>
            </td>
            <td>
                <div class="checkbox-b">
                    <input class="pressed-chb" type="checkbox" name="" id="checkbox7" checked>
                    <label class="pressed-lb chb-lb" for="checkbox7">Checkbox 1</label>
                    <input class="pressed-chb" type="checkbox" name="" id="checkbox8" checked>
                    <label class="pressed-lb chb-lb" for="checkbox8">Checkbox 2</label>
                </div>
            </td>
        </tr>
    </tbody>
</table>
</div>
<div class="table-responsive">
<table class="club-table container table-striped">
    <thead>
        <tr>
            <th>Element</th>
            <th>Inactive</th>
            <th>Regular</th>
            <th>Focus</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Text field</td>
            <td>
                <form action="" role="form">
                    <div class="form-group">
                        <label class="sr-only" for="input-13">Subscribe:</label>
                        <input type="text" class="form-control off" id="input-13"  placeholder="Subscribe:" disabled>
                    </div>
                </form>
            </td>
            <td>
                <form action="" role="form">
                    <div class="form-group">
                        <label class="sr-only" for="input-14">Subscribe:</label>
                        <input type="text" class="form-control" id="input-14" placeholder="Subscribe:">
                    </div>
                </form>
            </td>
            <td>
                <form action="" role="form">
                    <div class="form-group">
                        <label class="sr-only" for="input-15">Subscribe:</label>
                        <input type="text" class="form-control pressed" id="input-15" placeholder="myemail@mail.com">
                    </div>
                </form>
            </td>
        </tr>
        <tr>
            <td>Text field + label</td>
            <td>
                <form action="" class="form-horizontal" role="form">
                    <div class="form-group">
                        <label for="emeil1" class="col-sm-3 control-label off">Subscribe:</label>
                        <div class="col-sm-9">
                            <input type="email" id="emeil1" class="form-control off" disabled>
                        </div>
                    </div>
                </form>
            </td>
            <td>
                <form action="" class="form-horizontal" role="form">
                    <div class="form-group">
                        <label for="emeil2" class="col-sm-3 control-label">Subscribe:</label>
                        <div class="col-sm-9">
                            <input type="email" id="emeil2" class="form-control">
                        </div>
                    </div>
                </form>
            </td>
            <td>
                <form action="" class="form-horizontal" role="form">
                    <div class="form-group">
                        <label for="emeil3" class="col-sm-3 control-label pressed">Subscribe:</label>
                        <div class="col-sm-9">
                            <input type="email" id="emeil3" class="form-control pressed" placeholder="@mail.com">
                        </div>
                    </div>
                </form>
            </td>
        </tr>
        <tr>
            <td>Text dropdown</td>
            <td>
                <form action="" role="form">
                    <span class="select-dropdown off">
                    <select name="" id="" class="form-control" disabled>
                        <option value="Option 1" class="option">Option 1</option>
                        <option value="Option 2" class="option">Option 2</option>
                        <option value="Option 3" class="option">Option 3</option>
                    </select>
                    </span>
                </form>
            </td>
            <td>
                <form action="" role="form">
                    <span class="select-dropdown">
                    <select name="" id="" class="form-control">
                        <option value="Option 1" class="option">Option 1</option>
                        <option value="Option 2" class="option">Option 2</option>
                        <option value="Option 3" class="option">Option 3</option>
                    </select>
                    </span>
                </form>
            </td>
            <td>
                <form action="" role="form">
                    <span class="select-dropdown pressed">
                    <select name="" id="" class="form-control">
                        <option value="Option 1" class="option">Option 1</option>
                        <option value="Option 2" class="option">Option 2</option>
                        <option value="Option 3" class="option">Option 3</option>
                    </select>
                    </span>
                </form>
            </td>
        </tr>
        <tr>
            <td>Text multiline</td>
            <td>
                <form action="" role="form">
                    <textarea class="form-control off" name="" id="" cols="20" rows="5" disabled>Your message:
                    </textarea>
                </form>
            </td>
            <td>
                <form action="" role="form">
                    <textarea class="form-control" name="" id="" cols="20" rows="5">Your message:
                    </textarea>
                </form>
            </td>
            <td>
                <form action="" role="form">
                    <textarea class="form-control pressed" name="" id="" cols="20" rows="5">Your message:
                    </textarea>
                </form>
            </td>
        </tr>
        <tr>
            <td>Text error</td>
            <td colspan="3">
                <form action="" class="form-horizontal" role="form">
                    <div class="form-group has-error">
                        <div class="col-xs-8">
                            <input class="form-control tooltips-show" type="email" name="" id="" data-toggle="tooltip" titile data-original-title="Enter valid Email" >
                        </div>
                        <div class="col-xs-4">
                            <input class="btn btn-default" type="submit" value="Submit">
                            <button class="btn btn-default">Button</button>
                            <a href="#" class="btn btn-default">Href</a>
                        </div>
                    </div>
                </form>
            </td>
        </tr>
    </tbody>
</table>
</div>
';

$content_about_template = '
<h2>Преимущества</h2>
<div class="row">
    <div class="col-md-4 col-sm-4">
        <h3>Полная поддержка Bootstrap 3</h3>
        <p></p>
    </div>
    <div class="col-md-4 col-sm-4">
        <h3>Высокая скорость работы</h3>
        <p></p>
    </div>
    <div class="col-md-4 col-sm-4">
        <h3>SEO оптимизация</h3>
        <p></p>
    </div>
</div>
<div class="row">
    <div class="col-md-4 col-sm-4">
        <h3>Более 20 шаблонов страниц</h3>
        <p></p>
    </div>
    <div class="col-md-4 col-sm-4">
        <h3>Цветовые схемы</h3>
        <p>Включено 3 цветовых схемы и ручная настройка</p>
    </div>
    <div class="col-md-4 col-sm-4">
        <h3>Настраиваемый шаблон главной страницы</h3>
        <p>Каждый блок на главной странице имеет 2 дизайна. Вы можете выбирать любой понравившийся.</p>
    </div>
</div>
<div class="row">
    <div class="col-md-4 col-sm-4">
        <h3>Unisender</h3>
        <p></p>
    </div>
    <div class="col-md-4 col-sm-4">
        <h3>Удобен для разработчиков</h3>
        <p></p>
    </div>
    <div class="col-md-4 col-sm-4">
        <h3>Расширяемый js</h3>
        <p></p>
    </div>
</div>
<div class="row">
    <div class="col-md-4 col-sm-4">
        <h3>Less включен</h3>
        <p></p>
    </div>
    <div class="col-md-4 col-sm-4">
        <h3>Лучшие практики разработки корпоративных сайтов</h3>
        <p></p>
    </div>
    <div class="col-md-4 col-sm-4">
        <h3>Спецальный пользователь для редактирования контента</h3>
        <p></p>
    </div>
</div>
<div class="row">
    <div class="col-md-4 col-sm-4">
        <h3>Полная поддержка мультиязычности</h3>
        <p></p>
    </div>
    <div class="col-md-4 col-sm-4">
        <h3>Включено 2 языка</h3>
        <p></p>
    </div>
    <div class="col-md-4 col-sm-4">
        <h3>Возможность установить демо контент</h3>
        <p></p>
    </div>
</div>
';

$content_manual = '
<p>Где настраивать шаблон, показать скрины конфигов и как туда попасть.</p>
<h2>Настройка главной страницы</h2>
<p></p>
<h2>Настройкка Google Analytics</h2>
<p></p>
<h2>Настройкка Unisender</h2>
<p></p>
';

if ($object && $object->xpdo) {
    switch ($options[xPDOTransport::PACKAGE_ACTION]) {
        case xPDOTransport::ACTION_INSTALL:
        case xPDOTransport::ACTION_UPGRADE:
            $modx =& $object->xpdo;

            $options['demo_data'] = 1;
            if($options['demo_data']) {
                $modx->log(modX::LOG_LEVEL_INFO,'Setup demo resources');
                /*
                 * search templates
                 */

                $templateNames = array(
                    'index',
                    'eventsList',
                    'eventsListTickets',
                    'eventsItem',
                    'galleryList',
                    'galleryBigList',
                    'galleryItem',
                    'blogList',
                    'blogListTile',
                    'blogItem',
                    'partners',
                    'text',
                    'textAside',
                    'textAsideWithImage',
                    'textAsideRight',
                    'textAsideRightWithImage',
                    'textWithImage',
                    'contacts',
                    '404',
                );
                $templateVarPrefix = 'tpl_';
                foreach($templateNames as $templateName){
                    $varName = $templateVarPrefix.$templateName;
                    if(!$$varName  = $modx->getObject('modTemplate', array('templatename'  => $templateName)   ) ){
                        $modx->log(xPDO::LOG_LEVEL_ERROR, "Could not get Template with name '{$templateName}'");
                        return false;
                    }
                }

                /*  */
                $resources = array(
                    'childs' => array(
                        'home' => array(
                            'template' => $tpl_index->get('id'),
                            'pagetitle' => 'Home',
                            'longtitle' => '',
                            'description' => '',
                            'introtext' => '',
                            'alias' => 'index',
                            'uri' => 'index',
                            'link_attributes' => '',
                            'content' => '',
                            'isfolder' => true,
                            'published' => true,
                            'publishedon' => time(),
                            'hidemenu' => false,
                            'cacheable' => true,
                            'searchable' => true,
                            'richtext' => true,
                            'context_key' => 'web',
                            'menutitle' => '',
                            'childs' => array(
                                'Home ver.2' => array(
                                    'template' => 0,
                                    'pagetitle' => 'Home ver.2',
                                    'longtitle' => '',
                                    'description' => '',
                                    'introtext' => '',
                                    'alias' => 'home2',
                                    'uri' => 'index/home2',
                                    'link_attributes' => '',
                                    'content' => $content_index_demo1,
                                    'isfolder' => false,
                                    'published' => true,
                                    'publishedon' => time(),
                                    'hidemenu' => false,
                                    'cacheable' => true,
                                    'searchable' => true,
                                    'richtext' => true,
                                    'uri_override' => true,
                                    'context_key' => 'web',
                                    'menutitle' => '',
                                ),
                            )
                        ),
                        '404' => array(
                            'template' => $tpl_404->get('id'),
                            'pagetitle' => '404',
                            'longtitle' => '',
                            'description' => '',
                            'introtext' => '',
                            'alias' => '404',
                            'uri' => '404',
                            'link_attributes' => '',
                            'content' => '',
                            'isfolder' => false,
                            'published' => true,
                            'publishedon' => time(),
                            'hidemenu' => true,
                            'cacheable' => true,
                            'searchable' => false,
                            'richtext' => false,
                            'context_key' => 'web',
                            'menutitle' => '',
                            'group' => 'technical',
                            'tvs' => array(
                                'img' => '404.png'
                            )
                        ),
                        'sitemap' => array(
                            'template' => 0,
                            'pagetitle' => 'sitemap',
                            'longtitle' => '',
                            'description' => '',
                            'introtext' => '',
                            'alias' => 'sitemap',
                            'uri' => 'sitemap',
                            'link_attributes' => '',
                            'content' => '[[pdoSitemap? &parents=`-2,`]]',
                            'isfolder' => false,
                            'published' => true,
                            'publishedon' => time(),
                            'hidemenu' => true,
                            'cacheable' => true,
                            'searchable' => false,
                            'richtext' => false,
                            'context_key' => 'web',
                            'menutitle' => '',
                            'content_type' => 2, //XML
                            'group' => 'technical',
                        ),
                        'ajax' => array(
                            'template' => 0,
                            'pagetitle' => 'ajax',
                            'longtitle' => '',
                            'description' => '',
                            'introtext' => '',
                            'alias' => 'ajax',
                            'uri' => 'ajax',
                            'link_attributes' => '',
                            'content' => '',
                            'isfolder' => true,
                            'published' => false,
                            'publishedon' => time(),
                            'hidemenu' => true,
                            'cacheable' => true,
                            'searchable' => false,
                            'richtext' => false,
                            'context_key' => 'web',
                            'menutitle' => '',
                            'group' => 'technical',
                            'childs' => array(
                                'formContacts' => array(
                                    'template' => 0,
                                    'pagetitle' => 'formContacts',
                                    'longtitle' => '',
                                    'description' => '',
                                    'introtext' => '',
                                    'alias' => 'formcontacts',
                                    'uri' => 'ajax/formcontacts',
                                    'link_attributes' => '',
                                    'content' => '[[!formContacts]]',
                                    'isfolder' => false,
                                    'published' => true,
                                    'publishedon' => time(),
                                    'hidemenu' => true,
                                    'cacheable' => true,
                                    'searchable' => false,
                                    'richtext' => true,
                                    'uri_override' => true,
                                    'context_key' => 'web',
                                    'menutitle' => '',
                                ),
                                'formSubscribe' => array(
                                    'template' => 0,
                                    'pagetitle' => 'formSubscribe',
                                    'longtitle' => '',
                                    'description' => '',
                                    'introtext' => '',
                                    'alias' => 'formsubscribe',
                                    'uri' => 'ajax/formsubscribe',
                                    'link_attributes' => '',
                                    'content' => '[[!formSubscribe]]',
                                    'isfolder' => false,
                                    'published' => true,
                                    'publishedon' => time(),
                                    'hidemenu' => true,
                                    'cacheable' => true,
                                    'searchable' => false,
                                    'richtext' => true,
                                    'uri_override' => true,
                                    'context_key' => 'web',
                                    'menutitle' => '',
                                ),
                            )
                        ),
                        'eventsList' => array(
                            'class_key' => 'modWebLink',
                            'template' => 0,
                            'pagetitle' => 'Events',
                            'longtitle' => '',
                            'description' => '',
                            'introtext' => '',
                            'alias' => 'eventslist',
                            'uri' => 'eventslist',
                            'link_attributes' => '',
                            'content' => $modx->getObject('modResource', array('alias' => 'events','context_key' => 'web',))->get('id'),
                            'isfolder' => true,
                            'published' => true,
                            'publishedon' => time(),
                            'hidemenu' => false,
                            'cacheable' => true,
                            'searchable' => true,
                            'richtext' => true,
                            'context_key' => 'web',
                            'menutitle' => '',
                            'childs' => array(
                                'events:TicketsSection' => array(
                                    'parentCheck' => true,
                                    'class_key' => 'TicketsSection',
                                    'template' => $tpl_eventsList->get('id'),
                                    'pagetitle' => 'Events',
                                    'longtitle' => '',
                                    'description' => '',
                                    'introtext' => '',
                                    'alias' => 'events',
                                    'uri' => 'eventslist/events',
                                    'link_attributes' => '',
                                    'content' => '',
                                    'isfolder' => true,
                                    'published' => true,
                                    'publishedon' => time(),
                                    'hidemenu' => false,
                                    'cacheable' => true,
                                    'searchable' => true,
                                    'richtext' => true,
                                    'context_key' => 'web',
                                    'menutitle' => '',
                                    'properties' => array(
                                        'tickets' => array(
                                            'template' => $tpl_eventsItem->get('id'),
                                            'uri' => '%alias',
                                            'disable_jevix' => true
                                        )
                                    ),
                                    'childs' => array(
                                        'event1:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_eventsItem->get('id'),
                                            'pagetitle' => 'Event 1',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => '',
                                            'alias' => 'event1',
                                            'uri' => 'eventslist/events/event1',
                                            'link_attributes' => '',
                                            'content' => '',
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (1 * 60),
                                            'hidemenu' => true,
                                            'cacheable' => true,
                                            'searchable' => true,
                                            'richtext' => true,
                                            'uri_override' => true,
                                            'context_key' => 'web',
                                            'menutitle' => '',
                                            'show_in_tree' => 0,
                                            'syncsite' => 0,
                                            'properties' => array(
                                                'disable_jevix' => true,
                                                'process_tags' => false,
                                            ),
                                            'tvs' => array(
                                                'img' => 'events/130197.jpg',
                                                'timeStart' => date('Y-m-d H:i:00', time() + (-14 * 24 * 60 * 60)),
                                                'price' => '5$',
                                                'lineUp' => $modx->toJson(array(
                                                    array(
                                                        "MIGX_id" => 1,
                                                        'name' => 'Andrew Feeling',
                                                        'location' => "donetsk"
                                                    ),
                                                    array(
                                                        "MIGX_id" => 2,
                                                        'name' => 'Shalim',
                                                        'location' => "donetsk"
                                                    ),
                                                    array(
                                                        "MIGX_id" => 3,
                                                        'name' => 'Stay B',
                                                        'location' => "donetsk"
                                                    ),
                                                    array(
                                                        "MIGX_id" => 4,
                                                        'name' => 'Someone',
                                                        'location' => "mariupol"
                                                    ),
                                                    array(
                                                        "MIGX_id" => 5,
                                                        'name' => 'Dranga',
                                                        'location' => "mariupol"
                                                    ),
                                                ))
                                            ),
                                        ),
                                        'event2:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_eventsItem->get('id'),
                                            'pagetitle' => 'Event 2',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => '',
                                            'alias' => 'event2',
                                            'uri' => 'eventslist/events/event2',
                                            'link_attributes' => '',
                                            'content' => '',
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (2 * 60),
                                            'hidemenu' => true,
                                            'cacheable' => true,
                                            'searchable' => true,
                                            'richtext' => true,
                                            'uri_override' => true,
                                            'context_key' => 'web',
                                            'menutitle' => '',
                                            'show_in_tree' => 0,
                                            'syncsite' => 0,
                                            'properties' => array(
                                                'disable_jevix' => true,
                                                'process_tags' => false,
                                            ),
                                            'tvs' => array(
                                                'img' => 'events/20130125-rhcp-x600-1359132290.jpg',
                                                'timeStart' => date('Y-m-d H:i:00', time() + (21 * 24 * 60 * 60)),
                                                'price' => '5$',
                                                'lineUp' => $modx->toJson(array(
                                                    array(
                                                        "MIGX_id" => 1,
                                                        'name' => 'Andrew Feeling',
                                                        'location' => "donetsk"
                                                    ),
                                                    array(
                                                        "MIGX_id" => 2,
                                                        'name' => 'Shalim',
                                                        'location' => "donetsk"
                                                    ),
                                                    array(
                                                        "MIGX_id" => 3,
                                                        'name' => 'Stay B',
                                                        'location' => "donetsk"
                                                    ),
                                                    array(
                                                        "MIGX_id" => 4,
                                                        'name' => 'Someone',
                                                        'location' => "mariupol"
                                                    ),
                                                    array(
                                                        "MIGX_id" => 5,
                                                        'name' => 'Dranga',
                                                        'location' => "mariupol"
                                                    ),
                                                ))
                                            ),
                                        ),
                                        'event3:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_eventsItem->get('id'),
                                            'pagetitle' => 'Event 3',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => '',
                                            'alias' => 'event3',
                                            'uri' => 'eventslist/events/event3',
                                            'link_attributes' => '',
                                            'content' => '',
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (3 * 60),
                                            'hidemenu' => true,
                                            'cacheable' => true,
                                            'searchable' => true,
                                            'richtext' => true,
                                            'uri_override' => true,
                                            'context_key' => 'web',
                                            'menutitle' => '',
                                            'show_in_tree' => 0,
                                            'syncsite' => 0,
                                            'properties' => array(
                                                'disable_jevix' => true,
                                                'process_tags' => false,
                                            ),
                                            'tvs' => array(
                                                'img' => 'events/Paramore-11.jpg',
                                                'timeStart' => date('Y-m-d H:i:00', time() + (28 * 24 * 60 * 60)),
                                                'price' => '5$',
                                                'lineUp' => $modx->toJson(array(
                                                    array(
                                                        "MIGX_id" => 1,
                                                        'name' => 'Andrew Feeling',
                                                        'location' => "donetsk"
                                                    ),
                                                    array(
                                                        "MIGX_id" => 2,
                                                        'name' => 'Shalim',
                                                        'location' => "donetsk"
                                                    ),
                                                    array(
                                                        "MIGX_id" => 3,
                                                        'name' => 'Stay B',
                                                        'location' => "donetsk"
                                                    ),
                                                    array(
                                                        "MIGX_id" => 4,
                                                        'name' => 'Someone',
                                                        'location' => "mariupol"
                                                    ),
                                                    array(
                                                        "MIGX_id" => 5,
                                                        'name' => 'Dranga',
                                                        'location' => "mariupol"
                                                    ),
                                                ))
                                            ),
                                        ),
                                        'event4:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_eventsItem->get('id'),
                                            'pagetitle' => 'Event 4',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => '',
                                            'alias' => 'event4',
                                            'uri' => 'eventslist/events/event4',
                                            'link_attributes' => '',
                                            'content' => '',
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (4 * 60),
                                            'hidemenu' => true,
                                            'cacheable' => true,
                                            'searchable' => true,
                                            'richtext' => true,
                                            'uri_override' => true,
                                            'context_key' => 'web',
                                            'menutitle' => '',
                                            'show_in_tree' => 0,
                                            'syncsite' => 0,
                                            'properties' => array(
                                                'disable_jevix' => true,
                                                'process_tags' => false,
                                            ),
                                            'tvs' => array(
                                                'img' => 'events/the-police.jpg',
                                                'timeStart' => date('Y-m-d H:i:00', time() + (35 * 24 * 60 * 60)),
                                                'price' => '5$',
                                                'topEvent' => 1,
                                                'lineUp' => $modx->toJson(array(
                                                    array(
                                                        "MIGX_id" => 1,
                                                        'name' => 'Andrew Feeling',
                                                        'location' => "donetsk"
                                                    ),
                                                    array(
                                                        "MIGX_id" => 2,
                                                        'name' => 'Shalim',
                                                        'location' => "donetsk"
                                                    ),
                                                    array(
                                                        "MIGX_id" => 3,
                                                        'name' => 'Stay B',
                                                        'location' => "donetsk"
                                                    ),
                                                    array(
                                                        "MIGX_id" => 4,
                                                        'name' => 'Someone',
                                                        'location' => "mariupol"
                                                    ),
                                                    array(
                                                        "MIGX_id" => 5,
                                                        'name' => 'Dranga',
                                                        'location' => "mariupol"
                                                    ),
                                                ))
                                            ),
                                        ),
                                        'event5:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_eventsItem->get('id'),
                                            'pagetitle' => 'Event 5',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => '',
                                            'alias' => 'event5',
                                            'uri' => 'eventslist/events/event5',
                                            'link_attributes' => '',
                                            'content' => '',
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (5 * 60),
                                            'hidemenu' => true,
                                            'cacheable' => true,
                                            'searchable' => true,
                                            'richtext' => true,
                                            'uri_override' => true,
                                            'context_key' => 'web',
                                            'menutitle' => '',
                                            'show_in_tree' => 0,
                                            'syncsite' => 0,
                                            'properties' => array(
                                                'disable_jevix' => true,
                                                'process_tags' => false,
                                            ),
                                            'tvs' => array(
                                                'img' => 'events/top-ev.jpg',
                                                'timeStart' => date('Y-m-d H:i:00', time() + (42 * 24 * 60 * 60)),
                                                'price' => '5$',
                                                'topEvent' => 1,
                                                'lineUp' => $modx->toJson(array(
                                                    array(
                                                        "MIGX_id" => 1,
                                                        'name' => 'Andrew Feeling',
                                                        'location' => "donetsk"
                                                    ),
                                                    array(
                                                        "MIGX_id" => 2,
                                                        'name' => 'Shalim',
                                                        'location' => "donetsk"
                                                    ),
                                                    array(
                                                        "MIGX_id" => 3,
                                                        'name' => 'Stay B',
                                                        'location' => "donetsk"
                                                    ),
                                                    array(
                                                        "MIGX_id" => 4,
                                                        'name' => 'Someone',
                                                        'location' => "mariupol"
                                                    ),
                                                    array(
                                                        "MIGX_id" => 5,
                                                        'name' => 'Dranga',
                                                        'location' => "mariupol"
                                                    ),
                                                ))
                                            ),
                                        ),
                                        'event6:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_eventsItem->get('id'),
                                            'pagetitle' => 'Event 6',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => '',
                                            'alias' => 'event6',
                                            'uri' => 'eventslist/events/event6',
                                            'link_attributes' => '',
                                            'content' => '',
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (6 * 60),
                                            'hidemenu' => true,
                                            'cacheable' => true,
                                            'searchable' => true,
                                            'richtext' => true,
                                            'uri_override' => true,
                                            'context_key' => 'web',
                                            'menutitle' => '',
                                            'show_in_tree' => 0,
                                            'syncsite' => 0,
                                            'properties' => array(
                                                'disable_jevix' => true,
                                                'process_tags' => false,
                                            ),
                                            'tvs' => array(
                                                'img' => 'events/top-ev2.jpg',
                                                'timeStart' => date('Y-m-d H:i:00', time() + (49 * 24 * 60 * 60)),
                                                'price' => '5$',
                                                'topEvent' => 1,
                                                'promoEvent' => 1,
                                                'promoImg' => 'slider/Celebrities-Paramore-005.jpg',
                                                'lineUp' => $modx->toJson(array(
                                                    array(
                                                        "MIGX_id" => 1,
                                                        'name' => 'Andrew Feeling',
                                                        'location' => "donetsk"
                                                    ),
                                                    array(
                                                        "MIGX_id" => 2,
                                                        'name' => 'Shalim',
                                                        'location' => "donetsk"
                                                    ),
                                                    array(
                                                        "MIGX_id" => 3,
                                                        'name' => 'Stay B',
                                                        'location' => "donetsk"
                                                    ),
                                                    array(
                                                        "MIGX_id" => 4,
                                                        'name' => 'Someone',
                                                        'location' => "mariupol"
                                                    ),
                                                    array(
                                                        "MIGX_id" => 5,
                                                        'name' => 'Dranga',
                                                        'location' => "mariupol"
                                                    ),
                                                ))
                                            ),
                                        ),
                                        'event7:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_eventsItem->get('id'),
                                            'pagetitle' => 'Event 7',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => '',
                                            'alias' => 'event7',
                                            'uri' => 'eventslist/events/event7',
                                            'link_attributes' => '',
                                            'content' => '',
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (7 * 60),
                                            'hidemenu' => true,
                                            'cacheable' => true,
                                            'searchable' => true,
                                            'richtext' => true,
                                            'uri_override' => true,
                                            'context_key' => 'web',
                                            'menutitle' => '',
                                            'show_in_tree' => 0,
                                            'syncsite' => 0,
                                            'properties' => array(
                                                'disable_jevix' => true,
                                                'process_tags' => false,
                                            ),
                                            'tvs' => array(
                                                'img' => 'events/top-ev3.jpg',
                                                'timeStart' => date('Y-m-d H:i:00', time() + (56 * 24 * 60 * 60)),
                                                'price' => '10$',
                                                'topEvent' => 1,
                                                'promoEvent' => 1,
                                                'promoImg' => 'slider/1375702763_thirty-seconds-to-mars-do-or-die.jpg',
                                                'lineUp' => $modx->toJson(array(
                                                    array(
                                                        "MIGX_id" => 1,
                                                        'name' => 'Andrew Feeling',
                                                        'location' => "donetsk"
                                                    ),
                                                    array(
                                                        "MIGX_id" => 2,
                                                        'name' => 'Shalim',
                                                        'location' => "donetsk"
                                                    ),
                                                    array(
                                                        "MIGX_id" => 3,
                                                        'name' => 'Stay B',
                                                        'location' => "donetsk"
                                                    ),
                                                    array(
                                                        "MIGX_id" => 4,
                                                        'name' => 'Someone',
                                                        'location' => "mariupol"
                                                    ),
                                                    array(
                                                        "MIGX_id" => 5,
                                                        'name' => 'Dranga',
                                                        'location' => "mariupol"
                                                    ),
                                                    array(
                                                        "MIGX_id" => 6,
                                                        'name' => 'Andrew Feeling',
                                                        'location' => "donetsk"
                                                    ),
                                                    array(
                                                        "MIGX_id" => 7,
                                                        'name' => 'Shalim',
                                                        'location' => "donetsk"
                                                    ),
                                                    array(
                                                        "MIGX_id" => 8,
                                                        'name' => 'Stay B',
                                                        'location' => "donetsk"
                                                    ),
                                                    array(
                                                        "MIGX_id" => 9,
                                                        'name' => 'Someone',
                                                        'location' => "mariupol"
                                                    ),
                                                    array(
                                                        "MIGX_id" => 10,
                                                        'name' => 'Dranga',
                                                        'location' => "mariupol"
                                                    ),
                                                ))
                                            ),
                                        ),
                                    ),
                                ),
                                'events2:TicketsSection' => array(
                                    'class_key' => 'TicketsSection',
                                    'template' => $tpl_eventsListTickets->get('id'),
                                    'pagetitle' => 'Events ver.2',
                                    'longtitle' => '',
                                    'description' => '',
                                    'introtext' => '',
                                    'alias' => 'events2',
                                    'uri' => 'eventslist/events2',
                                    'link_attributes' => '',
                                    'content' => '',
                                    'isfolder' => true,
                                    'published' => true,
                                    'publishedon' => time(),
                                    'hidemenu' => false,
                                    'cacheable' => true,
                                    'searchable' => true,
                                    'richtext' => true,
                                    'context_key' => 'web',
                                    'menutitle' => '',
                                    'properties' => array(
                                        'tickets' => array(
                                            'template' => $tpl_eventsItem->get('id'),
                                            'uri' => '%alias',
                                            'disable_jevix' => true
                                        )
                                    ),
                                    'childs' => array(
                                        'event1:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_eventsItem->get('id'),
                                            'pagetitle' => 'Event 1',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => '',
                                            'alias' => 'event1',
                                            'uri' => 'eventslist/events2/event1',
                                            'link_attributes' => '',
                                            'content' => '',
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (1 * 60),
                                            'hidemenu' => true,
                                            'cacheable' => true,
                                            'searchable' => true,
                                            'richtext' => true,
                                            'uri_override' => true,
                                            'context_key' => 'web',
                                            'menutitle' => '',
                                            'show_in_tree' => 0,
                                            'syncsite' => 0,
                                            'properties' => array(
                                                'disable_jevix' => true,
                                                'process_tags' => false,
                                            ),
                                            'tvs' => array(
                                                'img' => 'events/130197.jpg',
                                                'timeStart' => date('Y-m-d H:i:00', time() + (-14 * 24 * 60 * 60)),
                                                'price' => '5$',
                                                'lineUp' => $modx->toJson(array(
                                                    array(
                                                        "MIGX_id" => 1,
                                                        'name' => 'Andrew Feeling',
                                                        'location' => "donetsk"
                                                    ),
                                                    array(
                                                        "MIGX_id" => 2,
                                                        'name' => 'Shalim',
                                                        'location' => "donetsk"
                                                    ),
                                                    array(
                                                        "MIGX_id" => 3,
                                                        'name' => 'Stay B',
                                                        'location' => "donetsk"
                                                    ),
                                                    array(
                                                        "MIGX_id" => 4,
                                                        'name' => 'Someone',
                                                        'location' => "mariupol"
                                                    ),
                                                    array(
                                                        "MIGX_id" => 5,
                                                        'name' => 'Dranga',
                                                        'location' => "mariupol"
                                                    ),
                                                ))
                                            ),
                                        ),
                                        'event2:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_eventsItem->get('id'),
                                            'pagetitle' => 'Event 2',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => '',
                                            'alias' => 'event2',
                                            'uri' => 'eventslist/events2/event2',
                                            'link_attributes' => '',
                                            'content' => '',
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (2 * 60),
                                            'hidemenu' => true,
                                            'cacheable' => true,
                                            'searchable' => true,
                                            'richtext' => true,
                                            'uri_override' => true,
                                            'context_key' => 'web',
                                            'menutitle' => '',
                                            'show_in_tree' => 0,
                                            'syncsite' => 0,
                                            'properties' => array(
                                                'disable_jevix' => true,
                                                'process_tags' => false,
                                            ),
                                            'tvs' => array(
                                                'img' => 'events/20130125-rhcp-x600-1359132290.jpg',
                                                'timeStart' => date('Y-m-d H:i:00', time() + (21 * 24 * 60 * 60)),
                                                'price' => '5$',
                                                'lineUp' => $modx->toJson(array(
                                                    array(
                                                        "MIGX_id" => 1,
                                                        'name' => 'Andrew Feeling',
                                                        'location' => "donetsk"
                                                    ),
                                                    array(
                                                        "MIGX_id" => 2,
                                                        'name' => 'Shalim',
                                                        'location' => "donetsk"
                                                    ),
                                                    array(
                                                        "MIGX_id" => 3,
                                                        'name' => 'Stay B',
                                                        'location' => "donetsk"
                                                    ),
                                                    array(
                                                        "MIGX_id" => 4,
                                                        'name' => 'Someone',
                                                        'location' => "mariupol"
                                                    ),
                                                    array(
                                                        "MIGX_id" => 5,
                                                        'name' => 'Dranga',
                                                        'location' => "mariupol"
                                                    ),
                                                ))
                                            ),
                                        ),
                                        'event3:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_eventsItem->get('id'),
                                            'pagetitle' => 'Event 3',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => '',
                                            'alias' => 'event3',
                                            'uri' => 'eventslist/events2/event3',
                                            'link_attributes' => '',
                                            'content' => '',
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (3 * 60),
                                            'hidemenu' => true,
                                            'cacheable' => true,
                                            'searchable' => true,
                                            'richtext' => true,
                                            'uri_override' => true,
                                            'context_key' => 'web',
                                            'menutitle' => '',
                                            'show_in_tree' => 0,
                                            'syncsite' => 0,
                                            'properties' => array(
                                                'disable_jevix' => true,
                                                'process_tags' => false,
                                            ),
                                            'tvs' => array(
                                                'img' => 'events/Paramore-11.jpg',
                                                'timeStart' => date('Y-m-d H:i:00', time() + (28 * 24 * 60 * 60)),
                                                'price' => '5$',
                                                'lineUp' => $modx->toJson(array(
                                                    array(
                                                        "MIGX_id" => 1,
                                                        'name' => 'Andrew Feeling',
                                                        'location' => "donetsk"
                                                    ),
                                                    array(
                                                        "MIGX_id" => 2,
                                                        'name' => 'Shalim',
                                                        'location' => "donetsk"
                                                    ),
                                                    array(
                                                        "MIGX_id" => 3,
                                                        'name' => 'Stay B',
                                                        'location' => "donetsk"
                                                    ),
                                                    array(
                                                        "MIGX_id" => 4,
                                                        'name' => 'Someone',
                                                        'location' => "mariupol"
                                                    ),
                                                    array(
                                                        "MIGX_id" => 5,
                                                        'name' => 'Dranga',
                                                        'location' => "mariupol"
                                                    ),
                                                ))
                                            ),
                                        ),
                                        'event4:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_eventsItem->get('id'),
                                            'pagetitle' => 'Event 4',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => '',
                                            'alias' => 'event4',
                                            'uri' => 'eventslist/events2/event4',
                                            'link_attributes' => '',
                                            'content' => '',
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (4 * 60),
                                            'hidemenu' => true,
                                            'cacheable' => true,
                                            'searchable' => true,
                                            'richtext' => true,
                                            'uri_override' => true,
                                            'context_key' => 'web',
                                            'menutitle' => '',
                                            'show_in_tree' => 0,
                                            'syncsite' => 0,
                                            'properties' => array(
                                                'disable_jevix' => true,
                                                'process_tags' => false,
                                            ),
                                            'tvs' => array(
                                                'img' => 'events/the-police.jpg',
                                                'timeStart' => date('Y-m-d H:i:00', time() + (35 * 24 * 60 * 60)),
                                                'price' => '5$',
                                                'topEvent' => 1,
                                                'lineUp' => $modx->toJson(array(
                                                    array(
                                                        "MIGX_id" => 1,
                                                        'name' => 'Andrew Feeling',
                                                        'location' => "donetsk"
                                                    ),
                                                    array(
                                                        "MIGX_id" => 2,
                                                        'name' => 'Shalim',
                                                        'location' => "donetsk"
                                                    ),
                                                    array(
                                                        "MIGX_id" => 3,
                                                        'name' => 'Stay B',
                                                        'location' => "donetsk"
                                                    ),
                                                    array(
                                                        "MIGX_id" => 4,
                                                        'name' => 'Someone',
                                                        'location' => "mariupol"
                                                    ),
                                                    array(
                                                        "MIGX_id" => 5,
                                                        'name' => 'Dranga',
                                                        'location' => "mariupol"
                                                    ),
                                                ))
                                            ),
                                        ),
                                        'event5:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_eventsItem->get('id'),
                                            'pagetitle' => 'Event 5',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => '',
                                            'alias' => 'event5',
                                            'uri' => 'eventslist/events2/event5',
                                            'link_attributes' => '',
                                            'content' => '',
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (5 * 60),
                                            'hidemenu' => true,
                                            'cacheable' => true,
                                            'searchable' => true,
                                            'richtext' => true,
                                            'uri_override' => true,
                                            'context_key' => 'web',
                                            'menutitle' => '',
                                            'show_in_tree' => 0,
                                            'syncsite' => 0,
                                            'properties' => array(
                                                'disable_jevix' => true,
                                                'process_tags' => false,
                                            ),
                                            'tvs' => array(
                                                'img' => 'events/top-ev.jpg',
                                                'timeStart' => date('Y-m-d H:i:00', time() + (42 * 24 * 60 * 60)),
                                                'price' => '5$',
                                                'topEvent' => 1,
                                                'lineUp' => $modx->toJson(array(
                                                    array(
                                                        "MIGX_id" => 1,
                                                        'name' => 'Andrew Feeling',
                                                        'location' => "donetsk"
                                                    ),
                                                    array(
                                                        "MIGX_id" => 2,
                                                        'name' => 'Shalim',
                                                        'location' => "donetsk"
                                                    ),
                                                    array(
                                                        "MIGX_id" => 3,
                                                        'name' => 'Stay B',
                                                        'location' => "donetsk"
                                                    ),
                                                    array(
                                                        "MIGX_id" => 4,
                                                        'name' => 'Someone',
                                                        'location' => "mariupol"
                                                    ),
                                                    array(
                                                        "MIGX_id" => 5,
                                                        'name' => 'Dranga',
                                                        'location' => "mariupol"
                                                    ),
                                                ))
                                            ),
                                        ),
                                        'event6:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_eventsItem->get('id'),
                                            'pagetitle' => 'Event 6',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => '',
                                            'alias' => 'event6',
                                            'uri' => 'eventslist/events2/event6',
                                            'link_attributes' => '',
                                            'content' => '',
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (6 * 60),
                                            'hidemenu' => true,
                                            'cacheable' => true,
                                            'searchable' => true,
                                            'richtext' => true,
                                            'uri_override' => true,
                                            'context_key' => 'web',
                                            'menutitle' => '',
                                            'show_in_tree' => 0,
                                            'syncsite' => 0,
                                            'properties' => array(
                                                'disable_jevix' => true,
                                                'process_tags' => false,
                                            ),
                                            'tvs' => array(
                                                'img' => 'events/top-ev2.jpg',
                                                'timeStart' => date('Y-m-d H:i:00', time() + (49 * 24 * 60 * 60)),
                                                'price' => '5$',
                                                'topEvent' => 1,
                                                'promoEvent' => 1,
                                                'promoImg' => 'slider/Celebrities-Paramore-005.jpg',
                                                'lineUp' => $modx->toJson(array(
                                                    array(
                                                        "MIGX_id" => 1,
                                                        'name' => 'Andrew Feeling',
                                                        'location' => "donetsk"
                                                    ),
                                                    array(
                                                        "MIGX_id" => 2,
                                                        'name' => 'Shalim',
                                                        'location' => "donetsk"
                                                    ),
                                                    array(
                                                        "MIGX_id" => 3,
                                                        'name' => 'Stay B',
                                                        'location' => "donetsk"
                                                    ),
                                                    array(
                                                        "MIGX_id" => 4,
                                                        'name' => 'Someone',
                                                        'location' => "mariupol"
                                                    ),
                                                    array(
                                                        "MIGX_id" => 5,
                                                        'name' => 'Dranga',
                                                        'location' => "mariupol"
                                                    ),
                                                ))
                                            ),
                                        ),
                                        'event7:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_eventsItem->get('id'),
                                            'pagetitle' => 'Event 7',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => '',
                                            'alias' => 'event7',
                                            'uri' => 'eventslist/events2/event7',
                                            'link_attributes' => '',
                                            'content' => '',
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (7 * 60),
                                            'hidemenu' => true,
                                            'cacheable' => true,
                                            'searchable' => true,
                                            'richtext' => true,
                                            'uri_override' => true,
                                            'context_key' => 'web',
                                            'menutitle' => '',
                                            'show_in_tree' => 0,
                                            'syncsite' => 0,
                                            'properties' => array(
                                                'disable_jevix' => true,
                                                'process_tags' => false,
                                            ),
                                            'tvs' => array(
                                                'img' => 'events/top-ev3.jpg',
                                                'timeStart' => date('Y-m-d H:i:00', time() + (56 * 24 * 60 * 60)),
                                                'price' => '10$',
                                                'topEvent' => 1,
                                                'promoEvent' => 1,
                                                'promoImg' => 'slider/1375702763_thirty-seconds-to-mars-do-or-die.jpg',
                                                'lineUp' => $modx->toJson(array(
                                                    array(
                                                        "MIGX_id" => 1,
                                                        'name' => 'Andrew Feeling',
                                                        'location' => "donetsk"
                                                    ),
                                                    array(
                                                        "MIGX_id" => 2,
                                                        'name' => 'Shalim',
                                                        'location' => "donetsk"
                                                    ),
                                                    array(
                                                        "MIGX_id" => 3,
                                                        'name' => 'Stay B',
                                                        'location' => "donetsk"
                                                    ),
                                                    array(
                                                        "MIGX_id" => 4,
                                                        'name' => 'Someone',
                                                        'location' => "mariupol"
                                                    ),
                                                    array(
                                                        "MIGX_id" => 5,
                                                        'name' => 'Dranga',
                                                        'location' => "mariupol"
                                                    ),
                                                    array(
                                                        "MIGX_id" => 6,
                                                        'name' => 'Andrew Feeling',
                                                        'location' => "donetsk"
                                                    ),
                                                    array(
                                                        "MIGX_id" => 7,
                                                        'name' => 'Shalim',
                                                        'location' => "donetsk"
                                                    ),
                                                    array(
                                                        "MIGX_id" => 8,
                                                        'name' => 'Stay B',
                                                        'location' => "donetsk"
                                                    ),
                                                    array(
                                                        "MIGX_id" => 9,
                                                        'name' => 'Someone',
                                                        'location' => "mariupol"
                                                    ),
                                                    array(
                                                        "MIGX_id" => 10,
                                                        'name' => 'Dranga',
                                                        'location' => "mariupol"
                                                    ),
                                                ))
                                            ),
                                        ),
                                    ),
                                ),
                            ),
                        ),
                        'galleryList' => array(
                            'class_key' => 'modWebLink',
                            'template' => 0,
                            'pagetitle' => 'Gallery',
                            'longtitle' => '',
                            'description' => '',
                            'introtext' => '',
                            'alias' => 'gallerylist',
                            'uri' => 'gallerylist',
                            'link_attributes' => '',
                            'content' => $modx->getObject('modResource', array('alias' => 'gallery','context_key' => 'web',))->get('id'),
                            'isfolder' => true,
                            'published' => true,
                            'publishedon' => time(),
                            'hidemenu' => false,
                            'cacheable' => true,
                            'searchable' => true,
                            'richtext' => true,
                            'context_key' => 'web',
                            'menutitle' => '',
                            'childs' => array(
                                'gallery:TicketsSection' => array(
                                    'parentCheck' => true,
                                    'class_key' => 'TicketsSection',
                                    'template' => $tpl_galleryList->get('id'),
                                    'pagetitle' => 'Gallery',
                                    'longtitle' => '',
                                    'description' => '',
                                    'introtext' => '',
                                    'alias' => 'gallery',
                                    'uri' => 'gallerylist/gallery',
                                    'link_attributes' => '',
                                    'content' => '',
                                    'isfolder' => true,
                                    'published' => true,
                                    'publishedon' => time(),
                                    'hidemenu' => false,
                                    'cacheable' => true,
                                    'searchable' => true,
                                    'richtext' => true,
                                    'context_key' => 'web',
                                    'menutitle' => '',
                                    'properties' => array(
                                        'tickets' => array(
                                            'template' => $tpl_galleryItem->get('id'),
                                            'uri' => '%alias',
                                            'disable_jevix' => true
                                        )
                                    ),
                                    'childs' => array(
                                        'gallery1:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_galleryItem->get('id'),
                                            'pagetitle' => 'Gallery 1',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => '',
                                            'alias' => 'gallery1',
                                            'uri' => 'gallerylist/gallery/gallery1',
                                            'link_attributes' => '',
                                            'content' => '',
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (1 * 60),
                                            'hidemenu' => true,
                                            'cacheable' => true,
                                            'searchable' => true,
                                            'richtext' => true,
                                            'uri_override' => true,
                                            'context_key' => 'web',
                                            'menutitle' => '',
                                            'show_in_tree' => 0,
                                            'syncsite' => 0,
                                            'properties' => array(
                                                'disable_jevix' => true,
                                                'process_tags' => false,
                                            ),
                                            'tvs' => array(
                                                'img' => 'gallery/gall-1.jpg',
                                                'gallery' => $modx->toJson(array(
                                                    array(
                                                        "MIGX_id" => 1,
                                                        'title' => 1,
                                                        'image' => "gallery/gall-1.jpg"
                                                    ),
                                                    array(
                                                        "MIGX_id" => 2,
                                                        'title' => 2,
                                                        'image' => "gallery/gall-2.jpg"
                                                    )
                                                ))
                                            ),
                                        ),
                                        'gallery2:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_galleryItem->get('id'),
                                            'pagetitle' => 'Gallery 2',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => '',
                                            'alias' => 'gallery2',
                                            'uri' => 'gallerylist/gallery/gallery2',
                                            'link_attributes' => '',
                                            'content' => '',
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (2 * 60),
                                            'hidemenu' => true,
                                            'cacheable' => true,
                                            'searchable' => true,
                                            'richtext' => true,
                                            'uri_override' => true,
                                            'context_key' => 'web',
                                            'menutitle' => '',
                                            'show_in_tree' => 0,
                                            'syncsite' => 0,
                                            'properties' => array(
                                                'disable_jevix' => true,
                                                'process_tags' => false,
                                            ),
                                            'tvs' => array(
                                                'img' => 'gallery/gall-2.jpg',
                                                'gallery' => $modx->toJson(array(
                                                    array(
                                                        "MIGX_id" => 1,
                                                        'title' => 1,
                                                        'image' => "gallery/gall-1.jpg"
                                                    ),
                                                    array(
                                                        "MIGX_id" => 2,
                                                        'title' => 2,
                                                        'image' => "gallery/gall-2.jpg"
                                                    )
                                                ))
                                            ),
                                        ),
                                        'gallery3:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_galleryItem->get('id'),
                                            'pagetitle' => 'Gallery 3',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => '',
                                            'alias' => 'gallery3',
                                            'uri' => 'gallerylist/gallery/gallery3',
                                            'link_attributes' => '',
                                            'content' => '',
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (3 * 60),
                                            'hidemenu' => true,
                                            'cacheable' => true,
                                            'searchable' => true,
                                            'richtext' => true,
                                            'uri_override' => true,
                                            'context_key' => 'web',
                                            'menutitle' => '',
                                            'show_in_tree' => 0,
                                            'syncsite' => 0,
                                            'properties' => array(
                                                'disable_jevix' => true,
                                                'process_tags' => false,
                                            ),
                                            'tvs' => array(
                                                'img' => 'gallery/paramore-paramore-8253970-850-680.jpg',
                                                'gallery' => $modx->toJson(array(
                                                    array(
                                                        "MIGX_id" => 1,
                                                        'title' => 1,
                                                        'image' => "gallery/gall-1.jpg"
                                                    ),
                                                    array(
                                                        "MIGX_id" => 2,
                                                        'title' => 2,
                                                        'image' => "gallery/gall-2.jpg"
                                                    )
                                                ))
                                            ),
                                        ),
                                        'gallery4:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_galleryItem->get('id'),
                                            'pagetitle' => 'Gallery 4',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => '',
                                            'alias' => 'gallery4',
                                            'uri' => 'gallerylist/gallery/gallery4',
                                            'link_attributes' => '',
                                            'content' => '',
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (4 * 60),
                                            'hidemenu' => true,
                                            'cacheable' => true,
                                            'searchable' => true,
                                            'richtext' => true,
                                            'uri_override' => true,
                                            'context_key' => 'web',
                                            'menutitle' => '',
                                            'show_in_tree' => 0,
                                            'syncsite' => 0,
                                            'properties' => array(
                                                'disable_jevix' => true,
                                                'process_tags' => false,
                                            ),
                                            'tvs' => array(
                                                'img' => 'gallery/Red-Hot-Chili-Peppers-Kiev.jpg',
                                                'gallery' => $modx->toJson(array(
                                                    array(
                                                        "MIGX_id" => 1,
                                                        'title' => 1,
                                                        'image' => "gallery/gall-1.jpg"
                                                    ),
                                                    array(
                                                        "MIGX_id" => 2,
                                                        'title' => 2,
                                                        'image' => "gallery/gall-2.jpg"
                                                    )
                                                ))
                                            ),
                                        ),
                                        'gallery5:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_galleryItem->get('id'),
                                            'pagetitle' => 'Gallery 5',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => '',
                                            'alias' => 'gallery5',
                                            'uri' => 'gallerylist/gallery/gallery5',
                                            'link_attributes' => '',
                                            'content' => '',
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (5 * 60),
                                            'hidemenu' => true,
                                            'cacheable' => true,
                                            'searchable' => true,
                                            'richtext' => true,
                                            'uri_override' => true,
                                            'context_key' => 'web',
                                            'menutitle' => '',
                                            'show_in_tree' => 0,
                                            'syncsite' => 0,
                                            'properties' => array(
                                                'disable_jevix' => true,
                                                'process_tags' => false,
                                            ),
                                            'tvs' => array(
                                                'img' => 'gallery/Red-Hot-Chili-Peppers-Kiev.jpg',
                                                'gallery' => $modx->toJson(array(
                                                    array(
                                                        "MIGX_id" => 1,
                                                        'title' => 1,
                                                        'image' => "gallery/gall-1.jpg"
                                                    ),
                                                    array(
                                                        "MIGX_id" => 2,
                                                        'title' => 2,
                                                        'image' => "gallery/gall-2.jpg"
                                                    )
                                                ))
                                            ),
                                        ),
                                        'gallery6:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_galleryItem->get('id'),
                                            'pagetitle' => 'Gallery 6',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => '',
                                            'alias' => 'gallery6',
                                            'uri' => 'gallerylist/gallery/gallery6',
                                            'link_attributes' => '',
                                            'content' => '',
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (6 * 60),
                                            'hidemenu' => true,
                                            'cacheable' => true,
                                            'searchable' => true,
                                            'richtext' => true,
                                            'uri_override' => true,
                                            'context_key' => 'web',
                                            'menutitle' => '',
                                            'show_in_tree' => 0,
                                            'syncsite' => 0,
                                            'properties' => array(
                                                'disable_jevix' => true,
                                                'process_tags' => false,
                                            ),
                                            'tvs' => array(
                                                'img' => 'gallery/top-ev.jpg',
                                                'gallery' => $modx->toJson(array(
                                                    array(
                                                        "MIGX_id" => 1,
                                                        'title' => 1,
                                                        'image' => "gallery/gall-1.jpg"
                                                    ),
                                                    array(
                                                        "MIGX_id" => 2,
                                                        'title' => 2,
                                                        'image' => "gallery/gall-2.jpg"
                                                    )
                                                ))
                                            ),
                                        ),
                                        'gallery7:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_galleryItem->get('id'),
                                            'pagetitle' => 'Gallery 7',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => '',
                                            'alias' => 'gallery7',
                                            'uri' => 'gallerylist/gallery/gallery7',
                                            'link_attributes' => '',
                                            'content' => '',
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (7 * 60),
                                            'hidemenu' => true,
                                            'cacheable' => true,
                                            'searchable' => true,
                                            'richtext' => true,
                                            'uri_override' => true,
                                            'context_key' => 'web',
                                            'menutitle' => '',
                                            'show_in_tree' => 0,
                                            'syncsite' => 0,
                                            'properties' => array(
                                                'disable_jevix' => true,
                                                'process_tags' => false,
                                            ),
                                            'tvs' => array(
                                                'img' => 'gallery/top-ev-big.jpg',
                                                'gallery' => $modx->toJson(array(
                                                    array(
                                                        "MIGX_id" => 1,
                                                        'title' => 1,
                                                        'image' => "gallery/gall-1.jpg"
                                                    ),
                                                    array(
                                                        "MIGX_id" => 2,
                                                        'title' => 2,
                                                        'image' => "gallery/gall-2.jpg"
                                                    )
                                                ))
                                            ),
                                        ),
                                        'gallery8:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_galleryItem->get('id'),
                                            'pagetitle' => 'Gallery 8',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => '',
                                            'alias' => 'gallery8',
                                            'uri' => 'gallerylist/gallery/gallery8',
                                            'link_attributes' => '',
                                            'content' => '',
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (8 * 60),
                                            'hidemenu' => true,
                                            'cacheable' => true,
                                            'searchable' => true,
                                            'richtext' => true,
                                            'uri_override' => true,
                                            'context_key' => 'web',
                                            'menutitle' => '',
                                            'show_in_tree' => 0,
                                            'syncsite' => 0,
                                            'properties' => array(
                                                'disable_jevix' => true,
                                                'process_tags' => false,
                                            ),
                                            'tvs' => array(
                                                'img' => 'gallery/top-ev-big2.jpg',
                                                'gallery' => $modx->toJson(array(
                                                    array(
                                                        "MIGX_id" => 1,
                                                        'title' => 1,
                                                        'image' => "gallery/gall-1.jpg"
                                                    ),
                                                    array(
                                                        "MIGX_id" => 2,
                                                        'title' => 2,
                                                        'image' => "gallery/gall-2.jpg"
                                                    )
                                                ))
                                            ),
                                        ),
                                        'gallery9:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_galleryItem->get('id'),
                                            'pagetitle' => 'Gallery 9',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => '',
                                            'alias' => 'gallery9',
                                            'uri' => 'gallerylist/gallery/gallery9',
                                            'link_attributes' => '',
                                            'content' => '',
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (9 * 60),
                                            'hidemenu' => true,
                                            'cacheable' => true,
                                            'searchable' => true,
                                            'richtext' => true,
                                            'uri_override' => true,
                                            'context_key' => 'web',
                                            'menutitle' => '',
                                            'show_in_tree' => 0,
                                            'syncsite' => 0,
                                            'properties' => array(
                                                'disable_jevix' => true,
                                                'process_tags' => false,
                                            ),
                                            'tvs' => array(
                                                'img' => 'gallery/top-ev-big3.jpg',
                                                'gallery' => $modx->toJson(array(
                                                    array(
                                                        "MIGX_id" => 1,
                                                        'title' => 1,
                                                        'image' => "gallery/gall-1.jpg"
                                                    ),
                                                    array(
                                                        "MIGX_id" => 2,
                                                        'title' => 2,
                                                        'image' => "gallery/gall-2.jpg"
                                                    )
                                                ))
                                            ),
                                        ),
                                    )
                                ),
                                'gallery2:TicketsSection' => array(
                                    'parentCheck' => true,
                                    'class_key' => 'TicketsSection',
                                    'template' => $tpl_galleryBigList->get('id'),
                                    'pagetitle' => 'Gallery ver.2',
                                    'longtitle' => '',
                                    'description' => '',
                                    'introtext' => '',
                                    'alias' => 'gallery2',
                                    'uri' => 'gallerylist/gallery2',
                                    'link_attributes' => '',
                                    'content' => '',
                                    'isfolder' => true,
                                    'published' => true,
                                    'publishedon' => time(),
                                    'hidemenu' => false,
                                    'cacheable' => true,
                                    'searchable' => true,
                                    'richtext' => true,
                                    'context_key' => 'web',
                                    'menutitle' => '',
                                    'properties' => array(
                                        'tickets' => array(
                                            'template' => $tpl_galleryItem->get('id'),
                                            'uri' => '%alias',
                                            'disable_jevix' => true
                                        )
                                    ),
                                    'childs' => array(
                                        'gallery1:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_galleryItem->get('id'),
                                            'pagetitle' => 'Gallery 1',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => '',
                                            'alias' => 'gallery1',
                                            'uri' => 'gallerylist/gallery2/gallery1',
                                            'link_attributes' => '',
                                            'content' => '',
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (1 * 60),
                                            'hidemenu' => true,
                                            'cacheable' => true,
                                            'searchable' => true,
                                            'richtext' => true,
                                            'uri_override' => true,
                                            'context_key' => 'web',
                                            'menutitle' => '',
                                            'show_in_tree' => 0,
                                            'syncsite' => 0,
                                            'properties' => array(
                                                'disable_jevix' => true,
                                                'process_tags' => false,
                                            ),
                                            'tvs' => array(
                                                'img' => 'gallery/gall-1.jpg',
                                                'gallery' => $modx->toJson(array(
                                                    array(
                                                        "MIGX_id" => 1,
                                                        'title' => 1,
                                                        'image' => "gallery/gall-1.jpg"
                                                    ),
                                                    array(
                                                        "MIGX_id" => 2,
                                                        'title' => 2,
                                                        'image' => "gallery/gall-2.jpg"
                                                    )
                                                ))
                                            ),
                                        ),
                                        'gallery2:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_galleryItem->get('id'),
                                            'pagetitle' => 'Gallery 2',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => '',
                                            'alias' => 'gallery2',
                                            'uri' => 'gallerylist/gallery2/gallery2',
                                            'link_attributes' => '',
                                            'content' => '',
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (2 * 60),
                                            'hidemenu' => true,
                                            'cacheable' => true,
                                            'searchable' => true,
                                            'richtext' => true,
                                            'uri_override' => true,
                                            'context_key' => 'web',
                                            'menutitle' => '',
                                            'show_in_tree' => 0,
                                            'syncsite' => 0,
                                            'properties' => array(
                                                'disable_jevix' => true,
                                                'process_tags' => false,
                                            ),
                                            'tvs' => array(
                                                'img' => 'gallery/gall-2.jpg',
                                                'gallery' => $modx->toJson(array(
                                                    array(
                                                        "MIGX_id" => 1,
                                                        'title' => 1,
                                                        'image' => "gallery/gall-1.jpg"
                                                    ),
                                                    array(
                                                        "MIGX_id" => 2,
                                                        'title' => 2,
                                                        'image' => "gallery/gall-2.jpg"
                                                    )
                                                ))
                                            ),
                                        ),
                                        'gallery3:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_galleryItem->get('id'),
                                            'pagetitle' => 'Gallery 3',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => '',
                                            'alias' => 'gallery3',
                                            'uri' => 'gallerylist/gallery2/gallery3',
                                            'link_attributes' => '',
                                            'content' => '',
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (3 * 60),
                                            'hidemenu' => true,
                                            'cacheable' => true,
                                            'searchable' => true,
                                            'richtext' => true,
                                            'uri_override' => true,
                                            'context_key' => 'web',
                                            'menutitle' => '',
                                            'show_in_tree' => 0,
                                            'syncsite' => 0,
                                            'properties' => array(
                                                'disable_jevix' => true,
                                                'process_tags' => false,
                                            ),
                                            'tvs' => array(
                                                'img' => 'gallery/paramore-paramore-8253970-850-680.jpg',
                                                'gallery' => $modx->toJson(array(
                                                    array(
                                                        "MIGX_id" => 1,
                                                        'title' => 1,
                                                        'image' => "gallery/gall-1.jpg"
                                                    ),
                                                    array(
                                                        "MIGX_id" => 2,
                                                        'title' => 2,
                                                        'image' => "gallery/gall-2.jpg"
                                                    )
                                                ))
                                            ),
                                        ),
                                        'gallery4:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_galleryItem->get('id'),
                                            'pagetitle' => 'Gallery 4',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => '',
                                            'alias' => 'gallery4',
                                            'uri' => 'gallerylist/gallery2/gallery4',
                                            'link_attributes' => '',
                                            'content' => '',
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (4 * 60),
                                            'hidemenu' => true,
                                            'cacheable' => true,
                                            'searchable' => true,
                                            'richtext' => true,
                                            'uri_override' => true,
                                            'context_key' => 'web',
                                            'menutitle' => '',
                                            'show_in_tree' => 0,
                                            'syncsite' => 0,
                                            'properties' => array(
                                                'disable_jevix' => true,
                                                'process_tags' => false,
                                            ),
                                            'tvs' => array(
                                                'img' => 'gallery/Red-Hot-Chili-Peppers-Kiev.jpg',
                                                'gallery' => $modx->toJson(array(
                                                    array(
                                                        "MIGX_id" => 1,
                                                        'title' => 1,
                                                        'image' => "gallery/gall-1.jpg"
                                                    ),
                                                    array(
                                                        "MIGX_id" => 2,
                                                        'title' => 2,
                                                        'image' => "gallery/gall-2.jpg"
                                                    )
                                                ))
                                            ),
                                        ),
                                        'gallery5:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_galleryItem->get('id'),
                                            'pagetitle' => 'Gallery 5',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => '',
                                            'alias' => 'gallery5',
                                            'uri' => 'gallerylist/gallery2/gallery5',
                                            'link_attributes' => '',
                                            'content' => '',
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (5 * 60),
                                            'hidemenu' => true,
                                            'cacheable' => true,
                                            'searchable' => true,
                                            'richtext' => true,
                                            'uri_override' => true,
                                            'context_key' => 'web',
                                            'menutitle' => '',
                                            'show_in_tree' => 0,
                                            'syncsite' => 0,
                                            'properties' => array(
                                                'disable_jevix' => true,
                                                'process_tags' => false,
                                            ),
                                            'tvs' => array(
                                                'img' => 'gallery/Red-Hot-Chili-Peppers-Kiev.jpg',
                                                'gallery' => $modx->toJson(array(
                                                    array(
                                                        "MIGX_id" => 1,
                                                        'title' => 1,
                                                        'image' => "gallery/gall-1.jpg"
                                                    ),
                                                    array(
                                                        "MIGX_id" => 2,
                                                        'title' => 2,
                                                        'image' => "gallery/gall-2.jpg"
                                                    )
                                                ))
                                            ),
                                        ),
                                        'gallery6:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_galleryItem->get('id'),
                                            'pagetitle' => 'Gallery 6',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => '',
                                            'alias' => 'gallery6',
                                            'uri' => 'gallerylist/gallery2/gallery6',
                                            'link_attributes' => '',
                                            'content' => '',
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (6 * 60),
                                            'hidemenu' => true,
                                            'cacheable' => true,
                                            'searchable' => true,
                                            'richtext' => true,
                                            'uri_override' => true,
                                            'context_key' => 'web',
                                            'menutitle' => '',
                                            'show_in_tree' => 0,
                                            'syncsite' => 0,
                                            'properties' => array(
                                                'disable_jevix' => true,
                                                'process_tags' => false,
                                            ),
                                            'tvs' => array(
                                                'img' => 'gallery/top-ev.jpg',
                                                'gallery' => $modx->toJson(array(
                                                    array(
                                                        "MIGX_id" => 1,
                                                        'title' => 1,
                                                        'image' => "gallery/gall-1.jpg"
                                                    ),
                                                    array(
                                                        "MIGX_id" => 2,
                                                        'title' => 2,
                                                        'image' => "gallery/gall-2.jpg"
                                                    )
                                                ))
                                            ),
                                        ),
                                        'gallery7:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_galleryItem->get('id'),
                                            'pagetitle' => 'Gallery 7',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => '',
                                            'alias' => 'gallery7',
                                            'uri' => 'gallerylist/gallery2/gallery7',
                                            'link_attributes' => '',
                                            'content' => '',
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (7 * 60),
                                            'hidemenu' => true,
                                            'cacheable' => true,
                                            'searchable' => true,
                                            'richtext' => true,
                                            'uri_override' => true,
                                            'context_key' => 'web',
                                            'menutitle' => '',
                                            'show_in_tree' => 0,
                                            'syncsite' => 0,
                                            'properties' => array(
                                                'disable_jevix' => true,
                                                'process_tags' => false,
                                            ),
                                            'tvs' => array(
                                                'img' => 'gallery/top-ev-big.jpg',
                                                'gallery' => $modx->toJson(array(
                                                    array(
                                                        "MIGX_id" => 1,
                                                        'title' => 1,
                                                        'image' => "gallery/gall-1.jpg"
                                                    ),
                                                    array(
                                                        "MIGX_id" => 2,
                                                        'title' => 2,
                                                        'image' => "gallery/gall-2.jpg"
                                                    )
                                                ))
                                            ),
                                        ),
                                        'gallery8:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_galleryItem->get('id'),
                                            'pagetitle' => 'Gallery 8',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => '',
                                            'alias' => 'gallery8',
                                            'uri' => 'gallerylist/gallery2/gallery8',
                                            'link_attributes' => '',
                                            'content' => '',
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (8 * 60),
                                            'hidemenu' => true,
                                            'cacheable' => true,
                                            'searchable' => true,
                                            'richtext' => true,
                                            'uri_override' => true,
                                            'context_key' => 'web',
                                            'menutitle' => '',
                                            'show_in_tree' => 0,
                                            'syncsite' => 0,
                                            'properties' => array(
                                                'disable_jevix' => true,
                                                'process_tags' => false,
                                            ),
                                            'tvs' => array(
                                                'img' => 'gallery/top-ev-big2.jpg',
                                                'gallery' => $modx->toJson(array(
                                                    array(
                                                        "MIGX_id" => 1,
                                                        'title' => 1,
                                                        'image' => "gallery/gall-1.jpg"
                                                    ),
                                                    array(
                                                        "MIGX_id" => 2,
                                                        'title' => 2,
                                                        'image' => "gallery/gall-2.jpg"
                                                    )
                                                ))
                                            ),
                                        ),
                                        'gallery9:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_galleryItem->get('id'),
                                            'pagetitle' => 'Gallery 9',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => '',
                                            'alias' => 'gallery9',
                                            'uri' => 'gallerylist/gallery2/gallery9',
                                            'link_attributes' => '',
                                            'content' => '',
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (9 * 60),
                                            'hidemenu' => true,
                                            'cacheable' => true,
                                            'searchable' => true,
                                            'richtext' => true,
                                            'uri_override' => true,
                                            'context_key' => 'web',
                                            'menutitle' => '',
                                            'show_in_tree' => 0,
                                            'syncsite' => 0,
                                            'properties' => array(
                                                'disable_jevix' => true,
                                                'process_tags' => false,
                                            ),
                                            'tvs' => array(
                                                'img' => 'gallery/top-ev-big3.jpg',
                                                'gallery' => $modx->toJson(array(
                                                    array(
                                                        "MIGX_id" => 1,
                                                        'title' => 1,
                                                        'image' => "gallery/gall-1.jpg"
                                                    ),
                                                    array(
                                                        "MIGX_id" => 2,
                                                        'title' => 2,
                                                        'image' => "gallery/gall-2.jpg"
                                                    )
                                                ))
                                            ),
                                        ),
                                    )
                                ),
                            )
                        ),
                        'blogList' => array(
                            'class_key' => 'modWebLink',
                            'template' => 0,
                            'pagetitle' => 'Blog',
                            'longtitle' => '',
                            'description' => '',
                            'introtext' => '',
                            'alias' => 'bloglist',
                            'uri' => 'bloglist',
                            'link_attributes' => '',
                            'content' => $modx->getObject('modResource', array('alias' => 'blog','context_key' => 'web',))->get('id'),
                            'isfolder' => true,
                            'published' => true,
                            'publishedon' => time(),
                            'hidemenu' => false,
                            'cacheable' => true,
                            'searchable' => true,
                            'richtext' => true,
                            'context_key' => 'web',
                            'menutitle' => '',
                            'childs' => array(
                                'blog:TicketsSection' => array(
                                    'parentCheck' => true,
                                    'class_key' => 'TicketsSection',
                                    'template' => $tpl_blogList->get('id'),
                                    'pagetitle' => 'Blog',
                                    'longtitle' => '',
                                    'description' => '',
                                    'introtext' => '',
                                    'alias' => 'blog',
                                    'uri' => 'bloglist/blog',
                                    'link_attributes' => '',
                                    'content' => '',
                                    'isfolder' => true,
                                    'published' => true,
                                    'publishedon' => time(),
                                    'hidemenu' => false,
                                    'cacheable' => true,
                                    'searchable' => true,
                                    'richtext' => true,
                                    'context_key' => 'web',
                                    'menutitle' => '',
                                    'properties' => array(
                                        'tickets' => array(
                                            'template' => $tpl_blogItem->get('id'),
                                            'uri' => '%alias',
                                            'disable_jevix' => true
                                        )
                                    ),
                                    'childs' => array(
                                        'article-blog1:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_blogItem->get('id'),
                                            'pagetitle' => 'Article Blog 1',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => '',
                                            'alias' => 'article-blog1',
                                            'uri' => 'bloglist/blog/article-blog1',
                                            'link_attributes' => '',
                                            'content' => '',
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (1 * 60),
                                            'hidemenu' => true,
                                            'cacheable' => true,
                                            'searchable' => true,
                                            'richtext' => true,
                                            'uri_override' => true,
                                            'context_key' => 'web',
                                            'menutitle' => '',
                                            'show_in_tree' => 0,
                                            'syncsite' => 0,
                                            'properties' => array(
                                                'disable_jevix' => true,
                                                'process_tags' => false,
                                            ),
                                            'tvs' => array(
                                                'img' => 'blog/gal-1.jpg',
                                            ),
                                        ),
                                        'article-blog2:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_blogItem->get('id'),
                                            'pagetitle' => 'Article Blog 2',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => '',
                                            'alias' => 'article-blog2',
                                            'uri' => 'bloglist/blog/article-blog2',
                                            'link_attributes' => '',
                                            'content' => '',
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (2 * 60),
                                            'hidemenu' => true,
                                            'cacheable' => true,
                                            'searchable' => true,
                                            'richtext' => true,
                                            'uri_override' => true,
                                            'context_key' => 'web',
                                            'menutitle' => '',
                                            'show_in_tree' => 0,
                                            'syncsite' => 0,
                                            'properties' => array(
                                                'disable_jevix' => true,
                                                'process_tags' => false,
                                            ),
                                            'tvs' => array(
                                                'img' => '',
                                            ),
                                        ),
                                        'article-blog3:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_blogItem->get('id'),
                                            'pagetitle' => 'Article Blog 3',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => '',
                                            'alias' => 'article-blog3',
                                            'uri' => 'bloglist/blog/article-blog3',
                                            'link_attributes' => '',
                                            'content' => '',
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (3 * 60),
                                            'hidemenu' => true,
                                            'cacheable' => true,
                                            'searchable' => true,
                                            'richtext' => true,
                                            'uri_override' => true,
                                            'context_key' => 'web',
                                            'menutitle' => '',
                                            'show_in_tree' => 0,
                                            'syncsite' => 0,
                                            'properties' => array(
                                                'disable_jevix' => true,
                                                'process_tags' => false,
                                            ),
                                            'tvs' => array(
                                                'img' => 'blog/top-ev3.jpg',
                                            ),
                                        ),
                                        'article-blog4:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_blogItem->get('id'),
                                            'pagetitle' => 'Article Blog 4',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => '',
                                            'alias' => 'article-blog4',
                                            'uri' => 'bloglist/blog/article-blog4',
                                            'link_attributes' => '',
                                            'content' => '',
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (4 * 60),
                                            'hidemenu' => true,
                                            'cacheable' => true,
                                            'searchable' => true,
                                            'richtext' => true,
                                            'uri_override' => true,
                                            'context_key' => 'web',
                                            'menutitle' => '',
                                            'show_in_tree' => 0,
                                            'syncsite' => 0,
                                            'properties' => array(
                                                'disable_jevix' => true,
                                                'process_tags' => false,
                                            ),
                                            'tvs' => array(
                                                'img' => 'blog/gal-1.jpg',
                                            ),
                                        ),
                                        'article-blog5:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_blogItem->get('id'),
                                            'pagetitle' => 'Article Blog 5',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => getIntroDemo($content_article_blog6),
                                            'alias' => 'article-blog5',
                                            'uri' => 'bloglist/blog/article-blog5',
                                            'link_attributes' => '',
                                            'content' => $content_article_blog6,
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (5 * 60),
                                            'hidemenu' => true,
                                            'cacheable' => true,
                                            'searchable' => true,
                                            'richtext' => true,
                                            'uri_override' => true,
                                            'context_key' => 'web',
                                            'menutitle' => '',
                                            'show_in_tree' => 0,
                                            'syncsite' => 0,
                                            'properties' => array(
                                                'disable_jevix' => true,
                                                'process_tags' => false,
                                            ),
                                            'tvs' => array(
                                                'img' => '',
                                            ),
                                        ),
                                        'article-blog6:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_blogItem->get('id'),
                                            'pagetitle' => 'Article Blog 6',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => getIntroDemo($content_article_blog6),
                                            'alias' => 'article-blog6',
                                            'uri' => 'bloglist/blog/article-blog6',
                                            'link_attributes' => '',
                                            'content' => $content_article_blog6,
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (6 * 60),
                                            'hidemenu' => true,
                                            'cacheable' => true,
                                            'searchable' => true,
                                            'richtext' => true,
                                            'uri_override' => true,
                                            'context_key' => 'web',
                                            'menutitle' => '',
                                            'show_in_tree' => 0,
                                            'syncsite' => 0,
                                            'properties' => array(
                                                'disable_jevix' => true,
                                                'process_tags' => false,
                                            ),
                                            'tvs' => array(
                                                'img' => 'blog/top-ev3.jpg',
                                            ),
                                        )
                                    )
                                ),
                                'blog2:TicketsSection' => array(
                                    'class_key' => 'TicketsSection',
                                    'template' => $tpl_blogListTile->get('id'),
                                    'pagetitle' => 'Blog ver.2',
                                    'longtitle' => '',
                                    'description' => '',
                                    'introtext' => '',
                                    'alias' => 'blog2',
                                    'uri' => 'bloglist/blog2',
                                    'link_attributes' => '',
                                    'content' => '',
                                    'isfolder' => true,
                                    'published' => true,
                                    'publishedon' => time(),
                                    'hidemenu' => false,
                                    'cacheable' => true,
                                    'searchable' => true,
                                    'richtext' => true,
                                    'context_key' => 'web',
                                    'menutitle' => '',
                                    'properties' => array(
                                        'tickets' => array(
                                            'template' => $tpl_blogItem->get('id'),
                                            'uri' => '%alias',
                                            'disable_jevix' => true
                                        )
                                    ),
                                    'childs' => array(
                                        'article-blog1:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_blogItem->get('id'),
                                            'pagetitle' => 'Article Blog 1',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => '',
                                            'alias' => 'article-blog1',
                                            'uri' => 'bloglist/blog2/article-blog1',
                                            'link_attributes' => '',
                                            'content' => '',
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (1 * 60),
                                            'hidemenu' => true,
                                            'cacheable' => true,
                                            'searchable' => true,
                                            'richtext' => true,
                                            'uri_override' => true,
                                            'context_key' => 'web',
                                            'menutitle' => '',
                                            'show_in_tree' => 0,
                                            'syncsite' => 0,
                                            'properties' => array(
                                                'disable_jevix' => true,
                                                'process_tags' => false,
                                            ),
                                            'tvs' => array(
                                                'img' => 'blog/gal-1.jpg',
                                            ),
                                        ),
                                        'article-blog2:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_blogItem->get('id'),
                                            'pagetitle' => 'Article Blog 2',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => '',
                                            'alias' => 'article-blog2',
                                            'uri' => 'bloglist/blog2/article-blog2',
                                            'link_attributes' => '',
                                            'content' => '',
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (2 * 60),
                                            'hidemenu' => true,
                                            'cacheable' => true,
                                            'searchable' => true,
                                            'richtext' => true,
                                            'uri_override' => true,
                                            'context_key' => 'web',
                                            'menutitle' => '',
                                            'show_in_tree' => 0,
                                            'syncsite' => 0,
                                            'properties' => array(
                                                'disable_jevix' => true,
                                                'process_tags' => false,
                                            ),
                                            'tvs' => array(
                                                'img' => '',
                                            ),
                                        ),
                                        'article-blog3:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_blogItem->get('id'),
                                            'pagetitle' => 'Article Blog 3',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => '',
                                            'alias' => 'article-blog3',
                                            'uri' => 'bloglist/blog2/article-blog3',
                                            'link_attributes' => '',
                                            'content' => '',
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (3 * 60),
                                            'hidemenu' => true,
                                            'cacheable' => true,
                                            'searchable' => true,
                                            'richtext' => true,
                                            'uri_override' => true,
                                            'context_key' => 'web',
                                            'menutitle' => '',
                                            'show_in_tree' => 0,
                                            'syncsite' => 0,
                                            'properties' => array(
                                                'disable_jevix' => true,
                                                'process_tags' => false,
                                            ),
                                            'tvs' => array(
                                                'img' => 'blog/top-ev3.jpg',
                                            ),
                                        ),
                                        'article-blog4:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_blogItem->get('id'),
                                            'pagetitle' => 'Article Blog 4',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => '',
                                            'alias' => 'article-blog4',
                                            'uri' => 'bloglist/blog2/article-blog4',
                                            'link_attributes' => '',
                                            'content' => '',
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (4 * 60),
                                            'hidemenu' => true,
                                            'cacheable' => true,
                                            'searchable' => true,
                                            'richtext' => true,
                                            'uri_override' => true,
                                            'context_key' => 'web',
                                            'menutitle' => '',
                                            'show_in_tree' => 0,
                                            'syncsite' => 0,
                                            'properties' => array(
                                                'disable_jevix' => true,
                                                'process_tags' => false,
                                            ),
                                            'tvs' => array(
                                                'img' => 'blog/gal-1.jpg',
                                            ),
                                        ),
                                        'article-blog5:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_blogItem->get('id'),
                                            'pagetitle' => 'Article Blog 5',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => getIntroDemo($content_article_blog6),
                                            'alias' => 'article-blog5',
                                            'uri' => 'bloglist/blog2/article-blog5',
                                            'link_attributes' => '',
                                            'content' => $content_article_blog6,
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (5 * 60),
                                            'hidemenu' => true,
                                            'cacheable' => true,
                                            'searchable' => true,
                                            'richtext' => true,
                                            'uri_override' => true,
                                            'context_key' => 'web',
                                            'menutitle' => '',
                                            'show_in_tree' => 0,
                                            'syncsite' => 0,
                                            'properties' => array(
                                                'disable_jevix' => true,
                                                'process_tags' => false,
                                            ),
                                            'tvs' => array(
                                                'img' => '',
                                            ),
                                        ),
                                        'article-blog6:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_blogItem->get('id'),
                                            'pagetitle' => 'Article Blog 6',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => getIntroDemo($content_article_blog6),
                                            'alias' => 'article-blog6',
                                            'uri' => 'bloglist/blog2/article-blog6',
                                            'link_attributes' => '',
                                            'content' => $content_article_blog6,
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (6 * 60),
                                            'hidemenu' => true,
                                            'cacheable' => true,
                                            'searchable' => true,
                                            'richtext' => true,
                                            'uri_override' => true,
                                            'context_key' => 'web',
                                            'menutitle' => '',
                                            'show_in_tree' => 0,
                                            'syncsite' => 0,
                                            'properties' => array(
                                                'disable_jevix' => true,
                                                'process_tags' => false,
                                            ),
                                            'tvs' => array(
                                                'img' => 'blog/top-ev3.jpg',
                                            ),
                                        )
                                    )
                                ),
                            )
                        ),
                        'partners' => array(
                            'template' => $tpl_partners->get('id'),
                            'pagetitle' => 'Our Partners',
                            'longtitle' => '',
                            'description' => '',
                            'introtext' => '',
                            'alias' => 'partners',
                            'uri' => 'partners',
                            'link_attributes' => '',
                            'content' => '',
                            'isfolder' => true,
                            'published' => true,
                            'publishedon' => time(),
                            'hidemenu' => true,
                            'cacheable' => true,
                            'searchable' => false,
                            'richtext' => true,
                            'context_key' => 'web',
                            'menutitle' => '',
                            'childs' => array(
                                'partner1' => array(
                                    'template' => $tpl_partners->get('id'),
                                    'pagetitle' => 'Partner 1',
                                    'longtitle' => '',
                                    'description' => '',
                                    'introtext' => '',
                                    'alias' => 'partner1',
                                    'link_attributes' => '',
                                    'content' => '',
                                    'isfolder' => false,
                                    'published' => true,
                                    'publishedon' => time(),
                                    'hidemenu' => true,
                                    'cacheable' => true,
                                    'searchable' => false,
                                    'richtext' => true,
                                    'context_key' => 'web',
                                    'menutitle' => '',
                                    'tvs' => array(
                                        'img' => 'partners/partner1.jpg',
                                    ),
                                ),
                                'partner2' => array(
                                    'template' => $tpl_partners->get('id'),
                                    'pagetitle' => 'Partner 2',
                                    'longtitle' => '',
                                    'description' => '',
                                    'introtext' => '',
                                    'alias' => 'partner2',
                                    'link_attributes' => '',
                                    'content' => '',
                                    'isfolder' => false,
                                    'published' => true,
                                    'publishedon' => time(),
                                    'hidemenu' => true,
                                    'cacheable' => true,
                                    'searchable' => false,
                                    'richtext' => true,
                                    'context_key' => 'web',
                                    'menutitle' => '',
                                    'tvs' => array(
                                        'img' => 'partners/partner2.jpg',
                                    ),
                                ),
                                'partner3' => array(
                                    'template' => $tpl_partners->get('id'),
                                    'pagetitle' => 'Partner 3',
                                    'longtitle' => '',
                                    'description' => '',
                                    'introtext' => '',
                                    'alias' => 'partner3',
                                    'link_attributes' => '',
                                    'content' => '',
                                    'isfolder' => false,
                                    'published' => true,
                                    'publishedon' => time(),
                                    'hidemenu' => true,
                                    'cacheable' => true,
                                    'searchable' => false,
                                    'richtext' => true,
                                    'context_key' => 'web',
                                    'menutitle' => '',
                                    'tvs' => array(
                                        'img' => 'partners/partner3.jpg',
                                    ),
                                ),
                                'partner4' => array(
                                    'template' => $tpl_partners->get('id'),
                                    'pagetitle' => 'Partner 4',
                                    'longtitle' => '',
                                    'description' => '',
                                    'introtext' => '',
                                    'alias' => 'partner4',
                                    'link_attributes' => '',
                                    'content' => '',
                                    'isfolder' => false,
                                    'published' => true,
                                    'publishedon' => time(),
                                    'hidemenu' => true,
                                    'cacheable' => true,
                                    'searchable' => false,
                                    'richtext' => true,
                                    'context_key' => 'web',
                                    'menutitle' => '',
                                    'tvs' => array(
                                        'img' => 'partners/partner4.jpg',
                                    ),
                                ),
                                'partner5' => array(
                                    'template' => $tpl_partners->get('id'),
                                    'pagetitle' => 'Partner 5',
                                    'longtitle' => '',
                                    'description' => '',
                                    'introtext' => '',
                                    'alias' => 'partner5',
                                    'link_attributes' => '',
                                    'content' => '',
                                    'isfolder' => false,
                                    'published' => true,
                                    'publishedon' => time(),
                                    'hidemenu' => true,
                                    'cacheable' => true,
                                    'searchable' => false,
                                    'richtext' => true,
                                    'context_key' => 'web',
                                    'menutitle' => '',
                                    'tvs' => array(
                                        'img' => 'partners/partner5.jpg',
                                    ),
                                ),
                                'partner6' => array(
                                    'template' => $tpl_partners->get('id'),
                                    'pagetitle' => 'Partner 6',
                                    'longtitle' => '',
                                    'description' => '',
                                    'introtext' => '',
                                    'alias' => 'partner6',
                                    'link_attributes' => '',
                                    'content' => '',
                                    'isfolder' => false,
                                    'published' => true,
                                    'publishedon' => time(),
                                    'hidemenu' => true,
                                    'cacheable' => true,
                                    'searchable' => false,
                                    'richtext' => true,
                                    'context_key' => 'web',
                                    'menutitle' => '',
                                    'tvs' => array(
                                        'img' => 'partners/partner6.jpg',
                                    ),
                                ),
                                'partner7' => array(
                                    'template' => $tpl_partners->get('id'),
                                    'pagetitle' => 'Partner 7',
                                    'longtitle' => '',
                                    'description' => '',
                                    'introtext' => '',
                                    'alias' => 'partner7',
                                    'link_attributes' => '',
                                    'content' => '',
                                    'isfolder' => false,
                                    'published' => true,
                                    'publishedon' => time(),
                                    'hidemenu' => true,
                                    'cacheable' => true,
                                    'searchable' => false,
                                    'richtext' => true,
                                    'context_key' => 'web',
                                    'menutitle' => '',
                                    'tvs' => array(
                                        'img' => 'partners/partner6.jpg',
                                    ),
                                ),
                                'partner8' => array(
                                    'template' => $tpl_partners->get('id'),
                                    'pagetitle' => 'Partner 8',
                                    'longtitle' => '',
                                    'description' => '',
                                    'introtet' => '',
                                    'alias' => 'partner8',
                                    'link_attributes' => '',
                                    'content' => '',
                                    'isfolder' => false,
                                    'published' => true,
                                    'publishedon' => time(),
                                    'hidemenu' => true,
                                    'cacheable' => true,
                                    'searchable' => false,
                                    'richtext' => true,
                                    'context_key' => 'web',
                                    'menutitle' => '',
                                    'tvs' => array(
                                        'img' => 'partners/partner6.jpg',
                                    ),
                                )
                            )
                        ),
                        'textList' => array(
                            'class_key' => 'modWebLink',
                            'template' => 0,
                            'pagetitle' => 'Text',
                            'longtitle' => '',
                            'description' => '',
                            'introtext' => '',
                            'alias' => 'textlist',
                            'uri' => 'textlist',
                            'link_attributes' => '',
                            'content' => $modx->getObject('modResource', array('alias' => 'text','context_key' => 'web',))->get('id'),
                            'isfolder' => true,
                            'published' => true,
                            'publishedon' => time(),
                            'hidemenu' => false,
                            'cacheable' => true,
                            'searchable' => true,
                            'richtext' => true,
                            'context_key' => 'web',
                            'menutitle' => '',
                            'childs' => array(
                                'text' => array(
                                    'parentCheck' => true,
                                    'template' => $tpl_text->get('id'),
                                    'pagetitle' => 'Text',
                                    'longtitle' => '',
                                    'description' => '',
                                    'introtext' => '',
                                    'alias' => 'text',
                                    'uri' => 'text',
                                    'link_attributes' => '',
                                    'content' => $content_article_blog6,
                                    'isfolder' => false,
                                    'published' => true,
                                    'publishedon' => time(),
                                    'hidemenu' => false,
                                    'cacheable' => true,
                                    'searchable' => true,
                                    'richtext' => true,
                                    'context_key' => 'web',
                                    'menutitle' => '',
                                ),
                                'textWithImage' => array(
                                    'parentCheck' => true,
                                    'template' => $tpl_textWithImage->get('id'),
                                    'pagetitle' => 'Text with image',
                                    'longtitle' => '',
                                    'description' => '',
                                    'introtext' => '',
                                    'alias' => 'text-with-image',
                                    'uri' => 'text-with-image',
                                    'link_attributes' => '',
                                    'content' => $content_article_blog6,
                                    'isfolder' => false,
                                    'published' => true,
                                    'publishedon' => time(),
                                    'hidemenu' => false,
                                    'cacheable' => true,
                                    'searchable' => true,
                                    'richtext' => true,
                                    'context_key' => 'web',
                                    'menutitle' => '',
                                    'tvs' => array(
                                        'img' => 'blog/top-ev3.jpg',
                                    ),
                                ),
                                'textAside' => array(
                                    'parentCheck' => true,
                                    'template' => $tpl_textAside->get('id'),
                                    'pagetitle' => 'Text aside',
                                    'longtitle' => '',
                                    'description' => '',
                                    'introtext' => '',
                                    'alias' => 'text-aside',
                                    'uri' => 'text-aside',
                                    'link_attributes' => '',
                                    'content' => $content_article_blog6,
                                    'isfolder' => false,
                                    'published' => true,
                                    'publishedon' => time(),
                                    'hidemenu' => false,
                                    'cacheable' => true,
                                    'searchable' => true,
                                    'richtext' => true,
                                    'context_key' => 'web',
                                    'menutitle' => '',
                                ),
                                'textAsideWithImage' => array(
                                    'parentCheck' => true,
                                    'template' => $tpl_textAsideWithImage->get('id'),
                                    'pagetitle' => 'Text aside with image',
                                    'longtitle' => '',
                                    'description' => '',
                                    'introtext' => '',
                                    'alias' => 'text-aside-with-image',
                                    'uri' => 'text-aside-with-image',
                                    'link_attributes' => '',
                                    'content' => $content_article_blog6,
                                    'isfolder' => false,
                                    'published' => true,
                                    'publishedon' => time(),
                                    'hidemenu' => false,
                                    'cacheable' => true,
                                    'searchable' => true,
                                    'richtext' => true,
                                    'context_key' => 'web',
                                    'menutitle' => '',
                                    'tvs' => array(
                                        'img' => 'blog/top-ev3.jpg',
                                    ),
                                ),
                                'textAsideRight' => array(
                                    'parentCheck' => true,
                                    'template' => $tpl_textAsideRight->get('id'),
                                    'pagetitle' => 'Text aside right',
                                    'longtitle' => '',
                                    'description' => '',
                                    'introtext' => '',
                                    'alias' => 'text-aside-right',
                                    'uri' => 'text-aside-right',
                                    'link_attributes' => '',
                                    'content' => $content_article_blog6,
                                    'isfolder' => false,
                                    'published' => true,
                                    'publishedon' => time(),
                                    'hidemenu' => false,
                                    'cacheable' => true,
                                    'searchable' => true,
                                    'richtext' => true,
                                    'context_key' => 'web',
                                    'menutitle' => '',
                                ),
                                'textAsideRightWithImage' => array(
                                    'parentCheck' => true,
                                    'template' => $tpl_textAsideRightWithImage->get('id'),
                                    'pagetitle' => 'Text aside right with image',
                                    'longtitle' => '',
                                    'description' => '',
                                    'introtext' => '',
                                    'alias' => 'text-aside-right-with-image',
                                    'uri' => 'text-aside-right-with-image',
                                    'link_attributes' => '',
                                    'content' => $content_article_blog6,
                                    'isfolder' => false,
                                    'published' => true,
                                    'publishedon' => time(),
                                    'hidemenu' => false,
                                    'cacheable' => true,
                                    'searchable' => true,
                                    'richtext' => true,
                                    'context_key' => 'web',
                                    'menutitle' => '',
                                    'tvs' => array(
                                        'img' => 'blog/top-ev3.jpg',
                                    ),
                                ),
                            )
                        ),
                        'contacts' => array(
                            'template' => $tpl_contacts->get('id'),
                            'pagetitle' => 'Contacts',
                            'longtitle' => '',
                            'description' => '',
                            'introtext' => '',
                            'alias' => 'contacts',
                            'uri' => 'contacts',
                            'link_attributes' => '',
                            'content' => $content_contacts,
                            'isfolder' => false,
                            'published' => true,
                            'publishedon' => time(),
                            'hidemenu' => false,
                            'cacheable' => true,
                            'searchable' => true,
                            'richtext' => true,
                            'context_key' => 'web',
                            'menutitle' => '',
                        ),
                        'aboutList' => array(
                            'class_key' => 'modWebLink',
                            'template' => 0,
                            'pagetitle' => 'About template',
                            'longtitle' => '',
                            'description' => '',
                            'introtext' => '',
                            'alias' => 'aboutlist',
                            'uri' => 'aboutlist',
                            'link_attributes' => '',
                            'content' => $modx->getObject('modResource', array('alias' => 'about','context_key' => 'web',))->get('id'),
                            'isfolder' => true,
                            'published' => true,
                            'publishedon' => time(),
                            'hidemenu' => false,
                            'cacheable' => true,
                            'searchable' => true,
                            'richtext' => true,
                            'context_key' => 'web',
                            'menutitle' => '',
                            'childs' => array(
                                'about' => array(
                                    'parentCheck' => true,
                                    'template' => $tpl_text->get('id'),
                                    'pagetitle' => 'About template',
                                    'longtitle' => '',
                                    'description' => '',
                                    'introtext' => '',
                                    'alias' => 'about',
                                    'uri' => 'about',
                                    'link_attributes' => '',
                                    'content' => $content_about_template,
                                    'isfolder' => false,
                                    'published' => true,
                                    'publishedon' => time(),
                                    'hidemenu' => false,
                                    'cacheable' => true,
                                    'searchable' => true,
                                    'richtext' => true,
                                    'context_key' => 'web',
                                    'menutitle' => '',
                                ),
                                'manual' => array(
                                    'template' => $tpl_text->get('id'),
                                    'pagetitle' => 'Manual',
                                    'longtitle' => '',
                                    'description' => '',
                                    'introtext' => '',
                                    'alias' => 'manual',
                                    'uri' => 'manual',
                                    'link_attributes' => '',
                                    'content' => $content_manual,
                                    'isfolder' => false,
                                    'published' => true,
                                    'publishedon' => time(),
                                    'hidemenu' => false,
                                    'cacheable' => true,
                                    'searchable' => true,
                                    'richtext' => true,
                                    'context_key' => 'web',
                                    'menutitle' => '',
                                ),
                                'elements' => array(
                                    'template' => $tpl_text->get('id'),
                                    'pagetitle' => 'Design elements',
                                    'longtitle' => '',
                                    'description' => '',
                                    'introtext' => '',
                                    'alias' => 'design-elements',
                                    'uri' => 'design-elements',
                                    'link_attributes' => '',
                                    'content' => $content_design_elements,
                                    'isfolder' => false,
                                    'published' => true,
                                    'publishedon' => time(),
                                    'hidemenu' => false,
                                    'cacheable' => true,
                                    'searchable' => true,
                                    'richtext' => true,
                                    'context_key' => 'web',
                                    'menutitle' => '',
                                ),
                                'unisender' => array(
                                    'class_key' => 'modWebLink',
                                    'template' => 0,
                                    'pagetitle' => 'Unisender',
                                    'longtitle' => '',
                                    'description' => '',
                                    'introtext' => '',
                                    'alias' => 'unisender',
                                    'uri' => 'unisender',
                                    'link_attributes' => '',
                                    'content' => 'http://www.unisender.com/?a=makebecool&amp;chan=clubcube',
                                    'isfolder' => false,
                                    'published' => true,
                                    'publishedon' => time(),
                                    'hidemenu' => true,
                                    'cacheable' => true,
                                    'searchable' => false,
                                    'richtext' => true,
                                    'context_key' => 'web',
                                    'menutitle' => '',
                                ),
                            )
                        ),
                    )
                );
                createDocsDemo($modx, 'web', $resources, null);
                $modx->reloadContext('web');
                break;
            }

    }
}
return true;