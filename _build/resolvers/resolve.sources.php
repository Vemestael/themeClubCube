<?php
/**
 * Resolve creating media sources
 *
 * @var xPDOObject $object
 * @var array $options
 */

if ($object->xpdo) {
    /* @var modX $modx */
    $modx =& $object->xpdo;

    switch ($options[xPDOTransport::PACKAGE_ACTION]) {
        case xPDOTransport::ACTION_INSTALL:
        case xPDOTransport::ACTION_UPGRADE:
            $tmp = explode('/', MODX_ASSETS_URL);
            $assets = $tmp[count($tmp) - 2];

            $properties = array(
                'name' => 'Uploads',
                'description' => 'Default media source for upload files',
                'class_key' => 'sources.modFileMediaSource',
                'properties' => array(
                    'basePath' => array(
                        'name' => 'basePath','desc' => 'prop_file.basePath_desc','type' => 'textfield','lexicon' => 'core:source',
                        'value' => $assets . '/uploads/',
                    ),
                    'baseUrl' => array(
                        'name' => 'baseUrl','desc' => 'prop_file.baseUrl_desc','type' => 'textfield','lexicon' => 'core:source',
                        'value' => 'assets/uploads/',
                    ),
                    'imageExtensions' => array(
                        'name' => 'imageExtensions','desc' => 'prop_file.imageExtensions_desc','type' => 'textfield','lexicon' => 'core:source',
                        'value' => 'jpg,jpeg,png,gif',
                    ),
                    'allowedFileTypes' => array(
                        'name' => 'allowedFileTypes','desc' => 'prop_file.allowedFileTypes_desc','type' => 'textfield','lexicon' => 'core:source',
                        'value' => '',
                    ),
                    'thumbnailType' => array(
                        'name' => 'thumbnailType','desc' => 'prop_file.thumbnailType_desc','type' => 'list','lexicon' => 'core:source',
                        'options' => array(
                            array('text' => 'Png','value' => 'png'),
                            array('text' => 'Jpg','value' => 'jpg')
                        ),
                        'value' => 'jpg',
                    ),
                    'thumbnailQuality' => array(
                        'name' => 'thumbnailQuality','desc' => 'prop_file.thumbnailQuality','type' => 'textarea','lexicon' => 'core:source',
                        'value' => '90',
                    ),
                )
            ,'is_stream' => 1
            );
            /* @var $source modMediaSource */
            if (!$source = $modx->getObject('sources.modMediaSource', array('name' => $properties['name']))) {
                $source = $modx->newObject('sources.modMediaSource', $properties);
            }
            else {
                $default = $source->get('properties');
                foreach ($properties['properties'] as $k => $v) {
                    if (!array_key_exists($k, $default)) {
                        $default[$k] = $v;
                    }
                }
                $source->set('properties', $default);
            }
            $source->save();

            @mkdir(MODX_ASSETS_PATH . 'uploads/');
            break;

        case xPDOTransport::ACTION_UNINSTALL:
            break;
    }
}
return true;