<?php

$chunks = array();

$tmp = array(
    // Index
    'blockquoteBlog' => array(
        'file' => 'partsBlog/blockquoteBlog',
        'description' => '',
    ),
    'blogItemBlog' => array(
        'file' => 'partsBlog/blogItemBlog',
        'description' => '',
    ),
    'blogListBlog' => array(
        'file' => 'partsBlog/blogListBlog',
        'description' => '',
    ),
    'blogOpenNoTitleBlog' => array(
        'file' => 'partsBlog/blogOpenNoTitleBlog',
        'description' => '',
    ),
    'blogOpenTitleBlog' => array(
        'file' => 'partsBlog/blogOpenTitleBlog',
        'description' => '',
    ),
    'eventsDownItemBlog' => array(
        'file' => 'partsBlog/eventsDownItemBlog',
        'description' => '',
    ),
    'eventsDownListBlog' => array(
        'file' => 'partsBlog/eventsDownListBlog',
        'description' => '',
    ),
    'sidebarBlogItemBlog' => array(
        'file' => 'partsBlog/sidebarBlogItemBlog',
        'description' => '',
    ),
    'sidebarBlogListBlog' => array(
        'file' => 'partsBlog/sidebarBlogListBlog',
        'description' => '',
    ),
//    'blogItemBlog' => array(
//        'file' => 'partsBlog/blogItemBlog',
//        'description' => '',
//    ),
//    'blogItemTileBlog' => array(
//        'file' => 'partsBlog/blogItemTileBlog',
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