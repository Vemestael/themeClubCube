<?php
if ($object && $object->xpdo) {
    switch ($options[xPDOTransport::PACKAGE_ACTION]) {
        case xPDOTransport::ACTION_INSTALL:
        case xPDOTransport::ACTION_UPGRADE:
            $modx =& $object->xpdo;

            $settings = array(
                'container_suffix' => '',
                'friendly_alias_restrict_chars_pattern' => '/[\0\x0B\t\n\r\f\a&=+%#<>"~:`@«»,\?\[\]\{\}\|\^\'\\\\\!\.\)\(]/',
                'friendly_urls' => 1,
                'friendly_urls_strict' => 1,
                'friendly_alias_max_length' => 70,
                'use_alias_path' => 1,
                'automatic_alias' => 1,
                'tickets.section_content_default' => '',
            );

            $options['demo_data'] = 1;
            if($options['demo_data']) {
                $settings['themeclubcube.demo'] = 1;
            }

            foreach ($settings as $k => $v) {
                /* @var modSystemSetting $setting */
                $setting = $modx->getObject('modSystemSetting', array('key' => $k));
                $setting->set('value', $v);

                if ($setting->save() == false) {
                    $modx->log(xPDO::LOG_LEVEL_ERROR,'An unknown error occurred while trying to update the setting ('.$k.').');
                } else {
                    $modx->log(modX::LOG_LEVEL_INFO,'Update setting '.$k.'.');
                }
            }
        break;
        case xPDOTransport::ACTION_UNINSTALL:
        break;
    }
}

return true;
