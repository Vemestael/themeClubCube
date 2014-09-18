<?php

/*
* Create documents
*/
function createDocs(&$modx, $context_key, $node, $doc = null){
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
            if(!$doc__ = $modx->getObject($classKey, array(
                'context_key' => $context_key,
                'parent'    =>  $pid,
                'alias'     =>  $params['alias'],
            ))){
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

            createDocs($modx, $context_key, $options, $doc__);
        }
    }
}

/*
 * Content
 */

function getIntro($content){
    $intro = substr(strip_tags($content),0, 200);
    return $intro;
}

$content_article_blog6 = '
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin tincidunt placerat risus, nec pharetra nibh. Donec hendrerit eros non sapien tempor vestibulum. Etiam eu tempus enim. Donec vehicula lectus vitae magna gravida pulvinar. Praesent id dolor tincidunt, malesuada turpis nec, maximus massa. Aenean luctus eget quam sit amet lobortis. Suspendisse et augue varius, blandit quam id, efficitur ipsum. Sed finibus ipsum at velit consectetur iaculis. Etiam volutpat faucibus mauris ut dictum. Duis mattis augue ut ultrices feugiat.</p>
<p>Donec sed elementum sapien. In id ante quis tellus viverra facilisis. Mauris lobortis vestibulum diam. Etiam viverra ac orci molestie dapibus. Aenean pharetra quis nulla ut vestibulum. Nullam dapibus porta magna eu placerat. Maecenas in libero nibh. Suspendisse nec dolor tortor. Nunc convallis felis eu elementum finibus. Vestibulum faucibus nisi massa. Ut cursus velit in lacus tristique accumsan. Quisque pellentesque metus ac sapien lobortis, id efficitur neque maximus. Nullam at nisi vestibulum, pharetra libero vitae, gravida turpis. Integer congue mi viverra, ornare mauris eget, mollis massa. Nam eleifend, mauris vitae posuere auctor, magna felis porttitor magna, quis laoreet dui mauris vitae elit.</p>
<p>Nullam sed nulla in turpis ultricies consectetur non eget quam. Donec aliquet eu urna sed maximus. Curabitur placerat varius aliquam. Nulla ante odio, ullamcorper at dignissim a, imperdiet sit amet lorem. Nulla hendrerit ullamcorper est, at aliquam quam rhoncus vel. Maecenas gravida libero eget dolor rutrum, feugiat blandit nibh malesuada. Curabitur tincidunt imperdiet leo, ut maximus massa scelerisque ac. Vivamus id mauris facilisis, fringilla elit quis, consequat velit. In nulla tellus, porta eu laoreet varius, accumsan id quam. Nullam molestie sodales mollis. Nulla accumsan sapien non posuere eleifend. Maecenas scelerisque in dui vel volutpat. Aliquam id massa non lorem facilisis dignissim in quis urna. Phasellus ac egestas nisi.</p>
<p>Sed at iaculis dolor, vel semper augue. Quisque suscipit nunc volutpat pellentesque sodales. Cras vitae euismod erat. Aenean euismod lorem rhoncus, mollis orci eu, finibus massa. Nunc gravida efficitur orci vitae sollicitudin. Aliquam varius dictum consectetur. In ullamcorper dapibus tincidunt. Nunc neque mi, pharetra eu eros quis, pharetra suscipit metus. Phasellus at ultrices arcu, id fringilla lectus.</p>
<p>Curabitur vel nibh at tortor faucibus facilisis vel nec neque. Nunc ut tempus libero. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aliquam placerat augue velit, ut sodales odio eleifend in. In vehicula lacinia finibus. Nullam condimentum elit et mi dignissim pretium. Praesent auctor, dolor sit amet hendrerit molestie, arcu tortor volutpat tellus, quis sagittis justo felis id odio. Vestibulum dolor ex, accumsan ut efficitur sed, faucibus luctus ex. Ut venenatis euismod fringilla. Donec nec aliquet lacus.</p>
';

if ($object && $object->xpdo) {
    switch ($options[xPDOTransport::PACKAGE_ACTION]) {
        case xPDOTransport::ACTION_INSTALL:
        case xPDOTransport::ACTION_UPGRADE:
            $modx =& $object->xpdo;

            $options['demo_data'] = 1;
            if($options['demo_data'] == 1) {
                /*
                 * search templates
                 */

                $templateNames = array(
                    'index',
                    'eventsList',
                    'eventsListTickets',
                    'eventsItem',
                    'galleryList',
                    'galleryItem',
                    'blogList',
                    'blogListTile',
                    'blogItem',
                    'partners',
                    'text',
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
                        'index' => array(
                            'template' => $tpl_index->get('id'),
                            'pagetitle' => 'index',
                            'longtitle' => '',
                            'description' => '',
                            'introtext' => '',
                            'alias' => 'index',
                            'uri' => 'index',
                            'link_attributes' => '',
                            'content' => '',
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
                        '404' => array(
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
                            )
                        ),
                        'events:TicketsSection' => array(
                            'class_key' => 'TicketsSection',
                            'template' => $tpl_eventsList->get('id'),
                            'pagetitle' => 'Events',
                            'longtitle' => '',
                            'description' => '',
                            'introtext' => '',
                            'alias' => 'events',
                            'uri' => 'events',
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
                                    'uri' => 'events/event1',
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
                                    'uri' => 'events/event2',
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
                                    'uri' => 'events/event3',
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
                                    'uri' => 'events/event4',
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
                                    'uri' => 'events/event5',
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
                                    'uri' => 'events/event6',
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
                                    'uri' => 'events/event7',
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
                            )
                        ),
                        'gallery:TicketsSection' => array(
                            'class_key' => 'TicketsSection',
                            'template' => $tpl_galleryList->get('id'),
                            'pagetitle' => 'Gallery',
                            'longtitle' => '',
                            'description' => '',
                            'introtext' => '',
                            'alias' => 'gallery',
                            'uri' => 'gallery',
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
                                    'uri' => 'gallery/gallery1',
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
                                    'uri' => 'gallery/gallery2',
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
                                    'uri' => 'gallery/gallery3',
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
                                    'uri' => 'gallery/gallery4',
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
                                    'uri' => 'gallery/gallery5',
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
                                    'uri' => 'gallery/gallery6',
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
                                    'uri' => 'gallery/gallery7',
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
                                    'uri' => 'gallery/gallery8',
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
                                    'uri' => 'gallery/gallery9',
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
                        'blog:TicketsSection' => array(
                            'class_key' => 'TicketsSection',
                            'template' => $tpl_blogList->get('id'),
                            'pagetitle' => 'Blog',
                            'longtitle' => '',
                            'description' => '',
                            'introtext' => '',
                            'alias' => 'blog',
                            'uri' => 'blog',
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
                                    'uri' => 'blog/article-blog1',
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
                                    'uri' => 'blog/article-blog2',
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
                                    'uri' => 'blog/article-blog3',
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
                                    'uri' => 'blog/article-blog4',
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
                                    'introtext' => getIntro($content_article_blog6),
                                    'alias' => 'article-blog5',
                                    'uri' => 'blog/article-blog5',
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
                                    'introtext' => getIntro($content_article_blog6),
                                    'alias' => 'article-blog6',
                                    'uri' => 'blog/article-blog6',
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
                        'contacts' => array(
                            'template' => $tpl_contacts->get('id'),
                            'pagetitle' => 'Contacts',
                            'longtitle' => '',
                            'description' => '',
                            'introtext' => '',
                            'alias' => 'contacts',
                            'uri' => 'contacts',
                            'link_attributes' => '',
                            'content' => '',
                            'isfolder' => false,
                            'published' => true,
                            'publishedon' => time(),
                            'hidemenu' => false,
                            'cacheable' => true,
                            'searchable' => true,
                            'richtext' => true,
                            'context_key' => 'web',
                            'menutitle' => '',
                        )
                    )
                );
                createDocs($modx, 'web', $resources, null);
                $modx->reloadContext('web');
                break;
            }

    }
}
return true;