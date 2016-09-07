<?php

$chunks = array();

$tmp = array(
    /*
     * Content
     */
    '404Content' => array(
        'file' => 'content/404Content',
        'description' => '',
    ),
    'indexContent' => array(
        'file' => 'content/indexContent',
        'description' => '',
    ),
	'indexContentMusic' => array(
		'file' => 'content/indexContentMusic',
		'description' => '',
	),
	'indexContentEvents' => array(
		'file' => 'content/indexContentEvents',
		'description' => '',
	),
	'indexContentFEvents' => array(
		'file' => 'content/indexContentFEvents',
		'description' => '',
	),
	'indexContentGallery' => array(
		'file' => 'content/indexContentGallery',
		'description' => '',
	),
	'indexContentPosters' => array(
		'file' => 'content/indexContentPosters',
		'description' => '',
	),
	'eventsContent' => array(
		'file' => 'content/eventsContent',
		'description' => '',
	),
	'eventsOpenContent' => array(
		'file' => 'content/eventsOpenContent',
		'description' => '',
	),
	'galleryContent' => array(
		'file' => 'content/galleryContent',
		'description' => '',
	),
	'galleryOpenContent' => array(
		'file' => 'content/galleryOpenContent',
		'description' => '',
	),
	'blogContent' => array(
		'file' => 'content/blogContent',
		'description' => '',
	),
	'blogOpenNoTitleFullContent' => array(
		'file' => 'content/blogOpenNoTitleFullContent',
		'description' => '',
	),
	'blogOpenTitleFullContent' => array(
		'file' => 'content/blogOpenTitleFullContent',
		'description' => '',
	),
	'blogOpenTitleSidebarContent' => array(
		'file' => 'content/blogOpenTitleSidebarContent',
		'description' => '',
	),
	'blogOpenNoTitleSidebarContent' => array(
		'file' => 'content/blogOpenNoTitleSidebarContent',
		'description' => '',
	),
//    'galleryListContent' => array(
//        'file' => 'content/galleryListContent',
//        'description' => '',
//    ),
//    'galleryBigListContent' => array(
//        'file' => 'content/galleryBigListContent',
//        'description' => '',
//    ),
//    'galleryItemContent' => array(
//        'file' => 'content/galleryItemContent',
//        'description' => '',
//    ),
//    'blogItemContent' => array(
//        'file' => 'content/blogItemContent',
//        'description' => '',
//    ),
//    'blogItemWithoutImageContent' => array(
//        'file' => 'content/blogItemWithoutImageContent',
//        'description' => '',
//    ),
//    'blogItemAsideContent' => array(
//        'file' => 'content/blogItemAsideContent',
//        'description' => '',
//    ),
//    'blogItemAsideWithoutImageContent' => array(
//        'file' => 'content/blogItemAsideWithoutImageContent',
//        'description' => '',
//    ),
//    'blogListContent' => array(
//        'file' => 'content/blogListContent',
//        'description' => '',
//    ),
//    'blogListTileContent' => array(
//        'file' => 'content/blogListTileContent',
//        'description' => '',
//    ),
//    'eventsListContent' => array(
//        'file' => 'content/eventsListContent',
//        'description' => '',
//    ),
//    'eventsListTicketsContent' => array(
//        'file' => 'content/eventsListTicketsContent',
//        'description' => '',
//    ),
//    'eventsItemContent' => array(
//        'file' => 'content/eventsItemContent',
//        'description' => '',
//    ),
//    'textContent' => array(
//        'file' => 'content/textContent',
//        'description' => '',
//    ),
//    'textAsideContent' => array(
//        'file' => 'content/textAsideContent',
//        'description' => '',
//    ),
//    'textAsideRightContent' => array(
//        'file' => 'content/textAsideRightContent',
//        'description' => '',
//    ),
//    'textAsideRightWithImageContent' => array(
//        'file' => 'content/textAsideRightWithImageContent',
//        'description' => '',
//    ),
//    'textAsideWithImageContent' => array(
//        'file' => 'content/textAsideWithImageContent',
//        'description' => '',
//    ),
//    'textWithImageContent' => array(
//        'file' => 'content/textWithImageContent',
//        'description' => '',
//    ),
//    'contactsContent' => array(
//        'file' => 'content/contactsContent',
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