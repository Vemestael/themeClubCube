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
		'videoItemIndex' => array(
			'file' => 'partsIndex/videoItemIndex',
			'description' => '',
		),
		'videoListIndex' => array(
			'file' => 'partsIndex/videoListIndex',
			'description' => '',
		),
		'blogListIndex' => array(
			'file' => 'partsIndex/blogListIndex',
			'description' => '',
		),
		'pastEventsListIndex' => array(
			'file' => 'partsIndex/pastEventsListIndex',
			'description' => '',
		),
		'partnersItemIndex' => array(
			'file' => 'partsIndex/partnersItemIndex',
			'description' => '',
		),
		'partnersListIndex' => array(
			'file' => 'partsIndex/partnersListIndex',
			'description' => '',
		),
		'musicItemIndex' => array(
			'file' => 'partsIndex/musicItemIndex',
			'description' => '',
		),
		'musicListIndex' => array(
			'file' => 'partsIndex/musicListIndex',
			'description' => '',
		),
		'bigBlogListIndex' => array(
			'file' => 'partsIndex/bigBlogListIndex',
			'description' => '',  
		),
		'videoItemIndexEvents' => array(
			'file' => 'partsIndex/videoItemIndexEvents',
			'description' => '',
		),
		'videoListIndexEvents' => array(
			'file' => 'partsIndex/videoListIndexEvents',
			'description' => '',
		),
		'pastEventsListIndexGallery' => array(
			'file' => 'partsIndex/pastEventsListIndexGallery',
			'description' => '',
		),
		'socialItemIndexPosters' => array(
			'file' => 'partsIndex/socialItemIndexPosters',
			'description' => '',
		),
//    'eventsListFixedPromoIndex' => array(
//        'file' => 'partsIndex/eventsListFixedPromoIndex',
//        'description' => '',
//    ),
//    'eventsItemFixedPromoIndex' => array(
//        'file' => 'partsIndex/eventsItemFixedPromoIndex',
//        'description' => '',
//    ),
//    'eventsListIndex' => array(
//        'file' => 'partsIndex/eventsListIndex',
//        'description' => '',
//    ),
//    'eventsListTileIndex' => array(
//        'file' => 'partsIndex/eventsListTileIndex',
//        'description' => '',
//    ),
//    'eventsItemIndex' => array(
//        'file' => 'partsIndex/eventsItemIndex',
//        'description' => '',
//    ),
//    'eventsItemLastIndex' => array(
//        'file' => 'partsIndex/eventsItemLastIndex',
//        'description' => '',
//    ),
//    'eventsItemTileIndex' => array(
//        'file' => 'partsIndex/eventsItemTileIndex',
//        'description' => '',
//    ),
//    'galleryListIndex' => array(
//        'file' => 'partsIndex/galleryListIndex',
//        'description' => '',
//    ),
//    'galleryListSliderIndex' => array(
//        'file' => 'partsIndex/galleryListSliderIndex',
//        'description' => '',
//    ),
//    'galleryItemIndex' => array(
//        'file' => 'partsIndex/galleryItemIndex',
//        'description' => '',
//    ),
//    'galleryItemBigIndex' => array(
//        'file' => 'partsIndex/galleryItemBigIndex',
//        'description' => '',
//    ),
//    'blogListIndex' => array(
//        'file' => 'partsIndex/blogListIndex',
//        'description' => '',
//    ),
//    'blogItemIndex' => array(
//        'file' => 'partsIndex/blogItemIndex',
//        'description' => '',
//    ),
//    'blogItemTileIndex' => array(
//        'file' => 'partsIndex/blogItemTileIndex',
//        'description' => '',
//    ),
//    'partnersListIndex' => array(
//        'file' => 'partsIndex/partnersListIndex',
//        'description' => '',
//    ),
//    'partnersItemIndex' => array(
//        'file' => 'partsIndex/partnersItemIndex',
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