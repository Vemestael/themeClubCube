<?php
$templates = array();

$tmp = array(
    '404' => array(
        'file' => '404',
        'description' => 'Not found page template',
    ),
    'index' => array(
        'file' => 'index',
        'description' => 'Index template',
    ),
    'indexMusic' => array(
        'file' => 'indexMusic',
        'description' => 'Index template (music)',
    ),
    'indexEvents' => array(
        'file' => 'indexEvents',
        'description' => 'Index template (events)',
    ),
    'indexFEvents' => array(
        'file' => 'indexFEvents',
        'description' => 'Index template (frequent events)',
    ),
    'indexGallery' => array(
        'file' => 'indexGallery',
        'description' => 'Index template (frequent events)',
    ),
    'indexPosters' => array(
        'file' => 'indexPosters',
        'description' => 'Index template (posters)',
    ),
    'events' => array(
        'file' => 'events',
        'description' => 'Event template',
    ),
    'video' => array(
        'file' => 'video',
        'description' => 'Video template',
    ),
    'blog' => array(
        'file' => 'blog',
        'description' => 'Blog template',
    ),
    'gallery' => array(
        'file' => 'gallery',
        'description' => 'Gallery template',
    ),
    'partners' => array(
        'file' => 'partners',
        'description' => 'Partners template',
    ),
    'eventsOpen' => array(
        'file' => 'eventsOpen',
        'description' => 'Events open template',
    ),
    'galleryOpen' => array(
        'file' => 'galleryOpen',
        'description' => 'Gallery open template',
    ),
    'blogOpenNoTitleFull' => array(
        'file' => 'blogOpenNoTitleFull',
        'description' => 'Blog open template',
    ),
//    'partners' => array(
//        'file' => 'partners',
//        'description' => 'Template for partners',
//    ),
//    'galleryList' => array(
//        'file' => 'galleryList',
//        'description' => 'Gallery list template',
//    ),
//    'galleryBigList' => array(
//        'file' => 'galleryBigList',
//        'description' => 'Gallery list as big item template',
//    ),
//    'galleryItem' => array(
//        'file' => 'galleryItem',
//        'description' => 'Gallery item template',
//    ),
//    'blogList' => array(
//        'file' => 'blogList',
//        'description' => 'Blog list template with preview image',
//    ),
//    'blogListTile' => array(
//        'file' => 'blogListTile',
//        'description' => 'Blog list as tile template',
//    ),
//    'blogItem' => array(
//        'file' => 'blogItem',
//        'description' => 'Blog item with aside in footer template',
//    ),
//    'blogItemWithoutImage' => array(
//        'file' => 'blogItemWithoutImage',
//        'description' => 'Blog item with aside in footer and without big image on header template',
//    ),
//    'blogItemAside' => array(
//        'file' => 'blogItemAside',
//        'description' => 'Blog item with aside template',
//    ),
//    'blogItemAsideWithoutImage' => array(
//        'file' => 'blogItemAsideWithoutImage',
//        'description' => 'Blog item with aside and without big image on header template',
//    ),
//    'eventsList' => array(
//        'file' => 'eventsList',
//        'description' => 'Events list template',
//    ),
//    'eventsListTickets' => array(
//        'file' => 'eventsListTickets',
//        'description' => 'Events list as tickets template',
//    ),
//    'eventsItem' => array(
//        'file' => 'eventsItem',
//        'description' => 'Events item template',
//    ),
//    'text' => array(
//        'file' => 'text',
//        'description' => 'Text template',
//    ),
//    'textWithImage' => array(
//        'file' => 'textWithImage',
//        'description' => 'Text with image template',
//    ),
//    'textAside' => array(
//        'file' => 'textAside',
//        'description' => 'Text with aside template',
//    ),
//    'textAsideWithImage' => array(
//        'file' => 'textAsideWithImage',
//        'description' => 'Text with aside and with image template',
//    ),
//    'textAsideRight' => array(
//        'file' => 'textAsideRight',
//        'description' => 'Text with aside on right template',
//    ),
//    'textAsideRightWithImage' => array(
//        'file' => 'textAsideWithImage',
//        'description' => 'Text with aside on right and with image template',
//    ),
//    'contacts' => array(
//        'file' => 'contacts',
//        'description' => 'Contact page template',
//    ),
//    '404' => array(
//        'file' => '404',
//        'description' => 'Not found page template',
//    ),
);

// Save chunks for setup options

foreach ($tmp as $k => $v) {
    $template = $modx->newObject('modTemplate');
    $template->fromArray(array(
        'id' => 0,
        'templatename' => $k,
        'description' => @$v['description'],
        'content' => file_get_contents($sources['elements_core'].'/templates/'.$v['file'].'.tpl'),
        'static' => BUILD_TEMPLATE_STATIC,
        'source' => 1,
        'static_file' => 'assets/'.PKG_NAME_LOWER.'-elements/templates/'.$v['file'].'.tpl',
    ),'',true,true);

    $templates[] = $template;
}

unset($tmp);
return $templates;