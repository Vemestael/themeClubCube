<?php
if ($object && $object->xpdo) {
    switch ($options[xPDOTransport::PACKAGE_ACTION]) {
        case xPDOTransport::ACTION_INSTALL:
        case xPDOTransport::ACTION_UPGRADE:
            $modx =& $object->xpdo;

            /* list of property sets, and elements associated with each */
            $sets = array(
                'indexSlider' => array(
                    array('class' => 'modSnippet','name' => 'pdoResources'),
                ),
                'topEvents' => array(
                    array('class' => 'modSnippet','name' => 'pdoResources'),
                ),
                'topIndexEvents' => array(
                    array('class' => 'modSnippet','name' => 'pdoResources'),
                ),
                'topIndexFEvents' => array(
                    array('class' => 'modSnippet','name' => 'pdoResources'),
                ),
                'indexTopEventsGallery' => array(
                    array('class' => 'modSnippet','name' => 'pdoResources'),
                ),
                'indexVideo' => array(
                    array('class' => 'modSnippet','name' => 'pdoResources'),
                ),
                'indexBlog' => array(
                    array('class' => 'modSnippet','name' => 'pdoResources'),
                ),
                'indexBlogGallery' => array(
                    array('class' => 'modSnippet','name' => 'pdoResources'),
                ),
                'pastEvents' => array(
                    array('class' => 'modSnippet','name' => 'pdoResources'),
                ),
                'pastEventsIndexGallery' => array(
                    array('class' => 'modSnippet','name' => 'pdoResources'),
                ),
                'indexGallery' => array(
                    array('class' => 'modSnippet','name' => 'pdoResources'),
                ),
                'blogList' => array(
                    array('class' => 'modSnippet','name' => 'pdoResources'),
                ),
                'blogEventsDown' => array(
                    array('class' => 'modSnippet','name' => 'pdoResources'),
                ),
                'blogEventsSidebar' => array(
                    array('class' => 'modSnippet','name' => 'pdoResources'),
                ),
                'eventsList' => array(
                    array('class' => 'modSnippet','name' => 'pdoResources'),
                ),
                'eventsOpenSidebar' => array(
                    array('class' => 'modSnippet','name' => 'pdoResources'),
                ),
                'galleryOpenSidebar' => array(
                    array('class' => 'modSnippet','name' => 'pdoResources'),
                ),
//                'mainMenu' => array(
//                    array('class' => 'modSnippet','name' => 'pdoMenu'),
//                ),
//                'indexSlider' => array(
//                    array('class' => 'modSnippet','name' => 'pdoResources'),
//                ),
//                'indexEvents' => array(
//                    array('class' => 'modSnippet','name' => 'pdoResources'),
//                ),
//                'indexGallery' => array(
//                    array('class' => 'modSnippet','name' => 'pdoResources'),
//                ),
//                'indexBlog' => array(
//                    array('class' => 'modSnippet','name' => 'pdoResources'),
//                ),
//                'indexPartners' => array(
//                    array('class' => 'modSnippet','name' => 'pdoResources'),
//                ),
//                'blogList' => array(
//                    array('class' => 'modSnippet','name' => 'pdoPage'),
//                ),
//                'eventsListAll' => array(
//                    array('class' => 'modSnippet','name' => 'pdoPage'),
//                ),
//                'eventsListWeek' => array(
//                    array('class' => 'modSnippet','name' => 'pdoResources'),
//                ),
//                'galleryList' => array(
//                    array('class' => 'modSnippet','name' => 'pdoPage'),
//                ),
//                'asideEvents' => array(
//                    array('class' => 'modSnippet','name' => 'pdoResources'),
//                ),
//                'asideBlog' => array(
//                    array('class' => 'modSnippet','name' => 'pdoResources'),
//                ),
            );

            foreach ($sets as $setName => $elements) {
                if (!is_array($elements) || empty($elements)) continue;

                foreach ($elements as $el) {
                    if (!is_array($el) || empty($el['class']) || empty($el['name'])) continue;

                    $propertySet = $modx->getObject('modPropertySet',array('name' => $setName));
                    $element = $modx->getObject($el['class'],array('name' => $el['name']));

                    if ($propertySet && $element) {
                        $propertySetElement = $modx->getObject('modElementPropertySet',array(
                            'element' => $element->get('id'),
                            'element_class' => $el['class'],
                            'property_set' => $propertySet->get('id'),
                        ));
                        if (!$propertySetElement) {
                            $propertySetElement = $modx->newObject('modElementPropertySet');
                            $propertySetElement->fromArray(array(
                                'element' => $element->get('id'),
                                'element_class' => $el['class'],
                                'property_set' => $propertySet->get('id'),
                            ),'',true,true);
                            if ($propertySetElement->save() == false) {
                                $modx->log(xPDO::LOG_LEVEL_ERROR,'An unknown error occurred while trying to associate the Element to the Property Set.');
                            }
                        }
                    } else {
                        $modx->log(xPDO::LOG_LEVEL_ERROR,'Could not find property set '.$setName.' and element '.$el['name'].'.');
                    }

                    if($propertySet && isset($el['properties']) && !empty($el['properties'])) {
                        $propertySet->setProperties($el['properties'], true);
                        $propertySet->save();
                    }
                }
            }
            break;
    }
}
return true;