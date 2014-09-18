<?php
$templates = array();

$tmp = array(
    'index' => array(
        'file' => 'index',
        'description' => 'Index template',
    ),
    'partners' => array(
        'file' => 'partners',
        'description' => 'Template for partners',
    ),
    'galleryList' => array(
        'file' => 'galleryList',
        'description' => 'Gallery list template',
    ),
    'galleryBigList' => array(
        'file' => 'galleryBigList',
        'description' => 'Gallery list as big item template',
    ),
    'galleryItem' => array(
        'file' => 'galleryItem',
        'description' => 'Gallery item template',
    ),
    'blogList' => array(
        'file' => 'blogList',
        'description' => 'Blog list template with preview image',
    ),
    'blogListTile' => array(
        'file' => 'blogListTile',
        'description' => 'Blog list as tile template',
    ),
    'blogItem' => array(
        'file' => 'blogItem',
        'description' => 'Blog item with aside in footer template',
    ),
    'blogItemWithoutImage' => array(
        'file' => 'blogItemWithoutImage',
        'description' => 'Blog item with aside in footer and without big image on header template',
    ),
    'blogItemAside' => array(
        'file' => 'blogItemAside',
        'description' => 'Blog item with aside template',
    ),
    'blogItemAsideWithoutImage' => array(
        'file' => 'blogItemAsideWithoutImage',
        'description' => 'Blog item with aside and without big image on header template',
    ),
    'eventsList' => array(
        'file' => 'eventsList',
        'description' => 'Events list template',
    ),
    'eventsListTickets' => array(
        'file' => 'eventsListTickets',
        'description' => 'Events list as tickets template',
    ),
    'eventsItem' => array(
        'file' => 'eventsItem',
        'description' => 'Events item template',
    ),
    'text' => array(
        'file' => 'text',
        'description' => 'Text template',
    ),
    'textAside' => array(
        'file' => 'textAside',
        'description' => 'Text with aside template',
    ),
    'textAsideWithImage' => array(
        'file' => 'textAsideWithImage',
        'description' => 'Text with aside and with image template',
    ),
    'textWithImage' => array(
        'file' => 'textWithImage',
        'description' => 'Text with image template',
    ),
    'contacts' => array(
        'file' => 'contacts',
        'description' => 'Contact page template',
    ),
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