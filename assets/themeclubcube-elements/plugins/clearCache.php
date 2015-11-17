<?php

$eventName = $modx->event->name;
switch($eventName) {
    case 'OnBeforeCacheUpdate':
        $options = array('objects' => null, 'extensions' => array('.php', '.log'));
        $modx->cacheManager->clearCache(array('themeClubCubeCache/'),$options);

        break;
}