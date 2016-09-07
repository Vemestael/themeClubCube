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
            /*
             * search templates
             */
            $templateNames = array(
                '404',
                'index',
                'events',
                'video',
                'blog',
                'gallery',
                'partners',
                //elements
                'elements404',
                'elementsButtons',
                'elementsFooter1',
                'elementsFooter2',
                'elementsFooter3',
                'elementsFooter4',
                'elementsGrid',
                'elementsTabsAccordion',
                'elementsTypography',
                'elementsVideoAudio',
//                'eventsList',
//                'eventsListTickets',
//                'eventsItem',
//                'galleryList',
//                'galleryItem',
//                'blogList',
//                'blogListTile',
//                'blogItem',
//                'partners',
//                'text',
//                'contacts',

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
                        'parentCheck' => true,
                        'template' => $tpl_index->get('id'),
                        'pagetitle' => 'Home',
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
//                        'tvs' => array(
//                            'img' => '404.png'
//                        )
                    ),
                    'events' => array(
                        'parentCheck' => true,
                        'template' => $tpl_events->get('id'),
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
                        'class_key' => 'TicketsSection',
                    ),
                    'video' => array(
                        'parentCheck' => true,
                        'template' => $tpl_video->get('id'),
                        'pagetitle' => 'Video',
                        'longtitle' => '',
                        'description' => '',
                        'introtext' => '',
                        'alias' => 'video',
                        'uri' => 'video',
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
                        'class_key' => 'TicketsSection',
                    ),
                    'blog' => array(
                        'parentCheck' => true,
                        'template' => $tpl_blog->get('id'),
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
                        'class_key' => 'TicketsSection',
                    ),
                    'gallery' => array(
                        'parentCheck' => true,
                        'template' => $tpl_gallery->get('id'),
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
                        'class_key' => 'TicketsSection',
                    ),
                    'partners' => array(
                        'parentCheck' => true,
                        'template' => $tpl_partners->get('id'),
                        'pagetitle' => 'Partners',
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
                        'hidemenu' => false,
                        'cacheable' => true,
                        'searchable' => true,
                        'richtext' => true,
                        'context_key' => 'web',
                        'menutitle' => '',
                    'class_key' => 'TicketsSection',
                  ),
                    //elements
                    'elements404' => array(
                        'template' => $tpl_elements404->get('id'),
                        'pagetitle' => 'elements404',
                        'longtitle' => '',
                        'description' => '',
                        'introtext' => '',
                        'alias' => 'elements404',
                        'uri' => 'elements404',
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
                    'elementsButtons' => array(
                        'template' => $tpl_elementsButtons->get('id'),
                        'pagetitle' => 'elementsButtons',
                        'longtitle' => '',
                        'description' => '',
                        'introtext' => '',
                        'alias' => 'elementsButtons',
                        'uri' => 'elementsButtons',
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
                    'elementsFooter1' => array(
                        'template' => $tpl_elementsFooter1->get('id'),
                        'pagetitle' => 'elementsFooter1',
                        'longtitle' => '',
                        'description' => '',
                        'introtext' => '',
                        'alias' => 'elementsFooter1',
                        'uri' => 'elementsFooter1',
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
                    'elementsFooter2' => array(
                        'template' => $tpl_elementsFooter2->get('id'),
                        'pagetitle' => 'elementsFooter2',
                        'longtitle' => '',
                        'description' => '',
                        'introtext' => '',
                        'alias' => 'elementsFooter2',
                        'uri' => 'elementsFooter2',
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
                    'elementsFooter3' => array(
                        'template' => $tpl_elementsFooter3->get('id'),
                        'pagetitle' => 'elementsFooter3',
                        'longtitle' => '',
                        'description' => '',
                        'introtext' => '',
                        'alias' => 'elementsFooter3',
                        'uri' => 'elementsFooter3',
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
                    'elementsFooter4' => array(
                        'template' => $tpl_elementsFooter4->get('id'),
                        'pagetitle' => 'elementsFooter4',
                        'longtitle' => '',
                        'description' => '',
                        'introtext' => '',
                        'alias' => 'elementsFooter4',
                        'uri' => 'elementsFooter4',
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
                    'elementsGrid' => array(
                        'template' => $tpl_elementsGrid->get('id'),
                        'pagetitle' => 'elementsGrid',
                        'longtitle' => '',
                        'description' => '',
                        'introtext' => '',
                        'alias' => 'elementsGrid',
                        'uri' => 'elementsGrid',
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
                    'elementsTabsAccordion' => array(
                        'template' => $tpl_elementsTabsAccordion->get('id'),
                        'pagetitle' => 'elementsTabsAccordion',
                        'longtitle' => '',
                        'description' => '',
                        'introtext' => '',
                        'alias' => 'elementsTabsAccordion',
                        'uri' => 'elementsTabsAccordion',
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
                    'elementsTypography' => array(
                        'template' => $tpl_elementsTypography->get('id'),
                        'pagetitle' => 'elementsTypography',
                        'longtitle' => '',
                        'description' => '',
                        'introtext' => '',
                        'alias' => 'elementsTypography',
                        'uri' => 'elementsTypography',
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
                    'elementsVideoAudio' => array(
                        'template' => $tpl_elementsVideoAudio->get('id'),
                        'pagetitle' => 'elementsVideoAudio',
                        'longtitle' => '',
                        'description' => '',
                        'introtext' => '',
                        'alias' => 'elementsVideoAudio',
                        'uri' => 'elementsVideoAudio',
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
//                    'sitemap' => array(
//                        'template' => 0,
//                        'pagetitle' => 'sitemap',
//                        'longtitle' => '',
//                        'description' => '',
//                        'introtext' => '',
//                        'alias' => 'sitemap',
//                        'uri' => 'sitemap',
//                        'link_attributes' => '',
//                        'content' => '[[pdoSitemap]]',
//                        'isfolder' => false,
//                        'published' => true,
//                        'publishedon' => time(),
//                        'hidemenu' => true,
//                        'cacheable' => true,
//                        'searchable' => false,
//                        'richtext' => false,
//                        'context_key' => 'web',
//                        'menutitle' => '',
//                        'content_type' => 2, //XML
//                        'group' => 'technical',
//                    ),
//                    'ajax' => array(
//                        'template' => 0,
//                        'pagetitle' => 'ajax',
//                        'longtitle' => '',
//                        'description' => '',
//                        'introtext' => '',
//                        'alias' => 'ajax',
//                        'uri' => 'ajax',
//                        'link_attributes' => '',
//                        'content' => '',
//                        'isfolder' => true,
//                        'published' => false,
//                        'publishedon' => time(),
//                        'hidemenu' => true,
//                        'cacheable' => true,
//                        'searchable' => false,
//                        'richtext' => false,
//                        'context_key' => 'web',
//                        'menutitle' => '',
//                        'group' => 'technical',
//                        'childs' => array(
//                            'formContacts' => array(
//                                'template' => 0,
//                                'pagetitle' => 'formContacts',
//                                'longtitle' => '',
//                                'description' => '',
//                                'introtext' => '',
//                                'alias' => 'formcontacts',
//                                'uri' => 'ajax/formcontacts',
//                                'link_attributes' => '',
//                                'content' => '[[!formContacts]]',
//                                'isfolder' => false,
//                                'published' => true,
//                                'publishedon' => time(),
//                                'hidemenu' => true,
//                                'cacheable' => true,
//                                'searchable' => false,
//                                'richtext' => true,
//                                'uri_override' => true,
//                                'context_key' => 'web',
//                                'menutitle' => '',
//                            ),
//                            'formSubscribe' => array(
//                                'template' => 0,
//                                'pagetitle' => 'formSubscribe',
//                                'longtitle' => '',
//                                'description' => '',
//                                'introtext' => '',
//                                'alias' => 'formsubscribe',
//                                'uri' => 'ajax/formsubscribe',
//                                'link_attributes' => '',
//                                'content' => '[[!formSubscribe]]',
//                                'isfolder' => false,
//                                'published' => true,
//                                'publishedon' => time(),
//                                'hidemenu' => true,
//                                'cacheable' => true,
//                                'searchable' => false,
//                                'richtext' => true,
//                                'uri_override' => true,
//                                'context_key' => 'web',
//                                'menutitle' => '',
//                            ),
//                        )
//                    ),
//                    'events:TicketsSection' => array(
//                        'parentCheck' => true,
//                        'class_key' => 'TicketsSection',
//                        'template' => $tpl_eventsList->get('id'),
//                        'pagetitle' => 'Events',
//                        'longtitle' => '',
//                        'description' => '',
//                        'introtext' => '',
//                        'alias' => 'events',
//                        'uri' => 'events',
//                        'link_attributes' => '',
//                        'content' => '',
//                        'isfolder' => true,
//                        'published' => true,
//                        'publishedon' => time(),
//                        'hidemenu' => false,
//                        'cacheable' => true,
//                        'searchable' => true,
//                        'richtext' => true,
//                        'context_key' => 'web',
//                        'menutitle' => '',
//                        'properties' => array(
//                            'tickets' => array(
//                                'template' => $tpl_eventsItem->get('id'),
//                                'uri' => '%alias',
//                                'disable_jevix' => true
//                            )
//                        ),
//                    ),
//                    'gallery:TicketsSection' => array(
//                        'parentCheck' => true,
//                        'class_key' => 'TicketsSection',
//                        'template' => $tpl_galleryList->get('id'),
//                        'pagetitle' => 'Gallery',
//                        'longtitle' => '',
//                        'description' => '',
//                        'introtext' => '',
//                        'alias' => 'gallery',
//                        'uri' => 'gallery',
//                        'link_attributes' => '',
//                        'content' => '',
//                        'isfolder' => true,
//                        'published' => true,
//                        'publishedon' => time(),
//                        'hidemenu' => false,
//                        'cacheable' => true,
//                        'searchable' => true,
//                        'richtext' => true,
//                        'context_key' => 'web',
//                        'menutitle' => '',
//                        'properties' => array(
//                            'tickets' => array(
//                                'template' => $tpl_galleryItem->get('id'),
//                                'uri' => '%alias',
//                                'disable_jevix' => true
//                            )
//                        ),
//                    ),
//                    'blog:TicketsSection' => array(
//                        'parentCheck' => true,
//                        'class_key' => 'TicketsSection',
//                        'template' => $tpl_blogList->get('id'),
//                        'pagetitle' => 'Blog',
//                        'longtitle' => '',
//                        'description' => '',
//                        'introtext' => '',
//                        'alias' => 'blog',
//                        'uri' => 'blog',
//                        'link_attributes' => '',
//                        'content' => '',
//                        'isfolder' => true,
//                        'published' => true,
//                        'publishedon' => time(),
//                        'hidemenu' => false,
//                        'cacheable' => true,
//                        'searchable' => true,
//                        'richtext' => true,
//                        'context_key' => 'web',
//                        'menutitle' => '',
//                        'properties' => array(
//                            'tickets' => array(
//                                'template' => $tpl_blogItem->get('id'),
//                                'uri' => '%alias',
//                                'disable_jevix' => true
//                            )
//                        ),
//                    ),
//                    'partners' => array(
//                        'template' => $tpl_partners->get('id'),
//                        'pagetitle' => 'Our Partners',
//                        'longtitle' => '',
//                        'description' => '',
//                        'introtext' => '',
//                        'alias' => 'partners',
//                        'uri' => 'partners',
//                        'link_attributes' => '',
//                        'content' => '',
//                        'isfolder' => true,
//                        'published' => true,
//                        'publishedon' => time(),
//                        'hidemenu' => true,
//                        'cacheable' => true,
//                        'searchable' => false,
//                        'richtext' => true,
//                        'context_key' => 'web',
//                        'menutitle' => '',
//                    ),
//                    'text' => array(
//                        'parentCheck' => true,
//                        'template' => $tpl_text->get('id'),
//                        'pagetitle' => 'Text',
//                        'longtitle' => '',
//                        'description' => '',
//                        'introtext' => '',
//                        'alias' => 'text',
//                        'uri' => 'text',
//                        'link_attributes' => '',
//                        'content' => '',
//                        'isfolder' => false,
//                        'published' => true,
//                        'publishedon' => time(),
//                        'hidemenu' => false,
//                        'cacheable' => true,
//                        'searchable' => true,
//                        'richtext' => true,
//                        'context_key' => 'web',
//                        'menutitle' => '',
//                    ),
//                    'contacts' => array(
//                        'template' => $tpl_contacts->get('id'),
//                        'pagetitle' => 'Contacts',
//                        'longtitle' => '',
//                        'description' => '',
//                        'introtext' => '',
//                        'alias' => 'contacts',
//                        'uri' => 'contacts',
//                        'link_attributes' => '',
//                        'content' => '',
//                        'isfolder' => false,
//                        'published' => true,
//                        'publishedon' => time(),
//                        'hidemenu' => false,
//                        'cacheable' => true,
//                        'searchable' => true,
//                        'richtext' => true,
//                        'context_key' => 'web',
//                        'menutitle' => '',
//                    )
                )
            );
            createDocs($modx, 'web', $resources, null);
            $modx->reloadContext('web');
        break;

    }
}
return true;