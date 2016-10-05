<?php

$chunks = array();

$tmp = array(
    // Index
    '404' => array(
        'file' => 'partsElements/404',
        'description' => '',
    ),
    'buttons' => array(
        'file' => 'partsElements/buttons',
        'description' => '',
    ),
    'footer1' => array(
        'file' => 'partsElements/footer1',
        'description' => '',
    ),
    'footer2' => array(
        'file' => 'partsElements/footer2',
        'description' => '',
    ),
    'footer3' => array(
        'file' => 'partsElements/footer3',
        'description' => '',
    ),
    'footer4' => array(
        'file' => 'partsElements/footer4',
        'description' => '',
    ),
    'grid' => array(
        'file' => 'partsElements/grid',
        'description' => '',
    ),
    'tabsAccordion' => array(
        'file' => 'partsElements/tabsAccordion',
        'description' => '',
    ),
    'typography' => array(
        'file' => 'partsElements/typography',
        'description' => '',
    ),
    'videoAudio' => array(
        'file' => 'partsElements/videoAudio',
        'description' => '',
    ),
    'features' => array(
        'file' => 'partsElements/features',
        'description' => '',
    ),
//    'weeksEvents' => array(
//        'file' => 'partsEvents/weeksEvents',
//        'description' => '',
//    ),
//    'weeksCurrentEvents' => array(
//        'file' => 'partsEvents/weeksCurrentEvents',
//        'description' => '',
//    ),
//    'eventsItemTileEvents' => array(
//        'file' => 'partsEvents/eventsItemTileEvents',
//        'description' => '',
//    ),
//    'eventsItemEvents' => array(
//        'file' => 'partsEvents/eventsItemEvents',
//        'description' => '',
//    ),
//    'lineUpItemEvents' => array(
//        'file' => 'partsEvents/lineUpItemEvents',
//        'description' => '',
//    ),
//    'lineUpInTicketsItemEvents' => array(
//        'file' => 'partsEvents/lineUpInTicketsItemEvents',
//        'description' => '',
//    ),
//    'eventsListWrapperEvents' => array(
//        'file' => 'partsEvents/eventsListWrapperEvents',
//        'description' => '',
//    ),
);

// Save chunks for setup options
$BUILD_CHUNKS = array();

$chunkCategoryNameOld = '';
$i = 0;
foreach ($tmp as $k => $v) {

	/* @avr modChunk $chunk */
	$chunk = $modx->newObject('modChunk');
	$chunk->fromArray(array(
		'id' => 0,
		'name' => $k,
		'description' => @$v['description'],
		'snippet' => file_get_contents($sources['elements_core'].'/chunks/'.$v['file'].'.tpl'),
		'static' => BUILD_CHUNK_STATIC,
		'source' => 1,
		'static_file' => 'assets/'.PKG_NAME_LOWER.'-elements/chunks/'.$v['file'].'.tpl',
	),'',true,true);

	$chunks[] = $chunk;

	$BUILD_CHUNKS[$k] = file_get_contents($sources['elements_core'].'/chunks/'.$v['file'].'.tpl');
}

unset($tmp);
return $chunks;