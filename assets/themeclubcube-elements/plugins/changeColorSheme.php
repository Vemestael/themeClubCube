<?php
/**
 * Плагин для смены цветовой схемы
 */
$eventName = $modx->event->name;

switch($eventName) {
    case 'OnHandleRequest':
        if($modx->context->get('key') != "mgr"){
            if(isset($_GET['color'])) {
                $color = $_GET['color'];
                $colors = array('default', 'gold', 'basketball', 'blueberry');
                if(!in_array($color, $colors)) {
                    continue;
                }
                $setting = $modx->getObject('modSystemSetting', 'themeclubcube.color_scheme');
                $setting->set('value', $color);
                $setting->save();

                if (!$modx->getService('molt','Molt',$modx->getOption('molt_core_path',null,$modx->getOption('core_path').'components/molt/').'model/molt/',$scriptProperties)) {continue;}
                if (!$Molt = new Molt($modx, array('cacheFolder' => $modx->getOption('themeclubcube.design_url').'min/'))) {
                    continue;
                }

                $Molt->clearCache();

                $modx->cacheManager->refresh();
            }
        }
        break;
    case 'OnLoadWebDocument':
        if(isset($_GET['color'])) {
            $url = $modx->makeUrl($modx->resource->get('id'));
            $modx->sendRedirect($url);
        }
        break;
}