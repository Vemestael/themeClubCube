<?php
/**
 * @param $filename
 *
 * @return string
 */
function getSnippetContentForPlugin($filename) {
    $file = trim(file_get_contents($filename));
    preg_match('#\<\?php(.*)#is', $file, $data);

    return rtrim(rtrim(trim($data[1]),'?>'));
}

if ($object && $object->xpdo) {
    switch ($options[xPDOTransport::PACKAGE_ACTION]) {
        case xPDOTransport::ACTION_INSTALL:
        case xPDOTransport::ACTION_UPGRADE:
            $modx =& $object->xpdo;

            $root = dirname(dirname(__FILE__)).'/';
            $plugins = array(
                'lexiconFrontend' => array(
                    'package' => 'lexiconfrontend',
                    'file' => 'lexiconfrontend',
                    'events' => array()
                )
            );

            foreach ($plugins as $k => $v) {
                if(is_file(MODX_CORE_PATH.'components/'.$v['package'].'/elements/plugins/plugin.'.$v['file'].'.php')){
                    $plugin = $modx->getObject('modPlugin',array('name' => $k));
                    $plugin->fromArray(array(
                        'static' => 1,
                        'plugincode' => getSnippetContentForPlugin(MODX_CORE_PATH.'components/'.$v['package'].'/elements/plugins/plugin.'.$v['file'].'.php'),
                    ),'',true,true);

                    $events = array();
                    if (!empty($v['events'])) {
                        foreach ($v['events'] as $k2 => $v2) {
                            /* @var modPluginEvent $event */
                            $event = $modx->newObject('modPluginEvent');
                            $event->fromArray(array_merge(
                                array(
                                    'event' => $k2,
                                    'priority' => 0,
                                    'propertyset' => 0,
                                ), $v2
                            ),'',true,true);
                            $events[] = $event;
                        }
                        unset($v['events']);
                    }

                    if (!empty($events)) {
                        $plugin->addMany($events);
                    }
                    $plugin->save();
                }
            }
            break;
    }
}

return true;