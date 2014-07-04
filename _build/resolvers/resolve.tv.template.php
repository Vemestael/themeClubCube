<?php
if ($object && $object->xpdo) {
    switch ($options[xPDOTransport::PACKAGE_ACTION]) {
        case xPDOTransport::ACTION_INSTALL:
        case xPDOTransport::ACTION_UPGRADE:
            $modx =& $object->xpdo;

            /* list of tvs and templates for each */
            $tvs = array(
                'img' => array(
                    'templates' => array('listItem'),
                    'sources' => array(
                        'web' => 'Uploads'
                    )
                ),
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
        break;
        case xPDOTransport::ACTION_UNINSTALL:
        break;
    }
}

return true;
