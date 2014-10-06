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
	&tplLast=`eventsItemLastIndex`
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

$content_text = '
<p class="lead">Old unsatiable our now but considered travelling impression.
In excuse hardly summer in basket misery. By rent an part need.
At wrong of of water those linen. Needed oppose seemed how all.
Very mrs shed shew gave you.</p>
<div class="img-full-width">
    <figure class="content-figure">
        <img src="assets/uploads/blog/Open blog/Content_07_wide.jpg" alt="" title="One but not alone">
        <figcaption>One but not alone</figcaption>
    </figure>
</div>
<p>Few hills tears are weeks saw. Partiality insensible celebrated is in. Am offended as wandered thoughts greatest an friendly.
Evening covered in he exposed fertile to. Horses seeing at played plenty nature to expect we. Young say led stood hills own thing get.</p>
<ul>
<li>Still court no small think death so an wrote. Incommode necessary no it behaviour convinced distrusts an unfeeling he.</li>
<li>Could death since do we hoped is in.</li>
<li>Exquisite no my <a href="#" titile="attention extensive link">attention extensive</a>.</li>
<li>The determine conveying moonlight age. Avoid for see marry sorry child. Sitting so totally forbade hundred to.</li>
<li>Brother set had private his letters observe outward resolve. Shutters ye marriage to throwing we as. Effect in if agreed he wished wanted admire expect. Or shortly visitor is comfort placing to cheered do.</li>
</ul>
<p>Out too the been like hard off. Improve enquire welcome own beloved matters her. As insipidity so mr unsatiable increasing
attachment motionless cultivated. Addition mr husbands unpacked occasion he oh. Is unsatiable if projecting boisterous
insensible. It recommend be resolving pretended middleton.</p>
<ol>
<li>Still court no small think death so an wrote. Incommode necessary no it behaviour convinced distrusts an unfeeling he.</li>
<li>Could death since do we hoped is in.</li>
<li>Exquisite no my attention extensive.</li>
<li>The determine conveying moonlight age. Avoid for see marry sorry child. Sitting so totally forbade hundred to.</li>
<li>Brother set had private his letters observe outward resolve. Shutters ye marriage to throwing we as.
Effect in if agreed he wished wanted admire expect. Or shortly visitor is comfort placing to cheered do.</li>
</ol>
<h2>New life</h2>
<p>She who arrival end how fertile enabled. Brother she add yet see minuter natural smiling article painted.
Themselves at dispatched interested insensible am be prosperous reasonably it. </p>
<div class="img-side-right">
    <figure class="content-figure">
        <img src="assets/uploads/blog/Open blog/Content_01.jpg" alt="" title="Be free">
        <figcaption>Swim as you like</figcaption>
    </figure>
</div>
<p>In either so spring wished. Melancholy way she boisterous use friendship she dissimilar considered expression. Sex quick arose mrs lived. Mr things
do plenty others an vanity myself waited to. Always parish tastes at as mr father dining at.</p>
<p>Shewing met parties gravity husband sex pleased. On to no kind do next feel held walk. Last own loud and knew give gay four.
Sentiments motionless or principles preference excellence am. Literature surrounded insensible at indulgence or
to admiration remarkably. Matter future lovers desire marked boy use. Chamber reached do he nothing be.</p>
<p>She exposed painted fifteen are noisier mistake led waiting. Surprise not wandered speedily husbands although yet end. We highest ye friends is exposed equally in.
Ignorant had too strictly followed. Astonished as travelling assistance or unreserved oh pianoforte ye.
Five with seen put need tore add neat. Bringing it is he returned received raptures.</p>
<h3>True story of rock</h3>
<p>The foundations of rock music are in rock and roll, which originated in the United States during the late 1940s and early 1950s, and quickly spread to much of the rest of the world. Its immediate origins lay in a melding of various black musical genres of the time, including rhythm and blues and gospel music, with country and western. In 1951, Cleveland, Ohio disc jockey Alan Freed began playing rhythm and blues music for a multi-racial audience, and is credited with first using the phrase "rock and roll" to describe the music.</p>
<blockquote>
<p>"I like playing music because it`s a good living and I get satisfaction from it. But I can`t feed my family with satisfaction."</p>
<p><b>James Hetfield</b></p>
</blockquote>
<h4>The ultimate rock genres</h4>
<div class="table-responsive">
<table class="club-table table-striped">
    <thead>
        <tr>
            <th>Genres</th>
            <th>Best band</th>
            <th>Best Album</th>
            <th>Year</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Alternative rock‎</td>
            <td><a href="https://en.wikipedia.org/wiki/Seether" title="Seether wiki">Seether</a></td>
            <td>Disclaimer</td>
            <td>2002</td>
        </tr>
        <tr>
            <td>Funk rock</td>
            <td><a href="http://en.wikipedia.org/wiki/Red_Hot_Chili_Peppers" title="Red Hot Chili Peppers wiki">Red Hot Chili Peppers</a></td>
            <td>Blood Sugar Sex Magik</td>
            <td>1991</td>
        </tr>
        <tr>
            <td>Thrash metal</td>
            <td><a href="http://en.wikipedia.org/wiki/Metallica" title="Metallica wiki">Metallica</a></td>
            <td>Master of Puppets<span class="footnote">*</span></td>
            <td>1986</td>
        </tr>
        <tr>
            <td>Sludge</td>
            <td><a href="http://en.wikipedia.org/wiki/Down_(band)" title="Down wiki">Down</a></td>
            <td>NOLA</td>
            <td>1995</td>
        </tr>
        <tr>
            <td>Post-metal</td>
            <td><a href="http://en.wikipedia.org/wiki/Tool_(band)" title="Tool wiki">Tool</a></td>
            <td>10,000 Days</td>
            <td>2006</td>
        </tr>
    </tbody>
</table>
</div>
<hr>
<span class="footnote-main"><span class="footnote">*&nbsp;</span>– In our humble opinion</span>
<p>Progressive rock, a term sometimes used interchangeably with art rock, was an attempt to move beyond established musical
formulas by experimenting with different instruments, song types, and forms. From the mid-1960s The Left Banke, The Beatles,
The Rolling Stones and The Beach Boys, had pioneered the inclusion of harpsichords, wind and string sections on their recordings
to produce a form of Baroque rock and can be heard in singles like Procol Harum`s "A Whiter Shade of Pale" (1967), with
its Bach inspired introduction. The Moody Blues used a full orchestra on their album Days of Future Passed (1967) and
subsequently created orchestral sounds with synthesisers. Classical orchestration, keyboards and synthesisers were a
frequent edition to the established rock format of guitars, bass and drums in subsequent progressive rock.</p>
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
<h2>DESIGN</h2>
<div class="row">
    <div class="col-md-4 col-sm-4">
        <h4>More than 20 unique pages</h4>
        <p>Each page is provided with at least two display options, feel free to experiment.</p>
    </div>
    <div class="col-md-4 col-sm-4">
        <h4>Color themes</h4>
        <p>Theme includes 4 color schemes and manual tuning. Change the template to your taste.</p>
    </div>
    <div class="col-md-4 col-sm-4">
        <h4>Custom template home page</h4>
        <p>Each block on the main page has 2 design. You can choose any one you like.</p>
    </div>
</div>
<h2>TEMPLATE</h2>
<div class="row">
    <div class="col-md-4 col-sm-4">
        <h4>Bootstrap 3</h4>
        <p>Template provides all the advantages of this framework.</p>
    </div>
    <div class="col-md-4 col-sm-4">
        <h4>High working speed</h4>
        <p>PdoTools used for high-speed operation. Each implemented snippet uses a caching system MODX.</p>
    </div>
    <div class="col-md-4 col-sm-4">
        <h4>SEO optimized</h4>
        <p>Smart setting url, logic output title and description, and many other small details that affect the SEO.</p>
    </div>
</div>
<h2>ADMINISTRATION</h2>
<div class="row">
    <div class="col-md-4 col-sm-4">
        <h4>Full multilingual support</h4>
        <p>All texts are inserted through the template lexicon. You can easily transfer the pattern to the desired language, without affecting the code.</p>
    </div>
    <div class="col-md-4 col-sm-4">
        <h4>3 languages included</h4>
        <p>We have included 3 languages: English, Ukrainian and Russian.</p>
    </div>
     <div class="col-md-4 col-sm-4">
        <h4>Special user to edit content</h4>
        <p>If you do not edit your own content and your assistant does not need to see all the features of MODX, give him a special only access the content.</p>
    </div>
</div>
<div class="row">
    <div class="col-md-4 col-sm-4">
        <h4>Unisender</h4>
        <p>We have integrated a template subscription for one of the best, convenient and cheap email mailing services - <a href="[[~[[getIdResourceForAlias? &alias=`unisender`]]]]" target="_blank">unisender</a>.</p>
    </div>
</div>
<h2>DEVELOPMENT</h2>
<div class="row">
    <div class="col-md-4 col-sm-4">
        <h4>Developers friendly</h4>
        <p>We are developers and therefore we understand the needs of our colleagues for comfortable operation.</p>
    </div>
    <div class="col-md-4 col-sm-4">
        <h4>SASS included</h4>
        <p>We have included in the package all Less scripts, that you can change, all you want and how you want.</p>
    </div>
    <div class="col-md-4 col-sm-4">
        <h4>Extendable JS</h4>
        <p>All template js implemented using modules. You can easily add, modify, disable modules without worrying that something will break in the other functional.</p>
    </div>
</div>
<div class="row">
    <div class="col-md-4 col-sm-4">
        <h4>Best practices in the development of corporate websites</h4>
        <p>We have development experience of corporate websites, and we decided to collect and transfer the best practices in the template.</p>
    </div>
    <div class="col-md-4 col-sm-4">
        <h4>Deploy the demo content</h4>
        <p>You can deploy the exact same demo site without any effort.</p>
    </div>
</div>
';

$content_manual = '
<p>All template settings can be found in the "System Setting", section "themeclubcube".</p>
<h2>Setting up the main page</h2>
<p>These 5 parameters corresponding for setting up the main page:</p>
<ul>
<li>style_events_promo_slider</li>
<li>style_index_blog_list</li>
<li>style_index_events_list</li>
<li>style_events_time_format</li>
<li>style_index_gallery_list</li>
</ul>
<h4>style_events_promo_slider</h4>
<p>Slider has two states: a large (stretched to full screen) and fixed size. Changing this setting, you can select your desired option.</p>
<h4>style_index_blog_list</h4>
<p>Blog entries are 2 types of design: tiles without images and large previews (full width of the tile).</p>
<h4>style_index_events_list</h4>
<p>Events can be designed in 2 different styles: tiles with a picture in the background and in the form of tickets.</p>
<h4>style_events_time_format</h4>
<p>This setting affects the style of the time for the event, it can be in the format of am/pm or 24 hours.</p>
<h4>style_index_gallery_list</h4>
<p>Setting the gallery output. The gallery can be displayed as a list of small tiles on a colored background, or as a slider with large thumbs.</p>
<h2>Google Analytics settings</h2>
<p>To activate the google analytics need to register your Tracking ID to set up "ga_tracking_id".</p>
<h2>Color sheme setting</h2>
<p>Setting "color_scheme". Options: yellow, turbo, max-hurricane, mint</p>
<h2>Unisender settings</h2>
<p>You need to do 3 simple steps:</p>
<ul>
<li>Register on <a href="[[~[[getIdResourceForAlias? &alias=`unisender`]]]]" target="_blank">unisender</a></li>
<li>Get Api key</li>
<li>Create a mailing list and get his number</li>
</ul>
<h4>Register</h4>
<p>Registration is very simple, with it you can handle without problems.</p>
<h4>Api key</h4>
<p>Please login to unisender and go to the information about the user. There you will find Api key.</p>
<img src="assets/uploads/manual/unisender-api-key.png" alt="unisender api key">
<p>Add it to the tune "unisender_api_key"</p>
<h4>Mailing list</h4>
<p>It is necessary to create a mailing list and get the number.</p>
<img src="assets/uploads/manual/unisender-create-list.png" alt="unisender api key">
<p>Number of mailing list can be found in the url</p>
<img src="assets/uploads/manual/unisender-list-id.png" alt="unisender list id">
<p>Put the resulting number in the setting "unisender_list_ids"</p>
<h2>User to edit content</h2>
<p>manager: testmanager</p>
<hr>
<p>All settings are well described.</p>
<img src="assets/uploads/manual/settings.png" alt="theme settings">
';

$lineUp = array(
    array(
        "MIGX_id" => 1,
        'name' => 'DJ Supbass',
        'location' => "Detroit"
    ),
    array(
        "MIGX_id" => 2,
        'name' => 'Alexander Grooves',
        'location' => "Moscow"
    ),
    array(
        "MIGX_id" => 3,
        'name' => 'Itchy:Pitchy',
        'location' => "Saint Petersburg"
    ),
    array(
        "MIGX_id" => 4,
        'name' => 'Depeche Code',
        'location' => "Bratislava"
    ),
    array(
        "MIGX_id" => 5,
        'name' => 'Caesar Loves Bay',
        'location' => "London"
    ),
    array(
        "MIGX_id" => 6,
        'name' => 'Oscar from San Diego',
        'location' => "Auckland"
    ),
    array(
        "MIGX_id" => 7,
        'name' => 'DJ Biz',
        'location' => "NY"
    ),
    array(
        "MIGX_id" => 8,
        'name' => 'DJ Bonus Score',
        'location' => "Transylvania"
    )
);

$gallery = array(
    array(
        "MIGX_id" => 1,
        'title' => 1,
        'image' => "gallery/Gallery_01_Original.jpg"
    ),
    array(
        "MIGX_id" => 2,
        'title' => 2,
        'image' => "gallery/Gallery_02_Original.jpg"
    ),
    array(
        "MIGX_id" => 3,
        'title' => 3,
        'image' => "gallery/Gallery_03_Original.jpg"
    ),
    array(
        "MIGX_id" => 4,
        'title' => 4,
        'image' => "gallery/Gallery_04_Original.jpg"
    ),
    array(
        "MIGX_id" => 5,
        'title' => 5,
        'image' => "gallery/Gallery_05_Original.jpg"
    ),
    array(
        "MIGX_id" => 6,
        'title' => 6,
        'image' => "gallery/Gallery_06_Original.jpg"
    ),
    array(
        "MIGX_id" => 7,
        'title' => 7,
        'image' => "gallery/Gallery_07_Original.jpg"
    ),
    array(
        "MIGX_id" => 8,
        'title' => 8,
        'image' => "gallery/Gallery_08_Original.jpg"
    ),
    array(
        "MIGX_id" => 9,
        'title' => 9,
        'image' => "gallery/Gallery_09_Original.jpg"
    ),
    array(
        "MIGX_id" => 10,
        'title' => 10,
        'image' => "gallery/Gallery_10_Original.jpg"
    ),
    array(
        "MIGX_id" => 11,
        'title' => 11,
        'image' => "gallery/Gallery_11_Original.jpg"
    ),
    array(
        "MIGX_id" => 12,
        'title' => 12,
        'image' => "gallery/Gallery_12_Original.jpg"
    ),
    array(
        "MIGX_id" => 13,
        'title' => 13,
        'image' => "gallery/Gallery_13_Original.jpg"
    ),
    array(
        "MIGX_id" => 14,
        'title' => 14,
        'image' => "gallery/Gallery_14_Original.jpg"
    ),
    array(
        "MIGX_id" => 15,
        'title' => 15,
        'image' => "gallery/Gallery_15_Original.jpg"
    ),
    array(
        "MIGX_id" => 16,
        'title' => 16,
        'image' => "gallery/Gallery_16_Original.jpg"
    ),
    array(
        "MIGX_id" => 17,
        'title' => 17,
        'image' => "gallery/Gallery_17_Original.jpg"
    ),
    array(
        "MIGX_id" => 18,
        'title' => 18,
        'image' => "gallery/Gallery_18_Original.jpg"
    ),
    array(
        "MIGX_id" => 19,
        'title' => 19,
        'image' => "gallery/Gallery_19_Original.jpg"
    ),
    array(
        "MIGX_id" => 20,
        'title' => 20,
        'image' => "gallery/Gallery_20_Original.jpg"
    ),
);

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
                    'blogItemWithoutImage',
                    'blogItemAside',
                    'blogItemAsideWithoutImage',
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
                                    'menuindex' => 0,
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
                                            'pagetitle' => 'Daily Bass Ocean',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => '',
                                            'alias' => 'daily-bass-ocean',
                                            'uri' => 'eventslist/events/daily-bass-ocean',
                                            'link_attributes' => '',
                                            'content' => $content_text,
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
                                                'img' => 'events/EventsTiles_01_Retina.jpg',
                                                'timeStart' => date('Y-m-d H:i:00', time() + (1 * 24 * 60 * 60)),
                                                'price' => '5$',
                                                'lineUp' => $modx->toJson($lineUp)
                                            ),
                                        ),
                                        'event2:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_eventsItem->get('id'),
                                            'pagetitle' => 'Hip-Hop X OH!Trap',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => '',
                                            'alias' => 'hip-hop-x-oh-trap',
                                            'uri' => 'eventslist/events/hip-hop-x-oh-trap',
                                            'link_attributes' => '',
                                            'content' => $content_text,
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
                                                'img' => 'events/EventsTiles_02_Retina.jpg',
                                                'timeStart' => date('Y-m-d H:i:00', time() + (2 * 24 * 60 * 60)),
                                                'price' => '5$',
                                                'lineUp' => $modx->toJson($lineUp)
                                            ),
                                        ),
                                        'event3:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_eventsItem->get('id'),
                                            'pagetitle' => 'Streets Love Invasion',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => '',
                                            'alias' => 'streets-love-invasion',
                                            'uri' => 'eventslist/events/streets-love-invasion',
                                            'link_attributes' => '',
                                            'content' => $content_text,
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
                                                'img' => 'events/EventsTiles_03_Retina.jpg',
                                                'timeStart' => date('Y-m-d H:i:00', time() + (3 * 24 * 60 * 60)),
                                                'price' => '5$',
                                                'lineUp' => $modx->toJson($lineUp)
                                            ),
                                        ),
                                        'event4:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_eventsItem->get('id'),
                                            'pagetitle' => 'Californication Nights',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => '',
                                            'alias' => 'californication-nights',
                                            'uri' => 'eventslist/events/californication-nights',
                                            'link_attributes' => '',
                                            'content' => $content_text,
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
                                                'img' => 'events/EventsTiles_04_Retina.jpg',
                                                'promoImg' => 'slider/Slider_01.jpg',
                                                'timeStart' => date('Y-m-d H:i:00', time() + (4 * 24 * 60 * 60)),
                                                'price' => '5$',
                                                'lineUp' => $modx->toJson($lineUp),
                                                'promoEvent' => 1,
                                                'topEvent' => 1
                                            ),
                                        ),
                                        'event5:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_eventsItem->get('id'),
                                            'pagetitle' => 'Mash Up Your Heads: Christmas Night',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => '',
                                            'alias' => 'mash-up-your-heads-christmas-night',
                                            'uri' => 'eventslist/events/mash-up-your-heads-christmas-night',
                                            'link_attributes' => '',
                                            'content' => $content_text,
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
                                                'img' => 'events/EventsTiles_05_Retina.jpg',
                                                'promoImg' => 'slider/Slider_02.jpg',
                                                'timeStart' => date('Y-m-d H:i:00', time() + (5 * 24 * 60 * 60)),
                                                'price' => '5$',
                                                'lineUp' => $modx->toJson($lineUp),
                                                'promoEvent' => 1,
                                                'topEvent' => 1
                                            ),
                                        ),
                                        'event6:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_eventsItem->get('id'),
                                            'pagetitle' => 'Discover Paparazzi Madness',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => '',
                                            'alias' => 'discover-paparazzi-madness',
                                            'uri' => 'eventslist/events/discover-paparazzi-madness',
                                            'link_attributes' => '',
                                            'content' => $content_text,
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
                                                'img' => 'events/EventsTiles_06_Retina.jpg',
                                                'promoImg' => 'slider/Slider_03.jpg',
                                                'timeStart' => date('Y-m-d H:i:00', time() + (6 * 24 * 60 * 60)),
                                                'price' => '5$',
                                                'lineUp' => $modx->toJson($lineUp),
                                                'promoEvent' => 1,
                                                'topEvent' => 1
                                            ),
                                        ),
                                        'event7:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_eventsItem->get('id'),
                                            'pagetitle' => 'Daily Bass Ocean',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => '',
                                            'alias' => 'daily-bass-ocean-7',
                                            'uri' => 'eventslist/events/daily-bass-ocean-7',
                                            'link_attributes' => '',
                                            'content' => $content_text,
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
                                                'img' => 'events/EventsTiles_07_Retina.jpg',
                                                'promoImg' => 'slider/Slider_04.jpg',
                                                'timeStart' => date('Y-m-d H:i:00', time() + (7 * 24 * 60 * 60)),
                                                'price' => '5$',
                                                'lineUp' => $modx->toJson($lineUp),
                                                'promoEvent' => 1,
                                                'topEvent' => 1
                                            ),
                                        ),
                                        'event8:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_eventsItem->get('id'),
                                            'pagetitle' => 'Hip-Hop X OH!Trap',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => '',
                                            'alias' => 'hip-hop-x-oh-trap-8',
                                            'uri' => 'eventslist/events/hip-hop-x-oh-trap-8',
                                            'link_attributes' => '',
                                            'content' => $content_text,
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
                                                'img' => 'events/EventsTiles_08_Retina.jpg',
                                                'promoImg' => 'slider/Slider_05.jpg',
                                                'timeStart' => date('Y-m-d H:i:00', time() + (8 * 24 * 60 * 60)),
                                                'price' => '5$',
                                                'lineUp' => $modx->toJson($lineUp),
                                                'promoEvent' => 1,
                                                'topEvent' => 1
                                            ),
                                        ),
                                        'event9:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_eventsItem->get('id'),
                                            'pagetitle' => 'Streets Love Invasion',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => '',
                                            'alias' => 'streets-love-invasion-9',
                                            'uri' => 'eventslist/events/streets-love-invasion-9',
                                            'link_attributes' => '',
                                            'content' => $content_text,
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
                                                'img' => 'events/EventsTiles_09_Retina.jpg',
                                                'promoImg' => 'slider/Slider_06.jpg',
                                                'timeStart' => date('Y-m-d H:i:00', time() + (9 * 24 * 60 * 60)),
                                                'price' => '5$',
                                                'lineUp' => $modx->toJson($lineUp),
                                                'promoEvent' => 1,
                                                'topEvent' => 1
                                            ),
                                        ),
                                        'event10:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_eventsItem->get('id'),
                                            'pagetitle' => 'Californication Nights',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => '',
                                            'alias' => 'californication-nights-10',
                                            'uri' => 'eventslist/events/californication-nights-10',
                                            'link_attributes' => '',
                                            'content' => $content_text,
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (10 * 60),
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
                                                'img' => 'events/EventsTiles_10_Retina.jpg',
                                                'timeStart' => date('Y-m-d H:i:00', time() + (10 * 24 * 60 * 60)),
                                                'price' => '5$',
                                                'lineUp' => $modx->toJson($lineUp),
                                                'topEvent' => 1
                                            ),
                                        ),
                                        'event11:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_eventsItem->get('id'),
                                            'pagetitle' => 'Mash Up Your Heads: Christmas Night',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => '',
                                            'alias' => 'mash-up-your-heads-christmas-night-11',
                                            'uri' => 'eventslist/events/mash-up-your-heads-christmas-night-11',
                                            'link_attributes' => '',
                                            'content' => $content_text,
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (11 * 60),
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
                                                'img' => 'events/EventsTiles_11_Retina.jpg',
                                                'timeStart' => date('Y-m-d H:i:00', time() + (11 * 24 * 60 * 60)),
                                                'price' => '5$',
                                                'lineUp' => $modx->toJson($lineUp)
                                            ),
                                        ),
                                        'event12:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_eventsItem->get('id'),
                                            'pagetitle' => 'Discover Paparazzi Madness',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => '',
                                            'alias' => 'discover-paparazzi-madness-12',
                                            'uri' => 'eventslist/events/discover-paparazzi-madness-12',
                                            'link_attributes' => '',
                                            'content' => $content_text,
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (12 * 60),
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
                                                'img' => 'events/EventsTiles_12_Retina.jpg',
                                                'timeStart' => date('Y-m-d H:i:00', time() + (12 * 24 * 60 * 60)),
                                                'price' => '5$',
                                                'lineUp' => $modx->toJson($lineUp)
                                            ),
                                        ),
                                        'event13:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_eventsItem->get('id'),
                                            'pagetitle' => 'Daily Bass Ocean',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => '',
                                            'alias' => 'daily-bass-ocean-13',
                                            'uri' => 'eventslist/events/daily-bass-ocean-13',
                                            'link_attributes' => '',
                                            'content' => $content_text,
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (13 * 60),
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
                                                'img' => 'events/EventsTiles_13_Retina.jpg',
                                                'timeStart' => date('Y-m-d H:i:00', time() + (13 * 24 * 60 * 60)),
                                                'price' => '5$',
                                                'lineUp' => $modx->toJson($lineUp)
                                            ),
                                        ),
                                        'event14:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_eventsItem->get('id'),
                                            'pagetitle' => 'Hip-Hop X OH!Trap',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => '',
                                            'alias' => 'hip-hop-x-oh-trap-14',
                                            'uri' => 'eventslist/events/hip-hop-x-oh-trap-14',
                                            'link_attributes' => '',
                                            'content' => $content_text,
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (14 * 60),
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
                                                'img' => 'events/EventsTiles_14_Retina.jpg',
                                                'timeStart' => date('Y-m-d H:i:00', time() + (14 * 24 * 60 * 60)),
                                                'price' => '5$',
                                                'lineUp' => $modx->toJson($lineUp)
                                            ),
                                        ),
                                        'event15:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_eventsItem->get('id'),
                                            'pagetitle' => 'Streets Love Invasion',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => '',
                                            'alias' => 'streets-love-invasion-15',
                                            'uri' => 'eventslist/events/streets-love-invasion-15',
                                            'link_attributes' => '',
                                            'content' => $content_text,
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (15 * 60),
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
                                                'img' => 'events/EventsTiles_15_Retina.jpg',
                                                'timeStart' => date('Y-m-d H:i:00', time() + (15 * 24 * 60 * 60)),
                                                'price' => '5$',
                                                'lineUp' => $modx->toJson($lineUp)
                                            ),
                                        ),
                                    ),
                                ),
                                'events2:TicketsSection' => array(
                                    'class_key' => 'TicketsSection',
                                    'template' => $tpl_eventsListTickets->get('id'),
                                    'menuindex' => 1,
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
                                            'pagetitle' => 'Daily Bass Ocean',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => '',
                                            'alias' => 'daily-bass-ocean',
                                            'uri' => 'eventslist/events2/daily-bass-ocean',
                                            'link_attributes' => '',
                                            'content' => $content_text,
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
                                                'img' => 'events/EventsTiles_01_Retina.jpg',
                                                'timeStart' => date('Y-m-d H:i:00', time() + (1 * 24 * 60 * 60)),
                                                'price' => '5$',
                                                'lineUp' => $modx->toJson($lineUp)
                                            ),
                                        ),
                                        'event2:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_eventsItem->get('id'),
                                            'pagetitle' => 'Hip-Hop X OH!Trap',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => '',
                                            'alias' => 'hip-hop-x-oh-trap',
                                            'uri' => 'eventslist/events2/hip-hop-x-oh-trap',
                                            'link_attributes' => '',
                                            'content' => $content_text,
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
                                                'img' => 'events/EventsTiles_02_Retina.jpg',
                                                'timeStart' => date('Y-m-d H:i:00', time() + (2 * 24 * 60 * 60)),
                                                'price' => '5$',
                                                'lineUp' => $modx->toJson($lineUp)
                                            ),
                                        ),
                                        'event3:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_eventsItem->get('id'),
                                            'pagetitle' => 'Streets Love Invasion',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => '',
                                            'alias' => 'streets-love-invasion',
                                            'uri' => 'eventslist/events2/streets-love-invasion',
                                            'link_attributes' => '',
                                            'content' => $content_text,
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
                                                'img' => 'events/EventsTiles_03_Retina.jpg',
                                                'timeStart' => date('Y-m-d H:i:00', time() + (3 * 24 * 60 * 60)),
                                                'price' => '5$',
                                                'lineUp' => $modx->toJson($lineUp)
                                            ),
                                        ),
                                        'event4:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_eventsItem->get('id'),
                                            'pagetitle' => 'Californication Nights',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => '',
                                            'alias' => 'californication-nights',
                                            'uri' => 'eventslist/events2/californication-nights',
                                            'link_attributes' => '',
                                            'content' => $content_text,
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
                                                'img' => 'events/EventsTiles_04_Retina.jpg',
                                                'timeStart' => date('Y-m-d H:i:00', time() + (4 * 24 * 60 * 60)),
                                                'price' => '5$',
                                                'lineUp' => $modx->toJson($lineUp)
                                            ),
                                        ),
                                        'event5:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_eventsItem->get('id'),
                                            'pagetitle' => 'Mash Up Your Heads: Christmas Night',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => '',
                                            'alias' => 'mash-up-your-heads-christmas-night',
                                            'uri' => 'eventslist/events2/mash-up-your-heads-christmas-night',
                                            'link_attributes' => '',
                                            'content' => $content_text,
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
                                                'img' => 'events/EventsTiles_05_Retina.jpg',
                                                'timeStart' => date('Y-m-d H:i:00', time() + (5 * 24 * 60 * 60)),
                                                'price' => '5$',
                                                'lineUp' => $modx->toJson($lineUp)
                                            ),
                                        ),
                                        'event6:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_eventsItem->get('id'),
                                            'pagetitle' => 'Discover Paparazzi Madness',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => '',
                                            'alias' => 'discover-paparazzi-madness',
                                            'uri' => 'eventslist/events2/discover-paparazzi-madness',
                                            'link_attributes' => '',
                                            'content' => $content_text,
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
                                                'img' => 'events/EventsTiles_06_Retina.jpg',
                                                'timeStart' => date('Y-m-d H:i:00', time() + (6 * 24 * 60 * 60)),
                                                'price' => '5$',
                                                'lineUp' => $modx->toJson($lineUp)
                                            ),
                                        ),
                                        'event7:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_eventsItem->get('id'),
                                            'pagetitle' => 'Daily Bass Ocean',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => '',
                                            'alias' => 'daily-bass-ocean-7',
                                            'uri' => 'eventslist/events2/daily-bass-ocean-7',
                                            'link_attributes' => '',
                                            'content' => $content_text,
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
                                                'img' => 'events/EventsTiles_07_Retina.jpg',
                                                'timeStart' => date('Y-m-d H:i:00', time() + (7 * 24 * 60 * 60)),
                                                'price' => '5$',
                                                'lineUp' => $modx->toJson($lineUp)
                                            ),
                                        ),
                                        'event8:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_eventsItem->get('id'),
                                            'pagetitle' => 'Hip-Hop X OH!Trap',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => '',
                                            'alias' => 'hip-hop-x-oh-trap-8',
                                            'uri' => 'eventslist/events2/hip-hop-x-oh-trap-8',
                                            'link_attributes' => '',
                                            'content' => $content_text,
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
                                                'img' => 'events/EventsTiles_08_Retina.jpg',
                                                'timeStart' => date('Y-m-d H:i:00', time() + (8 * 24 * 60 * 60)),
                                                'price' => '5$',
                                                'lineUp' => $modx->toJson($lineUp)
                                            ),
                                        ),
                                        'event9:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_eventsItem->get('id'),
                                            'pagetitle' => 'Streets Love Invasion',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => '',
                                            'alias' => 'streets-love-invasion-9',
                                            'uri' => 'eventslist/events2/streets-love-invasion-9',
                                            'link_attributes' => '',
                                            'content' => $content_text,
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
                                                'img' => 'events/EventsTiles_09_Retina.jpg',
                                                'timeStart' => date('Y-m-d H:i:00', time() + (9 * 24 * 60 * 60)),
                                                'price' => '5$',
                                                'lineUp' => $modx->toJson($lineUp)
                                            ),
                                        ),
                                        'event10:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_eventsItem->get('id'),
                                            'pagetitle' => 'Californication Nights',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => '',
                                            'alias' => 'californication-nights-10',
                                            'uri' => 'eventslist/events2/californication-nights-10',
                                            'link_attributes' => '',
                                            'content' => $content_text,
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (10 * 60),
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
                                                'img' => 'events/EventsTiles_10_Retina.jpg',
                                                'timeStart' => date('Y-m-d H:i:00', time() + (10 * 24 * 60 * 60)),
                                                'price' => '5$',
                                                'lineUp' => $modx->toJson($lineUp)
                                            ),
                                        ),
                                        'event11:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_eventsItem->get('id'),
                                            'pagetitle' => 'Mash Up Your Heads: Christmas Night',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => '',
                                            'alias' => 'mash-up-your-heads-christmas-night-11',
                                            'uri' => 'eventslist/events2/mash-up-your-heads-christmas-night-11',
                                            'link_attributes' => '',
                                            'content' => $content_text,
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (11 * 60),
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
                                                'img' => 'events/EventsTiles_11_Retina.jpg',
                                                'timeStart' => date('Y-m-d H:i:00', time() + (11 * 24 * 60 * 60)),
                                                'price' => '5$',
                                                'lineUp' => $modx->toJson($lineUp)
                                            ),
                                        ),
                                        'event12:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_eventsItem->get('id'),
                                            'pagetitle' => 'Discover Paparazzi Madness',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => '',
                                            'alias' => 'discover-paparazzi-madness-12',
                                            'uri' => 'eventslist/events2/discover-paparazzi-madness-12',
                                            'link_attributes' => '',
                                            'content' => $content_text,
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (12 * 60),
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
                                                'img' => 'events/EventsTiles_12_Retina.jpg',
                                                'timeStart' => date('Y-m-d H:i:00', time() + (12 * 24 * 60 * 60)),
                                                'price' => '5$',
                                                'lineUp' => $modx->toJson($lineUp)
                                            ),
                                        ),
                                        'event13:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_eventsItem->get('id'),
                                            'pagetitle' => 'Daily Bass Ocean',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => '',
                                            'alias' => 'daily-bass-ocean-13',
                                            'uri' => 'eventslist/events2/daily-bass-ocean-13',
                                            'link_attributes' => '',
                                            'content' => $content_text,
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (13 * 60),
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
                                                'img' => 'events/EventsTiles_13_Retina.jpg',
                                                'timeStart' => date('Y-m-d H:i:00', time() + (13 * 24 * 60 * 60)),
                                                'price' => '5$',
                                                'lineUp' => $modx->toJson($lineUp)
                                            ),
                                        ),
                                        'event14:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_eventsItem->get('id'),
                                            'pagetitle' => 'Hip-Hop X OH!Trap',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => '',
                                            'alias' => 'hip-hop-x-oh-trap-14',
                                            'uri' => 'eventslist/events2/hip-hop-x-oh-trap-14',
                                            'link_attributes' => '',
                                            'content' => $content_text,
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (14 * 60),
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
                                                'img' => 'events/EventsTiles_14_Retina.jpg',
                                                'timeStart' => date('Y-m-d H:i:00', time() + (14 * 24 * 60 * 60)),
                                                'price' => '5$',
                                                'lineUp' => $modx->toJson($lineUp)
                                            ),
                                        ),
                                        'event15:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_eventsItem->get('id'),
                                            'pagetitle' => 'Streets Love Invasion',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => '',
                                            'alias' => 'streets-love-invasion-15',
                                            'uri' => 'eventslist/events2/streets-love-invasion-15',
                                            'link_attributes' => '',
                                            'content' => $content_text,
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (15 * 60),
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
                                                'img' => 'events/EventsTiles_15_Retina.jpg',
                                                'timeStart' => date('Y-m-d H:i:00', time() + (15 * 24 * 60 * 60)),
                                                'price' => '5$',
                                                'lineUp' => $modx->toJson($lineUp)
                                            ),
                                        ),
                                    ),
                                ),
                                'eventItem' => array(
                                    'template' => $tpl_eventsItem->get('id'),
                                    'menuindex' => 2,
                                    'pagetitle' => 'Open event',
                                    'longtitle' => '',
                                    'description' => '',
                                    'introtext' => '',
                                    'alias' => 'open-event',
                                    'uri' => 'eventslist/open-event',
                                    'link_attributes' => '',
                                    'content' => $content_text,
                                    'isfolder' => false,
                                    'published' => true,
                                    'publishedon' => time() + (11 * 60),
                                    'hidemenu' => false,
                                    'cacheable' => true,
                                    'searchable' => true,
                                    'richtext' => true,
                                    'uri_override' => true,
                                    'context_key' => 'web',
                                    'menutitle' => '',
                                    'syncsite' => 0,
                                    'properties' => array(
                                        'disable_jevix' => true,
                                        'process_tags' => false,
                                    ),
                                    'tvs' => array(
                                        'img' => 'events/EventsTiles_11_Retina.jpg',
                                        'timeStart' => date('Y-m-d H:i:00', time() + (11 * 24 * 60 * 60)),
                                        'price' => '5$',
                                        'lineUp' => $modx->toJson($lineUp)
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
                                    'menuindex' => 0,
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
                                            'pagetitle' => 'Daily Bass Ocean',
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
                                                'img' => 'gallery/Gallery_01_Original.jpg',
                                                'gallery' => $modx->toJson($gallery)
                                            ),
                                        ),
                                        'gallery2:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_galleryItem->get('id'),
                                            'pagetitle' => 'Hip-Hop X OH!Trap',
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
                                                'img' => 'gallery/Gallery_02_Original.jpg',
                                                'gallery' => $modx->toJson($gallery)
                                            ),
                                        ),
                                        'gallery3:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_galleryItem->get('id'),
                                            'pagetitle' => 'Streets Love Invasion',
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
                                                'img' => 'gallery/Gallery_03_Original.jpg',
                                                'gallery' => $modx->toJson($gallery)
                                            ),
                                        ),
                                        'gallery4:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_galleryItem->get('id'),
                                            'pagetitle' => 'Californication Nights',
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
                                                'img' => 'gallery/Gallery_04_Original.jpg',
                                                'gallery' => $modx->toJson($gallery)
                                            ),
                                        ),
                                        'gallery5:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_galleryItem->get('id'),
                                            'pagetitle' => 'Mash Up Your Heads: Christmas Night',
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
                                                'img' => 'gallery/Gallery_05_Original.jpg',
                                                'gallery' => $modx->toJson($gallery)
                                            ),
                                        ),
                                        'gallery6:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_galleryItem->get('id'),
                                            'pagetitle' => 'Discover Paparazzi Madness',
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
                                                'img' => 'gallery/Gallery_06_Original.jpg',
                                                'gallery' => $modx->toJson($gallery)
                                            ),
                                        ),
                                        'gallery7:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_galleryItem->get('id'),
                                            'pagetitle' => 'Daily Bass Ocean',
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
                                                'img' => 'gallery/Gallery_07_Original.jpg',
                                                'gallery' => $modx->toJson($gallery)
                                            ),
                                        ),
                                        'gallery8:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_galleryItem->get('id'),
                                            'pagetitle' => 'Hip-Hop X OH!Trap',
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
                                                'img' => 'gallery/Gallery_08_Original.jpg',
                                                'gallery' => $modx->toJson($gallery)
                                            ),
                                        ),
                                        'gallery9:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_galleryItem->get('id'),
                                            'pagetitle' => 'Streets Love Invasion',
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
                                                'img' => 'gallery/Gallery_09_Original.jpg',
                                                'gallery' => $modx->toJson($gallery)
                                            ),
                                        ),
                                        'gallery10:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_galleryItem->get('id'),
                                            'pagetitle' => 'Californication Nights',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => '',
                                            'alias' => 'gallery10',
                                            'uri' => 'gallerylist/gallery/gallery10',
                                            'link_attributes' => '',
                                            'content' => '',
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (10 * 60),
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
                                                'img' => 'gallery/Gallery_10_Original.jpg',
                                                'gallery' => $modx->toJson($gallery)
                                            ),
                                        ),
                                        'gallery11:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_galleryItem->get('id'),
                                            'pagetitle' => 'Mash Up Your Heads: Christmas Night',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => '',
                                            'alias' => 'gallery11',
                                            'uri' => 'gallerylist/gallery/gallery11',
                                            'link_attributes' => '',
                                            'content' => '',
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (11 * 60),
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
                                                'img' => 'gallery/Gallery_11_Original.jpg',
                                                'gallery' => $modx->toJson($gallery)
                                            ),
                                        ),
                                        'gallery12:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_galleryItem->get('id'),
                                            'pagetitle' => 'Discover Paparazzi Madness',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => '',
                                            'alias' => 'gallery12',
                                            'uri' => 'gallerylist/gallery/gallery12',
                                            'link_attributes' => '',
                                            'content' => '',
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (12 * 60),
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
                                                'img' => 'gallery/Gallery_12_Original.jpg',
                                                'gallery' => $modx->toJson($gallery)
                                            ),
                                        ),
                                        'gallery13:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_galleryItem->get('id'),
                                            'pagetitle' => 'Daily Bass Ocean',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => '',
                                            'alias' => 'gallery13',
                                            'uri' => 'gallerylist/gallery/gallery13',
                                            'link_attributes' => '',
                                            'content' => '',
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (13 * 60),
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
                                                'img' => 'gallery/Gallery_13_Original.jpg',
                                                'gallery' => $modx->toJson($gallery)
                                            ),
                                        ),
                                        'gallery14:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_galleryItem->get('id'),
                                            'pagetitle' => 'Hip-Hop X OH!Trap',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => '',
                                            'alias' => 'gallery14',
                                            'uri' => 'gallerylist/gallery/gallery14',
                                            'link_attributes' => '',
                                            'content' => '',
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (14 * 60),
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
                                                'img' => 'gallery/Gallery_14_Original.jpg',
                                                'gallery' => $modx->toJson($gallery)
                                            ),
                                        ),
                                        'gallery15:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_galleryItem->get('id'),
                                            'pagetitle' => 'Streets Love Invasion',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => '',
                                            'alias' => 'gallery15',
                                            'uri' => 'gallerylist/gallery/gallery15',
                                            'link_attributes' => '',
                                            'content' => '',
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (15 * 60),
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
                                                'img' => 'gallery/Gallery_15_Original.jpg',
                                                'gallery' => $modx->toJson($gallery)
                                            ),
                                        ),
                                        'gallery16:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_galleryItem->get('id'),
                                            'pagetitle' => 'Californication Nights',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => '',
                                            'alias' => 'gallery16',
                                            'uri' => 'gallerylist/gallery/gallery16',
                                            'link_attributes' => '',
                                            'content' => '',
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (16 * 60),
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
                                                'img' => 'gallery/Gallery_16_Original.jpg',
                                                'gallery' => $modx->toJson($gallery)
                                            ),
                                        ),
                                        'gallery17:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_galleryItem->get('id'),
                                            'pagetitle' => 'Mash Up Your Heads: Christmas Night',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => '',
                                            'alias' => 'gallery17',
                                            'uri' => 'gallerylist/gallery/gallery17',
                                            'link_attributes' => '',
                                            'content' => '',
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (17 * 60),
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
                                                'img' => 'gallery/Gallery_17_Original.jpg',
                                                'gallery' => $modx->toJson($gallery)
                                            ),
                                        ),
                                        'gallery18:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_galleryItem->get('id'),
                                            'pagetitle' => 'Discover Paparazzi Madness',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => '',
                                            'alias' => 'gallery18',
                                            'uri' => 'gallerylist/gallery/gallery18',
                                            'link_attributes' => '',
                                            'content' => '',
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (18 * 60),
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
                                                'img' => 'gallery/Gallery_18_Original.jpg',
                                                'gallery' => $modx->toJson($gallery)
                                            ),
                                        ),
                                        'gallery19:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_galleryItem->get('id'),
                                            'pagetitle' => 'Daily Bass Ocean',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => '',
                                            'alias' => 'gallery19',
                                            'uri' => 'gallerylist/gallery/gallery19',
                                            'link_attributes' => '',
                                            'content' => '',
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (19 * 60),
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
                                                'img' => 'gallery/Gallery_19_Original.jpg',
                                                'gallery' => $modx->toJson($gallery)
                                            ),
                                        ),
                                        'gallery20:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_galleryItem->get('id'),
                                            'pagetitle' => 'Hip-Hop X OH!Trap',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => '',
                                            'alias' => 'gallery20',
                                            'uri' => 'gallerylist/gallery/gallery20',
                                            'link_attributes' => '',
                                            'content' => '',
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (20 * 60),
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
                                                'img' => 'gallery/Gallery_20_Original.jpg',
                                                'gallery' => $modx->toJson($gallery)
                                            ),
                                        ),
                                    )
                                ),
                                'gallery2:TicketsSection' => array(
                                    'parentCheck' => true,
                                    'class_key' => 'TicketsSection',
                                    'template' => $tpl_galleryBigList->get('id'),
                                    'menuindex' => 1,
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
                                            'pagetitle' => 'Daily Bass Ocean',
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
                                                'img' => 'gallery/Gallery_01_Original.jpg',
                                                'gallery' => $modx->toJson($gallery)
                                            ),
                                        ),
                                        'gallery2:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_galleryItem->get('id'),
                                            'pagetitle' => 'Hip-Hop X OH!Trap',
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
                                                'img' => 'gallery/Gallery_02_Original.jpg',
                                                'gallery' => $modx->toJson($gallery)
                                            ),
                                        ),
                                        'gallery3:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_galleryItem->get('id'),
                                            'pagetitle' => 'Streets Love Invasion',
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
                                                'img' => 'gallery/Gallery_03_Original.jpg',
                                                'gallery' => $modx->toJson($gallery)
                                            ),
                                        ),
                                        'gallery4:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_galleryItem->get('id'),
                                            'pagetitle' => 'Californication Nights',
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
                                                'img' => 'gallery/Gallery_04_Original.jpg',
                                                'gallery' => $modx->toJson($gallery)
                                            ),
                                        ),
                                        'gallery5:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_galleryItem->get('id'),
                                            'pagetitle' => 'Mash Up Your Heads: Christmas Night',
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
                                                'img' => 'gallery/Gallery_05_Original.jpg',
                                                'gallery' => $modx->toJson($gallery)
                                            ),
                                        ),
                                        'gallery6:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_galleryItem->get('id'),
                                            'pagetitle' => 'Discover Paparazzi Madness',
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
                                                'img' => 'gallery/Gallery_06_Original.jpg',
                                                'gallery' => $modx->toJson($gallery)
                                            ),
                                        ),
                                        'gallery7:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_galleryItem->get('id'),
                                            'pagetitle' => 'Daily Bass Ocean',
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
                                                'img' => 'gallery/Gallery_07_Original.jpg',
                                                'gallery' => $modx->toJson($gallery)
                                            ),
                                        ),
                                        'gallery8:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_galleryItem->get('id'),
                                            'pagetitle' => 'Hip-Hop X OH!Trap',
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
                                                'img' => 'gallery/Gallery_08_Original.jpg',
                                                'gallery' => $modx->toJson($gallery)
                                            ),
                                        ),
                                        'gallery9:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_galleryItem->get('id'),
                                            'pagetitle' => 'Streets Love Invasion',
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
                                                'img' => 'gallery/Gallery_09_Original.jpg',
                                                'gallery' => $modx->toJson($gallery)
                                            ),
                                        ),
                                        'gallery10:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_galleryItem->get('id'),
                                            'pagetitle' => 'Californication Nights',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => '',
                                            'alias' => 'gallery10',
                                            'uri' => 'gallerylist/gallery2/gallery10',
                                            'link_attributes' => '',
                                            'content' => '',
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (10 * 60),
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
                                                'img' => 'gallery/Gallery_10_Original.jpg',
                                                'gallery' => $modx->toJson($gallery)
                                            ),
                                        ),
                                        'gallery11:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_galleryItem->get('id'),
                                            'pagetitle' => 'Mash Up Your Heads: Christmas Night',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => '',
                                            'alias' => 'gallery11',
                                            'uri' => 'gallerylist/gallery2/gallery11',
                                            'link_attributes' => '',
                                            'content' => '',
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (11 * 60),
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
                                                'img' => 'gallery/Gallery_11_Original.jpg',
                                                'gallery' => $modx->toJson($gallery)
                                            ),
                                        ),
                                        'gallery12:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_galleryItem->get('id'),
                                            'pagetitle' => 'Discover Paparazzi Madness',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => '',
                                            'alias' => 'gallery12',
                                            'uri' => 'gallerylist/gallery2/gallery12',
                                            'link_attributes' => '',
                                            'content' => '',
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (12 * 60),
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
                                                'img' => 'gallery/Gallery_12_Original.jpg',
                                                'gallery' => $modx->toJson($gallery)
                                            ),
                                        ),
                                        'gallery13:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_galleryItem->get('id'),
                                            'pagetitle' => 'Daily Bass Ocean',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => '',
                                            'alias' => 'gallery13',
                                            'uri' => 'gallerylist/gallery2/gallery13',
                                            'link_attributes' => '',
                                            'content' => '',
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (13 * 60),
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
                                                'img' => 'gallery/Gallery_13_Original.jpg',
                                                'gallery' => $modx->toJson($gallery)
                                            ),
                                        ),
                                        'gallery14:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_galleryItem->get('id'),
                                            'pagetitle' => 'Hip-Hop X OH!Trap',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => '',
                                            'alias' => 'gallery14',
                                            'uri' => 'gallerylist/gallery2/gallery14',
                                            'link_attributes' => '',
                                            'content' => '',
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (14 * 60),
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
                                                'img' => 'gallery/Gallery_14_Original.jpg',
                                                'gallery' => $modx->toJson($gallery)
                                            ),
                                        ),
                                        'gallery15:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_galleryItem->get('id'),
                                            'pagetitle' => 'Streets Love Invasion',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => '',
                                            'alias' => 'gallery15',
                                            'uri' => 'gallerylist/gallery2/gallery15',
                                            'link_attributes' => '',
                                            'content' => '',
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (15 * 60),
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
                                                'img' => 'gallery/Gallery_15_Original.jpg',
                                                'gallery' => $modx->toJson($gallery)
                                            ),
                                        ),
                                        'gallery16:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_galleryItem->get('id'),
                                            'pagetitle' => 'Californication Nights',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => '',
                                            'alias' => 'gallery16',
                                            'uri' => 'gallerylist/gallery2/gallery16',
                                            'link_attributes' => '',
                                            'content' => '',
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (16 * 60),
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
                                                'img' => 'gallery/Gallery_16_Original.jpg',
                                                'gallery' => $modx->toJson($gallery)
                                            ),
                                        ),
                                        'gallery17:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_galleryItem->get('id'),
                                            'pagetitle' => 'Mash Up Your Heads: Christmas Night',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => '',
                                            'alias' => 'gallery17',
                                            'uri' => 'gallerylist/gallery2/gallery17',
                                            'link_attributes' => '',
                                            'content' => '',
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (17 * 60),
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
                                                'img' => 'gallery/Gallery_17_Original.jpg',
                                                'gallery' => $modx->toJson($gallery)
                                            ),
                                        ),
                                        'gallery18:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_galleryItem->get('id'),
                                            'pagetitle' => 'Discover Paparazzi Madness',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => '',
                                            'alias' => 'gallery18',
                                            'uri' => 'gallerylist/gallery2/gallery18',
                                            'link_attributes' => '',
                                            'content' => '',
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (18 * 60),
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
                                                'img' => 'gallery/Gallery_18_Original.jpg',
                                                'gallery' => $modx->toJson($gallery)
                                            ),
                                        ),
                                        'gallery19:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_galleryItem->get('id'),
                                            'pagetitle' => 'Daily Bass Ocean',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => '',
                                            'alias' => 'gallery19',
                                            'uri' => 'gallerylist/gallery2/gallery19',
                                            'link_attributes' => '',
                                            'content' => '',
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (19 * 60),
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
                                                'img' => 'gallery/Gallery_19_Original.jpg',
                                                'gallery' => $modx->toJson($gallery)
                                            ),
                                        ),
                                        'gallery20:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_galleryItem->get('id'),
                                            'pagetitle' => 'Hip-Hop X OH!Trap',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => '',
                                            'alias' => 'gallery20',
                                            'uri' => 'gallerylist/gallery2/gallery20',
                                            'link_attributes' => '',
                                            'content' => '',
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (20 * 60),
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
                                                'img' => 'gallery/Gallery_20_Original.jpg',
                                                'gallery' => $modx->toJson($gallery)
                                            ),
                                        ),
                                    )
                                ),
                                'galleryItem' => array(
                                    'template' => $tpl_galleryItem->get('id'),
                                    'menuindex' => 2,
                                    'pagetitle' => 'Open Gallery',
                                    'longtitle' => '',
                                    'description' => '',
                                    'introtext' => '',
                                    'alias' => 'gallery-item',
                                    'uri' => 'gallerylist/gallery-item',
                                    'link_attributes' => '',
                                    'content' => '',
                                    'isfolder' => false,
                                    'published' => true,
                                    'publishedon' => time() + (1 * 60),
                                    'hidemenu' => false,
                                    'cacheable' => true,
                                    'searchable' => true,
                                    'richtext' => true,
                                    'uri_override' => true,
                                    'context_key' => 'web',
                                    'menutitle' => '',
                                    'syncsite' => 0,
                                    'properties' => array(
                                        'disable_jevix' => true,
                                        'process_tags' => false,
                                    ),
                                    'tvs' => array(
                                        'img' => 'gallery/Gallery_01_Retina.jpg',
                                        'gallery' => $modx->toJson($gallery)
                                    ),
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
                                    'menuindex' => 0,
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
                                            'pagetitle' => 'A disco ball is a roughly spherical object that reflects light directed at it in many directions.',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => getIntroDemo($content_text),
                                            'alias' => 'a-disco-ball',
                                            'uri' => 'bloglist/blog/a-disco-ball',
                                            'link_attributes' => '',
                                            'content' => $content_text,
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
                                                'img' => 'blog/Blog_01_Retina.jpg',
                                            ),
                                        ),
                                        'article-blog2:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_blogItem->get('id'),
                                            'pagetitle' => 'Sound card mixer is the analog part of a sound card that routes and mixes sound signals.',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => getIntroDemo($content_text),
                                            'alias' => 'sound-card-mixer',
                                            'uri' => 'bloglist/blog/sound-card-mixer',
                                            'link_attributes' => '',
                                            'content' => $content_text,
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
                                            'pagetitle' => 'A turntable is a musical device DJ`s use to play records, aka vinyl.',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => getIntroDemo($content_text),
                                            'alias' => 'a-turntable-is-a-musical',
                                            'uri' => 'bloglist/blog/a-turntable-is-a-musical',
                                            'link_attributes' => '',
                                            'content' => $content_text,
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
                                                'img' => 'blog/Blog_02_Retina.jpg',
                                            ),
                                        ),
                                        'article-blog4:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_blogItem->get('id'),
                                            'pagetitle' => 'A disco ball is a roughly spherical object that reflects light directed at it in many directions.',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => getIntroDemo($content_text),
                                            'alias' => 'a-disco-ball-4',
                                            'uri' => 'bloglist/blog/a-disco-ball-4',
                                            'link_attributes' => '',
                                            'content' => $content_text,
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
                                                'img' => 'blog/Blog_03_Retina.jpg',
                                            ),
                                        ),
                                        'article-blog5:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_blogItem->get('id'),
                                            'pagetitle' => 'A disco ball is a roughly spherical object that reflects light directed at it in many directions.',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => getIntroDemo($content_text),
                                            'alias' => 'a-disco-ball-5',
                                            'uri' => 'bloglist/blog/a-disco-ball-5',
                                            'link_attributes' => '',
                                            'content' => $content_text,
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
                                                'img' => 'blog/Blog_01_Retina.jpg',
                                            ),
                                        ),
                                        'article-blog6:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_blogItem->get('id'),
                                            'pagetitle' => 'Sound card mixer is the analog part of a sound card that routes and mixes sound signals.',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => getIntroDemo($content_text),
                                            'alias' => 'sound-card-mixer-6',
                                            'uri' => 'bloglist/blog/sound-card-mixer-6',
                                            'link_attributes' => '',
                                            'content' => $content_text,
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
                                                'img' => '',
                                            ),
                                        ),
                                        'article-blog7:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_blogItem->get('id'),
                                            'pagetitle' => 'A turntable is a musical device DJ`s use to play records, aka vinyl.',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => getIntroDemo($content_text),
                                            'alias' => 'a-turntable-is-a-musical-7',
                                            'uri' => 'bloglist/blog/a-turntable-is-a-musical-7',
                                            'link_attributes' => '',
                                            'content' => $content_text,
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
                                                'img' => 'blog/Blog_02_Retina.jpg',
                                            ),
                                        ),
                                        'article-blog8:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_blogItem->get('id'),
                                            'pagetitle' => 'A disco ball is a roughly spherical object that reflects light directed at it in many directions.',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => getIntroDemo($content_text),
                                            'alias' => 'a-disco-ball-8',
                                            'uri' => 'bloglist/blog/a-disco-ball-8',
                                            'link_attributes' => '',
                                            'content' => $content_text,
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
                                                'img' => 'blog/Blog_03_Retina.jpg',
                                            ),
                                        ),
                                        'article-blog9:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_blogItem->get('id'),
                                            'pagetitle' => 'A disco ball is a roughly spherical object that reflects light directed at it in many directions.',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => getIntroDemo($content_text),
                                            'alias' => 'a-disco-ball-9',
                                            'uri' => 'bloglist/blog/a-disco-ball-9',
                                            'link_attributes' => '',
                                            'content' => $content_text,
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
                                                'img' => 'blog/Blog_01_Retina.jpg',
                                            ),
                                        ),
                                        'article-blog10:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_blogItem->get('id'),
                                            'pagetitle' => 'Sound card mixer is the analog part of a sound card that routes and mixes sound signals.',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => getIntroDemo($content_text),
                                            'alias' => 'sound-card-mixer-10',
                                            'uri' => 'bloglist/blog/sound-card-mixer-10',
                                            'link_attributes' => '',
                                            'content' => $content_text,
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (10 * 60),
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
                                        'article-blog11:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_blogItem->get('id'),
                                            'pagetitle' => 'A turntable is a musical device DJ`s use to play records, aka vinyl.',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => getIntroDemo($content_text),
                                            'alias' => 'a-turntable-is-a-musical-11',
                                            'uri' => 'bloglist/blog/a-turntable-is-a-musical-11',
                                            'link_attributes' => '',
                                            'content' => $content_text,
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (11 * 60),
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
                                                'img' => 'blog/Blog_02_Retina.jpg',
                                            ),
                                        ),
                                        'article-blog12:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_blogItem->get('id'),
                                            'pagetitle' => 'A disco ball is a roughly spherical object that reflects light directed at it in many directions.',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => getIntroDemo($content_text),
                                            'alias' => 'a-disco-ball-12',
                                            'uri' => 'bloglist/blog/a-disco-ball-12',
                                            'link_attributes' => '',
                                            'content' => $content_text,
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
                                                'img' => 'blog/Blog_03_Retina.jpg',
                                            ),
                                        ),
                                        'article-blog13:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_blogItem->get('id'),
                                            'pagetitle' => 'A disco ball is a roughly spherical object that reflects light directed at it in many directions.',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => getIntroDemo($content_text),
                                            'alias' => 'a-disco-ball-13',
                                            'uri' => 'bloglist/blog/a-disco-ball-13',
                                            'link_attributes' => '',
                                            'content' => $content_text,
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (13 * 60),
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
                                                'img' => 'blog/Blog_01_Retina.jpg',
                                            ),
                                        ),
                                        'article-blog14:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_blogItem->get('id'),
                                            'pagetitle' => 'Sound card mixer is the analog part of a sound card that routes and mixes sound signals.',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => getIntroDemo($content_text),
                                            'alias' => 'sound-card-mixer-14',
                                            'uri' => 'bloglist/blog/sound-card-mixer-14',
                                            'link_attributes' => '',
                                            'content' => $content_text,
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (14 * 60),
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
                                        'article-blog15:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_blogItem->get('id'),
                                            'pagetitle' => 'A turntable is a musical device DJ`s use to play records, aka vinyl.',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => getIntroDemo($content_text),
                                            'alias' => 'a-turntable-is-a-musical-15',
                                            'uri' => 'bloglist/blog/a-turntable-is-a-musical-15',
                                            'link_attributes' => '',
                                            'content' => $content_text,
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (15 * 60),
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
                                                'img' => 'blog/Blog_02_Retina.jpg',
                                            ),
                                        ),
                                        'article-blog16:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_blogItem->get('id'),
                                            'pagetitle' => 'A disco ball is a roughly spherical object that reflects light directed at it in many directions.',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => getIntroDemo($content_text),
                                            'alias' => 'a-disco-ball-16',
                                            'uri' => 'bloglist/blog/a-disco-ball-16',
                                            'link_attributes' => '',
                                            'content' => $content_text,
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (16 * 60),
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
                                                'img' => 'blog/Blog_03_Retina.jpg',
                                            ),
                                        ),
                                        'article-blog17:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_blogItem->get('id'),
                                            'pagetitle' => 'A disco ball is a roughly spherical object that reflects light directed at it in many directions.',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => getIntroDemo($content_text),
                                            'alias' => 'a-disco-ball-17',
                                            'uri' => 'bloglist/blog/a-disco-ball-17',
                                            'link_attributes' => '',
                                            'content' => $content_text,
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (17 * 60),
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
                                                'img' => 'blog/Blog_01_Retina.jpg',
                                            ),
                                        ),
                                        'article-blog18:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_blogItem->get('id'),
                                            'pagetitle' => 'Sound card mixer is the analog part of a sound card that routes and mixes sound signals.',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => getIntroDemo($content_text),
                                            'alias' => 'sound-card-mixer-18',
                                            'uri' => 'bloglist/blog/sound-card-mixer-18',
                                            'link_attributes' => '',
                                            'content' => $content_text,
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (18 * 60),
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
                                        'article-blog19:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_blogItem->get('id'),
                                            'pagetitle' => 'A turntable is a musical device DJ`s use to play records, aka vinyl.',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => getIntroDemo($content_text),
                                            'alias' => 'a-turntable-is-a-musical-19',
                                            'uri' => 'bloglist/blog/a-turntable-is-a-musical-19',
                                            'link_attributes' => '',
                                            'content' => $content_text,
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (19 * 60),
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
                                                'img' => 'blog/Blog_02_Retina.jpg',
                                            ),
                                        ),
                                        'article-blog20:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_blogItem->get('id'),
                                            'pagetitle' => 'A disco ball is a roughly spherical object that reflects light directed at it in many directions.',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => getIntroDemo($content_text),
                                            'alias' => 'a-disco-ball-20',
                                            'uri' => 'bloglist/blog/a-disco-ball-20',
                                            'link_attributes' => '',
                                            'content' => $content_text,
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (20 * 60),
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
                                                'img' => 'blog/Blog_03_Retina.jpg',
                                            ),
                                        ),
                                    )
                                ),
                                'blog2:TicketsSection' => array(
                                    'class_key' => 'TicketsSection',
                                    'template' => $tpl_blogListTile->get('id'),
                                    'menuindex' => 1,
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
                                            'pagetitle' => 'A disco ball is a roughly spherical object that reflects light directed at it in many directions.',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => getIntroDemo($content_text),
                                            'alias' => 'a-disco-ball',
                                            'uri' => 'bloglist/blog2/a-disco-ball',
                                            'link_attributes' => '',
                                            'content' => $content_text,
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
                                                'img' => 'blog/Blog_01_Retina.jpg',
                                            ),
                                        ),
                                        'article-blog2:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_blogItem->get('id'),
                                            'pagetitle' => 'Sound card mixer is the analog part of a sound card that routes and mixes sound signals.',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => getIntroDemo($content_text),
                                            'alias' => 'sound-card-mixer',
                                            'uri' => 'bloglist/blog2/sound-card-mixer',
                                            'link_attributes' => '',
                                            'content' => $content_text,
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
                                            'pagetitle' => 'A turntable is a musical device DJ`s use to play records, aka vinyl.',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => getIntroDemo($content_text),
                                            'alias' => 'a-turntable-is-a-musical',
                                            'uri' => 'bloglist/blog2/a-turntable-is-a-musical',
                                            'link_attributes' => '',
                                            'content' => $content_text,
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
                                                'img' => 'blog/Blog_02_Retina.jpg',
                                            ),
                                        ),
                                        'article-blog4:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_blogItem->get('id'),
                                            'pagetitle' => 'A disco ball is a roughly spherical object that reflects light directed at it in many directions.',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => getIntroDemo($content_text),
                                            'alias' => 'a-disco-ball-4',
                                            'uri' => 'bloglist/blog2/a-disco-ball-4',
                                            'link_attributes' => '',
                                            'content' => $content_text,
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
                                                'img' => 'blog/Blog_03_Retina.jpg',
                                            ),
                                        ),
                                        'article-blog5:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_blogItem->get('id'),
                                            'pagetitle' => 'A disco ball is a roughly spherical object that reflects light directed at it in many directions.',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => getIntroDemo($content_text),
                                            'alias' => 'a-disco-ball-5',
                                            'uri' => 'bloglist/blog2/a-disco-ball-5',
                                            'link_attributes' => '',
                                            'content' => $content_text,
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
                                                'img' => 'blog/Blog_01_Retina.jpg',
                                            ),
                                        ),
                                        'article-blog6:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_blogItem->get('id'),
                                            'pagetitle' => 'Sound card mixer is the analog part of a sound card that routes and mixes sound signals.',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => getIntroDemo($content_text),
                                            'alias' => 'sound-card-mixer-6',
                                            'uri' => 'bloglist/blog2/sound-card-mixer-6',
                                            'link_attributes' => '',
                                            'content' => $content_text,
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
                                                'img' => '',
                                            ),
                                        ),
                                        'article-blog7:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_blogItem->get('id'),
                                            'pagetitle' => 'A turntable is a musical device DJ`s use to play records, aka vinyl.',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => getIntroDemo($content_text),
                                            'alias' => 'a-turntable-is-a-musical-7',
                                            'uri' => 'bloglist/blog2/a-turntable-is-a-musical-7',
                                            'link_attributes' => '',
                                            'content' => $content_text,
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
                                                'img' => 'blog/Blog_02_Retina.jpg',
                                            ),
                                        ),
                                        'article-blog8:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_blogItem->get('id'),
                                            'pagetitle' => 'A disco ball is a roughly spherical object that reflects light directed at it in many directions.',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => getIntroDemo($content_text),
                                            'alias' => 'a-disco-ball-8',
                                            'uri' => 'bloglist/blog2/a-disco-ball-8',
                                            'link_attributes' => '',
                                            'content' => $content_text,
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
                                                'img' => 'blog/Blog_03_Retina.jpg',
                                            ),
                                        ),
                                        'article-blog9:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_blogItem->get('id'),
                                            'pagetitle' => 'A disco ball is a roughly spherical object that reflects light directed at it in many directions.',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => getIntroDemo($content_text),
                                            'alias' => 'a-disco-ball-9',
                                            'uri' => 'bloglist/blog2/a-disco-ball-9',
                                            'link_attributes' => '',
                                            'content' => $content_text,
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
                                                'img' => 'blog/Blog_01_Retina.jpg',
                                            ),
                                        ),
                                        'article-blog10:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_blogItem->get('id'),
                                            'pagetitle' => 'Sound card mixer is the analog part of a sound card that routes and mixes sound signals.',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => getIntroDemo($content_text),
                                            'alias' => 'sound-card-mixer-10',
                                            'uri' => 'bloglist/blog2/sound-card-mixer-10',
                                            'link_attributes' => '',
                                            'content' => $content_text,
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (10 * 60),
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
                                        'article-blog11:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_blogItem->get('id'),
                                            'pagetitle' => 'A turntable is a musical device DJ`s use to play records, aka vinyl.',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => getIntroDemo($content_text),
                                            'alias' => 'a-turntable-is-a-musical-11',
                                            'uri' => 'bloglist/blog2/a-turntable-is-a-musical-11',
                                            'link_attributes' => '',
                                            'content' => $content_text,
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (11 * 60),
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
                                                'img' => 'blog/Blog_02_Retina.jpg',
                                            ),
                                        ),
                                        'article-blog12:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_blogItem->get('id'),
                                            'pagetitle' => 'A disco ball is a roughly spherical object that reflects light directed at it in many directions.',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => getIntroDemo($content_text),
                                            'alias' => 'a-disco-ball-12',
                                            'uri' => 'bloglist/blog2/a-disco-ball-12',
                                            'link_attributes' => '',
                                            'content' => $content_text,
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
                                                'img' => 'blog/Blog_03_Retina.jpg',
                                            ),
                                        ),
                                        'article-blog13:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_blogItem->get('id'),
                                            'pagetitle' => 'A disco ball is a roughly spherical object that reflects light directed at it in many directions.',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => getIntroDemo($content_text),
                                            'alias' => 'a-disco-ball-13',
                                            'uri' => 'bloglist/blog2/a-disco-ball-13',
                                            'link_attributes' => '',
                                            'content' => $content_text,
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (13 * 60),
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
                                                'img' => 'blog/Blog_01_Retina.jpg',
                                            ),
                                        ),
                                        'article-blog14:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_blogItem->get('id'),
                                            'pagetitle' => 'Sound card mixer is the analog part of a sound card that routes and mixes sound signals.',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => getIntroDemo($content_text),
                                            'alias' => 'sound-card-mixer-14',
                                            'uri' => 'bloglist/blog2/sound-card-mixer-14',
                                            'link_attributes' => '',
                                            'content' => $content_text,
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (14 * 60),
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
                                        'article-blog15:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_blogItem->get('id'),
                                            'pagetitle' => 'A turntable is a musical device DJ`s use to play records, aka vinyl.',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => getIntroDemo($content_text),
                                            'alias' => 'a-turntable-is-a-musical-15',
                                            'uri' => 'bloglist/blog2/a-turntable-is-a-musical-15',
                                            'link_attributes' => '',
                                            'content' => $content_text,
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (15 * 60),
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
                                                'img' => 'blog/Blog_02_Retina.jpg',
                                            ),
                                        ),
                                        'article-blog16:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_blogItem->get('id'),
                                            'pagetitle' => 'A disco ball is a roughly spherical object that reflects light directed at it in many directions.',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => getIntroDemo($content_text),
                                            'alias' => 'a-disco-ball-16',
                                            'uri' => 'bloglist/blog2/a-disco-ball-16',
                                            'link_attributes' => '',
                                            'content' => $content_text,
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (16 * 60),
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
                                                'img' => 'blog/Blog_03_Retina.jpg',
                                            ),
                                        ),
                                        'article-blog17:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_blogItem->get('id'),
                                            'pagetitle' => 'A disco ball is a roughly spherical object that reflects light directed at it in many directions.',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => getIntroDemo($content_text),
                                            'alias' => 'a-disco-ball-17',
                                            'uri' => 'bloglist/blog2/a-disco-ball-17',
                                            'link_attributes' => '',
                                            'content' => $content_text,
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (17 * 60),
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
                                                'img' => 'blog/Blog_01_Retina.jpg',
                                            ),
                                        ),
                                        'article-blog18:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_blogItem->get('id'),
                                            'pagetitle' => 'Sound card mixer is the analog part of a sound card that routes and mixes sound signals.',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => getIntroDemo($content_text),
                                            'alias' => 'sound-card-mixer-18',
                                            'uri' => 'bloglist/blog2/sound-card-mixer-18',
                                            'link_attributes' => '',
                                            'content' => $content_text,
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (18 * 60),
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
                                        'article-blog19:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_blogItem->get('id'),
                                            'pagetitle' => 'A turntable is a musical device DJ`s use to play records, aka vinyl.',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => getIntroDemo($content_text),
                                            'alias' => 'a-turntable-is-a-musical-19',
                                            'uri' => 'bloglist/blog2/a-turntable-is-a-musical-19',
                                            'link_attributes' => '',
                                            'content' => $content_text,
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (19 * 60),
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
                                                'img' => 'blog/Blog_02_Retina.jpg',
                                            ),
                                        ),
                                        'article-blog20:Ticket' => array(
                                            'class_key' => 'Ticket',
                                            'template' => $tpl_blogItem->get('id'),
                                            'pagetitle' => 'A disco ball is a roughly spherical object that reflects light directed at it in many directions.',
                                            'longtitle' => '',
                                            'description' => '',
                                            'introtext' => getIntroDemo($content_text),
                                            'alias' => 'a-disco-ball-20',
                                            'uri' => 'bloglist/blog2/a-disco-ball-20',
                                            'link_attributes' => '',
                                            'content' => $content_text,
                                            'isfolder' => false,
                                            'published' => true,
                                            'publishedon' => time() + (20 * 60),
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
                                                'img' => 'blog/Blog_03_Retina.jpg',
                                            ),
                                        ),
                                    )
                                ),
                                'blogItem1' => array(
                                    'template' => $tpl_blogItem->get('id'),
                                    'menuindex' => 2,
                                    'pagetitle' => 'Open Blog (With image)',
                                    'longtitle' => '',
                                    'description' => '',
                                    'introtext' => '',
                                    'alias' => 'blog-item1',
                                    'uri' => 'bloglist/blog-item1',
                                    'link_attributes' => '',
                                    'content' => $content_text,
                                    'isfolder' => false,
                                    'published' => true,
                                    'publishedon' => time() + (1 * 60),
                                    'hidemenu' => false,
                                    'cacheable' => true,
                                    'searchable' => true,
                                    'richtext' => true,
                                    'uri_override' => true,
                                    'context_key' => 'web',
                                    'menutitle' => '',
                                    'syncsite' => 0,
                                    'properties' => array(
                                        'disable_jevix' => true,
                                        'process_tags' => false,
                                    ),
                                    'tvs' => array(
                                        'img' => 'blog/Blog_01_Retina.jpg',
                                    ),
                                ),
                                'blogItem2' => array(
                                    'template' => $tpl_blogItemWithoutImage->get('id'),
                                    'menuindex' => 3,
                                    'pagetitle' => 'Open Blog (No image)',
                                    'longtitle' => '',
                                    'description' => '',
                                    'introtext' => '',
                                    'alias' => 'blog-item2',
                                    'uri' => 'bloglist/blog-item2',
                                    'link_attributes' => '',
                                    'content' => $content_text,
                                    'isfolder' => false,
                                    'published' => true,
                                    'publishedon' => time() + (2 * 60),
                                    'hidemenu' => false,
                                    'cacheable' => true,
                                    'searchable' => true,
                                    'richtext' => true,
                                    'uri_override' => true,
                                    'context_key' => 'web',
                                    'menutitle' => '',
                                    'syncsite' => 0,
                                    'properties' => array(
                                        'disable_jevix' => true,
                                        'process_tags' => false,
                                    ),
                                    'tvs' => array(
                                        'img' => '',
                                    ),
                                ),
                                'blogItem3' => array(
                                    'template' => $tpl_blogItemAside->get('id'),
                                    'menuindex' => 4,
                                    'pagetitle' => 'Open Blog Aside (With image)',
                                    'longtitle' => '',
                                    'description' => '',
                                    'introtext' => '',
                                    'alias' => 'blog-item3',
                                    'uri' => 'bloglist/blog-item3',
                                    'link_attributes' => '',
                                    'content' => $content_text,
                                    'isfolder' => false,
                                    'published' => true,
                                    'publishedon' => time() + (3 * 60),
                                    'hidemenu' => false,
                                    'cacheable' => true,
                                    'searchable' => true,
                                    'richtext' => true,
                                    'uri_override' => true,
                                    'context_key' => 'web',
                                    'menutitle' => '',
                                    'syncsite' => 0,
                                    'properties' => array(
                                        'disable_jevix' => true,
                                        'process_tags' => false,
                                    ),
                                    'tvs' => array(
                                        'img' => 'blog/Blog_02_Retina.jpg',
                                    ),
                                ),
                                'blogItem4' => array(
                                    'class_key' => 'Ticket',
                                    'template' => $tpl_blogItemAsideWithoutImage->get('id'),
                                    'menuindex' => 5,
                                    'pagetitle' => 'Open Blog Aside (No image)',
                                    'longtitle' => '',
                                    'description' => '',
                                    'introtext' => '',
                                    'alias' => 'blog-item4',
                                    'uri' => 'bloglist/blog-item4',
                                    'link_attributes' => '',
                                    'content' => $content_text,
                                    'isfolder' => false,
                                    'published' => true,
                                    'publishedon' => time() + (4 * 60),
                                    'hidemenu' => false,
                                    'cacheable' => true,
                                    'searchable' => true,
                                    'richtext' => true,
                                    'uri_override' => true,
                                    'context_key' => 'web',
                                    'menutitle' => '',
                                    'syncsite' => 0,
                                    'properties' => array(
                                        'disable_jevix' => true,
                                        'process_tags' => false,
                                    ),
                                    'tvs' => array(
                                        'img' => 'blog/Blog_03_Retina.jpg',
                                    ),
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
                                    'menuindex' => 0,
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
                                    'menuindex' => 1,
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
                                    'menuindex' => 2,
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
                                    'menuindex' => 3,
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
                                    'menuindex' => 4,
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
                                    'menuindex' => 5,
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
                                    'pagetitle' => 'Features',
                                    'longtitle' => '',
                                    'description' => '',
                                    'introtext' => '',
                                    'alias' => 'features',
                                    'uri' => 'features',
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