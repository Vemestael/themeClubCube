<?php
$properties =& $scriptProperties;

$properties['data'] = !empty($properties['data']) ? $properties['data'] : date('Y-m-d');
$properties['laterWeeks'] = !empty($properties['laterWeeks']) ? $properties['laterWeeks'] : 3;
$properties['tpl'] = !empty($properties['tpl']) ? $properties['tpl'] : 'weeksEvents';
$properties['tplCurrent'] = !empty($properties['tplCurrent']) ? $properties['tplCurrent'] : 'weeksCurrentEvents';
$properties['startDate'] = !empty($_GET['startDate']) ? $_GET['startDate'] : null;
$properties['endDate'] = !empty($_GET['endDate']) ? $_GET['endDate'] : null;
$properties['id'] = !empty($properties['id']) ? $properties['id'] : $modx->resource->id;

$output = '';
$cacheOptions = array(
    xPDO::OPT_CACHE_KEY => 'themeClubCubeCache',
);

$cacheKey = 'getWeeksEvents/'.md5(serialize($properties));

if($modx->getCacheManager() && is_null($output = $modx->cacheManager->get($cacheKey, $cacheOptions))) {
    $thisDate = new DateTime($properties['data']);
    $currentWeekDay = $thisDate->format('w') - 1;

    $startDate = new DateTime($properties['data']);

    if($currentWeekDay > 0) {
        $startDate->modify('-'.$currentWeekDay.' day');
    }

    $endDate = new DateTime($startDate->format('Y-m-d'));
    $endDate->modify('+6 day');

    if(!is_null($properties['startDate']) && !is_null($properties['endDate'])) {
        $getStartDate = new DateTime($properties['startDate']);
        $getEndDate = new DateTime($properties['endDate']);
    }

    $current = array(
        'weekNum' => null
    );

    $placeholders = array(
        'startDate' => $startDate->getTimestamp(),
        'endDate' => $endDate->getTimestamp(),
        'weekNum' => 1,
        'active' => (!is_null($getStartDate) && !is_null($getEndDate)) && ($startDate->diff($getStartDate)->days == 0 && $endDate->diff($getEndDate)->days == 0) ? 1 : 0
    );

    if($placeholders['active'] == 1) $current = $placeholders;

    $weekOutput = '';

    $weekOutput = $modx->getChunk($properties['tpl'],$placeholders);

    for($i = 1; $i <= $properties['laterWeeks']; $i++){
        $placeholders['startDate'] = $startDate->modify('+7 day')->getTimestamp();
        $placeholders['endDate'] = $endDate->modify('+7 day')->getTimestamp();
        $placeholders['weekNum'] = 1 + $i;
        $placeholders['active'] = (!is_null($getStartDate) && !is_null($getEndDate)) && ($startDate->diff($getStartDate)->days == 0 && $endDate->diff($getEndDate)->days == 0) ? 1 : 0;
        if($placeholders['active'] == 1) $current = $placeholders;
        $weekOutput .= $modx->getChunk($properties['tpl'],$placeholders);
    }
    $current['output'] = $weekOutput;
    $output = $modx->getChunk($properties['tplCurrent'],$current);

    $modx->cacheManager->set($cacheKey, $output, 0, $cacheOptions);
}
return $output;