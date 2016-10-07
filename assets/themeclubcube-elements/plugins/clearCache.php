<?php

$eventName = $modx->event->name;
switch($eventName) {
    case 'OnBeforeCacheUpdate':
        $options = array('objects' => null, 'extensions' => array('.php', '.log'));
        $modx->cacheManager->clearCache(array('themeClubCubeCache/'),$options);

//        if (!$modx->getService('molt','Molt',$modx->getOption('molt_core_path',null,$modx->getOption('core_path').'components/molt/').'model/molt/',$scriptProperties)) {continue;}
//        if (!$Molt = new Molt($modx, array('cacheFolder' => $modx->getOption('themeclubcube.design_url').'min/'))) {
//            continue;
//        }

        $Molt->clearCache();
        break;
}