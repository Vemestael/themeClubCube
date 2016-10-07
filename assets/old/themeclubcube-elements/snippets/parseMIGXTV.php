<?php
$migx = $modx->getService('migx', 'Migx', $modx->getOption('migx.core_path', null, $modx->getOption('core_path') . 'components/migx/') . 'model/migx/', $scriptProperties);
if (!($migx instanceof Migx))
    return '';
$migx->working_context = isset($modx->resource) ? $modx->resource->get('context_key') : 'web';

$properties =& $scriptProperties;

$properties['input'] = !empty($properties['input']) ? $modx->fromJSON($properties['input']) : null;
$properties['limit'] = !empty($properties['limit']) ? (int)$properties['limit'] : 0;
$properties['tpl'] = !empty($properties['tpl']) ? $properties['tpl'] : null;

$output = '';

$cacheOptions = array(
    xPDO::OPT_CACHE_KEY => 'themeClubCubeCache',
);

$cacheKey = 'parseMIGXTV/'.md5(serialize($properties));

if($modx->getCacheManager() && is_null($output = $modx->cacheManager->get($cacheKey, $cacheOptions))) {
    if (!$properties['input'] || empty($properties['tpl'])) return '';
    $i = 0;
    foreach ($properties['input'] as $row) {
        $output .= $modx->getChunk($properties['tpl'], $row);
        $i++;

        if($properties['limit'] != 0 && $properties['limit'] == $i) {
            break;
        }
    }
    $modx->cacheManager->set($cacheKey, $output, 0, $cacheOptions);
}

if (!empty($toPlaceholder)) {
    $modx->setPlaceholder($toPlaceholder, $output);
} else {
    return $output;
}