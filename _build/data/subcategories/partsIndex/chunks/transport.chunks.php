<?php

$chunks = array();

$tmp = array(
    // Index
    'eventsListPromoIndex' => array(
        'file' => 'partsIndex/eventsListPromoIndex',
        'description' => '',
    ),
    'eventsItemPromoIndex' => array(
        'file' => 'partsIndex/eventsItemPromoIndex',
        'description' => '',
    ),
    'eventsListFixedPromoIndex' => array(
        'file' => 'partsIndex/eventsListFixedPromoIndex',
        'description' => '',
    ),
    'eventsItemFixedPromoIndex' => array(
        'file' => 'partsIndex/eventsItemFixedPromoIndex',
        'description' => '',
    ),
    'eventsListIndex' => array(
        'file' => 'partsIndex/eventsListIndex',
        'description' => '',
    ),
    'eventsListTileIndex' => array(
        'file' => 'partsIndex/eventsListTileIndex',
        'description' => '',
    ),
    'eventsItemIndex' => array(
        'file' => 'partsIndex/eventsItemIndex',
        'description' => '',
    ),
    'eventsItemTileIndex' => array(
        'file' => 'partsIndex/eventsItemTileIndex',
        'description' => '',
    ),
    'galleryListIndex' => array(
        'file' => 'partsIndex/galleryListIndex',
        'description' => '',
    ),
    'galleryListSliderIndex' => array(
        'file' => 'partsIndex/galleryListSliderIndex',
        'description' => '',
    ),
    'galleryItemIndex' => array(
        'file' => 'partsIndex/galleryItemIndex',
        'description' => '',
    ),
    'galleryItemBigIndex' => array(
        'file' => 'partsIndex/galleryItemBigIndex',
        'description' => '',
    ),
    'blogListIndex' => array(
        'file' => 'partsIndex/blogListIndex',
        'description' => '',
    ),
    'blogItemIndex' => array(
        'file' => 'partsIndex/blogItemIndex',
        'description' => '',
    ),
    'blogItemTileIndex' => array(
        'file' => 'partsIndex/blogItemTileIndex',
        'description' => '',
    ),
    'partnersListIndex' => array(
        'file' => 'partsIndex/partnersListIndex',
        'description' => '',
    ),
    'partnersItemIndex' => array(
        'file' => 'partsIndex/partnersItemIndex',
        'description' => '',
    ),
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