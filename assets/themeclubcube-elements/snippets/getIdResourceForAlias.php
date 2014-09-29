<?php
$properties =& $scriptProperties;

$properties['alias'] = !empty($properties['alias']) ? $properties['alias'] : null;

$output = '';

$cacheOptions = array(
    xPDO::OPT_CACHE_KEY => 'themeClubCubeCache',
);

$cacheKey = 'getIdResourceForAlias/'.md5(serialize($properties));
if($modx->getCacheManager() && is_null($output = $modx->cacheManager->get($cacheKey, $cacheOptions))) {
    if(!is_null($properties['alias'])){
        if($res = $modx->getObject('modResource',
                array(
                    'context_key' => 'web',
                    'alias'     =>  $properties['alias'],
                ))){
            $output = $res->get('id');
        }

    }
    $modx->cacheManager->set($cacheKey, $output, 0, $cacheOptions);
}
return $output;