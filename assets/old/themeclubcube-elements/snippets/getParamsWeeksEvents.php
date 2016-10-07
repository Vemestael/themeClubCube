<?php
$properties =& $scriptProperties;

$properties['startDate'] = !empty($_GET['startDate']) ? $_GET['startDate'] : null;
$properties['endDate'] = !empty($_GET['endDate']) ? $_GET['endDate'] : null;

$output = array();
$cacheOptions = array(
    xPDO::OPT_CACHE_KEY => 'themeClubCubeCache',
);

$cacheKey = 'getParamsWeeksEvents/'.md5(serialize($properties));

if($modx->getCacheManager() && is_null($output = $modx->cacheManager->get($cacheKey, $cacheOptions))) {
    $placeholders = array(
        'week' => null
    );
    if(!is_null($properties['startDate']) && !is_null($properties['endDate'])) {
        $getStartDate = new DateTime($properties['startDate']);
        $getEndDate = new DateTime($properties['endDate']);

        $placeholders = array(
            'startDate' => $getStartDate->getTimestamp(),
            'endDate' => $getEndDate->getTimestamp(),
            'week' => 1,
            'params' => "timeStart>={$getStartDate->format('Y-m-d 00:00:00')},timeStart<={$getEndDate->format('Y-m-d 00:00:00')}"
        );
    }

    $output = $placeholders;
    $modx->cacheManager->set($cacheKey, $output, 0, $cacheOptions);
}
$modx->setPlaceholders($output);

return ;