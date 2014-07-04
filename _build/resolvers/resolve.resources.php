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

if ($object && $object->xpdo) {
    switch ($options[xPDOTransport::PACKAGE_ACTION]) {
        case xPDOTransport::ACTION_INSTALL:
        case xPDOTransport::ACTION_UPGRADE:
            $modx =& $object->xpdo;

            if($options['demo_data'] == 1) {
                /*
                 * search templates
                 */

                $templateNames = array(
                    'index',
                    'list',
                    'listItem',
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
                            'hidemenu' => false,
                            'cacheable' => true,
                            'searchable' => true,
                            'richtext' => true,
                            'context_key' => 'web',
                            'menutitle' => '',
                        )
                        ,'404' => array(
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
                            'hidemenu' => true,
                            'cacheable' => true,
                            'searchable' => false,
                            'richtext' => false,
                            'context_key' => 'web',
                            'menutitle' => '',
                            'group' => 'technical',
                        )
                        ,'sitemap' => array(
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
                            'hidemenu' => true,
                            'cacheable' => true,
                            'searchable' => false,
                            'richtext' => false,
                            'context_key' => 'web',
                            'menutitle' => '',
                            'content_type' => 2, //XML
                            'group' => 'technical',
                        )
                        ,'blog:TicketsSection' => array(
                            'class_key' => 'TicketsSection',
                            'template' => $tpl_list->get('id'),
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
                            'hidemenu' => false,
                            'cacheable' => true,
                            'searchable' => true,
                            'richtext' => true,
                            'context_key' => 'web',
                            'menutitle' => '',
                            'properties' => array(
                                'tickets' => array(
                                    'template' => $tpl_listItem->get('id'),
                                    'uri' => '%alias',
                                    'disable_jevix' => true
                                )
                            ),
                            'childs' => array(
                                'standarts:Ticket' => array(
                                    'class_key' => 'Ticket',
                                    'template' => $tpl_listItem->get('id'),
                                    'pagetitle' => 'Standarts',
                                    'longtitle' => '',
                                    'description' => '',
                                    'introtext' => '',
                                    'alias' => 'standarts',
                                    'link_attributes' => '',
                                    'content' => '',
                                    'isfolder' => false,
                                    'published' => true,
                                    'hidemenu' => true,
                                    'cacheable' => true,
                                    'searchable' => true,
                                    'richtext' => true,
                                    'context_key' => 'web',
                                    'menutitle' => '',
                                    'show_in_tree' => 0,
                                    'syncsite' => 0,
                                    'properties' => array(
                                        'disable_jevix' => 1,
                                        'process_tags' => 0,
                                    ),
                                    'tvs' => array(
                                        'img' => 'samplePreview.jpeg',
                                    ),
                                )
                                ,'test1:Ticket' => array(
                                    'class_key' => 'Ticket',
                                    'template' => $tpl_listItem->get('id'),
                                    'pagetitle' => 'test1',
                                    'longtitle' => '',
                                    'description' => '',
                                    'introtext' => '',
                                    'alias' => 'test1',
                                    'link_attributes' => '',
                                    'content' => '',
                                    'isfolder' => false,
                                    'published' => true,
                                    'hidemenu' => true,
                                    'cacheable' => true,
                                    'searchable' => true,
                                    'richtext' => true,
                                    'context_key' => 'web',
                                    'menutitle' => '',
                                    'show_in_tree' => 0,
                                    'syncsite' => 0,
                                    'properties' => array(
                                        'disable_jevix' => 1,
                                        'process_tags' => 0,
                                    )
                                )
                                ,'test2:Ticket' => array(
                                    'class_key' => 'Ticket',
                                    'template' => $tpl_listItem->get('id'),
                                    'pagetitle' => 'test2',
                                    'longtitle' => '',
                                    'description' => '',
                                    'introtext' => '',
                                    'alias' => 'test2',
                                    'link_attributes' => '',
                                    'content' => '',
                                    'isfolder' => false,
                                    'published' => true,
                                    'hidemenu' => true,
                                    'cacheable' => true,
                                    'searchable' => true,
                                    'richtext' => true,
                                    'context_key' => 'web',
                                    'menutitle' => '',
                                    'show_in_tree' => 0,
                                    'syncsite' => 0,
                                    'properties' => array(
                                        'disable_jevix' => 1,
                                        'process_tags' => 0,
                                    )
                                )
                                ,'test3:Ticket' => array(
                                    'class_key' => 'Ticket',
                                    'template' => $tpl_listItem->get('id'),
                                    'pagetitle' => 'test3',
                                    'longtitle' => '',
                                    'description' => '',
                                    'introtext' => '',
                                    'alias' => 'test3',
                                    'link_attributes' => '',
                                    'content' => '',
                                    'isfolder' => false,
                                    'published' => true,
                                    'hidemenu' => true,
                                    'cacheable' => true,
                                    'searchable' => true,
                                    'richtext' => true,
                                    'context_key' => 'web',
                                    'menutitle' => '',
                                    'show_in_tree' => 0,
                                    'syncsite' => 0,
                                    'properties' => array(
                                        'disable_jevix' => 1,
                                        'process_tags' => 0,
                                    )
                                )
                                ,'test4:Ticket' => array(
                                    'class_key' => 'Ticket',
                                    'template' => $tpl_listItem->get('id'),
                                    'pagetitle' => 'test4',
                                    'longtitle' => '',
                                    'description' => '',
                                    'introtext' => '',
                                    'alias' => 'test4',
                                    'link_attributes' => '',
                                    'content' => '',
                                    'isfolder' => false,
                                    'published' => true,
                                    'hidemenu' => true,
                                    'cacheable' => true,
                                    'searchable' => true,
                                    'richtext' => true,
                                    'context_key' => 'web',
                                    'menutitle' => '',
                                    'show_in_tree' => 0,
                                    'syncsite' => 0,
                                    'properties' => array(
                                        'disable_jevix' => 1,
                                        'process_tags' => 0,
                                    )
                                )
                                ,'test5:Ticket' => array(
                                    'class_key' => 'Ticket',
                                    'template' => $tpl_listItem->get('id'),
                                    'pagetitle' => 'test5',
                                    'longtitle' => '',
                                    'description' => '',
                                    'introtext' => '',
                                    'alias' => 'test5',
                                    'link_attributes' => '',
                                    'content' => '',
                                    'isfolder' => false,
                                    'published' => true,
                                    'hidemenu' => true,
                                    'cacheable' => true,
                                    'searchable' => true,
                                    'richtext' => true,
                                    'context_key' => 'web',
                                    'menutitle' => '',
                                    'show_in_tree' => 0,
                                    'syncsite' => 0,
                                    'properties' => array(
                                        'disable_jevix' => 1,
                                        'process_tags' => 0,
                                    )
                                )
                            )
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