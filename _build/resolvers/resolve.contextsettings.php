<?php
if ($object && $object->xpdo) {
    switch ($options[xPDOTransport::PACKAGE_ACTION]) {
        case xPDOTransport::ACTION_INSTALL:
        case xPDOTransport::ACTION_UPGRADE:
            $modx =& $object->xpdo;

            $settings = array(
                'site_start' => 'index',
                'error_page' => '404',
            );

            $context_key = 'web';

            if(!$ctx = $modx->getObject('modContext',  $context_key)){
                $modx->log(xPDO::LOG_LEVEL_ERROR, "Context with key {$context_key} not exists");
                return false;
            }
            $ctx->prepare(true);

            foreach ($settings as $k => $v) {
                if(!isset($ctx->config[$k])){
                    if($doc = $modx->getObject('modResource', array(
                        'alias'     => $v,
                        'context_key' => 'web',
                    ))){
                        $setting = $modx->newObject('modContextSetting', array(
                            'xtype' => 'numberfield',
                            'value' => $doc->get('id'),
                            'area'  => 'site',
                        ));
                        $setting->set('key', $k);
                        $settings[] = $setting;
                    }
                }
            }

            if($settings){
                $ctx->addMany($settings);
                $ctx->save();
                $modx->log(modX::LOG_LEVEL_INFO,'Update context setting.');
            }
            unset($settings);
        break;
        case xPDOTransport::ACTION_UNINSTALL:
        break;
    }
}

return true;
