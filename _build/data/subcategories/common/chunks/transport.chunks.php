<?php

$chunks = array();

$tmp = array(
    /*
     * Common
     */
    'blogOpenCommon' => array(
        'file' => 'common/blogOpenCommon',
        'description' => '',
    ),
    'videoItemCommon' => array(
        'file' => 'common/videoItemCommon',
        'description' => '',
    ),
	'blogItemCommon' => array(
		'file' => 'common/blogItemCommon',
		'description' => '',
	),
	'galleryItemCommon' => array(
		'file' => 'common/galleryItemCommon',
		'description' => '',
	),
	'galleryListCommon' => array(
		'file' => 'common/galleryListCommon',
		'description' => '',
	),
	'pastEventsItemCommon' => array(
		'file' => 'common/pastEventsItemCommon',
		'description' => '',
	),
	'eventsRectangleCommon' => array(
		'file' => 'common/eventsRectangleCommon',
		'description' => '',
	),
	'eventsSquareCommon' => array(
		'file' => 'common/eventsSquareCommon',
		'description' => '',
	),
	'eventsSquareListCommon' => array(
		'file' => 'common/eventsSquareListCommon',
		'description' => '',
	),
	'eventsRectangleListCommon' => array(
		'file' => 'common/eventsRectangleListCommon',
		'description' => '',
	),
	'sidebarEventsListCommon' => array(
		'file' => 'common/sidebarEventsListCommon',
		'description' => '',
	),
	'sidebarEventsItemCommon_1' => array(
		'file' => 'common/sidebarEventsItemCommon_1',
		'description' => '',
	),
	'sidebarEventsItemCommon_2' => array(
		'file' => 'common/sidebarEventsItemCommon_2',
		'description' => '',
	),
//    'pageWrapperCommon' => array(
//        'file' => 'common/pageWrapperCommon',
//        'description' => '',
//    ),
//    'blogItemAsideCommon' => array(
//        'file' => 'common/blogItemAsideCommon',
//        'description' => '',
//    ),
//    'blogListAsideCommon' => array(
//        'file' => 'common/blogListAsideCommon',
//        'description' => '',
//    ),
//    'eventsListAsideCommon' => array(
//        'file' => 'common/eventsListAsideCommon',
//        'description' => '',
//    ),
//    'eventsItemAsideCommon' => array(
//        'file' => 'common/eventsItemAsideCommon',
//        'description' => '',
//    ),
//    'eventsListAsideCenterCommon' => array(
//        'file' => 'common/eventsListAsideCenterCommon',
//        'description' => '',
//    ),
//    'eventsItemAsideCenterCommon' => array(
//        'file' => 'common/eventsItemAsideCenterCommon',
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

//    $partsName = explode('/', $v['file']);
//    $chunkCategoryName = $partsName[0];
//
//    if($chunkCategoryName != $chunkCategoryNameOld) {
//        $chunkCategoryNameOld = $chunkCategoryName;
//        /* create category */
//        /* @var modCategory $category */
//        $chunkCategory[$i] = $modx->newObject('modCategory');
//        $chunkCategory[$i]->set('category',$chunkCategoryName);
//        echo $chunkCategoryName . '<br>';
//
//        $i++;
//    }

	$chunks[] = $chunk;

	$BUILD_CHUNKS[$k] = file_get_contents($sources['elements_core'].'/chunks/'.$v['file'].'.tpl');
}

//$attr[xPDOTransport::RELATED_OBJECT_ATTRIBUTES]['Children'] = array (
//    xPDOTransport::UNIQUE_KEY => 'category',
//    xPDOTransport::PRESERVE_KEYS => false,
//    xPDOTransport::UPDATE_OBJECT => true,
//    xPDOTransport::RELATED_OBJECTS => true,
//);
//$modx->log(xPDO::LOG_LEVEL_INFO,'Created sub category for chunks.');
//$category->addMany($chunkCategory);

unset($tmp);
return $chunks;