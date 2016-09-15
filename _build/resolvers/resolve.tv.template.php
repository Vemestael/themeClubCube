<?php
if ($object && $object->xpdo) {
    switch ($options[xPDOTransport::PACKAGE_ACTION]) {
        case xPDOTransport::ACTION_INSTALL:
        case xPDOTransport::ACTION_UPGRADE:
            $modx =& $object->xpdo;

            /* list of tvs and templates for each */
            $tvs = array(
                'img' => array(
                    'templates' => array('events', 'eventsOpen', 'blog', 'gallery', 'galleryOpen', 'partners', 'blogOpenTitleFull', 'blogOpenTitleSidebar'),
                    'sources' => array(
                        'web' => 'Uploads'
                    )
                ),
                'viewType' => array(
                    'templates' => array('events', 'eventsOpen'),
                ),
                'timeStart' => array(
                    'templates' => array('events', 'eventsOpen'),
                ),
                'imgSquare' => array(
                    'templates' => array('events', 'eventsOpen'),
                    'sources' => array(
                        'web' => 'Uploads'
                    )
                ),
                'videoLink' => array(
                    'templates' => array('video'),
                ),
                'topEvent' => array(
                    'templates' => array('events', 'eventsOpen'),
                ),
                'partnerLink' => array(
                    'templates' => array('partners'),
                ),
                'migxEventArtist' => array(
                    'templates' => array('events', 'eventsOpen'),
                ),
                'contactNumber' => array(
                    'templates' => array('eventsOpen'),
                ),
                'contactEmail' => array(
                    'templates' => array('eventsOpen'),
                ),
                'ticketPrice' => array(
                    'templates' => array('eventsOpen'),
                ),
                'annotationText' => array(
                    'templates' => array('eventsOpen', 'blogOpenNoTitleFull', 'blogOpenTitleFull', 'blogOpenNoTitleSidebar', 'blogOpenTitleSidebar'),
                ),
                'eventHeaderViewType' => array(
                    'templates' => array('eventsOpen'),
                ),
                'audioLink' => array(
                    'templates' => array('indexMusic'),
                ),
                'audioViewType' => array(
                    'templates' => array('indexMusic'),
                ),
                'blogViewType' => array(
                    'templates' => array('blog', 'blogOpenNoTitleFull', 'blogOpenTitleFull', 'blogOpenNoTitleSidebar', 'blogOpenTitleSidebar'),
                ),
                'twitterLogin' => array(
                    'templates' => array('indexPosters'),
                ),
                'facebookLink' => array(
                    'templates' => array('indexPosters'),
                ),
                'imgList' => array(
                    'templates' => array('galleryOpen', 'gallery'),
                ),
                'videoId' => array(
                    'templates' => array('eventsOpen', 'blogOpenNoTitleFull', 'blogOpenTitleFull', 'blogOpenNoTitleSidebar', 'blogOpenTitleSidebar'),
                ),
                'eventId' => array(
                    'templates' => array('galleryOpen'),
                ),
                'annotationBlog' => array(
                    'templates' => array('blogOpenNoTitleFull', 'blogOpenTitleFull', 'blogOpenNoTitleSidebar', 'blogOpenTitleSidebar'),
                ),
                'typeSidebar' => array(
                    'templates' => array('galleryOpen', 'eventsOpen', 'blogOpenNoTitleSidebar', 'blogOpenTitleSidebar'),
                ),
//                'img' => array(
//                    'templates' => array('partners','galleryItem','eventsItem','blogItem','blogItemAside','404','textWithImage','textAsideWithImage','textAsideRightWithImage'),
//                    'sources' => array(
//                        'web' => 'Uploads'
//                    )
//                ),
//                'galleryImg' => array(
//                    'templates' => array(),
//                    'sources' => array(
//                        'web' => 'Uploads'
//                    )
//                ),
//                'gallery' => array(
//                    'templates' => array('galleryItem'),
//                ),
//                'timeStart' => array(
//                    'templates' => array('eventsItem'),
//                ),
//                'price' => array(
//                    'templates' => array('eventsItem'),
//                ),
//                'lineUp' => array(
//                    'templates' => array('eventsItem'),
//                ),
//                'topEvent' => array(
//                    'templates' => array('eventsItem'),
//                ),
//                'promoEvent' => array(
//                    'templates' => array('eventsItem'),
//                ),
//                'promoImg' => array(
//                    'templates' => array('eventsItem'),
//                    'sources' => array(
//                        'web' => 'Uploads'
//                    )
//                ),
            );

            foreach ($tvs as $tvName => $relations) {

                $tv = $modx->getObject('modTemplateVar',array('name' => $tvName));
                if (empty($tv)) {
                    $modx->log(xPDO::LOG_LEVEL_ERROR,'Could not find TV: '.$tvName.' to associate to Templates.');
                    continue;
                }

                $rank = 0;
                foreach ($relations['templates'] as $templateName) {
                    $template = $modx->getObject('modTemplate',array('templatename' => $templateName));

                    if (!empty($template)) {
                        $templateVarTemplate = $modx->getObject('modTemplateVarTemplate',array(
                            'tmplvarid' => $tv->get('id'),
                            'templateid' => $template->get('id'),
                        ));
                        if (!$templateVarTemplate) {
                            $templateVarTemplate = $modx->newObject('modTemplateVarTemplate');
                            $templateVarTemplate->fromArray(array(
                                'tmplvarid' => $tv->get('id'),
                                'templateid' => $template->get('id'),
                                'rank' => $rank,
                            ),'',true,true);

                            if ($templateVarTemplate->save() == false) {
                                $modx->log(xPDO::LOG_LEVEL_ERROR,'An unknown error occurred while trying to associate the TV '.$tvName.' to the Template '.$templateName);
                            }
                        }
                    } else {
                        $modx->log(xPDO::LOG_LEVEL_ERROR,'Could not find Template '.$templateName);
                    }
                    $rank++;
                }

                if(isset($relations['sources'])) {
                    $sourceElements = $modx->getCollection('sources.modMediaSourceElement',array(
                        'object' => $tv->get('id'),
                        'object_class' => 'modTemplateVar',
                    ));
                    /** @var modMediaSourceElement $sourceElement */
                    foreach ($sourceElements as $sourceElement) {
                        $sourceElement->remove();
                    }

                    foreach ($relations['sources'] as $key => $sourceName) {
                        $source = $modx->getObject('sources.modMediaSource', array('name' => $sourceName));
                        if (!$source) continue;

                        /** @var modMediaSourceElement $sourceElement */
                        $sourceElement = $modx->getObject('sources.modMediaSourceElement',array(
                            'object' => $tv->get('id'),
                            'object_class' => $tv->_class,
                            'context_key' => $key,
                        ));
                        if (!$sourceElement) {
                            $sourceElement = $modx->newObject('sources.modMediaSourceElement');
                            $sourceElement->fromArray(array(
                                'object' => $tv->get('id'),
                                'object_class' => $tv->_class,
                                'context_key' => $key,
                            ),'',true,true);
                        }
                        $sourceElement->set('source',$source->get('id'));
                        $sourceElement->save();
                    }
                }
            }
        break;
        case xPDOTransport::ACTION_UNINSTALL:
        break;
    }
}

return true;
